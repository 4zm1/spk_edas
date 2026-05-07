<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Edas_model');
        
        // --- TAMBAHKAN INI ---
        // Jika belum login, tendang ke halaman login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        $data['title'] = "Hasil Analisa";
        
        // --- 1. AMBIL DATA DARI MODEL ---
        $kriteria = $this->Edas_model->get_kriteria();
        $alternatif = $this->Edas_model->get_alternatif();
        
        // PERHATIKAN: Ada titik koma (;) di ujung baris ini
        $matriks = $this->Edas_model->get_matriks_keputusan(); 
        
        // --- 2. LOGIKA PERHITUNGAN EDAS ---
        
        // A. Hitung Average (AV)
        $av = [];
        foreach($kriteria as $krit) {
            $sum = 0;
            foreach($alternatif as $alt) {
                // Cek apakah nilai ada di matriks
                $nilai = isset($matriks[$alt['id_alternatif']][$krit['id_kriteria']]) 
                         ? $matriks[$alt['id_alternatif']][$krit['id_kriteria']] 
                         : 0; 
                $sum += $nilai;
            }
            // Hindari pembagian dengan nol
            $count = count($alternatif);
            $av[$krit['id_kriteria']] = ($count > 0) ? $sum / $count : 0;
        }

        // B. Hitung PDA & NDA
        $pda = []; 
        $nda = [];
        
        foreach($alternatif as $alt) {
            foreach($kriteria as $krit) {
                $x = isset($matriks[$alt['id_alternatif']][$krit['id_kriteria']]) 
                     ? $matriks[$alt['id_alternatif']][$krit['id_kriteria']] 
                     : 0;
                     
                $avg = $av[$krit['id_kriteria']];
                
                // Jika Average 0, set 0 agar tidak error
                if($avg == 0) {
                    $pda[$alt['id_alternatif']][$krit['id_kriteria']] = 0;
                    $nda[$alt['id_alternatif']][$krit['id_kriteria']] = 0;
                    continue;
                }

                // Rumus PDA/NDA
                if($krit['jenis'] == 'Benefit') {
                    $pda[$alt['id_alternatif']][$krit['id_kriteria']] = max(0, ($x - $avg) / $avg);
                    $nda[$alt['id_alternatif']][$krit['id_kriteria']] = max(0, ($avg - $x) / $avg);
                } else { // Cost
                    $pda[$alt['id_alternatif']][$krit['id_kriteria']] = max(0, ($avg - $x) / $avg);
                    $nda[$alt['id_alternatif']][$krit['id_kriteria']] = max(0, ($x - $avg) / $avg);
                }
            }
        }

        // C. Hitung SP & SN
        $sp = []; 
        $sn = [];
        
        foreach($alternatif as $alt) {
            $sp_temp = 0; 
            $sn_temp = 0;
            foreach($kriteria as $krit) {
                $val_pda = isset($pda[$alt['id_alternatif']][$krit['id_kriteria']]) ? $pda[$alt['id_alternatif']][$krit['id_kriteria']] : 0;
                $val_nda = isset($nda[$alt['id_alternatif']][$krit['id_kriteria']]) ? $nda[$alt['id_alternatif']][$krit['id_kriteria']] : 0;

                $sp_temp += $krit['bobot'] * $val_pda;
                $sn_temp += $krit['bobot'] * $val_nda;
            }
            $sp[$alt['id_alternatif']] = $sp_temp;
            $sn[$alt['id_alternatif']] = $sn_temp;
        }

        // D. Normalisasi & Appraisal Score (AS)
        $max_sp = empty($sp) ? 0 : max($sp);
        $max_sn = empty($sn) ? 0 : max($sn);
        $rank = [];

        foreach($alternatif as $alt) {
            $nsp = ($max_sp != 0) ? $sp[$alt['id_alternatif']] / $max_sp : 0;
            $nsn = ($max_sn != 0) ? 1 - ($sn[$alt['id_alternatif']] / $max_sn) : 0;
            
            $as = ($nsp + $nsn) / 2;
            
            $rank[] = [
                'kode' => $alt['kode_alternatif'],
                'nama' => $alt['nama_alternatif'],
                'nilai' => $as
            ];
        }

        // Sorting
        usort($rank, function($a, $b) { return $b['nilai'] <=> $a['nilai']; });

        // Kirim data ke View
        $data['kriteria'] = $kriteria;
        $data['alternatif'] = $alternatif;
        $data['matriks'] = $matriks;
        $data['av'] = $av;
        $data['rank'] = $rank;

        $this->load->view('layout/header', $data);  // Head & CSS
        $this->load->view('layout/sidebar');        // Menu Samping
        $this->load->view('layout/navbar');         // Menu Atas & Wrapper Buka
        $this->load->view('edas_result', $data);    // KONTEN UTAMA
        $this->load->view('layout/footer');
    }
}
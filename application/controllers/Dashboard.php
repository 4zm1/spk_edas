<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Edas_model');
        
        // --- TAMBAHKAN INI ---
        // Jika belum login, tendang ke halaman login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Edas_model');
    }

    public function index() {
        $data['title'] = "Dashboard Utama";
        
        // 1. Ambil Data Dasar
        $kriteria = $this->Edas_model->get_kriteria();
        $alternatif = $this->Edas_model->get_alternatif();
        $matriks = $this->Edas_model->get_matriks_keputusan();
        
        $data['total_kriteria'] = count($kriteria);
        $data['total_alternatif'] = count($alternatif);

        // 2. HITUNG SKOR EDAS (Untuk Data Grafik)
        // A. Hitung Rata-rata (AV)
        $av = [];
        foreach($kriteria as $krit) {
            $sum = 0;
            foreach($alternatif as $alt) {
                $nilai = isset($matriks[$alt['id_alternatif']][$krit['id_kriteria']]) ? $matriks[$alt['id_alternatif']][$krit['id_kriteria']] : 0;
                $sum += $nilai;
            }
            $count = count($alternatif);
            $av[$krit['id_kriteria']] = ($count > 0) ? $sum / $count : 0;
        }

        // B. Hitung PDA & NDA
        $pda = []; $nda = [];
        foreach($alternatif as $alt) {
            foreach($kriteria as $krit) {
                $x = isset($matriks[$alt['id_alternatif']][$krit['id_kriteria']]) ? $matriks[$alt['id_alternatif']][$krit['id_kriteria']] : 0;
                $avg = $av[$krit['id_kriteria']];
                if($avg == 0) {
                    $pda[$alt['id_alternatif']][$krit['id_kriteria']] = 0;
                    $nda[$alt['id_alternatif']][$krit['id_kriteria']] = 0;
                    continue;
                }
                if($krit['jenis'] == 'Benefit') {
                    $pda[$alt['id_alternatif']][$krit['id_kriteria']] = max(0, ($x - $avg) / $avg);
                    $nda[$alt['id_alternatif']][$krit['id_kriteria']] = max(0, ($avg - $x) / $avg);
                } else { 
                    $pda[$alt['id_alternatif']][$krit['id_kriteria']] = max(0, ($avg - $x) / $avg);
                    $nda[$alt['id_alternatif']][$krit['id_kriteria']] = max(0, ($x - $avg) / $avg);
                }
            }
        }

        // C. Hitung SP, SN & Skor Akhir (AS)
        $sp = []; $sn = []; $skor_akhir = [];
        
        foreach($alternatif as $alt) {
            $sp_temp = 0; $sn_temp = 0;
            foreach($kriteria as $krit) {
                $val_pda = isset($pda[$alt['id_alternatif']][$krit['id_kriteria']]) ? $pda[$alt['id_alternatif']][$krit['id_kriteria']] : 0;
                $val_nda = isset($nda[$alt['id_alternatif']][$krit['id_kriteria']]) ? $nda[$alt['id_alternatif']][$krit['id_kriteria']] : 0;
                $sp_temp += $krit['bobot'] * $val_pda;
                $sn_temp += $krit['bobot'] * $val_nda;
            }
            $sp[$alt['id_alternatif']] = $sp_temp;
            $sn[$alt['id_alternatif']] = $sn_temp;
        }

        $max_sp = empty($sp) ? 0 : max($sp);
        $max_sn = empty($sn) ? 0 : max($sn);

        foreach($alternatif as $alt) {
            $nsp = ($max_sp != 0) ? $sp[$alt['id_alternatif']] / $max_sp : 0;
            $nsn = ($max_sn != 0) ? 1 - ($sn[$alt['id_alternatif']] / $max_sn) : 0;
            $as = ($nsp + $nsn) / 2;
            
            // Simpan data untuk grafik
            $skor_akhir[] = [
                'nama' => $alt['nama_alternatif'],
                'nilai' => number_format($as, 4) // Format 4 desimal
            ];
        }

        // Urutkan untuk grafik (Juara di kiri/atas)
        usort($skor_akhir, function($a, $b) { return $b['nilai'] <=> $a['nilai']; });

        // Kirim data ke View
        $data['chart_hasil'] = $skor_akhir;
        $data['chart_kriteria'] = $kriteria;

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/navbar');
        $this->load->view('dashboard/index', $data);
        $this->load->view('layout/footer');
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaian extends CI_Controller {

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
        $data['title'] = "Input Penilaian Matriks";
        
        // Ambil semua data yang dibutuhkan
        $data['alternatif'] = $this->Edas_model->get_alternatif();
        $data['kriteria'] = $this->Edas_model->get_kriteria();
        
        // Ambil matriks yang sudah ada agar form terisi nilai lama
        $data['matriks'] = $this->Edas_model->get_matriks_keputusan();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/navbar');
        $this->load->view('penilaian/index', $data);
        $this->load->view('layout/footer');
    }

    // Proses Simpan Semua Data Sekaligus
    public function update() {
        // Data dikirim dalam bentuk array: nilai[id_alternatif][id_kriteria]
        $nilai_input = $this->input->post('nilai');

        if ($nilai_input) {
            foreach ($nilai_input as $id_alt => $kriteria_nilai) {
                foreach ($kriteria_nilai as $id_krit => $nilai) {
                    // Simpan satu per satu
                    $this->Edas_model->simpan_nilai($id_alt, $id_krit, $nilai);
                }
            }
            
            $this->session->set_flashdata('message', '<div class="alert alert-success">Nilai matriks berhasil diperbarui! Silakan cek hasil perhitungan.</div>');
        }

        // Setelah simpan, kembalikan ke halaman penilaian
        redirect('penilaian');
    }
}
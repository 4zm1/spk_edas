<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Alternatif extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Edas_model');
        
        // --- TAMBAHKAN INI ---
        // Jika belum login, tendang ke halaman login
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
        $this->load->model('Edas_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = "Data Alternatif Sunscreen";
        $data['alternatif'] = $this->Edas_model->get_alternatif();

        // Load View dengan Layout
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/navbar');
        $this->load->view('alternatif/index', $data); // View utama kita nanti
        $this->load->view('layout/footer');
    }

    // Proses Tambah Data
    public function simpan() {
        $data = [
            'kode_alternatif' => $this->input->post('kode'),
            'nama_alternatif' => $this->input->post('nama')
        ];
        
        $this->Edas_model->insert_alternatif($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil ditambahkan!</div>');
        redirect('alternatif');
    }

    // Proses Update Data
    public function update() {
        $id = $this->input->post('id_alternatif');
        $data = [
            'kode_alternatif' => $this->input->post('kode'),
            'nama_alternatif' => $this->input->post('nama')
        ];

        $this->Edas_model->update_alternatif($id, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-primary">Data berhasil diperbarui!</div>');
        redirect('alternatif');
    }

    // Proses Hapus Data
    public function hapus($id) {
        $this->Edas_model->delete_alternatif($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Data berhasil dihapus!</div>');
        redirect('alternatif');
    }
}
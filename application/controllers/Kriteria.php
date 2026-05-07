<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

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
        $data['title'] = "Data Kriteria";
        $data['kriteria'] = $this->Edas_model->get_kriteria();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/navbar');
        $this->load->view('kriteria/index', $data);
        $this->load->view('layout/footer');
    }

    public function simpan() {
        $data = [
            'kode_kriteria' => $this->input->post('kode'),
            'nama_kriteria' => $this->input->post('nama'),
            'bobot'         => $this->input->post('bobot'),
            'jenis'         => $this->input->post('jenis')
        ];
        
        $this->Edas_model->insert_kriteria($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Kriteria berhasil ditambahkan!</div>');
        redirect('kriteria');
    }

    public function update() {
        $id = $this->input->post('id_kriteria');
        $data = [
            'kode_kriteria' => $this->input->post('kode'),
            'nama_kriteria' => $this->input->post('nama'),
            'bobot'         => $this->input->post('bobot'),
            'jenis'         => $this->input->post('jenis')
        ];

        $this->Edas_model->update_kriteria($id, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-primary">Kriteria berhasil diperbarui!</div>');
        redirect('kriteria');
    }

    public function hapus($id) {
        $this->Edas_model->delete_kriteria($id);
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Kriteria berhasil dihapus!</div>');
        redirect('kriteria');
    }
}
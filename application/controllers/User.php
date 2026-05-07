<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        
        // Cek Login (Wajib)
        if (!$this->session->userdata('logged_in')) {
            redirect('auth');
        }
    }

    public function index() {
        $data['title'] = "Manajemen User";
        $data['users'] = $this->User_model->get_all();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('layout/navbar');
        $this->load->view('user/index', $data);
        $this->load->view('layout/footer');
    }

    // Simpan User Baru
    public function simpan() {
        $data = [
            'nama_lengkap' => $this->input->post('nama'),
            'username'     => $this->input->post('username'),
            'password'     => md5($this->input->post('password')) // Enkripsi MD5
        ];

        $this->User_model->insert($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success">User baru berhasil ditambahkan!</div>');
        redirect('user');
    }

    // Update User
    public function update() {
        $id = $this->input->post('id_user');
        $password_baru = $this->input->post('password');

        $data = [
            'nama_lengkap' => $this->input->post('nama'),
            'username'     => $this->input->post('username')
        ];

        // Jika password diisi, update passwordnya. Jika kosong, abaikan.
        if (!empty($password_baru)) {
            $data['password'] = md5($password_baru);
        }

        $this->User_model->update($id, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-primary">Data user berhasil diperbarui!</div>');
        redirect('user');
    }

    // Hapus User
    public function hapus($id) {
        // Mencegah hapus akun sendiri yang sedang login
        if ($id == $this->session->userdata('id_user')) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning">Anda tidak bisa menghapus akun yang sedang digunakan!</div>');
        } else {
            $this->User_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-danger">User berhasil dihapus!</div>');
        }
        redirect('user');
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index() {
        // Jika sudah login, lempar ke dashboard
        if ($this->session->userdata('id_user')) {
            redirect('dashboard');
        }

        // Load View Login (Tanpa Sidebar/Header standar karena ini halaman khusus)
        $this->load->view('auth/login');
    }

    public function process() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $cek = $this->Auth_model->cek_login($username, $password);

        if ($cek) {
            // Set Session
            $sess_data = [
                'id_user' => $cek['id_user'],
                'username' => $cek['username'],
                'nama' => $cek['nama_lengkap'],
                'logged_in' => TRUE
            ];
            $this->session->set_userdata($sess_data);
            
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Username atau Password salah!</div>');
            redirect('auth');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
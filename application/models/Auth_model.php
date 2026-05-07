<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function cek_login($username, $password) {
        // Cek username
        $user = $this->db->get_where('users', ['username' => $username])->row_array();
        
        // Jika user ada
        if ($user) {
            // Cek password (menggunakan MD5 sesuai database tadi)
            if (md5($password) === $user['password']) {
                return $user; // Login Sukses
            }
        }
        return false; // Login Gagal
    }
}
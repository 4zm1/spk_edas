<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    // Ambil semua data user
    public function get_all() {
        return $this->db->get('users')->result_array();
    }

    // Tambah User Baru
    public function insert($data) {
        return $this->db->insert('users', $data);
    }

    // Update User
    public function update($id, $data) {
        $this->db->where('id_user', $id);
        return $this->db->update('users', $data);
    }

    // Hapus User
    public function delete($id) {
        $this->db->where('id_user', $id);
        return $this->db->delete('users');
    }
}
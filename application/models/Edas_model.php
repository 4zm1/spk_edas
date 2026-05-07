<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edas_model extends CI_Model {

    // Ambil semua data kriteria
    public function get_kriteria() {
        return $this->db->get('kriteria')->result_array();
    }

    // Ambil semua data alternatif
    public function get_alternatif() {
        return $this->db->get('alternatif')->result_array();
    }

    /**
     * Mengambil nilai matriks dan menyusunnya menjadi array asosiatif
     * Format array: [id_alternatif][id_kriteria] = nilai
     */
    public function get_matriks_keputusan() {
        $query = $this->db->get('nilai_matriks')->result_array();
        
        $matriks = [];
        foreach($query as $row) {
            // Mapping: id_alternatif -> id_kriteria = nilai
            $matriks[$row['id_alternatif']][$row['id_kriteria']] = $row['nilai'];
        }
        
        return $matriks;
    }

    // (Opsional) Ambil nilai spesifik satu sel
    public function get_nilai_spesifik($id_alt, $id_krit) {
        $this->db->where('id_alternatif', $id_alt);
        $this->db->where('id_kriteria', $id_krit);
        return $this->db->get('nilai_matriks')->row()->nilai;
    }
    // --- TAMBAHAN UNTUK CRUD ALTERNATIF ---

    // Ambil 1 data spesifik untuk Edit
    public function get_alternatif_by_id($id) {
        return $this->db->get_where('alternatif', ['id_alternatif' => $id])->row_array();
    }

    // Simpan Data Baru
    public function insert_alternatif($data) {
        return $this->db->insert('alternatif', $data);
    }

    // Update Data
    public function update_alternatif($id, $data) {
        $this->db->where('id_alternatif', $id);
        return $this->db->update('alternatif', $data);
    }

    // Hapus Data (Hapus juga nilainya di matriks agar tidak error)
    public function delete_alternatif($id) {
        // Hapus nilai matriks terkait dulu
        $this->db->delete('nilai_matriks', ['id_alternatif' => $id]);
        // Baru hapus alternatifnya
        $this->db->delete('alternatif', ['id_alternatif' => $id]);
    }
    // --- TAMBAHAN UNTUK CRUD KRITERIA ---

    // Ambil 1 kriteria spesifik (untuk Edit)
    public function get_kriteria_by_id($id) {
        return $this->db->get_where('kriteria', ['id_kriteria' => $id])->row_array();
    }

    // Simpan Kriteria Baru
    public function insert_kriteria($data) {
        return $this->db->insert('kriteria', $data);
    }

    // Update Kriteria
    public function update_kriteria($id, $data) {
        $this->db->where('id_kriteria', $id);
        return $this->db->update('kriteria', $data);
    }

    // Hapus Kriteria
    public function delete_kriteria($id) {
        // Hapus nilai penilaian yang terkait kriteria ini dulu
        $this->db->delete('nilai_matriks', ['id_kriteria' => $id]);
        // Baru hapus kriterianya
        $this->db->delete('kriteria', ['id_kriteria' => $id]);
    }
    // --- TAMBAHAN UNTUK INPUT PENILAIAN ---

    // Simpan atau Update Nilai Matriks
    public function simpan_nilai($id_alt, $id_krit, $nilai) {
        $cek = $this->db->get_where('nilai_matriks', [
            'id_alternatif' => $id_alt,
            'id_kriteria' => $id_krit
        ]);

        if ($cek->num_rows() > 0) {
            // Jika sudah ada, update
            $this->db->where([
                'id_alternatif' => $id_alt,
                'id_kriteria' => $id_krit
            ]);
            $this->db->update('nilai_matriks', ['nilai' => $nilai]);
        } else {
            // Jika belum ada, insert baru
            $this->db->insert('nilai_matriks', [
                'id_alternatif' => $id_alt,
                'id_kriteria' => $id_krit,
                'nilai' => $nilai
            ]);
        }
    }
}
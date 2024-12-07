<?php
include('model.php');

class PelanggaranModel extends Model
{
    private $db;
    private $table = 'pelanggaran';


    public function __construct()
    {
        include_once('../lib/connection.php');

        $this->db = $db;
        $this->db->set_charset('utf8');
    }

    public function insertData($data)
    {
        // Prepare statement untuk query insert
        $query = $this->db->prepare("INSERT INTO {$this->table} (id_pelapor, id_terlapor, id_dpa, id_tatib, sanksi, lampiran) VALUES (?, ?, ?, ?, ?, ?)");

        // Binding parameter ke query
        $query->bind_param('ssssss', $data['id_pelapor'], $data['id_terlapor'], $data['id_dpa'], $data['id_tatib'], $data['sanksi'], $data['lampiran']);

        // Eksekusi query untuk menyimpan ke database
        $query->execute();
    }

    public function getData()
    {
        // Query untuk mengambil semua data dari tabel pelanggaran
        return $this->db->query("SELECT * FROM {$this->table}");
    }

    public function getDataById($id)
    {
        // Query untuk mengambil data berdasarkan id_pelanggaran
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE id_pelanggaran = ?");

        // Binding parameter ke query
        $query->bind_param('i', $id);

        // Eksekusi query
        $query->execute();

        // Ambil hasil query
        return $query->get_result()->fetch_assoc();
    }

    public function updateData($id, $data)
    {
        // Query untuk update data
        $query = $this->db->prepare("UPDATE {$this->table} SET id_pelapor = ?, id_terlapor = ?, id_dpa = ?, id_tatib = ?, sanksi = ?, lampiran = ? WHERE id_pelanggaran = ?");

        // Binding parameter ke query
        $query->bind_param('ssssssi', $data['id_pelapor'], $data['id_terlapor'], $data['id_dpa'], $data['id_tatib'], $data['sanksi'], $data['lampiran'], $id);

        // Eksekusi query
        $query->execute();
    }

    public function deleteData($id)
    {
        // Query untuk delete data
        $query = $this->db->prepare("DELETE FROM {$this->table} WHERE id_pelanggaran = ?");

        // Binding parameter ke query
        $query->bind_param('i', $id);

        // Eksekusi query
        $query->execute();
    }
}

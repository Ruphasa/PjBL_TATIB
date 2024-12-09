<?php
include('model.php');

class PelanggaranModel extends Model
{
    private $db;
    private $table = 'pelanggaran';

    public function __construct()
    {
        include_once('../lib/connection.php');

        global $db; // Ensure $db is a global variable
        $this->db = $db;
        $this->db->set_charset('utf8');
    }

    public function insertData($data)
    {
        // Prepare statement untuk query insert
        $query = $this->db->prepare("INSERT INTO {$this->table} (id_pelapor, id_terlapor, id_dpa, id_tatib, sanksi, lampiran) VALUES (?, ?, ?, ?, ?, ?)");

        if ($query === false) {
            die('Prepare failed: ' . htmlspecialchars($this->db->error));
        }

        // Binding parameter ke query
        $query->bind_param('ssssss', $data['id_pelapor'], $data['id_terlapor'], $data['id_dpa'], $data['id_tatib'], $data['sanksi'], $data['lampiran']);

        // Eksekusi query untuk menyimpan ke database
        $success = $query->execute();

        if ($success === false) {
            die('Execute failed: ' . htmlspecialchars($query->error));
        }

        $query->close();
    }

    public function getData()
    {
        // Query untuk mengambil semua data dari tabel pelanggaran
        $result = $this->db->query("SELECT * FROM {$this->table}");

        if ($result === false) {
            die('Query failed: ' . htmlspecialchars($this->db->error));
        }

        return $result;
    }

    public function getDataById($id)
    {
        // Query untuk mengambil data berdasarkan id_pelanggaran
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE id_pelanggaran = ?");

        if ($query === false) {
            die('Prepare failed: ' . htmlspecialchars($this->db->error));
        }

        // Binding parameter ke query
        $query->bind_param('i', $id);

        // Eksekusi query
        $query->execute();

        // Ambil hasil query
        $result = $query->get_result();

        if ($result === false) {
            die('Get result failed: ' . htmlspecialchars($query->error));
        }

        $data = $result->fetch_assoc();
        $query->close();

        return $data;
    }

    public function updateData($id, $data)
    {
        // Query untuk update data
        $query = $this->db->prepare("UPDATE {$this->table} SET id_pelapor = ?, id_terlapor = ?, id_dpa = ?, id_tatib = ?, lampiran = ? WHERE id_pelanggaran = ?");

        if ($query === false) {
            die('Prepare failed: ' . htmlspecialchars($this->db->error));
        }

        // Binding parameter ke query
        $query->bind_param('sssssi', $data['id_pelapor'], $data['id_terlapor'], $data['id_dpa'], $data['id_tatib'], $data['lampiran'], $id);

        // Eksekusi query
        $success = $query->execute();

        if ($success === false) {
            die('Execute failed: ' . htmlspecialchars($query->error));
        }

        $query->close();
    }

    public function deleteData($id)
    {
        // Query untuk delete data
        $query = $this->db->prepare("DELETE FROM {$this->table} WHERE id_pelanggaran = ?");

        if ($query === false) {
            die('Prepare failed: ' . htmlspecialchars($this->db->error));
        }

        // Binding parameter ke query
        $query->bind_param('i', $id);

        // Eksekusi query
        $success = $query->execute();

        if ($success === false) {
            die('Execute failed: ' . htmlspecialchars($query->error));
        }

        $query->close();
    }

    public function getDataByNim($nim)
    {
        // Query untuk mengambil data berdasarkan NIM
        $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE id_pelapor = ?");

        if ($query === false) {
            die('Prepare failed: ' . htmlspecialchars($this->db->error));
        }

        // Binding parameter ke query
        $query->bind_param('s', $nim);

        // Eksekusi query
        $query->execute();

        // Ambil hasil query
        $result = $query->get_result();

        if ($result === false) {
            die('Get result failed: ' . htmlspecialchars($query->error));
        }

        $data = $result->fetch_assoc();
        $query->close();

        return $data;
    }
}

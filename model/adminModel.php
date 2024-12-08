<?php
include('Model.php');

class adminModel extends Model
{
    private $db;
    private $table = 'verifikasi';

    public function __construct()
    {
        include_once('../lib/connection.php');

        $this->db = $db;
        $this->db->set_charset('utf8');
    }

    public function insertData($id)
    {
        $query = "INSERT INTO $this->table (id) VALUES ('$id')";
        $result = $this->db->query($query);
        return $result;
    }

    public function updateData($id, $data)
    {
        $query = "UPDATE $this->table SET status = '$data' WHERE id = '$id'";
        $result = $this->db->query($query);
        return $result;
    }

    public function getDataById($id)
    {
        $query = "SELECT * FROM $this->table WHERE id = '$id'";
        $result = $this->db->query($query);
        return $result;
    }

    public function getData()
    {
        $query = "SELECT * FROM $this->table";
        $result = $this->db->query($query);
        return $result;
    }

    public function deleteData($id)
    {
        $query = "DELETE FROM $this->table WHERE id = '$id'";
        $result = $this->db->query($query);
        return $result;
    }
}
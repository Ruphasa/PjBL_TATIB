<?php
class Connection {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'pjbl';
    private $connection;

    public function connect() {
        if (!$this->connection) {
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

            if ($this->connection->connect_error) {
                die('Koneksi database gagal: ' . $this->connection->connect_error);
            }

            $this->connection->set_charset('utf8mb4'); // Set charset ke UTF-8
        }
        return $this->connection;
    }
}
?>

<?php
try {
    $db = new mysqli('localhost', 'root', '', 'pjbl');
    if ($db->connect_error) {
        die('Connection DB failed: ' . $db->connect_error);
    }
} catch (Exception $e) {
    die($e->getMessage());
}
?>
<?php
include_once('../lib/Session.php');
include('../lib/Connection.php');

$session = new Session();

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'login') {
    $id = $_POST['id'];
    $password = $_POST['password'];

    // digunakan untuk query user
    $queryMahasiswa = $db->prepare('SELECT * FROM mahasiswa WHERE NIM = ?');
    $queryMahasiswa->bind_param('s', $id);
    $queryMahasiswa->execute();
    $dataMahasiswa = $queryMahasiswa->get_result()->fetch_assoc();
    $queryMahasiswa->close(); // Tutup query

    $queryDosen = $db->prepare('SELECT * FROM dosen WHERE NIP = ?');
    $queryDosen->bind_param('s', $id);
    $queryDosen->execute();
    $dataDosen = $queryDosen->get_result()->fetch_assoc();
    $queryDosen->close(); // Tutup query

    $queryAdmin = $db->prepare('SELECT * FROM admin WHERE id_admin = ?');
    $queryAdmin->bind_param('s', $id);
    $queryAdmin->execute();
    $dataAdmin = $queryAdmin->get_result()->fetch_assoc();
    $queryAdmin->close(); // Tutup query

    // jika password sesuai
    if ($dataMahasiswa &&$dataMahasiswa['password'] == $password) {
        $session->set('is_login', true);
        $session->set('id', $id);
        $session->set('name', $dataMahasiswa['nama']);
        $session->set('role', 'user');
        $session->commit();

        header('Location: ../index.php');
    } else if ($dataAdmin && $dataAdmin['password'] == $password) {
        $session->set('is_login', true);
        $session->set('id', $id);
        $session->set('name', $dataAdmin['nama']);
        $session->set('role', 'admin');
        $session->commit();

        header('Location: ../index.php');
    } else if ($dataDosen && $dataDosen['password'] == $password) {
        $session->set('is_login', true);
        $session->set('id', $id);
        $session->set('name', $dataDosen['nama']);
        $session->set('role', 'user');
        $session->commit();

        header('Location: ../index.php');
    } else {
        $session->set('is_login', false);
        $session->commit();
        header('Location: ../login.php');
    }
} else if ($act == 'logout') { // Logout case 
    $session->deleteAll(); // Menghapus semua data sesi 
    header('Location: ../login.php'); // Redirect ke halaman login 
}
?>
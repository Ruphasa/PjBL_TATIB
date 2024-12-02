<?php
include('../lib/Session.php');
include('../lib/Connection.php');

$session = new Session();

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'login') {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // digunakan untuk query user
    $queryMahasiswa = $db->prepare('SELECT * FROM mahasiswa WHERE nama = ?');
    $queryMahasiswa->bind_param('s', $username);
    $queryMahasiswa->execute();
    $dataMahasiswa = $queryMahasiswa->get_result()->fetch_assoc();
    $queryMahasiswa->close(); // Tutup query

    $queryDosen = $db->prepare('SELECT * FROM dosen WHERE nama = ?');
    $queryDosen->bind_param('s', $username);
    $queryDosen->execute();
    $dataDosen = $queryDosen->get_result()->fetch_assoc();
    $queryDosen->close(); // Tutup query

    $queryAdmin = $db->prepare('SELECT * FROM admin WHERE nama = ?');
    $queryAdmin->bind_param('s', $username);
    $queryAdmin->execute();
    $dataAdmin = $queryAdmin->get_result()->fetch_assoc();
    $queryAdmin->close(); // Tutup query

    // jika password sesuai
    if ($dataMahasiswa && password_verify($password, $dataMahasiswa['password'])) {
        $session->set('is_login', true);
        $session->set('name', $dataMahasiswa['nama']);
        $session->commit();

        header('Location: ../index.php');
    } else if ($dataAdmin && $dataAdmin['password'] == $password) {
        $session->set('is_login', true);
        $session->set('name', $dataAdmin['nama']);
        $session->commit();

        header('Location: ../index.php');
    } else if ($dataDosen && $dataDosen['password'] == $password) {
        $session->set('is_login', true);
        $session->set('name', $dataDosen['nama']);
        $session->commit();

        header('Location: ../index.php');
    } else {
        $session->setFlash('status', false);
        $session->setFlash('message', 'Username dan password salah.');
        $session->commit();
        header('Location: ../login.php');
    }
} else if ($act == 'logout') {
    $session->deleteAll();
    header('Location: ../login.php');
}
?>

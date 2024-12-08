<?php
include_once('../lib/Session.php');
include_once('../model/userModel.php');
include_once('../lib/Secure.php');
include_once('../lib/Connection.php');

$session = new Session();
$model = new PelanggaranModel();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}


$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if($act == 'verifikasi'){
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $pelanggaran = new PelanggaranModel();
    $pelanggaran->verifikasiData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diverifikasi.'
    ]);
}
?>
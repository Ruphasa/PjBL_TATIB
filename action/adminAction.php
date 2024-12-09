<?php
include_once('../lib/Session.php');
include_once('../model/adminModel.php');
include_once('../lib/Secure.php');
include_once('../lib/Connection.php');

$session = new Session();
$model = new adminModel();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}


$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if($act == 'verifikasi'){
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $pelanggaran = new adminModel();
    $pelanggaran->updateData($id, 'ongoing');

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diverifikasi.'
    ]);
}else if($act == 'selesai'){
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $pelanggaran = new adminModel();
    $pelanggaran->updateData($id, 'done');

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diselesaikan.'
    ]);
}else if($act == 'reject'){
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $pelanggaran = new adminModel();
    $pelanggaran->updateData($id, 'rejected');

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil ditolak.'
    ]);
}else if($act == 'revisi'){
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $pelanggaran = new adminModel();
    $pelanggaran->updateData($id, 'revisi');

    echo json_encode([
        'status' => true,
        'message' => 'Data kembali ke pelanggar.'
    ]);
}
?>
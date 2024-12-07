<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/PelanggaranModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $pelanggaran = new PelanggaranModel();
    $data = $pelanggaran->getData();
    $result = [];
    $i = 1;
    while ($row = $data->fetch_assoc()) {
        $result['data'][] = [
            $i,
            $row['id_pelapor'],
            $row['id_terlapor'],
            $row['id_dpa'],
            $row['id_tatib'],
            $row['sanksi'],
            $row['lampiran'],
            '<button class="btn btn-sm btn-warning" 
onclick="editData(' . $row['id_pelanggaran'] . ')"><i class="fa fa-edit"></i></button>
            <button class="btn btn-sm btn-danger" 
onclick="deleteData(' . $row['id_pelanggaran'] . ')"><i class="fa fa-trash"></i></button>'
        ];
        $i++;
    }
    echo json_encode($result);
}

if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $pelanggaran = new PelanggaranModel();
    $data = $pelanggaran->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
        'id_pelapor' => antiSqlInjection($_POST['id_pelapor']),
        'id_terlapor' => antiSqlInjection($_POST['id_terlapor']),
        'id_dpa' => antiSqlInjection($_POST['id_dpa']),
        'id_tatib' => antiSqlInjection($_POST['id_tatib']),
        'sanksi' => antiSqlInjection($_POST['sanksi']),
        'lampiran' => antiSqlInjection($_POST['lampiran'])
    ];

    $pelanggaran = new PelanggaranModel();
    $pelanggaran->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [
        'id_pelapor' => antiSqlInjection($_POST['id_pelapor']),
        'id_terlapor' => antiSqlInjection($_POST['id_terlapor']),
        'id_dpa' => antiSqlInjection($_POST['id_dpa']),
        'id_tatib' => antiSqlInjection($_POST['id_tatib']),
        'sanksi' => antiSqlInjection($_POST['sanksi']),
        'lampiran' => antiSqlInjection($_POST['lampiran'])
    ];

    $pelanggaran = new PelanggaranModel();
    $pelanggaran->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $pelanggaran = new PelanggaranModel();
    $pelanggaran->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}

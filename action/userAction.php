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
if ($act == 'lapor') {
    // Get the NIM details
    $row = $model->getDataByNim($_POST['NIM']);
    if (!$row) {
        echo json_encode(['status' => false, 'message' => 'NIM tidak ditemukan.']);
        exit;
    }

    // Get the form data
    $id_pelapor = $session->get('id');
    $id_terlapor = $_POST['NIM'];
    $id_dpa = $row['id_dpa'];
    $id_tatib = $_POST['id_tatib'];
    $lampiran = $_FILES['lampiran']; 

    // Debugging: Print the received data
    error_log("ID Pelapor: " . $id_pelapor);
    error_log("ID Terlapor: " . $id_terlapor);
    error_log("ID DPA: " . $id_dpa);
    error_log("ID Tatib: " . $id_tatib);
    error_log("Lampiran: " . print_r($lampiran, true));

    // Perform necessary validations and file upload processing
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($lampiran["name"]);

    if (move_uploaded_file($lampiran["tmp_name"], $target_file)) {
        // Insert data into the database
        $query = $db->prepare('INSERT INTO pelanggaran (id_pelapor, id_terlapor, id_dpa, id_tatib, lampiran) VALUES (?, ?, ?, ?, ?)');
        $query->bind_param('sssss', $id_pelapor, $id_terlapor, $id_dpa, $id_tatib, $target_file);

        if ($query->execute()) {
            echo json_encode(['status' => true, 'message' => 'Data berhasil disimpan!']);
        } else {
            error_log('Error executing query: ' . $query->error);
            echo json_encode(['status' => false, 'message' => 'Gagal menyimpan data.']);
        }

        $query->close();
    } else {
        echo json_encode(['status' => false, 'message' => 'Gagal mengunggah lampiran.']);
    }
} else {
    echo json_encode(['status' => false, 'message' => 'Aksi tidak valid.']);
}
?>


<?php
include_once('../lib/Session.php');
include_once('../model/userModel.php');
include_once('../lib/Secure.php');
include_once('../lib/Connection.php');

$session = new Session();
$model = new PelanggaranModel();
$id = $session->get('id');

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
} elseif ($act == 'get') {
    $pelanggaran = new PelanggaranModel();
    $data = $pelanggaran->getDataById($id);
    echo json_encode($data);
} elseif ($act == 'save') {
    // Check if POST data is set before using it
    $data = [
        'id_pelapor' => isset($_POST['id_pelapor']) ? antiSqlInjection($_POST['id_pelapor']) : '',
        'id_terlapor' => isset($_POST['id_terlapor']) ? antiSqlInjection($_POST['id_terlapor']) : '',
        'id_dpa' => isset($_POST['id_dpa']) ? antiSqlInjection($_POST['id_dpa']) : '',
        'id_tatib' => isset($_POST['id_tatib']) ? antiSqlInjection($_POST['id_tatib']) : '',
        'sanksi' => isset($_POST['sanksi']) ? antiSqlInjection($_POST['sanksi']) : '',
        'lampiran' => isset($_POST['lampiran']) ? antiSqlInjection($_POST['lampiran']) : ''
    ];

    $pelanggaran = new PelanggaranModel();
    $pelanggaran->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
} elseif ($act == 'update') {
    if (isset($_POST['NIM']) && isset($_POST['id_tatib']) && isset($_FILES['lampiran'])) {
        // Get the NIM details
        $row = $model->getDataByNim($_POST['NIM']);
        $id_pelanggaran = (isset($_GET['id_pelanggaran']) && ctype_digit($_GET['id_pelanggaran'])) ? $_GET['id_pelanggaran'] : 0;
        if (!$row) {
            echo json_encode(['status' => false, 'message' => 'NIM tidak ditemukan.']);
            exit;
        }

        // Get the form data
        $id_terlapor = $_POST['NIM'];
        $id_dpa = $row['id_dpa'];
        $id_tatib = $_POST['id_tatib'];
        $lampiran = $_FILES['lampiran'];
        $status = 'pending';

        // Debugging: Print the received data
        error_log("ID Pelapor: " . $id);
        error_log("ID Terlapor: " . $id_terlapor);
        error_log("ID DPA: " . $id_dpa);
        error_log("ID Tatib: " . $id_tatib);
        error_log("Lampiran: " . print_r($lampiran, true));
        error_log("Status: " . $status);

        // Perform necessary validations and file upload processing
        $target_dir = "../uploads/";
        $file_name = str_replace(' ', '_', basename($lampiran["name"]));
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($lampiran["tmp_name"], $target_file)) {
            // Insert data into the database
            $data = [
                'id_pelapor' => $id,
                'id_terlapor' => $id_terlapor,
                'id_dpa' => $id_dpa,
                'id_tatib' => $id_tatib,
                'lampiran' => $file_name,
                'status' => $status
            ];
            $pelanggaran = new PelanggaranModel();
            $pelanggaran->updateData($id_pelanggaran, $data);
            header ('Location: ../index.php');
        }
    } else {
        echo json_encode(['status' => false, 'message' => 'Form tidak lengkap.']);
    }
} elseif ($act == 'lapor') {
    // Ensure the necessary POST variables are set
    if (isset($_POST['NIM']) && isset($_POST['id_tatib']) && isset($_FILES['lampiran'])) {
        // Get the NIM details
        $row = $model->getDataByNim($_POST['NIM']);
        if (!$row) {
            echo json_encode(['status' => false, 'message' => 'NIM tidak ditemukan.']);
            exit;
        }

        // Get the form data
        $id_terlapor = $_POST['NIM'];
        $id_dpa = $row['id_dpa'];
        $id_tatib = $_POST['id_tatib'];
        $lampiran = $_FILES['lampiran'];
        $status = 'pending';

        // Debugging: Print the received data
        error_log("ID Pelapor: " . $id);
        error_log("ID Terlapor: " . $id_terlapor);
        error_log("ID DPA: " . $id_dpa);
        error_log("ID Tatib: " . $id_tatib);
        error_log("Lampiran: " . print_r($lampiran, true));

        // Perform necessary validations and file upload processing
        $target_dir = "../uploads/";
        $file_name = str_replace(' ', '_', basename($lampiran["name"]));
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($lampiran["tmp_name"], $target_file)) {
            // Insert data into the database
            $query = $db->prepare('INSERT INTO pelanggaran (id_pelapor, id_terlapor, id_dpa, id_tatib, lampiran, status) VALUES (?, ?, ?, ?, ?, ?)');
            $query->bind_param('ssssss', $id, $id_terlapor, $id_dpa, $id_tatib, $target_file, $status);

            if ($query->execute()) {
                echo json_encode(['status' => true, 'message' => 'Data berhasil disimpan!']);
                // Redirect to the home page or any other desired page
                header('Location: ../index.php');
            } else {
                error_log('Error executing query: ' . $query->error);
                echo json_encode(['status' => false, 'message' => 'Gagal menyimpan data.']);
            }
        }
    } else {
        echo json_encode(['status' => false, 'message' => 'Form tidak lengkap.']);
    }

} else if ($act == 'delete') {
    $id_pelanggaran = (isset($_GET['id_pelanggaran']) && ctype_digit($_GET['id_pelanggaran'])) ? $_GET['id_pelanggaran'] : 0;
    $pelanggaran = new PelanggaranModel();
    $pelanggaran->deleteData($id_pelanggaran);
    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
} else {
    echo json_encode(['status' => false, 'message' => 'Aksi tidak valid.']);
}
?>
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
}

if ($act == 'get') {
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

if ($act == 'lapor') {
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
    
    if ($_GET['act'] === 'delete') {
    include('lib/Connection.php');
    $id = $_POST['id'];

    // Debugging: Cetak ID
    error_log("ID diterima: " . $id);

    if (!empty($id)) {
        $query = $db->prepare("DELETE FROM pelanggaran WHERE id_pelanggaran = ?");
        $query->bind_param("i", $id);

        if ($query->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus data di database.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID tidak valid.']);
    }
    exit;
}

if ($act == 'delete') {
    // Pastikan request adalah POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idPelanggaran = intval($_POST['id_pelanggaran']); // Validasi ID Pelanggaran

        // Cek apakah ID Pelanggaran valid
        if ($idPelanggaran <= 0) {
            echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
            exit;
        }

        // Hapus data dari database
        $query = "DELETE FROM pelanggaran WHERE id_pelanggaran = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('i', $idPelanggaran);

        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal menghapus data']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Metode request tidak valid']);
    }
}
        
        $query->close();
    } else {
        echo json_encode(['status' => false, 'message' => 'Gagal mengunggah lampiran.']);
    }
} else {
    echo json_encode(['status' => false, 'message' => 'Aksi tidak valid.']);
}
?>
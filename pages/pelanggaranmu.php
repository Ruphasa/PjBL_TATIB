<?php
include_once('lib/Session.php');
if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

$session = new Session();
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pelanggaran</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Pelanggaran</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content" style="margin-bottom: 100px;">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Pelanggaran</h3>
            <!-- <div class="card-tools">
                    <button type="button" class="btn btn-md btn-primary" onclick="tambahData()">
                        Tambah
                    </button>
                </div> -->
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped" id="table-data">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Pelanggaran</th>
                        <th>ID Pelapor</th>
                        <th>ID Terlapor</th>
                        <th>ID DPA</th>
                        <th>ID Tatib</th>
                        <th>Sanksi</th>
                        <?php
                        if ($_SESSION['role'] == 'mahasiswa') {
                            echo "<th>Aksi</th>";
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($_SESSION['role'] == 'dosen') {
                        $query = "SELECT * FROM pelanggaran as p inner join tatib as t on p.id_tatib = t.id_tatib where id_dpa = '" . $_SESSION['id'] . "' and status = 'ongoing' or status = 'revisi'";
                        $result = $db->query($query);
                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$no}</td>";
                                echo "<td>{$row['id_pelanggaran']}</td>";
                                echo "<td>{$row['id_pelapor']}</td>";
                                echo "<td>{$row['id_terlapor']}</td>";
                                echo "<td>{$row['id_dpa']}</td>";
                                echo "<td>{$row['id_tatib']}</td>";
                                echo "<td>{$row['Sanksi']}</td>";
                                echo "</tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='9'>Tidak ada data.</td></tr>";
                        }
                    } else if ($_SESSION['role'] == 'mahasiswa') {
                        $query = "SELECT * FROM pelanggaran as p inner join tatib as t on p.id_tatib = t.id_tatib where id_terlapor = '" . $_SESSION['id'] . "' and status = 'ongoing' or status = 'revisi'";
                        $result = $db->query($query);
                        if ($result->num_rows > 0) {
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$no}</td>";
                                echo "<td>{$row['id_pelanggaran']}</td>";
                                echo "<td>{$row['id_pelapor']}</td>";
                                echo "<td>{$row['id_terlapor']}</td>";
                                echo "<td>{$row['id_dpa']}</td>";
                                echo "<td>{$row['id_tatib']}</td>";
                                echo "<td>{$row['Sanksi']}</td>";
                                if ($row['status'] == 'revisi') {
                                    echo "<td><button type='button' class='btn btn-md btn-danger' data-id='{$row['id_pelanggaran']}' 
                                            data-id_pelapor='{$row['id_pelapor']}' data-id_terlapor='{$row['id_terlapor']}' 
                                            data-id_dpa='{$row['id_dpa']}' data-id_tatib='{$row['id_tatib']}' 
                                            data-toggle='modal' data-target='#kirimModal' onclick='kerjakanData(this)'>
                                            revisi </button>
                                        <td>";
                                } else if ($row['status'] == 'ongoing') {
                                    echo "<td><button type='button' class='btn btn-md btn-primary' data-id='{$row['id_pelanggaran']}' 
                                            data-id_pelapor='{$row['id_pelapor']}' data-id_terlapor='{$row['id_terlapor']}' 
                                            data-id_dpa='{$row['id_dpa']}' data-id_tatib='{$row['id_tatib']}' 
                                            data-toggle='modal' data-target='#kirimModal' onclick='kerjakanData(this)'>
                                            Kerjakan </button>
                                        </td>";
                                }
                                echo "</tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='9'>Tidak ada data.</td></tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<div class="modal fade" id="kirimModal" tabindex="-1" role="dialog" aria-labelledby="kirimModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kirimModalLabel">Bukti Pengerjaan Sanksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="kirim-form" action="action/userAction.php?act=kirim&id_pelanggaran=" method="post"
                    enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="kirim-lampiran">Lampiran</label>
                        <input type="file" class="form-control-file" id="kirim-lampiran" name="lampiran" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function tambahData() {
        alert('Form tambah data dapat diimplementasikan di sini.');
    }

    $(document).ready(function () {
        $('#table-data').DataTable();
    });

    function kerjakanData(button) {
            // Retrieve data from the button attributes
            const id = button.getAttribute('data-id');
            const idPelapor = button.getAttribute('data-id_pelapor');
            const idTerlapor = button.getAttribute('data-id_terlapor');
            const idDpa = button.getAttribute('data-id_dpa');
            const idTatib = button.getAttribute('data-id_tatib');

            // Populate the modal input fields with the corresponding values
            document.getElementById('kirim-form').setAttribute('action', 'action/userAction.php?act=kirim&id_pelanggaran=' + id);

            // Open the modal
            $('#kirimModal').modal('show');

            // Optional: If you want to populate any hidden fields or other elements, you can do it here
            // Example: document.getElementById('hidden-id-pelapor').value = idPelapor;
            // Example: document.getElementById('hidden-id-terlapor').value = idTerlapor;
            // Example: document.getElementById('hidden-id-dpa').value = idDpa;
        }
</script>
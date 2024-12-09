<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
</head>

<body>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Accept Min</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Pending</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" style="margin-bottom: 100px;">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> <?php
                if (isset($_SESSION['name'])) {
                    # code...
                    echo "Selamat Datang <b>" . $_SESSION['name'];
                }
                ?></h3>
            </div>
            <div class="card-body">
                <!-- /.Card Header -->
                <section class="content">
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
                                        <th>Lampiran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM pelanggaran as p inner join tatib as t on p.id_tatib = t.id_tatib where status = 'pending'";
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
                                            if (empty($row['lampiran'])) {
                                                # code...
                                                echo "<td>Tidak ada lampiran</td>";
                                            } else {
                                                echo "<td><img src= '" . $row['lampiran'] . "' style='height: 100px;'></td>";
                                            }
                                            echo "<td><button type='button' class='btn btn-md btn-primary' onclick='verifikasiData({$row['id_pelanggaran']})'>Verifikasi</button> <button type='button' class='btn btn-md btn-danger' onclick='tolakData({$row['id_pelanggaran']})'>Tolak</button></td>";
                                            echo "</tr>";
                                            $no++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>Tidak ada data.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
    </section>

    <script>
        function tambahData() {
            alert('Form tambah data dapat diimplementasikan di sini.');
        }

        function verifikasiData(id) {
            if (confirm('Apakah Anda yakin ingin memverifikasi data ini?')) {
                window.location.href = 'action/adminAction.php?act=verifikasi&id=' + id;
            }
        }

        function tolakData(id) {
            if (confirm('Apakah Anda yakin ingin menolak data ini?')) {
                window.location.href = 'action/adminAction.php?act=reject&id=' + id;
            }
        }

        $(document).ready(function () {
            $('#table-data').DataTable();
        });
    </script>
</body>

</html>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Admin</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Blank Page</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM pelanggaran as p inner join tatib as t on p.id_tatib = t.id_tatib where status = 'ongoing'";
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
                                echo "<tr><td colspan='7'>Tidak ada data.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</section>

<script>
$(document).ready(function () {
    $('#table-data').DataTable();
});
</script>
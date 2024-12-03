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
        </div>
        <section class="content">
            <div class="container-fluid">
                <!-- Card Wrapper -->
                <div class="card">
                    <!-- Card Header -->
                    <div class="card-header">
                        <h3 class="card-title">Data Pelanggar Prodi TI</h3>
                    </div>
                    <!-- /.Card Header -->

                    <!-- Card Body -->
                    <div class="card-body">
                        <!-- Tabel -->
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Pelapor</th>
                                    <th>Pelaku</th>
                                    <th>Pelanggaran</th>
                                    <th>Level</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Contoh data dummy (ganti dengan query database Anda)
                                $data = [
                                    ['tanggal' => '2024-01-01', 'pelapor' => 'John', 'pelaku' => 'Doe', 'pelanggaran' => 'Tidak Memakai Masker', 'level' => 'Sedang'],
                                    ['tanggal' => '2024-01-02', 'pelapor' => 'Jane', 'pelaku' => 'Smith', 'pelanggaran' => 'Merokok di Area Larangan', 'level' => 'Sedang'],
                                ];

                                foreach ($data as $index => $row) {
                                    echo "<tr>
                                <td>" . ($index + 1) . "</td>
                                <td>{$row['tanggal']}</td>
                                <td>{$row['pelapor']}</td>
                                <td>{$row['pelaku']}</td>
                                <td>{$row['pelanggaran']}</td>
                                <td>{$row['level']}</td>
                            </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.Card Body -->
                </div>
                <!-- /.Card Wrapper -->
            </div>
        </section>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
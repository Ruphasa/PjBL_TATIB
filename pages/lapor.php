<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Lapor</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Lapor</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Lapor</h3>
            </div>
            <div class="card-body">
                <section class=" content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form id="form-lapor" action="action/userAction.php" method="post"
                                        enctype="multipart/form-data">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="NIM">Nomor Induk</label>
                                                <input type="text" class="form-control" id="NIM" name="NIM"
                                                    placeholder="Enter NIM" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="nama">Nama</label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    placeholder="Enter Full Name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="id_tatib">Aturan yang dilanggar</label>
                                                <select class="form-control" id="id_tatib" name="id_tatib" required>
                                                    <option value="">Pilih Aturan</option>
                                                    <?php
                                                    $queryTatib = $db->prepare("SELECT * FROM tatib");
                                                    $queryTatib->execute();
                                                    $dataTatib = $queryTatib->get_result();
                                                    while ($row = $dataTatib->fetch_assoc()) {
                                                        echo "<option value='" . $row['id_tatib'] . "'>" . $row['aturan'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="lampiran">Lampiran</label>
                                                <input type="file" class="form-control" id="lampiran" name="lampiran">
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Lapor</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            $('#form-lapor').validate({
                rules: {
                    NIM: {
                        required: true,
                        digits: true,
                        minlength: 8,
                        maxlength: 15
                    },
                    nama: {
                        required: true,
                        minlength: 3
                    },
                    id_tatib: {
                        required: true,
                        min: 1
                    },
                    lampiran: {
                        required: true,
                        extension: "jpg|jpeg|png|pdf"
                    }
                },
                messages: {
                    NIM: {
                        required: "Nomor Induk wajib diisi.",
                        digits: "Nomor Induk harus berupa angka.",
                        minlength: "Nomor Induk minimal 8 karakter.",
                        maxlength: "Nomor Induk maksimal 15 karakter."
                    },
                    nama: {
                        required: "Nama wajib diisi.",
                        minlength: "Nama minimal 3 karakter."
                    },
                    id_tatib: {
                        required: "Silakan pilih aturan yang dilanggar.",
                        min: "Silakan pilih aturan yang valid."
                    },
                    lampiran: {
                        required: "Lampiran wajib diunggah.",
                        extension: "File harus berupa format jpg, jpeg, png, atau pdf."
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.mb-3').append(error);
                },
                highlight: function (element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function (form) {
                    // Kirim data dengan AJAX
                    $.ajax({
                        url: $(form).attr('action'),
                        method: 'POST',
                        data: new FormData(form),
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            const result = JSON.parse(response);
                            if (result.status) {
                                alert('Data berhasil disimpan!');
                                $(form)[0].reset(); // Reset form
                                window.location.href = 'pelanggaranmu.php'; // Redirect ke halaman pelanggaranmu.php
                            } else {
                                alert('Gagal menyimpan data: ' + result.message);
                            }
                        },

                        error: function () {
                            alert('Terjadi kesalahan saat mengirim data.');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
<?php
include_once('lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pelanggaran</title>
    <!-- Including jQuery and jQuery Validate -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <!-- form start -->
                                    <form id="form-lapor" action="action/userAction.php?act=lapor" method="post"
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
                                                    include('lib/Connection.php');
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
                                                <label for="lampiran">File input</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="lampiran"
                                                            name="lampiran" required>
                                                        <label class="custom-file-label" for="lampiran">Choose
                                                            file</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <button type="button" class="btn btn-primary"
                                                            data-toggle="modal"
                                                            data-target="#uploadModal">Upload</button>
                                                    </div>
                                                </div>
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

    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Upload File</h5> <button type="button" class="close"
                        data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body">
                    <div id="drop-zone" class="border border-primary p-4 text-center">
                        <p>Drag & drop file here or click to upload</p> <input type="file" id="file-input"
                            class="d-none">
                    </div>
                </div>
                <div class="modal-footer"> <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close</button> <button type="button" class="btn btn-primary"
                        id="upload-btn">Upload</button> </div>
            </div>
        </div>

        <script> document.addEventListener('DOMContentLoaded', function () {
                const dropZone = document.getElementById('drop-zone'); const fileInput = document.getElementById('file-input'); const fileDisplay = document.getElementById('file-display'); dropZone.addEventListener('click', function () { fileInput.click(); }); dropZone.addEventListener('dragover', function (e) { e.preventDefault(); dropZone.classList.add('bg-light'); }); dropZone.addEventListener('dragleave', function (e) { e.preventDefault(); dropZone.classList.remove('bg-light'); }); dropZone.addEventListener('drop', function (e) { e.preventDefault(); dropZone.classList.remove('bg-light'); const files = e.dataTransfer.files; handleFiles(files); }); fileInput.addEventListener('change', function (e) { const files = e.target.files; handleFiles(files); }); function handleFiles(files) {
                    if (files.length > 0) {
                        fileDisplay.value = files[0].name; fileInput.files = files;
                        // Ensure the file input has the files for form submission 
                        $('#uploadModal').modal('hide');
                    }
                }
                // Trigger form submit button click on modal upload button click 
                document.getElementById('upload-btn').addEventListener('click', function () {
                    if (fileInput.files.length > 0) {
                        // Manually trigger change event to update the form input 
                        fileInput.dispatchEvent(new Event('change'));
                    }
                });
            }); </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Custom file input label
                document.querySelector(".custom-file-input").addEventListener("change", function (e) {
                    var fileName = document.getElementById("lampiran").files[0].name;
                    var nextSibling = e.target.nextElementSibling
                    nextSibling.innerText = fileName
                });
            });
        </script>

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
                            required: "Silakan pilih aturan yang dilanggar."
                        },
                        lampiran: {
                            required: "Lampiran wajib diunggah.",
                            extension: "File harus berupa format jpg, jpeg, png, atau pdf."
                        }
                    },
                });

                // Custom file input label
                $(".custom-file-input").on("change", function () {
                    var fileName = $(this).val().split("\\").pop();
                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                });
            });
        </script>
</body>

</html>
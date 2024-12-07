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
            <div class="card-body"">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <!-- /.card-header -->
                                    <!-- form start -->
                                    <form>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email" class="form-control" id="exampleInputEmail1"
                                                    placeholder="Enter email">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password" class="form-control" id="exampleInputPassword1"
                                                    placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">File input</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose
                                                            file</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Upload</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Lapor</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            </form>
                        </div>
                    </div>
                </section>

                <script>
                    function tambahData() {
                        $('#form-data').modal('show');
                        $('#form-tambah').attr('action', 'action/bukuAction.php?act=save');
                        $('#kategori_id').val('');
                        $('#buku_kode').val('');
                        $('#buku_nama').val('');
                        $('#jumlah').val('');
                        $('#deskripsi').val('');
                        $('#gambar').val('');
                    }

                    var tabelData;
                    $(document).ready(function () {
                        tabelData = $('#table-data').DataTable({
                            ajax: 'action/bukuAction.php?act=load',
                        });

                        $('#form-tambah').validate({
                            rules: {
                                kategori_id: {
                                    required: true,
                                    minlength: 1
                                },
                                buku_kode: {
                                    required: true,
                                    minlength: 1
                                },
                                buku_nama: {
                                    required: true,
                                    minlength: 1
                                },
                                jumlah: {
                                    required: true,
                                    minlength: 1
                                },
                                deskripsi: {
                                    required: true,
                                    minlength: 10
                                },
                                gambar: {
                                    required: true,
                                    minlength: 10
                                }
                            },
                            errorElement: 'span',
                            errorPlacement: function (error, element) {
                                error.addClass('invalid-feedback');
                                element.closest('.form-group').append(error);
                            },
                            highlight: function (element, errorClass, validClass) {
                                $(element).addClass('is-invalid');
                            },
                            unhighlight: function (element, errorClass, validClass) {
                                $(element).removeClass('is-invalid');
                            },
                            submitHandler: function (form) {
                                $.ajax({
                                    url: $(form).attr('action'),
                                    method: 'post',
                                    data: $(form).serialize(),
                                    success: function (response) {
                                        var result = JSON.parse(response);
                                        if (result.status) {
                                            $('#form-data').modal('hide');
                                            tabelData.ajax.reload(); // reload data tabel 
                                        } else {
                                            alert(result.message);
                                        }
                                    }
                                });
                            }
                        });
                    }); 
                </script>
</body>

</html>
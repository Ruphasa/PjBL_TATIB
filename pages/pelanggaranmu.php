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
                    <h1>Buku</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Buku</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Buku</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-md btn-primary" onclick="tambahData()">
                        Tambah
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm table-bordered table-striped" id="table-data">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Kategori</th>
                            <th>Kode Buku</th>
                            <th>Judul</th>
                            <th>jumlah</th>
                            <th>deskripsi</th>
                            <th>gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="modal fade" id="form-data" style="display: none;" aria-hidden="true">
        <form action="action/bukuAction.php?act=save" method="post" id="form-tambah">
            <!--    Ukuran Modal  
                modal-sm : Modal ukuran kecil 
                modal-md : Modal ukuran sedang 
                modal-lg : Modal ukuran besar 
                modal-xl : Modal ukuran sangat besar 
            penerapan setelah class modal-dialog seperti di bawah 
    -->
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Buku</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>ID Kategori</label>
                            <input type="text" class="form-control" name="kategori_id" id="kategori_id">
                        </div>
                        <div class="form-group">
                            <label>Kode Buku</label>
                            <input type="text" class="form-control" name="buku_kode" id="buku_kode">
                        </div>
                        <div class="form-group">
                            <label>Judul</label>
                            <input type="text" class="form-control" name="buku_nama" id="buku_nama">
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="text" class="form-control" name="jumlah" id="jumlah">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" class="form-control" name="deskripsi" id="deskripsi">
                        </div>
                        <div class="form-group">
                            <label>Link Gambar</label>
                            <input type="text" class="form-control" name="gambar" id="gambar">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

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

        function editData(id) {
            $.ajax({
                url: 'action/bukuAction.php?act=get&id=' + id,
                method: 'post',
                success: function (response) {
                    var data = JSON.parse(response);
                    $('#form-data').modal('show');
                    $('#form-tambah').attr('action', 'action/bukuAction.php?act=update&id=' + id);
                    $('#kategori_id').val(data.kategori_id);
                    $('#buku_kode').val(data.buku_kode);
                    $('#buku_nama').val(data.buku_nama);
                    $('#jumlah').val(data.jumlah);
                    $('#deskripsi').val(data.deskripsi);
                    $('#gambar').val(data.gambar);
                }
            });
        }

        function deleteData(id) {
            if (confirm('Apakah anda yakin?')) {
                $.ajax({
                    url: 'action/bukuAction.php?act=delete&id=' + id,
                    method: 'post',
                    success: function (response) {
                        var result = JSON.parse(response);
                        if (result.status) {
                            tabelData.ajax.reload();
                        } else {
                            alert(result.message);
                        }
                    }
                });
            }
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
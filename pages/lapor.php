<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pelanggaran</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .report-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 500px;
        }

        .report-container h2 {
            margin-bottom: 20px;
        }

        .report-container input[type="text"],
        .report-container input[type="date"],
        .report-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        .report-container .btn-custom {
            background-color: #007bff;
            color: white;
        }

        .report-container .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="report-container">
        <h2>Laporan Pelanggaran Mahasiswa</h2>
        <form action="pelanggaranModel.php" method="post">
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Pelanggaran</label>
                <input type="date" id="tanggal" name="tanggal" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi Pelanggaran</label>
                <textarea id="deskripsi" name="deskripsi" class="form-control" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-custom btn-block">Laporkan</button>
        </form>
    </div>
</body>

</html>
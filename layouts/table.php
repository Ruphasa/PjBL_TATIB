<!DOCTYPE html>
<html lang="en">
?<?php

$conn = new Connection();
$db = $conn->connect();

// Query untuk mengambil data dari tabel pelanggaran
$query = "SELECT * FROM pelanggaran"; // Sesuaikan nama tabel dan kolom sesuai struktur database Anda
$result = $db->query($query);

// Array untuk menyimpan data
$data = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    </html><table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Pelapor</th>
                    <th>Pelaku</th>
                    <th>Pelanggaran</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $index => $row): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= $row['tanggal']; ?></td>
                    <td><?= $row['pelapor']; ?></td>
                    <td><?= $row['pelaku']; ?></td>
                    <td><?= $row['pelanggaran']; ?></td>
                    <td><?= $row['level']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    
</body>
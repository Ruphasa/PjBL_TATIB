-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Des 2024 pada 02.16
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pjbl`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `password`) VALUES
('A001', 'Putri', 'admin1'),
('A002', 'Sinta', 'admin2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `NIP` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`NIP`, `nama`, `password`, `kelas`) VALUES
('12345678', 'Dr. Sudirman', 'dosen1', '2B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` varchar(10) NOT NULL,
  `id_prodi` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_prodi`) VALUES
('3A', 'SIB01'),
('2B', 'TI01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NIM` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`NIM`, `nama`, `password`, `kelas`) VALUES
('2341720202', 'Ericha Rizki Wardani', 'ericha123', '2B'),
('2341720224', 'Natasha Wilona', 'natasha224', '3A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `id_pelanggaran` varchar(10) NOT NULL,
  `id_pelapor` varchar(20) NOT NULL,
  `id_terlapor` varchar(20) NOT NULL,
  `id_dpa` varchar(20) NOT NULL,
  `id_tatib` int(11) NOT NULL,
  `sanksi` varchar(255) NOT NULL,
  `lampiran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggaran`
--

INSERT INTO `pelanggaran` (`id_pelanggaran`, `id_pelapor`, `id_terlapor`, `id_dpa`, `id_tatib`, `sanksi`, `lampiran`) VALUES
('P001', 'PL001', '2341720202', '12345678', 1, 'Kompen 1 minggu', 'Laporan.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` varchar(5) NOT NULL,
  `id_jurusan` int(10) NOT NULL,
  `nama_prodi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `id_jurusan`, `nama_prodi`) VALUES
('SIB01', 23417, 'SIB'),
('TI01', 41720, 'Teknik Informatika');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tatib`
--

CREATE TABLE `tatib` (
  `id_tatib` int(11) NOT NULL,
  `aturan` varchar(100) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tatib`
--

INSERT INTO `tatib` (`id_tatib`, `aturan`, `level`) VALUES
(1, 'Merusak fasilitas kampus', 3),
(2, 'Merokok di kelas', 2),
(3, 'Mahasiswa Iaki-laki berambut tidak rapi, gondrong yaitu \r\npanjang rambutnya melewati batas alis mata', 4),
(4, 'Mahasiswa berambut dengan model punk, dicat selain hitam \r\ndan/atau skinned', 4),
(5, 'Makan, atau minum di dalam ruang kuliah / laboratorium / \r\nbengkel', 4),
(6, 'Melanggar peraturan / ketentuan yang berlaku di Polinema baik \r\ndiJurusan / Program Studi', 3),
(7, 'Tidak menjaga kebersihan di seluruh area Polinema', 3),
(8, 'Membuat kegaduhan yang mengganggu pelaksanaan \r\nperkuliahan atau praktikum yang sedang berlangsung', 3),
(9, 'Merokok di luar area kawasan merokok', 3),
(10, 'Bermain kartu, game online di area kampus', 3),
(11, 'Mengotori atau mencoret-coret meja, kursi, tembok, dan lain-lain di \r\nlingkungan Polinema', 3),
(12, 'Bertingkah laku kasar atau tidak sopan kepada mahasiswa, dosen, \r\ndan/atau karyawan', 3),
(13, 'Merusak sarana dan prasarana yang ada di area Polinema', 2),
(14, 'Tidak menjaga ketertiban dan keamanan di seluruh area Polinema \r\n(misalnya: parkir tidak pada tempat', 2),
(15, 'Melakukan pengotoran/ pengrusakan barang milik orang lain \r\ntermasuk milik Politeknik Negeri Malang ', 2),
(16, 'Mengakses materi pornografi di kelas atau area kampus', 2),
(17, 'Membawa dan/atau menggunakan senjata tajam dan/atau senjata \r\napi untuk hal kriminal', 2),
(18, 'Melakukan perkelahian, serta membentuk geng/ kelompok yang \r\nbertujuan negatif', 2),
(19, 'Melakukan kegiatan politik praktis di dalam kampus', 2),
(20, 'Melakukan tindakan kekerasan atau perkelahian di dalam kampus', 2),
(21, 'Melakukan penyalahgunaan identitas untuk perbuatan negatif', 2),
(22, 'Mengancam, baik tertulis atau tidak tertulis kepada mahasiswa, \r\ndosen, dan/atau karyawan', 2),
(23, 'Mencuri dalam bentuk apapun', 2),
(24, 'Melakukan kecurangan dalam bidang akademik, administratif, dan \r\nkeuangan', 2),
(25, 'Melakukan pemerasan dan/atau penipuan', 2),
(26, 'Melakukan pelecehan dan/atau tindakan asusila dalam segala \r\nbentuk di dalam dan di luar kampus', 2),
(27, 'Berjudi, mengkonsumsi minum-minuman keras, dan/atau \r\nbermabuk-mabukan di lingkungan dan di luar lin', 2),
(28, 'Mengikuti organisasi dan atau menyebarkan faham-faham yang \r\ndilarang oleh Pemerintah', 1),
(29, 'Melakukan pemalsuan data / dokumen / tanda tangan', 1),
(30, 'Melakukan plagiasi (copy paste) dalam tugas-tugas atau karya ilmiah', 1),
(31, 'Tidak menjaga nama baik Polinema di masyarakat dan/ atau \r\nmencemarkan nama baik Polinema melalui me', 1),
(32, 'Melakukan kegiatan atau sejenisnya yang dapat menurunkan \r\nkehormatan atau martabat Negara, Bangsa d', 1),
(33, 'Menggunakan barang-barang psikotropika dan/ atau zat-zat Adiktif \r\nlainnya', 1),
(34, 'Mengedarkan serta menjual barang-barang psikotropika dan / atau \r\nzat-zat Adiktif lainnya', 1),
(35, 'Terlibat dalam tindakan kriminal dan dinyatakan bersalah oleh \r\nPengadilan', 1),
(123, 'Berkomunikasi dengan tidak sopan, baik tertulis atau tidak \r\ntertulis kepada mahasiswa, dosen, karya', 5),
(321, 'Berbusana tidak sopan dan tidak rapi. Yaitu antara lain adalah: \r\nberpakaian ketat, transparan, mema', 4);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`NIP`),
  ADD KEY `kelas` (`kelas`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indeks untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NIM`),
  ADD KEY `kelas` (`kelas`);

--
-- Indeks untuk tabel `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`id_pelanggaran`),
  ADD KEY `id_tatib` (`id_tatib`),
  ADD KEY `id_dpa` (`id_dpa`),
  ADD KEY `id_terlapor` (`id_terlapor`);

--
-- Indeks untuk tabel `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`),
  ADD KEY `id_jurusan` (`id_jurusan`);

--
-- Indeks untuk tabel `tatib`
--
ALTER TABLE `tatib`
  ADD PRIMARY KEY (`id_tatib`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tatib`
--
ALTER TABLE `tatib`
  MODIFY `id_tatib` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`);

--
-- Ketidakleluasaan untuk tabel `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Ketidakleluasaan untuk tabel `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD CONSTRAINT `pelanggaran_ibfk_1` FOREIGN KEY (`id_dpa`) REFERENCES `dosen` (`NIP`),
  ADD CONSTRAINT `pelanggaran_ibfk_2` FOREIGN KEY (`id_terlapor`) REFERENCES `mahasiswa` (`NIM`),
  ADD CONSTRAINT `pelanggaran_ibfk_3` FOREIGN KEY (`id_tatib`) REFERENCES `tatib` (`id_tatib`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

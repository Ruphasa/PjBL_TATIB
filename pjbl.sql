-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 12:44 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `password`) VALUES
('A001', 'Putri', 'admin1'),
('A002', 'Sinta', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `NIP` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`NIP`, `nama`, `password`, `kelas`) VALUES
('198005142005022001', 'Triana Fatmawati', '12345', 'TI2B'),
('198610022019032011', 'Elok Nur Hamdana, S.T., M.T.', '54321', 'SIB3A');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` varchar(10) NOT NULL,
  `id_prodi` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `id_prodi`) VALUES
('SIB3A', 'SIB01'),
('TI2B', 'TI01');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `NIM` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `kelas` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`NIM`, `nama`, `password`, `kelas`) VALUES
('2341720134', 'Ahmad Rifqi Hendriansyah', 'itsqii', 'TI2B'),
('2341720143', 'Rizqi Fauzan', 'rizqi2005', 'TI2B');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `id_pelanggaran` int(10) NOT NULL,
  `id_pelapor` varchar(20) NOT NULL,
  `id_terlapor` varchar(20) NOT NULL,
  `id_dpa` varchar(20) NOT NULL,
  `id_tatib` int(11) NOT NULL,
  `lampiran` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggaran`
--

INSERT INTO `pelanggaran` (`id_pelanggaran`, `id_pelapor`, `id_terlapor`, `id_dpa`, `id_tatib`, `lampiran`, `status`) VALUES
(1, '2341720134', '2341720143', '198005142005022001', 3, '', ''),
(4, '2341720143', '2341720134', '198005142005022001', 5, 'uploads/KTMRifqi.jpg', 'done'),
(5, '2341720143', '2341720134', '198005142005022001', 7, 'uploads/KTMRifqi.jpg', 'done'),
(15, '2341720134', '2341720143', '198005142005022001', 1, 'upload/KTM_Rizqi.jpg', 'ongoing'),
(16, '2341720134', '2341720143', '198005142005022001', 12, 'uploads/Fin_whale.jpeg', 'hold'),
(17, '2341720143', '2341720134', '198005142005022001', 10, 'uploads/KTM_Aryo.png', 'pending'),
(18, '2341720143', '2341720134', '198005142005022001', 7, 'uploads/52-hz.jpeg', 'done');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` varchar(5) NOT NULL,
  `nama_prodi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id_prodi`, `nama_prodi`) VALUES
('SIB01', 'SIB'),
('TI01', 'Teknik Informatika');

-- --------------------------------------------------------

--
-- Table structure for table `tatib`
--

CREATE TABLE `tatib` (
  `id_tatib` int(11) NOT NULL,
  `aturan` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  `Sanksi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tatib`
--

INSERT INTO `tatib` (`id_tatib`, `aturan`, `level`, `Sanksi`) VALUES
(1, 'Merusak fasilitas kampus', 3, 'Membuat surat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi \r\nmaterai ditandatangani mahasiswa, orang tua/wali, dan DPA dan Melakukan tugas khusus. '),
(2, 'Merokok di kelas', 2, 'Dikenakan penggantian kerugian atau penggantian benda/ barang \r\nsemacamnya dan/atau Melakukan tugas '),
(3, 'Mahasiswa Iaki-laki berambut tidak rapi, gondrong yaitu \r\npanjang rambutnya melewati batas alis mata', 4, 'Teguran tertulis disertai dengan pemanggilan orang tua/wali dan membuat \r\nsurat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi materai, \r\nditandatangani mahasiswa, orang tua/wali, dan DPA'),
(4, 'Mahasiswa berambut dengan model punk, dicat selain hitam \r\ndan/atau skinned', 4, 'Teguran tertulis disertai dengan pemanggilan orang tua/wali dan membuat \r\nsurat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi materai, \r\nditandatangani mahasiswa, orang tua/wali, dan DPA'),
(5, 'Makan, atau minum di dalam ruang kuliah / laboratorium / \r\nbengkel', 4, 'Teguran tertulis disertai dengan pemanggilan orang tua/wali dan membuat \r\nsurat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi materai, \r\nditandatangani mahasiswa, orang tua/wali, dan DPA'),
(6, 'Melanggar peraturan / ketentuan yang berlaku di Polinema baik \r\ndiJurusan / Program Studi', 3, 'Membuat surat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi \r\nmaterai ditandatangani mahasiswa, orang tua/wali, dan DPA dan Melakukan tugas khusus. '),
(7, 'Tidak menjaga kebersihan di seluruh area Polinema', 3, 'Membuat surat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi \r\nmaterai ditandatangani mahasiswa, orang tua/wali, dan DPA dan Melakukan tugas khusus. '),
(8, 'Membuat kegaduhan yang mengganggu pelaksanaan \r\nperkuliahan atau praktikum yang sedang berlangsung', 3, 'Membuat surat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi \r\nmaterai ditandatangani mahasiswa, orang tua/wali, dan DPA dan Melakukan tugas khusus. '),
(9, 'Merokok di luar area kawasan merokok', 3, 'Membuat surat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi \r\nmaterai ditandatangani mahasiswa, orang tua/wali, dan DPA dan Melakukan tugas khusus. '),
(10, 'Bermain kartu, game online di area kampus', 3, 'Membuat surat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi \r\nmaterai ditandatangani mahasiswa, orang tua/wali, dan DPA dan Melakukan tugas khusus. '),
(11, 'Mengotori atau mencoret-coret meja, kursi, tembok, dan lain-lain di \r\nlingkungan Polinema', 3, 'Membuat surat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi \r\nmaterai ditandatangani mahasiswa, orang tua/wali, dan DPA dan Melakukan tugas khusus. '),
(12, 'Bertingkah laku kasar atau tidak sopan kepada mahasiswa, dosen, \r\ndan/atau karyawan', 3, 'Membuat surat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi \r\nmaterai ditandatangani mahasiswa, orang tua/wali, dan DPA dan Melakukan tugas khusus. '),
(13, 'Merusak sarana dan prasarana yang ada di area Polinema', 2, 'Dikenakan penggantian kerugian atau penggantian benda/ barang \r\nsemacamnya dan/atau Melakukan tugas '),
(14, 'Tidak menjaga ketertiban dan keamanan di seluruh area Polinema \r\n(misalnya: parkir tidak pada tempat', 2, 'Dikenakan penggantian kerugian atau penggantian benda/ barang \r\nsemacamnya dan/atau Melakukan tugas '),
(15, 'Melakukan pengotoran/ pengrusakan barang milik orang lain \r\ntermasuk milik Politeknik Negeri Malang ', 2, 'Dikenakan penggantian kerugian atau penggantian benda/ barang \r\nsemacamnya dan/atau Melakukan tugas '),
(16, 'Mengakses materi pornografi di kelas atau area kampus', 2, 'Dikenakan penggantian kerugian atau penggantian benda/ barang \r\nsemacamnya dan/atau Melakukan tugas '),
(17, 'Membawa dan/atau menggunakan senjata tajam dan/atau senjata \r\napi untuk hal kriminal', 2, 'Dikenakan penggantian kerugian atau penggantian benda/ barang \r\nsemacamnya dan/atau Melakukan tugas '),
(18, 'Melakukan perkelahian, serta membentuk geng/ kelompok yang \r\nbertujuan negatif', 2, 'Dikenakan penggantian kerugian atau penggantian benda/ barang \r\nsemacamnya dan/atau Melakukan tugas '),
(19, 'Melakukan kegiatan politik praktis di dalam kampus', 2, 'Dikenakan penggantian kerugian atau penggantian benda/ barang \r\nsemacamnya dan/atau Melakukan tugas '),
(20, 'Melakukan tindakan kekerasan atau perkelahian di dalam kampus', 2, 'Dikenakan penggantian kerugian atau penggantian benda/ barang \r\nsemacamnya dan/atau Melakukan tugas '),
(21, 'Melakukan penyalahgunaan identitas untuk perbuatan negatif', 2, 'Dikenakan penggantian kerugian atau penggantian benda/ barang \r\nsemacamnya dan/atau Melakukan tugas '),
(22, 'Mengancam, baik tertulis atau tidak tertulis kepada mahasiswa, \r\ndosen, dan/atau karyawan', 2, 'Dikenakan penggantian kerugian atau penggantian benda/ barang \r\nsemacamnya dan/atau Melakukan tugas '),
(23, 'Mencuri dalam bentuk apapun', 2, 'Dikenakan penggantian kerugian atau penggantian benda/ barang \r\nsemacamnya dan/atau Melakukan tugas '),
(24, 'Melakukan kecurangan dalam bidang akademik, administratif, dan \r\nkeuangan', 2, 'Dikenakan penggantian kerugian atau penggantian benda/ barang \r\nsemacamnya dan/atau Melakukan tugas '),
(25, 'Melakukan pemerasan dan/atau penipuan', 2, 'Dikenakan penggantian kerugian atau penggantian benda/ barang \r\nsemacamnya dan/atau Melakukan tugas '),
(26, 'Melakukan pelecehan dan/atau tindakan asusila dalam segala \r\nbentuk di dalam dan di luar kampus', 2, ''),
(27, 'Berjudi, mengkonsumsi minum-minuman keras, dan/atau \r\nbermabuk-mabukan di lingkungan dan di luar lin', 2, ''),
(28, 'Mengikuti organisasi dan atau menyebarkan faham-faham yang \r\ndilarang oleh Pemerintah', 1, ''),
(29, 'Melakukan pemalsuan data / dokumen / tanda tangan', 1, ''),
(30, 'Melakukan plagiasi (copy paste) dalam tugas-tugas atau karya ilmiah', 1, ''),
(31, 'Tidak menjaga nama baik Polinema di masyarakat dan/ atau \r\nmencemarkan nama baik Polinema melalui me', 1, ''),
(32, 'Melakukan kegiatan atau sejenisnya yang dapat menurunkan \r\nkehormatan atau martabat Negara, Bangsa d', 1, ''),
(33, 'Menggunakan barang-barang psikotropika dan/ atau zat-zat Adiktif \r\nlainnya', 1, ''),
(34, 'Mengedarkan serta menjual barang-barang psikotropika dan / atau \r\nzat-zat Adiktif lainnya', 1, ''),
(35, 'Terlibat dalam tindakan kriminal dan dinyatakan bersalah oleh \r\nPengadilan', 1, ''),
(123, 'Berkomunikasi dengan tidak sopan, baik tertulis atau tidak \r\ntertulis kepada mahasiswa, dosen, karya', 5, ''),
(321, 'Berbusana tidak sopan dan tidak rapi. Yaitu antara lain adalah: \r\nberpakaian ketat, transparan, mema', 4, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`NIP`),
  ADD KEY `kelas` (`kelas`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`NIM`),
  ADD KEY `kelas` (`kelas`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`id_pelanggaran`),
  ADD KEY `id_tatib` (`id_tatib`),
  ADD KEY `id_dpa` (`id_dpa`),
  ADD KEY `id_terlapor` (`id_terlapor`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indexes for table `tatib`
--
ALTER TABLE `tatib`
  ADD PRIMARY KEY (`id_tatib`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `id_pelanggaran` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tatib`
--
ALTER TABLE `tatib`
  MODIFY `id_tatib` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=322;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`);

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD CONSTRAINT `pelanggaran_ibfk_1` FOREIGN KEY (`id_dpa`) REFERENCES `dosen` (`NIP`),
  ADD CONSTRAINT `pelanggaran_ibfk_2` FOREIGN KEY (`id_terlapor`) REFERENCES `mahasiswa` (`NIM`),
  ADD CONSTRAINT `pelanggaran_ibfk_3` FOREIGN KEY (`id_tatib`) REFERENCES `tatib` (`id_tatib`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

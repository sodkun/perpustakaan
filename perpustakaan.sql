-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 12, 2021 at 03:42 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nama_anggota` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `alamat_anggota` tinytext DEFAULT NULL,
  `telp_anggota` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nama_anggota`, `jenis_kelamin`, `status`, `alamat_anggota`, `telp_anggota`) VALUES
(1, 'Achmat Sodikkun', 'L', 'Mahasiswa', 'Pekalongan', '02153650110'),
(2, 'Istiqomah', 'P', 'Mahasiswa', 'Pati', '086744279011'),
(3, 'Iqbhal Abdillah', 'L', 'Mahasiswa', 'Kendal', '081652411821'),
(4, 'Ilmaya', 'P', 'Mahasiswa', 'Kalimantan', '087231179011'),
(6, 'Bambang', 'L', 'Masyarakat Umum', 'Mana', '08150021045'),
(7, 'Aku', 'L', 'Mahasiswa', 'Bali', '08657689123'),
(8, 'Juli', 'P', 'Mahasiswa', 'Batang', '08273862736');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `tahun_terbit` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `isbn` varchar(45) DEFAULT NULL,
  `pengarang_id` int(11) NOT NULL,
  `penerbit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `tahun_terbit`, `jumlah`, `isbn`, `pengarang_id`, `penerbit_id`) VALUES
(1, 'Laskar Pelangi', 2005, 8, '9783446242890', 2, 3),
(6, 'Kamu', 2020, 7, '84972364727980', 2, 1),
(7, 'Dia', 2019, 8, '92309126263', 4, 3),
(9, 'Tawa', 2010, 8, '239821839', 4, 1),
(10, 'Hebat', 2018, 2, '9127391709', 4, 2),
(11, 'Sebuah Seni Bersikap Bodoamat', 2010, 5, '92309126263', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `anggota_id` int(11) NOT NULL,
  `petugas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `tanggal_pinjam`, `tanggal_kembali`, `anggota_id`, `petugas_id`) VALUES
(1, '2021-11-15', '2021-11-22', 1, 1),
(2, '2021-12-01', '2021-12-08', 6, 2),
(9, '2021-12-02', '2021-12-10', 1, 2),
(10, '2021-11-02', '2021-11-09', 3, 1),
(11, '2021-11-02', '2021-11-15', 4, 2),
(12, '2021-12-01', '2021-12-08', 3, 1),
(13, '2021-12-01', '2021-12-08', 2, 1),
(14, '2021-12-04', '2021-12-11', 4, 1),
(15, '2021-12-04', '2021-12-11', 6, 1),
(16, '2021-12-04', '2021-12-11', 6, 1),
(17, '2021-11-25', '2021-12-02', 2, 1),
(18, '2021-12-12', '2021-12-19', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_detail`
--

CREATE TABLE `peminjaman_detail` (
  `peminjaman_id` int(11) NOT NULL,
  `buku_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `peminjaman_detail`
--

INSERT INTO `peminjaman_detail` (`peminjaman_id`, `buku_id`) VALUES
(1, 1),
(10, 9),
(13, 9),
(14, 1),
(15, 9),
(16, 9),
(17, 7),
(18, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `nama_penerbit` varchar(100) DEFAULT NULL,
  `alamat_penerbit` tinytext DEFAULT NULL,
  `telp_penerbit` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `alamat_penerbit`, `telp_penerbit`) VALUES
(1, 'Republika', 'Jagakarsa,Jakarta Selatan.', '021781912728'),
(2, 'Erlangga', 'Ciracas, Jakarta Timur.', '0218717006'),
(3, 'Gramedia Sindo', 'Tanah abang,Jakarta Selatan', '081847189279');

-- --------------------------------------------------------

--
-- Table structure for table `pengarang`
--

CREATE TABLE `pengarang` (
  `id_pengarang` int(11) NOT NULL,
  `nama_pengarang` varchar(100) DEFAULT NULL,
  `alamat_pengarang` tinytext DEFAULT NULL,
  `telp_pengarang` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pengarang`
--

INSERT INTO `pengarang` (`id_pengarang`, `nama_pengarang`, `alamat_pengarang`, `telp_pengarang`) VALUES
(1, 'Tere Liye', 'Kampung Baru, Jakarta.', '02153650110'),
(2, 'Andrea Hirata', 'Kota Lama, Semarang', '086744279011'),
(4, 'Sodikkunn', 'Bali', '08316252653');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `tanggal_pengembalian` date DEFAULT NULL,
  `denda` int(11) DEFAULT NULL,
  `peminjaman_id` int(11) NOT NULL,
  `anggota_id` int(11) NOT NULL,
  `petugas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `tanggal_pengembalian`, `denda`, `peminjaman_id`, `anggota_id`, `petugas_id`) VALUES
(1, '2021-11-21', 0, 1, 1, 1),
(2, '2021-11-17', 1000, 10, 3, 1),
(5, '2021-12-12', 500, 14, 4, 1),
(6, '2021-12-07', 2500, 17, 2, 1),
(8, '2021-12-12', 500, 16, 6, 1),
(9, '2021-12-12', 13500, 10, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian_detail`
--

CREATE TABLE `pengembalian_detail` (
  `pengembalian_id` int(11) NOT NULL,
  `buku_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pengembalian_detail`
--

INSERT INTO `pengembalian_detail` (`pengembalian_id`, `buku_id`) VALUES
(1, 1),
(2, 9),
(5, 1),
(6, 7),
(8, 9);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `nama_petugas` varchar(100) DEFAULT NULL,
  `telp_petugas` varchar(12) DEFAULT NULL,
  `alamat_petugas` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `username`, `password`, `nama_petugas`, `telp_petugas`, `alamat_petugas`) VALUES
(1, 'Kun', '12345', 'Achmat Sodikkun', '08150021000', 'Pekalongan'),
(2, 'admin', 'admin', 'Omesh', '085210001500', 'Semarang');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `fk_buku_pengarang1_idx` (`pengarang_id`),
  ADD KEY `fk_buku_penerbit1_idx` (`penerbit_id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `fk_peminjaman_anggota1_idx` (`anggota_id`),
  ADD KEY `fk_peminjaman_petugas1_idx` (`petugas_id`);

--
-- Indexes for table `peminjaman_detail`
--
ALTER TABLE `peminjaman_detail`
  ADD PRIMARY KEY (`peminjaman_id`,`buku_id`),
  ADD KEY `fk_peminjaman_has_buku_buku1_idx` (`buku_id`),
  ADD KEY `fk_peminjaman_has_buku_peminjaman_idx` (`peminjaman_id`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`);

--
-- Indexes for table `pengarang`
--
ALTER TABLE `pengarang`
  ADD PRIMARY KEY (`id_pengarang`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `fk_pengembalian_peminjaman1_idx` (`peminjaman_id`),
  ADD KEY `fk_pengembalian_anggota1_idx` (`anggota_id`),
  ADD KEY `fk_pengembalian_petugas1_idx` (`petugas_id`);

--
-- Indexes for table `pengembalian_detail`
--
ALTER TABLE `pengembalian_detail`
  ADD PRIMARY KEY (`pengembalian_id`,`buku_id`),
  ADD KEY `fk_pengembalian_has_buku_buku1_idx` (`buku_id`),
  ADD KEY `fk_pengembalian_has_buku_pengembalian1_idx` (`pengembalian_id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengarang`
--
ALTER TABLE `pengarang`
  MODIFY `id_pengarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `fk_buku_penerbit1` FOREIGN KEY (`penerbit_id`) REFERENCES `penerbit` (`id_penerbit`),
  ADD CONSTRAINT `fk_buku_pengarang1` FOREIGN KEY (`pengarang_id`) REFERENCES `pengarang` (`id_pengarang`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `fk_peminjaman_anggota1` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `fk_peminjaman_petugas1` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`);

--
-- Constraints for table `peminjaman_detail`
--
ALTER TABLE `peminjaman_detail`
  ADD CONSTRAINT `fk_peminjaman_has_buku_buku1` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `fk_peminjaman_has_buku_peminjaman` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id_peminjaman`);

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `fk_pengembalian_anggota1` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `fk_pengembalian_peminjaman1` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id_peminjaman`),
  ADD CONSTRAINT `fk_pengembalian_petugas1` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`);

--
-- Constraints for table `pengembalian_detail`
--
ALTER TABLE `pengembalian_detail`
  ADD CONSTRAINT `fk_pengembalian_has_buku_buku1` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `fk_pengembalian_has_buku_pengembalian1` FOREIGN KEY (`pengembalian_id`) REFERENCES `pengembalian` (`id_pengembalian`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

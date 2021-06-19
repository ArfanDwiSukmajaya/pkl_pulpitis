-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Bulan Mei 2021 pada 18.05
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pulpitis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama_lengkap`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator'),
('riri', '21232f297a57a5a743894a0e4a801fc3', 'Riri Fitria Geofani');

-- --------------------------------------------------------

--
-- Struktur dari tabel `basis_pengetahuan`
--

CREATE TABLE `basis_pengetahuan` (
  `kode_pengetahuan` int(11) NOT NULL,
  `kode_penyakit` int(11) NOT NULL,
  `kode_gejala` int(11) NOT NULL,
  `mb` double NOT NULL,
  `md` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `basis_pengetahuan`
--

INSERT INTO `basis_pengetahuan` (`kode_pengetahuan`, `kode_penyakit`, `kode_gejala`, `mb`, `md`) VALUES
(1, 1, 1, 0.6, 0.2),
(2, 1, 3, 0.8, 0.2),
(3, 1, 4, 1, 0),
(4, 1, 9, 0.4, 0.2),
(5, 1, 3, 1, 0),
(6, 2, 3, 0.8, 0.2),
(7, 2, 5, 0.6, 0.2),
(8, 2, 6, 1, 0),
(9, 2, 9, 0.4, 0.2),
(34, 3, 1, 0.6, 0.2),
(35, 3, 5, 0.6, 0.2),
(36, 3, 7, 1, 0),
(37, 3, 8, 1, 0),
(38, 3, 9, 0.4, 0.2),
(39, 3, 10, 1, 0),
(40, 3, 11, 1, 0),
(41, 3, 12, 0.8, 0.2),
(42, 3, 13, 0.8, 0.2),
(43, 3, 14, 0.6, 0.2),
(44, 4, 1, 0.6, 0.2),
(45, 4, 5, 0.6, 0.2),
(46, 4, 9, 0.4, 0.2),
(47, 4, 13, 0.8, 0.2),
(48, 4, 14, 0.6, 0.2),
(49, 5, 1, 0.6, 0.2),
(50, 5, 5, 0.6, 0.2),
(51, 5, 9, 0.4, 0.2),
(52, 5, 12, 0.8, 0.2),
(53, 5, 14, 0.6, 0.2),
(54, 5, 15, 1, 0),
(55, 5, 16, 1, 0),
(56, 5, 17, 1, 0),
(57, 5, 18, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `kode_gejala` int(11) NOT NULL,
  `nama_gejala` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`kode_gejala`, `nama_gejala`) VALUES
(1, 'Sakit Secara Spontan'),
(2, 'Tidak Ada Sakit Spontan'),
(3, 'Respon Linu Terhadap Suhu Dingin'),
(4, 'Respon Linu Terhadap Makanan Manis'),
(5, 'Sakit Tajam Karena Makanan dan Minuman Dingin'),
(6, 'Sakit Tajam Karena Udara Dingin'),
(7, 'Nyeri Lama'),
(8, 'Berdenyut'),
(9, 'Rasa Tidak Nyaman Pada Mulut'),
(10, 'Mengganggu Kenyamanan Tidur Malam'),
(11, 'Sakit Kepala'),
(12, 'Sakit Pelipis'),
(13, 'Sakit Saat Mengunyah'),
(14, 'Gigi Berlubang besar'),
(15, 'Demam'),
(16, 'Gusi Pernah Bengkak'),
(17, 'Bau Mulut'),
(18, 'Gigi berubah Warna Agak Kehitaman');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `umur` int(2) NOT NULL,
  `tanggal` varchar(50) NOT NULL DEFAULT '0',
  `penyakit` text NOT NULL,
  `gejala` text NOT NULL,
  `hasil_id` int(11) NOT NULL,
  `hasil_nilai` varchar(16) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `nama`, `jk`, `umur`, `tanggal`, `penyakit`, `gejala`, `hasil_id`, `hasil_nilai`) VALUES
(28, 'Anton Iqmal', 'Laki-Laki', 41, '2021-05-28 22:50:22', 'a:3:{i:3;s:7:\"0.87840\";i:5;s:7:\"0.81760\";i:4;s:7:\"0.24000\";}', 'a:5:{i:7;s:1:\"3\";i:8;s:1:\"3\";i:14;s:1:\"3\";i:15;s:1:\"4\";i:16;s:1:\"3\";}', 3, '0.87840'),
(27, 'Nanda', 'Laki-Laki', 24, '2021-05-28 22:48:28', 'a:3:{i:5;s:7:\"1.00000\";i:3;s:7:\"0.40000\";i:4;s:7:\"0.40000\";}', 'a:3:{i:14;s:1:\"1\";i:17;s:1:\"1\";i:18;s:1:\"1\";}', 5, '1.00000'),
(26, 'Arfan Dwi Sukmajaya', 'Laki-Laki', 21, '2021-05-28 22:46:14', 'a:2:{i:1;s:7:\"0.89760\";i:3;s:7:\"0.40000\";}', 'a:6:{i:2;s:1:\"4\";i:3;s:1:\"3\";i:4;s:1:\"3\";i:6;s:1:\"4\";i:7;s:1:\"5\";i:10;s:1:\"3\";}', 1, '0.89760'),
(25, 'Nanda Hady Mulya', 'Laki-Laki', 24, '2021-05-28 22:38:29', 'a:4:{i:1;s:7:\"1.00000\";i:3;s:7:\"0.52000\";i:4;s:7:\"0.52000\";i:5;s:7:\"0.52000\";}', 'a:5:{i:1;s:1:\"1\";i:2;s:1:\"5\";i:3;s:1:\"1\";i:4;s:1:\"1\";i:9;s:1:\"1\";}', 1, '1.00000');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kondisi`
--

CREATE TABLE `kondisi` (
  `id` int(11) NOT NULL,
  `kondisi` varchar(64) NOT NULL,
  `ket` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kondisi`
--

INSERT INTO `kondisi` (`id`, `kondisi`, `ket`) VALUES
(1, 'Pasti ya', ''),
(2, 'Hampir pasti ya', ''),
(3, 'Kemungkinan besar ya', ''),
(4, 'Mungkin ya', ''),
(5, 'Tidak tahu', ''),
(6, 'Mungkin tidak', ''),
(7, 'Kemungkinan besar tidak', ''),
(8, 'Hampir pasti tidak', ''),
(9, 'Pasti tidak', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyakit`
--

CREATE TABLE `penyakit` (
  `kode_penyakit` int(11) NOT NULL,
  `nama_penyakit` varchar(50) NOT NULL,
  `det_penyakit` varchar(500) NOT NULL,
  `srn_penyakit` varchar(500) NOT NULL,
  `gambar` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penyakit`
--

INSERT INTO `penyakit` (`kode_penyakit`, `nama_penyakit`, `det_penyakit`, `srn_penyakit`, `gambar`) VALUES
(1, 'Hiperemiae Pulpa', 'Penyebab adalah Bakteri pada gigi berlubang.', 'Lakukan perawatan ke dokter gigi, dengan membawa hasil diagnosa.', 'pulpitis.jpeg'),
(3, 'Pulpitis Reversibel', 'Bakteri pada gigi berlubang hampir mengenai pulpa.', 'Lakukan perawatan ke dokter gigi, dengan membawa hasil diagnosa.', 'pulpitis.jpeg'),
(4, 'Pulpitis Irreversibel', 'Bakteri pada gigi berlubang sudah menembus pulpa. ', 'Lakukan perawatan ke dokter gigi, dengan membawa hasil diagnosa.', 'pulpitis.jpeg'),
(5, 'Pulpitis Hiperplastik/Pulpa Polip', 'Iritasi pada pulpa oleh bakteri secara terus menerus hingga menimbulkan tumbuhnya jaringan seperti bisul didalam gigi.', 'Lakukan perawatan ke dokter gigi, dengan membawa hasil diagnosa.', 'pulpitis.jpeg'),
(6, 'Nekrose Pulpa', 'Sakit terhadap stimulus panas dan dingin, sakit spontan, sakit pelipis atau telinga, bau busuk, rasa tidak nyaman saaat makanan masuk ke mulut, gigi berubah warna dari abu-abu sampai agak kehitaman.', 'Lakukan perawatan ke dokter gigi, dengan membawa hasil diagnosa.', 'pulpitis.jpeg'),
(40, 'Nekrose Pulpa', 'Sakit terhadap stimulus panas dan dingin, sakit spontan, sakit pelipis atau telinga, bau busuk, rasa tidak nyaman saaat makanan masuk ke mulut, gigi berubah warna dari abu-abu sampai agak kehitaman.', 'Lakukan perawatan ke dokter gigi, dengan membawa hasil diagnosa.', 'pulpitis.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `post`
--

CREATE TABLE `post` (
  `kode_post` int(11) NOT NULL,
  `nama_post` varchar(50) NOT NULL,
  `det_post` varchar(15000) NOT NULL,
  `srn_post` varchar(15000) NOT NULL,
  `gambar` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `basis_pengetahuan`
--
ALTER TABLE `basis_pengetahuan`
  ADD PRIMARY KEY (`kode_pengetahuan`);

--
-- Indeks untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`kode_gejala`);

--
-- Indeks untuk tabel `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indeks untuk tabel `kondisi`
--
ALTER TABLE `kondisi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`kode_penyakit`);

--
-- Indeks untuk tabel `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`kode_post`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `basis_pengetahuan`
--
ALTER TABLE `basis_pengetahuan`
  MODIFY `kode_pengetahuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `gejala`
--
ALTER TABLE `gejala`
  MODIFY `kode_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `kondisi`
--
ALTER TABLE `kondisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `kode_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `post`
--
ALTER TABLE `post`
  MODIFY `kode_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

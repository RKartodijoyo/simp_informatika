-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02 Sep 2017 pada 06.16
-- Versi Server: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `praktikumelektro`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `ID_BERITA` int(255) UNSIGNED NOT NULL,
  `JUDUL_BERITA` varchar(50) DEFAULT NULL,
  `ISI_BERITA` text,
  `TANGGAL_BERITA` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`ID_BERITA`, `JUDUL_BERITA`, `ISI_BERITA`, `TANGGAL_BERITA`) VALUES
(1, 'Berita 1', 'Dosen memberikan nilai (melalui SIPTEU) setelah mahasiswa menyerahkan laporan praktikum yang dijilid rapi dan telah ditandatangani dosen. Selanjutnya mahasiswa menyerahkan buku laporan resmi dan print nilai praktikum kepada staf FT agar nilai praktikum dapat dientry ke SIM Akademik Ubhara.', '2016-12-29'),
(2, 'Berita 2', 'Meningkatkan kemampuan dan persaudaraan antar setiap mahasiswa di teknik informatika khususnya dalam satu kelompok belajar | Official Web http://iuc.web.id', '2016-12-30'),
(4, '77020a4d508aa728a2ca605cda1294e2', 'keren', NULL),
(5, 'dsafas', 'dsfaas', '2017-06-02'),
(6, 'Berita ke 7', 'Diberitahukan kepada tiap mahasiswa bahwa akan diadakan ujian ulang', '2017-06-02'),
(7, 'Mas Udin', 'DIberitahukan Kepada Teman teman Bahwa Saudara Udin telah menikah Lagi', '2017-06-09'),
(8, 'Mas Udin sakti', 'mas udin ternyata bisa tenaga dalam.', '2017-09-02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita1`
--

CREATE TABLE `berita1` (
  `ID_USER` int(11) UNSIGNED NOT NULL,
  `KATASANDI_USER` text NOT NULL,
  `EMAIL_USER` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `berita1`
--

INSERT INTO `berita1` (`ID_USER`, `KATASANDI_USER`, `EMAIL_USER`) VALUES
(1, 'cb9cc59854402e0ed651f00f6492dd8f', 'vienzz@ubhara.ac.id'),
(2, 'cb9cc59854402e0ed651f00f6492dd8f', 'user@gmail.com'),
(3, 'cb9cc59854402e0ed651f00f6492dd8f', 'rizalkartodijoyo@gmail.com'),
(4, 'cb9cc59854402e0ed651f00f6492dd8f', 'jagats.kolot@gmail.com'),
(5, 'cb9cc59854402e0ed651f00f6492dd8f', 'jagats.kolot@gmail.com'),
(6, 'cb9cc59854402e0ed651f00f6492dd8f', 'jagats.kolot@gmail.com'),
(7, 'a66014446d21496249f6e351d983a509', 'fdsafasf'),
(8, 'fece4ccf132cd5460d91ae1e41d3160a', 'sfdafasfas'),
(9, 'cb9cc59854402e0ed651f00f6492dd8f', 'dsafa@gmail.com'),
(10, 'd1bb70baa31f1df69628c00632b65eab', 'dasfsa@gmail.com'),
(11, '57a6a0811829faf34a78ca625c383ec9', 'dsaf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dospem`
--

CREATE TABLE `dospem` (
  `id` int(10) NOT NULL,
  `nim` int(15) NOT NULL,
  `nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dospem`
--

INSERT INTO `dospem` (`id`, `nim`, `nama`) VALUES
(1, 100250, 'Dr. ir. Prihastono ,MT'),
(2, 1100003, 'Ahmadi ST, MT'),
(3, 1111111, 'Richa Watiasih ,ST ,MT'),
(4, 111112, 'Hasti Afianti ,ST,MT');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hak`
--

CREATE TABLE `hak` (
  `id` int(1) NOT NULL,
  `hak` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `hak`
--

INSERT INTO `hak` (`id`, `hak`) VALUES
(1, 'Mahasiswa'),
(2, 'Dosen'),
(3, 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hakakses`
--

CREATE TABLE `hakakses` (
  `ID_HAKAKSES` int(1) NOT NULL,
  `NAMA_HAKAKSES` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hakakses`
--

INSERT INTO `hakakses` (`ID_HAKAKSES`, `NAMA_HAKAKSES`) VALUES
(1, 'Mahasiswa'),
(2, 'Dosen'),
(3, 'Administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(1) NOT NULL,
  `jurusan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id`, `jurusan`) VALUES
(1, 'Teknik Elektro'),
(2, 'Teknik Elektronika'),
(3, 'Teknik Sistem Tenaga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(4) NOT NULL,
  `nim` int(6) NOT NULL,
  `nama` text NOT NULL,
  `jurusan` int(4) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `nohp` text NOT NULL,
  `email` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `nim`, `nama`, `jurusan`, `alamat`, `nohp`, `email`) VALUES
(12, 1231314, 'rizaldi', 1, 'hahahah', '3123213', 'sdafljasdkjfklj'),
(11, 12043031, 'Rizaldi', 1, 'Jl. Ahmad Yani no 14b Timika Papua', '081282157520', 'rizaldikartodijoyo@gmail.'),
(13, 235266, 'fgdsgds', 1, 'fgdsg', '4334242', 'fdgdsg'),
(14, 235266, 'fgdsgds', 1, 'fgdsg', '4334242', 'fdgdsg'),
(15, 235266, 'fgdsgds', 1, 'fgdsg', '4334242', 'fdgdsg'),
(16, 54322, 'dfsfa', 1, 'fdsagsdag', '43532532', 'fdsgf'),
(17, 2147483647, 'fjhjkfh', 1, 'dfhasjkhasjkh', '2147483647', 'hkjsdhafjkhasjk'),
(18, 2147483647, 'fjhjkfh', 1, 'dfhasjkhasjkh', '2147483647', 'hkjsdhafjkhasjk'),
(19, 2147483647, 'fjhjkfh', 1, 'dfhasjkhasjkh', '2147483647', 'hkjsdhafjkhasjk'),
(20, 432234, 'ewrf', 1, 'wertrw', '231414', 'hlsjdhfjklhjksdf'),
(21, 5432234, 'ewrf', 1, 'wertrw', '231414', 'hlsjdhfjklhjksdf'),
(22, 1234567, 'rizaldi', 2, 'riadfjaljdkl', '2147483647', 'jkljlkdjaklf'),
(23, 12313, 'sdfaasd', 3, 'fdsadf', '12312', 'fdsafdasd@gmail.com'),
(24, 12313, 'sdfaasd', 3, 'fdsadf', '12312', 'fdsafdasd@gmail.com'),
(25, 11041056, 'Rizaldi', 0, '', '', ''),
(26, 11041055, 'Rizaldi', 0, '', '', ''),
(27, 1, 'fahreza', 1, 'jl ahmad yani no 14b', '081282157520', 'jagats.koot@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `praktikum`
--

CREATE TABLE `praktikum` (
  `id_praktikum` int(2) NOT NULL,
  `nama_praktikum` varchar(100) NOT NULL,
  `kode_praktikum` varchar(10) NOT NULL,
  `jurusan` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `praktikum`
--

INSERT INTO `praktikum` (`id_praktikum`, `nama_praktikum`, `kode_praktikum`, `jurusan`) VALUES
(1, 'Praktikum Dasar Komputer dan Pemrograman', '1231', 1),
(2, 'Praktikum Pengukuran Besaran Listrik', '2236', 1),
(3, 'Praktikum Rangkaian Elektronika', '2237', 1),
(4, 'Praktikum Elektronika Digital', '2234', 1),
(5, 'Praktikum Rangkaian Listrik', '3238', 1),
(6, 'Praktikum Sistem Kontrol', '4239', 1),
(7, 'Praktikum Dasar Konversi Tenaga Listrik', '4232', 1),
(8, 'Praktikum Elektronika Daya', '5233', 1),
(9, 'Praktikum Mikroprosessor', '5235', 1),
(10, 'Praktikum Sistem Tenaga Listrik', '7241', 3),
(11, 'Praktikum Sistem Pemrosessan Sinyal', '7240', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `praktikumku`
--

CREATE TABLE `praktikumku` (
  `id` int(10) NOT NULL,
  `nim` int(10) NOT NULL,
  `kode_praktikum` int(10) NOT NULL,
  `status_pembayaran` int(1) NOT NULL,
  `tanggal_praktek` date NOT NULL,
  `daftar_hadir` int(1) NOT NULL,
  `nama_dopem` int(2) NOT NULL,
  `bimbingan` int(1) NOT NULL,
  `tanggal_pengumpulan` date NOT NULL,
  `pengumpulan` int(1) NOT NULL,
  `nilai` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `praktikumku`
--

INSERT INTO `praktikumku` (`id`, `nim`, `kode_praktikum`, `status_pembayaran`, `tanggal_praktek`, `daftar_hadir`, `nama_dopem`, `bimbingan`, `tanggal_pengumpulan`, `pengumpulan`, `nilai`) VALUES
(22, 1, 9, 1, '2017-09-15', 0, 2, 0, '0000-00-00', 0, ''),
(23, 1, 10, 0, '0000-00-00', 0, 2, 0, '0000-00-00', 0, ''),
(24, 1, 3, 0, '0000-00-00', 0, 0, 0, '0000-00-00', 0, ''),
(25, 1, 11, 0, '0000-00-00', 0, 0, 0, '0000-00-00', 0, ''),
(28, 12043031, 1, 0, '0000-00-00', 0, 0, 0, '0000-00-00', 0, ''),
(29, 12043031, 3, 0, '0000-00-00', 0, 0, 0, '0000-00-00', 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id` int(1) NOT NULL,
  `nama_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id`, `nama_status`) VALUES
(1, 'Aktif'),
(2, 'Non Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `ID_USER` int(11) UNSIGNED NOT NULL,
  `NIM_USER` int(50) UNSIGNED NOT NULL,
  `NAMA_USER` varchar(50) NOT NULL,
  `KATASANDI_USER` text NOT NULL,
  `EMAIL_USER` text NOT NULL,
  `TGLDAFTAR_USER` datetime NOT NULL,
  `HAKAKSES_USER` int(11) NOT NULL,
  `STATUS_USER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`ID_USER`, `NIM_USER`, `NAMA_USER`, `KATASANDI_USER`, `EMAIL_USER`, `TGLDAFTAR_USER`, `HAKAKSES_USER`, `STATUS_USER`) VALUES
(1, 12043031, 'Rizaldi', 'c4ca4238a0b923820dcc509a6f75849b', 'vienzz@ubhara.ac.id', '2017-01-04 15:47:53', 1, 1),
(2, 12345678, 'user', 'cb9cc59854402e0ed651f00f6492dd8f', 'user@gmail.com', '2017-01-04 00:00:00', 2, 1),
(3, 11041055, '11041055', 'cb9cc59854402e0ed651f00f6492dd8f', 'rizalkartodijoyo@gmail.com', '2017-05-03 00:00:00', 3, 1),
(4, 1, 'kartodijoyo', 'cb9cc59854402e0ed651f00f6492dd8f', 'jagats.kolot@gmail.com', '2017-05-01 00:00:00', 1, 1),
(5, 2, 'kartodijoyo2', 'cb9cc59854402e0ed651f00f6492dd8f', 'jagats.kolot@gmail.com', '2017-05-01 00:00:00', 2, 1),
(6, 3, 'kartodijoyo3', 'cb9cc59854402e0ed651f00f6492dd8f', 'jagats.kolot@gmail.com', '2017-05-01 00:00:00', 3, 1),
(7, 11, 'sdfaas', 'a66014446d21496249f6e351d983a509', 'fdsafasf', '2017-06-09 00:00:00', 1, 1),
(8, 11041055, 'rizaldi', 'fece4ccf132cd5460d91ae1e41d3160a', 'sfdafasfas', '2017-06-08 00:00:00', 1, 2),
(9, 12313, 'sdfasfa', 'cb9cc59854402e0ed651f00f6492dd8f', 'dsafa@gmail.com', '2017-06-07 00:00:00', 1, 1),
(10, 1234, 'sdfsaas', 'd1bb70baa31f1df69628c00632b65eab', 'dasfsa@gmail.com', '2017-06-02 00:00:00', 1, 0),
(11, 11041056, 'Rizaldi', '25f4f666c11538a3c6e8a0269bde282e', 'rizaldikartodijoyo@gmail.com', '2017-06-07 00:00:00', 1, 0),
(12, 11041056, 'Rizaldi', '1dc7f4bfa0dd7e12a1d715a062f48b57', 'rizaldikartodijoyo@gmail.com', '2017-06-07 00:00:00', 1, 0),
(13, 11041056, 'Rizaldi', '1dc7f4bfa0dd7e12a1d715a062f48b57', 'rizaldikartodijoyo@gmail.com', '2017-06-07 00:00:00', 1, 0),
(14, 11041056, 'Rizaldi', '1dc7f4bfa0dd7e12a1d715a062f48b57', 'rizaldikartodijoyo@gmail.com', '2017-06-07 00:00:00', 1, 0),
(15, 11041056, 'Rizaldi', '7815696ecbf1c96e6894b779456d330e', 'rizaldikartodijoyo@gmail.com', '2017-06-07 00:00:00', 1, 0),
(16, 11041055, 'Rizaldi', '56e2bf2276b89c6479fb687b060c23d0', 'jagats.kolot@gmail.com', '2017-06-07 00:00:00', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`ID_BERITA`);

--
-- Indexes for table `berita1`
--
ALTER TABLE `berita1`
  ADD PRIMARY KEY (`ID_USER`);

--
-- Indexes for table `dospem`
--
ALTER TABLE `dospem`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hak`
--
ALTER TABLE `hak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `praktikum`
--
ALTER TABLE `praktikum`
  ADD PRIMARY KEY (`id_praktikum`);

--
-- Indexes for table `praktikumku`
--
ALTER TABLE `praktikumku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `ID_BERITA` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `berita1`
--
ALTER TABLE `berita1`
  MODIFY `ID_USER` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `dospem`
--
ALTER TABLE `dospem`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `praktikumku`
--
ALTER TABLE `praktikumku`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

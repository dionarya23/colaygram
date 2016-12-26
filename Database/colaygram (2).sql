-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 26 Des 2016 pada 13.48
-- Versi Server: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `colaygram`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `isi_komen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `status` varchar(200) NOT NULL,
  `id_users` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `status`
--

INSERT INTO `status` (`id`, `status`, `id_users`, `gambar`, `jumlah`, `waktu`) VALUES
(42, 'Penajajaln Ngetes Status Pertama', 1, 'hacker.jpg_1482751791.jpeg', 0, '2016-12-26 11:29:51'),
(43, 'Status ke dua nya', 1, 'main-qimg-04cc4402b7c33287efba45bcf8a6f862_1482751828.png', 0, '2016-12-26 11:30:28'),
(44, 'STATUS KE TIGA', 1, 'Kerajinan-Pigura.jpg_1482752463.jpeg', 0, '2016-12-26 11:41:03'),
(45, 'sTTAUS KE EMPAT', 1, 'main-qimg-04cc4402b7c33287efba45bcf8a6f862_1482752509.png', 0, '2016-12-26 11:41:49'),
(46, 'STATUS KE LIMA', 1, 'bergas.jpg_1482752522.jpeg', 0, '2016-12-26 11:42:02'),
(47, 'sTATUS KE ENAM', 1, 'Kerajinan-Pigura.jpg_1482752546.jpeg', 0, '2016-12-26 11:42:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tentang` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `email`, `tentang`, `foto`) VALUES
(1, 'Dion Arya Pamungkas', 'dionarya', '$2y$10$dlJWDFrpeKxJoEb.Gi/TTOjz.tT2vp387vbdwxdZ.R6RQ8LtpCB.2', 'zonamp3metal@gmail.com', 'I am Web Programmer', 'main-qimg-04cc4402b7c33287efba45bcf8a6f862.png'),
(2, 'Dion Pamungkas', 'dionarya6661', '$2y$10$40eHGhNvJ3kAv.l7c2r5AeIJ5nxxCFSgB/cFyYMFO3wrq0hNZMB8C', 'subang@gmail.com', 'Ini Bio saya adalah seorang pelaut', 'bitch.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_status` (`id_status`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `status`
--
ALTER TABLE `status`
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

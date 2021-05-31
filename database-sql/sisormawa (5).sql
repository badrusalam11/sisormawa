-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Agu 2020 pada 16.03
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisormawa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` char(7) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `jenis_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `stok`, `satuan_id`, `jenis_id`) VALUES
('B000005', 'Stabilo', 617, 5, 9),
('B000006', 'Pulpen', 180, 2, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_barang_keluar` char(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `barang_id` char(7) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_barang_keluar`, `user_id`, `divisi_id`, `barang_id`, `jumlah_keluar`, `tanggal_keluar`) VALUES
('T-BK-20072900002', 2, 1, 'B000005', 8, '2020-07-29'),
('T-BK-20072900003', 2, 3, 'B000005', 1, '2020-07-29'),
('T-BK-20080200001', 2, 3, 'B000006', 20, '2020-08-02');

--
-- Trigger `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `update_stok_keluar` BEFORE INSERT ON `barang_keluar` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` - NEW.jumlah_keluar WHERE `barang`.`id_barang` = NEW.barang_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_barang_masuk` char(16) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `barang_id` char(7) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_barang_masuk`, `supplier_id`, `user_id`, `barang_id`, `jumlah_masuk`, `tanggal_masuk`, `gambar`) VALUES
('T-BM-20080100001', 4, 2, 'B000005', 12, '2020-08-01', '5f24f9ee3f616.jpg'),
('T-BM-20080200001', 4, 2, 'B000006', 200, '2020-08-02', '0');

--
-- Trigger `barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `update_stok_masuk` BEFORE INSERT ON `barang_masuk` FOR EACH ROW UPDATE `barang` SET `barang`.`stok` = `barang`.`stok` + NEW.jumlah_masuk WHERE `barang`.`id_barang` = NEW.barang_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita_acara`
--

CREATE TABLE `berita_acara` (
  `id_BA` int(11) NOT NULL,
  `nama_BA` varchar(100) NOT NULL,
  `berkas` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `catatan` text NOT NULL,
  `id_ormawa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `berita_acara`
--

INSERT INTO `berita_acara` (`id_BA`, `nama_BA`, `berkas`, `status`, `catatan`, `id_ormawa`) VALUES
(1, 'Berita Acara HME', 'berita acara.pdf', 'Diterima', 'diterima', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
(1, 'Sales'),
(3, 'Partman'),
(4, 'Service Advisor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`) VALUES
(7, 'Perangkat Komputer'),
(8, 'Bolpoin'),
(9, 'Alat Tulis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lpj`
--

CREATE TABLE `lpj` (
  `id_lpj` int(11) NOT NULL,
  `nama_lpj` varchar(100) NOT NULL,
  `berkas` varchar(100) NOT NULL,
  `dokumentasi` varchar(100) NOT NULL,
  `lembar_pengesahan` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `catatan` text NOT NULL,
  `id_proker` int(11) NOT NULL,
  `id_ormawa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lpj`
--

INSERT INTO `lpj` (`id_lpj`, `nama_lpj`, `berkas`, `dokumentasi`, `lembar_pengesahan`, `status`, `catatan`, `id_proker`, `id_ormawa`) VALUES
(1, 'LPJ HME 2020', 'LAPORAN.pdf', '', '', 'Diterima', 'Tingkatkan lagi ya..', 1, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ormawa`
--

CREATE TABLE `ormawa` (
  `id_ormawa` int(11) NOT NULL,
  `nama_ormawa` varchar(100) NOT NULL,
  `sejarah` text,
  `ad_art` text,
  `gbho` text,
  `gbhk` text,
  `struktur` text,
  `id_rumpun` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ormawa`
--

INSERT INTO `ormawa` (`id_ormawa`, `nama_ormawa`, `sejarah`, `ad_art`, `gbho`, `gbhk`, `struktur`, `id_rumpun`) VALUES
(0, 'admin', NULL, NULL, NULL, NULL, NULL, 0),
(3, 'HMM', NULL, NULL, NULL, NULL, NULL, 2),
(4, 'BEM FEB', NULL, NULL, NULL, NULL, NULL, 2),
(7, 'HME (Himpunan Mahasiswa Elektro)', 'HME adalah', 'ad/art', 'gbho', 'gbhk', 'struktur', 1),
(8, 'HMS', 'HMS adalah Himpunan Mahasiswa Sipil.', 'ad art HMS', 'GBHO HMS', 'GBHK HMS', 'strukturnya ini', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` char(16) CHARACTER SET utf8 NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_beli` date NOT NULL,
  `barang_id` int(7) NOT NULL,
  `jumlah_beli` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `user_id`, `tanggal_beli`, `barang_id`, `jumlah_beli`) VALUES
('B000001', 1, '2020-07-28', 0, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaanpembelian`
--

CREATE TABLE `permintaanpembelian` (
  `id_pp` char(16) CHARACTER SET utf8 NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal_minta` date NOT NULL,
  `divisi_id` int(11) NOT NULL,
  `barang_id` varchar(7) NOT NULL,
  `jumlah_minta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `permintaanpembelian`
--

INSERT INTO `permintaanpembelian` (`id_pp`, `user_id`, `tanggal_minta`, `divisi_id`, `barang_id`, `jumlah_minta`) VALUES
('PP-20072800001', 1, '2020-07-28', 1, 'B000005', 5),
('PP-20072900001', 18, '2020-07-29', 1, 'B000005', 5),
('PP-20072900002', 18, '2020-07-29', 3, 'B000005', 2),
('PP-20072900003', 18, '2020-07-29', 1, 'B000005', 2),
('PP-20072900004', 18, '2020-07-29', 3, 'B000005', 7),
('PP-200731', 2, '2020-07-10', 10, 'B000005', 100),
('PP-20073100733', 2, '2020-07-31', 3, 'B000005', 10),
('PP-20073100734', 2, '2020-07-31', 1, 'B000005', 213),
('PP-20073100735', 2, '2020-07-31', 3, 'B000005', 999),
('PP-20080200001', 2, '2020-08-02', 1, 'B12354', 2),
('T-BM-20072900001', 18, '2020-07-29', 1, 'B000005', 8),
('T-BM-20072900002', 18, '2020-07-29', 3, 'B000005', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `proker`
--

CREATE TABLE `proker` (
  `id_proker` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `id_ormawa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `proker`
--

INSERT INTO `proker` (`id_proker`, `tanggal`, `keterangan`, `id_ormawa`) VALUES
(1, '2020-08-11', 'Musma HME', 1),
(3, '2020-08-27', 'Ulang tahun HME', 1),
(4, '2020-08-20', 'main catur', 7),
(5, '2020-08-07', 'cek', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `proposal`
--

CREATE TABLE `proposal` (
  `id_proposal` int(11) NOT NULL,
  `nama_proposal` varchar(200) NOT NULL,
  `berkas` varchar(100) NOT NULL,
  `lembar_pengesahan` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `catatan` text NOT NULL,
  `id_ormawa` int(11) NOT NULL,
  `id_proker` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `proposal`
--

INSERT INTO `proposal` (`id_proposal`, `nama_proposal`, `berkas`, `lembar_pengesahan`, `status`, `catatan`, `id_ormawa`, `id_proker`) VALUES
(1, 'Proposal HME 1', 'PROPOSAL.pdf', '', 'Revisi', 'Tidak Sesuai kaidah', 7, 1),
(2, 'Proposal Main catur', '5f3f654be0de1.pdf', '', 'Diterima', 'tidak ada', 7, 4),
(5, 'Proposal Main catur', '5f40e418ea72a.pdf', '', '', '', 7, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_pengeluaran_kas`
--

CREATE TABLE `rekap_pengeluaran_kas` (
  `id_rpk` char(16) NOT NULL,
  `tanggal_rpk` date NOT NULL,
  `dibayar_kepada` varchar(50) NOT NULL,
  `keterangan_rpk` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rumpun_ormawa`
--

CREATE TABLE `rumpun_ormawa` (
  `id_rumpun` int(11) NOT NULL,
  `nama_rumpun` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rumpun_ormawa`
--

INSERT INTO `rumpun_ormawa` (`id_rumpun`, `nama_rumpun`) VALUES
(1, 'Fakultas Teknik dan Ilmu Komputer'),
(2, 'Fakultas Ekonomi dan Bisnis\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(1, 'Unit'),
(2, 'Pack'),
(3, 'Botol'),
(5, 'pcs');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sk_ormawa`
--

CREATE TABLE `sk_ormawa` (
  `id_sk` int(11) NOT NULL,
  `nama_sk` varchar(100) NOT NULL,
  `berkas` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `catatan` text NOT NULL,
  `id_ormawa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sk_ormawa`
--

INSERT INTO `sk_ormawa` (`id_sk`, `nama_sk`, `berkas`, `status`, `catatan`, `id_ormawa`) VALUES
(1, 'SK ORMAWA HME', 'SK ORMAWA.pdf\r\n', 'Diterima', 'ini', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `no_telp`, `alamat`) VALUES
(4, 'Maestro', '085786453531', 'jl. Kartini No. 8 Salatiga'),
(5, 'Sumber Bukit', '089727080816', 'Jl. Hasanudin 600 Salatiga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `role` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `foto` text NOT NULL,
  `id_ormawa` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `email`, `no_telp`, `role`, `password`, `created_at`, `foto`, `id_ormawa`, `is_active`) VALUES
(1, 'Kepala Cabang', 'admin3', 'kepalacabang@gmail.com', '085786453531', 'admin', '$2y$10$jpv830K3opkwSr8UBiVF2.kOsfHZsfJaNDYbyfZGRo2JnA1jEe8Vy', 1596032863, 'user.png', 0, 1),
(2, 'Akuntansi', 'admin1', 'akuntansi@gmail.com', '123', 'admin', '$2y$10$rGXi.q0IcMyV7azFLU0gjOxHMPlmyBmY7LlDJMrHw0lFsUL66fWUK', 1596032645, 'user.png', 0, 1),
(3, 'Kasir', 'admin2', 'kasir@gmail.com', '234', 'admin', '$2y$10$Y5ar6B5wPnP053qCgT8MNO7EBmI4k8i8h7sNB5T8VNV/XugyCGTse', 1596032769, 'user.png', 0, 1),
(5, 'Hasan Gunung', 'Hasan', 'hasangunung@gmail.com', '08901152447', 'user', '$2y$10$hvTeZlmO0aJASgRVdZ9Kp.XlwR9Z/mX48qWZaop6kcPYqtAB7ObCu', 1597914107, 'user.png', 8, 1),
(10, 'Rizky Maulana', 'rizky', 'rizkymaul@gmail.com', '087872233445', 'user', '$2y$10$bLg5VtLUjiz5HW7ayX/FL.0iICWX5U9WjUryJP74Gv0fhX08tqls6', 1597915745, 'user.png', 7, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `satuan_id` (`satuan_id`),
  ADD KEY `kategori_id` (`jenis_id`);

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_barang_keluar`),
  ADD KEY `id_user` (`user_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_barang_masuk`),
  ADD KEY `id_user` (`user_id`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `berita_acara`
--
ALTER TABLE `berita_acara`
  ADD PRIMARY KEY (`id_BA`);

--
-- Indeks untuk tabel `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indeks untuk tabel `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indeks untuk tabel `lpj`
--
ALTER TABLE `lpj`
  ADD PRIMARY KEY (`id_lpj`);

--
-- Indeks untuk tabel `ormawa`
--
ALTER TABLE `ormawa`
  ADD PRIMARY KEY (`id_ormawa`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD UNIQUE KEY `user_id` (`user_id`,`barang_id`);

--
-- Indeks untuk tabel `permintaanpembelian`
--
ALTER TABLE `permintaanpembelian`
  ADD PRIMARY KEY (`id_pp`),
  ADD KEY `user_id` (`user_id`,`divisi_id`,`barang_id`) USING BTREE;

--
-- Indeks untuk tabel `proker`
--
ALTER TABLE `proker`
  ADD PRIMARY KEY (`id_proker`);

--
-- Indeks untuk tabel `proposal`
--
ALTER TABLE `proposal`
  ADD PRIMARY KEY (`id_proposal`);

--
-- Indeks untuk tabel `rekap_pengeluaran_kas`
--
ALTER TABLE `rekap_pengeluaran_kas`
  ADD PRIMARY KEY (`id_rpk`);

--
-- Indeks untuk tabel `rumpun_ormawa`
--
ALTER TABLE `rumpun_ormawa`
  ADD PRIMARY KEY (`id_rumpun`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `sk_ormawa`
--
ALTER TABLE `sk_ormawa`
  ADD PRIMARY KEY (`id_sk`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berita_acara`
--
ALTER TABLE `berita_acara`
  MODIFY `id_BA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `lpj`
--
ALTER TABLE `lpj`
  MODIFY `id_lpj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ormawa`
--
ALTER TABLE `ormawa`
  MODIFY `id_ormawa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `proker`
--
ALTER TABLE `proker`
  MODIFY `id_proker` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `proposal`
--
ALTER TABLE `proposal`
  MODIFY `id_proposal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `rumpun_ormawa`
--
ALTER TABLE `rumpun_ormawa`
  MODIFY `id_rumpun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `sk_ormawa`
--
ALTER TABLE `sk_ormawa`
  MODIFY `id_sk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`jenis_id`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_masuk_ibfk_3` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

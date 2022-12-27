-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Des 2022 pada 10.20
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pelangi_accessories`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `about_us`
--

CREATE TABLE `about_us` (
  `id` int(10) NOT NULL,
  `Heading` text NOT NULL,
  `Short_Desc` text NOT NULL,
  `Long_Desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `about_us`
--

INSERT INTO `about_us` (`id`, `Heading`, `Short_Desc`, `Long_Desc`) VALUES
(1, 'About Us - Our Story', 'Pelangi Accessories didirikan pada tahun 2012. Pelangi Accessories hadir untuk memenuhi kebutuhan pasar akan permintaan berbagai macam aksesoris pendukung penampilan di kota Palangka Raya.', 'Pelangi Accessories memiliki visi menjadikan usaha mikro kecil menengah yang mampu memberdayakan tenaga kerja lokal serta dapat menciptakan lapangan kerja sebesar mungkin. Pelangi Accessories bekerja sama dengan supplier terpercaya yang mampu menjamin kualitas dan stok yang selalu tersedia. Pelangi Accessories juga bekerja sama dengan berbagai jasa ekspedisi agar dapat menjamin kualitas dan keamanan saat pengiriman barang.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `nama`, `email`, `password`) VALUES
(1, 'admin', 'admin@mail.test', 'admin123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `id_pembeli` int(30) NOT NULL,
  `id_produk` int(30) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `kategori`) VALUES
(1, 'Jam'),
(2, 'Anting-Anting'),
(4, 'Parfume');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact`
--

CREATE TABLE `contact` (
  `id` int(1) NOT NULL,
  `facebook` varchar(50) DEFAULT NULL,
  `twitter` varchar(50) DEFAULT NULL,
  `instagram` varchar(50) DEFAULT NULL,
  `alamat` text NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `whatsapp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `contact`
--

INSERT INTO `contact` (`id`, `facebook`, `twitter`, `instagram`, `alamat`, `email`, `telepon`, `whatsapp`) VALUES
(1, 'https://www.facebook.com/', 'https://twitter.com/', 'https://www.instagram.com/', 'Kota Palangka Raya', 'pelangi@mail.com', '(021)-223-123-221', '085504768123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment`
--

CREATE TABLE `payment` (
  `id` int(30) NOT NULL,
  `id_pembeli` int(30) DEFAULT NULL,
  `invoice` varchar(15) NOT NULL,
  `nominal_kirim` double(8,2) NOT NULL,
  `payment_mode` enum('BNI','Mandiri','BRI','') NOT NULL,
  `id_reference` varchar(15) NOT NULL,
  `bukti_transaksi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `payment`
--

INSERT INTO `payment` (`id`, `id_pembeli`, `invoice`, `nominal_kirim`, `payment_mode`, `id_reference`, `bukti_transaksi`) VALUES
(8, 1, '0011670290546', 53000.00, 'BNI', '1234567890', 'transaksi_0011670290546.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembeli`
--

CREATE TABLE `pembeli` (
  `id` int(30) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_hp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembeli`
--

INSERT INTO `pembeli` (`id`, `nama`, `email`, `password`, `alamat`, `nomor_hp`) VALUES
(1, 'Lambang Dwi Windu Setyo Nugroho', 'lambangdwsn@email.com', 'lambang456', 'Polowidi Trimulyo Sleman', '085803956810'),
(12, 'Lambang Dwi Windu Setyo Nugroho', 'barjo@gmail.com', 'lambang123', 'Turi', '085803956222'),
(13, 'Lambang Dwi Windu Setyo Nugroho', 'ahmat@gmail.com', 'lambang123', 'Turi', '085803956333');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(10) NOT NULL,
  `invoice` varchar(15) NOT NULL,
  `id_pembeli` int(30) DEFAULT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga` double(8,2) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `kurir` enum('JNE','TIKI','POS INDONESIA') NOT NULL,
  `layanan` varchar(10) NOT NULL,
  `ongkir` double(8,2) NOT NULL,
  `tanggal_pesan` timestamp NOT NULL DEFAULT current_timestamp(),
  `resi` varchar(20) DEFAULT NULL,
  `status` enum('Cancel','Unpaid','Paid','Shipped','Complete') NOT NULL DEFAULT 'Unpaid',
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `invoice`, `id_pembeli`, `nama_produk`, `harga`, `jumlah`, `kurir`, `layanan`, `ongkir`, `tanggal_pesan`, `resi`, `status`, `keterangan`) VALUES
(13, '0011670290546', 1, 'Jam Tangan', 8000.00, 1, 'JNE', 'OKE', 45000.00, '2022-11-08 10:44:48', '', 'Complete', NULL),
(15, '0011670316516', 1, 'Jam Tangan', 8000.00, 2, 'JNE', 'REG', 50000.00, '2022-11-24 10:44:32', '', 'Complete', NULL),
(17, '0011670497359', 1, 'Gelang Suci', 8000.00, 2, 'JNE', 'OKE', 45000.00, '2022-11-14 11:02:39', '', 'Complete', NULL),
(18, '0011670503838', 1, 'Parfume', 8000.00, 3, 'JNE', 'REG', 50000.00, '2022-12-08 12:50:38', '', 'Cancel', ''),
(19, '0091670576339', NULL, 'Anting Super', 8000.00, 1, 'TIKI', 'ECO', 27000.00, '2022-12-16 08:58:59', '123456789012', 'Complete', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(30) NOT NULL,
  `kategori` int(10) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` double(8,2) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `jumlah` int(5) NOT NULL,
  `berat` double(2,2) NOT NULL,
  `label` varchar(10) NOT NULL,
  `foto_1` varchar(25) DEFAULT NULL,
  `foto_2` varchar(25) DEFAULT NULL,
  `foto_3` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `kategori`, `nama`, `harga`, `keterangan`, `jumlah`, `berat`, `label`, `foto_1`, `foto_2`, `foto_3`) VALUES
(4, 1, 'Jam Tangan', 8000.00, '<p>Jam Tangan Baru Nih</p><figure class=\"media\"><div data-oembed-url=\"https://youtu.be/EngW7tLk6R8\"><div style=\"position: relative; padding-bottom: 100%; height: 0; padding-bottom: 56.2493%;\"><iframe src=\"https://www.youtube.com/embed/EngW7tLk6R8\" style=\"position: absolute; width: 100%; height: 100%; top: 0; left: 0;\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen=\"\"></iframe></div></div></figure>', 8, 0.20, 'NEW', 'img_4_1.png', 'img_4_2.jpg', 'img_4_3.jpg'),
(5, 2, 'Anting', 10000.00, '<p>Barang ini baru</p>', 15, 0.20, 'BEST', 'img_5_1.jpg', 'img_5_2.png', 'img_5_3.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(30) NOT NULL,
  `id_pembeli` int(30) NOT NULL,
  `id_produk` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pembeli` (`id_pembeli`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_ibfk_1` (`id_pembeli`);

--
-- Indeks untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`,`nomor_hp`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pesanan_ibfk_1` (`id_pembeli`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `katagori_idk` (`kategori`);

--
-- Indeks untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pembeli` (`id_pembeli`),
  ADD KEY `id_produk` (`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `katagori_idk` FOREIGN KEY (`kategori`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jan 2023 pada 13.19
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(1, 'Keyboard'),
(2, 'Headphone'),
(4, 'Processor'),
(6, 'Ram'),
(7, 'Hdd'),
(8, 'Ssd'),
(9, 'Vga Card'),
(10, 'Power Supply');

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
  `harga` double(10,2) NOT NULL,
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
(4, 1, 'Logitech MX Mechanical Tactile Keyboard Wireless Bluetooth Backlit', 2639000.00, '<b>Logitech MX Mechanical Tactile Keyboard Wireless Bluetooth Backlit</b>\r\n<hr>\r\n<p>Memperkenalkan MX Mechanical, keyboard full-size dengan nuansa, presisi, dan kinerja luar biasa. Pengetikan mekanikal yang sederhana menghadirkan feedback yang memuaskan dengan tipe tombol switch Tactile Quiet. Jemarimu akan meluncur mulus di permukaan tombol matte dan keycap dua warnanya memandu penglihatan guna memudahkanmu mengarahkan jemari dan tetap fokus dalam alur kerjamu.</p>\r\n<br>\r\n<p>MX Mechanical dibuat untuk menghadirkan kenyamanan ergonomis dengan smart backlighting dan easy-switch, memungkinkanmu untuk terhubung ke maksimum 3 perangkat dan tetap fokus bekerja selama berjam-jam lamanya. Tombol backlit secara otomatis menyesuaikan agar sesuai dengan kondisi pencahayaan yang berubah-ubah.</p>\r\n<hr>\r\n<b>PERSYARATAN SISTEM</b>\r\n<p>- Koneksi internet untuk download software</p>\r\n<p>- Software Logi Options+ untuk macOS dan Windows.</p>\r\n<p>- Perangkat dengan kemampuan teknologi Bluetooth® Rendah Energi: Windows® 10, 11 atau versi terbaru, macOS 10.15 atau versi terbaru, iOS 14 atau versi terbaru, iPadOS 14 atau versi terbaru, Linux®, ChromeOS, Android 8.0 atau versi terbaru.</p>\r\n<p>- Port USB-A yang kosong untuk terhubung via receiver</p>', 24, 0.99, 'NEW', 'mx1.jpg', 'mx2.jpg', 'mx3.jpg'),
(5, 2, 'SENNHEISER HD 400S Headphone', 999000.00, '<p>HD 400S memiliki fitur smart remote yaitu satu tombol yang terletak di kabel, yang memungkinkan Anda mengontrol musik dan menerima panggilan dengan mudah, dan desain lipat yang kokoh membuat headphone ini tahan lama dan cukup ringkas untuk dibawa ke mana saja. Driver dinamis Sennheiser menghadirkan respons suara yang diperluas dengan bass dinamis.</p>\r\n<br>\r\n<p>Fitur</p>\r\n<p>-Kualitas suara Sennheiser yang terkenal untuk pengalaman mendengarkan yang unik.</p>\r\n<p>-Mikrofon internal dan remote untuk kontrol panggilan dan musik.</p>\r\n<p>-Headphone di sekitar telinga yang tertutup mengurangi kebisingan latar belakang yang tidak diinginkan demi kenyamanan Anda.</p>\r\n<p>-Headphone yang ringan dan dapat dilipat untuk memudahkan penyimpanan saat bepergian.</p>\r\n<hr>\r\n<p>What\'s in the box?</p>\r\n<p>-HD 400S around-ear headphones</p>\r\n<p>-RCS 400 detachable single-sided cable with 1-button remote and 3.5 mm angled plug</p>\r\n<p>-Traveling pouch</p>\r\n<hr>\r\n<p>Garansi 2 Tahun</p>', 15, 0.50, 'BEST', 'sh4.jpg', 'sh41.jpg', 'sh42.jpg'),
(7, 1, 'logitech K380 Wireless', 449000.00, '<b>K380 MULTI-DEVICE BLUETOOTH KEYBOARD</b>\r\n<br>\r\n<p>Minimalis. Modern. Multiguna</p>\r\n<br>\r\n<p>YOUR SPACE. DI MANA PUN.</p>\r\n<br>\r\n<p>Minimalis, modern, dan mudah dibawa. K380 Multi-Device keyboard yang tipis dan ringan ini dilengkapi dengan Bluetooth® sehingga kamu bisa melakukan multitasking di rumah, dalam perjalanan, atau di kafe favoritmu. Mengetik di laptop, ponsel, atau tablet dan kuasai ruang gerakmu di mana pun kamu berada.</p>\r\n<br>\r\n<p>MENGETIK PADA PERANGKAT APA PUN</p>\r\n<br>\r\n<p>Perangkat apa pun, OS apa pun. K380 Multi-Device terhubung ke semua perangkat wireless Bluetooth yang dilengkapi dukungan keyboard eksternal sehingga kamu bisa bekerja dengan lancar menggunakan Windows®, macOS, iPadOS, Chrome OS™, Android™, iOS, dan bahkan Apple TV.</p>\r\n<br>\r\n<p>PENGETIKAN ALA LAPTOP YANG NYAMAN</p>\r\n<br>\r\n<p>Semua tombol dalam desain yang kencang. Footprint yang sangat kecil memungkinkanmu meletakkan mouse lebih dekat agar lebih terjangkau, lebih nyaman, dan postur tubuh yang lebih baik.<p>\r\n', 81, 0.99, 'NEW', 'k380.jpg', 'k380p.jpg', 'k380w.jpg'),
(9, 2, 'Steelseries Arctis 7 Wireless 7.1 DTS:X - White', 2199000.00, '<p>Features :</p>\r\n<p>- Lossless 2.4 GHz wireless audio designed for low latency gaming</p>\r\n<p>- Best mic in gaming: the Discord-certified Clearcast bidirectional microphone</p>\r\n<p>- Hear stunning detail in all games with award-winning Arctis sound</p>\r\n<p>- Next-generation DTS Headphone:X v2.0 surround sound</p>\r\n<p>- 24-hour battery life outlasts even your longest gaming sessions</p>\r\n<hr>\r\n<p>Garansi Resmi 1 Tahun Steelseries Indonesia</p>', 81, 0.99, 'NEW', 'sa1.jpg', 'sa2.jpg', 'sa3.jpg'),
(10, 4, 'AMD Ryzen 9 7950X 16 Core 32 Thread 5.7Ghz AM5 Processor', 10090000.00, '<p>Specification :<p>\r\n\r\n\r\n<p><b>Platform</b></br>\r\nDesktop</p>\r\n<p><b>Market Segment</b></br>\r\nEnthusiast Desktop</p>\r\n<p><b>Product Family</b></br>\r\nAMD Ryzen™ Processors</p>\r\n<p><b>Product Line</b><br>\r\nAMD Ryzen™ 9 Desktop Processors</p>\r\n<p><b>AMD PRO Technologies</b><br>\r\nNo</p>\r\n<p><b>Consumer Use</b><br>\r\nYes</p>\r\n<p><b>Regional Availability</b><br>\r\nGlobal</p>\r\n<p><b>Former Codename</b><br>\r\n\"Raphael AM5\"</p>\r\n<p><b>Architecture</b><br>\r\n\"Zen 4\"</p>\r\n<p><b># of CPU Cores</b><br>\r\n16</p>\r\n<p><b>Multithreading (SMT)</b><br>\r\nYes</p>\r\n<p><b># of Threads</b><br>\r\n32</p>\r\n<p><b>Max. Boost Clock</b><br>\r\nUp to 5.7GHz</p>\r\n<p><b>Base Clock</b><br>\r\n4.5GHz</p>', 81, 0.99, 'NEW', 'amd.jpg', 'amd2.jpg', 'amd3.jpg'),
(11, 4, 'Intel Processor Core i9 13900KF - LGA1700', 10880000.00, '<b>Spesifikasi CPU</b>\r\n<p>Jumlah Inti 24</p>\r\n<p># Performance-core8</p>\r\n<p># Efficient-core16</p>\r\n<p>Jumlah Untaian 32</p>\r\n<p>Frekuensi Turbo Maks 5.80 GHz</p>\r\n<p>Intel® Thermal Velocity Boost Frequency 5.80 GHz</p>\r\n<p>Intel® Turbo Boost Max Technology 3.0 Frequency ‡ 5.70 GHz</p>\r\n<p>Frekuensi Turbo Maksimum Performance-core 5.40 GHz</p>\r\n<p>Frekuensi Turbo Maksimum Efficient-core 4.30 GHz</p>\r\n<p>Frekuensi Dasar Performance-core3.00 GHz</p>\r\n<p>Frekuensi Dasar Efficient-core2.20 GHz</p>\r\n<p>Cache 36 MB Intel® Smart Cache</p>\r\n<p>Cache L2 Total32 MB</p>\r\n<p>Daya Dasar Prosesor 125 W</p>\r\n<p>Daya Turbo Maksimum 253 W</p>\r\n\r\n<b>Spesifikasi Memori</b>\r\n<p>Ukuran Memori Maks (bergantung jenis memori) 128 GB</p>\r\n<p>Jenis Memori Up to DDR5 5600 MT/s</p>\r\n<p>Up to DDR4 3200 MT/s</p>\r\n<p>Jumlah Maksimum Saluran Memori 2</p>\r\n<p>Bandwidth Memori Maks 89.6 GB/s</p>\r\n\r\n<p>TDP i9 : 125- 253W</p>', 81, 0.99, 'NEW', 'i91.jpg', 'i92.jpg', 'i93.jpg'),
(12, 6, 'Kingston Fury BEAST 8GB DDR4 - 3200MHz', 412000.00, '<b>Features :</b>\r\n<p>Low-profile heat spreader design</p>\r\n<p>Cost-efficient, high-performance DDR4 upgrade</p>\r\n<p>Intel XMP-ready</p>\r\n<p>Ready for AMD Ryzen™</p>\r\n<p>Speeds up to 3733MHz1 and kit capacity up to 128GB</p>\r\n<p>Plug N Play functionality at 2666MHz</p>\r\n\r\n<p>CL(IDD) : 17 cycles</p>\r\n<p>Row Cycle Time (tRCmin) : 45.75ns(min.)</p>\r\n<p>Refresh to Active/Refresh : 260ns(min.)</p>\r\n<p>Command Time (tRFCmin)</p>\r\n<p>Row Active Time (tRASmin) 32ns(min.)</p>\r\n<p>UL Rating : 94 V - 0</p>\r\n<p>Operating Temperature : 0C to +85C</p>\r\n<p>Storage Temperature : -55C to +100C</p>\r\n', 81, 0.20, 'NEW', 'kf1.jpg', 'kf2.jpg', 'kf3.jpg'),
(13, 6, 'Team T-Create SILVER DDR4 16GB (2x8) 3200MHz TTCCD416G3200HC22DC01', 859000.00, '<b>Lifetime Warranty</b>\r\n<p>Module Type</p>\r\n\r\n<p>DDR4 288 Pin Unbuffered DIMM Non ECC</p>\r\n<p>Capacity</p>\r\n\r\n<p>8GBx2/ 16GBx2 / 32GBx2</p>\r\n<p>Frequency 3200</p>\r\n<p>Data Transfer Bandwidth</p>\r\n\r\n<p>21,328 MB/s</p>\r\n\r\n\r\n<p>25,600 MB/s</p>\r\n<p>(PC4 25600)</p>\r\n<p>Latency CL19-19-19-43 CL22-22-22-52</p>\r\n<p>Voltage 1.2V</p>\r\n<p>Dimensions 32(H) x 140(L) x 7(W)mm</p>\r\n<p>Heat Spreader Aluminum heat spreader</p>\r\n', 81, 0.20, 'NEW', 't1.jpg', 't2.jpg', 't3.jpg'),
(14, 7, 'Seagate BarraCuda HDD / Hardisk Internal Laptop 1TB SATA 7200RPM', 895000.00, '<p>ST1000LM049</p>\r\n<p>Form Factor: 2.5Inch</p>\r\n<p>Interface: SATA 6Gb/s</p>\r\n<p>Kapasitas: 1TB</p>\r\n<p>Rotation Speed: 7200RPM</p>\r\n<p>Cache: 128MB</p>\r\n<p>Ketebalan: 7mm</p>\r\n<p>Garansi Resmi 5 Tahun</p>', 100, 0.20, 'NEW', 'b1.png', 'b2.png', 'b3.png'),
(15, 7, 'Hardisk 500GB WD Blue Sata 3.5 HDD Internal For PC Computer Rpm 7200 - WD BLUE', 114000.00, '<p>KAPASITAS : 500GB</p>\r\n<p>PERFORMANCE 100%</p>\r\n<p>SENTINEL 100%</p>\r\n<p>POWER ON TIME :0 DAYS</p>\r\n<p>SPEED RPM 7200</p>\r\n\r\n<p>MEREK WD BLUE</p>\r\n<p>UKURAN 3,5 INCHI</p>', 100, 0.50, 'NEW', 'wb1.jpg', 'wb2.jpg', 'wb3.jpg'),
(16, 8, 'SSD 128GB SATA3 V-GEN Solid State Drive 128 GB VGEN SATA 3 2.5 Inch', 188000.00, '<p>Kapasitas : 128GB</p>\r\n<p>Dimensi : 100 x 70 x 6 mm</p>\r\n<p>Speed : Read up to 550Mbps; Write up to 477Mbps</p>\r\n<p>Interface : SATA 3 - 6GB/s</p>\r\n<p>Form Factor : 2.5 inch</p>\r\n<p>Type : Internal Storage</p>\r\n<p>Supported : UDMA Mode 6</p>\r\n<p>TRIM Support : Yes (Requires OS Support)</p>\r\n<p>Garbage Collection : Yes</p>\r\n<p>S.M.A.R.T : Yes</p>\r\n<p>Write Cache : Yes</p>\r\n<p>Host Protect Area : Yes</p>\r\n<p>APM : Yes</p>\r\n<p>NCQ : Yes</p>\r\n<p>48-Bit : Yes</p>\r\n<p>Security : AES 256-Bit Full Disk Encryption (FDE)</p>\r\n<p>TCG/Opal V2.0 , Encryption Drive (IEEE1667)</p>\r\n<p>Volume : +/- 20 gr</p>\r\n<p>Garansi : 3 Tahun (One to One Replacement / Rusak Langsung Tukar Barang)</p>', 100, 0.20, 'NEW', 'vs1.jpg', 'vs2.jpg', 'vs3.jpg'),
(17, 8, 'SAMSUNG SSD 970 EVO PLUS 250GB / 500GB 1TB / 2TB M2 NVMe Internal SSD - SSD Only, 250GB', 953000.00, '<b>SAMSUNG SSD 970 EVO PLUS 250GB / 500GB 1TB / 2TB M2 PCIe NVMe</b>\r\n\r\n<p>Product Type : SSD</p>\r\n<p>Series : 970 EVO Plus</p>\r\n<p>Usage Application : Client PCs</p>\r\n<p>Interface : PCIe Gen 3.0 x 4, NVMe 1.3</p>\r\n<p>Consumer : Yes</p>', 15, 0.20, 'NEW', 'nv1.jpg', 'nv2.jpg', 'nv3.jpg'),
(18, 9, 'VGA Colorful iGame GeForce RTX 3060 Ultra W OC-V 8GB - 8GB GDDR6', 5599000.00, '<b>VGA Colorful iGame GeForce RTX 3060 Ultra W OC-V 8GB - 8GB GDDR6</b>\r\n\r\n<p>Garansi Resmi 3 Tahun</p>\r\n\r\n<p>Chip Series : GeForce® RTX 3060</p>\r\n<p>Product Series : iGame Series</p>\r\n<p>GPU Code Name : GA106</p>\r\n<p>Manufacturing Process : 8nm</p>\r\n<p>CUDA Cores : 3584</p>\r\n<p>Core Clock : Base:1320Mhz; <p>Boost:1777Mhz</p>\r\n<p>One-Key OC : Base:1320Mhz; Boost:1822Mhz</p>\r\n<p>Memory Clock : 15Gbps</p>\r\n<p>Memory Size : 8GB</p>\r\n<p>Memory Bus Width : 128bit</p>\r\n<p>Memory Type : GDDR6</p>\r\n<p>Memory Bandwidth : 240GB/s</p>\r\n<p>Power Connector : 2*8Pin</p>\r\n<p>Power Supply : 7+2</p>\r\n<p>TDP : 200W</p>\r\n<p>Display Ports : 3DP+HDMI</p>\r\n<p>Fans Type : FAN</p>\r\n<p>Heat Pipe Number/Spec : 2*?6+2*?8</p>\r\n<p>Auto Stop Technology : Y</p>\r\n<p>Power Suggest : 550W</p>\r\n<p>DirectX : DirectX 12 Ultimate/OpenGL4.6</p>\r\n<p>NV technology Support : NVIDIA DLSS, NVIDIA G-SYNC, 2nd Gen Ray Tracing Cores</p>\r\n<p>Slot Number : over 2 slot</p>\r\n<p>Product Size : 310*131.5*56mm</p>\r\n<p>Product Weight : 1.1KG(N.W)</p>', 15, 0.99, 'NEW', 'i1.jpg', 'i2.jpg', 'i3.jpg'),
(19, 9, 'VGA Colorful GeForce RTX 3060 Duo NB 8GB - 8 GB GDDR6', 5299000.00, '<b>VGA Colorful GeForce RTX 3060 Duo NB 8GB - 8 GB GDDR6</b>\r\n\r\n<p>Garansi Resmi 3 Tahun</p>\r\n\r\n<p>Graphics_Card_Model : GeForce® RTX 3060</p>\r\n<p>GPU GeForce RTX 3060</p>\r\n<p>GPU_Code_Name : GA106</p>\r\n<p>Manufacturing_Process : 8nm</p>\r\n<p>CUDA_CORES : 3584</p>\r\n<p>Core_Clock : Base:1320Mhz; Boost:1777Mhz</p>\r\n<p>Memory_Clock : 15Gbps</p>\r\n<p>Memory_Size : 8GB</p>\r\n<p>Memory_Bus_Width : 128bit</p>\r\n<p>Memory Bandwidth : 240GB/s</p>\r\n<p>Memory_Type : GDDR6</p>\r\n<p>Display_Ports : 3DP+HDMI</p>\r\n<p>Power_Connector : 8pin</p>\r\n<p>Power Supply : 6+2</p>\r\n<p>Power Suggest :550W and above</p>\r\n<p>DirectX : DirectX 12 Ultimate/OpenGL4.6</p>\r\nNV technology Support NVIDIA DLSS, NVIDIA G-SYNC, 2nd Gen Ray Tracing Cores</p>\r\n<p>Slot Number : 2 slot</p>\r\n<p>Product Size : 253.4*132.5*41mm</p>\r\n<p>Product Weight : 0.73KG(N.W)</p>', 15, 0.99, 'NEW', 'cg1.jpg', 'cg2.jpg', 'cg3.jpg'),
(20, 10, 'AeroCool Power Supply LUX 550W Bronze', 485000.00, '<p>Features</p>\r\n<p>- 12VDC x 42A</p>\r\n<p>- 1x 6+2 pin</p>\r\n<p>- 1x 4+4 pin</p>\r\n<p>- 2x IDE</p>\r\n<p>- 4x SATA</p>\r\n<p>- input voltage 200-240 VAC</p>\r\n<p>- Power Supply 550 Watt</p>\r\n<p>- 80Plus 230V EU Bronze Certified for up to 88%+ efficiency</p>\r\n<p>- Silent 12cm fan with optimized thermal fan speed control. Fan runs at startup speed (less than 800RPM) before reaching 60% load at 25 ambient temperatures</p>\r\n<p>- Soft, black, flat cables allow for more convenient cable management and easier installation</p>\r\n<p>- Compatible with all Intel form factors up to ATX12V Ver.2.4</p>\r\n\r\n<p>Garansi 2 tahun</p>', 15, 0.99, 'NEW', 'l1.jpg', 'l2.jpg', 'l3.jpg'),
(21, 10, 'Power Supply Gamemax VP-800 RGB 800Watt 80+ Bronze', 710700.00, '<b>Power Supply Gamemax VP-800 RGB 800Watt 80+ Bronze</b>\r\n<p>VP-800-RGB</p>\r\n<p>The GameMax VP series power supply offers “Value and Performance” scheme. 80Plus ready for support high efficiency required, also it is continuing a popular for computer builds.</p>\r\n<p>GameMax VP RGB Range have great features that make it a good choice for people who are looking for an efficient and reliable, good value power supply. The most suitable cost/performance ratio is the best choice for system builder.\r\nRGB LED Lighting to power your system with style. Bring your system to life with build-in unique lighting effects that without additional controlled used.</p>\r\n\r\n<p>PSU Type? ATX</p>\r\n<p>Cabling? Wired</p>\r\n<p>Efficiency? 85+ Bronze</p>\r\n\r\n<b>Specification :</b>\r\n<p>Total Wattage 800W</p>\r\n<p>80PLUS® APFC 80+ Plus Compliant</p>\r\n<p>Efficiency Level 80+ Bronze</p>\r\n<p>Noise Level Zero (ECO-ON),<32dBA (at 100% load)</p>\r\n<p>Form Factor Intel ATX 12 V 2.31</p>\r\n<p>Dimensions 140 mm (W) x 150 mm (L) x 86 mm (H)</p>\r\n\r\n<b>Fan Information:</b>\r\n<p>Fan Size 120 mm</p>\r\n<p>Fan Control ECO-ON/OFF</p>\r\n<p>Fan Bearing Fluid Dynamic Bearing</p>\r\n<p>Life Expectancy 50,000 hours at 40 °C, 15 % - 65 % RH</p>\r\n\r\n<b>Cable Information:</b>\r\n<p>Modularity Wired Cabling</p>\r\n<p>Cable type Black tube shield along with colors CPU and PCIe connector</p>\r\n\r\n<b>Electrical Features :</b>\r\n<p>Operating Temperature 0 - 50 °C (derating from 100 % to 80 % from 40 °C to 50 °C)</p>\r\n<p>MTBF @ 25 °C, excl. fan 100,000 hours</p>\r\n<p>AC Input Full Range AC input (100-240Vac)</p>\r\n<p>Protection OPP, OVP, UVP, OCP, OTP, SCP</p>\r\n\r\n<b>Safety and Environmental :</b>\r\n<p>Safety and EMC CB, CCC,CE</p>\r\n<p>Environmental Compliance RoHS, WEEE, ErP Lot 6</p>', 15, 0.99, 'NEW', 'g1.jpg', 'g2.jpg', 'g3.jpg');

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Nov 2022 pada 13.44
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_olshop`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id_admin` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` enum('Admin','Petugas') NOT NULL,
  `avatar` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id_admin`, `admin_name`, `email`, `password`, `level`, `avatar`) VALUES
(1, 'M.Amirul Fahmi', 'amirulfahmi148@gmail.com', '123', 'Admin', 8),
(2, 'Alex Ibrahim', 'amirulfahmi@gmail.com', '123', 'Petugas', 4),
(3, 'Yuli Timor Riana', 'ujicoba@gmail.com', '123', 'Admin', 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_category`
--

CREATE TABLE `tb_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_category`
--

INSERT INTO `tb_category` (`category_id`, `category_name`) VALUES
(10, 'Fashion Pria'),
(11, 'Fashion Wanita'),
(12, 'Peralatan Elektronik'),
(13, 'Aksesoris Elektronik'),
(14, 'Skincare'),
(15, 'Otomotif'),
(16, 'Laptop');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_product`
--

CREATE TABLE `tb_product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_pcs` varchar(15) NOT NULL,
  `product_image` varchar(200) NOT NULL,
  `product_status` tinyint(4) NOT NULL,
  `data_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_product`
--

INSERT INTO `tb_product` (`product_id`, `category_id`, `product_name`, `product_price`, `product_pcs`, `product_image`, `product_status`, `data_created`) VALUES
(14, 10, 'Jacket Bomber ', 130000, '100', '6386d1785464f.jpg', 1, '2022-11-30 03:43:52'),
(15, 12, 'Kamera Cannon', 2400000, '20', '6386d22e0908b.jpg', 1, '2022-11-30 03:46:54'),
(16, 12, 'Speaker Bluetot', 130000, '33', '6386d34cc611b.jpg', 1, '2022-11-30 03:51:40'),
(17, 13, 'Headphone', 150000, '40', '6386d3848f257.jpg', 1, '2022-11-30 03:52:36'),
(18, 13, 'SdCard SanDisk', 80000, '40', '6386d3d376612.jpg', 1, '2022-11-30 03:53:55'),
(19, 16, 'Laptop Lenovo', 8000000, '12', '6386d44dadc15.jpg', 1, '2022-11-30 03:54:58'),
(20, 10, 'Jacket Bomber', 120000, '19', '6386db32957ea.jpg', 1, '2022-11-30 03:57:41'),
(21, 13, 'Headset gaming', 180000, '76', '6386d4ff9bb2e.jpg', 1, '2022-11-30 03:58:55'),
(22, 12, 'Kamera Cannon', 3000000, '10', '6386e8c844c63.jpg', 1, '2022-11-30 05:23:20');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `tb_category`
--
ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeks untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_category`
--
ALTER TABLE `tb_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

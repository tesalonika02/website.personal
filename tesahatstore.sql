-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Feb 2024 pada 05.24
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tesahatstore`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(102, 36, 51, 'Beanie Rabbit', 125000, 100, 'beanie hat 2.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(12, 34, 'tesa', 'tesalonika@gmail.com', '4442552666', 'Warna kurang terang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` int(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending',
  `image` varchar(100) NOT NULL,
  `paket` varchar(255) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `estimasi` varchar(255) NOT NULL,
  `namaprovinsi` varchar(255) NOT NULL,
  `namakota` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`, `image`, `paket`, `ongkir`, `estimasi`, `namaprovinsi`, `namakota`, `tipe`) VALUES
(50, 34, 'artha', 0, 'arthatesa@gmail.com', 'Dana', 'Jl. Gagak 2 Tambun Selatan Sumber Jaya  9 - jne', ', Beanie Cat ( 1 ), Beanie Rabbit ( 1 )', 245000, '12-Feb-2024', 'completed', 'bukti teep.jpg', 'CTC', 10000, '1-2', 'Jawa Barat', 'Bekasi', 'Kabupaten'),
(51, 34, 'tesa', 0, 'tesalonika@gmail.com', 'Dana', 'Jl. Mawar 2 Tambun Selatan Sumber Jaya  9 - jne', ', Beanie Cat ( 5 ), Beanie Panda ( 5 )', 1225000, '13-Feb-2024', 'diterima', 'bukti teep.jpg', 'CTC', 10000, '1-2', 'Jawa Barat', 'Bekasi', 'Kabupaten'),
(52, 34, 'qwfqwfwq', 0, 'arthatesa@gmail.com', 'Dana', '2wf2f2223 23f23f23f223f23f23 32f23f2f  16 - pos', ', Beanie Cat ( 1 )', 120000, '14-Feb-2024', 'pending', 'bukti teep.jpg', 'Pos Reguler', 147000, '8 HARI', 'Kalimantan Utara', 'Nunukan', 'Kabupaten'),
(53, 34, 'jqwfjqwhfqwhfh', 2147483647, 'arthatesa@gmail.com', 'Dana', 'qlkwfkwjfkwkef wlengwegwle wjehgjkwehgj  16 - jne', ', Beanie Cat ( 1 )', 120000, '14-Feb-2024', 'pending', 'logo smapat.jpg', 'OKE', 154000, '5-7', 'Kalimantan Utara', 'Tana Tidung', 'Kabupaten');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `berat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `details`, `price`, `image`, `berat`) VALUES
(51, 'Beanie Rabbit', 'BeanieHat', 'Beanie Hat Rabbit ini berbahan halus karena terbuat dari bludru. Cocok digunakan untuk segala musim dan berukuran all size', 125000, 'beanie hat 2.jpg', 0),
(52, 'Beanie Cat', 'BeanieHat', 'Beanie Hat Cat ini dibuat dengan benang tebal dan dijahit menggunakan metode rajut. Berukuran all size', 120000, 'beanie hat 1.jpg', 0),
(53, 'Beanie Panda', 'BeanieHat', 'Beanie Hat Panda ini berbahan halus karena terbuat dari bludru. Cocok digunakan untuk segala musim dan berukuran all size. Cocok juga digunakan untuk semua gender', 125000, 'beanie hat 3.jpg', 0),
(54, 'Beanie Cute', 'BeanieHat', 'Beanie Hat Panda ini dibuat dengan model sedikit lebih unyu. Terbuat dari benang tebal dan dijahit menggunakan metode rajut. Berukuran all size', 120000, 'beanie hat 4.jpg', 0),
(55, 'Beret Metal', 'Beret', 'Beret ini terbuat dari bahan kulit. Cocok untuk fashion semua gender. Berukuran all size', 100000, 'beret 1.jpg', 0),
(56, 'Beret Sweet', 'Beret', 'Beret ini terbuat dari bahan bulu sehingga halus dan nyaman digunakan. Berukuran all size', 120000, 'beret 2.jpg', 0),
(57, 'Beret Antique', 'Beret', 'Beret ini terbuat dari bludru. Cocok untuk fashion klasik. Berukuran all size', 115000, 'beret 3.jpg', 0),
(58, 'Beret Good', 'Beret', 'Beret ini terbuat dari bludru. Cocok untuk semua gender. Berukuran all size', 115000, 'beret 4.jpg', 0),
(59, 'Bucket Snow', 'BucketHat', 'Bucket Snow terbuat dari bahan bulu sehingga halus dan nyaman digunakan. Cocok untuk musim dingin. Berukuran all size', 120000, 'bucket hat 1.jpg', 0),
(60, 'Bucket Good', 'BucketHat', 'Bucket Good ini terbuat dari kulit. Cocok untuk fashion masa kini. Berukuran all size', 115000, 'bucket hat 2.jpg', 0),
(61, 'Bucket Warm', 'BucketHat', 'Bucket Warm ini terbuat dari bahan katun. Cocok untuk berpergian santai. Berukuran all size', 100000, 'bucket hat 3.jpg', 0),
(62, 'Bucket Man', 'BucketHat', 'Bucket Man ini terbuat dari bahan katun. Digunakan untuk pria. Berukuran all size', 100000, 'bucket hat 4.jpg', 0),
(63, 'Snapback Nice', 'SnapbackCap', 'Snapback Nice ini terbuat dari katun. Cocok untuk fashion sehari-hari. Berukuran all size', 100000, 'snapback 1.jpg', 0),
(64, 'Snapback Boy', 'SnapbackCap', 'Snapback Boy ini terbuat dari bahan kulit. Termasuk topi fashion masa kini. Berukuran all size', 115000, 'snapback 2.jpg', 0),
(65, 'Snapback Man', 'SnapbackCap', 'Snapback Man ini terbuat dari bahan katun. Digunakan untuk pria. Berukuran all size', 120000, 'snapback 3.jpg', 0),
(66, 'Snapback Cool', 'SnapbackCap', 'Snapback Cool ini terbuat dari bahan katun. Cocok digunakan untuk sehari-hari. Berukuran all size', 100000, 'snapback 4.jpg', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `image`) VALUES
(34, 'artha', 'arthatesa@gmail.com', '2f6167d9f954d747e87bfcee0465eba4', 'user', 'mod.jpg'),
(36, 'tesa', 'tesalonika@gmail.com', 'f0cc828f2c2c224335a33214295156c2', 'user', 'modd.jpg'),
(38, 'artha', 'adminartha@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin', 'modd.jpg'),
(39, 'tesa', 'tesaadmin@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin', 'model.jpg'),
(40, 'tesartha', 'tesartha@gmail.com', 'afac106f892338f49e4eab21829c4997', 'user', 'model.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(54, 31, 28, 'Cylinder Head Honda Sonic', 3000000, 'headsoni.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT untuk tabel `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

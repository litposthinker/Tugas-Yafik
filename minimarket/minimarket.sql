-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2020 at 08:39 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minimarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `user_id` int(11) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `nama_lengkap`, `username`, `password`) VALUES
(1, 'Yafik', 'yafik', 'c4ca4238a0b923820dcc509a6f75849b'),
(2, 'nuris akbar', 'nuris', '5f4dcc3b5aa765d61d8327deb882cf99'),
(3, 'John Doe', 'john', '5f4dcc3b5aa765d61d8327deb882cf99');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(30) DEFAULT NULL,
  `jenis` text DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `supplier` varchar(30) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `gambar` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `jenis`, `harga`, `supplier`, `stok`, `gambar`) VALUES
(3, 'Doritos Tortilla Chips', 'Makanan', 12000, '', 50, 'https://www.londondrugs.com/on/demandware.static/-/Sites-londondrugs-master/default/dw5be015c2/products/L5110754/large/L5110754.JPG'),
(4, ' Fanta Orange Soft Drink Can', 'Minuman', 7500, '', 100, 'https://images-na.ssl-images-amazon.com/images/I/71y12uT-UuL._SL1500_.jpg'),
(5, 'Fresh Golden Pineapple', 'Buah', 200000, '', 10, 'https://images-na.ssl-images-amazon.com/images/I/71+qAJehpkL._SX425_.jpg'),
(6, 'Hotwheels, Fat Ride', 'Mainan', 235000, '', 5, 'https://i.ebayimg.com/images/g/wOUAAOSwX5hdhybO/s-l300.jpg'),
(7, 'Breyers, Oreo Cookie Ice Cream', 'Makanan', 50000, '', 45, 'https://images-na.ssl-images-amazon.com/images/I/71p76vWMMtL._SX425_.jpg'),
(8, 'Wire Storage', 'Peralatan Rumah Tangga', 235000, '', 15, 'https://images.homedepot-static.com/productImages/eb356c29-0773-408c-819d-03ab9e640316/svn/white-closetmaid-wire-closet-drawers-1088-64_1000.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `produk_beli`
--

CREATE TABLE `produk_beli` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `jenis` text NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk_beli`
--

INSERT INTO `produk_beli` (`id_produk`, `nama_produk`, `jenis`, `harga`, `stok`, `image`) VALUES
(9, 'asdasd', 'asd', 0, 0, 'https://cf.shopee.co.id/file/37960edcbdfb06d0d40248602853e923');

-- --------------------------------------------------------

--
-- Table structure for table `produk_laku`
--

CREATE TABLE `produk_laku` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total_harga` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk_laku`
--

INSERT INTO `produk_laku` (`id`, `tanggal`, `nama`, `jumlah`, `harga`, `total_harga`) VALUES
(46, '2015-02-01', 'roti unibis', 2, 6000, 12000),
(47, '2015-02-02', 'makkkanan', 7, 12000, 84000),
(48, '2015-02-02', 'dji sam soe', 2, 15000, 30000),
(49, '2015-02-03', 'makkkanan', 1, 12000, 12000),
(50, '2015-02-01', 'tim tam', 2, 4000, 8000),
(51, '2015-02-02', 'mild', 2, 17000, 34000),
(52, '2015-02-03', 'magnum', 1, 18000, 18000),
(53, '2015-02-06', 'dji sam soe', 2, 19000, 38000),
(54, '2015-02-15', 'nu mild', 2, 19100, 38200),
(56, '2015-02-19', 'roti unibis', 1, 7000, 7000),
(57, '2015-01-14', 'roti unibis', 1, 7000, 7000),
(58, '2015-02-01', 'pulpen', 1, 3000, 3000),
(59, '2015-02-02', 'roti', 2, 3000, 6000),
(63, '2016-01-22', 'tic tac', 8, 4000, 32000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produk_beli`
--
ALTER TABLE `produk_beli`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `produk_laku`
--
ALTER TABLE `produk_laku`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `produk_beli`
--
ALTER TABLE `produk_beli`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `produk_laku`
--
ALTER TABLE `produk_laku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

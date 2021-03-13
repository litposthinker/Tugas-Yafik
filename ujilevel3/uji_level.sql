-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2021 at 03:58 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uji_level`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cekbarangterhapus` ()  BEGIN
SELECT * FROM
stockbarang WHERE IsDeleted = 1;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `CekPenjualan` (`barang` VARCHAR(20)) RETURNS VARCHAR(200) CHARSET utf8mb4 BEGIN
DECLARE stock int;
SELECT COUNT(*) INTO stock FROM orderbarang,stockbarang
WHERE orderbarang.barang_id = stockbarang.id 
AND stockbarang.nama = barang; 
IF(stock>1)THEN
RETURN 
CONCAT("Total penjualan ",barang," adalah ",stock," Buah");
ELSE
RETURN "Anda belum menjual satu pun dari barang ini";
END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `belibarang`
--

CREATE TABLE `belibarang` (
  `id` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `belibarang`
--

INSERT INTO `belibarang` (`id`, `jumlah_barang`, `total_harga`, `created_at`) VALUES
(557, 1, 1121000, '2021-03-13 01:16:20'),
(558, 3, 3504600, '2021-03-13 02:23:24'),
(559, 2, 930600, '2021-03-13 02:42:51'),
(560, 2, 1821600, '2021-03-13 02:43:18'),
(561, 1, 910800, '2021-03-13 02:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `orderbarang`
--

CREATE TABLE `orderbarang` (
  `id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `belibarang_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderbarang`
--

INSERT INTO `orderbarang` (`id`, `barang_id`, `belibarang_id`, `stock`, `created_at`) VALUES
(153, 44, 557, 1, '2021-03-13 01:16:20'),
(154, 44, 558, 3, '2021-03-13 02:23:24'),
(155, 66, 559, 1, '2021-03-13 02:42:51'),
(156, 43, 559, 1, '2021-03-13 02:42:51'),
(157, 43, 560, 2, '2021-03-13 02:43:18'),
(158, 43, 561, 1, '2021-03-13 02:43:26');

--
-- Triggers `orderbarang`
--
DELIMITER $$
CREATE TRIGGER `after_insert_databeli` AFTER INSERT ON `orderbarang` FOR EACH ROW BEGIN
	UPDATE stockbarang 
    SET stockbarang.stock = stockbarang.stock - new.stock WHERE stockbarang.id = new.barang_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hapusbarang` AFTER DELETE ON `orderbarang` FOR EACH ROW BEGIN
UPDATE stockbarang
SET
stockbarang.stock = stockbarang.stock + old.stock WHERE stockbarang.id = OLD.barang_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `stockbarang`
--

CREATE TABLE `stockbarang` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `IsDeleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stockbarang`
--

INSERT INTO `stockbarang` (`id`, `nama`, `harga`, `stock`, `gambar`, `IsDeleted`) VALUES
(43, 'Keychron K6', 900000, 31, 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//92/MTA-7773131/keychron_keychron_k6_hotswappable_white_backlight_plastic_frame_wired_-_wired_mechanical_keyboard_full04_nh88ele8.jpg', 0),
(44, 'Logitech G502', 1180000, 52, 'https://cdn.shopify.com/s/files/1/1295/3887/products/LogiG502LSWls_001_2400x.png?v=1590127566', 0),
(45, 'Lenovo Legion 7i', 37000000, 5, 'https://static.bhphoto.com/images/images1000x1000/1587080742_1548422.jpg\r\n', 0),
(46, 'Samsung Gaming Monitor 240Hz', 5600000, 36, 'https://images.samsung.com/is/image/samsung/id-curved-c27rg50-lc27rg50fqexxd-frontblack-178490748?$684_547_PNG$', 0),
(47, 'Nikon D3500', 6999000, 43, 'https://images-na.ssl-images-amazon.com/images/I/41x8G1EuPoL._AC_.jpg', 0),
(48, 'AMD Ryzen 9 3900X', 8500000, 0, 'https://cdn.shopify.com/s/files/1/0108/2553/1449/products/2_sq_1200x.jpg?v=1579246655', 0),
(49, 'ASUS ROG STRIX GeForce RTX 3090', 35000000, 199, 'https://image.coolblue.nl/max/500x500/products/1480934', 0),
(50, 'Wacom Cintiq 16', 33000000, 54, 'https://images-na.ssl-images-amazon.com/images/I/71hS-sYZusL._AC_SL1500_.jpg\r\n', 0),
(51, 'Logitech HD Pro Webcam C920', 1050000, 66, 'https://www.powerplanetonline.com/cdnassets/logitech_hd-_pro_webcam_c920_01_l.jpg', 0),
(52, 'NZXT H710i Matte Black Red', 2200000, 315, 'https://nzxt-site-media.s3-us-west-2.amazonaws.com/uploads/product_image/image/2718/large_6de3c192b42af400.png', 0),
(53, 'Elgato HD60 S ', 2800000, 52, 'https://images-na.ssl-images-amazon.com/images/I/51O6n4bQbUL._AC_SL1000_.jpg', 0),
(65, 'Cooler Master MasterAir', 789000, 114, 'https://ecs7.tokopedia.net/img/cache/700/product-1/2020/7/14/13780346/13780346_04faff62-c56e-4746-b476-9ed4fb88aaff_600_600', 0),
(66, 'MousePad', 20000, 42, 'https://id-test-11.slatic.net/p/f8b60c148670277e2e58814ef3d16e1b.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `belibarang`
--
ALTER TABLE `belibarang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderbarang`
--
ALTER TABLE `orderbarang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `belibarang_id` (`belibarang_id`);

--
-- Indexes for table `stockbarang`
--
ALTER TABLE `stockbarang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `belibarang`
--
ALTER TABLE `belibarang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=562;

--
-- AUTO_INCREMENT for table `orderbarang`
--
ALTER TABLE `orderbarang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `stockbarang`
--
ALTER TABLE `stockbarang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderbarang`
--
ALTER TABLE `orderbarang`
  ADD CONSTRAINT `orderbarang_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `stockbarang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderbarang_ibfk_2` FOREIGN KEY (`belibarang_id`) REFERENCES `belibarang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

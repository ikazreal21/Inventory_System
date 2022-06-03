-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2022 at 02:26 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_navitopia`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `CART_ID` int(11) NOT NULL,
  `PROD_IMAGE` varchar(200) NOT NULL,
  `CUSTOMER_NAME` varchar(200) NOT NULL,
  `PROD_NAME` varchar(200) NOT NULL,
  `PROD_PRICE` int(11) NOT NULL,
  `PROD_QUANT` int(200) NOT NULL,
  `PROD_DATE` date NOT NULL,
  `PROD_TOTAL` int(200) NOT NULL,
  `PROD_STATUS` varchar(200) NOT NULL,
  `Product_id` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`CART_ID`, `PROD_IMAGE`, `CUSTOMER_NAME`, `PROD_NAME`, `PROD_PRICE`, `PROD_QUANT`, `PROD_DATE`, `PROD_TOTAL`, `PROD_STATUS`, `Product_id`) VALUES
(11, '../inventory/img/BujMOvGk/old.jpg', 'alexisreobilo', 'Rainbow theme cake', 1000, 1, '2022-04-23', 1000, 'Cart', 0),
(15, 'cake2.jpg', 'pairat21', 'Large cake 2', 1000, 1, '2022-05-08', 1000, 'Cart', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_log`
--

CREATE TABLE `tbl_log` (
  `id` int(11) NOT NULL,
  `USER` varchar(100) NOT NULL,
  `ACTION` varchar(100) NOT NULL,
  `DATE` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_log`
--

INSERT INTO `tbl_log` (`id`, `USER`, `ACTION`, `DATE`) VALUES
(1, 'alexisreobilo', 'Logged In', '2021-11-29 18:52:11'),
(2, 'alexisreobilo', 'Logged In', '2021-11-29 18:52:28'),
(3, 'alexisreobilo', 'Logged In', '2021-11-29 18:53:17'),
(4, 'alexisreobilo', 'Logged In', '2021-11-29 18:54:34'),
(5, 'alexisreobilo', 'Logged In', '2021-11-29 18:57:10'),
(6, 'expzak', 'Logged In', '2022-03-10 14:18:02'),
(7, 'alexisreobilo', 'Logged In', '2022-03-10 14:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `Order_ID` int(11) NOT NULL,
  `Customer_Name` varchar(200) NOT NULL,
  `NumberofProd` int(11) NOT NULL,
  `ProdTotal` int(11) NOT NULL,
  `Order_Status` varchar(50) NOT NULL,
  `orderDate` date NOT NULL,
  `orderArray` varchar(2000) NOT NULL,
  `orderSerial` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`Order_ID`, `Customer_Name`, `NumberofProd`, `ProdTotal`, `Order_Status`, `orderDate`, `orderArray`, `orderSerial`) VALUES
(30, 'zaki21', 1, 1000, 'for_approval', '2022-06-02', '[\"40\"]', 'ACAFNRJR'),
(31, 'zaki21', 1, 1000, 'for_approval', '2022-06-02', '[\"40\"]', 'N4UW3VNU');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `PAYMENT_ID` int(200) NOT NULL,
  `CUSTOMER_EMAIL` varchar(200) NOT NULL,
  `PAYMENT_NAME` varchar(200) NOT NULL,
  `PAYMENT_TYPE` varchar(200) NOT NULL,
  `PAYMENT_GNUMER` varchar(11) NOT NULL,
  `PAYMENT_TOTAL` int(200) NOT NULL,
  `PAYMENT_DATE` date NOT NULL,
  `PAYMENT_STATUS` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`PAYMENT_ID`, `CUSTOMER_EMAIL`, `PAYMENT_NAME`, `PAYMENT_TYPE`, `PAYMENT_GNUMER`, `PAYMENT_TOTAL`, `PAYMENT_DATE`, `PAYMENT_STATUS`) VALUES
(1, 'milescasas@yahoo.com', 'Godwyn Casas', 'GCash', '2147483647', 450, '2021-12-08', 'Canceled'),
(2, 'milescasas@yahoo.com', 'Godwyn Casas', 'GCash', '2147483647', 450, '2021-12-08', 'Canceled'),
(3, 'milescasas@yahoo.com', 'Godwyn Casas', 'GCash', '2147483647', 450, '2021-12-08', 'Canceled'),
(4, 'milescasas@yahoo.com', 'Godwyn Casas', 'GCash', '2147483647', 450, '2021-12-08', 'Canceled'),
(5, 'milescasas@yahoo.com', 'Godwyn Casas', 'GCash', '2147483647', 450, '2021-12-08', 'Canceled'),
(6, 'milescasas@yahoo.com', 'Godwyn Casas', 'GCash', '2147483647', 450, '2021-12-08', 'Canceled'),
(7, 'milescasas@yahoo.com', 'Godwyn Casas', 'GCash', '2147483647', 1400, '2021-12-08', 'Canceled'),
(8, 'milescasas@yahoo.com', 'Godwyn Casas', 'GCash', '2147483647', 1400, '2021-12-09', 'Canceled'),
(9, 'milescasas@yahoo.com', 'Godwyn Casas', 'GCash', '9123456789', 1000, '2021-12-09', 'Canceled'),
(10, 'milescasas@yahoo.com', 'Godwyn Casas', 'GCash', '9123456789', 1000, '2021-12-09', 'Canceled'),
(11, 'milescasas@yahoo.com', 'Godwyn Casas', 'GCash', '9504001758', 1000, '2021-12-09', 'Canceled'),
(12, 'milescasas@yahoo.com', 'Godwyn Casas', 'GCash', '9504001758', 2000, '2021-12-09', 'Canceled');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `ID` int(5) NOT NULL,
  `PNAME` varchar(50) NOT NULL,
  `Pimage` varchar(200) NOT NULL,
  `PROD_DESC` varchar(255) NOT NULL,
  `PPRICE` int(11) NOT NULL,
  `PQUAN` int(11) NOT NULL,
  `PTOTAL` float NOT NULL,
  `PDATE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`ID`, `PNAME`, `Pimage`, `PROD_DESC`, `PPRICE`, `PQUAN`, `PTOTAL`, `PDATE`) VALUES
(40, 'TEST', '../inventory/img/bFzP6a7a/wp8377232-pointing-wallpapers.jpg', 'T', 500, 4, 3000, '2022-06-02'),
(41, 'Sample Product', '../inventory/img/195jvqp9/unnamed.jpg', 'Sample Description', 1000, 10, 10000, '2022-06-02');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `phonenumber` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `phonenumber`, `username`, `email`, `password`, `usertype`, `status`) VALUES
(1, 'Alexis', 'Reobilo', 9616241262, 'alexisreobilo', 'areobilo30@gmail.com', '123095', 'customer', 'active'),
(2, 'zaki', 'zaki', 111111111111, 'zaki21', 'soriano.zaki.1@gmail.com', 'zakizakizaki', 'customer', 'active'),
(3, 'pairat', 'pairat', 1111111111, 'pairat21', 'pairat@pairat.com', '2001210809', 'customer', 'active'),
(5, 'TEST', 'TEST2', 11111111111111, 'TEST3', 'zakisoriano21@gmail.com', 'zakizakizaki', 'admin', 'active'),
(6, 'test', 'test1', 2222222222222, 'zakiadmin', 'joaquinzaki21@gmail.com', 'zakizakizaki', 'employee', 'active'),
(7, 'Test22', 'test22', 0, 'email test', 'lejedd11@gmail.com', 'zakizakizaki', 'customer', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`CART_ID`);

--
-- Indexes for table `tbl_log`
--
ALTER TABLE `tbl_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`Order_ID`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`PAYMENT_ID`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `CART_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_log`
--
ALTER TABLE `tbl_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `Order_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `PAYMENT_ID` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

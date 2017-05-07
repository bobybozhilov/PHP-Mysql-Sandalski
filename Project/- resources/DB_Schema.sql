-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2017 at 08:45 PM
-- Server version: 5.7.17-log
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sandalski`
--
CREATE DATABASE IF NOT EXISTS `sandalski` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `sandalski`;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `customer_type_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='таблица съдържаща информация за клиентите';

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_type_id`) VALUES
(1, 'Иван Иванов', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers_items`
--

DROP TABLE IF EXISTS `customers_items`;
CREATE TABLE `customers_items` (
  `ci_id` int(11) NOT NULL,
  `ci_customer_id` int(11) NOT NULL COMMENT 'id на клиента',
  `ci_item_id` int(11) NOT NULL COMMENT 'id на артикула',
  `ci_quantity` int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'количество от конкретния артикул',
  `ci_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'дата на добавяне',
  `ci_comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'коментар на поръчката',
  `ci_last_edit_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'момент на последна промяна'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(60) NOT NULL COMMENT 'име на артикула',
  `item_price` decimal(10,0) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'цена на артикула',
  `item_description` text COMMENT 'описание на артикула'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE `types` (
  `type_id` int(4) NOT NULL,
  `type_name` varchar(120) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='таблица, съдържаща трите типа клиенти';

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `type_name`) VALUES
(1, 'Клиенти, които авансово са заплатили всичките заявени продукти'),
(2, 'Клиенти, които с акредитив са заплатили само 15% от заявените продукти'),
(3, 'Клиенти, които ще получат заявените продукти на консигнация');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `customer_id` (`customer_id`,`customer_type_id`),
  ADD KEY `customer_type_id` (`customer_type_id`),
  ADD KEY `customer_id_2` (`customer_id`,`customer_name`,`customer_type_id`);

--
-- Indexes for table `customers_items`
--
ALTER TABLE `customers_items`
  ADD PRIMARY KEY (`ci_id`),
  ADD KEY `ci_customer_id` (`ci_customer_id`,`ci_item_id`),
  ADD KEY `ci_item_id` (`ci_item_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `item_id` (`item_id`,`item_name`,`item_price`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`type_id`),
  ADD KEY `type_id` (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customers_items`
--
ALTER TABLE `customers_items`
  MODIFY `ci_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `type_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`customer_type_id`) REFERENCES `types` (`type_id`);

--
-- Constraints for table `customers_items`
--
ALTER TABLE `customers_items`
  ADD CONSTRAINT `customers_items_ibfk_1` FOREIGN KEY (`ci_customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customers_items_ibfk_2` FOREIGN KEY (`ci_item_id`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

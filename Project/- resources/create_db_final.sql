-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2017 at 09:19 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `customer_type_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='таблица съдържаща информация за клиентите';

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_type_id`) VALUES
(1, 'Иван Иванов', 1),
(2, 'Гергана Петрова', 1),
(3, 'Иван Димитров', 2),
(4, 'Боян Божилов', 3),
(5, 'Джони Уокър', 1),
(6, 'Майкъл Джексън', 3),
(7, 'Александър Владимиров', 1),
(8, 'Владимир Путин', 1),
(9, 'Ким Ченг Ун', 3),
(10, 'Димитър Рачков', 2),
(11, 'Малин Малинов', 3),
(12, 'Ивет Маринова', 1),
(13, 'Димитър Бербатов', 2),
(14, 'Алексей Милушев', 2),
(15, 'Илия Димитров', 1),
(16, 'Августин Кишишев', 2),
(17, 'гошо петров', 2),
(19, 'Боян Божилов', 3),
(20, 'Джони Уокър', 1),
(21, 'Майкъл Джексън', 3),
(22, 'Александър Владимиров', 1),
(23, 'Владимир Путин', 1),
(24, 'Ким Ченг Ун', 3),
(25, 'Димитър Рачков', 2),
(26, 'Малин Малинов', 3),
(27, 'Ивет Лалова', 1),
(28, 'Димитър Бербатов', 2),
(29, 'Алексей Милушев', 2),
(30, 'Илия Димитров', 1),
(31, 'Августин Кишишев', 2),
(32, 'Янко Петров', 2),
(33, 'Теодор Владимиров', 1),
(34, 'Янко Петров', 2),
(35, 'Теодор Владимиров', 1),
(37, 'Явор Янакиев', 1),
(38, 'Петър Петров', 3);

-- --------------------------------------------------------

--
-- Table structure for table `customers_items`
--

CREATE TABLE `customers_items` (
  `ci_id` int(11) NOT NULL,
  `ci_customer_id` int(11) NOT NULL COMMENT 'id на клиента',
  `ci_item_id` int(11) NOT NULL COMMENT 'id на артикула',
  `ci_quantity` int(10) UNSIGNED NOT NULL DEFAULT '1' COMMENT 'количество от конкретния артикул',
  `ci_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'дата на добавяне',
  `ci_comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT 'коментар на поръчката',
  `ci_last_edit_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'момент на последна промяна'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers_items`
--

INSERT INTO `customers_items` (`ci_id`, `ci_customer_id`, `ci_item_id`, `ci_quantity`, `ci_date`, `ci_comment`, `ci_last_edit_time`) VALUES
(1, 5, 1, 1, '2017-05-11 22:10:48', NULL, '2017-05-11 22:10:48'),
(2, 8, 3, 3, '2017-05-10 23:15:13', NULL, '2017-05-11 23:15:13'),
(4, 7, 3, 2, '2017-05-12 03:32:53', NULL, '2017-05-12 03:32:53'),
(6, 3, 1, 1, '2017-05-12 03:34:12', NULL, '2017-05-12 03:34:12'),
(7, 4, 3, 2, '2017-05-12 03:58:20', NULL, '2017-05-12 03:58:20'),
(8, 3, 1, 1, '2017-05-19 10:17:31', NULL, '2017-05-19 10:17:31'),
(9, 3, 3, 2, '2017-05-19 10:17:31', NULL, '2017-05-19 10:17:31');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(60) NOT NULL COMMENT 'име на артикула',
  `item_price` decimal(10,0) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'цена на артикула',
  `item_description` text COMMENT 'описание на артикула'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_price`, `item_description`) VALUES
(1, 'Хидравлична помпа хидро1000', '10000', 'Хидравлична помпа хидро1000 нисък клас          lol afklsdajfkl;asdf\r\nsdafkasdfjklasdjgklasd\';\r\ndsfasdfjkasd;fkasdl\';fk\r\nasdjgkljf\r\nasdkf\r\nasdglfjasdklfjkasdljfklsjg;sd\r\nasd;\r\nfjkasdjfklasdjflasdjkfsdf'),
(3, 'Хидравлична помпа хидро2000', '20000', 'lele');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

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
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `customers_items`
--
ALTER TABLE `customers_items`
  MODIFY `ci_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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

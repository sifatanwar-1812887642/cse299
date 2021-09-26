-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2018 at 03:41 AM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orderfood`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `foodId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `orderTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`foodId`, `customerId`, `orderTime`, `quantity`) VALUES
(3, 2, '2018-02-04 06:11:39', 2);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `phone`, `email`, `pass`) VALUES
(1, 'nadim', 'mohakhali,dhaka', 1689284587, 'shakilnadim@gmail.com', '$2y$10$YkDXMYu/2V1Z9wQjBVsEk.Nf2OEVy/Er2Lawp9n/ZkNDADXQa6ave'),
(2, 'Israt Jerin Bristy', 'banasree', 1685191968, 'ijerin111@gmail.com', '$2y$10$oNiYuTRVy3ivmR/7/ZGC3eaa73lndwyjdxQS4XkE1jD08FVNv/vB.');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `ingredients` varchar(255) NOT NULL,
  `restaurantId` int(11) DEFAULT NULL,
  `foodno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `name`, `price`, `ingredients`, `restaurantId`, `foodno`) VALUES
(1, 'set menu', 250, 'rice, chicken, vegetables', 1, 1),
(2, 'bbq burger beef', 180, 'beef patty, bbq sauce, cheese', 1, 2),
(3, 'cappuccino', 250, 'coffee beans, sugar, milk', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `restaurantid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `orderdesc` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deliveryStat` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `restaurantid`, `userid`, `orderdesc`, `time`, `deliveryStat`) VALUES
(1, 1, 1, '1. set menu <br>qty: 1<br>price: 250 tk<br><br>2. bbq burger beef <br>qty: 2<br>price: 360 tk<br><br>Total: 610', '2018-01-31 15:36:08', 0),
(2, 2, 1, '1. cappuccino <br>qty: 5<br>price: 1250 tk<br><br>Total: 1250', '2018-01-31 15:39:39', 0),
(3, 2, 1, '1. cappuccino <br>qty: 5<br>price: 1250 tk<br><br>Total: 1250', '2018-01-31 15:40:26', 0),
(4, 1, 1, '1. set menu <br>qty: 1<br>price: 250 tk<br><br>Total: 250', '2018-02-02 04:59:48', 0),
(5, 1, 1, '1. set menu <br>qty: 1<br>price: 250 tk<br><br>Total: 250', '2018-02-04 06:09:13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `pass` text NOT NULL,
  `address` varchar(100) NOT NULL,
  `pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `email`, `phone`, `pass`, `address`, `pic`) VALUES
(1, 'test', 'test@gmail.com', 1689284587, '$2y$10$sL5.yIeEqA284AG1hrf2muLefiSjclyT.I2BG64hIvjCBwYDa/3eO', 'address', '5a6f4ffc0bdb1.jpg'),
(2, 'starbucks', 'starbucks@gmail.com', 1701864149, '$2y$10$pjF6f25hl4hIvlB4BKNEk.pe0024O2Fo1UkOHKoVopwE/lOeDoy5.', 'banani, dhaka', '5a6f5ee478363.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `name` varchar(50) NOT NULL,
  `date` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`name`, `date`) VALUES
('shakil', '00:00:00'),
('nadim', '19:22:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`foodId`,`customerId`),
  ADD KEY `orders_ibfk_2` (`customerId`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `food_ibfk_1` (`restaurantId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`foodId`) REFERENCES `food` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`customerId`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`restaurantId`) REFERENCES `restaurants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
  
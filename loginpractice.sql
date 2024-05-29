-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2023 at 01:10 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginpractice`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(10) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(20) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `order_id` int(50) NOT NULL,
  `orderedby` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `phone_no` bigint(50) NOT NULL,
  `payment_mode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `product_name` varchar(20) NOT NULL,
  `product_description` varchar(225) NOT NULL,
  `product_price` decimal(65,2) NOT NULL,
  `product_image` varchar(225) NOT NULL,
  `product_stock` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `product_name`, `product_description`, `product_price`, `product_image`, `product_stock`) VALUES
(50, 'Basic Tshirt', 'introducing our Mens Classic Tee  a versatile wardrobe essential. Crafted with premium cotton for comfort and durability, this tshirt offers a timeless fit that complements any style.', '1600.00', 'aaa.jpg', 179),
(51, 'Beige Tshirt', 'introducing our Mens Classic Tee a versatile wardrobe essential. Crafted with premium cotton for comfort and durability, this tshirt offers a timeless fit that complements any style', '1600.00', 'a.jpg', 200),
(52, 'White Tattooed Tshir', 'introducing our Mens Classic tattooed Tee a versatile wardrobe essential with a tattooed design. Crafted with premium cotton for comfort and durability, this tshirt offers a timeless fit that complements any style', '2000.00', 'b.jpg', 200),
(53, 'Green Basic Shirt', 'Introducing our Green Shirt,  a stylish wardrobe staple that seamlessly blends comfort and fashion. Crafted with care, this shirt boasts a classic design in a refreshing green hue, adding a touch of vibrancy to your look.', '1700.00', 'c.jpg', 200),
(54, 'Beige and Black comf', 'Introducing our comfy Shirt, a stylish wardrobe staple that seamlessly blends comfort and fashion. Crafted with care, this shirt boasts a classic design in a refreshing Beige and black hue, adding a touch of vibrancy to your ', '1650.00', 'd.jpg', 100),
(55, 'Tattooed Shirt', 'Introducing our tattooed Shirt, a stylish wardrobe staple that seamlessly blends comfort and fashion. Crafted with care, this shirt boasts a classic design, adding a touch of vibrancy to your look.', '2200.00', 'e.jpg', 120),
(56, 'Black Tattooed Tshir', 'Introducing our Black Tshirt, a stylish wardrobe staple that seamlessly blends comfort and fashion. Crafted with care, this shirt boasts a classic design in a refreshing black hue, adding a touch of vibrancy to your look.', '1600.00', 'f.jpg', 200),
(57, 'Alpha Beige Tshirt', 'Introducing our Alpha Beige Tshirt, a stylish wardrobe staple that seamlessly blends comfort and fashion. Crafted with care, this shirt boasts a classic design in a refreshing Beige hue, adding a touch of vibrancy to your loo', '2000.00', 'g.jpg', 199),
(58, 'Tattooed Sweatshirt', 'Introducing our Alpha Beige Sweatshirt, a stylish wardrobe staple that seamlessly blends comfort and fashion. Crafted with care, this shirt boasts a classic design in a refreshing Beige hue, adding a touch of vibrancy to your', '2000.00', 'h.jpg', 200),
(59, 'Maroon Basic Tshirt', 'Introducing our basic Maroon Tshirt, a stylish wardrobe staple that seamlessly blends comfort and fashion. Crafted with care, this shirt boasts a classic design adding a touch of vibrancy to your look.', '1600.00', 'j.jpg', 200),
(60, 'Grey Stylish Tshirt', 'Introducing our grey Tshirt, a stylish wardrobe staple that seamlessly blends comfort and fashion. Crafted with care, this shirt boasts a classic design, adding a touch of vibrancy to your look.', '1750.00', 'k.jpg', 198),
(61, 'Deep Blue Pants', '\r\nIntroducing our Pants, the perfect blend of style and comfort. Tailored for a modern look, these high-quality pants are versatile for any occasion.', '1800.00', 'p.jpg', 200),
(62, 'Grey Pants', '\r\nIntroducing our pants the perfect blend of style and comfort. Tailored for a modern look, these high quality pants are versatile for any occasion.', '1800.00', 'q.jpg', 200),
(63, 'Black Pants', '\r\nIntroducing our pants the perfect blend of style and comfort. Tailored for a modern look, these high quality pants are versatile for any occasion.', '2000.00', 'r.jpg', 200),
(64, 'White formal pants', '\r\nIntroducing our formal pants the perfect blend of style and comfort. Tailored for a modern look, these high quality pants are for formal occasion.', '2000.00', 's.jpg', 200),
(65, 'Varsity Jacket', '\r\nMeet our Varsity Jacket, a blend of classic style and modern cool. Iconic design, premium materials, and timeless appeal. Elevate your look effortlessly.', '4000.00', 't.jpg', 200);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `uid` int(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(225) NOT NULL,
  `phone` bigint(10) NOT NULL,
  `password` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`uid`, `username`, `fname`, `lname`, `email`, `phone`, `password`, `address`) VALUES
(38, 'Shushanta', 'Shushanta', 'Dhungana', 'shushantadhungana0@gmail.com', 9865062545, 'y2u2j224', 'Boudha'),
(39, 'Shu', 'Shushanta', 'Dhungana', 's@gmail.com', 9865062545, 'y2u2j224', 'Ramhiti'),
(41, 'sanjayk', 'sanjay', 'khadka', 'sanjay1khadka@gmail.com', 9861497286, 'password', 'golfutar'),
(42, 'nischal', 'Nischal ', 'Dahal', 'nischaldahal@tuicms.edu.np', 9865062545, 'nischal10', 'nischaldahal@tuicms.edu.np');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `uid` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

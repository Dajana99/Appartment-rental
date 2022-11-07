-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 09, 2021 at 01:42 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appartment_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'Beograd'),
(2, 'Kragujevac'),
(3, 'Kraljevo'),
(4, 'Nis'),
(5, 'Subotica'),
(6, 'Cacak'),
(7, 'Bor'),
(8, 'Sokobanja'),
(9, 'Vrnjacka Banja');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `offer_name` varchar(50) NOT NULL,
  `offer_type` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `room_number` int(11) NOT NULL,
  `people_number` int(11) NOT NULL,
  `parking` int(11) NOT NULL,
  `internet` int(11) NOT NULL,
  `smoking_allowed` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`id`, `seller_id`, `offer_name`, `offer_type`, `city_id`, `room_number`, `people_number`, `parking`, `internet`, `smoking_allowed`, `description`, `price`) VALUES
(1, 2, 'Privatna kuca 1', 0, 1, 4, 5, 1, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis accumsan magna ut lacus porttitor feugiat. Integer in augue ante. Sed varius, neque eget maximus rutrum, nisi sem dignissim eros, id imperdiet dui massa non nulla. Donec pulvinar feugiat lorem a hendrerit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In faucibus dolor in diam auctor malesuada. Nunc vel rhoncus elit. Aliquam iaculis libero quis lorem venenatis, et hendrerit lorem fringilla. Praesent eu facilisis felis, at maximus urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae', 1400),
(3, 2, 'Privatna kuca 1', 0, 1, 4, 5, 0, 0, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis accumsan magna ut lacus porttitor feugiat. Integer in augue ante. Sed varius, neque eget maximus rutrum, nisi sem dignissim eros, id imperdiet dui massa non nulla. Donec pulvinar feugiat lorem a hendrerit. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In faucibus dolor in diam auctor malesuada. Nunc vel rhoncus elit. Aliquam iaculis libero quis lorem venenatis, et hendrerit lorem fringilla. Praesent eu facilisis felis, at maximus urna. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae', 2500),
(4, 4, 'Kuca Nis', 0, 4, 5, 8, 1, 1, 0, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eget purus ex. Nullam ut est libero. Vivamus fermentum odio enim, ut feugiat velit eleifend ut. Nullam nec tincidunt mi. Nam quis commodo odio. Ut posuere in metus sed viverra. Morbi lacinia arcu id mauris ultrices, quis bibendum magna cursus. Morbi fermentum at justo nec consectetur. Fusce maximus enim ut arcu cursus finibus. Nam metus ante, luctus nec urna ut, posuere iaculis odio.', 7500),
(5, 4, 'Stan Kraljevo', 1, 3, 2, 1, 0, 0, 1, 'Nam egestas augue vel leo congue gravida. Donec ultrices consectetur nisi eu auctor. In sem massa, facilisis a nibh dignissim, laoreet iaculis lectus. Aenean bibendum vel erat eget lacinia. Suspendisse in est lorem. Aenean eu libero nec ex pulvinar pharetra quis non erat. Proin id tristique sapien. Fusce tempor auctor mauris ac consequat. Donec maximus pharetra lorem quis rhoncus. Nulla ut tincidunt sapien, at sagittis libero. Nullam laoreet sodales mi et tempus. Sed vitae malesuada sapien.', 3000),
(6, 4, 'Stan Beograd Vracar', 1, 1, 2, 2, 1, 1, 0, 'Donec id hendrerit neque. Nullam semper posuere elit, sagittis aliquam turpis ultrices eget. Maecenas porta vestibulum dui, congue gravida ante pellentesque non. Quisque pretium ac ipsum ac condimentum. Suspendisse luctus efficitur blandit. Integer aliquet magna leo, sit amet blandit nibh lacinia euismod. In a lectus in sem tincidunt sodales. Cras dignissim enim sed purus auctor, sit amet iaculis velit bibendum. Proin vel convallis quam.', 4500);

-- --------------------------------------------------------

--
-- Table structure for table `offer_images`
--

CREATE TABLE `offer_images` (
  `id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offer_images`
--

INSERT INTO `offer_images` (`id`, `offer_id`, `title`) VALUES
(3, 1, 'neonbrand-kdwahpWYfQo-unsplash.jpg'),
(8, 3, 'webaliser-_TPTXZd9mOo-unsplash.jpg'),
(9, 3, 'kara-eads-L7EwHkq1B2s-unsplash.jpg'),
(10, 3, 'jarek-ceborski-jn7uVeCdf6U-unsplash.jpg'),
(11, 4, 'todd-kent-178j8tJrNlc-unsplash.jpg'),
(12, 4, 'pexels-pixabay-534151.jpg'),
(13, 4, 'pexels-vecislavas-popa-1643383.jpg'),
(14, 5, 'centar---vracar-id40400-5425636284474-71794367361.jpg'),
(15, 5, 'centar---vracar-id40400-5425636284474-71794367362.jpg'),
(16, 5, 'centar---vracar-id40400-5425636284474-71794367363.jpg'),
(17, 5, 'centar---vracar-id40400-5425636284474-71794367366.jpg'),
(18, 6, '414bfb90-79f3-4a0c-b26f-82060cc3ce28.webp'),
(19, 6, '1660959d-6199-4dc0-a13a-624cdc679ad8.webp'),
(20, 6, '258cbaf2-751e-46c6-813f-64e12ae4f24a.webp'),
(21, 6, '70d03aeb-2810-4319-8888-1da59db6f5b1.webp');

-- --------------------------------------------------------

--
-- Table structure for table `offer_reservations`
--

CREATE TABLE `offer_reservations` (
  `id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `payment` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offer_reservations`
--

INSERT INTO `offer_reservations` (`id`, `offer_id`, `user_id`, `start_date`, `end_date`, `payment`, `status`) VALUES
(7, 3, 6, '2021-02-04', '2021-02-06', 0, 0),
(8, 5, 6, '2021-02-11', '2021-02-17', 1, 0),
(9, 4, 7, '2021-02-11', '2021-02-18', 0, 0),
(10, 6, 7, '2021-02-18', '2021-02-25', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `offer_reviews`
--

CREATE TABLE `offer_reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `offer_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `review` text NOT NULL,
  `date_created` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offer_reviews`
--

INSERT INTO `offer_reviews` (`id`, `user_id`, `offer_id`, `rate`, `review`, `date_created`) VALUES
(2, 3, 1, 3, 'Okej je', '2021-02-07'),
(5, 6, 3, 5, 'Sjajna kuca', '2021-02-09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `role`) VALUES
(2, 'Pera', 'Pericic', 'pera@pericic.rs', 'peraprodavac', 'bf676ed1364b5857fba69b5623c81b64', 'subadmin'),
(3, 'Nalog', '2', 'nalog2@test.rs', 'nalog2', '1d2bcc3b69cf0a5097468cbbfeac9854', 'user'),
(4, 'Mika', 'Prodavac', 'mika@prodavac.rs', 'mikaprodavac', 'e471a891c22fb1b5b722f57bed71de32', 'subadmin'),
(5, 'Main', 'Admin', 'admin@main.rs', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(6, 'Milica', 'Stevic', 'milicastevic@gmail.com', 'milicastevic', 'c1cf2d1d7d45ce288a19baf8e4bbcb8f', 'user'),
(7, 'Dajana', 'Cuzovic', 'dajanacuzovic@gmail.com', 'dajanacuzovic', '4f5d59793e43dbdfb1bff92124489717', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `offer_images`
--
ALTER TABLE `offer_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_id` (`offer_id`);

--
-- Indexes for table `offer_reservations`
--
ALTER TABLE `offer_reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_id` (`offer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `offer_reviews`
--
ALTER TABLE `offer_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `offer_id` (`offer_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `offer_images`
--
ALTER TABLE `offer_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `offer_reservations`
--
ALTER TABLE `offer_reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `offer_reviews`
--
ALTER TABLE `offer_reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `offers_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offer_images`
--
ALTER TABLE `offer_images`
  ADD CONSTRAINT `offer_images_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offer_reservations`
--
ALTER TABLE `offer_reservations`
  ADD CONSTRAINT `offer_reservations_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offer_reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `offer_reviews`
--
ALTER TABLE `offer_reviews`
  ADD CONSTRAINT `offer_reviews_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `offer_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

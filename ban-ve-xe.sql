-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2020 at 04:37 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ban-ve-xe`
--

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `image`, `title`, `content`) VALUES
(2, 'public/images/5e81e4cc1793c-ten-nhan-vat-game-audition-5.jpg', 'quan', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic, dolorum?'),
(3, 'public/images/5e81dd25dcc7b-Best-PC-Games-GTAV.jpg', 'Lorem, ipsum dolor.', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic, dolorum?'),
(4, 'public/images/5e81e56903319-INSIDE-1.jpg', 'Lorem, ipsum dolor.', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic, dolorum?'),
(7, 'public/images/5e8300ba4d995-5e7d871aa732a-error_bg.jpg', 'Lorem, ipsum dolor.', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic, dolorum?'),
(10, 'public/images/5e89d2d31a0b2-Selection_004.png', 'Nguyễn hồng Quân', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic, dolorum?');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `unit_price` varchar(255) NOT NULL,
  `seat_number` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `status`) VALUES
(1, 'Người Dùng - User', 1),
(2, 'Quản trị - Staff', 1),
(3, 'Quản trị - Manager', 0);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `distance` varchar(100) NOT NULL,
  `estimate_time` time NOT NULL,
  `begin_point` varchar(255) NOT NULL,
  `end_point` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `distance`, `estimate_time`, `begin_point`, `end_point`) VALUES
(1, '160', '04:00:00', 'Mỹ Đình', 'Nam Định'),
(2, '160', '04:20:00', 'Hải Hậu', 'Giáp Bát'),
(4, '1434', '04:00:00', 'Mỹ Đình', 'Hải Hậu'),
(5, '200', '04:00:00', 'Mỹ Đình A', 'Hải Hậu A'),
(6, '160', '04:00:00', 'Mỹ Đình B', 'Bx hải hậu'),
(7, '160', '04:00:00', 'Mỹ Đình BABC', 'Bx hải hậu ABC'),
(8, '160', '04:00:00', 'Mỹ Đình c', 'Nam Định a');

-- --------------------------------------------------------

--
-- Table structure for table `route_schedules`
--

CREATE TABLE `route_schedules` (
  `id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `route_schedules`
--

INSERT INTO `route_schedules` (`id`, `route_id`, `vehicle_id`, `price`, `start_time`, `end_time`) VALUES
(8, 1, 1, '120000', '03/07/2020 9:30 AM', '03/07/2020 12:30 PM'),
(9, 2, 1, '80000', '03/08/2020 9:46 AM', '03/10/2020 12:45 PM'),
(10, 5, 7, '120000', '04/05/2020 4:15 PM', '04/05/2020 8:15 PM'),
(11, 1, 1, '110000', '04/05/2020 2:18 PM', '04/05/2020 4:18 PM');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `role_id` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone_number`, `role_id`) VALUES
(2, 'ThienTH', 'thienth@gmail.com', '$2y$10$4ijdV/Z4EA7fLZRnYGmhMeLo9.a7wgyBpCap1V5SjPKSTenSDTSFa', '123456789', 3),
(3, 'Hồng Quân', 'helgrindxxx@gmail.com', '$2y$10$/9RCcuWqFwwH1eRgLbg3ue5a/7n2NPHOc0oPc9QYMoxOn6meQSWge', '0914946200', 3),
(8, 'Sơn', 'son@gmail.com', '$2y$10$I5VitogA/1kBqDfnrhBsSO/92xwuvHqm.MXDbwk7sQ.ZvgQR7BGuC', '1231232132', 1),
(9, 'Quan Nguyen', 'quannh@gmail.com', '$2y$10$H9SQOX6AENgrDQkLfYVIEua.SqW.2qU1KezZAVgQSG7P8lZqQSkTW', '0123456789', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `plate_number` varchar(100) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `type_id`, `plate_number`, `avatar`) VALUES
(1, 1, '29T9-999.99', 'public/images/5e8de08cd58e4-Nơi_này_có_anh_-_Single_Cover.jpg'),
(6, 1, '18H1-888.88', NULL),
(7, 6, '29G9-666.00', 'public/images/5e8d9aa20f82c-mbuntu-1.jpg'),
(13, 2, '29G9-555.55', 'public/images/5e8d96742fdbb-maxresdefault.jpg'),
(14, 2, '29G9-555.00', 'public/images/5e8d975562ab4-mbuntu-2.jpg'),
(15, 6, '29T9-999.77', 'public/images/5e8d99b1d7109-marian-kroell-A-5aEufc0j4-unsplash.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

CREATE TABLE `vehicle_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `seat` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`id`, `name`, `status`, `seat`) VALUES
(1, 'Xe Bus 2 tầng', 0, 9),
(2, 'Xe Limousine', 0, 23),
(3, 'Xe cút kít', 1, 14),
(6, 'Xe Công lý 19 bánh', 0, 9),
(12, 'Xe Công lý 18 bánh', 0, 9),
(13, 'Xe Công lý 11 bánh', 0, 11);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`) USING BTREE,
  ADD KEY `schedule_id` (`schedule_id`) USING BTREE;

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route_schedules`
--
ALTER TABLE `route_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `route_id` (`route_id`) USING BTREE,
  ADD KEY `vehicle_id` (`vehicle_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`) USING BTREE;

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_id` (`type_id`) USING BTREE;

--
-- Indexes for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `route_schedules`
--
ALTER TABLE `route_schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`schedule_id`) REFERENCES `route_schedules` (`id`);

--
-- Constraints for table `route_schedules`
--
ALTER TABLE `route_schedules`
  ADD CONSTRAINT `route_schedules_ibfk_1` FOREIGN KEY (`route_id`) REFERENCES `routes` (`id`),
  ADD CONSTRAINT `route_schedules_ibfk_2` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `vehicle_types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

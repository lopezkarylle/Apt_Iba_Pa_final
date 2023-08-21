-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2023 at 05:39 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apt_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `apt_application_requests`
--

CREATE TABLE `apt_application_requests` (
  `application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apt_appointments`
--

CREATE TABLE `apt_appointments` (
  `appointment_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apt_bookmarks`
--

CREATE TABLE `apt_bookmarks` (
  `bookmark_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apt_password_reset_tokens`
--

CREATE TABLE `apt_password_reset_tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apt_properties`
--

CREATE TABLE `apt_properties` (
  `property_id` int(11) NOT NULL,
  `property_type` varchar(255) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `landlord_id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_properties`
--

INSERT INTO `apt_properties` (`property_id`, `property_type`, `property_name`, `landlord_id`, `status`) VALUES
(20, 'Dormitory', 'Sample', 26, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_property_amenities`
--

CREATE TABLE `apt_property_amenities` (
  `amenity_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `amenity_name` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_property_amenities`
--

INSERT INTO `apt_property_amenities` (`amenity_id`, `property_id`, `amenity_name`, `status`) VALUES
(32, 20, 'wifi,parking', 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_property_details`
--

CREATE TABLE `apt_property_details` (
  `property_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `total_floors` int(20) NOT NULL,
  `total_rooms` int(3) NOT NULL,
  `lowest_rate` float NOT NULL,
  `reservation_fee` float NOT NULL,
  `advance_deposit` float NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_property_details`
--

INSERT INTO `apt_property_details` (`property_id`, `description`, `total_floors`, `total_rooms`, `lowest_rate`, `reservation_fee`, `advance_deposit`, `status`) VALUES
(20, 'relapse muna', 12, 44, 2222, 3000, 3000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_property_images`
--

CREATE TABLE `apt_property_images` (
  `image_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apt_property_locations`
--

CREATE TABLE `apt_property_locations` (
  `property_id` int(11) NOT NULL,
  `property_number` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `postal_code` varchar(5) DEFAULT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_property_locations`
--

INSERT INTO `apt_property_locations` (`property_id`, `property_number`, `street`, `barangay`, `city`, `province`, `region`, `postal_code`, `latitude`, `longitude`, `status`) VALUES
(20, '12', 'Street', 'Cuayan', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '1234', '15.145113074763598', '120.5950306751359', 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_property_rules`
--

CREATE TABLE `apt_property_rules` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `short_term` int(1) NOT NULL,
  `min_weeks` int(2) NOT NULL,
  `mix_gender` int(1) NOT NULL,
  `curfew` int(1) NOT NULL,
  `from_curfew` varchar(255) NOT NULL,
  `to_curfew` varchar(255) NOT NULL,
  `cooking` int(1) NOT NULL,
  `pets` int(1) NOT NULL,
  `visitors` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_property_rules`
--

INSERT INTO `apt_property_rules` (`id`, `property_id`, `short_term`, `min_weeks`, `mix_gender`, `curfew`, `from_curfew`, `to_curfew`, `cooking`, `pets`, `visitors`, `status`) VALUES
(8, 20, 1, 2, 1, 1, '8pm', '7am', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_reservations`
--

CREATE TABLE `apt_reservations` (
  `reservation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apt_reviews`
--

CREATE TABLE `apt_reviews` (
  `review_id` int(11) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `description` text NOT NULL,
  `review_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apt_rooms`
--

CREATE TABLE `apt_rooms` (
  `room_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `total_beds` int(11) NOT NULL,
  `occupied_beds` int(11) NOT NULL,
  `furnished_type` varchar(255) NOT NULL,
  `monthly_rent` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_rooms`
--

INSERT INTO `apt_rooms` (`room_id`, `property_id`, `total_beds`, `occupied_beds`, `furnished_type`, `monthly_rent`, `status`) VALUES
(9, 20, 2, 0, 'Furnished', '2222', 1),
(10, 20, 1, 0, 'Semi-furnished', '1111', 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_room_amenities`
--

CREATE TABLE `apt_room_amenities` (
  `amenity_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `amenity_name` text NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_room_amenities`
--

INSERT INTO `apt_room_amenities` (`amenity_id`, `room_id`, `amenity_name`, `status`) VALUES
(11, 9, 'aircon,cushion', 1),
(12, 10, 'aircon,cushion', 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_unavailable_slots`
--

CREATE TABLE `apt_unavailable_slots` (
  `slot_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apt_users`
--

CREATE TABLE `apt_users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_users`
--

INSERT INTO `apt_users` (`user_id`, `email`, `password`, `salt`, `status`) VALUES
(20, 'yabutmicoh@apt.com', 'a93d18186b74e8aac9932cb98f78a1c2ef0536f2b754fe20c226ea3911e4f6e8', 'c0590f51183b48df8b17648efcd69f09', 1),
(21, 'tardeoada@apt.com', 'aa86588497b777d578a36768fac574e00e35d38368d7dd9d5308a9b773a3be4f', '7f02a1affaa4cc17e5e7e14f4a5c943e', 1),
(22, 'admin@apt.com', '1ff54cf4ca397c97914108bbc01ce3a1ab3bd58ae92dfe7fce19778e420366fa', '33ea6d51bee39462274b30ab71aa94db', 1),
(23, 'echondavid@apt.com', '72219ced0d93bd74ea5630e0644d797eb70b84cfc9ea2e410a8c2a7317285383', 'adc98a3581624b6ffa2b29016d87e998', 0),
(24, 'limarnold@apt.com', '2fcafcd6928ab375940827e117b79c5414ea6b9f27cdf74b12a435b832ef41bc', '316707b7c2213cb55c79fe7fedc471eb', 0),
(26, 'limarnoldd@apt.com', '32521b6f00cb920d539c1421b0cee3b805c35fdd7f677191fa68b5ca811da4ac', 'c867b7dcd51df865a0af210243880aba', 1),
(28, 'myouiminaa@apt.com', '2125be274efb1b7adbf468d3e2a490463663cfb32166c8098ed92592929e2025', '93a91a3878c90d605b26a01837892d96', 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_user_images`
--

CREATE TABLE `apt_user_images` (
  `image_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_user_images`
--

INSERT INTO `apt_user_images` (`image_id`, `user_id`, `image_name`, `image_path`, `status`) VALUES
(1, 26, '9a1bac285025a470c1ae1e04e83febe5.jpg', '../../resources/images/landlords/', 1),
(3, 28, 'FbEursTagAE8Kiz.jpg', '../../resources/images/users/', 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_user_information`
--

CREATE TABLE `apt_user_information` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `user_type` int(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_user_information`
--

INSERT INTO `apt_user_information` (`user_id`, `first_name`, `last_name`, `contact_number`, `user_type`, `status`) VALUES
(20, 'Micoh', 'Yabut', '09456956498', 2, 1),
(21, 'Ada', 'Tardeo', '09156465954', 2, 1),
(22, 'Apt', 'Admin', '', 0, 1),
(23, 'David', 'Echon', '09659895654', 1, 0),
(24, 'arnold', 'lim', '09484848484', 1, 0),
(26, 'Arnoldd', 'Lim', '09123712937', 1, 1),
(28, 'Minaa', 'Myoui', '09123892138', 2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apt_application_requests`
--
ALTER TABLE `apt_application_requests`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `apt_application_requests_ibfk_1` (`user_id`);

--
-- Indexes for table `apt_appointments`
--
ALTER TABLE `apt_appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `apt_appointments_ibfk_2` (`user_id`);

--
-- Indexes for table `apt_bookmarks`
--
ALTER TABLE `apt_bookmarks`
  ADD KEY `property_id` (`property_id`),
  ADD KEY `apt_bookmarks_ibfk_2` (`user_id`);

--
-- Indexes for table `apt_properties`
--
ALTER TABLE `apt_properties`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `apt_properties_ibfk_1` (`landlord_id`);

--
-- Indexes for table `apt_property_amenities`
--
ALTER TABLE `apt_property_amenities`
  ADD PRIMARY KEY (`amenity_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `apt_property_details`
--
ALTER TABLE `apt_property_details`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `apt_property_images`
--
ALTER TABLE `apt_property_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `apt_property_locations`
--
ALTER TABLE `apt_property_locations`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `apt_property_rules`
--
ALTER TABLE `apt_property_rules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `apt_reservations`
--
ALTER TABLE `apt_reservations`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `apt_reservations_ibfk_2` (`user_id`);

--
-- Indexes for table `apt_reviews`
--
ALTER TABLE `apt_reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `property_id` (`property_id`),
  ADD KEY `apt_reviews_ibfk_2` (`user_id`);

--
-- Indexes for table `apt_rooms`
--
ALTER TABLE `apt_rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `apt_room_amenities`
--
ALTER TABLE `apt_room_amenities`
  ADD PRIMARY KEY (`amenity_id`),
  ADD KEY `apt_room_amenities_ibfk_1` (`room_id`);

--
-- Indexes for table `apt_unavailable_slots`
--
ALTER TABLE `apt_unavailable_slots`
  ADD PRIMARY KEY (`slot_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `apt_users`
--
ALTER TABLE `apt_users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `apt_user_images`
--
ALTER TABLE `apt_user_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `apt_user_information`
--
ALTER TABLE `apt_user_information`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apt_application_requests`
--
ALTER TABLE `apt_application_requests`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `apt_appointments`
--
ALTER TABLE `apt_appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `apt_properties`
--
ALTER TABLE `apt_properties`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `apt_property_amenities`
--
ALTER TABLE `apt_property_amenities`
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `apt_property_images`
--
ALTER TABLE `apt_property_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `apt_property_rules`
--
ALTER TABLE `apt_property_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `apt_reservations`
--
ALTER TABLE `apt_reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `apt_reviews`
--
ALTER TABLE `apt_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `apt_rooms`
--
ALTER TABLE `apt_rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `apt_room_amenities`
--
ALTER TABLE `apt_room_amenities`
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `apt_unavailable_slots`
--
ALTER TABLE `apt_unavailable_slots`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `apt_users`
--
ALTER TABLE `apt_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `apt_user_images`
--
ALTER TABLE `apt_user_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apt_application_requests`
--
ALTER TABLE `apt_application_requests`
  ADD CONSTRAINT `apt_application_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `apt_user_information` (`user_id`),
  ADD CONSTRAINT `apt_application_requests_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`);

--
-- Constraints for table `apt_appointments`
--
ALTER TABLE `apt_appointments`
  ADD CONSTRAINT `apt_appointments_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`),
  ADD CONSTRAINT `apt_appointments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `apt_user_information` (`user_id`);

--
-- Constraints for table `apt_bookmarks`
--
ALTER TABLE `apt_bookmarks`
  ADD CONSTRAINT `apt_bookmarks_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`),
  ADD CONSTRAINT `apt_bookmarks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `apt_user_information` (`user_id`);

--
-- Constraints for table `apt_properties`
--
ALTER TABLE `apt_properties`
  ADD CONSTRAINT `apt_properties_ibfk_1` FOREIGN KEY (`landlord_id`) REFERENCES `apt_user_information` (`user_id`);

--
-- Constraints for table `apt_property_amenities`
--
ALTER TABLE `apt_property_amenities`
  ADD CONSTRAINT `apt_property_amenities_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`);

--
-- Constraints for table `apt_property_details`
--
ALTER TABLE `apt_property_details`
  ADD CONSTRAINT `apt_property_details_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`);

--
-- Constraints for table `apt_property_images`
--
ALTER TABLE `apt_property_images`
  ADD CONSTRAINT `apt_property_images_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`);

--
-- Constraints for table `apt_property_locations`
--
ALTER TABLE `apt_property_locations`
  ADD CONSTRAINT `apt_property_locations_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`);

--
-- Constraints for table `apt_property_rules`
--
ALTER TABLE `apt_property_rules`
  ADD CONSTRAINT `apt_property_rules_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`);

--
-- Constraints for table `apt_reservations`
--
ALTER TABLE `apt_reservations`
  ADD CONSTRAINT `apt_reservations_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`),
  ADD CONSTRAINT `apt_reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `apt_user_information` (`user_id`),
  ADD CONSTRAINT `apt_reservations_ibfk_3` FOREIGN KEY (`room_id`) REFERENCES `apt_rooms` (`room_id`);

--
-- Constraints for table `apt_reviews`
--
ALTER TABLE `apt_reviews`
  ADD CONSTRAINT `apt_reviews_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`),
  ADD CONSTRAINT `apt_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `apt_user_information` (`user_id`);

--
-- Constraints for table `apt_rooms`
--
ALTER TABLE `apt_rooms`
  ADD CONSTRAINT `apt_rooms_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`);

--
-- Constraints for table `apt_room_amenities`
--
ALTER TABLE `apt_room_amenities`
  ADD CONSTRAINT `apt_room_amenities_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `apt_rooms` (`room_id`);

--
-- Constraints for table `apt_unavailable_slots`
--
ALTER TABLE `apt_unavailable_slots`
  ADD CONSTRAINT `apt_unavailable_slots_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `apt_properties` (`property_id`);

--
-- Constraints for table `apt_user_information`
--
ALTER TABLE `apt_user_information`
  ADD CONSTRAINT `apt_user_information_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `apt_users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

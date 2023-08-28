-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2023 at 05:33 PM
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
(26, 'Dormitory', 'Burj\'s Dormitory', 36, 1);

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
(38, 26, 'parking,lounge,laundromat,drinking water,refrigerator,sink,fire exit', 1);

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
(26, 'Burj\'s Dormitory is a conveniently located accommodation situated in front of Angeles University Foundation. It offers a practical and accessible living space for students and individuals looking to reside near the university. With its prime location, residents have easy access to the campus facilities and activities.', 4, 10, 4500, 4500, 4500, 1);

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

--
-- Dumping data for table `apt_property_images`
--

INSERT INTO `apt_property_images` (`image_id`, `property_id`, `image_path`, `title`, `status`) VALUES
(24, 26, '370595770_667566765036425_7321147237747323968_n.jpg', 'Room Overview', 1),
(25, 26, '370593894_823926732744253_1377430621130434504_n.jpg', 'Room 2', 1),
(26, 26, '370592728_540971608161002_4200914045398910546_n.jpg', 'CR', 1),
(27, 26, '370598292_988105119116513_8260999782814867466_n.jpg', 'Fire Exit', 1),
(28, 26, '370598911_1735256210241128_6988875149388136487_n.jpg', 'CR 2', 1);

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
(26, '452', 'Cuatro de Hulyo', 'Salapungan', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '2009', '15.145113074763598', '120.5950306751359', 1);

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
(14, 26, 1, 4, 1, 1, '12mn', '5am', 1, 1, 1, 1);

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

--
-- Dumping data for table `apt_reservations`
--

INSERT INTO `apt_reservations` (`reservation_id`, `user_id`, `property_id`, `room_id`, `payment_status`, `status`) VALUES
(4, 40, 26, 18, 2, 2);

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
  `room_type` int(11) NOT NULL,
  `total_rooms` int(11) NOT NULL,
  `total_beds` int(11) NOT NULL,
  `occupied_beds` int(11) NOT NULL,
  `furnished_type` varchar(255) NOT NULL,
  `monthly_rent` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_rooms`
--

INSERT INTO `apt_rooms` (`room_id`, `property_id`, `room_type`, `total_rooms`, `total_beds`, `occupied_beds`, `furnished_type`, `monthly_rent`, `status`) VALUES
(18, 26, 2, 10, 20, 0, 'Furnished', '4500', 1);

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
(20, 18, 'aircon,drinking water', 1);

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
(22, 'admin@apt.com', '1ff54cf4ca397c97914108bbc01ce3a1ab3bd58ae92dfe7fce19778e420366fa', '33ea6d51bee39462274b30ab71aa94db', 1),
(33, 'micoh@apt.com', '52884cb52fe57c9b9909ce5401f4f0570d2bcfdfde8ad7886eb95ee30d573412', '33402ffc5ec960116b31b26324e097b2', 1),
(35, 'sarmiento@apt.com', 'd2d585b25220c6b5bd192822ced5a2dd3df27c6fc6df547480879fb26282b41c', '8fa409215d1fa4e688f85e4e4782a254', 1),
(36, 'burjs@apt.com', '6693b037a762fe735b6f4b6323df7eddf9904e47f81ded78285aade8a9bf9dc2', 'af6826f8ce53afdbadfa4d758c7feead', 1),
(37, 'tridia@apt.com', '36ef8d8e7127a5551e915b6b78756d7f19e1afda0e00b89ca69201e2b459c3c5', '156fd7aa03b236aeb4b868bfb1252da6', 1),
(38, 'karylle@apt.com', '1b9285b6fc63339316578ab3ec6769054e2d4fc8b4b364ae46c2ce20c6b9b205', '192203d06400a98fa0d2b56905221fc4', 1),
(40, 'david@apt.com', '3b2a9ad68ea238994ce1d8ead3cc1a4e8e104b9d214f7a2d4ac45d195354e0a5', '8d3632e068e9c0db26671695381e8bb2', 1),
(41, 'arnold@apt.com', '0b9a2f1ab2ca937a731dc7141844b392f25e5fb7ad8ea0e99cc5c4bb81aef785', '9d41a3cd4533161b0e924b274cac094b', 1);

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
(5, 35, 'female-logo.png', '../../resources/images/landlords/', 1),
(6, 36, 'male-logo.png', '../../resources/images/landlords/', 1),
(7, 37, '64ecb9bda9138_male-logo.png', '../../resources/images/landlords/', 1);

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
(22, 'apt', 'admin', '', 0, 1),
(33, 'Micoh', 'Yabut', '09654659565', 2, 1),
(35, 'Raquel', 'Diaz', '639952671924', 1, 1),
(36, 'Tito', 'Mac', '639340790701', 1, 1),
(37, 'Kuya', 'Jason', '639757870091', 1, 1),
(38, 'Karylle', 'Lopez', '09465656232', 2, 1),
(40, 'David', 'Echon', '09765984652', 2, 1),
(41, 'Arnold', 'Lim', '09010652356', 2, 1);

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
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `apt_appointments`
--
ALTER TABLE `apt_appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `apt_properties`
--
ALTER TABLE `apt_properties`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `apt_property_amenities`
--
ALTER TABLE `apt_property_amenities`
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `apt_property_images`
--
ALTER TABLE `apt_property_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `apt_property_rules`
--
ALTER TABLE `apt_property_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `apt_reservations`
--
ALTER TABLE `apt_reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `apt_reviews`
--
ALTER TABLE `apt_reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `apt_rooms`
--
ALTER TABLE `apt_rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `apt_room_amenities`
--
ALTER TABLE `apt_room_amenities`
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `apt_unavailable_slots`
--
ALTER TABLE `apt_unavailable_slots`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `apt_users`
--
ALTER TABLE `apt_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `apt_user_images`
--
ALTER TABLE `apt_user_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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

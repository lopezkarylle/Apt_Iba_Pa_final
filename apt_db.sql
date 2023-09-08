-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2023 at 05:02 PM
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

--
-- Dumping data for table `apt_application_requests`
--

INSERT INTO `apt_application_requests` (`application_id`, `user_id`, `property_id`, `status`) VALUES
(4, 38, 26, 1),
(5, 43, 39, 1);

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

--
-- Dumping data for table `apt_appointments`
--

INSERT INTO `apt_appointments` (`appointment_id`, `property_id`, `user_id`, `date`, `time`, `status`) VALUES
(9, 26, 33, '1970-01-01', '05:30 PM', 2),
(10, 26, 33, '2023-09-09', '3:00 PM', 1);

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
-- Table structure for table `apt_chats`
--

CREATE TABLE `apt_chats` (
  `chat_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `landlord_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apt_messages`
--

CREATE TABLE `apt_messages` (
  `message_id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `message_text` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isRead` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apt_notifications`
--

CREATE TABLE `apt_notifications` (
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notification_text` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `notification_type` varchar(255) NOT NULL,
  `isRead` tinyint(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_notifications`
--

INSERT INTO `apt_notifications` (`notification_id`, `user_id`, `notification_text`, `timestamp`, `notification_type`, `isRead`, `status`) VALUES
(1, 36, 'An appointment has been scheduled for your property, Burj\'s Dormitory, on September 9, 2023 at 3:00 PM by Micoh Yabut', '2023-09-07 09:39:35', 'appointment', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_password_reset_tokens`
--

CREATE TABLE `apt_password_reset_tokens` (
  `token_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_password_reset_tokens`
--

INSERT INTO `apt_password_reset_tokens` (`token_id`, `email`, `token`, `expiry`) VALUES
(1, 'micoh@apt.com', '950ee5864b731042bef0d13554baf2aab526445ad599b8b11679b55b091d0aa2', '2023-09-07 22:13:21'),
(2, 'micoh@apt.com', 'eb5b4bfde408e0b189699ad2f03f9d5ca39dab67274d0efa21a50a3ff8998118', '2023-09-07 22:15:51'),
(3, 'sia.yabut.micohjomarie@gmail.com', '045c863c7e4d21720018cc820985928ab0d20303c268f1c706fc9d736bf01c6f', '2023-09-07 22:35:20'),
(4, 'sia.yabut.micohjomarie@gmail.com', '2d186632568f782fc7dbff10dc4fc3f8488bd25f5af9d5196d31dfdbf20338a3', '2023-09-07 22:39:52'),
(5, 'sia.yabut.micohjomarie@gmail.com', '9b1aa7bd835935b6a7955f6cebd1c09f5da34e69afaf4004d210b6f6e73b8ff3', '2023-09-07 22:41:49'),
(6, 'sia.yabut.micohjomarie@gmail.com', '2f5334364a707c0a385c6e0771db0beaf65ff93540c191db2eff2390bbd23e69', '2023-09-07 22:42:09'),
(7, 'sia.yabut.micohjomarie@gmail.com', '269d8dcef3d4257689e988cbb7bc821942df4a83683bd66827b2f89f2cda3e99', '2023-09-07 22:56:58'),
(8, 'sia.yabut.micohjomarie@gmail.com', 'b628dc8698ae657c4a54acc7a9f2326eeaf06528c63c4d7b028fbd1a71fc6b7d', '2023-09-07 22:57:27'),
(9, 'sia.yabut.micohjomarie@gmail.com', '02384e9ed1458a3b4fc605a69ebb296e5f44a5a36620b2071138056ee2b161da', '2023-09-07 23:02:31'),
(10, 'sia.yabut.micohjomarie@gmail.com', '7c36141b384ae2c85293be12e4a1074f47aaf367ffa8378aa143c738ad1e43c8', '2023-09-07 23:03:27'),
(11, 'sia.yabut.micohjomarie@gmail.com', '21abd0d8f893c520e476d5ac1991c9a788603e3d684d9a84ffd2a2cadbcbd62d', '2023-09-07 23:03:39');

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
(26, 'Dormitory', 'Burj\'s Dormitory', 36, 1),
(39, 'Dormitory', 'Batac', 43, 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_property_amenities`
--

CREATE TABLE `apt_property_amenities` (
  `amenity_id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `aircon` tinyint(1) NOT NULL,
  `cabinet` tinyint(1) NOT NULL,
  `cctv` tinyint(1) NOT NULL,
  `drinking_water` tinyint(1) NOT NULL,
  `elevator` tinyint(1) NOT NULL,
  `emergency_exit` tinyint(1) NOT NULL,
  `food_hall` tinyint(1) NOT NULL,
  `laundry` tinyint(1) NOT NULL,
  `lounge` tinyint(1) NOT NULL,
  `microwave` tinyint(1) NOT NULL,
  `parking` tinyint(1) NOT NULL,
  `refrigerator` tinyint(1) NOT NULL,
  `roof_deck` tinyint(1) NOT NULL,
  `security` tinyint(1) NOT NULL,
  `sink` tinyint(1) NOT NULL,
  `study_area` tinyint(1) NOT NULL,
  `tv` tinyint(1) NOT NULL,
  `wifi` tinyint(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_property_amenities`
--

INSERT INTO `apt_property_amenities` (`amenity_id`, `property_id`, `aircon`, `cabinet`, `cctv`, `drinking_water`, `elevator`, `emergency_exit`, `food_hall`, `laundry`, `lounge`, `microwave`, `parking`, `refrigerator`, `roof_deck`, `security`, `sink`, `study_area`, `tv`, `wifi`, `status`) VALUES
(38, 26, 1, 1, 1, 1, 0, 1, 0, 1, 0, 0, 0, 1, 0, 1, 1, 0, 1, 1, 1),
(39, 39, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1);

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
  `electric_bill` varchar(255) NOT NULL,
  `water_bill` varchar(255) NOT NULL,
  `reservation_fee` float NOT NULL,
  `advance_deposit` float NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_property_details`
--

INSERT INTO `apt_property_details` (`property_id`, `description`, `total_floors`, `total_rooms`, `lowest_rate`, `electric_bill`, `water_bill`, `reservation_fee`, `advance_deposit`, `status`) VALUES
(26, 'Burj\'s Dormitory is a conveniently located accommodation situated in front of Angeles University Foundation. It offers a practical and accessible living space for students and individuals looking to reside near the university. With its prime location, residents have easy access to the campus facilities and activities.', 4, 10, 4500, '', '', 4500, 4500, 1),
(39, 'description', 5, 5, 2500, '1000', '1000', 1000, 1000, 1);

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
(28, 26, '370598911_1735256210241128_6988875149388136487_n.jpg', 'CR 2', 1),
(29, 39, '352142478_273638251824393_3861382219506690596_n.jpg', '1', 1),
(30, 39, '1eb6b65cc5facadab82357963b41904a.jpg', '2', 1),
(31, 39, '3aef63b5a901f6488b5fe85beab32b52.jpg', '3', 1),
(32, 39, '3c70c9017ed57198f2a145b3974cc763.jpg', '4', 1),
(33, 39, '3f6b79d1a5357359268459b6eba8578b.jpg', '5', 1);

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
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_property_locations`
--

INSERT INTO `apt_property_locations` (`property_id`, `property_number`, `street`, `barangay`, `city`, `province`, `region`, `latitude`, `longitude`, `status`) VALUES
(26, '452', 'Cuatro de Hulyo', 'Salapungan', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '15.14611952781827', '120.59573897890535', 1),
(39, '12', 'Roxas', 'Lourdes Sur East', 'Angeles City', 'Pampanga', 'Region III (Central Luzon)', '15.145756876093449', '120.5934106242363', 1);

-- --------------------------------------------------------

--
-- Table structure for table `apt_property_rules`
--

CREATE TABLE `apt_property_rules` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `short_term` tinyint(1) NOT NULL,
  `min_weeks` int(2) NOT NULL,
  `mix_gender` tinyint(1) NOT NULL,
  `curfew` tinyint(1) NOT NULL,
  `from_curfew` varchar(255) NOT NULL,
  `to_curfew` varchar(255) NOT NULL,
  `cooking` tinyint(1) NOT NULL,
  `pets` tinyint(1) NOT NULL,
  `visitors` tinyint(1) NOT NULL,
  `from_visit` varchar(255) NOT NULL,
  `to_visit` varchar(255) NOT NULL,
  `alcohol` tinyint(1) NOT NULL,
  `smoking` tinyint(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apt_property_rules`
--

INSERT INTO `apt_property_rules` (`id`, `property_id`, `short_term`, `min_weeks`, `mix_gender`, `curfew`, `from_curfew`, `to_curfew`, `cooking`, `pets`, `visitors`, `from_visit`, `to_visit`, `alcohol`, `smoking`, `status`) VALUES
(14, 26, 1, 4, 0, 1, '12mn', '5am', 1, 1, 1, '8am', '11pm', 1, 0, 1),
(15, 39, 0, 4, 1, 1, '8PM', '7AM', 1, 0, 1, '5AM', '9PM', 0, 0, 1);

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
(18, 26, 2, 10, 20, 0, 'Furnished', '4500', 1),
(19, 39, 2, 5, 10, 0, 'Semi-furnished', '2500', 1);

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

--
-- Dumping data for table `apt_unavailable_slots`
--

INSERT INTO `apt_unavailable_slots` (`slot_id`, `property_id`, `date`, `time`) VALUES
(16, 26, '2023-09-05', '\"08:00 AM\",\"08:30 AM\",\"09:00 AM\",\"09:30 AM\",\"10:00 AM\",\"10:30 AM\",\"11:00 AM\"'),
(18, 26, '2023-09-09', '08:00 AM,08:30 AM,09:00 AM,09:30 AM,10:00 AM,10:30 AM,11:00 AM,11:30 AM,12:00 NN,12:30 PM,01:00 PM,01:30 PM,02:00 PM,02:30 PM,03:00 PM,03:30 PM,04:00 PM,04:30 PM,05:00 PM,05:30 PM,06:00 PM, 3:00 PM');

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
(41, 'arnold@apt.com', '0b9a2f1ab2ca937a731dc7141844b392f25e5fb7ad8ea0e99cc5c4bb81aef785', '9d41a3cd4533161b0e924b274cac094b', 1),
(42, 'superadmin@apt.com', '5dcd2298c52249c5ca02a817b19f939541ce35c39d3ad67049967d2e2274b0e4', '451b87672ce7d2be1cbe8a97afdb4fa4', 1),
(43, 'batac@apt.com', 'ee1b2000ab986ce826383937a70848a6a3fefa3e947ac52b5388ecfc3d2d99e7', '8991bc59a4e00105b48f265e09449008', 1),
(44, 'sia.yabut.micohjomarie@gmail.com', 'deeb7b8ec590eb646145aa9e83b4a243655598e2d64752cce81ac8859b221244', 'e98504d646109d6523fe7876ba0cb28a', 1);

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
(22, 'apt', 'admin', '', 3, 1),
(33, 'Micoh', 'Yabut', '09654659565', 2, 1),
(35, 'Raquel', 'Diaz', '639952671924', 1, 1),
(36, 'Tito', 'Mac', '639340790701', 1, 1),
(37, 'Kuya', 'Jason', '639757870091', 1, 1),
(38, 'Karylle', 'Lopez', '09465656232', 2, 1),
(40, 'David', 'Echon', '09765984652', 2, 1),
(41, 'Arnold', 'Lim', '09010652356', 2, 1),
(42, 'Apt', 'Superadmin', '', 4, 1),
(43, 'Jude', 'Batac', '096555666532', 1, 1),
(44, 'Meko', 'Yabt', '09656565656', 2, 1);

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
-- Indexes for table `apt_chats`
--
ALTER TABLE `apt_chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `apt_messages`
--
ALTER TABLE `apt_messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `apt_notifications`
--
ALTER TABLE `apt_notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `apt_password_reset_tokens`
--
ALTER TABLE `apt_password_reset_tokens`
  ADD PRIMARY KEY (`token_id`);

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
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `apt_appointments`
--
ALTER TABLE `apt_appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `apt_chats`
--
ALTER TABLE `apt_chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apt_messages`
--
ALTER TABLE `apt_messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `apt_notifications`
--
ALTER TABLE `apt_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `apt_password_reset_tokens`
--
ALTER TABLE `apt_password_reset_tokens`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `apt_properties`
--
ALTER TABLE `apt_properties`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `apt_property_amenities`
--
ALTER TABLE `apt_property_amenities`
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `apt_property_images`
--
ALTER TABLE `apt_property_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `apt_property_rules`
--
ALTER TABLE `apt_property_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `apt_unavailable_slots`
--
ALTER TABLE `apt_unavailable_slots`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `apt_users`
--
ALTER TABLE `apt_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `apt_user_images`
--
ALTER TABLE `apt_user_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- Constraints for table `apt_notifications`
--
ALTER TABLE `apt_notifications`
  ADD CONSTRAINT `apt_notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `apt_user_information` (`user_id`);

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

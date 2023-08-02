-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 03:20 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `traveling`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `profile_image` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `phone`, `address`, `profile_image`, `created_at`, `updated_at`) VALUES
(1, 'Asad', 'asad@gmail.com', '$2y$10$boHSUIBBFOQMFtzVCgX7aO1GhiBn0qk/1bFo3x75hbGF0qN3CMWDq', '123456789', 'adress,city,country', 'Profile_Image/p0TOVgBfKA3GhsaFJS1losciQNAFsMxYHIjIKTlT.jpg', '2023-07-14 15:42:04', '2023-07-30 08:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `air_company`
--

CREATE TABLE `air_company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `abbreviation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `air_company`
--

INSERT INTO `air_company` (`id`, `name`, `abbreviation`, `created_at`, `updated_at`) VALUES
(1, 'Pakistan International Airline', 'PIA', '2023-07-17 10:44:40', '2023-07-17 10:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `carrier`
--

CREATE TABLE `carrier` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `driver_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carrier`
--

INSERT INTO `carrier` (`id`, `company_name`, `driver_name`, `phone`, `created_at`, `updated_at`) VALUES
(3, 'Star travels', 'hammad', '12345678912', '2023-07-17 10:24:17', '2023-07-17 10:27:20');

-- --------------------------------------------------------

--
-- Table structure for table `collaborator`
--

CREATE TABLE `collaborator` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collaborator`
--

INSERT INTO `collaborator` (`id`, `name`, `location`, `phone`, `created_at`, `updated_at`) VALUES
(2, 'Aus Pak', 'Gujranwala', '1516561512', '2023-07-17 09:57:06', '2023-07-17 09:57:06');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `sex` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `id_card` varchar(255) DEFAULT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `passport_issue_date` varchar(255) DEFAULT NULL,
  `passport_file` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gaurdian_name` varchar(255) DEFAULT NULL,
  `gaurdian_phone` varchar(255) DEFAULT NULL,
  `gaurdian_relation` varchar(255) DEFAULT NULL,
  `collaborator` int(11) DEFAULT NULL,
  `linked_with` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `sex`, `gender`, `phone`, `dob`, `id_card`, `passport`, `passport_issue_date`, `passport_file`, `nationality`, `city`, `email`, `gaurdian_name`, `gaurdian_phone`, `gaurdian_relation`, `collaborator`, `linked_with`, `created_at`, `updated_at`) VALUES
(4, 'Hayden', 'Carl', 'Masculine', 'Adult', 'Rama', '1998-06-04', 'Marny', 'Moana', '1999-06-20', 'passport_files/LbDli1yYFQtnsT6bvUb2FHcyStdauaGQOZPyi0qR.jpg', 'Rahim', 'Sybill', 'hiquwuro@mailinator.com', 'Rhoda', NULL, 'Sybill', NULL, NULL, '2023-07-14 11:41:01', '2023-07-14 11:41:01'),
(7, 'Hammad', 'arif', 'Faminine', 'Infant', 'Louis', '1992-11-07', 'Erica', 'Teegan', '1984-04-19', 'passport_files/JQxVJMxQitBmhql94IjgaLAOrWqXUxqMkgj8PzRR.png', 'Merrill', 'Harper', 'wehocol@mailinator.com', 'Zachary', 'Kelsey', 'Stacy', NULL, 4, '2023-07-14 11:58:50', '2023-07-23 09:16:10'),
(8, 'Scarlet', 'Moana', 'Masculine', 'Adult', 'Stone', '2022-03-04', 'Fatima', 'Jakeem', '1983-03-27', NULL, 'Jack', 'Ferdinand', 'qonikehuku@mailinator.com', 'Tara', 'Justina', 'Chancellor', NULL, 7, '2023-07-20 12:39:38', '2023-07-20 12:39:38'),
(9, 'Tallulah', 'Clarke', 'Masculine', 'Child', 'Lance', '2005-01-14', 'Mollie', 'Nissim', '2015-11-08', NULL, 'Portia', 'Idona', 'bawicecyvy@mailinator.com', 'Tad', 'Nora', 'Cora', NULL, 4, '2023-07-20 12:42:04', '2023-07-20 12:42:04'),
(10, 'Plato', 'Lee', 'Masculine', 'Child', 'Jarrod', '2017-08-19', 'Grace', 'Zeph', '2013-02-26', NULL, 'Pandora', 'Prescott', 'tadinulyk@mailinator.com', 'Fatima', 'Melissa', 'Ethan', NULL, 8, '2023-07-28 10:17:06', '2023-07-28 10:17:06'),
(12, 'Rajah', 'Boone', 'Faminine', 'Infant', '+1 (618) 878-5001', '1994-03-06', 'Sunt sed sed sunt re', 'Laboriosam voluptat', '1976-01-08', NULL, 'Qui exercitation cup', 'Libero distinctio E', 'pafami@mailinator.com', 'Lani Adams', '+1 (568) 621-3052', 'Ut minim minima pers', NULL, 9, '2023-07-28 10:42:56', '2023-07-28 10:42:56'),
(13, 'Tashya', 'Baldwin', 'Faminine', 'Child', '+1 (938) 203-7047', '1990-01-04', 'Blanditiis et fugiat', 'Sit et fugiat in ni', '2000-10-08', NULL, 'Voluptatem tempore', 'Tempor sed at magna', 'nopu@mailinator.com', 'Heather Dominguez', '+1 (386) 747-9536', 'Mollit consectetur', NULL, 9, '2023-07-28 10:45:18', '2023-07-28 10:45:18'),
(14, 'Nasim', 'Valenzuela', 'Faminine', 'Infant', '+1 (854) 685-4431', '2013-04-19', 'Minim distinctio Qu', 'Mollitia inventore v', '1995-08-06', NULL, 'Eum repellendus Ips', 'Quibusdam soluta non', 'gugorusuqo@mailinator.com', 'Jerome Holt', '+1 (497) 883-3618', 'At repellendus Qui', NULL, 8, '2023-07-28 10:46:57', '2023-07-28 10:46:57'),
(15, 'Nasim', 'Valenzuela', 'Faminine', 'Infant', '+1 (854) 685-4431', '2013-04-19', 'Minim distinctio Qu', 'Mollitia inventore v', '1995-08-06', NULL, 'Eum repellendus Ips', 'Quibusdam soluta non', 'gugorusuqo@mailinator.com', 'Jerome Holt', '+1 (497) 883-3618', 'At repellendus Qui', NULL, 8, '2023-07-28 10:47:34', '2023-07-28 10:47:34'),
(16, 'Nasim', 'Valenzuela', 'Faminine', 'Infant', '+1 (854) 685-4431', '2013-04-19', 'Minim distinctio Qu', 'Mollitia inventore v', '1995-08-06', NULL, 'Eum repellendus Ips', 'Quibusdam soluta non', 'gugorusuqo@mailinator.com', 'Jerome Holt', '+1 (497) 883-3618', 'At repellendus Qui', NULL, 8, '2023-07-28 10:50:01', '2023-07-28 10:50:01'),
(17, 'Nasim', 'Valenzuela', 'Faminine', 'Infant', '+1 (854) 685-4431', '2013-04-19', 'Minim distinctio Qu', 'Mollitia inventore v', '1995-08-06', NULL, 'Eum repellendus Ips', 'Quibusdam soluta non', 'gugorusuqo@mailinator.com', 'Jerome Holt', '+1 (497) 883-3618', 'At repellendus Qui', NULL, 8, '2023-07-28 10:56:40', '2023-07-28 10:56:40'),
(18, 'Nasim', 'Valenzuela', 'Faminine', 'Infant', '+1 (854) 685-4431', '2013-04-19', 'Minim distinctio Qu', 'Mollitia inventore v', '1995-08-06', NULL, 'Eum repellendus Ips', 'Quibusdam soluta non', 'gugorusuqo@mailinator.com', 'Jerome Holt', '+1 (497) 883-3618', 'At repellendus Qui', NULL, 8, '2023-07-28 10:57:11', '2023-07-28 10:57:11'),
(19, 'Nasim', 'Valenzuela', 'Faminine', 'Infant', '+1 (854) 685-4431', '2013-04-19', 'Minim distinctio Qu', 'Mollitia inventore v', '1995-08-06', NULL, 'Eum repellendus Ips', 'Quibusdam soluta non', 'gugorusuqo@mailinator.com', 'Jerome Holt', '+1 (497) 883-3618', 'At repellendus Qui', NULL, 8, '2023-07-28 10:57:57', '2023-07-28 10:57:57'),
(21, 'Selma', 'Dickson', 'Masculine', 'Infant', '+1 (396) 678-1304', '2007-05-10', 'Maiores inventore qu', 'Ut consectetur ad a', '1986-08-29', NULL, 'Vitae et tempora ape', 'Ullamco nihil fuga', 'cisolor@mailinator.com', 'Galvin Mccoy', '+1 (856) 773-7521', 'Nostrud itaque repud', NULL, 14, '2023-07-28 10:58:53', '2023-07-28 10:58:53'),
(22, 'Fuller', 'Greer', 'Faminine', 'Infant', '+1 (133) 816-3858', '1988-03-05', 'Quisquam possimus q', 'Eaque velit molestia', '1976-05-12', NULL, 'Iure quia qui minus', 'Et omnis perspiciati', 'wuses@mailinator.com', 'Kimberly Kirby', '+1 (883) 177-3482', 'Eos odio quis eius n', 2, 13, '2023-07-30 09:07:22', '2023-07-30 09:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `extra_service`
--

CREATE TABLE `extra_service` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `extra_service`
--

INSERT INTO `extra_service` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'extra service12', '2023-07-23 04:53:01', '2023-07-23 04:53:01');

-- --------------------------------------------------------

--
-- Table structure for table `extra_service_for_reservation`
--

CREATE TABLE `extra_service_for_reservation` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `extra_service_id` int(11) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `trip_type` varchar(255) DEFAULT NULL,
  `service_price` varchar(255) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `extra_service_for_reservation`
--

INSERT INTO `extra_service_for_reservation` (`id`, `reservation_id`, `extra_service_id`, `country`, `type`, `trip_type`, `service_price`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL, 'round way', '23', '2023-07-28 08:58:56', '2023-07-28 08:58:56'),
(2, 2, 2, NULL, NULL, 'one way', '13', '2023-07-28 09:04:31', '2023-07-28 09:04:31'),
(3, 3, 2, NULL, NULL, 'one way', '21', '2023-07-28 11:00:35', '2023-07-29 04:03:12'),
(5, 5, NULL, NULL, NULL, NULL, '0', '2023-07-28 14:23:32', '2023-07-28 14:23:32'),
(6, 6, NULL, NULL, NULL, NULL, '0', '2023-07-30 04:04:26', '2023-07-30 04:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `extra_service_price`
--

CREATE TABLE `extra_service_price` (
  `id` int(11) NOT NULL,
  `extra_service_id` int(11) DEFAULT NULL,
  `adult_buying_one` varchar(255) DEFAULT NULL,
  `adult_selling_one` varchar(255) DEFAULT NULL,
  `adult_buying_round` varchar(255) DEFAULT NULL,
  `adult_selling_round` varchar(255) DEFAULT NULL,
  `child_buying_one` varchar(255) DEFAULT NULL,
  `child_selling_one` varchar(255) DEFAULT NULL,
  `child_buying_round` varchar(255) DEFAULT NULL,
  `child_selling_round` varchar(255) DEFAULT NULL,
  `infant_buying_one` varchar(255) DEFAULT NULL,
  `infant_selling_one` varchar(255) DEFAULT NULL,
  `infant_buying_round` varchar(255) DEFAULT NULL,
  `infant_selling_round` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `extra_service_price`
--

INSERT INTO `extra_service_price` (`id`, `extra_service_id`, `adult_buying_one`, `adult_selling_one`, `adult_buying_round`, `adult_selling_round`, `child_buying_one`, `child_selling_one`, `child_buying_round`, `child_selling_round`, `infant_buying_one`, `infant_selling_one`, `infant_buying_round`, `infant_selling_round`, `created_at`, `updated_at`) VALUES
(4, 2, '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '2023-07-23 04:53:02', '2023-07-23 04:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `flight_reservation`
--

CREATE TABLE `flight_reservation` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `flight_id` int(11) DEFAULT NULL,
  `from_airport` varchar(255) DEFAULT NULL,
  `to_airport` varchar(255) DEFAULT NULL,
  `trip_type` varchar(255) DEFAULT NULL,
  `flight_type` varchar(255) DEFAULT NULL,
  `air_company_id` varchar(255) DEFAULT NULL,
  `departure_time` varchar(255) DEFAULT NULL,
  `return_time` varchar(255) DEFAULT NULL,
  `service_price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flight_reservation`
--

INSERT INTO `flight_reservation` (`id`, `reservation_id`, `flight_id`, `from_airport`, `to_airport`, `trip_type`, `flight_type`, `air_company_id`, `departure_time`, `return_time`, `service_price`, `created_at`, `updated_at`) VALUES
(2, 6, 2, 'MARRAKECH AIRPORT (RAK)', 'CASABLANCA AIRPORT (CMN)', 'Round Trip', 'Direct', '1', '2023-07-25', '2023-08-02', '0', '2023-07-30 04:04:26', '2023-07-30 04:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `grouping`
--

CREATE TABLE `grouping` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) DEFAULT NULL,
  `going_date` varchar(255) DEFAULT NULL,
  `coming_date` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lodging_reservation`
--

CREATE TABLE `lodging_reservation` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `lodging_in_madina` varchar(255) DEFAULT NULL,
  `room_type_in_madina` varchar(255) DEFAULT NULL,
  `from_date_madina` varchar(255) DEFAULT NULL,
  `to_date_madina` varchar(255) DEFAULT NULL,
  `lodging_in_makkah` varchar(255) DEFAULT NULL,
  `room_type_in_makkah` varchar(255) DEFAULT NULL,
  `from_date_makkah` varchar(255) DEFAULT NULL,
  `to_date_makkah` varchar(255) DEFAULT NULL,
  `length_of_stay` varchar(255) DEFAULT NULL,
  `madina_price` varchar(255) DEFAULT NULL,
  `makkah_price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lodging_reservation`
--

INSERT INTO `lodging_reservation` (`id`, `reservation_id`, `destination`, `lodging_in_madina`, `room_type_in_madina`, `from_date_madina`, `to_date_madina`, `lodging_in_makkah`, `room_type_in_makkah`, `from_date_makkah`, `to_date_makkah`, `length_of_stay`, `madina_price`, `makkah_price`, `created_at`, `updated_at`) VALUES
(1, 2, 'Al Madina', '4', 'room_for_three', '2023-07-18', '2023-07-27', '3', 'room_for_three', '2023-07-27', '2023-08-02', '20', '567', '56', '2023-07-28 09:04:31', '2023-07-28 09:04:31');

-- --------------------------------------------------------

--
-- Table structure for table `lodging_service`
--

CREATE TABLE `lodging_service` (
  `id` int(11) NOT NULL,
  `hotel_name` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `hotel_type` varchar(255) DEFAULT NULL,
  `available_from` varchar(255) DEFAULT NULL,
  `available_to` varchar(255) DEFAULT NULL,
  `rooms_for_two` varchar(255) DEFAULT NULL,
  `rooms_for_three` varchar(255) DEFAULT NULL,
  `rooms_for_four` varchar(255) DEFAULT NULL,
  `rooms_for_five` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lodging_service`
--

INSERT INTO `lodging_service` (`id`, `hotel_name`, `city`, `hotel_type`, `available_from`, `available_to`, `rooms_for_two`, `rooms_for_three`, `rooms_for_four`, `rooms_for_five`, `created_at`, `updated_at`) VALUES
(3, '7 star', 'Makkah', 'Economic', '2023-07-17', '2023-07-18', '2', '3', '4', '5', '2023-07-18 03:08:23', '2023-07-28 07:21:04'),
(4, '9', 'Madina', 'Economic', '2023-07-10', '2023-07-24', '2', '3', '4', '5', '2023-07-20 14:38:19', '2023-07-20 14:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `lodging_service_price_for_individual`
--

CREATE TABLE `lodging_service_price_for_individual` (
  `id` int(11) NOT NULL,
  `lodging_service_id` int(11) DEFAULT NULL,
  `room_two_buying_adult` varchar(255) DEFAULT NULL,
  `room_two_selling_adult` varchar(255) DEFAULT NULL,
  `room_two_buying_child` varchar(255) DEFAULT NULL,
  `room_two_selling_child` varchar(255) DEFAULT NULL,
  `room_two_buying_infant` varchar(255) DEFAULT NULL,
  `room_two_selling_infant` varchar(255) DEFAULT NULL,
  `room_three_buying_adult` varchar(255) DEFAULT NULL,
  `room_three_selling_adult` varchar(255) DEFAULT NULL,
  `room_three_buying_child` varchar(255) DEFAULT NULL,
  `room_three_selling_child` varchar(255) DEFAULT NULL,
  `room_three_buying_infant` varchar(255) DEFAULT NULL,
  `room_three_selling_infant` varchar(255) DEFAULT NULL,
  `room_four_buying_adult` varchar(255) DEFAULT NULL,
  `room_four_selling_adult` varchar(255) DEFAULT NULL,
  `room_four_buying_child` varchar(255) DEFAULT NULL,
  `room_four_selling_child` varchar(255) DEFAULT NULL,
  `room_four_buying_infant` varchar(255) DEFAULT NULL,
  `room_four_selling_infant` varchar(255) DEFAULT NULL,
  `room_five_buying_adult` varchar(255) DEFAULT NULL,
  `room_five_selling_adult` varchar(255) DEFAULT NULL,
  `room_five_buying_child` varchar(255) DEFAULT NULL,
  `room_five_selling_child` varchar(255) DEFAULT NULL,
  `room_five_buying_infant` varchar(255) DEFAULT NULL,
  `room_five_selling_infant` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lodging_service_price_for_individual`
--

INSERT INTO `lodging_service_price_for_individual` (`id`, `lodging_service_id`, `room_two_buying_adult`, `room_two_selling_adult`, `room_two_buying_child`, `room_two_selling_child`, `room_two_buying_infant`, `room_two_selling_infant`, `room_three_buying_adult`, `room_three_selling_adult`, `room_three_buying_child`, `room_three_selling_child`, `room_three_buying_infant`, `room_three_selling_infant`, `room_four_buying_adult`, `room_four_selling_adult`, `room_four_buying_child`, `room_four_selling_child`, `room_four_buying_infant`, `room_four_selling_infant`, `room_five_buying_adult`, `room_five_selling_adult`, `room_five_buying_child`, `room_five_selling_child`, `room_five_buying_infant`, `room_five_selling_infant`, `created_at`, `updated_at`) VALUES
(8, 4, '67', 'we', '78', '8', '96', '47', '345', '567', '7', '7', '252', '36', '6987', '89', '7', '78', '36', '396', '78', '4', '45', '32', '3', NULL, '2023-07-20 14:38:20', '2023-07-20 14:38:20'),
(9, 3, '65', '67', '90', '234', '65', '324', '34', '56', '567', '78', '86', '75', '12', '45', '56', '34', '44', '66', '76', '98', '75', '34', '77', '88', '2023-07-28 07:21:04', '2023-07-28 07:21:04');

-- --------------------------------------------------------

--
-- Table structure for table `lodging_service_price_for_package`
--

CREATE TABLE `lodging_service_price_for_package` (
  `id` int(11) NOT NULL,
  `lodging_service_id` int(11) DEFAULT NULL,
  `room_two_buying_adult` varchar(255) DEFAULT NULL,
  `room_two_selling_adult` varchar(255) DEFAULT NULL,
  `room_two_buying_child` varchar(255) DEFAULT NULL,
  `room_two_selling_child` varchar(255) DEFAULT NULL,
  `room_two_buying_infant` varchar(255) DEFAULT NULL,
  `room_two_selling_infant` varchar(255) DEFAULT NULL,
  `room_three_buying_adult` varchar(255) DEFAULT NULL,
  `room_three_selling_adult` varchar(255) DEFAULT NULL,
  `room_three_buying_child` varchar(255) DEFAULT NULL,
  `room_three_selling_child` varchar(255) DEFAULT NULL,
  `room_three_buying_infant` varchar(255) DEFAULT NULL,
  `room_three_selling_infant` varchar(255) DEFAULT NULL,
  `room_four_buying_adult` varchar(255) DEFAULT NULL,
  `room_four_selling_adult` varchar(255) DEFAULT NULL,
  `room_four_buying_child` varchar(255) DEFAULT NULL,
  `room_four_selling_child` varchar(255) DEFAULT NULL,
  `room_four_buying_infant` varchar(255) DEFAULT NULL,
  `room_four_selling_infant` varchar(255) DEFAULT NULL,
  `room_five_buying_adult` varchar(255) DEFAULT NULL,
  `room_five_selling_adult` varchar(255) DEFAULT NULL,
  `room_five_buying_child` varchar(255) DEFAULT NULL,
  `room_five_selling_child` varchar(255) DEFAULT NULL,
  `room_five_buying_infant` varchar(255) DEFAULT NULL,
  `room_five_selling_infant` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lodging_service_price_for_package`
--

INSERT INTO `lodging_service_price_for_package` (`id`, `lodging_service_id`, `room_two_buying_adult`, `room_two_selling_adult`, `room_two_buying_child`, `room_two_selling_child`, `room_two_buying_infant`, `room_two_selling_infant`, `room_three_buying_adult`, `room_three_selling_adult`, `room_three_buying_child`, `room_three_selling_child`, `room_three_buying_infant`, `room_three_selling_infant`, `room_four_buying_adult`, `room_four_selling_adult`, `room_four_buying_child`, `room_four_selling_child`, `room_four_buying_infant`, `room_four_selling_infant`, `room_five_buying_adult`, `room_five_selling_adult`, `room_five_buying_child`, `room_five_selling_child`, `room_five_buying_infant`, `room_five_selling_infant`, `created_at`, `updated_at`) VALUES
(7, 4, '32', '3', '45', '56', '5', '45', '32', '32', '878', '8', '34', '76', '34', '45', '90', '45', '78', '89', '65', '76', '90', '90', '09', '67', '2023-07-20 14:38:20', '2023-07-20 14:38:20'),
(8, 3, '11', '12', '13', '14', '16', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31', '32', '33', '34', '2023-07-28 07:21:04', '2023-07-28 07:21:04');

-- --------------------------------------------------------

--
-- Table structure for table `package_reservation`
--

CREATE TABLE `package_reservation` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `package_type` varchar(255) DEFAULT NULL,
  `package_service_id` int(11) DEFAULT NULL,
  `from_date` varchar(255) DEFAULT NULL,
  `to_date` varchar(255) DEFAULT NULL,
  `length_of_stay` varchar(255) DEFAULT NULL,
  `service_price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package_reservation`
--

INSERT INTO `package_reservation` (`id`, `reservation_id`, `package_type`, `package_service_id`, `from_date`, `to_date`, `length_of_stay`, `service_price`, `created_at`, `updated_at`) VALUES
(1, 1, 'Normal', 3, '2023-07-11', '2023-07-26', '12', '1315', '2023-07-28 08:58:55', '2023-07-28 08:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `package_service`
--

CREATE TABLE `package_service` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `available_from` varchar(255) DEFAULT NULL,
  `available_to` varchar(255) DEFAULT NULL,
  `visa` varchar(255) DEFAULT NULL,
  `lodging_in_makkah` varchar(255) DEFAULT NULL,
  `room_type_makkah` varchar(255) DEFAULT NULL,
  `lodging_in_madina` varchar(255) DEFAULT NULL,
  `room_type_madina` varchar(255) DEFAULT NULL,
  `ticket` varchar(255) DEFAULT NULL,
  `price_for_adult` varchar(255) DEFAULT NULL,
  `price_for_child` varchar(255) DEFAULT NULL,
  `price_for_infant` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `package_service`
--

INSERT INTO `package_service` (`id`, `name`, `available_from`, `available_to`, `visa`, `lodging_in_makkah`, `room_type_makkah`, `lodging_in_madina`, `room_type_madina`, `ticket`, `price_for_adult`, `price_for_child`, `price_for_infant`, `created_at`, `updated_at`) VALUES
(3, 'kuwait', '2023-07-11', '2023-07-11', '1', '3', 'room_for_three', '4', 'room_for_three', '2', '1265', '1244', '1315', '2023-07-21 06:18:26', '2023-07-21 01:18:26');

-- --------------------------------------------------------

--
-- Table structure for table `payment_detail_for_reservation`
--

CREATE TABLE `payment_detail_for_reservation` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `advance_amount` varchar(255) DEFAULT NULL,
  `rest_amount` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_detail_for_reservation`
--

INSERT INTO `payment_detail_for_reservation` (`id`, `reservation_id`, `payment_method`, `total_amount`, `advance_amount`, `rest_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bank Check', '1338', '120', '1218', '2023-07-28 08:58:55', '2023-07-28 08:58:55'),
(2, 2, 'Bank Check', '636', '600', '36', '2023-07-28 09:04:31', '2023-07-28 09:04:31'),
(3, 3, 'Bank Check', '44', '14', '30', '2023-07-28 11:00:35', '2023-07-29 04:03:12'),
(5, 5, 'Bank Check', '68', '20', '48', '2023-07-28 14:23:32', '2023-07-28 14:23:32'),
(6, 6, NULL, '0', NULL, '0', '2023-07-30 04:04:26', '2023-07-30 04:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `service_type` varchar(255) DEFAULT NULL,
  `reservation_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `customer_id`, `service_type`, `reservation_status`, `created_at`, `updated_at`) VALUES
(1, 7, 'package', '1', '2023-07-28 08:58:55', '2023-07-28 08:58:55'),
(2, 4, 'lodging', '1', '2023-07-28 09:04:31', '2023-07-28 09:04:31'),
(3, 21, 'visa', '1', '2023-07-28 11:00:34', '2023-07-29 04:03:11'),
(5, 15, 'transport', '1', '2023-07-28 14:23:31', '2023-07-28 14:23:31'),
(6, 19, 'flight', '0', '2023-07-30 04:04:26', '2023-07-30 04:04:26');

-- --------------------------------------------------------

--
-- Table structure for table `ticketing`
--

CREATE TABLE `ticketing` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `is_group` varchar(255) DEFAULT NULL,
  `selling_price` varchar(255) DEFAULT NULL,
  `buying_price` varchar(255) DEFAULT NULL,
  `service_price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_service`
--

CREATE TABLE `ticket_service` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `flight_type` varchar(255) DEFAULT NULL,
  `air_company` int(11) DEFAULT NULL,
  `buying_price_for_package` varchar(255) DEFAULT NULL,
  `selling_price_for_package` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticket_service`
--

INSERT INTO `ticket_service` (`id`, `name`, `type`, `flight_type`, `air_company`, `buying_price_for_package`, `selling_price_for_package`, `created_at`, `updated_at`) VALUES
(2, 'KSA Tickets', 'One Way', 'Direct', 1, '1000', '1200', '2023-07-19 03:36:56', '2023-07-19 03:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `transport_reservation`
--

CREATE TABLE `transport_reservation` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `transport_service_id` int(11) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `trip_type` varchar(255) DEFAULT NULL,
  `service_price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transport_reservation`
--

INSERT INTO `transport_reservation` (`id`, `reservation_id`, `transport_service_id`, `country`, `type`, `trip_type`, `service_price`, `created_at`, `updated_at`) VALUES
(1, 5, 5, 'MAR', 'VIP', 'Round way', '68', '2023-07-28 14:23:32', '2023-07-29 08:04:25');

-- --------------------------------------------------------

--
-- Table structure for table `transport_service`
--

CREATE TABLE `transport_service` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transport_service`
--

INSERT INTO `transport_service` (`id`, `name`, `created_at`, `updated_at`) VALUES
(4, 'Transport service', '2023-07-28 04:43:40', '2023-07-28 04:43:40'),
(5, 'Transport service 2', '2023-07-28 05:50:32', '2023-07-28 05:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `transport_service_price_for_adult`
--

CREATE TABLE `transport_service_price_for_adult` (
  `id` int(11) NOT NULL,
  `transport_service_id` int(11) DEFAULT NULL,
  `vip_morroco_buying_one` varchar(255) DEFAULT NULL,
  `vip_morroco_selling_one` varchar(255) DEFAULT NULL,
  `vip_morroco_buying_round` varchar(255) DEFAULT NULL,
  `vip_morroco_selling_round` varchar(255) DEFAULT NULL,
  `vip_ksa_buying_one` varchar(255) DEFAULT NULL,
  `vip_ksa_selling_one` varchar(255) DEFAULT NULL,
  `vip_ksa_buying_round` varchar(255) DEFAULT NULL,
  `vip_ksa_selling_round` varchar(255) DEFAULT NULL,
  `normal_morroco_buying_one` varchar(255) DEFAULT NULL,
  `normal_morroco_selling_one` varchar(255) DEFAULT NULL,
  `normal_morroco_buying_round` varchar(255) DEFAULT NULL,
  `normal_morroco_selling_round` varchar(255) DEFAULT NULL,
  `normal_ksa_buying_one` varchar(255) DEFAULT NULL,
  `normal_ksa_selling_one` varchar(255) DEFAULT NULL,
  `normal_ksa_buying_round` varchar(255) DEFAULT NULL,
  `normal_ksa_selling_round` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transport_service_price_for_adult`
--

INSERT INTO `transport_service_price_for_adult` (`id`, `transport_service_id`, `vip_morroco_buying_one`, `vip_morroco_selling_one`, `vip_morroco_buying_round`, `vip_morroco_selling_round`, `vip_ksa_buying_one`, `vip_ksa_selling_one`, `vip_ksa_buying_round`, `vip_ksa_selling_round`, `normal_morroco_buying_one`, `normal_morroco_selling_one`, `normal_morroco_buying_round`, `normal_morroco_selling_round`, `normal_ksa_buying_one`, `normal_ksa_selling_one`, `normal_ksa_buying_round`, `normal_ksa_selling_round`, `created_at`, `updated_at`) VALUES
(7, 4, '12', '13', '423', '45', '76', '89', '90', '2345', '45', '65', '6787', '9809', '43', '45', '65', '78', '2023-07-28 04:43:40', '2023-07-28 04:43:40'),
(8, 5, '123', '654', '3456', '56', '654', '45', '90', '2345', '45', '65', '6787', '9809', '43', '45', '65', '78', '2023-07-28 05:50:32', '2023-07-28 05:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `transport_service_price_for_child`
--

CREATE TABLE `transport_service_price_for_child` (
  `id` int(11) NOT NULL,
  `transport_service_id` int(11) DEFAULT NULL,
  `vip_morroco_buying_one` varchar(255) DEFAULT NULL,
  `vip_morroco_selling_one` varchar(255) DEFAULT NULL,
  `vip_morroco_buying_round` varchar(255) DEFAULT NULL,
  `vip_morroco_selling_round` varchar(255) DEFAULT NULL,
  `vip_ksa_buying_one` varchar(255) DEFAULT NULL,
  `vip_ksa_selling_one` varchar(255) DEFAULT NULL,
  `vip_ksa_buying_round` varchar(255) DEFAULT NULL,
  `vip_ksa_selling_round` varchar(255) DEFAULT NULL,
  `normal_morroco_buying_one` varchar(255) DEFAULT NULL,
  `normal_morroco_selling_one` varchar(255) DEFAULT NULL,
  `normal_morroco_buying_round` varchar(255) DEFAULT NULL,
  `normal_morroco_selling_round` varchar(255) DEFAULT NULL,
  `normal_ksa_buying_one` varchar(255) DEFAULT NULL,
  `normal_ksa_selling_one` varchar(255) DEFAULT NULL,
  `normal_ksa_buying_round` varchar(255) DEFAULT NULL,
  `normal_ksa_selling_round` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transport_service_price_for_child`
--

INSERT INTO `transport_service_price_for_child` (`id`, `transport_service_id`, `vip_morroco_buying_one`, `vip_morroco_selling_one`, `vip_morroco_buying_round`, `vip_morroco_selling_round`, `vip_ksa_buying_one`, `vip_ksa_selling_one`, `vip_ksa_buying_round`, `vip_ksa_selling_round`, `normal_morroco_buying_one`, `normal_morroco_selling_one`, `normal_morroco_buying_round`, `normal_morroco_selling_round`, `normal_ksa_buying_one`, `normal_ksa_selling_one`, `normal_ksa_buying_round`, `normal_ksa_selling_round`, `created_at`, `updated_at`) VALUES
(7, 4, '45', '56', '78', '89', '890', NULL, '45', '56', '78', '67', '78', '89', '89', '90', '23', '233', '2023-07-28 04:43:40', '2023-07-28 04:43:40'),
(8, 5, '45', '56', '78', '89', '890', '121', '45', '234', '78', '67', '78', '89', '89', '90', '23', 'krnsc', '2023-07-28 05:50:32', '2023-07-28 05:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `transport_service_price_for_infant`
--

CREATE TABLE `transport_service_price_for_infant` (
  `id` int(11) NOT NULL,
  `transport_service_id` int(11) DEFAULT NULL,
  `vip_morroco_buying_one` varchar(255) DEFAULT NULL,
  `vip_morroco_selling_one` varchar(255) DEFAULT NULL,
  `vip_morroco_buying_round` varchar(255) DEFAULT NULL,
  `vip_morroco_selling_round` varchar(255) DEFAULT NULL,
  `vip_ksa_buying_one` varchar(255) DEFAULT NULL,
  `vip_ksa_selling_one` varchar(255) DEFAULT NULL,
  `vip_ksa_buying_round` varchar(255) DEFAULT NULL,
  `vip_ksa_selling_round` varchar(255) DEFAULT NULL,
  `normal_morroco_buying_one` varchar(255) DEFAULT NULL,
  `normal_morroco_selling_one` varchar(255) DEFAULT NULL,
  `normal_morroco_buying_round` varchar(255) DEFAULT NULL,
  `normal_morroco_selling_round` varchar(255) DEFAULT NULL,
  `normal_ksa_buying_one` varchar(255) DEFAULT NULL,
  `normal_ksa_selling_one` varchar(255) DEFAULT NULL,
  `normal_ksa_buying_round` varchar(255) DEFAULT NULL,
  `normal_ksa_selling_round` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transport_service_price_for_infant`
--

INSERT INTO `transport_service_price_for_infant` (`id`, `transport_service_id`, `vip_morroco_buying_one`, `vip_morroco_selling_one`, `vip_morroco_buying_round`, `vip_morroco_selling_round`, `vip_ksa_buying_one`, `vip_ksa_selling_one`, `vip_ksa_buying_round`, `vip_ksa_selling_round`, `normal_morroco_buying_one`, `normal_morroco_selling_one`, `normal_morroco_buying_round`, `normal_morroco_selling_round`, `normal_ksa_buying_one`, `normal_ksa_selling_one`, `normal_ksa_buying_round`, `normal_ksa_selling_round`, `created_at`, `updated_at`) VALUES
(7, 4, '45', '7', '67', '68', '789', '78', '76', '45', NULL, '56', '77', '88', '55', '54', '78', '43', '2023-07-28 04:43:41', '2023-07-28 04:43:41'),
(8, 5, '45', '7', '67', '68', '789', '78', '76', '45', '33344', '56', '34', '88', '55', '54', '78', '43', '2023-07-28 05:50:32', '2023-07-28 05:50:32');

-- --------------------------------------------------------

--
-- Table structure for table `visa_price_for_individual`
--

CREATE TABLE `visa_price_for_individual` (
  `id` int(11) NOT NULL,
  `visa_service_id` int(11) DEFAULT NULL,
  `adult_buying` varchar(255) DEFAULT NULL,
  `adult_selling` varchar(255) DEFAULT NULL,
  `child_buying` varchar(255) DEFAULT NULL,
  `child_selling` varchar(255) DEFAULT NULL,
  `infant_buying` varchar(255) DEFAULT NULL,
  `infant_selling` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visa_price_for_individual`
--

INSERT INTO `visa_price_for_individual` (`id`, `visa_service_id`, `adult_buying`, `adult_selling`, `child_buying`, `child_selling`, `infant_buying`, `infant_selling`, `created_at`, `updated_at`) VALUES
(4, 1, '18', '21', '19', '22', '20', '23', '2023-07-17 13:19:43', '2023-07-17 13:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `visa_price_for_package`
--

CREATE TABLE `visa_price_for_package` (
  `id` int(11) NOT NULL,
  `visa_service_id` int(11) DEFAULT NULL,
  `adult_buying` varchar(255) DEFAULT NULL,
  `adult_selling` varchar(255) DEFAULT NULL,
  `child_buying` varchar(255) DEFAULT NULL,
  `child_selling` varchar(255) DEFAULT NULL,
  `infant_buying` varchar(255) DEFAULT NULL,
  `infant_selling` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visa_price_for_package`
--

INSERT INTO `visa_price_for_package` (`id`, `visa_service_id`, `adult_buying`, `adult_selling`, `child_buying`, `child_selling`, `infant_buying`, `infant_selling`, `created_at`, `updated_at`) VALUES
(4, 1, '12', '15', '13', '16', '14', '17', '2023-07-17 13:19:43', '2023-07-17 13:19:43');

-- --------------------------------------------------------

--
-- Table structure for table `visa_reservation`
--

CREATE TABLE `visa_reservation` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `visa_type` varchar(255) DEFAULT NULL,
  `from_date` varchar(255) DEFAULT NULL,
  `to_date` varchar(255) DEFAULT NULL,
  `length_of_stay` varchar(255) DEFAULT NULL,
  `service_price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visa_reservation`
--

INSERT INTO `visa_reservation` (`id`, `reservation_id`, `visa_type`, `from_date`, `to_date`, `length_of_stay`, `service_price`, `created_at`, `updated_at`) VALUES
(5, 3, '1', '2023-07-13', '2023-07-26', '52', '23', '2023-07-29 04:03:12', '2023-07-29 04:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `visa_service`
--

CREATE TABLE `visa_service` (
  `id` int(11) NOT NULL,
  `visa_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visa_service`
--

INSERT INTO `visa_service` (`id`, `visa_name`, `created_at`, `updated_at`) VALUES
(1, 'Kuwait visa 12', '2023-07-17 12:45:46', '2023-07-17 13:19:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `air_company`
--
ALTER TABLE `air_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carrier`
--
ALTER TABLE `carrier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collaborator`
--
ALTER TABLE `collaborator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `linked_with` (`linked_with`),
  ADD KEY `collaborator` (`collaborator`);

--
-- Indexes for table `extra_service`
--
ALTER TABLE `extra_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extra_service_for_reservation`
--
ALTER TABLE `extra_service_for_reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `extra_service_for_reservation_ibfk_1` (`reservation_id`);

--
-- Indexes for table `extra_service_price`
--
ALTER TABLE `extra_service_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `extra_service_price_ibfk_1` (`extra_service_id`);

--
-- Indexes for table `flight_reservation`
--
ALTER TABLE `flight_reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flight_id` (`flight_id`),
  ADD KEY `flight_reservation_ibfk_1` (`reservation_id`);

--
-- Indexes for table `grouping`
--
ALTER TABLE `grouping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `lodging_reservation`
--
ALTER TABLE `lodging_reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lodging_reservation_ibfk_1` (`reservation_id`);

--
-- Indexes for table `lodging_service`
--
ALTER TABLE `lodging_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lodging_service_price_for_individual`
--
ALTER TABLE `lodging_service_price_for_individual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lodging_service_price_for_individual_ibfk_1` (`lodging_service_id`);

--
-- Indexes for table `lodging_service_price_for_package`
--
ALTER TABLE `lodging_service_price_for_package`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lodging_service_price_for_package_ibfk_1` (`lodging_service_id`);

--
-- Indexes for table `package_reservation`
--
ALTER TABLE `package_reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_id` (`package_service_id`),
  ADD KEY `package_reservation_ibfk_1` (`reservation_id`);

--
-- Indexes for table `package_service`
--
ALTER TABLE `package_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_detail_for_reservation`
--
ALTER TABLE `payment_detail_for_reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment_detail_for_reservation_ibfk_1` (`reservation_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `ticketing`
--
ALTER TABLE `ticketing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_service`
--
ALTER TABLE `ticket_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `air_company` (`air_company`);

--
-- Indexes for table `transport_reservation`
--
ALTER TABLE `transport_reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transport_reservation_ibfk_1` (`reservation_id`);

--
-- Indexes for table `transport_service`
--
ALTER TABLE `transport_service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transport_service_price_for_adult`
--
ALTER TABLE `transport_service_price_for_adult`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transport_service_id` (`transport_service_id`);

--
-- Indexes for table `transport_service_price_for_child`
--
ALTER TABLE `transport_service_price_for_child`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transport_service_id` (`transport_service_id`);

--
-- Indexes for table `transport_service_price_for_infant`
--
ALTER TABLE `transport_service_price_for_infant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transport_service_id` (`transport_service_id`);

--
-- Indexes for table `visa_price_for_individual`
--
ALTER TABLE `visa_price_for_individual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visa_price_for_individual_ibfk_1` (`visa_service_id`);

--
-- Indexes for table `visa_price_for_package`
--
ALTER TABLE `visa_price_for_package`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visa_price_for_package_ibfk_1` (`visa_service_id`);

--
-- Indexes for table `visa_reservation`
--
ALTER TABLE `visa_reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visa_reservation_ibfk_1` (`reservation_id`);

--
-- Indexes for table `visa_service`
--
ALTER TABLE `visa_service`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `air_company`
--
ALTER TABLE `air_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carrier`
--
ALTER TABLE `carrier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `collaborator`
--
ALTER TABLE `collaborator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `extra_service`
--
ALTER TABLE `extra_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `extra_service_for_reservation`
--
ALTER TABLE `extra_service_for_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `extra_service_price`
--
ALTER TABLE `extra_service_price`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `flight_reservation`
--
ALTER TABLE `flight_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `grouping`
--
ALTER TABLE `grouping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lodging_reservation`
--
ALTER TABLE `lodging_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lodging_service`
--
ALTER TABLE `lodging_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lodging_service_price_for_individual`
--
ALTER TABLE `lodging_service_price_for_individual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lodging_service_price_for_package`
--
ALTER TABLE `lodging_service_price_for_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `package_reservation`
--
ALTER TABLE `package_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `package_service`
--
ALTER TABLE `package_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment_detail_for_reservation`
--
ALTER TABLE `payment_detail_for_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ticketing`
--
ALTER TABLE `ticketing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_service`
--
ALTER TABLE `ticket_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transport_reservation`
--
ALTER TABLE `transport_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transport_service`
--
ALTER TABLE `transport_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transport_service_price_for_adult`
--
ALTER TABLE `transport_service_price_for_adult`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transport_service_price_for_child`
--
ALTER TABLE `transport_service_price_for_child`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transport_service_price_for_infant`
--
ALTER TABLE `transport_service_price_for_infant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `visa_price_for_individual`
--
ALTER TABLE `visa_price_for_individual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `visa_price_for_package`
--
ALTER TABLE `visa_price_for_package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `visa_reservation`
--
ALTER TABLE `visa_reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visa_service`
--
ALTER TABLE `visa_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`linked_with`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`collaborator`) REFERENCES `collaborator` (`id`);

--
-- Constraints for table `extra_service_for_reservation`
--
ALTER TABLE `extra_service_for_reservation`
  ADD CONSTRAINT `extra_service_for_reservation_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `extra_service_price`
--
ALTER TABLE `extra_service_price`
  ADD CONSTRAINT `extra_service_price_ibfk_1` FOREIGN KEY (`extra_service_id`) REFERENCES `extra_service` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `flight_reservation`
--
ALTER TABLE `flight_reservation`
  ADD CONSTRAINT `flight_reservation_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `flight_reservation_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `ticket_service` (`id`);

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`),
  ADD CONSTRAINT `group_members_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `grouping` (`id`);

--
-- Constraints for table `lodging_reservation`
--
ALTER TABLE `lodging_reservation`
  ADD CONSTRAINT `lodging_reservation_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lodging_service_price_for_individual`
--
ALTER TABLE `lodging_service_price_for_individual`
  ADD CONSTRAINT `lodging_service_price_for_individual_ibfk_1` FOREIGN KEY (`lodging_service_id`) REFERENCES `lodging_service` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lodging_service_price_for_package`
--
ALTER TABLE `lodging_service_price_for_package`
  ADD CONSTRAINT `lodging_service_price_for_package_ibfk_1` FOREIGN KEY (`lodging_service_id`) REFERENCES `lodging_service` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_reservation`
--
ALTER TABLE `package_reservation`
  ADD CONSTRAINT `package_reservation_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `package_reservation_ibfk_2` FOREIGN KEY (`package_service_id`) REFERENCES `package_service` (`id`);

--
-- Constraints for table `payment_detail_for_reservation`
--
ALTER TABLE `payment_detail_for_reservation`
  ADD CONSTRAINT `payment_detail_for_reservation_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `ticket_service`
--
ALTER TABLE `ticket_service`
  ADD CONSTRAINT `ticket_service_ibfk_1` FOREIGN KEY (`air_company`) REFERENCES `air_company` (`id`);

--
-- Constraints for table `transport_reservation`
--
ALTER TABLE `transport_reservation`
  ADD CONSTRAINT `transport_reservation_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transport_service_price_for_adult`
--
ALTER TABLE `transport_service_price_for_adult`
  ADD CONSTRAINT `transport_service_price_for_adult_ibfk_1` FOREIGN KEY (`transport_service_id`) REFERENCES `transport_service` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transport_service_price_for_child`
--
ALTER TABLE `transport_service_price_for_child`
  ADD CONSTRAINT `transport_service_price_for_child_ibfk_1` FOREIGN KEY (`transport_service_id`) REFERENCES `transport_service` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transport_service_price_for_infant`
--
ALTER TABLE `transport_service_price_for_infant`
  ADD CONSTRAINT `transport_service_price_for_infant_ibfk_1` FOREIGN KEY (`transport_service_id`) REFERENCES `transport_service` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visa_price_for_individual`
--
ALTER TABLE `visa_price_for_individual`
  ADD CONSTRAINT `visa_price_for_individual_ibfk_1` FOREIGN KEY (`visa_service_id`) REFERENCES `visa_service` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visa_price_for_package`
--
ALTER TABLE `visa_price_for_package`
  ADD CONSTRAINT `visa_price_for_package_ibfk_1` FOREIGN KEY (`visa_service_id`) REFERENCES `visa_service` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visa_reservation`
--
ALTER TABLE `visa_reservation`
  ADD CONSTRAINT `visa_reservation_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

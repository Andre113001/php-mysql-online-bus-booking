-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2023 at 02:21 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `irosin-elavil-db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`admin_username`, `admin_password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `admin_queue_discount`
--

CREATE TABLE `admin_queue_discount` (
  `discount_id` int(11) NOT NULL,
  `discount_ticketID` varchar(255) NOT NULL,
  `discount_passengerNames` varchar(255) NOT NULL,
  `discount_type` varchar(255) NOT NULL,
  `discount_upload` varchar(255) NOT NULL,
  `discount_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_queue_discount`
--

INSERT INTO `admin_queue_discount` (`discount_id`, `discount_ticketID`, `discount_passengerNames`, `discount_type`, `discount_upload`, `discount_status`) VALUES
(18, 'K3N-T0C-KEL', 'Jordan Michael,Bryan Kobe', 'PWD', 'WALK-IN', 'TRUE'),
(19, 'P1R-QDU-J8C', 'Robert Johnny,OK Computer,Kid A', 'Senior Citizen,Student', 'WALK-IN', 'TRUE'),
(20, '43C-1SH-AYR', 'Jonathan Robbins,Jacob Frye', 'Senior Citizen,Student', '../uploads/valid_id/43C-1SH-AYR.Jonathan Robbins.1.jpg,../uploads/valid_id/43C-1SH-AYR.Jacob Frye.2.jpg', ''),
(22, 'UA2-9MU-8GK', 'Johnny Era,Robert Sy', 'Student', '../uploads/valid_id/UA2-9MU-8GK.Johnny Era.1.jpg', 'TRUE'),
(23, 'S7F-O53-6YP', 'Franklin drake,Synonyms Rogers,Adverb Strout,Jobert Proce,Craig Frank', 'Student,Student,Student', '../uploads/valid_id/S7F-O53-6YP.Adverb Strout.1.png,../uploads/valid_id/S7F-O53-6YP.Jobert Proce.2.png,../uploads/valid_id/S7F-O53-6YP.Craig Frank.3.png', 'TRUE'),
(26, '7PK-YLN-6P3', 'John Lloyd,Jordan', 'Student', '../uploads/valid_id/7PK-YLN-6P3.Jordan.1.png', ''),
(27, '7PK-YLN-6P3', 'John Lloyd,Jordan', 'Student', '../uploads/valid_id/7PK-YLN-6P3.Jordan.1.png', ''),
(28, '7PK-YLN-6P3', 'John Lloyd,Jordan', 'Student', '../uploads/valid_id/7PK-YLN-6P3.Jordan.1.png', ''),
(29, '7PK-YLN-6P3', 'John Lloyd,Jordan', 'Student', '../uploads/valid_id/7PK-YLN-6P3.Jordan.1.png', ''),
(30, '7PK-YLN-6P3', 'John Lloyd,Jordan', 'Student', '../uploads/valid_id/7PK-YLN-6P3.Jordan.1.png', ''),
(31, '6AT-XO2-52V', 'Jordan,John Lloyd', 'Student', '../uploads/valid_id/6AT-XO2-52V.John Lloyd.1.png', ''),
(32, 'U0T-T4G-HUA', 'Andre', 'Student', '../uploads/valid_id/U0T-T4G-HUA.Andre.1.png', 'TRUE'),
(33, '3JS-WE2-G0G', 'Jordan,Jordan Michael', 'PWD,Student', '../uploads/valid_id/3JS-WE2-G0G.Jordan.1.png,../uploads/valid_id/3JS-WE2-G0G.Jordan Michael.2.png', 'TRUE'),
(34, 'O01-M9U-RU1', 'Ronalds Orginal', 'Senior Citizen', '../uploads/valid_id/O01-M9U-RU1.Ronalds Orginal.1.png', 'TRUE'),
(35, '3X4-D7Q-IS9', 'Serious Mike,Johnny Lloyd,John Alberts,Ronny Dy', 'Student,Student', '../uploads/valid_id/3X4-D7Q-IS9.Johnny Lloyd.1.png,../uploads/valid_id/3X4-D7Q-IS9.Ronny Dy.2.png', 'TRUE'),
(36, 'NM9-L1M-41D', 'Jordan', 'Student', '../uploads/valid_id/NM9-L1M-41D.Jordan.1.jpg', 'TRUE');

-- --------------------------------------------------------

--
-- Table structure for table `admin_queue_gcash`
--

CREATE TABLE `admin_queue_gcash` (
  `gcash_id` int(11) NOT NULL,
  `gcash_ticketID` varchar(255) NOT NULL,
  `gcash_proof` varchar(255) NOT NULL,
  `gcash_reference` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_queue_gcash`
--

INSERT INTO `admin_queue_gcash` (`gcash_id`, `gcash_ticketID`, `gcash_proof`, `gcash_reference`) VALUES
(1, 'hQV2a-MON001-4-2023-01-23', '../uploads/gcash_proof/hQV2a-MON001-4-2023-01-23.png', '112'),
(9, 'FMJyL-MON001-4-2023-01-23', '../uploads/gcash_proof/FMJyL-MON001-4-2023-01-23.png', '1121'),
(10, 'FMJyL-MON001-4-2023-01-23', '../uploads/gcash_proof/FMJyL-MON001-4-2023-01-23.jpg', '112'),
(11, 'CF8YX-MON003-4-2023-01-23', '../uploads/gcash_proof/CF8YX-MON003-4-2023-01-23.jpg', '1223221'),
(12, '6KShd-MON002-2-2023-01-23', '../uploads/gcash_proof/6KShd-MON002-2-2023-01-23.jpg', '1123'),
(13, '6KShd-MON002-2-2023-01-23', '../uploads/gcash_proof/6KShd-MON002-2-2023-01-23.jpg', '1123'),
(14, 'uaAA6-TUE001-2-2023-01-24', '../uploads/gcash_proof/uaAA6-TUE001-2-2023-01-24.jpg', '123123'),
(15, 'XQdR4-TUE001-1-2023-01-24', '../uploads/gcash_proof/XQdR4-TUE001-1-2023-01-24.jpg', '123123'),
(16, 'oI9Yv-TUE001-1-2023-01-24', '../uploads/gcash_proof/oI9Yv-TUE001-1-2023-01-24.png', '11221122'),
(17, 'JSvYh-MON001-1-2023-01-23', '../uploads/gcash_proof/JSvYh-MON001-1-2023-01-23.png', '444'),
(18, 'Pb7y4-TUE001-1-2023-01-24', '../uploads/gcash_proof/Pb7y4-TUE001-1-2023-01-24.png', '1123'),
(19, '2ALIM-MON001-1-2023-01-23', '../uploads/gcash_proof/2ALIM-MON001-1-2023-01-23.png', '112233'),
(20, 'oRdb4-MON001-1-2023-01-23', '../uploads/gcash_proof/oRdb4-MON001-1-2023-01-23.png', '1213'),
(21, 'FVWI6-TUE001-1-2023-01-24', '../uploads/gcash_proof/FVWI6-TUE001-1-2023-01-24.png', '1123'),
(22, 'B0UHP-MON001-1-2023-01-23', '../uploads/gcash_proof/B0UHP-MON001-1-2023-01-23.png', '12312332'),
(23, 'pYDK0-MON001-1-2023-01-30', '../uploads/gcash_proof/pYDK0-MON001-1-2023-01-30.png', '1123'),
(24, '5MO0z-MON001-1-2023-01-30', '../uploads/gcash_proof/5MO0z-MON001-1-2023-01-30.png', '112312'),
(25, 'a5nmb-MON003-1-2023-01-30', '../uploads/gcash_proof/a5nmb-MON003-1-2023-01-30.jpg', '1234'),
(26, 'OmR5E-MON003-1-2023-01-30', '../uploads/gcash_proof/OmR5E-MON003-1-2023-01-30.jpg', '111'),
(27, 'O03-8H6-D3E', '../uploads/gcash_proof/O03-8H6-D3E.jpg', '112223'),
(28, 'O03-8H6-D3E', '../uploads/gcash_proof/O03-8H6-D3E.jpg', '112223'),
(29, 'O03-8H6-D3E', '../uploads/gcash_proof/O03-8H6-D3E.jpg', '112223'),
(30, 'O03-8H6-D3E', '../uploads/gcash_proof/O03-8H6-D3E.jpg', '1123'),
(31, 'UA2-9MU-8GK', '../uploads/gcash_proof/UA2-9MU-8GK.jpg', '1122333'),
(32, 'S7F-O53-6YP', '../uploads/gcash_proof/S7F-O53-6YP.png', '1122'),
(33, 'ZD7-W16-JLJ', '../uploads/gcash_proof/ZD7-W16-JLJ.png', '1122'),
(34, 'NK6-6CY-8NN', '../uploads/gcash_proof/NK6-6CY-8NN.png', '112233'),
(35, 'EF1-AHT-MRX', '../uploads/gcash_proof/EF1-AHT-MRX.png', '1122'),
(36, 'YBG-O1W-RSQ', '../uploads/gcash_proof/YBG-O1W-RSQ.png', '777'),
(37, 'U0T-T4G-HUA', '../uploads/gcash_proof/U0T-T4G-HUA.png', '1122'),
(38, '3JS-WE2-G0G', '../uploads/gcash_proof/3JS-WE2-G0G.png', '112'),
(39, 'O01-M9U-RU1', '../uploads/gcash_proof/O01-M9U-RU1.png', '1122'),
(40, '3X4-D7Q-IS9', '../uploads/gcash_proof/3X4-D7Q-IS9.png', '1122');

-- --------------------------------------------------------

--
-- Table structure for table `bus_booking`
--

CREATE TABLE `bus_booking` (
  `booking_officialID` int(11) NOT NULL,
  `booking_id` varchar(50) DEFAULT NULL,
  `booking_date` date NOT NULL,
  `booking_added` datetime NOT NULL,
  `booking_passengers` varchar(255) NOT NULL,
  `booking_busCode` varchar(50) DEFAULT NULL,
  `booking_busType` varchar(255) DEFAULT NULL,
  `booking_seatChosen` varchar(255) DEFAULT NULL,
  `booking_seatFare` int(50) DEFAULT NULL,
  `booking_customerName` varchar(255) DEFAULT NULL,
  `booking_customerEmail` varchar(255) DEFAULT NULL,
  `booking_customerContact` varchar(15) DEFAULT NULL,
  `booking_gender` varchar(255) DEFAULT NULL,
  `booking_cargo` int(11) NOT NULL,
  `booking_departure` varchar(255) DEFAULT NULL,
  `booking_departureTime` time DEFAULT NULL,
  `booking_arrival` varchar(255) DEFAULT NULL,
  `booking_arrivalTime` time DEFAULT NULL,
  `booking_discountStatus` varchar(255) NOT NULL,
  `booking_status` varchar(255) NOT NULL,
  `booking_referenceStatus` varchar(255) NOT NULL,
  `booking_refund` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_booking`
--

INSERT INTO `bus_booking` (`booking_officialID`, `booking_id`, `booking_date`, `booking_added`, `booking_passengers`, `booking_busCode`, `booking_busType`, `booking_seatChosen`, `booking_seatFare`, `booking_customerName`, `booking_customerEmail`, `booking_customerContact`, `booking_gender`, `booking_cargo`, `booking_departure`, `booking_departureTime`, `booking_arrival`, `booking_arrivalTime`, `booking_discountStatus`, `booking_status`, `booking_referenceStatus`, `booking_refund`) VALUES
(54, 'P1R-QDU-J8C', '2023-02-06', '2023-02-12 10:10:41', 'Robert Johnny,OK Computer,Kid A', 'MON001', 'Ordinary', '14,19,15', 2100, 'WALK-IN', 'WALK-IN', 'WALK-IN', 'WALK-IN', 0, 'Irosin', '17:30:00', 'Cubao', '08:00:00', 'TRUE', 'PAID', 'TRUE', ''),
(58, 'UA2-9MU-8GK', '2023-02-06', '2023-02-04 08:21:48', 'Johnny Era,Robert Sy', 'MON003', 'Aircon', '4,9', 3000, 'Logan Paul', 'loganpaul@gmail.com', '09234672341', 'Male', 0, 'Irosin', '14:00:00', 'Cubao', '05:00:00', 'TRUE', 'PAID', 'FALSE', ''),
(59, 'S7F-O53-6YP', '2023-02-06', '2023-02-04 08:21:51', 'Franklin drake,Synonyms Rogers,Adverb Strout,Jobert Proce,Craig Frank', 'MON003', 'Aircon', '56,57,58,59,60', 7500, 'Logan Paul', 'loganpaul@gmail.com', '09234672341', 'Male', 0, 'Irosin', '14:00:00', 'Cubao', '05:00:00', 'TRUE', 'PAID', 'FALSE', ''),
(69, 'YBG-O1W-RSQ', '2023-02-06', '2023-02-12 10:45:27', 'Trent', 'MON001', 'Ordinary', '1', 700, 'Andre  Genorga', '1130marcusa@gmail.com', '09123322123', 'Female', 0, 'Irosin', '17:30:00', 'Cubao', '08:00:00', 'TRUE', 'PAID', 'FALSE', ''),
(82, 'O01-M9U-RU1', '2023-02-20', '2023-02-13 22:54:47', ' Jolibee', 'MON001', 'Ordinary', '4', 700, 'Andre Gig', '1130marcusa@gmail.com', '09999232323', 'Male', 0, 'Irosin', '17:30:00', 'Cubao', '08:00:00', 'TRUE', 'PAID', 'FALSE', ''),
(83, '3X4-D7Q-IS9', '2023-02-20', '2023-02-13 22:53:07', 'Serious Mike,Johnny Lloyd,John Alberts,Ronny Dy', 'MON001', 'Ordinary', '4,9,5,10', 2800, 'Andre Gig', '1130marcusa@gmail.com', '09999232323', 'Male', 0, 'Irosin', '17:30:00', 'Cubao', '08:00:00', 'TRUE', 'ON QUEUE', 'FALSE', ''),
(84, 'NM9-L1M-41D', '2023-02-20', '2023-02-13 22:17:39', 'John Lloyd', 'MON001', 'Ordinary', '29', 700, 'Andre Gig', '1130marcusa@gmail.com', '09999232323', 'Male', 0, 'Irosin', '17:30:00', 'Cubao', '08:00:00', 'TRUE', 'ON QUEUE', 'TRUE', 'WHOLE TICKET');

-- --------------------------------------------------------

--
-- Table structure for table `bus_details`
--

CREATE TABLE `bus_details` (
  `bus_id` int(11) NOT NULL,
  `bus_code` varchar(10) NOT NULL,
  `bus_platenum` varchar(10) NOT NULL,
  `bus_type` varchar(255) NOT NULL,
  `bus_driver` varchar(255) NOT NULL,
  `bus_conductor` varchar(255) NOT NULL,
  `bus_seats` int(50) NOT NULL,
  `bus_schedule` varchar(255) NOT NULL,
  `bus_departureTime` time NOT NULL,
  `bus_arrivalTime` time NOT NULL,
  `bus_fare` int(11) NOT NULL,
  `bus_departure` varchar(255) NOT NULL,
  `bus_arrival` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_details`
--

INSERT INTO `bus_details` (`bus_id`, `bus_code`, `bus_platenum`, `bus_type`, `bus_driver`, `bus_conductor`, `bus_seats`, `bus_schedule`, `bus_departureTime`, `bus_arrivalTime`, `bus_fare`, `bus_departure`, `bus_arrival`) VALUES
(7, 'MON001', 'PLT 9090', 'Ordinary', 'Jon Snow', 'Joji', 60, 'Monday', '17:30:00', '08:00:00', 700, 'Irosin', 'Cubao'),
(8, 'MON002', 'NIB 1021', 'Aircon', 'Coffeezilla', 'MoistCritical', 60, 'Monday', '15:00:00', '06:00:00', 1500, 'Irosin', 'Pasay'),
(9, 'MON003', 'GUS 8912', 'Aircon', 'PewDiePie', 'Markiplier', 60, 'Monday', '14:00:00', '05:00:00', 1500, 'Irosin', 'Cubao'),
(10, 'MON004', 'POW 2231', 'Ordinary', 'Johnny Cage', 'Jenna Ortega', 60, 'Monday', '01:05:00', '04:00:00', 700, 'Irosin', 'Pasay'),
(11, 'TUE001', 'SUS 420', 'Ordinary', 'John Cena', 'Peter Parker', 60, 'Tuesday', '15:00:00', '05:00:00', 800, 'Irosin', 'Pasay');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_contactnum` varchar(11) NOT NULL,
  `customer_password` varchar(255) NOT NULL,
  `customer_gender` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `customer_email`, `customer_contactnum`, `customer_password`, `customer_gender`) VALUES
(2, 'Logan Paul', 'loganpaul@gmail.com', '09234672341', '5cdf113ffd8b0f4d005f5ad39d4fb2e1', 'Male'),
(3, 'Logan Paul', 'loganpaul@gmail.com', '09234672341', '5cdf113ffd8b0f4d005f5ad39d4fb2e1', 'Male'),
(4, 'Jake Paul', 'jakepaul@gmail.com', '09123344532', '5cdf113ffd8b0f4d005f5ad39d4fb2e1', 'Male'),
(5, 'Administrator Jugger', 'admin@gmail.com', '09123343212', '5cdf113ffd8b0f4d005f5ad39d4fb2e1', 'Female'),
(6, 'Motahar TheOne', 'motahar@gmail', '1092', '5cdf113ffd8b0f4d005f5ad39d4fb2e1', 'Male'),
(7, 'Motahar TheOne', 'motahar@gmail', '1092', '5cdf113ffd8b0f4d005f5ad39d4fb2e1', 'Male'),
(8, 'Finn The Human', 'finn@gmail.com', '09123322123', 'e192edc5e874f3227f235cbd39691a7d', 'Male'),
(9, 'testin dummy01', 'testing@gmail.com', '09123321111', '5cdf113ffd8b0f4d005f5ad39d4fb2e1', 'Male'),
(10, 'Justine Bieber', 'jb@gmail.com', '09123322123', '5cdf113ffd8b0f4d005f5ad39d4fb2e1', 'Male'),
(11, 'Tom Hollan', 'tomholland@gmail.com', '09123344322', '5cdf113ffd8b0f4d005f5ad39d4fb2e1', 'Male'),
(12, 'Johnny Bravo', 'bravo@gmail.com', '09892233456', '5cdf113ffd8b0f4d005f5ad39d4fb2e1', 'Male'),
(13, 'Andre Genorga', 'andre@gmail.com', '+6394875322', '5cdf113ffd8b0f4d005f5ad39d4fb2e1', 'Male'),
(18, 'Andre Gig', '1130marcusa@gmail.com', '09999232323', '5cdf113ffd8b0f4d005f5ad39d4fb2e1', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `customer_cancellation`
--

CREATE TABLE `customer_cancellation` (
  `cancel_id` int(11) NOT NULL,
  `cancel_ticketID` varchar(255) NOT NULL,
  `cancel_busCode` varchar(255) NOT NULL,
  `cancel_busDeparture` varchar(255) NOT NULL,
  `cancel_customerName` varchar(255) NOT NULL,
  `cancel_reason` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_cancellation`
--

INSERT INTO `customer_cancellation` (`cancel_id`, `cancel_ticketID`, `cancel_busCode`, `cancel_busDeparture`, `cancel_customerName`, `cancel_reason`) VALUES
(61, 'O01-M9U-RU1', 'MON001', 'Irosin', 'Andre Gig', 'Refund');

-- --------------------------------------------------------

--
-- Table structure for table `customer_feedback`
--

CREATE TABLE `customer_feedback` (
  `feedback_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `feedback_text` text NOT NULL,
  `feedback_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_feedback`
--

INSERT INTO `customer_feedback` (`feedback_id`, `customer_id`, `customer_name`, `feedback_text`, `feedback_date`) VALUES
(438, 0, '', '', '2023-01-10'),
(439, 1, 'Andre  Genorga', 'Helpasdad', '2023-01-10'),
(440, 1, 'Andre  Genorga', 'Hi I\'m andre and I love your website!', '2023-01-10'),
(441, 11, 'Tom Hollan', 'Hi! I love your bus, it\'s neat!', '2023-01-11'),
(442, 1, 'Andre  Genorga', 'hi!', '2023-01-12'),
(443, 12, 'Johnny Bravo', 'Hello I\'m johnny bravo!', '2023-01-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_queue_discount`
--
ALTER TABLE `admin_queue_discount`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `admin_queue_gcash`
--
ALTER TABLE `admin_queue_gcash`
  ADD PRIMARY KEY (`gcash_id`);

--
-- Indexes for table `bus_booking`
--
ALTER TABLE `bus_booking`
  ADD PRIMARY KEY (`booking_officialID`);

--
-- Indexes for table `bus_details`
--
ALTER TABLE `bus_details`
  ADD PRIMARY KEY (`bus_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_cancellation`
--
ALTER TABLE `customer_cancellation`
  ADD PRIMARY KEY (`cancel_id`);

--
-- Indexes for table `customer_feedback`
--
ALTER TABLE `customer_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_queue_discount`
--
ALTER TABLE `admin_queue_discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `admin_queue_gcash`
--
ALTER TABLE `admin_queue_gcash`
  MODIFY `gcash_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `bus_booking`
--
ALTER TABLE `bus_booking`
  MODIFY `booking_officialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `bus_details`
--
ALTER TABLE `bus_details`
  MODIFY `bus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customer_cancellation`
--
ALTER TABLE `customer_cancellation`
  MODIFY `cancel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `customer_feedback`
--
ALTER TABLE `customer_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=444;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

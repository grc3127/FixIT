-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2026 at 03:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `try`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_status`
--

CREATE TABLE `account_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_status`
--

INSERT INTO `account_status` (`status_id`, `status_name`) VALUES
(1, 'Active'),
(2, 'Suspended'),
(3, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(1) NOT NULL,
  `dept_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_name`) VALUES
(1, 'Administration'),
(2, 'Technical'),
(3, 'Sales'),
(4, 'Finance'),
(5, 'Marketing'),
(6, 'Operations'),
(7, 'Human Resources'),
(8, 'Finance');

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `device_id` int(11) NOT NULL,
  `device_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`device_id`, `device_name`) VALUES
(1, 'Desktop Computer'),
(2, 'Laptop'),
(3, 'Tablet'),
(4, 'Monitor'),
(5, 'Keyboard'),
(6, 'Mouse'),
(7, 'Printer'),
(8, 'Scanner'),
(9, 'Router'),
(10, 'Switch'),
(11, 'Access Point'),
(12, 'UPS'),
(13, 'Network Cable LAN'),
(14, 'IP Phone'),
(15, 'Webcam'),
(16, 'Headset');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `dept_id` int(2) NOT NULL DEFAULT 2,
  `role_id` int(2) NOT NULL DEFAULT 2,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_num` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status_id` int(2) NOT NULL DEFAULT 1,
  `profile_pic` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `first_name`, `middle_name`, `last_name`, `dept_id`, `role_id`, `password_hash`, `email`, `mobile_num`, `address`, `status_id`, `profile_pic`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'I', 'strator', 1, 1, '$2y$12$6SNsE.EipJC1WXeCAQD3/uFazM82zF4RWg7y2wDNlU7WzuACIT2Yu', 'admin@gmail.com', '09000000001', 'San Fernando City', 1, '/img/profile_pic/administrator.jpg', '2026-03-25 08:04:30', '2026-04-09 10:34:14'),
(2, 'Augusto', 'Patacsil', 'Manzana', 1, 1, '$2y$12$6SNsE.EipJC1WXeCAQD3/uFazM82zF4RWg7y2wDNlU7WzuACIT2Yu', 'augusto.manzana@gmail.com', '09000000002', 'Bauang', 1, '', '2026-03-25 08:04:30', '2026-03-30 03:31:23'),
(3, 'Gladwin', 'Pedronio', 'Garcia', 2, 2, '$2y$12$6SNsE.EipJC1WXeCAQD3/uFazM82zF4RWg7y2wDNlU7WzuACIT2Yu', 'gladwin.garcia@gmail.com', '09000000003', 'Agoo', 1, '', '2026-03-25 08:04:30', '2026-03-30 03:31:27'),
(4, 'Gelo Ryann', 'Mendoza', 'Carbonell', 2, 2, '$2y$12$6SNsE.EipJC1WXeCAQD3/uFazM82zF4RWg7y2wDNlU7WzuACIT2Yu', 'geloryann.carbonell@gmail.com', '09000000004', 'San Fernando City', 1, '/img/profile_pic/profile_69d781a513d367.02598208.jpg', '2026-03-25 08:04:30', '2026-04-09 10:38:29'),
(5, 'Collette', 'Lindenman', 'Thorin', 3, 3, '$2y$12$6SNsE.EipJC1WXeCAQD3/uFazM82zF4RWg7y2wDNlU7WzuACIT2Yu', 'collette.thorin@gmail.com', '09000000005', 'Luna', 1, '/img/profile_pic/collete.jpg', '2026-03-25 08:38:21', '2026-04-09 10:34:14'),
(6, 'Carma', 'Revie', 'Jehu', 3, 3, '$2y$12$6SNsE.EipJC1WXeCAQD3/uFazM82zF4RWg7y2wDNlU7WzuACIT2Yu', 'carma.jehu@gmail.com', '09000000006', 'Balaoan', 1, '/img/profile_pic/carma.png', '2026-03-25 08:38:21', '2026-04-09 10:34:14'),
(7, 'Arley', 'Houtbie', 'Ted', 4, 3, '$2y$12$6SNsE.EipJC1WXeCAQD3/uFazM82zF4RWg7y2wDNlU7WzuACIT2Yu', 'arley.ted@gmail.com', '09000000007', 'Rosario', 1, '/img/profile_pic/arley.jpg', '2026-03-25 08:38:21', '2026-04-09 10:34:14'),
(8, 'Nicolai', 'Plampeyn', 'Devora', 5, 3, '$2y$12$6SNsE.EipJC1WXeCAQD3/uFazM82zF4RWg7y2wDNlU7WzuACIT2Yu', 'nicolai.devora@gmail.com', '09000000008', 'Bagulin', 1, '/img/profile_pic/nicolai.png', '2026-03-25 08:38:21', '2026-04-09 10:34:14'),
(9, 'Rorke', 'Dallon', 'Tandy', 6, 3, '$2y$12$6SNsE.EipJC1WXeCAQD3/uFazM82zF4RWg7y2wDNlU7WzuACIT2Yu', 'rorke.tandy@gmail.com', '09000000009', 'Bacnotan', 1, '/img/profile_pic/roke.jpg', '2026-03-25 08:38:21', '2026-04-09 10:34:14'),
(10, 'Paquito', 'Maplethorpe', 'Yancey', 7, 3, '$2y$12$6SNsE.EipJC1WXeCAQD3/uFazM82zF4RWg7y2wDNlU7WzuACIT2Yu', 'paquito.yancey@gmail.com', '09000000010', 'Sudipen', 1, '/img/profile_pic/paquito.png', '2026-03-25 08:38:21', '2026-04-09 10:34:14'),
(11, 'Anya', 'Macewan', 'Genny', 8, 3, '$2y$12$6SNsE.EipJC1WXeCAQD3/uFazM82zF4RWg7y2wDNlU7WzuACIT2Yu', 'anya.genny@gmail.com', '09000000011', 'Bangar', 1, '/img/profile_pic/anya.png', '2026-03-25 08:38:21', '2026-04-09 10:34:14'),
(12, 'OIIAI', 'OIIAI', 'OIIAI', 2, 3, '$2y$10$jWNKofdBaTcycjEdZ2cZWetG.fXJUaBCZ6Q54bPUvqBmJmftMWK7S', 'oiiai@gmail.com', '1234561234546', 'sfclu', 1, '/img/profile_pic/profile_69d85238f09388.30918487.jpg', '2026-04-10 01:28:24', '2026-04-10 01:28:24');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `j_ticket_id` int(11) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `comments` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `j_ticket_id`, `rating`, `comments`, `created_at`) VALUES
(1, 1, 5.0, 'Fast and efficient service', '2026-04-06 22:37:16'),
(2, 2, 4.5, 'Issue resolved properly', '2026-04-06 22:37:16'),
(3, 3, 4.0, 'Good service', '2026-04-06 22:37:16'),
(4, 4, 4.5, 'Technician was helpful', '2026-04-06 22:37:16'),
(5, 5, 3.5, 'Resolved but took time', '2026-04-06 22:37:16'),
(6, 6, 5.0, 'Very satisfied', '2026-04-06 22:37:16'),
(7, 7, 4.0, 'Good fix', '2026-04-06 22:37:16'),
(8, 8, 4.5, 'Quick response', '2026-04-06 22:37:16'),
(9, 9, 2.0, 'Could not fix device', '2026-04-06 22:37:16'),
(10, 10, 4.5, 'Working fine now', '2026-04-06 22:37:16'),
(11, 11, 4.0, 'Audio fixed', '2026-04-06 22:37:16'),
(12, 12, 4.5, 'Screen issue resolved', '2026-04-06 22:37:16'),
(13, 13, 4.0, 'USB working now', '2026-04-06 22:37:16'),
(14, 14, 4.5, 'Boot issue fixed', '2026-04-06 22:37:16'),
(15, 15, 4.0, 'Looks good now', '2026-04-06 22:37:16'),
(16, 16, 4.5, 'Noise gone', '2026-04-06 22:37:16'),
(17, 17, 5.0, 'WiFi working', '2026-04-06 22:37:16'),
(18, 18, 4.5, 'Battery replaced', '2026-04-06 22:37:16'),
(19, 19, 4.0, 'No more errors', '2026-04-06 22:37:16'),
(20, 20, 4.5, 'Power issue fixed', '2026-04-06 22:37:16'),
(21, 21, 5.0, 'Faster system now', '2026-04-06 22:37:16'),
(22, 22, 4.0, 'Keyboard replaced', '2026-04-06 22:37:16'),
(23, 23, 4.5, 'Display fixed', '2026-04-06 22:37:16'),
(24, 24, 4.0, 'Boot issue resolved', '2026-04-06 22:37:16'),
(25, 25, 4.5, 'LAN working', '2026-04-06 22:37:16'),
(26, 26, 4.0, 'Mouse replaced', '2026-04-06 22:37:16'),
(27, 27, 4.5, 'Temperature normal', '2026-04-06 22:37:16'),
(28, 28, 5.0, 'Boot faster now', '2026-04-06 22:37:16'),
(29, 29, 4.0, 'Display working', '2026-04-06 22:37:16'),
(30, 30, 3.5, 'Unit disposed properly', '2026-04-06 22:37:16'),
(31, 31, 4.5, 'Signal restored', '2026-04-06 22:37:16'),
(32, 32, 4.0, 'Printer fixed', '2026-04-06 22:37:16'),
(33, 33, 4.5, 'Scanner working', '2026-04-06 22:37:16'),
(34, 34, 4.0, 'Router stable', '2026-04-06 22:37:16'),
(35, 35, 4.0, 'Switch fixed', '2026-04-06 22:37:16'),
(36, 36, 4.5, 'UPS working', '2026-04-06 22:37:16'),
(37, 37, 4.0, 'Cable replaced', '2026-04-06 22:37:16'),
(38, 38, 4.5, 'Phone updated', '2026-04-06 22:37:16'),
(39, 39, 4.0, 'Webcam works now', '2026-04-06 22:37:16'),
(40, 40, 4.5, 'Headset replaced', '2026-04-06 22:37:16'),
(41, 41, 4.5, 'No more restart issue', '2026-04-06 22:37:16'),
(42, 42, 4.0, 'Boot issue fixed', '2026-04-06 22:37:16'),
(43, 43, 5.0, 'Performance improved', '2026-04-06 22:37:16'),
(44, 44, 4.0, 'Cooling fixed', '2026-04-06 22:37:16'),
(45, 45, 4.5, 'Port repaired', '2026-04-06 22:37:16'),
(46, 46, 3.5, 'Handled disposal well', '2026-04-06 22:37:16'),
(47, 47, 4.5, 'WiFi fixed', '2026-04-06 22:37:16'),
(48, 48, 4.0, 'Stable system now', '2026-04-06 22:37:16'),
(49, 49, 4.0, 'Keyboard cleaned', '2026-04-06 22:37:16'),
(50, 50, 4.5, 'Battery replaced', '2026-04-06 22:37:16'),
(51, 51, 5.0, 'Excellent support, very professional.', '2026-04-06 22:37:16'),
(52, 52, 4.5, 'Keyboard replacement was seamless.', '2026-04-06 22:37:16'),
(53, 53, 4.0, 'Quick fix on the laptop display.', '2026-04-06 22:37:16'),
(54, 54, 5.0, 'Highly recommended technician.', '2026-04-06 22:37:16'),
(55, 55, 4.5, 'Issue solved properly and on time.', '2026-04-06 22:37:16'),
(56, 56, 4.0, 'Great service, as usual.', '2026-04-06 22:37:16'),
(57, 57, 4.5, 'The network is much faster now.', '2026-04-06 22:37:16'),
(58, 58, 5.0, 'Thank you for the quick response.', '2026-04-06 22:37:16'),
(59, 59, 4.0, 'Technician explained the fix well.', '2026-04-06 22:37:16'),
(60, 60, 4.5, 'Device working perfectly now.', '2026-04-06 22:37:16'),
(61, 61, 4.5, 'The laptop speed is much better now.', '2026-04-06 22:37:16'),
(62, 62, 5.0, 'Quick turnaround on the repair.', '2026-04-06 22:37:16'),
(63, 63, 4.0, 'Technician was very professional.', '2026-04-06 22:37:16'),
(64, 64, 4.5, 'Issue with the port was solved.', '2026-04-06 22:37:16'),
(65, 65, 5.0, 'Excellent technical support.', '2026-04-06 22:37:16'),
(66, 66, 4.0, 'Satisfied with the result.', '2026-04-06 22:37:16'),
(67, 67, 4.5, 'Very helpful and efficient.', '2026-04-06 22:37:16'),
(68, 68, 5.0, 'Keyboard replacement works perfectly.', '2026-04-06 22:37:16'),
(69, 69, 4.0, 'Handled the request professionally.', '2026-04-06 22:37:16'),
(70, 70, 4.5, 'Everything is back to normal.', '2026-04-06 22:37:16'),
(71, 71, 4.5, 'Resolved the login issue quickly.', '2026-04-06 22:37:16'),
(72, 72, 5.0, 'System is stable after the update.', '2026-04-06 22:37:16'),
(73, 73, 4.0, 'Helpful technician and great service.', '2026-04-06 22:37:16'),
(74, 74, 4.5, 'Replaced the faulty cable promptly.', '2026-04-06 22:37:16'),
(75, 75, 5.0, 'The network speed has improved.', '2026-04-06 22:37:16'),
(76, 76, 4.0, 'Fixed the software error as requested.', '2026-04-06 22:37:16'),
(77, 77, 4.5, 'Very professional and efficient work.', '2026-04-06 22:37:16'),
(78, 78, 5.0, 'Device is working like new again.', '2026-04-06 22:37:16'),
(79, 79, 4.0, 'Good communication throughout the process.', '2026-04-06 22:37:16'),
(80, 80, 4.5, 'The repair was handled expertly.', '2026-04-06 22:37:16'),
(81, 81, 4.0, 'Very happy with the printer setup.', '2026-04-06 22:37:16'),
(82, 82, 5.0, 'Fixed the connectivity issues in the conference room.', '2026-04-06 22:37:16'),
(83, 83, 4.5, 'Software installation was handled perfectly.', '2026-04-06 22:37:16'),
(84, 84, 4.0, 'Prompt service and clear instructions provided.', '2026-04-06 22:37:16'),
(85, 85, 5.0, 'The technician was knowledgeable and polite.', '2026-04-06 22:37:16'),
(86, 86, 4.5, 'Great support for the email migration.', '2026-04-06 22:37:16'),
(87, 87, 4.0, 'Resolved the hardware conflict efficiently.', '2026-04-06 22:37:16'),
(88, 88, 5.0, 'Highly satisfied with the screen replacement.', '2026-04-06 22:37:16'),
(89, 89, 4.5, 'The team was very responsive to my request.', '2026-04-06 22:37:16'),
(90, 90, 5.0, 'Everything is working smoothly now. Thanks!', '2026-04-06 22:37:16'),
(91, 91, 5.0, 'Excellent service, resolved my technical issues promptly.', '2026-04-06 22:37:16'),
(92, 92, 4.5, 'Very helpful technician, highly recommend.', '2026-04-06 22:37:16'),
(93, 93, 4.0, 'Quick response and fixed the problem efficiently.', '2026-04-06 22:37:16'),
(94, 94, 4.5, 'Satisfied with the outcome of the request.', '2026-04-06 22:37:16'),
(95, 95, 5.0, 'Professional and knowledgeable staff.', '2026-04-06 22:37:16'),
(96, 96, 4.0, 'Great communication throughout the process.', '2026-04-06 22:37:16'),
(97, 97, 4.5, 'Issue was resolved faster than expected.', '2026-04-06 22:37:16'),
(98, 98, 5.0, 'Technician was polite and very capable.', '2026-04-06 22:37:16'),
(99, 99, 4.5, 'Everything works perfectly now, thank you!', '2026-04-06 22:37:16'),
(100, 100, 5.0, 'Top-notch support, very impressed.', '2026-04-06 22:37:16'),
(101, 101, 4.0, 'Problem solved with minimal downtime.', '2026-04-06 22:37:16'),
(102, 102, 4.5, 'Friendly service and great results.', '2026-04-06 22:37:16'),
(103, 103, 5.0, 'Efficient handling of my support ticket.', '2026-04-06 22:37:16'),
(104, 104, 4.0, 'The fix was simple and explained well.', '2026-04-06 22:37:16'),
(105, 105, 4.5, 'High quality work, very satisfied.', '2026-04-06 22:37:16'),
(106, 106, 5.0, 'The team was very responsive.', '2026-04-06 22:37:16'),
(107, 107, 4.0, 'Good troubleshooting steps taken.', '2026-04-06 22:37:16'),
(108, 108, 4.5, 'Successful resolution of the network issue.', '2026-04-06 22:37:16'),
(109, 109, 5.0, 'Appreciate the quick turnaround.', '2026-04-06 22:37:16'),
(110, 110, 4.5, 'Technician was very thorough.', '2026-04-06 22:37:16'),
(111, 111, 4.0, 'Solved the software glitch effectively.', '2026-04-06 22:37:16'),
(112, 112, 4.5, 'System is back up and running smoothly.', '2026-04-06 22:37:16'),
(113, 113, 5.0, 'Great experience with the IT support.', '2026-04-06 22:37:16'),
(114, 114, 4.0, 'Helpful guidance provided during the fix.', '2026-04-06 22:37:16'),
(115, 115, 4.5, 'Excellent attention to detail.', '2026-04-06 22:37:16'),
(116, 116, 5.0, 'Very professional handling of the request.', '2026-04-06 22:37:16'),
(117, 117, 4.5, 'The problem has not recurred since the fix.', '2026-04-06 22:37:16'),
(118, 118, 4.0, 'Fast and reliable service provided.', '2026-04-06 22:37:16'),
(119, 119, 4.5, 'Very satisfied with the repair work.', '2026-04-06 22:37:16'),
(120, 120, 5.0, 'Professionalism at its best.', '2026-04-06 22:37:16'),
(121, 121, 4.0, 'Clear instructions given for future use.', '2026-04-06 22:37:16'),
(122, 122, 4.5, 'The support was exactly what I needed.', '2026-04-06 22:37:16'),
(123, 123, 5.0, 'Exceptional service from the start.', '2026-04-06 22:37:16'),
(124, 124, 4.5, 'Quickly identified and solved the bug.', '2026-04-06 22:37:16'),
(125, 125, 4.0, 'Very polite and professional technician.', '2026-04-06 22:37:16'),
(126, 126, 4.5, 'Outstanding technical assistance.', '2026-04-06 22:37:16'),
(127, 127, 5.0, 'Always great to work with this team.', '2026-04-06 22:37:16'),
(128, 128, 4.5, 'They went above and beyond.', '2026-04-06 22:37:16'),
(129, 129, 4.0, 'Solid performance and quick fix.', '2026-04-06 22:37:16'),
(130, 130, 4.5, 'Great value in the service provided.', '2026-04-06 22:37:16'),
(131, 131, 5.0, 'Took care of everything efficiently.', '2026-04-06 22:37:16'),
(132, 132, 4.5, 'A pleasure to deal with.', '2026-04-06 22:37:16'),
(133, 133, 4.0, 'Very happy with the prompt assistance.', '2026-04-06 22:37:16'),
(134, 134, 4.5, 'Smooth process from start to finish.', '2026-04-06 22:37:16'),
(135, 135, 5.0, 'Truly a professional team.', '2026-04-06 22:37:16'),
(136, 136, 4.5, 'Solved my connectivity issue in minutes.', '2026-04-06 22:37:16'),
(137, 137, 4.0, 'They know their stuff!', '2026-04-06 22:37:16'),
(138, 138, 4.5, 'Very effective troubleshooting.', '2026-04-06 22:37:16'),
(139, 139, 5.0, 'Reliable and friendly technician.', '2026-04-06 22:37:16'),
(140, 140, 4.5, 'Prompt and effective resolution.', '2026-04-06 22:37:16'),
(141, 141, 4.0, 'Highly satisfied with the IT department.', '2026-04-06 22:37:16'),
(142, 142, 4.5, 'Quickly fixed my monitor issues.', '2026-04-06 22:37:16'),
(143, 143, 5.0, 'Very impressive response time.', '2026-04-06 22:37:16'),
(144, 144, 4.5, 'Service was excellent as always.', '2026-04-06 22:37:16'),
(145, 145, 4.0, 'Everything was handled correctly.', '2026-04-06 22:37:16'),
(146, 146, 4.5, 'The technician was very helpful.', '2026-04-06 22:37:16'),
(147, 147, 5.0, 'Great communication and fast results.', '2026-04-06 22:37:16'),
(148, 148, 4.5, 'Problem resolved without any issues.', '2026-04-06 22:37:16'),
(149, 149, 4.0, 'A+ service from the IT team.', '2026-04-06 22:37:16'),
(150, 150, 4.5, 'Satisfied with the technical support.', '2026-04-06 22:37:16'),
(151, 151, 5.0, 'Excellent troubleshooting skills.', '2026-04-06 22:37:16'),
(152, 152, 4.5, 'Knowledgeable and efficient service.', '2026-04-06 22:37:16'),
(153, 153, 4.0, 'Prompt fix of the printing issue.', '2026-04-06 22:37:16'),
(154, 154, 4.5, 'Very professional demeanor.', '2026-04-06 22:37:16'),
(155, 155, 5.0, 'Appreciate the technical guidance.', '2026-04-06 22:37:16'),
(156, 156, 4.5, 'Handled the laptop repair perfectly.', '2026-04-06 22:37:16'),
(157, 157, 4.0, 'Great follow-up on the ticket.', '2026-04-06 22:37:16'),
(158, 158, 4.5, 'Issue resolved in a timely manner.', '2026-04-06 22:37:16'),
(159, 159, 5.0, 'Highly professional tech support.', '2026-04-06 22:37:16'),
(160, 160, 4.5, 'Excellent solution to the problem.', '2026-04-06 22:37:16'),
(161, 161, 4.0, 'Reliable assistance whenever needed.', '2026-04-06 22:37:16'),
(162, 162, 4.5, 'The support was quick and thorough.', '2026-04-06 22:37:16'),
(163, 163, 5.0, 'Very impressed with the repair quality.', '2026-04-06 22:37:16'),
(164, 164, 4.5, 'Efficient and polite staff.', '2026-04-06 22:37:16'),
(165, 165, 4.0, 'Prompt resolution of the software bug.', '2026-04-06 22:37:16'),
(166, 166, 4.5, 'Very satisfied with the help desk.', '2026-04-06 22:37:16'),
(167, 167, 5.0, 'Always helpful and professional.', '2026-04-06 22:37:16'),
(168, 168, 4.5, 'Excellent service delivery.', '2026-04-06 22:37:16'),
(169, 169, 4.0, 'Handled the server issue expertly.', '2026-04-06 22:37:16'),
(170, 170, 4.5, 'The fix was exactly what was needed.', '2026-04-06 22:37:16'),
(171, 171, 5.0, 'Top quality technical assistance.', '2026-04-06 22:37:16'),
(172, 172, 4.5, 'Fast response to my request.', '2026-04-06 22:37:16'),
(173, 173, 4.0, 'Professional and courteous service.', '2026-04-06 22:37:16'),
(174, 174, 4.5, 'Very knowledgeable technician.', '2026-04-06 22:37:16'),
(175, 175, 5.0, 'Solved my hardware problem easily.', '2026-04-06 22:37:16'),
(176, 176, 4.5, 'Great job on the setup.', '2026-04-06 22:37:16'),
(177, 177, 4.0, 'Appreciated the fast fix.', '2026-04-06 22:37:16'),
(178, 178, 4.5, 'System is performing much better.', '2026-04-06 22:37:16'),
(179, 179, 5.0, 'Expertly handled my support ticket.', '2026-04-06 22:37:16'),
(180, 180, 4.5, 'Polite and efficient help.', '2026-04-06 22:37:16'),
(181, 181, 4.0, 'Very satisfied with the service provided.', '2026-04-06 22:37:16'),
(182, 182, 4.5, 'Professional approach to technical issues.', '2026-04-06 22:37:16'),
(183, 183, 5.0, 'The fix was handled very professionally.', '2026-04-06 22:37:16'),
(184, 184, 4.5, 'Excellent results on the software update.', '2026-04-06 22:37:16'),
(185, 185, 4.0, 'Great help with my system configuration.', '2026-04-06 22:37:16'),
(186, 186, 4.5, 'Highly recommended support team.', '2026-04-06 22:37:16'),
(187, 187, 5.0, 'Very quick and reliable fix.', '2026-04-06 22:37:16'),
(188, 188, 4.5, 'Impressive technical knowledge.', '2026-04-06 22:37:16'),
(189, 189, 4.0, 'Prompt service and great attitude.', '2026-04-06 22:37:16'),
(190, 190, 4.5, 'Everything was handled smoothly.', '2026-04-06 22:37:16'),
(191, 191, 5.0, 'Very satisfied with the help received.', '2026-04-06 22:37:16'),
(192, 192, 4.5, 'Professional and efficient troubleshooting.', '2026-04-06 22:37:16'),
(193, 193, 4.0, 'Great support for my hardware issue.', '2026-04-06 22:37:16'),
(194, 194, 4.5, 'Quick fix and very helpful staff.', '2026-04-06 22:37:16'),
(195, 195, 5.0, 'The support was top quality.', '2026-04-06 22:37:16'),
(196, 196, 4.5, 'Resolved the problem effectively.', '2026-04-06 22:37:16'),
(197, 197, 4.0, 'Appreciated the clear communication.', '2026-04-06 22:37:16'),
(198, 198, 4.5, 'Very fast turnaround time.', '2026-04-06 22:37:16'),
(199, 199, 5.0, 'Great service as usual.', '2026-04-06 22:37:16'),
(200, 200, 4.5, 'Highly satisfied with the IT work.', '2026-04-06 22:37:16'),
(201, 201, 4.0, 'Problem solved with great expertise.', '2026-04-06 22:37:16'),
(202, 202, 4.5, 'The technician was excellent.', '2026-04-06 22:37:16'),
(203, 203, 5.0, 'Very reliable technical assistance.', '2026-04-06 22:37:16'),
(204, 204, 4.5, 'Good work on the system repair.', '2026-04-06 22:37:16'),
(205, 205, 4.0, 'Prompt and professional service.', '2026-04-06 22:37:16'),
(206, 206, 4.5, 'Exceptional support provided today.', '2026-04-06 22:37:16'),
(207, 207, 5.0, 'Fixed the issue on the first visit.', '2026-04-06 22:37:16'),
(208, 208, 4.5, 'Professional demeanor and efficient work.', '2026-04-06 22:37:16'),
(209, 209, 4.0, 'Handled the request very well.', '2026-04-06 22:37:16'),
(210, 210, 4.5, 'Very happy with the technical fix.', '2026-04-06 22:37:16'),
(211, 211, 5.0, 'Quick resolution of my support issue.', '2026-04-06 22:37:16'),
(212, 212, 4.5, 'Knowledgeable and friendly staff.', '2026-04-06 22:37:16'),
(213, 213, 4.0, 'Appreciated the efficient troubleshooting.', '2026-04-06 22:37:16'),
(214, 214, 4.5, 'The support team is fantastic.', '2026-04-06 22:37:16'),
(215, 215, 5.0, 'Excellent job on the network setup.', '2026-04-06 22:37:16'),
(216, 216, 4.5, 'Prompt and expert assistance.', '2026-04-06 22:37:16'),
(217, 217, 4.0, 'Very satisfied with the IT resolution.', '2026-04-06 22:37:16'),
(218, 218, 4.5, 'Handled the laptop issue perfectly.', '2026-04-06 22:37:16'),
(219, 219, 5.0, 'Great follow-up and service.', '2026-04-06 22:37:16'),
(220, 220, 4.5, 'Professional and quick assistance.', '2026-04-06 22:37:16'),
(221, 221, 4.0, 'Very good experience with the tech team.', '2026-04-06 22:37:16'),
(222, 222, 4.5, 'The problem was solved promptly.', '2026-04-06 22:37:16'),
(223, 223, 5.0, 'Reliable and effective support.', '2026-04-06 22:37:16'),
(224, 224, 4.5, 'Excellent technical support skills.', '2026-04-06 22:37:16'),
(225, 225, 4.0, 'Helpful and efficient resolution.', '2026-04-06 22:37:16'),
(226, 226, 4.5, 'Very happy with the overall service.', '2026-04-06 22:37:16'),
(227, 227, 5.0, 'Professional results on the fix.', '2026-04-06 22:37:16'),
(228, 228, 4.5, 'Fast response to technical trouble.', '2026-04-06 22:37:16'),
(229, 229, 4.0, 'The service was professional and thorough.', '2026-04-06 22:37:16'),
(230, 230, 4.5, 'Great work on the software glitch.', '2026-04-06 22:37:16'),
(231, 231, 5.0, 'Technician was knowledgeable and polite.', '2026-04-06 22:37:16'),
(232, 232, 4.5, 'Satisfied with the prompt support.', '2026-04-06 22:37:16'),
(233, 233, 4.0, 'System is back to normal now.', '2026-04-06 22:37:16'),
(234, 234, 4.5, 'Appreciate the quality fix.', '2026-04-06 22:37:16'),
(235, 235, 5.0, 'Excellent work on the hardware problem.', '2026-04-06 22:37:16'),
(236, 236, 4.5, 'Responsive and professional staff.', '2026-04-06 22:37:16'),
(237, 237, 4.0, 'Quick fix on my desktop computer.', '2026-04-06 22:37:16'),
(238, 238, 4.5, 'Very professional support delivery.', '2026-04-06 22:37:16'),
(239, 239, 5.0, 'Highly satisfied with the IT service.', '2026-04-06 22:37:16'),
(240, 240, 4.5, 'Good troubleshooting and clear explanation.', '2026-04-06 22:37:16'),
(241, 241, 4.0, 'The problem was fixed very quickly.', '2026-04-06 22:37:16'),
(242, 242, 4.5, 'Professional and reliable technician.', '2026-04-06 22:37:16'),
(243, 243, 5.0, 'Excellent help with the printer issues.', '2026-04-06 22:37:16'),
(244, 244, 4.5, 'Very satisfied with the quick solution.', '2026-04-06 22:37:16'),
(245, 245, 4.0, 'The staff was extremely helpful.', '2026-04-06 22:37:16'),
(246, 246, 4.5, 'Impressive speed and technical ability.', '2026-04-06 22:37:16'),
(247, 247, 5.0, 'Great support for the login issue.', '2026-04-06 22:37:16'),
(248, 248, 4.5, 'The team was very efficient today.', '2026-04-06 22:37:16'),
(249, 249, 4.0, 'Very good technical resolution.', '2026-04-06 22:37:16'),
(250, 250, 4.5, 'Friendly and effective IT support.', '2026-04-06 22:37:16'),
(251, 251, 5.0, 'High standard of professional service.', '2026-04-06 22:37:16'),
(252, 252, 4.5, 'Problem solved with great speed.', '2026-04-06 22:37:16'),
(253, 253, 4.0, 'Reliable and expert help provided.', '2026-04-06 22:37:16'),
(254, 254, 4.5, 'Handled the request with ease.', '2026-04-06 22:37:16'),
(255, 255, 5.0, 'Excellent technical assistance today.', '2026-04-06 22:37:16'),
(256, 256, 4.5, 'Very prompt response time.', '2026-04-06 22:37:16'),
(257, 257, 4.0, 'Professional results on the system repair.', '2026-04-06 22:37:16'),
(258, 258, 4.5, 'Satisfied with the help desk resolution.', '2026-04-06 22:37:16'),
(259, 259, 5.0, 'The tech team is doing a great job.', '2026-04-06 22:37:16'),
(260, 260, 4.5, 'Quick resolution and friendly staff.', '2026-04-06 22:37:16'),
(261, 261, 4.0, 'Very effective troubleshooting skills.', '2026-04-06 22:37:16'),
(262, 262, 4.5, 'Appreciate the fast assistance.', '2026-04-06 22:37:16'),
(263, 263, 5.0, 'Professional and courteous technician.', '2026-04-06 22:37:16'),
(264, 264, 4.5, 'System speed is much improved.', '2026-04-06 22:37:16'),
(265, 265, 4.0, 'Great help with the software installation.', '2026-04-06 22:37:16'),
(266, 266, 4.5, 'Very satisfied with the quick fix.', '2026-04-06 22:37:16'),
(267, 267, 5.0, 'Technician was very competent.', '2026-04-06 22:37:16'),
(268, 268, 4.5, 'Solved the problem without any issues.', '2026-04-06 22:37:16'),
(269, 269, 4.0, 'Very prompt and professional service.', '2026-04-06 22:37:16'),
(270, 270, 4.5, 'Highly satisfied with the IT work.', '2026-04-06 22:37:16'),
(271, 271, 5.0, 'Excellent job on the server update.', '2026-04-06 22:37:16'),
(272, 272, 4.5, 'Professional and efficient support.', '2026-04-06 22:37:16'),
(273, 273, 4.0, 'Resolved the technical error quickly.', '2026-04-06 22:37:16'),
(274, 274, 4.5, 'Great results on the hardware fix.', '2026-04-06 22:37:16'),
(275, 275, 5.0, 'Appreciated the thorough help.', '2026-04-06 22:37:16'),
(276, 276, 4.5, 'Knowledgeable and friendly tech.', '2026-04-06 22:37:16'),
(277, 277, 4.0, 'Quick turnaround on the ticket.', '2026-04-06 22:37:16'),
(278, 278, 4.5, 'Very satisfied with the assistance.', '2026-04-06 22:37:16'),
(279, 279, 5.0, 'Expertly handled my support request.', '2026-04-06 22:37:16'),
(280, 280, 4.5, 'The problem was solved in record time.', '2026-04-06 22:37:16'),
(281, 281, 4.0, 'Excellent support, very happy.', '2026-04-06 22:37:16'),
(282, 282, 4.5, 'Prompt resolution and great service.', '2026-04-06 22:37:16'),
(283, 283, 5.0, 'High quality fix on my workstation.', '2026-04-06 22:37:16'),
(284, 284, 4.5, 'Professional approach and fast results.', '2026-04-06 22:37:16'),
(285, 285, 4.0, 'Very effective troubleshooting today.', '2026-04-06 22:37:16'),
(286, 286, 4.5, 'Appreciate the technical expertise.', '2026-04-06 22:37:16'),
(287, 287, 5.0, 'Everything was handled correctly.', '2026-04-06 22:37:16'),
(288, 288, 4.5, 'Great job by the IT support team.', '2026-04-06 22:37:16'),
(289, 289, 4.0, 'Quick fix on the keyboard issue.', '2026-04-06 22:37:16'),
(290, 290, 4.5, 'Highly professional and helpful staff.', '2026-04-06 22:37:16'),
(291, 291, 5.0, 'Very satisfied with the system check.', '2026-04-06 22:37:16'),
(292, 292, 4.5, 'Excellent technical resolution provided.', '2026-04-06 22:37:16'),
(293, 293, 4.0, 'The fix was quick and reliable.', '2026-04-06 22:37:16'),
(294, 294, 4.5, 'Great communication during the fix.', '2026-04-06 22:37:16'),
(295, 295, 5.0, 'Very satisfied with the repair quality.', '2026-04-06 22:37:16'),
(296, 296, 4.5, 'Handled the request with great care.', '2026-04-06 22:37:16'),
(297, 297, 4.0, 'Efficient and polite technical support.', '2026-04-06 22:37:16'),
(298, 298, 4.5, 'Solved the software problem efficiently.', '2026-04-06 22:37:16'),
(299, 299, 5.0, 'Fantastic job on the network fix.', '2026-04-06 22:37:16'),
(300, 300, 4.5, 'Prompt and expert assistance today.', '2026-04-06 22:37:16'),
(301, 301, 4.0, 'Very happy with the overall fix.', '2026-04-06 22:37:16'),
(302, 302, 4.5, 'Knowledgeable staff and great results.', '2026-04-06 22:37:16'),
(303, 303, 5.0, 'Appreciated the professional handling.', '2026-04-06 22:37:16'),
(304, 304, 4.5, 'The issue was fixed perfectly.', '2026-04-06 22:37:16'),
(305, 305, 4.0, 'Quick response to my technical issue.', '2026-04-06 22:37:16'),
(306, 306, 4.5, 'Excellent experience with the tech team.', '2026-04-06 22:37:16'),
(307, 307, 5.0, 'Highly reliable support service.', '2026-04-06 22:37:16'),
(308, 308, 4.5, 'Professional behavior and fast results.', '2026-04-06 22:37:16'),
(309, 309, 4.0, 'The support was exactly what I needed.', '2026-04-06 22:37:16'),
(310, 310, 4.5, 'Great work on the software update.', '2026-04-06 22:37:16'),
(311, 311, 5.0, 'Satisfied with the quick technical fix.', '2026-04-06 22:37:16'),
(312, 312, 4.5, 'Handled my request with efficiency.', '2026-04-06 22:37:16'),
(313, 313, 4.0, 'Very satisfied with the help desk.', '2026-04-06 22:37:16'),
(314, 314, 4.5, 'Exceptional support provided today.', '2026-04-06 22:37:16'),
(315, 315, 5.0, 'The technician was excellent.', '2026-04-06 22:37:16'),
(316, 316, 4.5, 'Quick resolution and polite staff.', '2026-04-06 22:37:16'),
(317, 317, 4.0, 'Excellent service delivery today.', '2026-04-06 22:37:16'),
(318, 318, 4.5, 'Very impressed with the repair.', '2026-04-06 22:37:16'),
(319, 319, 5.0, 'Top quality technical assistance.', '2026-04-06 22:37:16'),
(320, 320, 4.5, 'Helpful and professional service.', '2026-04-06 22:37:16'),
(321, 321, 4.0, 'Appreciate the fast resolution.', '2026-04-06 22:37:16'),
(322, 322, 4.5, 'Very professional demeanor.', '2026-04-06 22:37:16'),
(323, 323, 5.0, 'Great results on the software fix.', '2026-04-06 22:37:16'),
(324, 324, 4.5, 'Prompt and effective troubleshooting.', '2026-04-06 22:37:16'),
(325, 325, 4.0, 'Knowledgeable and friendly service.', '2026-04-06 22:37:16'),
(326, 326, 4.5, 'Successful resolution of the glitch.', '2026-04-06 22:37:16'),
(327, 327, 5.0, 'Very satisfied with the quick turnaround.', '2026-04-06 22:37:16'),
(328, 328, 4.5, 'Highly professional tech support team.', '2026-04-06 22:37:16'),
(329, 329, 4.0, 'Everything is working perfectly again.', '2026-04-06 22:37:16'),
(330, 330, 4.5, 'Excellent support for my hardware.', '2026-04-06 22:37:16'),
(331, 331, 5.0, 'Very reliable technical help.', '2026-04-06 22:37:16'),
(332, 332, 4.5, 'Prompt and expert service today.', '2026-04-06 22:37:16'),
(333, 333, 4.0, 'The issue was solved very fast.', '2026-04-06 22:37:16'),
(334, 334, 4.5, 'Satisfied with the professional results.', '2026-04-06 22:37:16'),
(335, 335, 5.0, 'Great job on the system fix.', '2026-04-06 22:37:16'),
(336, 336, 4.5, 'Very polite and efficient staff.', '2026-04-06 22:37:16'),
(337, 337, 4.0, 'The fix was exactly what was needed.', '2026-04-06 22:37:16'),
(338, 338, 4.5, 'Appreciated the fast troubleshooting.', '2026-04-06 22:37:16'),
(339, 339, 5.0, 'High standard of technical service.', '2026-04-06 22:37:16'),
(340, 340, 4.5, 'Professional approach to my problem.', '2026-04-06 22:37:16'),
(341, 341, 4.0, 'Good results on the setup.', '2026-04-06 22:37:16'),
(342, 342, 4.5, 'Helpful and friendly technician.', '2026-04-06 22:37:16'),
(343, 343, 5.0, 'Excellent response to my ticket.', '2026-04-06 22:37:16'),
(344, 344, 4.5, 'Prompt resolution and great help.', '2026-04-06 22:37:16'),
(345, 345, 4.0, 'Technician was knowledgeable and fast.', '2026-04-06 22:37:16'),
(346, 346, 4.5, 'Highly satisfied with the IT fix.', '2026-04-06 22:37:16'),
(347, 347, 5.0, 'Very professional handling of the bug.', '2026-04-06 22:37:16'),
(348, 348, 4.5, 'Great communication throughout.', '2026-04-06 22:37:16'),
(349, 349, 4.0, 'The support was very helpful.', '2026-04-06 22:37:16'),
(350, 350, 4.5, 'Solved the connectivity issue perfectly.', '2026-04-06 22:37:16'),
(351, 351, 5.0, 'Excellent technical knowledge.', '2026-04-06 22:37:16'),
(352, 352, 4.5, 'Quick fix on my workstation.', '2026-04-06 22:37:16'),
(353, 353, 4.0, 'Satisfied with the efficient results.', '2026-04-06 22:37:16'),
(354, 354, 4.5, 'Handled the request very professionally.', '2026-04-06 22:37:16'),
(355, 355, 5.0, 'Very good experience with tech support.', '2026-04-06 22:37:16'),
(356, 356, 4.5, 'Great service as usual, thank you.', '2026-04-06 22:37:16'),
(357, 357, 4.0, 'Problem solved with great speed.', '2026-04-06 22:37:16'),
(358, 358, 4.5, 'Impressive technical skills shown.', '2026-04-06 22:37:16'),
(359, 359, 5.0, 'The technician was outstanding.', '2026-04-06 22:37:16'),
(360, 360, 4.5, 'Very happy with the prompt fix.', '2026-04-06 22:37:16'),
(361, 361, 4.0, 'Top quality service and results.', '2026-04-06 22:37:16'),
(362, 362, 4.5, 'Excellent handling of the hardware issue.', '2026-04-06 22:37:16'),
(363, 363, 4.0, 'Tell us how it went', '2026-04-07 08:46:16'),
(364, 365, 4.0, 'Araw ng kagitinganAraw ng kagitingan', '2026-04-09 04:23:27'),
(366, 366, 2.0, 'bad service', '2026-04-09 04:24:39'),
(367, 367, 1.0, 'OIIAI', '2026-04-09 04:45:50'),
(371, 368, 1.0, 'tell us', '2026-04-09 05:19:55'),
(372, 364, 4.0, 'HEIL HITLER', '2026-04-09 10:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_request`
--

CREATE TABLE `inventory_request` (
  `i_ticket_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `requested_by_employee` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `given_by_employee` int(11) DEFAULT NULL,
  `date_borrowed` timestamp NULL DEFAULT NULL,
  `received_by_employee` int(11) DEFAULT NULL,
  `date_returned` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_request`
--

INSERT INTO `inventory_request` (`i_ticket_id`, `item_id`, `requested_by_employee`, `description`, `status_id`, `given_by_employee`, `date_borrowed`, `received_by_employee`, `date_returned`, `updated_at`) VALUES
(1, 72, 6, 'Borrow', 5, 3, '2026-02-16 01:00:00', 3, '2026-02-17 01:00:00', '2026-04-07 07:55:10'),
(2, 33, 7, 'Borrow', 5, 4, '2026-02-17 01:00:00', 4, '2026-02-18 01:00:00', '2026-04-07 07:55:10'),
(3, 69, 9, 'Borrow', 5, 2, '2026-02-18 01:00:00', 2, '2026-02-19 01:00:00', '2026-04-07 07:55:10'),
(4, 68, 11, 'Borrow', 5, 4, '2026-02-18 01:00:00', 4, '2026-02-19 01:00:00', '2026-04-07 07:55:10'),
(5, 15, 5, 'Borrow', 5, 3, '2026-02-19 01:00:00', 3, '2026-02-20 01:00:00', '2026-04-07 07:55:10'),
(6, 5, 7, 'Borrow', 5, 3, '2026-02-23 01:00:00', 3, '2026-02-24 01:00:00', '2026-04-07 07:55:10'),
(7, 56, 11, 'Borrow', 5, 2, '2026-02-25 01:00:00', 2, '2026-02-26 01:00:00', '2026-04-07 07:55:10'),
(8, 23, 11, 'Borrow', 5, 3, '2026-02-27 01:00:00', 3, '2026-03-02 01:00:00', '2026-04-07 07:55:10'),
(9, 18, 6, 'Borrow', 5, 2, '2026-02-27 01:00:00', 2, '2026-03-02 01:00:00', '2026-04-07 07:55:10'),
(10, 36, 6, 'Borrow', 5, 3, '2026-03-02 01:00:00', 3, '2026-03-03 01:00:00', '2026-04-07 07:55:10'),
(11, 12, 11, 'Borrow', 5, 4, '2026-03-03 01:00:00', 4, '2026-03-04 01:00:00', '2026-04-07 07:55:10'),
(12, 37, 11, 'Borrow', 5, 4, '2026-03-03 01:00:00', 4, '2026-03-04 01:00:00', '2026-04-07 07:55:10'),
(13, 69, 8, 'Borrow', 5, 2, '2026-03-04 01:00:00', 2, '2026-03-05 01:00:00', '2026-04-07 07:55:10'),
(14, 78, 10, 'Borrow', 5, 2, '2026-03-04 01:00:00', 2, '2026-03-05 01:00:00', '2026-04-07 07:55:10'),
(15, 14, 11, 'Borrow', 5, 3, '2026-03-04 01:00:00', 3, '2026-03-05 01:00:00', '2026-04-07 07:55:10'),
(16, 55, 7, 'Borrow', 5, 2, '2026-03-05 01:00:00', 2, '2026-03-06 01:00:00', '2026-04-07 07:55:10'),
(17, 31, 11, 'Borrow', 5, 3, '2026-03-05 01:00:00', 3, '2026-03-06 01:00:00', '2026-04-07 07:55:10'),
(18, 64, 11, 'Borrow', 5, 3, '2026-03-06 01:00:00', 3, '2026-03-09 01:00:00', '2026-04-07 07:55:10'),
(19, 16, 11, 'Borrow', 5, 3, '2026-03-06 01:00:00', 3, '2026-03-09 01:00:00', '2026-04-07 07:55:10'),
(20, 10, 7, 'Borrow', 5, 4, '2026-03-06 01:00:00', 4, '2026-03-09 01:00:00', '2026-04-07 07:55:10'),
(21, 30, 5, 'Borrow', 5, 3, '2026-03-09 01:00:00', 3, '2026-03-10 01:00:00', '2026-04-07 07:55:10'),
(22, 62, 5, 'Borrow', 5, 3, '2026-03-09 01:00:00', 3, '2026-03-10 01:00:00', '2026-04-07 07:55:10'),
(23, 45, 7, 'Borrow', 5, 2, '2026-03-09 01:00:00', 2, '2026-03-10 01:00:00', '2026-04-07 07:55:10'),
(24, 7, 11, 'Borrow', 5, 2, '2026-03-10 01:00:00', 2, '2026-03-11 01:00:00', '2026-04-07 07:55:10'),
(25, 57, 9, 'Borrow', 5, 3, '2026-03-10 01:00:00', 3, '2026-03-11 01:00:00', '2026-04-07 07:55:10'),
(26, 41, 5, 'Borrow', 5, 2, '2026-03-10 01:00:00', 2, '2026-03-11 01:00:00', '2026-04-07 07:55:10'),
(27, 78, 10, 'Borrow', 5, 2, '2026-03-10 01:00:00', 2, '2026-03-11 01:00:00', '2026-04-07 07:55:10'),
(28, 47, 8, 'Borrow', 5, 3, '2026-03-10 01:00:00', 3, '2026-03-11 01:00:00', '2026-04-07 07:55:10'),
(29, 46, 8, 'Borrow', 5, 4, '2026-03-10 01:00:00', 4, '2026-03-11 01:00:00', '2026-04-07 07:55:10'),
(30, 17, 6, 'Borrow', 5, 2, '2026-03-10 01:00:00', 2, '2026-03-11 01:00:00', '2026-04-07 07:55:10'),
(31, 69, 8, 'Borrow', 5, 3, '2026-03-10 01:00:00', 3, '2026-03-11 01:00:00', '2026-04-07 07:55:10'),
(32, 65, 10, 'Borrow', 5, 3, '2026-03-11 01:00:00', 3, '2026-03-12 01:00:00', '2026-04-07 07:55:10'),
(33, 27, 7, 'Borrow', 5, 3, '2026-03-11 01:00:00', 3, '2026-03-12 01:00:00', '2026-04-07 07:55:10'),
(34, 66, 6, 'Borrow', 5, 2, '2026-03-11 01:00:00', 2, '2026-03-12 01:00:00', '2026-04-07 07:55:10'),
(35, 12, 8, 'Borrow', 5, 3, '2026-03-12 01:00:00', 3, '2026-03-13 01:00:00', '2026-04-07 07:55:10'),
(36, 19, 10, 'Borrow', 5, 2, '2026-03-12 01:00:00', 2, '2026-03-13 01:00:00', '2026-04-07 07:55:10'),
(37, 72, 8, 'Borrow', 5, 2, '2026-03-13 01:00:00', 2, '2026-03-16 01:00:00', '2026-04-07 07:55:10'),
(38, 51, 8, 'Borrow', 5, 2, '2026-03-13 01:00:00', 2, '2026-03-16 01:00:00', '2026-04-07 07:55:10'),
(39, 69, 10, 'Borrow', 5, 2, '2026-03-16 01:00:00', 2, '2026-03-17 01:00:00', '2026-04-07 07:55:10'),
(40, 9, 9, 'Borrow', 5, 4, '2026-03-16 01:00:00', 4, '2026-03-17 01:00:00', '2026-04-07 07:55:10'),
(41, 67, 9, 'Borrow', 5, 4, '2026-03-16 01:00:00', 4, '2026-03-17 01:00:00', '2026-04-07 07:55:10'),
(42, 17, 11, 'Borrow', 5, 4, '2026-03-16 01:00:00', 4, '2026-03-17 01:00:00', '2026-04-07 07:55:10'),
(43, 2, 11, 'Borrow', 5, 3, '2026-03-16 01:00:00', 3, '2026-03-17 01:00:00', '2026-04-07 07:55:10'),
(44, 17, 6, 'Borrow', 5, 2, '2026-03-17 01:00:00', 2, '2026-03-18 01:00:00', '2026-04-07 07:55:10'),
(45, 8, 6, 'Borrow', 5, 4, '2026-03-17 01:00:00', 4, '2026-03-18 01:00:00', '2026-04-07 07:55:10'),
(46, 32, 9, 'Borrow', 5, 2, '2026-03-17 01:00:00', 2, '2026-03-18 01:00:00', '2026-04-07 07:55:10'),
(47, 5, 11, 'Borrow', 5, 3, '2026-03-17 01:00:00', 3, '2026-03-18 01:00:00', '2026-04-07 07:55:10'),
(48, 45, 6, 'Borrow', 5, 3, '2026-03-18 01:00:00', 3, '2026-03-19 01:00:00', '2026-04-07 07:55:10'),
(49, 5, 6, 'Borrow', 5, 2, '2026-03-18 01:00:00', 2, '2026-03-19 01:00:00', '2026-04-07 07:55:10'),
(50, 29, 6, 'Borrow', 5, 2, '2026-03-18 01:00:00', 2, '2026-03-19 01:00:00', '2026-04-07 07:55:10'),
(51, 73, 5, 'Borrow', 5, 4, '2026-03-18 01:00:00', 4, '2026-03-19 01:00:00', '2026-04-07 07:55:10'),
(52, 23, 11, 'Borrow', 5, 4, '2026-03-19 01:00:00', 4, '2026-03-20 01:00:00', '2026-04-07 07:55:10'),
(53, 23, 5, 'Borrow', 5, 4, '2026-03-19 01:00:00', 4, '2026-03-20 01:00:00', '2026-04-07 07:55:10'),
(54, 37, 8, 'Borrow', 5, 3, '2026-03-19 01:00:00', 3, '2026-03-20 01:00:00', '2026-04-07 07:55:10'),
(55, 30, 11, 'Borrow for next week', 5, 1, '2026-03-20 07:00:00', 1, '2026-04-09 09:52:31', '2026-04-09 09:52:31'),
(56, 27, 10, 'Borrow for next week', 5, 1, '2026-03-20 07:00:00', 1, '2026-04-10 01:16:51', '2026-04-10 01:16:51'),
(57, 9, 9, 'Borrow for next week', 2, 1, '2026-03-20 07:00:00', NULL, NULL, '2026-04-10 01:19:37'),
(58, 16, 11, 'Borrow for next week', 1, NULL, '2026-03-20 07:00:00', NULL, NULL, '2026-03-20 07:01:00'),
(59, 75, 8, 'Borrow for next week', 1, NULL, '2026-03-20 07:00:00', NULL, NULL, '2026-03-20 07:01:00'),
(60, 52, 10, 'Borrow for next week', 1, NULL, '2026-03-20 07:00:00', NULL, NULL, '2026-03-20 07:01:00'),
(61, 55, 6, 'Pahiram', 5, 1, '2026-04-09 09:02:40', 1, '2026-04-09 09:52:14', '2026-04-09 09:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `created_by_employee` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `article` varchar(255) NOT NULL,
  `property_num` varchar(255) NOT NULL,
  `serial_num` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT 1,
  `date_acquired` date DEFAULT NULL,
  `date_counted` date DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `created_by_employee`, `device_id`, `status_id`, `article`, `property_num`, `serial_num`, `quantity`, `date_acquired`, `date_counted`, `updated_at`) VALUES
(1, 1, 1, 3, 'Dell OptiPlex 7010', '2020-123456789123-0101', 'DO89123', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(2, 1, 1, 3, 'HP EliteDesk 800 G6', '2020-123456789124-0102', 'HE89124', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(3, 1, 1, 4, 'Lenovo ThinkCentre M70s', '2020-123456789125-0103', 'LT89125', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(4, 1, 1, 1, 'Acer Veriton X2660G', '2020-123456789126-0104', 'AV89126', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(5, 1, 1, 2, 'Asus ExpertCenter D5', '2020-123456789127-0105', 'AE89127', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(6, 1, 2, 3, 'Dell Inspiron 15 3520', '2020-123456789128-0106', 'DI89128', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(7, 1, 2, 4, 'HP Pavilion 14', '2020-123456789129-0107', 'HP89129', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(8, 1, 2, 1, 'Lenovo ThinkPad E14', '2020-123456789130-0108', 'LT89130', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(9, 1, 2, 2, 'Acer Aspire 5', '2020-123456789131-0109', 'AA89131', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(10, 1, 2, 2, 'Apple MacBook Air M1', '2020-123456789132-0110', 'AM89132', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(11, 1, 3, 1, 'Apple iPad 10th Gen', '2020-123456789133-0111', 'Ai89133', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(12, 1, 3, 1, 'Samsung Galaxy Tab S9', '2020-123456789134-0112', 'SG89134', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(13, 1, 3, 2, 'Lenovo Tab P11', '2020-123456789135-0113', 'LT89135', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(14, 1, 3, 3, 'Huawei MatePad 11', '2020-123456789136-0114', 'HM89136', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(15, 1, 3, 4, 'Microsoft Surface Go 3', '2020-123456789137-0115', 'MS89137', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(16, 1, 4, 1, 'Dell P2422H', '2020-123456789138-0116', 'DP89138', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(17, 1, 4, 2, 'LG 24MP400', '2020-123456789139-0117', 'L289139', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(18, 1, 4, 3, 'Samsung S24F350', '2020-123456789140-0118', 'SS89140', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(19, 1, 4, 4, 'Asus VA24EHE', '2020-123456789141-0119', 'AV89141', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(20, 1, 4, 3, 'Acer KA242Y', '2020-123456789142-0120', 'AK89142', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(21, 1, 5, 4, 'Logitech K120', '2020-123456789143-0121', 'LK89143', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(22, 1, 5, 3, 'Microsoft Wired Keyboard 600', '2020-123456789144-0122', 'MW89144', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(23, 1, 5, 4, 'Razer Ornata V3', '2020-123456789145-0123', 'RO89145', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(24, 1, 5, 1, 'Corsair K55 RGB', '2020-123456789146-0124', 'CK89146', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(25, 1, 5, 2, 'HP C2500 Keyboard', '2020-123456789147-0125', 'HC89147', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(26, 1, 6, 3, 'Logitech M185', '2020-123456789148-0126', 'LM89148', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(27, 1, 6, 4, 'Razer DeathAdder Essential', '2020-123456789149-0127', 'RD89149', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(28, 1, 6, 1, 'Microsoft Basic Optical Mouse', '2020-123456789150-0128', 'MB89150', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(29, 1, 6, 2, 'HP X1000', '2020-123456789151-0129', 'HX89151', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(30, 1, 6, 2, 'Corsair Harpoon RGB', '2020-123456789152-0130', 'CH89152', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(31, 1, 7, 1, 'HP LaserJet Pro M404dn', '2020-123456789153-0131', 'HL89153', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(32, 1, 7, 1, 'Epson EcoTank L3210', '2020-123456789154-0132', 'EE89154', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(33, 1, 7, 2, 'Canon PIXMA G2020', '2020-123456789155-0133', 'CP89155', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(34, 1, 7, 3, 'Brother HL-L2350DW', '2020-123456789156-0134', 'BH89156', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(35, 1, 7, 4, 'Xerox Phaser 3020', '2020-123456789157-0135', 'XP89157', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(36, 1, 8, 1, 'Epson Perfection V39', '2020-123456789158-0136', 'EP89158', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(37, 1, 8, 2, 'Canon CanoScan LiDE 400', '2020-123456789159-0137', 'CC89159', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(38, 1, 8, 3, 'HP ScanJet Pro 2000', '2020-123456789160-0138', 'HS89160', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(39, 1, 8, 4, 'Brother ADS-1700W', '2020-123456789161-0139', 'BA89161', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(40, 1, 8, 4, 'Fujitsu ScanSnap iX1600', '2020-123456789162-0140', 'FS89162', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(41, 1, 9, 3, 'TP-Link Archer C6', '2020-123456789163-0141', 'TA89163', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(42, 1, 9, 4, 'Asus RT-AX55', '2020-123456789164-0142', 'AR89164', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(43, 1, 9, 1, 'Netgear Nighthawk R7000', '2020-123456789165-0143', 'NN89165', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(44, 1, 9, 1, 'D-Link DIR-842', '2020-123456789166-0144', 'DD89166', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(45, 1, 9, 2, 'Cisco RV160', '2020-123456789167-0145', 'CR89167', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(46, 1, 10, 3, 'Cisco Catalyst 2960', '2020-123456789168-0146', 'CC89168', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(47, 1, 10, 4, 'TP-Link TL-SG1024', '2020-123456789169-0147', 'TT89169', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(48, 1, 10, 1, 'Netgear GS108', '2020-123456789170-0148', 'NG89170', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(49, 1, 10, 2, 'D-Link DGS-1210', '2020-123456789171-0149', 'DD89171', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(50, 1, 10, 3, 'Ubiquiti UniFi Switch Lite 16', '2020-123456789172-0150', 'UU89172', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(51, 1, 11, 2, 'Ubiquiti UniFi U6 Lite', '2020-123456789173-0151', 'UU89173', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(52, 1, 11, 2, 'TP-Link EAP225', '2020-123456789174-0152', 'TE89174', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(53, 1, 11, 3, 'Cisco Aironet 1832i', '2020-123456789175-0153', 'CA89175', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(54, 1, 11, 4, 'Aruba Instant On AP22', '2020-123456789176-0154', 'AI89176', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(55, 1, 11, 1, 'Netgear WAX610', '2020-123456789177-0155', 'NW89177', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(56, 1, 12, 1, 'APC Back-UPS BX1100', '2020-123456789178-0156', 'AB89178', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(57, 1, 12, 3, 'CyberPower CP1500AVRLCD', '2020-123456789179-0157', 'CC89179', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(58, 1, 12, 4, 'Eaton 5E 1100i', '2020-123456789180-0158', 'E589180', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(59, 1, 12, 1, 'Vertiv Liebert PSA5', '2020-123456789181-0159', 'VL89181', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(60, 1, 12, 3, 'Tripp Lite SMART1500LCD', '2020-123456789182-0160', 'TS89182', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(61, 1, 13, 4, 'UGREEN Cat6 Ethernet Cable', '2020-123456789183-0161', 'UC89183', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(62, 1, 13, 3, 'D-Link NCB-C6UGRYR-305', '2020-123456789184-0162', 'DN89184', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(63, 1, 13, 4, 'TP-Link TL-N6', '2020-123456789185-0163', 'TT89185', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(64, 1, 13, 1, 'Belkin Cat6 Patch Cable', '2020-123456789186-0164', 'BC89186', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(65, 1, 13, 2, 'Vention Cat6 UTP Cable', '2020-123456789187-0165', 'VC89187', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(66, 1, 14, 3, 'Cisco IP Phone 7841', '2020-123456789188-0166', 'CI89188', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(67, 1, 14, 4, 'Yealink SIP-T31P', '2020-123456789189-0167', 'YS89189', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(68, 1, 14, 1, 'Grandstream GXP1625', '2020-123456789190-0168', 'GG89190', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(69, 1, 14, 2, 'Avaya J129', '2020-123456789191-0169', 'AJ89191', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(70, 1, 14, 2, 'Poly VVX 250', '2020-123456789192-0170', 'PV89192', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(71, 1, 15, 1, 'Logitech C920', '2020-123456789193-0171', 'LC89193', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(72, 1, 15, 1, 'Microsoft LifeCam HD-3000', '2020-123456789194-0172', 'ML89194', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(73, 1, 15, 2, 'Razer Kiyo', '2020-123456789195-0173', 'RK89195', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(74, 1, 15, 3, 'AVerMedia PW310', '2020-123456789196-0174', 'AP89196', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(75, 1, 15, 4, 'Lenovo 300 FHD Webcam', '2020-123456789197-0175', 'L389197', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(76, 1, 16, 1, 'Logitech H390', '2020-123456789198-0176', 'LH89198', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(77, 1, 16, 2, 'Jabra Evolve 20', '2020-123456789199-0177', 'JE89199', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(78, 1, 16, 3, 'HyperX Cloud Stinger', '2020-123456789200-0178', 'HC89200', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(79, 1, 16, 4, 'Corsair HS35', '2020-123456789201-0179', 'CH89201', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(80, 1, 16, 1, 'Sony WH-1000XM4', '2020-123456789202-0180', 'SW89202', NULL, NULL, NULL, '2026-04-10 01:24:54'),
(81, 1, 11, 1, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aa', 'aa', NULL, '2026-04-09', NULL, '2026-04-10 01:24:54');

-- --------------------------------------------------------

--
-- Table structure for table `item_status`
--

CREATE TABLE `item_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_status`
--

INSERT INTO `item_status` (`status_id`, `status_name`) VALUES
(1, 'Available'),
(2, 'Borrowed'),
(3, 'Under Repair'),
(4, 'For Disposal');

-- --------------------------------------------------------

--
-- Table structure for table `job_request`
--

CREATE TABLE `job_request` (
  `j_ticket_id` int(11) NOT NULL,
  `requested_by_employee` int(11) NOT NULL,
  `request_type` varchar(20) NOT NULL,
  `description` text DEFAULT NULL,
  `taken_by_employee` int(11) DEFAULT 0,
  `status_id` int(11) NOT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_request`
--

INSERT INTO `job_request` (`j_ticket_id`, `requested_by_employee`, `request_type`, `description`, `taken_by_employee`, `status_id`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 11, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(2, 11, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(3, 11, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(4, 9, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(5, 9, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(6, 8, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(7, 7, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(8, 6, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(9, 11, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(10, 10, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(11, 8, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(12, 5, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(13, 5, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(14, 5, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(15, 11, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(16, 9, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(17, 8, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(18, 7, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(19, 5, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(20, 5, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(21, 5, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(22, 11, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(23, 10, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(24, 10, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(25, 9, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(26, 8, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(27, 8, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(28, 8, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(29, 6, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(30, 5, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(31, 11, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(32, 10, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(33, 9, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(34, 9, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(35, 8, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(36, 8, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(37, 6, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(38, 5, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(39, 6, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(40, 5, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(41, 11, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(42, 10, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(43, 10, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(44, 10, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(45, 10, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(46, 10, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(47, 9, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(48, 7, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(49, 7, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(50, 5, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(51, 5, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(52, 5, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(53, 10, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(54, 8, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(55, 8, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(56, 7, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(57, 6, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(58, 6, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(59, 5, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(60, 11, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(61, 11, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(62, 8, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(63, 8, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(64, 7, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(65, 7, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(66, 5, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(67, 5, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(68, 11, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(69, 9, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(70, 9, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(71, 9, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(72, 9, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(73, 9, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(74, 8, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(75, 6, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(76, 6, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(77, 11, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(78, 11, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(79, 11, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(80, 10, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(81, 10, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(82, 9, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(83, 9, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(84, 9, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(85, 8, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(86, 7, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(87, 7, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(88, 7, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(89, 6, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(90, 5, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(91, 11, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(92, 11, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(93, 11, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(94, 10, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(95, 10, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(96, 9, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(97, 9, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(98, 9, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(99, 8, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(100, 7, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(101, 7, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(102, 6, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(103, 5, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(104, 10, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(105, 9, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(106, 7, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(107, 7, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(108, 7, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(109, 7, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(110, 6, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(111, 6, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(112, 6, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(113, 5, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(114, 11, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(115, 11, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(116, 11, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(117, 10, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(118, 10, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(119, 8, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(120, 7, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(121, 7, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(122, 7, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(123, 5, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(124, 11, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(125, 11, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(126, 10, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(127, 10, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(128, 10, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(129, 9, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(130, 7, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(131, 7, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(132, 5, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(133, 5, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(134, 11, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(135, 11, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(136, 11, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(137, 10, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(138, 10, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(139, 10, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(140, 9, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(141, 8, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(142, 7, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(143, 7, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(144, 7, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(145, 6, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(146, 6, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(147, 6, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(148, 5, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(149, 5, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(150, 5, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(151, 5, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(152, 11, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(153, 10, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(154, 10, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(155, 9, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(156, 8, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(157, 8, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(158, 7, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(159, 7, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(160, 7, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(161, 7, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(162, 6, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(163, 6, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(164, 5, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(165, 7, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(166, 7, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(167, 6, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(168, 6, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(169, 5, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(170, 5, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(171, 11, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(172, 11, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(173, 11, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(174, 10, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(175, 10, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(176, 10, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(177, 9, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(178, 9, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(179, 9, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(180, 8, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(181, 8, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(182, 8, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(183, 7, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(184, 7, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(185, 7, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(186, 6, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(187, 6, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(188, 6, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(189, 5, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(190, 5, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(191, 5, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(192, 11, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(193, 10, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(194, 9, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(195, 8, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(196, 7, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(197, 6, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(198, 5, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(199, 9, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(200, 6, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(201, 6, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(202, 9, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(203, 11, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(204, 7, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(205, 9, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(206, 7, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(207, 8, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(208, 8, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(209, 5, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(210, 8, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(211, 6, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(212, 5, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(213, 10, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(214, 8, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(215, 10, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(216, 11, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(217, 8, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(218, 8, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(219, 11, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(220, 5, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(221, 9, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(222, 6, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(223, 11, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(224, 11, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(225, 11, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(226, 6, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(227, 10, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(228, 6, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(229, 6, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(230, 9, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(231, 6, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(232, 7, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(233, 11, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(234, 9, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(235, 5, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(236, 7, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(237, 8, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(238, 6, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(239, 6, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(240, 7, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(241, 5, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(242, 8, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(243, 6, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(244, 5, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(245, 8, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(246, 10, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(247, 9, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(248, 9, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(249, 6, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(250, 11, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(251, 9, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(252, 6, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(253, 5, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(254, 7, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(255, 6, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(256, 6, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(257, 6, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(258, 7, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(259, 7, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(260, 7, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(261, 7, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(262, 11, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(263, 7, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(264, 11, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(265, 7, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(266, 6, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(267, 7, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(268, 6, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(269, 7, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(270, 8, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(271, 7, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(272, 7, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(273, 10, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(274, 8, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(275, 6, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(276, 7, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(277, 9, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(278, 10, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(279, 10, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(280, 5, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(281, 11, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(282, 7, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(283, 10, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(284, 10, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(285, 9, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(286, 5, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(287, 8, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(288, 7, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(289, 9, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(290, 11, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(291, 10, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(292, 9, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(293, 5, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(294, 11, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(295, 9, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(296, 7, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(297, 7, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(298, 7, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(299, 8, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(300, 5, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(301, 11, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(302, 11, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(303, 5, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(304, 11, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(305, 5, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(306, 11, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(307, 7, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(308, 8, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(309, 10, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(310, 9, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(311, 8, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(312, 8, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(313, 8, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(314, 11, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(315, 9, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(316, 11, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(317, 10, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(318, 10, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(319, 11, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(320, 5, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(321, 10, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(322, 11, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(323, 7, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(324, 11, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(325, 5, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(326, 10, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(327, 5, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(328, 7, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(329, 10, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(330, 10, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(331, 11, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(332, 5, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(333, 8, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(334, 10, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(335, 5, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(336, 7, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(337, 5, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(338, 10, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(339, 10, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(340, 5, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(341, 7, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(342, 7, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(343, 7, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(344, 6, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(345, 9, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(346, 8, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(347, 8, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(348, 9, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(349, 9, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(350, 5, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(351, 7, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(352, 7, 'Physical', 'Hardware', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(353, 10, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(354, 10, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(355, 5, 'Digital', 'Software', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(356, 6, 'Physical', 'Hardware', 4, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(357, 11, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(358, 11, 'Physical', 'Hardware', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(359, 6, 'Digital', 'Software', 3, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(360, 7, 'Digital', 'Software', 2, 5, NULL, '2026-04-07 07:08:04', '2026-04-07 07:08:04'),
(361, 10, 'Digital', 'Software', 3, 2, NULL, '2026-04-11 11:30:00', '2026-04-11 11:55:00'),
(362, 7, 'Digital', 'Software', 2, 2, NULL, '2026-04-05 09:14:03', '2026-04-05 09:14:03'),
(363, 8, 'Physical', 'Hardware', 1, 5, 'qweqweqweqwe', '2026-04-07 08:46:16', '2026-04-07 08:46:16'),
(364, 6, 'Physical', 'Hardware', 1, 5, 'OIIAI', '2026-04-09 10:03:25', '2026-04-09 10:03:25'),
(365, 8, 'Physical', 'qweqweqweqw', 1, 5, 'Araw ng kagitingan', '2026-04-09 04:23:27', '2026-04-09 04:23:27'),
(366, 8, 'Digital', 'Araw ng kagitingan v2', 1, 5, 'DONEDONE', '2026-04-09 04:24:39', '2026-04-09 04:24:39'),
(367, 8, 'Physical', 'requestquest', 1, 5, 'requestquestrequestquest', '2026-04-09 05:19:04', '2026-04-09 05:19:04'),
(368, 8, 'Physical', 'aasdasdasdasdas', 1, 5, 'describe', '2026-04-09 05:19:55', '2026-04-09 05:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `repair_status`
--

CREATE TABLE `repair_status` (
  `repair_status_id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `repair_status`
--

INSERT INTO `repair_status` (`repair_status_id`, `status_name`) VALUES
(1, 'Fixed'),
(2, 'Unrepairable'),
(3, 'Pending Parts');

-- --------------------------------------------------------

--
-- Table structure for table `request_status`
--

CREATE TABLE `request_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_status`
--

INSERT INTO `request_status` (`status_id`, `status_name`) VALUES
(1, 'Pending'),
(2, 'In Progress'),
(3, 'Pending Feedback'),
(4, 'Cancelled'),
(5, 'Completed');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_status`
--
ALTER TABLE `account_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`device_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `dept_id` (`dept_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD UNIQUE KEY `unique_job_feedback` (`j_ticket_id`);

--
-- Indexes for table `inventory_request`
--
ALTER TABLE `inventory_request`
  ADD PRIMARY KEY (`i_ticket_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `requested_by_employee` (`requested_by_employee`),
  ADD KEY `given_by_employee` (`given_by_employee`),
  ADD KEY `received_by_employee` (`received_by_employee`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `created_by_employee` (`created_by_employee`),
  ADD KEY `device_id` (`device_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `item_status`
--
ALTER TABLE `item_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `job_request`
--
ALTER TABLE `job_request`
  ADD PRIMARY KEY (`j_ticket_id`),
  ADD KEY `requested_by_employee` (`requested_by_employee`),
  ADD KEY `taken_by_employee` (`taken_by_employee`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `repair_status`
--
ALTER TABLE `repair_status`
  ADD PRIMARY KEY (`repair_status_id`);

--
-- Indexes for table `request_status`
--
ALTER TABLE `request_status`
  ADD PRIMARY KEY (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=373;

--
-- AUTO_INCREMENT for table `inventory_request`
--
ALTER TABLE `inventory_request`
  MODIFY `i_ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `item_status`
--
ALTER TABLE `item_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job_request`
--
ALTER TABLE `job_request`
  MODIFY `j_ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;

--
-- AUTO_INCREMENT for table `repair_status`
--
ALTER TABLE `repair_status`
  MODIFY `repair_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_feedback_job` FOREIGN KEY (`j_ticket_id`) REFERENCES `job_request` (`j_ticket_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2025 at 06:17 AM
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
-- Database: `db_leavedesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_contact` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_contact`, `admin_password`) VALUES
(10, 'BASIL JACOB', 'se@gmail.com', '5555555555', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(11, 'Sick Leave'),
(12, 'Medical Leave'),
(14, 'Emergency Leave'),
(15, 'Vacation');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE `tbl_department` (
  `department_ID` int(10) NOT NULL,
  `department_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`department_ID`, `department_name`) VALUES
(1, 'Management'),
(2, 'Development'),
(3, 'Designing'),
(4, 'Marketing');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(1, 'Thiruvananthapuram'),
(2, 'Kollam'),
(3, 'Pathanamthitta'),
(4, 'Alappuzha'),
(5, 'Kottayam'),
(6, 'Idukki'),
(7, 'Ernakulam'),
(8, 'Trissur'),
(9, 'Palakkad'),
(10, 'Malappuram'),
(11, 'Kozhikode'),
(12, 'Wayanad'),
(13, 'Kannur'),
(14, 'Kasaragod');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee`
--

CREATE TABLE `tbl_employee` (
  `employee_id` int(100) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `employee_email` varchar(100) NOT NULL,
  `employee_password` varchar(100) NOT NULL,
  `employee_contact` varchar(100) NOT NULL,
  `employee_address` varchar(100) NOT NULL,
  `employee_salary` varchar(100) NOT NULL,
  `department_ID` int(100) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_employee`
--

INSERT INTO `tbl_employee` (`employee_id`, `employee_name`, `employee_email`, `employee_password`, `employee_contact`, `employee_address`, `employee_salary`, `department_ID`, `photo`) VALUES
(24, 'SOUMYA MATHEW', 'soumya@mecollege.ac.in', ' soumya@', '9745325854', 'Renjithhwbisdjo(h)\r\niuhsidjfd;kpo\r\nfsjnlnlnnkl', '', 5, 'hodcsa.jpg'),
(28, 'Joseph S R', 'josseph008@gmail.com', '1234', '86878868683', 'slkfnvebhjvhbsfvfbd', '45693', 2, 'istockphoto-814423752-612x612.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hr`
--

CREATE TABLE `tbl_hr` (
  `hr_id` int(11) NOT NULL,
  `hr_name` varchar(200) NOT NULL,
  `hr_email` varchar(200) NOT NULL,
  `hr_contact` varchar(200) NOT NULL,
  `hr_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_hr`
--

INSERT INTO `tbl_hr` (`hr_id`, `hr_name`, `hr_email`, `hr_contact`, `hr_password`) VALUES
(1, 'Hr Joseph S', 'josephfrancizz444@gmail.com', '9633452096', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave`
--

CREATE TABLE `tbl_leave` (
  `leave_id` int(11) NOT NULL,
  `leave_title` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `leave_content` varchar(100) NOT NULL,
  `leave_fromdate` varchar(100) NOT NULL,
  `leave_enddate` varchar(100) NOT NULL,
  `leave_status` int(11) NOT NULL DEFAULT 0,
  `employee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_leave`
--

INSERT INTO `tbl_leave` (`leave_id`, `leave_title`, `category_id`, `leave_content`, `leave_fromdate`, `leave_enddate`, `leave_status`, `employee_id`) VALUES
(2, 'sdfsf', 11, 'dfsfasffggg', '2025-08-18', '2025-08-29', 1, 28);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(100) NOT NULL,
  `place_name` varchar(100) NOT NULL,
  `district_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `place_name`, `district_id`) VALUES
(1, 'Thiruvananthapuram', 1),
(2, 'Neyyattinkara', 1),
(3, 'Attingal', 1),
(4, 'Varkala', 1),
(5, 'Kollam', 2),
(6, 'Paravur', 2),
(7, 'Karunagappally', 2),
(8, 'Punalur', 2),
(9, 'Adoor', 3),
(10, 'Thiruvalla', 3),
(11, 'Ranni', 3),
(12, 'Cherthala', 4),
(13, 'Kayamkulam', 4),
(14, 'Mavelikkara', 4),
(15, 'Changanassery', 5),
(16, 'Pala', 5),
(17, 'Vaikom', 5),
(18, 'Thodupuzha', 6),
(19, 'Munnar', 6),
(20, 'Nedumkandam', 6),
(21, 'Devikulam', 6),
(22, 'Kochi', 7),
(23, 'Aluva', 7),
(24, 'Angamaly', 7),
(25, 'Perumbavoor', 7),
(26, 'Kothamangalam', 7),
(27, 'Chalakudy', 8),
(28, 'Guruvayur', 8),
(29, 'Kodungallur', 8),
(30, 'Ottapalam', 9),
(31, 'Chittur', 9),
(32, 'Mannarkkad', 9),
(33, 'Manjeri', 10),
(34, 'Tirur', 10),
(35, 'Ponnani', 10),
(36, 'Vadakara', 11),
(37, 'Koyilandy', 11),
(38, 'Ramanattukara', 11),
(39, 'Kalpetta', 12),
(40, 'Mananthavady', 12),
(41, 'Sulthan Bathery', 12),
(42, 'Thalassery', 13),
(43, 'Payyanur', 13),
(44, 'Iritty', 13),
(45, 'Manjeshwar', 14),
(46, 'Nileshwar', 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vacancy`
--

CREATE TABLE `tbl_vacancy` (
  `vacancy_id` int(11) NOT NULL,
  `vancancy_role` varchar(100) NOT NULL,
  `vacancy_description` varchar(100) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `posted_date` varchar(100) NOT NULL,
  `last_date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_vacancy`
--

INSERT INTO `tbl_vacancy` (`vacancy_id`, `vancancy_role`, `vacancy_description`, `dept_id`, `posted_date`, `last_date`) VALUES
(2, 'Python Developer', 'sdjfnjffff', 2, '2025-08-18', '2025-08-21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_work`
--

CREATE TABLE `tbl_work` (
  `work_id` int(11) NOT NULL,
  `work_name` varchar(100) NOT NULL,
  `work_description` varchar(500) NOT NULL,
  `work_startdate` varchar(100) NOT NULL,
  `work_enddate` varchar(100) NOT NULL,
  `work_file` varchar(100) NOT NULL,
  `department_id` int(11) NOT NULL,
  `hr_id` int(100) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `work_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_work`
--

INSERT INTO `tbl_work` (`work_id`, `work_name`, `work_description`, `work_startdate`, `work_enddate`, `work_file`, `department_id`, `hr_id`, `employee_id`, `work_status`) VALUES
(2, 'Design', 'skdjnfsnfsf', '2025-08-19', '2025-08-22', 'mandi.jpg', 2, 0, 28, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
  ADD PRIMARY KEY (`department_ID`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `tbl_hr`
--
ALTER TABLE `tbl_hr`
  ADD PRIMARY KEY (`hr_id`);

--
-- Indexes for table `tbl_leave`
--
ALTER TABLE `tbl_leave`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_vacancy`
--
ALTER TABLE `tbl_vacancy`
  ADD PRIMARY KEY (`vacancy_id`);

--
-- Indexes for table `tbl_work`
--
ALTER TABLE `tbl_work`
  ADD PRIMARY KEY (`work_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
  MODIFY `department_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_employee`
--
ALTER TABLE `tbl_employee`
  MODIFY `employee_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_hr`
--
ALTER TABLE `tbl_hr`
  MODIFY `hr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_leave`
--
ALTER TABLE `tbl_leave`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_vacancy`
--
ALTER TABLE `tbl_vacancy`
  MODIFY `vacancy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_work`
--
ALTER TABLE `tbl_work`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

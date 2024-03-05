-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2023 at 10:54 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kanban_board`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `parent_id` int(50) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `comment`, `parent_id`, `sender`, `date`) VALUES
(4, 'hi raju', 0, 'root', '2023-09-06 22:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `createprojectinfo`
--

CREATE TABLE `createprojectinfo` (
  `User_Email` varchar(50) NOT NULL,
  `Project_ID` int(50) NOT NULL,
  `Project_Name` varchar(50) NOT NULL,
  `Supervisor_Name` varchar(50) NOT NULL,
  `Project_Description` varchar(50) NOT NULL,
  `Project_Creator_Eail` varchar(50) NOT NULL,
  `VerificationID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `createprojectinfo`
--

INSERT INTO `createprojectinfo` (`User_Email`, `Project_ID`, `Project_Name`, `Supervisor_Name`, `Project_Description`, `Project_Creator_Eail`, `VerificationID`) VALUES
('raju.iit3@gmail.com', 1, 'Blood Bank Management', 'Tasniya Ahmed Mam', 'Group Project for SPL2', 'tasniya.tt@nstu.edu.bd', 'RtrFbz'),
('raju.iit3@gmail.com', 3, 'Police Verification', 'Auhidur Rahman Sumon', 'Group Project for SPL2', 'auhidsumon@nstu.edu.bd', 'jze82O'),
('smtsaiful@gmail.com', 6, 'E-Filing', 'Md. Iftekharul Alam Efat', 'Group Project For SPL2', 'iftekhar.iit@nstu.edu.bd', 'W61nsr'),
('raju.iit3@gmail.com', 9, 'E-Filing', 'Md. Iftekharul Alam Efat', 'Group Project for SPL2', 'iftekhar.iit@nstu.edu.bd', 'wSGhSQ'),
('raju.iit3@gmail.com', 10, 'Hkdhdkd', 'hasan', 'wwuwiwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', 'iftekhar.iit@nstu.edu.bd', 'Ri8YQk'),
('raju.iit3@gmail.com', 20, 'Responsive  Book Store Website Design', 'Md. Iftekharul Alam Efat', 'Group Project for SPL2', 'iftekhar.iit@nstu.edu.bd', 'xemRXK');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `Project_ID` int(50) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `filesize` int(11) NOT NULL,
  `filetype` varchar(100) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invitemeberinfo`
--

CREATE TABLE `invitemeberinfo` (
  `User_Email` varchar(50) NOT NULL,
  `Invited_Member_Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projectmember`
--

CREATE TABLE `projectmember` (
  `Project_ID` int(50) NOT NULL,
  `User_Email` varchar(50) NOT NULL,
  `Invited_Member_Email` varchar(50) NOT NULL,
  `Reference_Code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projectmember`
--

INSERT INTO `projectmember` (`Project_ID`, `User_Email`, `Invited_Member_Email`, `Reference_Code`) VALUES
(6, 'smtsaiful@gmail.com', 'raju.iit3@gmail.com', 'W61nsr'),
(20, 'raju.iit3@gmail.com', 'iftekhar.iit@nstu.edu.bd', 'xemRXK'),
(10, 'raju.iit3@gmail.com', 'iftekhar.iit@nstu.edu.bd', 'Ri8YQk');

-- --------------------------------------------------------

--
-- Table structure for table `taskinfo`
--

CREATE TABLE `taskinfo` (
  `Project_ID` int(50) NOT NULL,
  `Task_Title` varchar(50) NOT NULL,
  `Assign_Member` varchar(50) NOT NULL,
  `Due_Date` datetime(5) NOT NULL,
  `Set_Priority` varchar(50) NOT NULL,
  `Status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `taskinfo`
--

INSERT INTO `taskinfo` (`Project_ID`, `Task_Title`, `Assign_Member`, `Due_Date`, `Set_Priority`, `Status`) VALUES
(9, 'Complete your toDo list', 'raju.iit3@gmail.com', '2023-09-21 00:00:00.00000', 'medium', 'ToDo');

-- --------------------------------------------------------

--
-- Table structure for table `userjoininfo`
--

CREATE TABLE `userjoininfo` (
  `User_Email` varchar(50) NOT NULL,
  `Join_ID` int(50) NOT NULL,
  `Project_Name` varchar(50) NOT NULL,
  `Project_Description` varchar(100) NOT NULL,
  `Supervisor_Name` varchar(50) NOT NULL,
  `Supervisor_Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userjoininfo`
--

INSERT INTO `userjoininfo` (`User_Email`, `Join_ID`, `Project_Name`, `Project_Description`, `Supervisor_Name`, `Supervisor_Email`) VALUES
('raju.iit3@gmail.com', 6, 'E-Filing', 'Group Project For SPL2', 'Md. Iftekharul Alam Efat', 'iftekhar.iit@nstu.edu.bd');

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

CREATE TABLE `usertable` (
  `User_Email` varchar(50) NOT NULL,
  `First_Password` varchar(50) NOT NULL,
  `Correct_password` varchar(50) NOT NULL,
  `Status` varchar(50) NOT NULL,
  `VerificationCode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`User_Email`, `First_Password`, `Correct_password`, `Status`, `VerificationCode`) VALUES
('raju.iit3@gmail.com', '123', '202cb962ac59075b964b07152d234b70', 'Active', 'l6HBj3'),
('smtsaiful@gmail.com', '123', '202cb962ac59075b964b07152d234b70', 'Active', 'JjGupQ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `createprojectinfo`
--
ALTER TABLE `createprojectinfo`
  ADD PRIMARY KEY (`Project_ID`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD KEY `Project_ID` (`Project_ID`);

--
-- Indexes for table `invitemeberinfo`
--
ALTER TABLE `invitemeberinfo`
  ADD KEY `User_Email` (`User_Email`);

--
-- Indexes for table `projectmember`
--
ALTER TABLE `projectmember`
  ADD KEY `Project_ID` (`Project_ID`);

--
-- Indexes for table `taskinfo`
--
ALTER TABLE `taskinfo`
  ADD KEY `Project_ID` (`Project_ID`);

--
-- Indexes for table `userjoininfo`
--
ALTER TABLE `userjoininfo`
  ADD PRIMARY KEY (`Join_ID`),
  ADD KEY `User_Email` (`User_Email`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`User_Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`Project_ID`) REFERENCES `createprojectinfo` (`Project_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invitemeberinfo`
--
ALTER TABLE `invitemeberinfo`
  ADD CONSTRAINT `invitemeberinfo_ibfk_1` FOREIGN KEY (`User_Email`) REFERENCES `usertable` (`User_Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projectmember`
--
ALTER TABLE `projectmember`
  ADD CONSTRAINT `projectmember_ibfk_1` FOREIGN KEY (`Project_ID`) REFERENCES `createprojectinfo` (`Project_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `taskinfo`
--
ALTER TABLE `taskinfo`
  ADD CONSTRAINT `taskinfo_ibfk_1` FOREIGN KEY (`Project_ID`) REFERENCES `createprojectinfo` (`Project_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userjoininfo`
--
ALTER TABLE `userjoininfo`
  ADD CONSTRAINT `userjoininfo_ibfk_1` FOREIGN KEY (`User_Email`) REFERENCES `usertable` (`User_Email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

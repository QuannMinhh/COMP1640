-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 05, 2024 at 06:06 PM
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
-- Database: `COMP1640`
--

-- --------------------------------------------------------

--
-- Table structure for table `Account`
--

CREATE TABLE `Account` (
  `AccountID` int(11) NOT NULL,
  `Password` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `AdministratorID` int(11) NOT NULL,
  `Name` varchar(250) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Role` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `COMMENT`
--

CREATE TABLE `COMMENT` (
  `CommentID` int(11) NOT NULL,
  `Content` varchar(250) DEFAULT NULL,
  `ContributionID` int(11) DEFAULT NULL,
  `Marketing_CoordinatorID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Contribution`
--

CREATE TABLE `Contribution` (
  `ContributionID` int(11) NOT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `IsEnabled` blob DEFAULT NULL,
  `IsSelected` blob DEFAULT NULL,
  `ImageFile` blob DEFAULT NULL,
  `ArticleFile` blob DEFAULT NULL,
  `EntryID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Entry`
--

CREATE TABLE `Entry` (
  `EntryID` int(11) NOT NULL,
  `Name` varchar(250) DEFAULT NULL,
  `Deadline` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Faculty`
--

CREATE TABLE `Faculty` (
  `FacultyID` int(11) NOT NULL,
  `FacultyName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Marketing_Coordinator`
--

CREATE TABLE `Marketing_Coordinator` (
  `Marketing_CoordinatorID` int(11) NOT NULL,
  `Name` varchar(250) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Role` varchar(50) DEFAULT NULL,
  `AccountID` int(11) DEFAULT NULL,
  `FacultyID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Marketing_Manager`
--

CREATE TABLE `Marketing_Manager` (
  `Marketing_ManagerID` int(11) NOT NULL,
  `Name` varchar(250) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Role` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Notification`
--

CREATE TABLE `Notification` (
  `NotificationID` int(11) NOT NULL,
  `SenderUserID` int(11) DEFAULT NULL,
  `ReceiverUserID` int(11) DEFAULT NULL,
  `Content` varchar(250) DEFAULT NULL,
  `ContributionID` int(11) DEFAULT NULL,
  `Marketing_CoordinatorID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `SelectedContribution`
--

CREATE TABLE `SelectedContribution` (
  `SContributionID` int(11) NOT NULL,
  `ContributionID` int(11) DEFAULT NULL,
  `IsDownload` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE `Student` (
  `StudentID` int(11) NOT NULL,
  `Name` varchar(250) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Role` varchar(250) DEFAULT NULL,
  `IsAgree` bit(1) DEFAULT NULL,
  `FacultyID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`AccountID`);

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`AdministratorID`);

--
-- Indexes for table `COMMENT`
--
ALTER TABLE `COMMENT`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `ContributionID` (`ContributionID`),
  ADD KEY `Marketing_CoordinatorID` (`Marketing_CoordinatorID`);

--
-- Indexes for table `Contribution`
--
ALTER TABLE `Contribution`
  ADD PRIMARY KEY (`ContributionID`),
  ADD KEY `EntryID` (`EntryID`);

--
-- Indexes for table `Entry`
--
ALTER TABLE `Entry`
  ADD PRIMARY KEY (`EntryID`);

--
-- Indexes for table `Faculty`
--
ALTER TABLE `Faculty`
  ADD PRIMARY KEY (`FacultyID`);

--
-- Indexes for table `Marketing_Coordinator`
--
ALTER TABLE `Marketing_Coordinator`
  ADD PRIMARY KEY (`Marketing_CoordinatorID`),
  ADD KEY `AccountID` (`AccountID`),
  ADD KEY `FacultyID` (`FacultyID`);

--
-- Indexes for table `Marketing_Manager`
--
ALTER TABLE `Marketing_Manager`
  ADD PRIMARY KEY (`Marketing_ManagerID`);

--
-- Indexes for table `Notification`
--
ALTER TABLE `Notification`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `ContributionID` (`ContributionID`),
  ADD KEY `Marketing_CoordinatorID` (`Marketing_CoordinatorID`);

--
-- Indexes for table `SelectedContribution`
--
ALTER TABLE `SelectedContribution`
  ADD PRIMARY KEY (`SContributionID`),
  ADD KEY `ContributionID` (`ContributionID`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`StudentID`),
  ADD KEY `FacultyID` (`FacultyID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `COMMENT`
--
ALTER TABLE `COMMENT`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`ContributionID`) REFERENCES `Contribution` (`ContributionID`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`Marketing_CoordinatorID`) REFERENCES `Marketing_Coordinator` (`Marketing_CoordinatorID`);

--
-- Constraints for table `Contribution`
--
ALTER TABLE `Contribution`
  ADD CONSTRAINT `contribution_ibfk_1` FOREIGN KEY (`EntryID`) REFERENCES `Entry` (`EntryID`);

--
-- Constraints for table `Marketing_Coordinator`
--
ALTER TABLE `Marketing_Coordinator`
  ADD CONSTRAINT `marketing_coordinator_ibfk_1` FOREIGN KEY (`AccountID`) REFERENCES `Account` (`AccountID`),
  ADD CONSTRAINT `marketing_coordinator_ibfk_2` FOREIGN KEY (`FacultyID`) REFERENCES `Faculty` (`FacultyID`);

--
-- Constraints for table `Notification`
--
ALTER TABLE `Notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`ContributionID`) REFERENCES `Contribution` (`ContributionID`),
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`Marketing_CoordinatorID`) REFERENCES `Marketing_Coordinator` (`Marketing_CoordinatorID`);

--
-- Constraints for table `SelectedContribution`
--
ALTER TABLE `SelectedContribution`
  ADD CONSTRAINT `selectedcontribution_ibfk_1` FOREIGN KEY (`ContributionID`) REFERENCES `Contribution` (`ContributionID`);

--
-- Constraints for table `Student`
--
ALTER TABLE `Student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`FacultyID`) REFERENCES `Faculty` (`FacultyID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 16, 2017 at 12:58 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fashion_style`
--

-- --------------------------------------------------------

--
-- Table structure for table `business_meeting`
--

CREATE TABLE `business_meeting` (
  `ItemID` int(10) NOT NULL,
  `username` varchar(15) NOT NULL,
  `image_ID` int(11) NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `casual`
--

CREATE TABLE `casual` (
  `ItemID` int(10) NOT NULL,
  `username` varchar(15) NOT NULL,
  `image_ID` int(11) NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cloth_specs`
--

CREATE TABLE `cloth_specs` (
  `ItemID` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `cloth` text NOT NULL,
  `description` varchar(20) NOT NULL,
  `colour` text NOT NULL,
  `sleeve length` text NOT NULL,
  `fitting` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Gym`
--

CREATE TABLE `Gym` (
  `ItemID` int(10) NOT NULL,
  `username` varchar(15) NOT NULL,
  `image_ID` int(11) NOT NULL,
  `counter` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `image_specs`
--

CREATE TABLE `image_specs` (
  `username` varchar(10) NOT NULL,
  `image_ID` int(11) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `topwear` varchar(15) NOT NULL DEFAULT 't-shirt',
  `bottomwear` varchar(15) NOT NULL DEFAULT 'casual trouser',
  `overwear` varchar(15) DEFAULT NULL,
  `footwear` varchar(15) NOT NULL DEFAULT 'casual shoes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(15) NOT NULL,
  `password` varchar(30) DEFAULT NULL,
  `name` text NOT NULL,
  `gender` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='this is the login info of various users';

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

CREATE TABLE `party` (
  `ItemID` int(10) NOT NULL,
  `username` varchar(15) NOT NULL,
  `image_ID` int(11) NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `travel`
--

CREATE TABLE `travel` (
  `ItemID` int(10) NOT NULL,
  `username` varchar(15) NOT NULL,
  `image_ID` int(11) NOT NULL,
  `counter` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_meeting`
--
ALTER TABLE `business_meeting`
  ADD PRIMARY KEY (`ItemID`),
  ADD UNIQUE KEY `foriegn_key2` (`username`);

--
-- Indexes for table `casual`
--
ALTER TABLE `casual`
  ADD UNIQUE KEY `cloth_itemID` (`ItemID`),
  ADD UNIQUE KEY `login_username` (`ItemID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `cloth_specs`
--
ALTER TABLE `cloth_specs`
  ADD PRIMARY KEY (`ItemID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `Gym`
--
ALTER TABLE `Gym`
  ADD KEY `ItemID` (`ItemID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `image_specs`
--
ALTER TABLE `image_specs`
  ADD PRIMARY KEY (`image_ID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `party`
--
ALTER TABLE `party`
  ADD KEY `ItemID` (`ItemID`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `travel`
--
ALTER TABLE `travel`
  ADD KEY `ItemID` (`ItemID`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cloth_specs`
--
ALTER TABLE `cloth_specs`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `business_meeting`
--
ALTER TABLE `business_meeting`
  ADD CONSTRAINT `business_meeting_ibfk_1` FOREIGN KEY (`ItemID`) REFERENCES `cloth_specs` (`ItemID`),
  ADD CONSTRAINT `business_meeting_ibfk_2` FOREIGN KEY (`username`) REFERENCES `login` (`username`),
  ADD CONSTRAINT `foriegn_key1` FOREIGN KEY (`ItemID`) REFERENCES `cloth_specs` (`ItemID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foriegn_key2` FOREIGN KEY (`username`) REFERENCES `login` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `casual`
--
ALTER TABLE `casual`
  ADD CONSTRAINT `casual_ibfk_1` FOREIGN KEY (`ItemID`) REFERENCES `cloth_specs` (`ItemID`),
  ADD CONSTRAINT `casual_ibfk_2` FOREIGN KEY (`username`) REFERENCES `login` (`username`);

--
-- Constraints for table `cloth_specs`
--
ALTER TABLE `cloth_specs`
  ADD CONSTRAINT `cloth_specs_ibfk_1` FOREIGN KEY (`username`) REFERENCES `login` (`username`);

--
-- Constraints for table `Gym`
--
ALTER TABLE `Gym`
  ADD CONSTRAINT `Gym_ibfk_1` FOREIGN KEY (`ItemID`) REFERENCES `cloth_specs` (`ItemID`),
  ADD CONSTRAINT `Gym_ibfk_2` FOREIGN KEY (`username`) REFERENCES `login` (`username`);

--
-- Constraints for table `image_specs`
--
ALTER TABLE `image_specs`
  ADD CONSTRAINT `image_specs_ibfk_1` FOREIGN KEY (`username`) REFERENCES `login` (`username`);

--
-- Constraints for table `party`
--
ALTER TABLE `party`
  ADD CONSTRAINT `party_ibfk_1` FOREIGN KEY (`ItemID`) REFERENCES `cloth_specs` (`ItemID`),
  ADD CONSTRAINT `party_ibfk_2` FOREIGN KEY (`username`) REFERENCES `login` (`username`);

--
-- Constraints for table `travel`
--
ALTER TABLE `travel`
  ADD CONSTRAINT `travel_ibfk_1` FOREIGN KEY (`ItemID`) REFERENCES `cloth_specs` (`ItemID`),
  ADD CONSTRAINT `travel_ibfk_2` FOREIGN KEY (`username`) REFERENCES `login` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

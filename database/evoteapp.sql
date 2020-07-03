-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2020 at 12:38 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evoteapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `date_aadded` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `fullname`, `email`, `phone`, `date_aadded`) VALUES
(1, 'Admin', 'cfb545934516467ef3467d05dfb4a395', 'Innocent Tauzeni', 'admin@test.co.uk', '0774914150', '2020-04-01 08:52:14');

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `programme` varchar(30) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `dob` varchar(30) NOT NULL,
  `address` varchar(330) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `imageurl` text NOT NULL,
  `roleID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id`, `firstname`, `lastname`, `email`, `programme`, `gender`, `dob`, `address`, `phone`, `imageurl`, `roleID`) VALUES
(1, 'Innocent', 'Tauzeni', 'mediafreesonix@gmail.com', 'Bsc Computer Science', 'M', '1991-12-12', '3138 Aerodrome, Bindura', '263774914150', './img/cntpics/15857390495991.jpg', 1),
(2, 'Ashley', 'Nelson', 'mediafreesonix@gmail.com', 'Bsc Commerce', 'F', '1998-12-21', '4538 Aerodrome, Bindura', '7784447777333', './img/cntpics/15857400021495.jpg', 1),
(3, 'Maideyima', 'Nyasha', 'mediafreesonix@gmail.com', 'Bsc Social Work', 'F', '1989-03-12', '3138 Aerodrome, Bindura', '77491489', './img/cntpics/15857410372310.jpg', 1),
(4, 'Shamiso', 'Makona', 'mediafreesonix@gmail.com', 'Bsc Animal Science', 'F', '1992-01-23', '3138 Aerodrome, Bindura', '8966669066', './img/cntpics/15857411466597.jpg', 2),
(5, 'Yvonne', 'Mataranyika', 'mediafreesonix@gmail.com', 'Bsc Commerce', 'F', '1990-11-12', '3138 Aerodrome, Bindura', '8966669066', './img/cntpics/15857412128771.jpg', 3),
(6, 'Godwin', 'Maid', 'mediafreesonix@gmail.com', 'Bsc Business Finance', 'M', '1996-12-12', '3138 Aerodrome, Bindura', '263774014340', './img/cntpics/15857414383515.jpg', 4),
(7, 'Abel', 'Nyasha', 'mediafreesonix@gmail.com', 'Bsc Computer Science', 'M', '1998-12-12', '3138 Aerodrome, Bindura', '66666666', './img/cntpics/15857431155445.jpg', 2),
(8, 'Ryn', 'Aduya', 'mediafreesonix@gmail.com', 'Bsc Commerce', 'M', '1995-12-01', '3138 Aerodrome, Bindura', '263774914150', './img/cntpics/15857431665097.jpg', 2),
(9, 'Vimbai', 'Sekai', 'mediafreesonix@gmail.com', 'Bsc Business Finance', 'F', '1999-11-11', '3138 Aerodrome, Bindura', '66666666', './img/cntpics/15857433527775.png', 3),
(10, 'Noleen', 'Chingwete', 'mediafreesonix@gmail.com', 'Bsc Peace and Govenance', 'F', '1992-11-11', '3138 Aerodrome, Bindura', '8966669066', './img/cntpics/15857434097120.png', 3),
(11, 'Wraraz', 'Nyasha', 'mediafreesonix@gmail.com', 'Bsc Social Work', 'M', '1999-12-12', '3138 Aerodrome, Bindura', '12234444444', './img/cntpics/15857454114357.png', 4),
(12, 'Nyembex', 'Nox', 'mediafreesonix@gmail.com', 'Bsc Computer Science', 'F', '2000-12-12', '3138 Aerodrome, Bindura', '778444777', './img/cntpics/15857455869663.png', 4);

-- --------------------------------------------------------

--
-- Table structure for table `castvote`
--

CREATE TABLE `castvote` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `stid` varchar(8) NOT NULL,
  `vote` int(11) NOT NULL DEFAULT '1',
  `roleid` int(11) NOT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

CREATE TABLE `elections` (
  `id` int(11) NOT NULL,
  `electname` varchar(255) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `stop_time` time DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'No Election',
  `date_aadded` datetime DEFAULT NULL,
  `stopTimeDate` datetime DEFAULT NULL,
  `dateAdded` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`id`, `electname`, `start_time`, `stop_time`, `status`, `date_aadded`, `stopTimeDate`, `dateAdded`) VALUES
(1, 'SRC ELECTIONS', '10:30:00', '10:35:00', 'In Progress', '2020-07-03 10:35:00', NULL, '2020-07-03 10:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `code` char(4) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(320) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `code`, `name`, `description`) VALUES
(1, 'PR', 'President', 'President of the SRC'),
(2, 'VP', 'Vice President', 'Vice President'),
(3, 'SEC', 'Secretary', 'Secretary'),
(4, 'FIN', 'Minister of Finance', 'Minister of Finance');

-- --------------------------------------------------------

--
-- Table structure for table `voters`
--

CREATE TABLE `voters` (
  `stud_id` varchar(8) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '123456',
  `email` varchar(30) NOT NULL,
  `gender` varchar(15) NOT NULL,
  `dob` varchar(30) NOT NULL,
  `address` varchar(330) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `programme` varchar(30) NOT NULL,
  `img_url` varchar(30) NOT NULL DEFAULT 'img/noImage.png',
  `status` varchar(30) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voters`
--

INSERT INTO `voters` (`stud_id`, `firstname`, `lastname`, `password`, `email`, `gender`, `dob`, `address`, `phone`, `programme`, `img_url`, `status`) VALUES
('B1440405', 'innocent', 'tauzeni', 'e10adc3949ba59abbe56e057f20f883e', 'inn@gmail.com', 'M', '12-12-1992', 'Main', '033', 'BSCMAK', 'img/noImage.png', 'Pending'),
('B1440406', 'Tayana', 'Tauzeni', 'e10adc3949ba59abbe56e057f20f883e', 'r@main.com', 'F', '12-12-2011', 'MA', '22', 'NAKK', 'img/noImage.png', 'Pending'),
('B1440407', 'Manu', 'Nyara', 'e10adc3949ba59abbe56e057f20f883e', 'e@mail.com', 'F', '12-12-2011', 'MN', '09888', 'MSK', 'img/noImage.png', 'Pending'),
('B1440408', 'Maew', 'Nyambeu', 'e10adc3949ba59abbe56e057f20f883e', 'w@gmail.com', 'M', '12-12-2002', 'DDD', '0003', 'HAAHA', 'img/noImage.png', 'Pending'),
('B1780988', 'Mash', 'Nasho', 'e10adc3949ba59abbe56e057f20f883e', 'mediafreesonix@gmail.com', 'F', '12-12-2001', '3138 Aerodrome, Bindura', '7784447777333', 'Finc', 'img/noImage.png', 'Pending'),
('B1780989', 'Anahse', 'Mapatule', 'e10adc3949ba59abbe56e057f20f883e', 'mediafreesonix@gmail.com', 'F', '20-12-2003', '3138 Aerodrome, Bindura', '8966669066', 'PG', 'img/noImage.png', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `RoleKey` (`roleID`);

--
-- Indexes for table `castvote`
--
ALTER TABLE `castvote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cidKey` (`cid`),
  ADD KEY `stidKey` (`stid`),
  ADD KEY `roidkey` (`roleid`);

--
-- Indexes for table `elections`
--
ALTER TABLE `elections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voters`
--
ALTER TABLE `voters`
  ADD PRIMARY KEY (`stud_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `castvote`
--
ALTER TABLE `castvote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `elections`
--
ALTER TABLE `elections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `RoleKey` FOREIGN KEY (`roleID`) REFERENCES `roles` (`id`);

--
-- Constraints for table `castvote`
--
ALTER TABLE `castvote`
  ADD CONSTRAINT `cidKey` FOREIGN KEY (`cid`) REFERENCES `candidate` (`id`),
  ADD CONSTRAINT `roidkey` FOREIGN KEY (`roleid`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `stidKey` FOREIGN KEY (`stid`) REFERENCES `voters` (`stud_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

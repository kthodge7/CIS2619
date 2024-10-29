-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 28, 2024 at 11:57 PM
-- Server version: 8.0.35
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `password manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `authenticationtbl`
--

CREATE TABLE `authenticationtbl` (
  `authentication_key` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'Foreign Key',
  `salt` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `hashed_master_password` varchar(256) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `authenticationtbl`
--

INSERT INTO `authenticationtbl` (`authentication_key`, `user_id`, `salt`, `hashed_master_password`) VALUES
(1, 7, '5606264e646a8fe6a24b0ed672dac429', '693e249d90a1f547ea95499debf7bac635a1138cf936368cee311b727881bae9'),
(2, 8, '79ed741996280d235d50a77f2d86afb3', 'a4b1b6f88bda315edc6fad7433c0e14b2f4c72eab9f6da75b734e4d4831f863a'),
(3, 9, 'eb77e6c65c6c5318368d48a5881e2bb7', 'be78b19eeeaf05a7f6243f125cd634d4ff8ab58c43d69ef4f9ec942e62c674da'),
(4, 10, 'f98f4c19d5f0342ba4f037e5b3ca6548', 'ea94e30469894b06380ceeebb4a2ecca91048bca347fb6cd39a60c053c46280a'),
(5, 11, '2aeaeea86cafd3ed81dfe1628785f172', 'f7b2b3a36d7aa84e0ac9d1578db96f5a38c40384f0932fe515e4ab787ec19358'),
(6, 12, '1e1dcee8c3dd20010edbd9cf842001b8', '3d7aed8248a9a5232672a365e47895c0b85395b7b5360d78c5281692b9e155a9'),
(7, 13, 'fd71e465320f3f44bcc8791849b3cf2e', '35aa67b432677e7abbedde72cb71b5cb8ef53b8c48a4c30c291c334aaefd3a69'),
(8, 14, '57d2f177af2b1b2fff50fe2e3156a6d6', '2f6dc839dc6b038be833bb94ce519387baa682b0e235a21efe5dbe3cf628acca'),
(9, 15, '868682b6bb988c86271eb9c634dd6b55', '61e09bf9ad3b3f9c89027c78fc28f69195c794766e18e388965d7270b5464595'),
(10, 16, '4e2f05dc0ec68930e4878a037a61954b', '8bc12450a65872f475af5713f14b03da43202ef7064ade3c6e10bd54c86b66bc'),
(11, 17, 'c4ec02d76cf82319de523c95514d97e6', 'ff0f3797fa0701fb86dcfba353c9344c83d0ba81e42d74f9a7f11dc6967ab329'),
(12, 18, '63cbe7d6a0637ea1d97d678f93fe2f44', 'aa13e001b69e3ef1ea446fa9dd5d68e2b9226e0f62741639902730d0aff205b6');

-- --------------------------------------------------------

--
-- Table structure for table `passwordtbl`
--

CREATE TABLE `passwordtbl` (
  `entry_id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'Foreign Key',
  `website` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `passwordtbl`
--

INSERT INTO `passwordtbl` (`entry_id`, `user_id`, `website`, `username`, `password`) VALUES
(4, 7, 'dropbox.com', 'name444', 'passwor3333'),
(7, 7, 'boop.com', 'asdfasdf', ';lij;lkj;l'),
(8, 7, 'youtube.com', 'name098', 'j;alskdjf;alds'),
(11, 13, 'google.com', 'test234', ';lkasjdf;kl'),
(13, 13, 'zsdf', 'asdf', 'asdf'),
(14, 13, 'website3.com', 'username3', 'password3'),
(15, 13, 'Awebsite.com', 'username!', 'password'),
(16, 14, 'google.com', 'mirela', '234234'),
(17, 14, 'dropbox.com', 'mirela5', '1234556677'),
(19, 15, 'website2', 'group5-2', 'password'),
(20, 15, 'website3', 'group5-3', 'alskjfh@#$T'),
(21, 15, 'website4', 'group5-4', 'jklksdfjkhjkw34'),
(22, 15, 'website5', 'group5-5', ';laskfj;da'),
(23, 15, 'website6', 'group5-6', 'dsl;kjf;adk'),
(24, 15, 'website7', 'group5-7', 'P@sdf88'),
(25, 15, 'website8', 'group5-8', 'passbbndfidfjg'),
(26, 15, 'google.com', 'username4', 'mhgiuryufgths'),
(27, 15, 'amazon.com', 'purplehorse', 'boop4444'),
(28, 15, 'dropbox.com', '55342344', 'lskdjfl;kads'),
(29, 15, 'bestbuy.com', 'userfortech', 'b3e5TbuY'),
(30, 15, 'youtube.com', 'yesthatsme', 'iforgot?'),
(31, 15, 'canvas.com', '99999999@sfcollege.edu', 'dddfdfsdfsdfsdf'),
(32, 15, 'sfcollege.edu', 'username', 'ASDFSDFGDGSF');

-- --------------------------------------------------------

--
-- Table structure for table `usertbl`
--

CREATE TABLE `usertbl` (
  `user_id` int NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `usertbl`
--

INSERT INTO `usertbl` (`user_id`, `email`) VALUES
(7, 'name@gmail.com'),
(8, 'myemail@gmail.com'),
(9, 'boop3@yahoo.com'),
(10, 'test0@yahoo.com'),
(11, 'kelsey@gmail.com'),
(12, 'test1@gmail.com'),
(13, 'test2@gmail.com'),
(14, 'mirela1@gmail.com'),
(15, 'group5@example.com'),
(16, 'test@tester.com'),
(17, 'test10@gmail.com'),
(18, 'test11@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authenticationtbl`
--
ALTER TABLE `authenticationtbl`
  ADD PRIMARY KEY (`authentication_key`),
  ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `passwordtbl`
--
ALTER TABLE `passwordtbl`
  ADD PRIMARY KEY (`entry_id`),
  ADD KEY `user_id_idx` (`user_id`);

--
-- Indexes for table `usertbl`
--
ALTER TABLE `usertbl`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authenticationtbl`
--
ALTER TABLE `authenticationtbl`
  MODIFY `authentication_key` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `passwordtbl`
--
ALTER TABLE `passwordtbl`
  MODIFY `entry_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `usertbl`
--
ALTER TABLE `usertbl`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authenticationtbl`
--
ALTER TABLE `authenticationtbl`
  ADD CONSTRAINT `user_id1` FOREIGN KEY (`user_id`) REFERENCES `usertbl` (`user_id`);

--
-- Constraints for table `passwordtbl`
--
ALTER TABLE `passwordtbl`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `usertbl` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

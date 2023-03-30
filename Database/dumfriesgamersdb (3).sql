-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2023 at 09:20 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dumfriesgamersdb`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `adduseridtotables` (IN `Username` VARCHAR(100), IN `Crypted_pass` VARCHAR(100), IN `userstatus` INT, IN `addressline1` VARCHAR(100), IN `addressline2` VARCHAR(100), IN `city` VARCHAR(100), IN `postcode` VARCHAR(100), IN `firstname` VARCHAR(100), IN `lastname` VARCHAR(100), IN `email` VARCHAR(100), IN `phone` VARCHAR(20))  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;  -- rollback any error in the transaction
    END;

    START TRANSACTION;

    -- Insert into user table
    INSERT INTO user (UserName, Crypted_pass, userstatus, email, phone)
    VALUES (Username, Crypted_pass, userstatus, email, phone);
    SET @Userid = LAST_INSERT_ID();

    -- Insert into useraddressandname table
    SET @Userid = LAST_INSERT_ID();
    INSERT INTO useraddressandname (addressline1, addressline2, postcode, city, firstname, lastname,  user_id)
    VALUES (addressline1, addressline2, postcode, city, firstname, lastname,  @Userid);

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateuseridtotables` (IN `uid` INT, IN `Username` VARCHAR(100), IN `Crypted_pass` VARCHAR(100), IN `addressline1` VARCHAR(100), IN `addressline2` VARCHAR(100), IN `city` VARCHAR(100), IN `postcode` VARCHAR(100), IN `firstname` VARCHAR(100), IN `lastname` VARCHAR(100), IN `email` VARCHAR(100), IN `phone` VARCHAR(20))  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
        ROLLBACK;  -- rollback any error in the transaction
    END;

    START TRANSACTION;

    -- Update user table
    UPDATE user SET
        UserName = Username,
        Crypted_pass = Crypted_pass,

        email = email,
        phone = phone
    WHERE user_id = uid;

    -- Update useraddressandname table
    UPDATE useraddressandname SET
        addressline1 = addressline1,
        addressline2 = addressline2,
        postcode = postcode,
        city = city,
        firstname = firstname,
        lastname = lastname
    WHERE user_id = uid;

    COMMIT;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateUserStatus` (IN `p_User_id` INT)  BEGIN
    UPDATE user SET userstatus = 3 WHERE user_id = p_User_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `announcement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `announcement_text` text NOT NULL,
  `announcement_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `announcement_title` varchar(200) DEFAULT NULL,
  `image` longblob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`announcement_id`, `user_id`, `announcement_text`, `announcement_date`, `announcement_title`, `image`) VALUES
(2, 37, 'test', '2023-03-17 00:00:00', 'test', NULL),
(3, 37, 'test', '2023-03-17 00:00:00', 'test', NULL),
(4, 37, 'test', '2023-03-17 00:00:00', 'test', NULL),
(5, 37, 'fted', '2023-03-17 00:00:00', 'test', NULL),
(6, 46, 'awdawwdadwada', '2023-03-26 00:00:00', 'awdawdwa', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_description` varchar(500) DEFAULT NULL,
  `location` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `start_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`event_id`, `event_name`, `event_description`, `location`, `user_id`, `end_date`, `start_date`) VALUES
(6, 'this is a test event', 'dada', 'main_hall', 33, '2023-03-26 23:13:00', '2023-03-26 22:19:00'),
(7, 'test', 'test', 'main_hall', 33, '2023-03-09 23:24:00', '2023-03-09 23:24:00'),
(12, 'test new form ', 'test', 'main_hall', 34, '2023-03-09 18:55:00', '2023-03-09 18:57:00'),
(13, 'test new form ', 'test', 'main_hall', 34, '2023-03-09 18:55:00', '2023-03-09 16:55:00'),
(14, 'test new form ', 'test', 'main_hall', 34, '2023-03-09 18:57:00', '2023-03-09 18:57:00'),
(15, 'raw', 'rwqw', 'main_hall', 34, '2023-03-09 22:24:00', '2023-03-09 19:23:00'),
(16, 'ross kicks adrians ass', 'lol ross wins', 'main_hall', 38, '2023-03-18 05:52:00', '2023-03-19 00:44:00'),
(18, 'this is a test event', 'test', 'main_hall', 46, '2023-03-27 22:38:00', '2023-03-27 17:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `announcement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `announcement_id`, `user_id`, `comment_text`, `comment_date`) VALUES
(7, 6, 46, 'hahahaha what a terrible paiting and stuff', '2023-03-26 21:20:53'),
(10, 2, 48, 'this work?', '2023-03-28 22:09:18'),
(11, 2, 48, 'this will check if it logs comments ', '2023-03-28 23:48:11'),
(12, 2, 49, 'testing on other users', '2023-03-29 15:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `scoreboard`
--

CREATE TABLE `scoreboard` (
  `user_id` int(11) NOT NULL,
  `player1name` varchar(100) DEFAULT NULL,
  `player1army` varchar(100) DEFAULT NULL,
  `player1points` decimal(10,0) DEFAULT NULL,
  `player1kills` varchar(100) DEFAULT NULL,
  `player1deaths` varchar(100) DEFAULT NULL,
  `player2name` varchar(100) DEFAULT NULL,
  `player2army` varchar(100) DEFAULT NULL,
  `player2points` decimal(10,0) DEFAULT NULL,
  `player2kills` varchar(100) DEFAULT NULL,
  `player2deaths` varchar(100) DEFAULT NULL,
  `game_id` int(11) NOT NULL,
  `game_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scoreboard`
--

INSERT INTO `scoreboard` (`user_id`, `player1name`, `player1army`, `player1points`, `player1kills`, `player1deaths`, `player2name`, `player2army`, `player2points`, `player2kills`, `player2deaths`, `game_id`, `game_date`) VALUES
(32, 'ross', 'ross destroyers ', '444', '22', '2', 'chris ', 'chris lost ', '4145', '20', '10', 1, NULL),
(32, 'ross', 'ross destroyers ', '52', '2', '2', 'chris ', 'chris lost ', '522', '2', '2', 2, NULL),
(32, 'ross', 'teds', '500', '52', '50', 'chris ', 'test', '50', '50', '50', 3, '2023-03-10 03:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `Crypted_pass` varchar(100) DEFAULT NULL,
  `userstatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `Username`, `email`, `phone`, `Crypted_pass`, `userstatus`) VALUES
(32, 'ross', 'testemail@test.com', '12345', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 3),
(33, 'rosstest', 'ross@ross.com', '0123455665', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 5),
(34, 'Scoross', 'test@testr.com', 'test', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 5),
(35, 'Sco-Ross', 'testtest@test.com', '0123456778', '727fc2719077df003bf305600d2bec45c060e526', 5),
(36, 'test2', 'testtest@test.com', '0123456778', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 5),
(37, 'rosstheboss', 'emai@emal.com', '123', '109f4b3c50d7b0df729d299bc6f8e9ef9066971f', 5),
(38, 'admin1', 'rosslam5@live.com', '07460805335', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 5),
(39, 'ross', 'coonta75@gmail.com', '07460805335', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 2),
(40, 'ross', 'rosslam5@live.com', '07460805335', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 2),
(45, 'coonta75', 'rosslam5@live.com', '07460805335', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 2),
(46, 'testr', 'coonta75@gmail.com', '07460805335', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 5),
(48, 'thetest', 'null@null.com', '1234568', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 5),
(49, 'testpay', 'i@k.com', '12341', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 3);

-- --------------------------------------------------------

--
-- Table structure for table `useraddressandname`
--

CREATE TABLE `useraddressandname` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `addressline1` varchar(100) NOT NULL,
  `addressline2` varchar(100) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `postcode` varchar(20) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useraddressandname`
--

INSERT INTO `useraddressandname` (`address_id`, `user_id`, `addressline1`, `addressline2`, `city`, `postcode`, `firstname`, `lastname`) VALUES
(13, 32, 'test address', 'test addresss', 'test city', 'p code test', 'ross', 'lamont'),
(14, 33, 'testing', 'testing', 'testing', 'testing', 'test', 'testing'),
(15, 34, 'test', 'test', 'test', 'test', 'test', 'test'),
(16, 35, '34', 'Burns Street', 'dumfries', 'dg1 2ps', 'ross', 'lamont'),
(17, 36, 'testcunt', 'testcunt', 'cuntcity', 'testcunt', 'cunt', 'test'),
(18, 37, 'boss', 'lol', 'lol', 'lol', 'ross', 'the'),
(19, 38, '34', 'Burns Street', 'Dumfries', 'DG1 2PS', 'Ross', 'Lamont'),
(20, 39, '34 Burns Street', 'dumfries', 'Dumfries', 'DG1 2PS', 'Ross', 'Lamont'),
(21, 40, '34', 'Burns Street', 'Dumfries', 'DG1 2PS', 'Ross', 'Lamont'),
(26, 45, '34', 'Burns Street', 'Dumfries', 'DG1 2PS', 'Ross', 'Lamont'),
(27, 46, '34 Burns Street', 'dumfries', 'Dumfries', 'DG1 2PS', 'Ross John', 'Lamont'),
(29, 48, 'null', 'road', 'new york', 'lol', 'test', 'trent'),
(30, 49, 'oay', 'pay', 'oat', 'pay', 'pay', 'oay');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`announcement_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `announcement_id` (`announcement_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `scoreboard`
--
ALTER TABLE `scoreboard`
  ADD PRIMARY KEY (`game_id`),
  ADD KEY `scoreboard_user_user_id_fk` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `useraddressandname`
--
ALTER TABLE `useraddressandname`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `scoreboard`
--
ALTER TABLE `scoreboard`
  MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `useraddressandname`
--
ALTER TABLE `useraddressandname`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `calendar`
--
ALTER TABLE `calendar`
  ADD CONSTRAINT `calendar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`announcement_id`) REFERENCES `announcements` (`announcement_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `scoreboard`
--
ALTER TABLE `scoreboard`
  ADD CONSTRAINT `scoreboard_user_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `useraddressandname`
--
ALTER TABLE `useraddressandname`
  ADD CONSTRAINT `useraddressandname_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

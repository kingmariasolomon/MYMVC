-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 30, 2020 at 02:05 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elitemvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `fname` varchar(150) NOT NULL,
  `lname` varchar(150) NOT NULL,
  `email` varchar(175) NOT NULL,
  `home_phone` varchar(50) DEFAULT NULL,
  `cell_phone` varchar(50) DEFAULT NULL,
  `work_phone` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(150) DEFAULT NULL,
  `zip` varchar(50) DEFAULT NULL,
  `country` varchar(155) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `deleted` (`deleted`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `user_id`, `fname`, `lname`, `email`, `home_phone`, `cell_phone`, `work_phone`, `address`, `address2`, `city`, `state`, `zip`, `country`, `deleted`) VALUES
(1, 1, 'solomon', 'king', 'solomon@gmail.com', '1234567890', '0987654321', '4567898765', 'jnfuiw aowhe', 'uicjeij ijaowfo', 'enugu', 'enugu', '45678', 'nigeria', 0),
(2, 1, 'john', 'bull', 'johnbull@gmail.com', '23456754333', '444532354545', '44577467685', 'oijiosdf aojwefj', 'oigweoijijweo', 'iweoiw', 'ojweoij', '234567', 'opijerioj', 0),
(4, 1, 'bathlomew', 'ebuka', 'ebuka@gmail.com', '765567878', '10987652345', '32345345654', '7. obuozougwu', '', 'Ngwo', 'Enugu', '12345', NULL, 0),
(5, 1, 'celest', 'mento led', '', '', '7834567891', '', '', '', '', '', '', NULL, 0),
(6, 1, 'sixtus', 'methan', 'sistus@gmail.com', '', '1453 67 8976', '', 'city gate', '', '', '', '', NULL, 0),
(7, 1, 'delete', 'me', 'delete@gmail.com', '', '123 65 8765 3', '', '', '', '', '', '', NULL, 0),
(8, 1, 'tokyo', 'nirobi', '', '', '1235 533 5565', '', '', '', '', '', '', NULL, 0),
(9, 1, 'roman', 'teller', 'roman@tell.com', '', '123 6533 7652', '', '', '', 'neq york city', 'united arab emirate', '', NULL, 1),
(10, 1, 'dfdyuty', 'oukfyjfg', 'abc@mailer.com', '', '', '', '', '', '', '', '', NULL, 0),
(11, 10, 'contact', 'added', '', '', '222 35 31235', '', '', '', 'contacto', '', '', NULL, 0),
(12, 10, 'reace me', 'itti', '', '', '1233 65 32166', '', '', '', 'tty73', '', '', NULL, 1),
(13, 10, 'added', 'fla', '', '', '65328765', '', '', '', '', '', '', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `fname` varchar(150) DEFAULT NULL,
  `lname` varchar(150) DEFAULT NULL,
  `acl` text,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `fname`, `lname`, `acl`, `deleted`) VALUES
(1, 'solomon', 'solomon@gmail.com', '$2y$10$X7SC60W8YV6WeBV5dfNmDes8d3zjU8ugiM3TzkIMSpWoZTEQkoLfa', 'Solomon', 'King', '', 0),
(2, 'supermario', 'mario@gmail.com', '$2y$10$sFiWyOt0hKzYe2hT.8lcUOJxIR0plmxj28lSZbIgmGyy5/N0a3ryy', 'solomon', 'mario', NULL, NULL),
(3, 'solomoney', 'solomoney@gmail.com', '$2y$10$W1hyXSZVpXhsq/dT/X2wtO8k95SYjdQ5Omov4Y8kNx2s0BbMhzoZ6', 'solomoney', 'king', NULL, NULL),
(4, 'chijioke', 'chijioke@gmail.com', '$2y$10$YJ60JoAVTPCieYB2rEgnUOCAVx/DWc47E1QLBzqVVq/WYVhbs127C', 'chijioke', 'solomon', NULL, NULL),
(5, 'ebukab', 'ebuka@gmail.com', '$2y$10$0s0lsXG9OfuGVAL7mG8rpOpj4sh8ANIFUJhcWHMYyQ8yTcXnfBB/y', 'bathlomew', 'ebuka', NULL, 0),
(9, 'romanteller', 'roman@tell.com', '$2y$10$VKvgxkUphC.tZh53pIurHu1L7sRhP6zRmlTNVcELvrSihzlliWyRG', 'roman', 'teller', NULL, 0),
(10, 'fnamelname', 'fname@mail.com', '$2y$10$uoxTcTXlDd4q5YOEQJrtheJTORxgPYFdxjrHNkT9BJC1jHfPaHi0q', 'fname', 'lname', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

DROP TABLE IF EXISTS `user_sessions`;
CREATE TABLE IF NOT EXISTS `user_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `user_id`, `session`, `user_agent`) VALUES
(28, 1, 'e4da3b7fbbce2345d7772b0674a318d5', 'Mozilla.0 (Windows NT 10.0; Win64; x64; rv:73.0) Gecko Firefox.0'),
(34, 4, '6364d3f0f495b6ab9dcf8d3b5c6e0b01', 'Mozilla.0 (Windows NT 10.0; Win64; x64; rv:77.0) Gecko Firefox.0');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

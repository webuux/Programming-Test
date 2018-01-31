-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2018 at 07:05 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`) VALUES
(1, 'Bill Gates', 'Gates', 'billgates@gmail.com', '000000'),
(2, 'Steve Jobs', 'Jobs', 'stevejobs@gmail.com', '555555'),
(3, 'Albert Einstein', 'Einstein', 'alberteinstein@hotmail.com', '123456'),
(4, 'Galileo Galilei', 'Galileo', 'galileogalilei@outlook.com', '987654'),
(5, 'Leonardo Da Vinci', 'Da Vinci', 'leonardodavinci@vinci.com', 'qwedfr58'),
(6, 'George Washington', 'Washington', 'georgewashington@usa.com', '456789'),
(7, 'Nelson Mandela', 'Mandela', 'nelsonmandela@gmail.com', 'ghjk456'),
(8, 'Pablo Picasso', 'PPicasso', 'pablopicasso@art.com', 'turer1258'),
(9, 'Nikola Tesla', 'Tesla', 'nikolatesla@tesla.com', '9999999999'),
(10, 'Henry Ford', 'Ford', 'henryford@ford.com', '567789'),
(11, 'Stephen Hawking', 'Hawking', 'stephenhawking@science.com', '456+456'),
(12, 'Isaac Newton', 'Newton', 'isaacnewton@fly.com', 'asd+asd+45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

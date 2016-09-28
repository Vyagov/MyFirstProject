-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Версия на сървъра: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_db`
--

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Схема на данните от таблица `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'test', 'test', 'test@test.bg', '$2a$07$2uDLvp1Ii2e./U9C8sBjqetFVVjBpIZlt4wEhAVkjjZSzsi3L.eSq'),
(4, 'milena', 'vyagova', 'mimozka_v@abv.bg', '$2a$07$2uDLvp1Ii2e./U9C8sBjqe6/iyP0RlJm5KXPTmIzXtvpeKMJFt.kO'),
(3, 'ivan', 'nikolov', 'quicky@abv.bg', '$2a$07$2uDLvp1Ii2e./U9C8sBjqexzlj7WZ8/O9P7ie9Zl/8/p667YwFQXe'),
(5, 'fdssfd', 'dddsd', 'dsd@sdds.bg', '$2a$07$2uDLvp1Ii2e./U9C8sBjqexp6Uum6jYFAw4UtnQUt2vqyBcV2HoHy'),
(6, 'ivan', 'nikolov', 'ivan.nikolov@mailinator.com', '$2a$07$2uDLvp1Ii2e./U9C8sBjqexp6Uum6jYFAw4UtnQUt2vqyBcV2HoHy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

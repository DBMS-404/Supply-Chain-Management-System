-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2022 at 05:54 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scmc`
--

-- --------------------------------------------------------

--
-- Structure for view `total_hours`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_hours`  AS SELECT `turn`.`turn_id` AS `turn_id`, `turn`.`driver_id` AS `driver_id`, concat(`u1`.`first_name`,' ',`u1`.`last_name`) AS `driver_name`, `turn`.`assistant_id` AS `assistant_id`, concat(`u2`.`first_name`,' ',`u2`.`last_name`) AS `assistant_name`, `turn`.`truck_id` AS `truck_id`, `truck`.`truck_no` AS `truck_no`, `city`.`name` AS `truck_city`, `turn`.`scheduled_date` AS `scheduled_date`, round(hour(timediff(`turn`.`turn_end_time`,`turn`.`turn_start_time`)) + minute(timediff(`turn`.`turn_end_time`,`turn`.`turn_start_time`)) / 60,2) AS `tot_time` FROM ((((`turn` join `user` `u1`) join `user` `u2`) join `truck`) join `city`) WHERE `truck`.`city_id` = `city`.`city_id` AND `turn`.`driver_id` = `u1`.`user_id` AND `turn`.`assistant_id` = `u2`.`user_id` AND `turn`.`truck_id` = `truck`.`truck_id` AND `turn`.`turn_end_time` is not null  ;

--
-- VIEW `total_hours`
-- Data: None
--

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

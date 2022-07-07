-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2022 at 07:46 AM
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

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`` FUNCTION `calc_tot_price` (`order_id` INT(11)) RETURNS INT(11)  BEGIN
    DECLARE tot_price INT;
    select sum(item_price) into @tot_price
    from(select item_id, item_quantity, item.unit_price*item_quantity as item_price
    from item_assignment left outer join item using(item_id)
    where item_assignment.order_id=order_id) as item_price_table;
    return @tot_price;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `available_assistants`
-- (See below for the actual view)
--
CREATE TABLE `available_assistants` (
`user_id` varchar(20)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`mobile_no` varchar(20)
,`weekly_worked_hours` int(11)
,`city` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `available_drivers`
-- (See below for the actual view)
--
CREATE TABLE `available_drivers` (
`user_id` varchar(20)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`mobile_no` varchar(20)
,`weekly_worked_hours` int(11)
,`city` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `name`) VALUES
(1, 'Badulla'),
(2, 'Colombo'),
(3, 'Bandarawela'),
(4, 'Moratuwa'),
(5, 'Kadawatha'),
(6, 'Monaragala');

-- --------------------------------------------------------

--
-- Table structure for table `city_assignment`
--

CREATE TABLE `city_assignment` (
  `city_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city_assignment`
--

INSERT INTO `city_assignment` (`city_id`, `route_id`) VALUES
(1, 1),
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `user_id` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `mobile_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`user_id`, `address`, `mobile_no`) VALUES
('CR1', 'Kings Strret, Badulla', '0762409795'),
('CR2', 'Katubedda, Moratuwa', '0719097353');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `user_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `license_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`user_id`, `license_no`) VALUES
('DR1', 'B7892148'),
('DR2', 'B9094148'),
('DR3', 'B5697189'),
('DR4', 'B8967159');

-- --------------------------------------------------------

--
-- Table structure for table `driver_assistant`
--

CREATE TABLE `driver_assistant` (
  `user_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `cons_turn_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `driver_assistant`
--

INSERT INTO `driver_assistant` (`user_id`, `cons_turn_count`) VALUES
('DA1', 0),
('DA2', 0),
('DA3', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `driver_assistant_order`
-- (See below for the actual view)
--
CREATE TABLE `driver_assistant_order` (
`order_id` int(11)
,`assistant_id` varchar(20)
,`driver_id` varchar(20)
,`route_map` longtext
);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `user_id` varchar(20) NOT NULL,
  `mobile_no` varchar(20) NOT NULL,
  `weekly_worked_hours` int(11) NOT NULL,
  `city` varchar(50) NOT NULL,
  `last_arrival_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`user_id`, `mobile_no`, `weekly_worked_hours`, `city`, `last_arrival_time`) VALUES
('DA1', '0764956029', 35, '1', '22:00:00'),
('DA2', '0775020514', 0, '1', '00:00:00'),
('DA3', '0779773608', 0, '2', '00:00:00'),
('DR1', '0752695390', 15, '1', '00:00:00'),
('DR2', '0714536184', 0, '1', '00:00:00'),
('DR3', '0710473672', 0, '2', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave`
--

CREATE TABLE `employee_leave` (
  `leave_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `leave_reason` varchar(500) NOT NULL,
  `status` tinyint(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_leave`
--

INSERT INTO `employee_leave` (`leave_id`, `user_id`, `date`, `leave_reason`, `status`) VALUES
(1, 'DR1', '2022-06-07', 'wertyuijhvc', 0),
(2, 'DR1', '2022-06-07', 'wertyuijhvc', 0),
(3, 'DR1', '2022-06-09', 'awedfvvvvvv', 0),
(4, 'DR1', '2022-06-09', 'awedfvvvvvv', 0),
(5, 'DR1', '2022-06-29', 'awedfvvvvvv', 0),
(6, 'DR1', '2022-06-28', 'awedfvvvvvv sdfssfsddsffsdfsdfsdfsffsdsfdfsfssfsfffdsfsdfs', 0),
(7, 'DR2', '2022-06-30', 'awedfvvvvvv', 1),
(8, 'DR2', '2022-06-29', 'awedfvvvvvv', 2),
(9, 'DR1', '2022-06-29', 'pigfsdfghjk', 0),
(10, 'DR1', '2022-06-29', 'werrtyuyiop;;', 0),
(11, 'DR1', '2022-07-07', 'wsdgukjf', 0),
(12, 'DR1', '2022-07-07', 'wsdgukjf', 0),
(13, 'DR1', '2022-07-07', 'wsdgukjf', 0),
(14, 'DR1', '2022-07-07', 'wsdgukjf', 0),
(15, 'DA1', '2022-06-30', 'Nimesh&#039;s Wedding', 0),
(16, 'DA1', '2022-06-29', 'hiruna wedding', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `future_leaves_details`
-- (See below for the actual view)
--
CREATE TABLE `future_leaves_details` (
`user_id` varchar(20)
,`mobile_no` varchar(20)
,`weekly_worked_hours` int(11)
,`city` varchar(50)
,`last_arrival_time` time
,`city_name` varchar(45)
,`first_name` varchar(50)
,`last_name` varchar(50)
,`leave_id` int(11)
,`date` date
,`leave_reason` varchar(500)
,`status` tinyint(3)
);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `available_count` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `name`, `available_count`, `unit_price`, `is_deleted`) VALUES
(1, 'Toolbox', 2000, 60, 0),
(2, 'Rice', 40, 1500, 0),
(3, 'Giftset', 57, 2500, 0),
(4, 'Stationary Set', 100, 500, 0),
(5, 'Ladies Handbag', 25, 4590, 0),
(7, 'Milk', 210, 600, 0),
(8, 'Soap', 100, 70, 1),
(9, 'Soap', 100, 80, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_assignment`
--

CREATE TABLE `item_assignment` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_assignment`
--

INSERT INTO `item_assignment` (`item_id`, `order_id`, `item_quantity`) VALUES
(1, 1, 1),
(2, 3, 2),
(3, 2, 1),
(4, 2, 4),
(5, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `item_order`
--

CREATE TABLE `item_order` (
  `order_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `route_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('new','dtrain','ctrain','dtruck','delivered') NOT NULL,
  `address` varchar(50) NOT NULL,
  `weight` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item_order`
--

INSERT INTO `item_order` (`order_id`, `user_id`, `route_id`, `date`, `status`, `address`, `weight`) VALUES
(1, 'CR1', 1, '2022-02-12', 'delivered', 'Badulla rd, Bandarawela', 5500),
(2, 'CR2', 1, '2022-06-25', 'dtruck', 'Katubedda, Moratuwa', 930),
(3, 'CR1', 3, '2022-09-23', 'new', 'Kandy rd, Kadawatha', 3058),
(4, 'CR1', 1, '2022-04-23', 'dtruck', 'Katubedda, Moratuwa', 980),
(5, 'CR2', 1, '2022-06-25', 'dtruck', 'Katubedda, Moratuwa', 100),
(6, 'CR2', 3, '2022-06-25', 'dtruck', 'Katubedda, Moratuwa', 50),
(7, 'CR2', 2, '2022-06-25', 'dtrain', 'Katubedda, Moratuwa', 40),
(8, 'CR2', 1, '2022-06-25', 'new', 'Katubedda, Moratuwa', 30);

--
-- Triggers `item_order`
--
DELIMITER $$
CREATE TRIGGER `after_status_change` AFTER UPDATE ON `item_order` FOR EACH ROW IF new.status='new' and old.status ='dtrain' THEN
		UPDATE train set filled_capacity = (select filled_capacity from train where train_id = (SELECT train_id from train_assignment where order_id = old.order_id)) -  old.weight where train_id in (SELECT train_id from train_assignment where order_id = old.order_id);
    	DELETE from train_assignment where order_id = old.order_id;
    end if
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `turn_order_trigger` AFTER UPDATE ON `item_order` FOR EACH ROW if(new.status = 'delivered') then
insert ignore into `scmc`.`turn_order`(order_id,turn_id) values(old.order_id, (Select t.turn_id from turn as t where (t.route_id = old.route_id and t.turn_end_time IS NULL) limit 1));
end if
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `leaved_employees_today`
-- (See below for the actual view)
--
CREATE TABLE `leaved_employees_today` (
`user_id` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `route`
--

CREATE TABLE `route` (
  `route_id` int(11) NOT NULL,
  `start_city` int(11) NOT NULL,
  `end_city` int(11) NOT NULL,
  `maximum_completion_time` int(11) NOT NULL,
  `route_map` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route`
--

INSERT INTO `route` (`route_id`, `start_city`, `end_city`, `maximum_completion_time`, `route_map`) VALUES
(1, 1, 3, 4, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d126747.15560476693!2d80.95402778757747!3d6.908698787823643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3ae462167fa6dad9%3A0x84d3d072c32aa246!2sBadulla!3m2!1d6.993400899999999!2d81.0549815!4m5!1s0x3ae470011c243a85%3A0xd94f7b8a6c4e9867!2sBandarawela!3m2!1d6.8258779999999994!2d80.9981576!5e0!3m2!1sen!2slk!4v1656235284004!5m2!1sen!2slk'),
(2, 2, 4, 3, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d126760.85914873828!2d79.8002928372469!3d6.857384325063575!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo!3m2!1d6.9270786!2d79.861243!4m5!1s0x3ae2450af2b3b63d%3A0x4bd5b87e09abb3c7!2sMoratuwa!3m2!1d6.788070599999999!2d79.8912813!5e0!3m2!1sen!2slk!4v1656235414641!5m2!1sen!2slk'),
(3, 2, 5, 5, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d63364.94452705501!2d79.87719598866488!3d6.972820260383569!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo!3m2!1d6.9270786!2d79.861243!4m5!1s0x3ae2f86bd75870f7%3A0xee362e29dbc079a6!2sKadawatha!3m2!1d7.0046719!2d79.9542002!5e0!3m2!1sen!2slk!4v1656235475363!5m2!1sen!2slk'),
(4, 1, 6, 6, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d253522.85466040875!2d80.98851470522371!3d6.855248452313724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e6!4m5!1s0x3ae462167fa6dad9%3A0x84d3d072c32aa246!2sbadulla!3m2!1d6.993400899999999!2d81.0549815!4m5!1s0x3ae45a9ddf60af13%3A0xaaeaff47009fda28!2sMonaragala!3m2!1d6.8906453999999995!2d81.3454417!5e0!3m2!1sen!2slk!4v1656260770588!5m2!1sen!2slk');

-- --------------------------------------------------------

--
-- Stand-in structure for view `route_details`
-- (See below for the actual view)
--
CREATE TABLE `route_details` (
`route_id` int(11)
,`start_city_name` varchar(45)
,`end_city_name` varchar(45)
,`city` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `stock_keeper`
--

CREATE TABLE `stock_keeper` (
  `user_id` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_keeper`
--

INSERT INTO `stock_keeper` (`user_id`, `city`) VALUES
('SK1', '1'),
('SK2', '2');

-- --------------------------------------------------------

--
-- Table structure for table `train`
--

CREATE TABLE `train` (
  `train_id` int(11) NOT NULL,
  `train_name` varchar(45) NOT NULL,
  `arrival_day` date NOT NULL,
  `arrival_time` time NOT NULL,
  `destination` varchar(45) NOT NULL,
  `capacity` double NOT NULL,
  `filled_capacity` double NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `train`
--

INSERT INTO `train` (`train_id`, `train_name`, `arrival_day`, `arrival_time`, `destination`, `capacity`, `filled_capacity`, `is_deleted`) VALUES
(112344, 'Udarata Manike', '2022-06-16', '03:58:03', 'Matara', 10000, 8828, 0),
(1123245, 'Yal devii', '2022-06-16', '03:58:03', 'Jaffna', 10000, 3348, 0);

-- --------------------------------------------------------

--
-- Table structure for table `train_assignment`
--

CREATE TABLE `train_assignment` (
  `assigned_date` date NOT NULL,
  `assigned_time` time NOT NULL,
  `train_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `train_assignment`
--

INSERT INTO `train_assignment` (`assigned_date`, `assigned_time`, `train_id`, `order_id`) VALUES
('2022-06-17', '01:40:21', 112344, 1),
('2022-06-26', '15:51:16', 112344, 3),
('2022-06-27', '02:02:59', 112344, 5),
('2022-06-26', '16:13:59', 112344, 6),
('2022-07-04', '23:22:14', 112344, 7),
('2022-06-26', '15:51:39', 1123245, 3),
('2022-06-27', '02:10:55', 1123245, 5);

-- --------------------------------------------------------

--
-- Stand-in structure for view `train_dispatched_orders`
-- (See below for the actual view)
--
CREATE TABLE `train_dispatched_orders` (
`order_id` int(11)
,`user_id` varchar(20)
,`route_id` int(11)
,`date` date
,`status` enum('new','dtrain','ctrain','dtruck','delivered')
,`address` varchar(50)
,`weight` double
,`city_id` int(11)
,`train_id` int(11)
,`train_name` varchar(45)
);

-- --------------------------------------------------------

--
-- Table structure for table `truck`
--

CREATE TABLE `truck` (
  `truck_id` int(11) NOT NULL,
  `truck_no` varchar(20) NOT NULL,
  `city_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `truck`
--

INSERT INTO `truck` (`truck_id`, `truck_no`, `city_id`) VALUES
(1, 'LD-5433', 1),
(2, 'LA-2376', 1),
(3, 'ZA-1124', 1),
(4, 'LL-6678', 1);

-- --------------------------------------------------------

--
-- Table structure for table `turn`
--

CREATE TABLE `turn` (
  `turn_id` int(11) NOT NULL,
  `driver_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `assistant_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `route_id` int(11) NOT NULL,
  `truck_id` int(11) NOT NULL,
  `scheduled_date` date NOT NULL,
  `scheduled_time` time NOT NULL,
  `turn_start_time` datetime DEFAULT NULL,
  `turn_end_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `turn`
--

INSERT INTO `turn` (`turn_id`, `driver_id`, `assistant_id`, `route_id`, `truck_id`, `scheduled_date`, `scheduled_time`, `turn_start_time`, `turn_end_time`) VALUES
(1, 'DR1', 'DA1', 1, 1, '2022-06-07', '01:40:21', '0000-00-00 00:00:00', NULL),
(3, 'DR2', 'DA2', 2, 2, '2022-06-26', '01:40:53', '2022-06-26 03:42:32', NULL),
(4, 'DR3', 'DA2', 3, 3, '2022-06-14', '03:00:00', '2022-06-26 03:42:32', '2022-06-26 18:26:16'),
(6, 'DR4', 'DA1', 4, 1, '2022-06-17', '05:00:00', NULL, NULL),
(7, 'DR3', 'DA2', 3, 3, '2022-06-18', '06:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `turns_in_progress`
-- (See below for the actual view)
--
CREATE TABLE `turns_in_progress` (
`turn_id` int(11)
,`driver_id` varchar(20)
,`assistant_id` varchar(20)
,`route_id` int(11)
,`truck_id` int(11)
,`scheduled_date` date
,`scheduled_time` time
,`turn_start_time` datetime
,`turn_end_time` datetime
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `turns_to_dispatch`
-- (See below for the actual view)
--
CREATE TABLE `turns_to_dispatch` (
`turn_id` int(11)
,`driver_id` varchar(20)
,`assistant_id` varchar(20)
,`route_id` int(11)
,`truck_id` int(11)
,`city_id` int(11)
,`driver_name` varchar(101)
,`assistant_name` varchar(101)
,`truck_no` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `turn_order`
--

CREATE TABLE `turn_order` (
  `order_id` int(11) NOT NULL,
  `turn_id` int(11) DEFAULT NULL,
  `delivered_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `turn_order`
--

INSERT INTO `turn_order` (`order_id`, `turn_id`, `delivered_time`) VALUES
(1, 1, '2022-06-27 04:04:18');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `password`) VALUES
('CR1', 'Gayani', 'Dissanayake', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('CR2', 'Vidumini', 'Raveesha', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA1', 'Sunil', 'Perera', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA2', 'Pawan', 'Karunarathne', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA3', 'Nimal', 'Jayakody', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR1', 'Kamal', 'Ranasignhe', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR2', 'Namal', 'Rajapaksha', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR3', 'Kasun', 'Gamage', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('MN1', 'System', 'Manager', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('SK1', 'Amal', 'Gunasignhe', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('SK2', 'Dasun', 'Shanaka', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('SM1', 'Kavindu', 'Pathirana', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK');

-- --------------------------------------------------------

--
-- Structure for view `available_assistants`
--
DROP TABLE IF EXISTS `available_assistants`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `available_assistants`  AS SELECT `driver_assistant`.`user_id` AS `user_id`, `user`.`first_name` AS `first_name`, `user`.`last_name` AS `last_name`, `employee`.`mobile_no` AS `mobile_no`, `employee`.`weekly_worked_hours` AS `weekly_worked_hours`, `employee`.`city` AS `city` FROM ((`driver_assistant` join `employee` on(`driver_assistant`.`user_id` = `employee`.`user_id`)) join `user` on(`driver_assistant`.`user_id` = `user`.`user_id`)) WHERE !(`driver_assistant`.`user_id` in (select `leaved_employees_today`.`user_id` from `leaved_employees_today`)) AND (`driver_assistant`.`cons_turn_count` < 2 OR `driver_assistant`.`cons_turn_count` = 2 AND hour(timediff(cast(convert_tz(current_timestamp(),'+00:00','+05:30') as time),`employee`.`last_arrival_time`)) > 0)  ;

-- --------------------------------------------------------

--
-- Structure for view `available_drivers`
--
DROP TABLE IF EXISTS `available_drivers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `available_drivers`  AS SELECT `driver`.`user_id` AS `user_id`, `user`.`first_name` AS `first_name`, `user`.`last_name` AS `last_name`, `employee`.`mobile_no` AS `mobile_no`, `employee`.`weekly_worked_hours` AS `weekly_worked_hours`, `employee`.`city` AS `city` FROM ((`driver` join `employee` on(`driver`.`user_id` = `employee`.`user_id`)) join `user` on(`driver`.`user_id` = `user`.`user_id`)) WHERE !(`driver`.`user_id` in (select `leaved_employees_today`.`user_id` from `leaved_employees_today`)) AND hour(timediff(cast(convert_tz(current_timestamp(),'+00:00','+05:30') as time),`employee`.`last_arrival_time`)) > 00  ;

-- --------------------------------------------------------

--
-- Structure for view `driver_assistant_order`
--
DROP TABLE IF EXISTS `driver_assistant_order`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `driver_assistant_order`  AS SELECT `o`.`order_id` AS `order_id`, `t`.`assistant_id` AS `assistant_id`, `t`.`driver_id` AS `driver_id`, (select `r`.`route_map` from `route` `r` where `r`.`route_id` = `t`.`route_id` limit 1) AS `route_map` FROM (`item_order` `o` join `turn` `t`) WHERE `o`.`status` = 'dtruck' AND `o`.`route_id` = `t`.`route_id``route_id`  ;

-- --------------------------------------------------------

--
-- Structure for view `future_leaves_details`
--
DROP TABLE IF EXISTS `future_leaves_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`sql6501921`@`%` SQL SECURITY INVOKER VIEW `future_leaves_details`  AS SELECT `employee`.`user_id` AS `user_id`, `employee`.`mobile_no` AS `mobile_no`, `employee`.`weekly_worked_hours` AS `weekly_worked_hours`, `employee`.`city` AS `city`, `employee`.`last_arrival_time` AS `last_arrival_time`, `city`.`name` AS `city_name`, `user`.`first_name` AS `first_name`, `user`.`last_name` AS `last_name`, `employee_leave`.`leave_id` AS `leave_id`, `employee_leave`.`date` AS `date`, `employee_leave`.`leave_reason` AS `leave_reason`, `employee_leave`.`status` AS `status` FROM (((`user` join `employee_leave` on(`user`.`user_id` = `employee_leave`.`user_id`)) join `employee` on(`user`.`user_id` = `employee`.`user_id`)) join `city` on(`city`.`city_id` = `employee`.`city`)) WHERE `employee_leave`.`date` > cast(convert_tz(current_timestamp(),'+00:00','+05:30') as date) ORDER BY `employee_leave`.`date` ASC  ;

-- --------------------------------------------------------

--
-- Structure for view `leaved_employees_today`
--
DROP TABLE IF EXISTS `leaved_employees_today`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `leaved_employees_today`  AS SELECT DISTINCT `employee_leave`.`user_id` AS `user_id` FROM `employee_leave` WHERE `employee_leave`.`date` = cast(convert_tz(current_timestamp(),'+00:00','+05:30') as date) AND `employee_leave`.`status` = 1111  ;

-- --------------------------------------------------------

--
-- Structure for view `route_details`
--
DROP TABLE IF EXISTS `route_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `route_details`  AS SELECT `route`.`route_id` AS `route_id`, `scity`.`name` AS `start_city_name`, `ecity`.`name` AS `end_city_name`, `city_assignment`.`city_id` AS `city` FROM (((`route` join `city_assignment` on(`route`.`route_id` = `city_assignment`.`route_id`)) join `city` `scity` on(`scity`.`city_id` = `route`.`start_city`)) join `city` `ecity` on(`ecity`.`city_id` = `route`.`end_city`))  ;

-- --------------------------------------------------------

--
-- Structure for view `train_dispatched_orders`
--
DROP TABLE IF EXISTS `train_dispatched_orders`;

CREATE ALGORITHM=UNDEFINED DEFINER=`sql6501921`@`%` SQL SECURITY INVOKER VIEW `train_dispatched_orders`  AS SELECT `item_order`.`order_id` AS `order_id`, `item_order`.`user_id` AS `user_id`, `item_order`.`route_id` AS `route_id`, `item_order`.`date` AS `date`, `item_order`.`status` AS `status`, `item_order`.`address` AS `address`, `item_order`.`weight` AS `weight`, `city_assignment`.`city_id` AS `city_id`, `train_assignment`.`train_id` AS `train_id`, `train`.`train_name` AS `train_name` FROM (((`item_order` join `city_assignment` on(`item_order`.`route_id` = `city_assignment`.`route_id`)) join `train_assignment` on(`item_order`.`order_id` = `train_assignment`.`order_id`)) join `train` on(`train_assignment`.`train_id` = `train`.`train_id`)) WHERE `item_order`.`status` = 'dtrain''dtrain'  ;

-- --------------------------------------------------------

--
-- Structure for view `turns_in_progress`
--
DROP TABLE IF EXISTS `turns_in_progress`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `turns_in_progress`  AS SELECT `turn`.`turn_id` AS `turn_id`, `turn`.`driver_id` AS `driver_id`, `turn`.`assistant_id` AS `assistant_id`, `turn`.`route_id` AS `route_id`, `turn`.`truck_id` AS `truck_id`, `turn`.`scheduled_date` AS `scheduled_date`, `turn`.`scheduled_time` AS `scheduled_time`, `turn`.`turn_start_time` AS `turn_start_time`, `turn`.`turn_end_time` AS `turn_end_time` FROM `turn` WHERE `turn`.`scheduled_date` = cast(convert_tz(current_timestamp(),'+00:00','+05:30') as date) AND (`turn`.`turn_start_time` is null OR `turn`.`turn_end_time` is null)  ;

-- --------------------------------------------------------

--
-- Structure for view `turns_to_dispatch`
--
DROP TABLE IF EXISTS `turns_to_dispatch`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `turns_to_dispatch`  AS SELECT `turn`.`turn_id` AS `turn_id`, `turn`.`driver_id` AS `driver_id`, `turn`.`assistant_id` AS `assistant_id`, `turn`.`route_id` AS `route_id`, `turn`.`truck_id` AS `truck_id`, `city_assignment`.`city_id` AS `city_id`, concat(`d_user`.`first_name`,' ',`d_user`.`last_name`) AS `driver_name`, concat(`da_user`.`first_name`,' ',`da_user`.`last_name`) AS `assistant_name`, `truck`.`truck_no` AS `truck_no` FROM ((((`turn` join `user` `d_user` on(`d_user`.`user_id` = `turn`.`driver_id`)) join `user` `da_user` on(`da_user`.`user_id` = `turn`.`assistant_id`)) join `truck` on(`turn`.`truck_id` = `truck`.`truck_id`)) join `city_assignment` on(`turn`.`route_id` = `city_assignment`.`route_id`)) WHERE `turn`.`turn_start_time` is nullnull  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `city_assignment`
--
ALTER TABLE `city_assignment`
  ADD PRIMARY KEY (`city_id`,`route_id`),
  ADD KEY `routee_idx` (`route_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `driver_assistant`
--
ALTER TABLE `driver_assistant`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `employee_leave`
--
ALTER TABLE `employee_leave`
  ADD PRIMARY KEY (`leave_id`),
  ADD KEY `apply_leave_idx` (`user_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `item_assignment`
--
ALTER TABLE `item_assignment`
  ADD PRIMARY KEY (`item_id`,`order_id`),
  ADD KEY `orderr_idx` (`order_id`);

--
-- Indexes for table `item_order`
--
ALTER TABLE `item_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id_idx` (`user_id`),
  ADD KEY `route_id_idx` (`route_id`);

--
-- Indexes for table `route`
--
ALTER TABLE `route`
  ADD PRIMARY KEY (`route_id`),
  ADD KEY `start_city_idx` (`start_city`),
  ADD KEY `end_city_idx` (`end_city`);

--
-- Indexes for table `stock_keeper`
--
ALTER TABLE `stock_keeper`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `train`
--
ALTER TABLE `train`
  ADD PRIMARY KEY (`train_id`);

--
-- Indexes for table `train_assignment`
--
ALTER TABLE `train_assignment`
  ADD PRIMARY KEY (`train_id`,`order_id`),
  ADD KEY `order_id_idx` (`order_id`);

--
-- Indexes for table `truck`
--
ALTER TABLE `truck`
  ADD PRIMARY KEY (`truck_id`),
  ADD KEY `truck_city_idx` (`city_id`);

--
-- Indexes for table `turn`
--
ALTER TABLE `turn`
  ADD PRIMARY KEY (`turn_id`),
  ADD KEY `truck_id_idx` (`truck_id`),
  ADD KEY `route_id_idx` (`route_id`),
  ADD KEY `truckassist_idx` (`assistant_id`),
  ADD KEY `driverr_idx` (`driver_id`);

--
-- Indexes for table `turn_order`
--
ALTER TABLE `turn_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `turn_idx` (`turn_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee_leave`
--
ALTER TABLE `employee_leave`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `item_order`
--
ALTER TABLE `item_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `train`
--
ALTER TABLE `train`
  MODIFY `train_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1123246;

--
-- AUTO_INCREMENT for table `turn`
--
ALTER TABLE `turn`
  MODIFY `turn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city_assignment`
--
ALTER TABLE `city_assignment`
  ADD CONSTRAINT `city_id` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `routee` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_leave`
--
ALTER TABLE `employee_leave`
  ADD CONSTRAINT `apply_leave` FOREIGN KEY (`user_id`) REFERENCES `employee` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_assignment`
--
ALTER TABLE `item_assignment`
  ADD CONSTRAINT `item_id` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderr` FOREIGN KEY (`order_id`) REFERENCES `item_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item_order`
--
ALTER TABLE `item_order`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `routess` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `route`
--
ALTER TABLE `route`
  ADD CONSTRAINT `end_city` FOREIGN KEY (`end_city`) REFERENCES `city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `start_city` FOREIGN KEY (`start_city`) REFERENCES `city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `train_assignment`
--
ALTER TABLE `train_assignment`
  ADD CONSTRAINT `order_id` FOREIGN KEY (`order_id`) REFERENCES `item_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `train_id` FOREIGN KEY (`train_id`) REFERENCES `train` (`train_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `truck`
--
ALTER TABLE `truck`
  ADD CONSTRAINT `truck_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `turn`
--
ALTER TABLE `turn`
  ADD CONSTRAINT `assistanttt` FOREIGN KEY (`assistant_id`) REFERENCES `driver_assistant` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `driverr` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `route_id` FOREIGN KEY (`route_id`) REFERENCES `route` (`route_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `truck_id` FOREIGN KEY (`truck_id`) REFERENCES `truck` (`truck_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `turn_order`
--
ALTER TABLE `turn_order`
  ADD CONSTRAINT `order` FOREIGN KEY (`order_id`) REFERENCES `item_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `turn` FOREIGN KEY (`turn_id`) REFERENCES `turn` (`turn_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

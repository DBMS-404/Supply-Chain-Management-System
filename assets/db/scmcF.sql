-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2022 at 05:48 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

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
CREATE DEFINER=`root`@`localhost` FUNCTION `calc_tot_price` (`order_id` INT(11)) RETURNS INT(11) BEGIN
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
(8, 'Colombo'),
(9, 'Negombo'),
(10, 'Galle'),
(11, 'Matara'),
(12, 'Jaffna'),
(13, 'Trinco'),
(14, 'Kurunegala'),
(15, 'Kegalle'),
(16, 'Avissawella'),
(17, 'Weligama'),
(18, 'Akuressa'),
(19, 'Ambalangoda'),
(20, 'Kalutara'),
(21, 'Badulla'),
(22, 'Nuwara Eliya'),
(23, 'Mannar'),
(24, 'Batticaloa'),
(25, 'Chilaw'),
(26, 'Hambantota'),
(27, 'Ampara'),
(28, 'Polonnaruwa'),
(29, 'Anuradhapura'),
(30, 'Kilinochchi'),
(31, 'Matale'),
(32, 'Ratnapura'),
(33, 'Monaragala'),
(34, 'Udugama'),
(35, 'Deniyaya');

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
(8, 7),
(8, 8),
(8, 9),
(8, 10),
(9, 11),
(9, 12),
(9, 13),
(10, 14),
(10, 15),
(10, 16),
(10, 17),
(11, 18),
(11, 19),
(11, 20),
(11, 21),
(12, 22),
(12, 23),
(12, 24),
(13, 25),
(13, 26),
(13, 27),
(13, 28);

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
('CR0001', 'B169,Talpotha,Polonnaruwa', '+94 47 926 1326'),
('CR0002', 'B63,PuttalamCementFactory,Puttalam', '+94 47 774 3432'),
('CR0003', 'B158,Talawattegedara,Kurunegala', '+94 47 616 8346'),
('CR0004', 'B95,Sigiriya,Matale', '+94 47 672 5505'),
('CR0005', 'B29,Cheddipalayam,Batticaloa', '+94 47 954 5892'),
('CR0006', 'B96,Ulpothagama,Kandy', '+94 47 670 0823'),
('CR0007', 'B92,Bopattalawa,Nuwara Eliya', '+94 47 373 8567'),
('CR0008', 'B14,Kahatagollewa,Anuradhapura', '+94 47 096 6007'),
('CR0009', 'B11,Walawela,Kolonnaw', '+94 47 965 8563'),
('CR0010', 'B35,Hindagolla,Moratuwa', '+94 47 341 7213');

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
('DR0001', 'K8138926'),
('DR0002', 'T0411968'),
('DR0003', 'B7892148'),
('DR0004', 'K8138927'),
('DR0005', 'T0411969'),
('DR0006', 'B7892149'),
('DR0007', 'K8138928'),
('DR0008', 'T0411970'),
('DR0009', 'B7892150'),
('DR0010', 'K8138929'),
('DR0011', 'T0411971'),
('DR0012', 'B7892151'),
('DR0013', 'K8138930'),
('DR0014', 'T0411972'),
('DR0015', 'B7892152'),
('DR0016', 'K8138931'),
('DR0017', 'T0411973'),
('DR0018', 'B7892153'),
('DR0019', 'K8138932'),
('DR0020', 'T0411974'),
('DR0021', 'B7892154'),
('DR0022', 'K8138933'),
('DR0023', 'T0411975'),
('DR0024', 'B7892155'),
('DR0025', 'K8138934'),
('DR0026', 'T0411976'),
('DR0027', 'B7892156'),
('DR0028', 'K8138935'),
('DR0029', 'T0411977'),
('DR0030', 'B7892157');

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
('DA0001', 0),
('DA0002', 0),
('DA0003', 0),
('DA0004', 0),
('DA0005', 0),
('DA0006', 0),
('DA0007', 0),
('DA0008', 0),
('DA0009', 0),
('DA0010', 0),
('DA0011', 0),
('DA0012', 0),
('DA0013', 0),
('DA0014', 0),
('DA0015', 0),
('DA0016', 0),
('DA0017', 0),
('DA0018', 0),
('DA0019', 0),
('DA0020', 0),
('DA0021', 0),
('DA0022', 0),
('DA0023', 0),
('DA0024', 0),
('DA0025', 0),
('DA0026', 0),
('DA0027', 0),
('DA0028', 0),
('DA0029', 0),
('DA0030', 0);

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
  `last_arrival_time` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`user_id`, `mobile_no`, `weekly_worked_hours`, `city`, `last_arrival_time`) VALUES
('DA0001', '+94 74 068 8177', 0, '8', '00:00:00'),
('DA0002', '+94 74 252 8487', 0, '8', '00:00:00'),
('DA0003', '+94 70 989 5284', 0, '8', '00:00:00'),
('DA0004', '+94 74 068 8179', 0, '8', '00:00:00'),
('DA0005', '+94 74 252 8489', 0, '8', '00:00:00'),
('DA0006', '+94 70 989 5286', 0, '9', '00:00:00'),
('DA0007', '+94 74 068 8181', 0, '9', '00:00:00'),
('DA0008', '+94 74 252 8491', 0, '9', '00:00:00'),
('DA0009', '+94 70 989 5288', 0, '9', '00:00:00'),
('DA0010', '+94 74 068 8183', 0, '9', '00:00:00'),
('DA0011', '+94 74 252 8493', 0, '10', '00:00:00'),
('DA0012', '+94 70 989 5290', 0, '10', '00:00:00'),
('DA0013', '+94 74 068 8185', 0, '10', '00:00:00'),
('DA0014', '+94 74 252 8495', 0, '10', '00:00:00'),
('DA0015', '+94 70 989 5292', 0, '10', '00:00:00'),
('DA0016', '+94 74 068 8187', 0, '11', '00:00:00'),
('DA0017', '+94 74 252 8497', 0, '11', '00:00:00'),
('DA0018', '+94 70 989 5294', 0, '11', '00:00:00'),
('DA0019', '+94 74 068 8189', 0, '11', '00:00:00'),
('DA0020', '+94 74 252 8499', 0, '11', '00:00:00'),
('DA0021', '+94 70 989 5296', 0, '12', '00:00:00'),
('DA0022', '+94 74 068 8191', 0, '12', '00:00:00'),
('DA0023', '+94 74 252 8501', 0, '12', '00:00:00'),
('DA0024', '+94 70 989 5298', 0, '12', '00:00:00'),
('DA0025', '+94 74 068 8193', 0, '12', '00:00:00'),
('DA0026', '+94 74 252 8503', 0, '13', '00:00:00'),
('DA0027', '+94 70 989 5300', 0, '13', '00:00:00'),
('DA0028', '+94 74 068 8195', 0, '13', '00:00:00'),
('DA0029', '+94 74 252 8505', 0, '13', '00:00:00'),
('DA0030', '+94 70 989 5302', 0, '13', '00:00:00'),
('DR0001', '+94 74 252 8486', 0, '8', '00:00:00'),
('DR0002', '+94 70 989 5283', 0, '8', '00:00:00'),
('DR0003', '+94 74 068 8178', 0, '8', '00:00:00'),
('DR0004', '+94 74 252 8488', 0, '8', '00:00:00'),
('DR0005', '+94 70 989 5285', 0, '8', '00:00:00'),
('DR0006', '+94 74 068 8180', 0, '9', '00:00:00'),
('DR0007', '+94 74 252 8490', 0, '9', '00:00:00'),
('DR0008', '+94 70 989 5287', 0, '9', '00:00:00'),
('DR0009', '+94 74 068 8182', 0, '9', '00:00:00'),
('DR0010', '+94 74 252 8492', 0, '9', '00:00:00'),
('DR0011', '+94 70 989 5289', 0, '10', '00:00:00'),
('DR0012', '+94 74 068 8184', 0, '10', '00:00:00'),
('DR0013', '+94 74 252 8494', 0, '10', '00:00:00'),
('DR0014', '+94 70 989 5291', 0, '10', '00:00:00'),
('DR0015', '+94 74 068 8186', 0, '10', '00:00:00'),
('DR0016', '+94 74 252 8496', 0, '11', '00:00:00'),
('DR0017', '+94 70 989 5293', 0, '11', '00:00:00'),
('DR0018', '+94 74 068 8188', 0, '11', '00:00:00'),
('DR0019', '+94 74 252 8498', 0, '11', '00:00:00'),
('DR0020', '+94 70 989 5295', 0, '11', '00:00:00'),
('DR0021', '+94 74 068 8190', 0, '12', '00:00:00'),
('DR0022', '+94 74 252 8500', 0, '12', '00:00:00'),
('DR0023', '+94 70 989 5297', 0, '12', '00:00:00'),
('DR0024', '+94 74 068 8192', 0, '12', '00:00:00'),
('DR0025', '+94 74 252 8502', 0, '12', '00:00:00'),
('DR0026', '+94 70 989 5299', 0, '13', '00:00:00'),
('DR0027', '+94 74 068 8194', 0, '13', '00:00:00'),
('DR0028', '+94 74 252 8504', 0, '13', '00:00:00'),
('DR0029', '+94 70 989 5301', 0, '13', '00:00:00'),
('DR0030', '+94 74 068 8196', 0, '13', '00:00:00');

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
(11, 'WHITE HANGING HEART ', 1631, 4163, 0),
(12, 'WHITE METAL LANTERN', 1546, 3100, 0),
(13, 'CREAM CUPID HEARTS C', 1397, 11103, 0),
(14, 'KNITTED UNION FLAG H', 184, 8686, 0),
(15, 'RED WOOLLY HOTTIE WH', 1174, 17527, 0),
(16, 'SET 7 BABUSHKA NESTI', 1716, 3102, 0),
(17, 'GLASS STAR FROSTED T', 1187, 944, 0),
(18, 'HAND WARMER UNION JA', 703, 17064, 0),
(19, 'HAND WARMER RED POLK', 402, 3048, 0),
(20, 'ASSORTED COLOUR BIRD', 579, 15359, 0),
(21, 'POPPY\'S PLAYHOUSE BE', 399, 10308, 0),
(22, 'POPPY\'S PLAYHOUSE KI', 1915, 4040, 0),
(23, 'FELTCRAFT PRINCESS C', 1751, 8413, 0),
(24, 'IVORY KNITTED MUG CO', 410, 10859, 0),
(25, 'BOX OF 6 ASSORTED CO', 206, 14070, 0),
(26, 'BOX OF VINTAGE JIGSA', 337, 11257, 0),
(27, 'BOX OF VINTAGE ALPHA', 520, 15955, 0),
(28, 'HOME BUILDING BLOCK ', 753, 13860, 0),
(29, 'LOVE BUILDING BLOCK ', 126, 7230, 0),
(30, 'RECIPE BOX WITH META', 1911, 18403, 0),
(31, 'DOORMAT NEW ENGLAND', 407, 2808, 0),
(32, 'JAM MAKING SET WITH ', 1616, 10083, 0),
(33, 'RED COAT RACK PARIS ', 1346, 18240, 0),
(34, 'YELLOW COAT RACK PAR', 1643, 13460, 0),
(35, 'BLUE COAT RACK PARIS', 1547, 12079, 0),
(36, 'BATH BUILDING BLOCK ', 1202, 9118, 0),
(37, 'ALARM CLOCK BAKELIKE', 1188, 2220, 0),
(38, 'ALARM CLOCK BAKELIKE', 806, 18464, 0),
(39, 'ALARM CLOCK BAKELIKE', 1942, 6271, 0),
(40, 'PANDA AND BUNNIES ST', 1379, 5315, 0),
(41, 'STARS GIFT TAPE ', 1303, 784, 0),
(42, 'INFLATABLE POLITICAL', 692, 9292, 0),
(43, 'VINTAGE HEADS AND TA', 1962, 4736, 0),
(44, 'SET/2 RED RETROSPOT ', 458, 1324, 0),
(45, 'ROUND SNACK BOXES SE', 919, 9381, 0),
(46, 'SPACEBOY LUNCH BOX ', 1907, 12041, 0),
(47, 'LUNCH BOX I LOVE LON', 720, 8160, 0),
(48, 'CIRCUS PARADE LUNCH ', 1425, 19855, 0),
(49, 'CHARLOTTE BAG DOLLY ', 1193, 17614, 0),
(50, 'RED TOADSTOOL LED NI', 1953, 1290, 0),
(51, ' SET 2 TEA TOWELS I ', 1556, 5588, 0),
(52, 'VINTAGE SEASIDE JIGS', 288, 17544, 0),
(53, 'MINI JIGSAW CIRCUS P', 1633, 16982, 0),
(54, 'MINI JIGSAW SPACEBOY', 1665, 4205, 0),
(55, 'MINI PAINT SET VINTA', 1805, 7302, 0),
(56, 'POSTAGE', 1865, 3083, 0),
(57, 'PAPER CHAIN KIT 50\'S', 932, 11205, 0),
(58, 'HAND WARMER RED POLK', 1092, 7391, 0),
(59, 'HAND WARMER UNION JA', 1768, 9759, 0),
(60, 'WHITE HANGING HEART ', 1612, 8803, 0),
(61, 'WHITE METAL LANTERN', 1050, 15135, 0),
(62, 'CREAM CUPID HEARTS C', 563, 10761, 0),
(63, 'EDWARDIAN PARASOL RE', 664, 7296, 0),
(64, 'RETRO COFFEE MUGS AS', 1638, 7078, 0),
(65, 'SAVE THE PLANET MUG', 300, 18973, 0),
(66, 'VINTAGE BILLBOARD DR', 478, 16699, 0),
(67, 'VINTAGE BILLBOARD LO', 263, 4783, 0),
(68, 'WOOD 2 DRAWER CABINE', 646, 15438, 0),
(69, 'WOOD S/3 CABINET ANT', 1530, 10240, 0),
(70, 'WOODEN PICTURE FRAME', 909, 5379, 0),
(71, 'WOODEN FRAME ANTIQUE', 1988, 418, 0),
(72, 'KNITTED UNION FLAG H', 931, 11528, 0),
(73, 'RED WOOLLY HOTTIE WH', 394, 19017, 0),
(74, 'SET 7 BABUSHKA NESTI', 1318, 15792, 0),
(75, 'GLASS STAR FROSTED T', 209, 16286, 0),
(76, 'VICTORIAN SEWING BOX', 217, 14947, 0),
(77, 'WHITE HANGING HEART ', 706, 5738, 0),
(78, 'WHITE METAL LANTERN', 980, 19394, 0),
(79, 'CREAM CUPID HEARTS C', 189, 11895, 0),
(80, 'EDWARDIAN PARASOL RE', 1992, 10463, 0),
(81, 'RETRO COFFEE MUGS AS', 487, 13848, 0),
(82, 'SAVE THE PLANET MUG', 527, 5173, 0),
(83, 'VINTAGE BILLBOARD DR', 321, 376, 0),
(84, 'VINTAGE BILLBOARD LO', 1364, 17014, 0),
(85, 'WOOD 2 DRAWER CABINE', 562, 1415, 0),
(86, 'WOOD S/3 CABINET ANT', 884, 13630, 0),
(87, 'WOODEN PICTURE FRAME', 558, 15897, 0),
(88, 'WOODEN FRAME ANTIQUE', 889, 6885, 0),
(89, 'KNITTED UNION FLAG H', 338, 10658, 0),
(90, 'RED WOOLLY HOTTIE WH', 1504, 7017, 0),
(91, 'SET 7 BABUSHKA NESTI', 1278, 2743, 0),
(92, 'GLASS STAR FROSTED T', 1808, 1575, 0),
(93, 'HOT WATER BOTTLE TEA', 234, 10815, 0),
(94, 'RED HANGING HEART T-', 1548, 13380, 0),
(95, 'HAND WARMER RED POLK', 900, 3969, 0),
(96, 'HAND WARMER UNION JA', 132, 5969, 0),
(97, 'JUMBO BAG PINK POLKA', 763, 10035, 0),
(98, 'JUMBO  BAG BAROQUE B', 496, 17865, 0),
(99, 'JUMBO BAG CHARLIE AN', 1223, 3007, 0),
(100, 'STRAWBERRY CHARLOTTE', 1140, 8719, 0),
(101, 'RED 3 PIECE RETROSPO', 177, 11298, 0),
(102, 'BLUE 3 PIECE POLKADO', 599, 8733, 0),
(103, 'SET/6 RED SPOTTY PAP', 661, 16940, 0),
(104, 'LUNCH BAG RED RETROS', 800, 11712, 0),
(105, 'STRAWBERRY LUNCH BOX', 1220, 363, 0),
(106, 'LUNCH BOX WITH CUTLE', 110, 16662, 0),
(107, 'PACK OF 72 RETROSPOT', 1335, 7439, 0),
(108, 'PACK OF 60 DINOSAUR ', 251, 6802, 0),
(109, 'PACK OF 60 PINK PAIS', 230, 3045, 0),
(110, '60 TEATIME FAIRY CAK', 508, 2757, 0),
(111, 'TOMATO CHARLIE+LOLA ', 539, 6101, 0),
(112, 'CHARLIE & LOLA WASTE', 1361, 2655, 0),
(113, 'RED CHARLIE+LOLA PER', 481, 15184, 0),
(114, 'JUMBO STORAGE BAG SU', 520, 19341, 0),
(115, 'JUMBO BAG PINK VINTA', 1118, 19107, 0),
(116, 'JAM MAKING SET PRINT', 362, 12231, 0),
(117, 'RETROSPOT TEA SET CE', 1007, 15735, 0),
(118, 'GIRLY PINK TOOL SET', 273, 9624, 0),
(119, 'JUMBO SHOPPER VINTAG', 1380, 13685, 0),
(120, 'AIRLINE LOUNGE,METAL', 1153, 13703, 0),
(121, 'WHITE SPOT RED CERAM', 771, 16650, 0),
(122, 'RED DRAWER KNOB ACRY', 1655, 13668, 0),
(123, 'CLEAR DRAWER KNOB AC', 1225, 5329, 0),
(124, 'PHOTO CLIP LINE', 214, 14249, 0),
(125, 'FELT EGG COSY CHICKE', 1974, 15623, 0),
(126, 'PIGGY BANK RETROSPOT', 788, 1986, 0),
(127, 'SKULL SHOULDER BAG', 1827, 6379, 0),
(128, 'YOU\'RE CONFUSING ME ', 806, 9524, 0),
(129, 'COOK WITH WINE METAL', 1670, 11441, 0),
(130, 'GIN + TONIC DIET MET', 165, 4596, 0),
(131, 'YELLOW BREAKFAST CUP', 1714, 14355, 0),
(132, 'PINK BREAKFAST CUP A', 1169, 2952, 0),
(133, 'PAPER CHAIN KIT 50\'S', 549, 2114, 0),
(134, 'PAPER CHAIN KIT RETR', 1192, 16047, 0),
(135, 'SMALL HEART FLOWERS ', 842, 4153, 0),
(136, 'PHOTO CLIP LINE', 483, 7786, 0),
(137, 'TEA TIME DES TEA COS', 1803, 15877, 0),
(138, 'FELT EGG COSY WHITE ', 810, 1471, 0),
(139, 'ZINC WILLIE WINKIE  ', 818, 11904, 0),
(140, 'CERAMIC CHERRY CAKE ', 1607, 2672, 0),
(141, 'RETROSPOT LARGE MILK', 1044, 10299, 0),
(142, 'SET OF 6 FUNKY BEAKE', 813, 16469, 0),
(143, 'EDWARDIAN PARASOL BL', 1709, 5189, 0),
(144, 'EDWARDIAN PARASOL NA', 359, 8092, 0),
(145, 'CERAMIC STRAWBERRY C', 1126, 18356, 0),
(146, 'BLUE OWL SOFT TOY', 1746, 1398, 0),
(147, 'BALLOON ART MAKE YOU', 1911, 2408, 0),
(148, 'RED TOADSTOOL LED NI', 363, 14143, 0),
(149, 'GLASS CLOCHE SMALL', 808, 15365, 0),
(150, 'GUMBALL MONOCHROME C', 1754, 10976, 0),
(151, 'DOORMAT FANCY FONT H', 308, 6284, 0),
(152, 'Discount', 1341, 12469, 0),
(153, 'INFLATABLE POLITICAL', 1132, 15131, 0),
(154, 'VINTAGE SNAKES & LAD', 124, 7488, 0),
(155, 'CHOCOLATE CALCULATOR', 1528, 6291, 0),
(156, 'JUMBO SHOPPER VINTAG', 1428, 5645, 0),
(157, 'RECYCLING BAG RETROS', 937, 4278, 0),
(158, 'TOY TIDY PINK POLKAD', 264, 17261, 0),
(159, 'ANTIQUE GLASS DRESSI', 183, 11029, 0),
(160, 'ALARM CLOCK BAKELIKE', 701, 17802, 0),
(161, 'IVORY GIANT GARDEN T', 1669, 12931, 0),
(162, '3 TIER CAKE TIN GREE', 484, 15395, 0),
(163, '3 TIER CAKE TIN RED ', 812, 7826, 0),
(164, 'SET 3 WICKER OVAL BA', 1840, 19613, 0),
(165, 'SET OF 3 COLOURED  F', 441, 6927, 0),
(166, 'WOOD BLACK BOARD ANT', 1592, 9064, 0),
(167, 'COLOUR GLASS T-LIGHT', 722, 14048, 0),
(168, 'HANGING METAL HEART ', 214, 10316, 0),
(169, 'HANGING MEDINA LANTE', 538, 2022, 0),
(170, 'NATURAL SLATE HEART ', 1606, 17646, 0),
(171, 'HEART OF WICKER SMAL', 1481, 436, 0),
(172, 'HEART OF WICKER LARG', 1244, 13057, 0),
(173, 'WHITE LOVEBIRD LANTE', 1000, 17732, 0),
(174, 'CLASSIC METAL BIRDCA', 1301, 6620, 0),
(175, 'CREAM HEART CARD HOL', 1445, 14417, 0),
(176, 'ENAMEL FLOWER JUG CR', 425, 7919, 0),
(177, 'ENAMEL FIRE BUCKET C', 1463, 4193, 0),
(178, 'ENAMEL BREAD BIN CRE', 1739, 18392, 0),
(179, 'SET 3 WICKER OVAL BA', 1137, 12057, 0),
(180, 'JAM MAKING SET PRINT', 114, 9021, 0),
(181, 'JAM MAKING SET WITH ', 860, 14724, 0),
(182, 'JUMBO BAG DOLLY GIRL', 1420, 11187, 0),
(183, 'TRADITIONAL CHRISTMA', 1326, 7962, 0),
(184, 'ORGANISER WOOD ANTIQ', 1663, 15179, 0),
(185, 'LUNCH BAG DOLLY GIRL', 423, 17560, 0),
(186, 'WHITE WIRE EGG HOLDE', 459, 11540, 0),
(187, 'JUMBO  BAG BAROQUE B', 567, 17857, 0),
(188, 'JUMBO BAG RED RETROS', 383, 7684, 0),
(189, 'CHILLI LIGHTS', 955, 10727, 0),
(190, 'LIGHT GARLAND BUTTER', 690, 4756, 0),
(191, 'WOODEN OWLS LIGHT GA', 1918, 9333, 0),
(192, 'FAIRY TALE COTTAGE N', 391, 19012, 0),
(193, 'RED TOADSTOOL LED NI', 1545, 9961, 0),
(194, 'HOME BUILDING BLOCK ', 823, 5098, 0),
(195, 'LOVE BUILDING BLOCK ', 280, 4097, 0),
(196, 'DOORMAT FANCY FONT H', 652, 16360, 0),
(197, 'HOME SMALL WOOD LETT', 876, 1158, 0),
(198, 'GINGHAM HEART  DOORS', 1541, 3725, 0),
(199, 'FIVE HEART HANGING D', 555, 6007, 0),
(200, 'HANGING METAL HEART ', 929, 8216, 0),
(201, 'ASSORTED BOTTLE TOP ', 1703, 5931, 0),
(202, 'FRIDGE MAGNETS US DI', 1408, 2251, 0),
(203, 'HOMEMADE JAM SCENTED', 274, 13284, 0),
(204, 'FRIDGE MAGNETS LES E', 932, 16975, 0),
(205, 'ROSE CARAVAN DOORSTO', 1543, 12490, 0),
(206, 'HEART OF WICKER SMAL', 1359, 13360, 0),
(207, '5 HOOK HANGER MAGIC ', 561, 7527, 0),
(208, 'CHRISTMAS LIGHTS 10 ', 175, 6233, 0),
(209, 'VINTAGE UNION JACK C', 1193, 15683, 0),
(210, 'VINTAGE HEADS AND TA', 1660, 2977, 0),
(211, 'SET OF 3 COLOURED  F', 1116, 19142, 0),
(212, 'SET OF 3 GOLD FLYING', 604, 6448, 0),
(213, 'RED RETROSPOT UMBREL', 860, 2325, 0),
(214, 'BLACK/BLUE POLKADOT ', 1708, 898, 0),
(215, 'RED DINER WALL CLOCK', 294, 4821, 0),
(216, 'ALARM CLOCK BAKELIKE', 121, 15914, 0),
(217, 'ALARM CLOCK BAKELIKE', 1217, 10518, 0),
(218, 'BLUE DINER WALL CLOC', 429, 11486, 0),
(219, 'IVORY DINER WALL CLO', 1084, 18737, 0),
(220, 'LARGE HEART MEASURIN', 1234, 4489, 0),
(221, 'SMALL HEART MEASURIN', 1336, 59, 0),
(222, 'CHRISTMAS LIGHTS 10 ', 1523, 2205, 0),
(223, 'JAM MAKING SET WITH ', 823, 9493, 0),
(224, 'JAM MAKING SET PRINT', 419, 16035, 0),
(225, 'JAM JAR WITH PINK LI', 1634, 18625, 0),
(226, 'JAM JAR WITH GREEN L', 1693, 13619, 0),
(227, 'ROSE COTTAGE KEEPSAK', 417, 10125, 0),
(228, 'HANGING HEART ZINC T', 1920, 1042, 0),
(229, 'PAPER CHAIN KIT VINT', 1968, 12061, 0),
(230, 'DISCO BALL CHRISTMAS', 485, 19712, 0),
(231, 'WHITE HANGING HEART ', 220, 13992, 0),
(232, 'SMALL POPCORN HOLDER', 655, 4132, 0),
(233, 'LARGE POPCORN HOLDER', 1516, 14764, 0),
(234, 'RETROSPOT LARGE MILK', 1741, 272, 0),
(235, 'SET/20 RED RETROSPOT', 1726, 6304, 0),
(236, 'SET/6 RED SPOTTY PAP', 1576, 8391, 0),
(237, 'SET/6 RED SPOTTY PAP', 1238, 1365, 0),
(238, 'POLKADOT RAIN HAT ', 431, 19754, 0),
(239, 'DELUXE SEWING KIT ', 522, 9306, 0),
(240, 'RETROSPOT HEART HOT ', 423, 10985, 0),
(241, 'KNITTED UNION FLAG H', 1690, 17701, 0),
(242, 'ENGLISH ROSE HOT WAT', 1738, 11914, 0),
(243, 'PHOTO CUBE', 1142, 5626, 0),
(244, 'HOMEMADE JAM SCENTED', 370, 6157, 0),
(245, 'JUMBO BAG RED RETROS', 1752, 2603, 0),
(246, 'PLASTERS IN TIN CIRC', 594, 10452, 0),
(247, 'PACK OF 12 PINK PAIS', 146, 2748, 0),
(248, 'PACK OF 12 BLUE PAIS', 207, 10271, 0),
(249, 'PACK OF 12 RED RETRO', 628, 11921, 0),
(250, 'CHICK GREY HOT WATER', 1484, 6444, 0),
(251, 'PLASTERS IN TIN VINT', 1633, 18980, 0),
(252, 'PLASTERS IN TIN SKUL', 152, 15567, 0),
(253, '3 STRIPEY MICE FELTC', 1979, 227, 0),
(254, 'SET OF 6 SOLDIER SKI', 830, 16488, 0),
(255, 'TRADITIONAL WOODEN S', 1400, 1048, 0),
(256, 'WOODEN BOX OF DOMINO', 1216, 4366, 0),
(257, 'RUSTIC  SEVENTEEN DR', 433, 15553, 0),
(258, 'PARTY CONES CARNIVAL', 608, 9725, 0),
(259, 'PARTY CONES CANDY AS', 1109, 4866, 0),
(260, 'PICNIC BASKET WICKER', 1738, 13328, 0),
(261, 'ASSORTED COLOUR BIRD', 1731, 6360, 0),
(262, 'STAR DECORATION PAIN', 810, 11679, 0),
(263, 'RETROSPOT LAMP', 369, 19810, 0),
(264, 'FANCY FONT BIRTHDAY ', 494, 10182, 0),
(265, 'HAND WARMER UNION JA', 1892, 7246, 0),
(266, 'HAND WARMER SCOTTY D', 471, 6129, 0),
(267, 'HAND WARMER OWL DESI', 1241, 845, 0),
(268, 'HAND WARMER RED RETR', 1790, 8700, 0),
(269, 'RETROSPOT HEART HOT ', 1939, 16155, 0),
(270, 'DOG BOWL CHASING BAL', 489, 6840, 0),
(271, 'CLOTHES PEGS RETROSP', 1716, 6121, 0),
(272, 'HAND OVER THE CHOCOL', 890, 13301, 0),
(273, 'WHITE HANGING HEART ', 1275, 7622, 0),
(274, 'TRAVEL SEWING KIT', 130, 16359, 0),
(275, 'BLACK HEART CARD HOL', 775, 1247, 0),
(276, 'ASSORTED COLOUR BIRD', 1881, 7029, 0),
(277, 'PACK OF 60 PINK PAIS', 1643, 10322, 0),
(278, '60 TEATIME FAIRY CAK', 1063, 16244, 0),
(279, 'PACK OF 72 RETROSPOT', 686, 14595, 0),
(280, 'CHICK GREY HOT WATER', 761, 18742, 0),
(281, 'SMALL GLASS HEART TR', 888, 7859, 0),
(282, 'ALARM CLOCK BAKELIKE', 1020, 13649, 0),
(283, 'ALARM CLOCK BAKELIKE', 328, 2429, 0),
(284, 'ALARM CLOCK BAKELIKE', 535, 17445, 0),
(285, 'ALARM CLOCK BAKELIKE', 1183, 1805, 0),
(286, 'HOT WATER BOTTLE TEA', 1819, 13210, 0),
(287, 'HAND WARMER BIRD DES', 166, 391, 0),
(288, 'HAND WARMER SCOTTY D', 1854, 13540, 0),
(289, 'WHITE HANGING HEART ', 778, 4989, 0),
(290, 'WHITE METAL LANTERN', 1292, 8015, 0),
(291, 'CREAM CUPID HEARTS C', 1598, 4548, 0),
(292, 'EDWARDIAN PARASOL BL', 838, 18192, 0),
(293, 'EDWARDIAN PARASOL RE', 653, 15748, 0),
(294, 'RETRO COFFEE MUGS AS', 1109, 11893, 0),
(295, 'SAVE THE PLANET MUG', 566, 18449, 0),
(296, 'VINTAGE BILLBOARD DR', 709, 12458, 0),
(297, 'VINTAGE BILLBOARD LO', 1797, 18037, 0),
(298, 'WOOD 2 DRAWER CABINE', 338, 19731, 0),
(299, 'WOOD S/3 CABINET ANT', 864, 4863, 0),
(300, 'WOODEN PICTURE FRAME', 1983, 17877, 0),
(301, 'WOODEN FRAME ANTIQUE', 235, 4617, 0),
(302, 'KNITTED UNION FLAG H', 1514, 1233, 0),
(303, 'RED WOOLLY HOTTIE WH', 415, 18490, 0),
(304, 'SET 7 BABUSHKA NESTI', 923, 11534, 0),
(305, 'IVORY EMBROIDERED QU', 623, 13095, 0),
(306, 'GLASS STAR FROSTED T', 251, 18495, 0),
(307, 'SET OF 3 BLACK FLYIN', 219, 12265, 0),
(308, 'SET OF 3 COLOURED  F', 1423, 16220, 0),
(309, 'PACK OF 12 RED RETRO', 1705, 1915, 0),
(310, 'RED RETROSPOT MUG', 319, 85, 0);

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
(12, 11, 2),
(12, 15, 6),
(12, 17, 10),
(12, 19, 8),
(12, 23, 4),
(13, 12, 5),
(13, 28, 4),
(13, 29, 6),
(14, 13, 1),
(15, 14, 3),
(17, 16, 6),
(19, 18, 10),
(21, 20, 4),
(22, 21, 6),
(22, 32, 2),
(22, 34, 7),
(23, 22, 2),
(25, 24, 4),
(26, 25, 2),
(27, 26, 4),
(28, 27, 6),
(31, 30, 8),
(32, 31, 7),
(34, 33, 6),
(36, 35, 4),
(37, 36, 4),
(38, 37, 2),
(39, 38, 1),
(40, 39, 10),
(41, 40, 4),
(42, 41, 8),
(43, 42, 1),
(44, 43, 1),
(45, 44, 6),
(46, 45, 3),
(47, 46, 3),
(48, 47, 8),
(49, 48, 4),
(50, 49, 6),
(51, 50, 8),
(52, 38, 7),
(53, 27, 4),
(54, 25, 8),
(55, 38, 2),
(56, 11, 9),
(57, 28, 6),
(58, 13, 4),
(59, 13, 9),
(60, 11, 5),
(61, 14, 2),
(62, 41, 4),
(63, 28, 5),
(64, 32, 10),
(65, 47, 9),
(66, 44, 7),
(67, 30, 1),
(68, 23, 10),
(69, 19, 1),
(70, 39, 4),
(71, 20, 1),
(72, 49, 5),
(73, 42, 9),
(74, 22, 4),
(75, 21, 8),
(76, 38, 6),
(77, 30, 2),
(78, 21, 3),
(79, 27, 2),
(80, 19, 5),
(81, 24, 3),
(82, 46, 10),
(83, 41, 7),
(84, 12, 2),
(85, 50, 1),
(86, 21, 2),
(87, 23, 8),
(88, 24, 6),
(89, 17, 8),
(90, 33, 8),
(91, 46, 8),
(92, 36, 1),
(93, 44, 6),
(94, 46, 3),
(95, 38, 5),
(96, 43, 7),
(97, 48, 8),
(98, 45, 8),
(99, 25, 8),
(100, 11, 6),
(101, 47, 3),
(102, 47, 1),
(103, 22, 1),
(104, 28, 3),
(105, 47, 1),
(106, 43, 6),
(107, 22, 5),
(108, 34, 5),
(109, 39, 6),
(110, 47, 4),
(111, 17, 7),
(112, 44, 7),
(113, 43, 1),
(114, 26, 6),
(115, 43, 10),
(116, 31, 6),
(117, 25, 4),
(118, 19, 1),
(119, 17, 8),
(120, 36, 2),
(121, 19, 7),
(122, 15, 4),
(123, 44, 9),
(124, 50, 4),
(125, 36, 4),
(126, 26, 6),
(127, 45, 2),
(128, 42, 6),
(129, 27, 3),
(130, 13, 6),
(131, 47, 9),
(132, 38, 10),
(133, 20, 2),
(134, 41, 3),
(135, 36, 1),
(136, 13, 6),
(137, 17, 7),
(138, 11, 1),
(139, 50, 1),
(140, 45, 9),
(141, 46, 9),
(142, 19, 8),
(143, 34, 1),
(144, 24, 6),
(145, 22, 1),
(146, 27, 5),
(147, 32, 4),
(148, 25, 5),
(149, 19, 6),
(150, 42, 8),
(151, 13, 3),
(152, 34, 10),
(153, 19, 2),
(154, 25, 3),
(155, 31, 4),
(156, 43, 4),
(157, 27, 2),
(158, 36, 2),
(159, 30, 5),
(160, 44, 7),
(161, 17, 5),
(162, 26, 8),
(163, 21, 1),
(164, 44, 10),
(165, 15, 1),
(166, 30, 10),
(167, 44, 9),
(168, 36, 1),
(169, 45, 5),
(170, 39, 10),
(171, 33, 3),
(172, 21, 7),
(173, 24, 10),
(174, 33, 6),
(175, 13, 3),
(176, 37, 9),
(177, 48, 9),
(178, 11, 5),
(179, 34, 5),
(180, 49, 6),
(181, 36, 4),
(182, 12, 4),
(183, 39, 4),
(184, 46, 10),
(185, 20, 7),
(186, 24, 3),
(187, 31, 2),
(188, 45, 7),
(189, 49, 3),
(190, 41, 6),
(191, 40, 10),
(192, 38, 4),
(193, 43, 9),
(194, 33, 8),
(195, 12, 10),
(196, 13, 6),
(197, 28, 7),
(198, 42, 4),
(199, 33, 2),
(200, 47, 3),
(201, 25, 3),
(202, 18, 10),
(203, 37, 9),
(204, 44, 7),
(205, 47, 10),
(206, 22, 7),
(207, 35, 7),
(208, 26, 9),
(209, 13, 1),
(210, 27, 6),
(211, 43, 10),
(212, 40, 9),
(213, 32, 5),
(214, 24, 5),
(215, 36, 6),
(216, 48, 5),
(217, 27, 9),
(218, 22, 5),
(219, 24, 2);

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
(11, 'CR0001', 27, '2022-04-08', 'new', 'B169,Talpotha,Polonnaruwa', 1890),
(12, 'CR0001', 27, '2022-06-12', 'new', 'B169,Talpotha,Polonnaruwa', 2650),
(13, 'CR0001', 27, '2022-02-08', 'new', 'B169,Talpotha,Polonnaruwa', 4030),
(14, 'CR0001', 23, '2022-05-28', 'dtrain', 'B5,PuttalamCementFactory,Anuradhapura', 3080),
(15, 'CR0002', 13, '2022-04-08', 'new', 'B63,PuttalamCementFactory,Puttalam', 1150),
(16, 'CR0002', 13, '2022-03-17', 'new', 'B63,PuttalamCementFactory,Puttalam', 3490),
(17, 'CR0002', 13, '2022-01-18', 'new', 'B63,PuttalamCementFactory,Puttalam', 1100),
(18, 'CR0002', 13, '2022-02-11', 'new', 'B63,PuttalamCementFactory,Puttalam', 3680),
(19, 'CR0003', 11, '2022-01-13', 'new', 'B158,Talawattegedara,Kurunegala', 1920),
(20, 'CR0003', 11, '2022-03-09', 'new', 'B158,Talawattegedara,Kurunegala', 1690),
(21, 'CR0003', 13, '2022-04-28', 'new', 'B35,Kaluwankemy,Ja Ela', 1710),
(22, 'CR0003', 13, '2022-04-03', 'new', 'B35,Kaluwankemy,Ja Ela', 2050),
(23, 'CR0004', 28, '2022-03-20', 'new', 'B95,Sigiriya,Matale', 4530),
(24, 'CR0004', 28, '2022-01-20', 'new', 'B95,Sigiriya,Matale', 1720),
(25, 'CR0004', 28, '2022-05-15', 'new', 'B95,Sigiriya,Matale', 4290),
(26, 'CR0004', 28, '2022-01-17', 'new', 'B95,Sigiriya,Matale', 4820),
(27, 'CR0005', 25, '2022-06-20', 'new', 'B29,Cheddipalayam,Batticaloa', 1270),
(28, 'CR0005', 25, '2022-03-20', 'new', 'B29,Cheddipalayam,Batticaloa', 1860),
(29, 'CR0005', 25, '2022-01-08', 'new', 'B29,Cheddipalayam,Batticaloa', 4240),
(30, 'CR0005', 25, '2022-05-13', 'new', 'B29,Cheddipalayam,Batticaloa', 1610),
(31, 'CR0006', 10, '2022-06-25', 'delivered', 'B96,Ulpothagama,Kandy', 1300),
(32, 'CR0006', 10, '2022-06-06', 'delivered', 'B96,Ulpothagama,Kandy', 3840),
(33, 'CR0006', 28, '2022-05-12', 'new', 'B32,Senarathwela,Matale ', 4560),
(34, 'CR0006', 28, '2022-06-17', 'new', 'B11,Iriyagolla,Matale ', 4250),
(35, 'CR0007', 10, '2022-03-16', 'new', 'B92,Bopattalawa,Nuwara Eliya', 3440),
(36, 'CR0007', 10, '2022-06-11', 'new', 'B92,Bopattalawa,Nuwara Eliya', 730),
(37, 'CR0007', 10, '2022-05-04', 'new', 'B92,Bopattalawa,Nuwara Eliya', 2490),
(38, 'CR0007', 10, '2022-01-24', 'delivered', 'B92,Bopattalawa,Nuwara Eliya', 3470),
(39, 'CR0008', 23, '2022-02-03', 'new', 'B14,Kahatagollewa,Anuradhapura', 3790),
(40, 'CR0008', 15, '2022-05-09', 'new', 'B15,Angunawila,Ratnapura', 4310),
(41, 'CR0008', 14, '2022-06-14', 'dtrain', 'B1,Mahamukalanyaya,Ambalangoda', 2290),
(42, 'CR0008', 16, '2022-02-07', 'dtrain', 'A12,Galle rd,Udugama', 940),
(43, 'CR0009', 7, '2022-02-08', 'new', 'B11,Walawela,Kolonnaw', 3980),
(44, 'CR0009', 18, '2022-02-04', 'new', 'B123,akuressa rd,Deniyaya', 820),
(45, 'CR0009', 21, '2022-06-28', 'new', 'B22,Maharachchimulla,Monaragala', 1710),
(46, 'CR0009', 20, '2022-06-15', 'dtrain', 'G23,Walasmulla,Hambantota', 2070),
(47, 'CR0010', 8, '2022-05-09', 'new', 'B35,Hindagolla,Moratuwa', 880),
(48, 'CR0010', 8, '2022-03-09', 'new', 'B35,Hindagolla,Moratuwa', 3910),
(49, 'CR0010', 8, '2022-06-14', 'new', 'B35,Hindagolla,Moratuwa', 2460),
(50, 'CR0010', 8, '2022-04-21', 'new', 'B35,Hindagolla,Moratuwa', 930);

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
(7, 8, 16, 6, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d253465.37448358783!2d79.89254954412888!3d6.96246874372975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo!3m2!1d6.9270786!2d79.861243!4m5!1s0x3ae3a99e4c1f47cd%3A0xee25998579adfb13!2sAvissawella!3m2!1d6.954328899999999!2d80.2045768!5e0!3m2!1sen!2slk!4v1657871589173!5m2!1sen!2slk'),
(8, 8, 20, 8, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d253551.08315727298!2d79.78609416329624!3d6.801976809403546!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo!3m2!1d6.9270786!2d79.861243!4m5!1s0x3ae2371ee59557e5%3A0x8b86ba840e8a7b51!2sKalutara!3m2!1d6.5853947999999995!2d79.96074!5e0!3m2!1sen!2slk!4v1657871769136!5m2!1sen!2slk'),
(9, 8, 21, 5, 'https://www.google.com/maps/embed?pb=!1m34!1m12!1m3!1d507091.2819784227!2d80.18082627826807!3d6.812279303224338!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m19!3e0!4m5!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo!3m2!1d6.9270786!2d79.861243!4m5!1s0x3ae3eb41448a86e9%3A0xa71d1480fbcb71bd!2sPelmadulla!3m2!1d6.6344847!2d80.5299541!4m5!1s0x3ae462167fa6dad9%3A0x84d3d072c32aa246!2sBadulla!3m2!1d6.993400899999999!2d81.0549815!5e0!3m2!1sen!2slk!4v1657872009103!5m2!1sen!2slk'),
(10, 8, 22, 10, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d506898.7927158309!2d80.04470159873158!3d6.991982816385436!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo!3m2!1d6.9270786!2d79.861243!4m5!1s0x3ae380434e1554c7%3A0x291608404c937d9c!2sNuwara%20Eliya!3m2!1d6.9497165999999995!2d80.7891068!5e0!3m2!1sen!2slk!4v1657872071904!5m2!1sen!2slk'),
(11, 9, 14, 7, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d253255.30423604397!2d79.97719387804929!3d7.341078746900358!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3ae2ee9c6bb2f73b%3A0xa51626e908186f3e!2sNegombo!3m2!1d7.2007968!2d79.8736754!4m5!1s0x3ae3398ab06be8b9%3A0x1f90e4e71e885052!2sKurunegala!3m2!1d7.4817694999999995!2d80.3608876!5e0!3m2!1sen!2slk!4v1657872195015!5m2!1sen!2slk'),
(12, 9, 15, 9, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d253319.4260548418!2d79.9699570748511!3d7.227604225168463!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3ae2ee9c6bb2f73b%3A0xa51626e908186f3e!2sNegombo!3m2!1d7.2007968!2d79.8736754!4m5!1s0x3ae316b5affca98d%3A0xec4aece6bdbb55b1!2sKegalle!3m2!1d7.2513317!2d80.3463754!5e0!3m2!1sen!2slk!4v1657872241983!5m2!1sen!2slk'),
(13, 9, 25, 10, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d253231.3058728174!2d79.73359962924621!3d7.38310187541864!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3ae2ee9c6bb2f73b%3A0xa51626e908186f3e!2sNegombo!3m2!1d7.2007968!2d79.8736754!4m5!1s0x3ae2c960aa4ecb03%3A0xbc913f96fdb4b8c6!2sChilaw!3m2!1d7.5619894!2d79.8016569!5e0!3m2!1sen!2slk!4v1657872290014!5m2!1sen!2slk'),
(14, 10, 19, 4, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d126942.18270948199!2d80.06547163287296!3d6.1383321985522405!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3ae173bb6932fce3%3A0x4a35b903f9c64c03!2sGalle!3m2!1d6.032894799999999!2d80.2167912!4m5!1s0x3ae1822ba5da53a1%3A0xe1ca72d5d96668ec!2sAmbalangoda!3m2!1d6.2441521!2d80.0590804!5e0!3m2!1sen!2slk!4v1657872333118!5m2!1sen!2slk'),
(15, 10, 32, 10, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d1014843.7485253257!2d79.62253308883366!3d6.492104746281816!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3ae173bb6932fce3%3A0x4a35b903f9c64c03!2sGalle!3m2!1d6.032894799999999!2d80.2167912!4m5!1s0x3ae3beb435df712f%3A0xc14a5df053ff0561!2sRatnapura!3m2!1d6.7055742!2d80.3847345!5e0!3m2!1sen!2slk!4v1657872398382!5m2!1sen!2slk'),
(16, 10, 34, 9, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d126945.62741422486!2d80.20507028278988!3d6.123858309120159!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3ae173bb6932fce3%3A0x4a35b903f9c64c03!2sGalle!3m2!1d6.032894799999999!2d80.2167912!4m5!1s0x3ae16476571d36e3%3A0xf9a8db9e41ece0d2!2sUdugama!3m2!1d6.2179047!2d80.3380213!5e0!3m2!1sen!2slk!4v1657872436407!5m2!1sen!2slk'),
(17, 10, 18, 8, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d126956.24327348618!2d80.27662543253376!3d6.079036891853253!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3ae173bb6932fce3%3A0x4a35b903f9c64c03!2sGalle!3m2!1d6.032894799999999!2d80.2167912!4m5!1s0x3ae142655768328f%3A0xe7f8f94593ce92c3!2sAkuressa!3m2!1d6.1001388!2d80.4759567!5e0!3m2!1sen!2slk!4v1657872545279!5m2!1sen!2slk'),
(18, 11, 35, 7, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d253880.69018549472!2d80.39776624685467!3d6.146039570101042!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3ae138d151937cd9%3A0x1d711f45897009a3!2sMatara!3m2!1d5.9496309!2d80.54685289999999!4m5!1s0x3ae3e217f98c14e1%3A0xa539e0eb604e1f7d!2sDeniyaya!3m2!1d6.3424847!2d80.5596582!5e0!3m2!1sen!2slk!4v1657872607574!5m2!1sen!2slk'),
(19, 11, 17, 5, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d63489.69530913012!2d80.45239988718579!3d5.98014574107588!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3ae138d151937cd9%3A0x1d711f45897009a3!2sMatara!3m2!1d5.9496309!2d80.54685289999999!4m5!1s0x3ae115377cc3eaf9%3A0x2463154f2d989243!2sWeligama!3m2!1d5.9773781999999995!2d80.4288487!5e0!3m2!1sen!2slk!4v1657872661078!5m2!1sen!2slk'),
(20, 11, 26, 4, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d253895.1954011626!2d80.67966724613107!3d6.11556425911351!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3ae138d151937cd9%3A0x1d711f45897009a3!2sMatara!3m2!1d5.9496309!2d80.54685289999999!4m5!1s0x3ae6bcffa57235f7%3A0x36c4af58943f2152!2sHambantota!3m2!1d6.1428829!2d81.12123079999999!5e0!3m2!1sen!2slk!4v1657872707334!5m2!1sen!2slk'),
(21, 11, 33, 5, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d1014988.6107996993!2d80.37391890422468!3d6.4198335170702645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3ae138d151937cd9%3A0x1d711f45897009a3!2sMatara!3m2!1d5.9496309!2d80.54685289999999!4m5!1s0x3ae45a9ddf60af13%3A0xaaeaff47009fda28!2sMonaragala!3m2!1d6.8906453999999995!2d81.3454417!5e0!3m2!1sen!2slk!4v1657872758462!5m2!1sen!2slk'),
(22, 12, 23, 5, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d504014.26005678583!2d79.77818805527144!3d9.278970270812776!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3afe53fd7be66aa5%3A0xc7da0d9203baf512!2sJaffna!3m2!1d9.6614981!2d80.02554649999999!4m5!1s0x3afe7601bad9466d%3A0xc5dfe091c45e7d15!2sMannar!3m2!1d8.9809743!2d79.90441489999999!5e0!3m2!1sen!2slk!4v1657872822238!5m2!1sen!2slk'),
(23, 12, 29, 9, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d1008852.5344596483!2d79.70250361923738!3d8.987766296403903!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3afe53fd7be66aa5%3A0xc7da0d9203baf512!2sJaffna!3m2!1d9.6614981!2d80.02554649999999!4m5!1s0x3afcf4f99360e159%3A0xc111fe9ebc6dcf0e!2sAnuradhapura!3m2!1d8.311351799999999!2d80.4036508!5e0!3m2!1sen!2slk!4v1657872877006!5m2!1sen!2slk'),
(24, 12, 30, 10, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d251823.51754043883!2d80.07649384944875!3d9.531089884292415!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3afe53fd7be66aa5%3A0xc7da0d9203baf512!2sJaffna!3m2!1d9.6614981!2d80.02554649999999!4m5!1s0x3afeeb2a49213dc5%3A0xfaa79ddb6a8aa288!2sKilinochchi!3m2!1d9.3802886!2d80.3769999!5e0!3m2!1sen!2slk!4v1657872917342!5m2!1sen!2slk'),
(25, 13, 24, 9, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d505527.4632510504!2d81.15072774448988!3d8.1590237468561!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3afbbcb6902dbe27%3A0x7de76a7a331b0fbb!2sTrincomalee!3m2!1d8.5873638!2d81.2152121!4m5!1s0x3afacd5a8d4e794b%3A0x445b48547815a564!2sBatticaloa!3m2!1d7.7309971!2d81.6747295!5e0!3m2!1sen!2slk!4v1657872970334!5m2!1sen!2slk'),
(26, 13, 27, 7, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d1011599.5487306655!2d80.76823881361832!3d7.940858867665061!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3afbbcb6902dbe27%3A0x7de76a7a331b0fbb!2sTrincomalee!3m2!1d8.5873638!2d81.2152121!4m5!1s0x3ae519dcbaf5b2f9%3A0x10f4a528a80c3e12!2sAmpara!3m2!1d7.3017563!2d81.6747295!5e0!3m2!1sen!2slk!4v1657873007519!5m2!1sen!2slk'),
(27, 13, 28, 10, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d505393.9402818292!2d80.74607785867939!3d8.263906793830973!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3afbbcb6902dbe27%3A0x7de76a7a331b0fbb!2sTrincomalee!3m2!1d8.5873638!2d81.2152121!4m5!1s0x3afb44ba3b16ce27%3A0xc34997a2b3032b7c!2sPolonnaruwa!3m2!1d7.9403384!2d81.0187984!5e0!3m2!1sen!2slk!4v1657873038726!5m2!1sen!2slk'),
(28, 13, 31, 8, 'https://www.google.com/maps/embed?pb=!1m28!1m12!1m3!1d1011319.9144813454!2d80.29722653037543!3d8.05360818143721!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m13!3e0!4m5!1s0x3afbbcb6902dbe27%3A0x7de76a7a331b0fbb!2sTrincomalee!3m2!1d8.5873638!2d81.2152121!4m5!1s0x3ae344d7d465445d%3A0xd6f70562e8850dbc!2sMatale!3m2!1d7.467465!2d80.6234161!5e0!3m2!1sen!2slk!4v1657873067988!5m2!1sen!2slk');

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
('SK0001', '8'),
('SK0002', '9'),
('SK0003', '10'),
('SK0004', '11'),
('SK0005', '12'),
('SK0006', '13');

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
(1123247, 'Udarata Menike', '2022-07-15', '07:00:00', 'Colombo', 1000000, 0, 0),
(1123248, 'Yal Devi', '2022-07-15', '08:00:00', 'Jaffna', 5000000, 3080, 0),
(1123249, 'Ruhunu Kumari', '2022-07-15', '09:00:00', 'Matara', 2500000, 5300, 0);

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
('2022-07-15', '16:07:49', 1123247, 31),
('2022-07-15', '16:07:18', 1123247, 32),
('2022-07-15', '16:06:54', 1123247, 38),
('2022-07-15', '16:08:50', 1123248, 14),
('2022-07-15', '16:08:31', 1123249, 41),
('2022-07-15', '16:08:25', 1123249, 42),
('2022-07-15', '16:08:17', 1123249, 46);

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
(1, 'IUZ-3137', 8),
(2, 'GIB-6870', 8),
(3, 'MSE-9442', 8),
(4, 'QPQ-8101', 8),
(5, 'XTD-1299', 8),
(6, 'IUJ-8823', 9),
(7, 'KIJ-9547', 9),
(8, 'FDO-2387', 9),
(9, 'RIP-4399', 9),
(10, 'PKL-2228', 9),
(11, 'YVD-2503', 10),
(12, 'WQH-6667', 10),
(13, 'MXJ-2605', 10),
(14, 'CVC-9518', 10),
(15, 'JHN-3817', 10),
(16, 'GZI-2474', 11),
(17, 'RNT-7775', 11),
(18, 'MBO-9719', 11),
(19, 'YYJ-3746', 11),
(20, 'LFJ-3520', 11),
(21, 'WRW-9489', 12),
(22, 'SCR-2626', 12),
(23, 'GPG-8756', 12),
(24, 'HVH-6519', 12),
(25, 'MMK-5345', 12),
(26, 'BFK-8393', 13),
(27, 'EMA-5233', 13),
(28, 'RDD-3541', 13),
(29, 'TYN-5910', 13),
(30, 'XYJ-8480', 13);

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
(9, 'DR0001', 'DA0005', 10, 3, '2022-07-15', '16:14:32', '2022-07-15 16:19:03', '2022-07-15 16:19:47');

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
(31, 9, '2022-07-15 10:49:26'),
(32, 9, '2022-07-15 10:49:33'),
(38, 9, '2022-07-15 10:49:35');

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
('CR0001', 'Logan', 'Melody', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('CR0002', 'Steve', 'Rose', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('CR0003', 'Ramon', 'Barry', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('CR0004', 'Bryce', 'Marco', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('CR0005', 'Tommy', 'Karl', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('CR0006', 'Preston', 'Daisy', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('CR0007', 'Keri', 'Leonard', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('CR0008', 'Devon', 'Randi', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('CR0009', 'Alana', 'Maggie', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('CR0010', 'Marisa', 'Charlotte', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0001', 'Christopher', 'Erin', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0002', 'Matthew', 'Jamie', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0003', 'Jennifer', 'Samantha', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0004', 'Amanda', 'Sara', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0005', 'David', 'Paul', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0006', 'Robert', 'Tyler', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0007', 'Joseph', 'Katherine', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0008', 'Ryan', 'Gregory', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0009', 'Jason', 'Mary', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0010', 'Sarah', 'Lisa', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0011', 'Frederick', 'Adriana', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0012', 'Autumn', 'Mindy', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0013', 'Martha', 'Noah', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0014', 'Lydia', 'Suzanne', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0015', 'Theodore', 'Dale', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0016', 'Neil', 'Christie', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0017', 'Sierra', 'Naomi', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0018', 'Tammy', 'Ernest', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0019', 'Terrance', 'Grace', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0020', 'Claire', 'Shanna', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0021', 'Trisha', 'Eduardo', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0022', 'Diane', 'Hillary', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0023', 'Carmen', 'Alberto', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0024', 'Jermaine', 'Olivia', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0025', 'Micah', 'Paula', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0026', 'Levi', 'Sheila', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0027', 'Brad', 'Robyn', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0028', 'Toni', 'Dane', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0029', 'Evelyn', 'Nicolas', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DA0030', 'Ronnie', 'Eugene', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0001', 'Michael', 'Sean', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0002', 'Jessica', 'Zachary', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0003', 'Ashley', 'Kelly', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0004', 'Joshua', 'Nathan', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0005', 'Daniel', 'Dustin', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0006', 'James', 'Angela', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0007', 'John', 'Scott', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0008', 'Andrew', 'Andrea', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0009', 'Brandon', 'Erica', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0010', 'Justin', 'Travis', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0011', 'Kaitlin', 'Joy', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0012', 'Cheryl', 'Ruth', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0013', 'Tyrone', 'Spencer', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0014', 'Omar', 'Raul', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0015', 'Jerome', 'Sophia', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0016', 'Abby', 'Jodi', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0017', 'Shawna', 'Raquel', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0018', 'Nina', 'Kellie', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0019', 'Nikki', 'Jake', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0020', 'Donna', 'Tristan', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0021', 'Cole', 'Hilary', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0022', 'Bonnie', 'Ivan', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0023', 'Summer', 'Yolanda', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0024', 'Mayra', 'Andres', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0025', 'Eddie', 'Armando', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0026', 'Marvin', 'Amelia', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0027', 'Emmanuel', 'Rosa', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0028', 'Taryn', 'Kurt', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0029', 'Jessie', 'Glenn', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('DR0030', 'Darryl', 'Gloria', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('MN0001', 'William', 'Kenneth', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('SK0001', 'Stephanie', 'Lindsey', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('SK0002', 'Brian', 'Kristen', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('SK0003', 'Nicole', 'Jose', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('SK0004', 'Nicholas', 'Alexander', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('SK0005', 'Anthony', 'Jesse', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('SK0006', 'Heather', 'Katie', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK'),
('SM0001', 'Jonathan', 'Bryan', '$2y$10$fQysbZapKMErQlP5sgAfxexvuj3ilG9CPVEqxWdnWXI8AccGcu7bK');

-- --------------------------------------------------------

--
-- Structure for view `available_assistants`
--
DROP TABLE IF EXISTS `available_assistants`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `available_assistants`  AS SELECT `driver_assistant`.`user_id` AS `user_id`, `user`.`first_name` AS `first_name`, `user`.`last_name` AS `last_name`, `employee`.`mobile_no` AS `mobile_no`, `employee`.`weekly_worked_hours` AS `weekly_worked_hours`, `employee`.`city` AS `city` FROM ((`driver_assistant` join `employee` on(`driver_assistant`.`user_id` = `employee`.`user_id`)) join `user` on(`driver_assistant`.`user_id` = `user`.`user_id`)) WHERE !(`driver_assistant`.`user_id` in (select `leaved_employees_today`.`user_id` from `leaved_employees_today`)) AND (`driver_assistant`.`cons_turn_count` < 2 OR `driver_assistant`.`cons_turn_count` = 2 AND hour(timediff(cast(current_timestamp() as time),`employee`.`last_arrival_time`)) > 0 AND !(`driver_assistant`.`user_id` in (select `turn`.`assistant_id` from `turn` where `turn`.`turn_end_time` is null))) ;

-- --------------------------------------------------------

--
-- Structure for view `available_drivers`
--
DROP TABLE IF EXISTS `available_drivers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `available_drivers`  AS SELECT `driver`.`user_id` AS `user_id`, `user`.`first_name` AS `first_name`, `user`.`last_name` AS `last_name`, `employee`.`mobile_no` AS `mobile_no`, `employee`.`weekly_worked_hours` AS `weekly_worked_hours`, `employee`.`city` AS `city` FROM ((`driver` join `employee` on(`driver`.`user_id` = `employee`.`user_id`)) join `user` on(`driver`.`user_id` = `user`.`user_id`)) WHERE !(`driver`.`user_id` in (select `leaved_employees_today`.`user_id` from `leaved_employees_today`)) AND !(`driver`.`user_id` in (select `turn`.`driver_id` from `turn` where `turn`.`turn_end_time` is null)) AND hour(timediff(cast(current_timestamp() as time),`employee`.`last_arrival_time`)) > 0 ;

-- --------------------------------------------------------

--
-- Structure for view `driver_assistant_order`
--
DROP TABLE IF EXISTS `driver_assistant_order`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `driver_assistant_order`  AS SELECT `o`.`order_id` AS `order_id`, `t`.`assistant_id` AS `assistant_id`, `t`.`driver_id` AS `driver_id`, (select `r`.`route_map` from `route` `r` where `r`.`route_id` = `t`.`route_id` limit 1) AS `route_map` FROM (`item_order` `o` join `turn` `t`) WHERE `o`.`status` = 'dtruck' AND `o`.`route_id` = `t`.`route_id` ;

-- --------------------------------------------------------

--
-- Structure for view `future_leaves_details`
--
DROP TABLE IF EXISTS `future_leaves_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`sql6501921`@`%` SQL SECURITY INVOKER VIEW `future_leaves_details`  AS SELECT `employee`.`user_id` AS `user_id`, `employee`.`mobile_no` AS `mobile_no`, `employee`.`weekly_worked_hours` AS `weekly_worked_hours`, `employee`.`city` AS `city`, `employee`.`last_arrival_time` AS `last_arrival_time`, `city`.`name` AS `city_name`, `user`.`first_name` AS `first_name`, `user`.`last_name` AS `last_name`, `employee_leave`.`leave_id` AS `leave_id`, `employee_leave`.`date` AS `date`, `employee_leave`.`leave_reason` AS `leave_reason`, `employee_leave`.`status` AS `status` FROM (((`user` join `employee_leave` on(`user`.`user_id` = `employee_leave`.`user_id`)) join `employee` on(`user`.`user_id` = `employee`.`user_id`)) join `city` on(`city`.`city_id` = `employee`.`city`)) WHERE `employee_leave`.`date` > cast(convert_tz(current_timestamp(),'+00:00','+05:30') as date) ORDER BY `employee_leave`.`date` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `leaved_employees_today`
--
DROP TABLE IF EXISTS `leaved_employees_today`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `leaved_employees_today`  AS SELECT DISTINCT `employee_leave`.`user_id` AS `user_id` FROM `employee_leave` WHERE `employee_leave`.`date` = cast(convert_tz(current_timestamp(),'+00:00','+05:30') as date) AND `employee_leave`.`status` = 11 ;

-- --------------------------------------------------------

--
-- Structure for view `route_details`
--
DROP TABLE IF EXISTS `route_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `route_details`  AS SELECT `route`.`route_id` AS `route_id`, `scity`.`name` AS `start_city_name`, `ecity`.`name` AS `end_city_name`, `city_assignment`.`city_id` AS `city` FROM (((`route` join `city_assignment` on(`route`.`route_id` = `city_assignment`.`route_id`)) join `city` `scity` on(`scity`.`city_id` = `route`.`start_city`)) join `city` `ecity` on(`ecity`.`city_id` = `route`.`end_city`)) ;

-- --------------------------------------------------------

--
-- Structure for view `train_dispatched_orders`
--
DROP TABLE IF EXISTS `train_dispatched_orders`;

CREATE ALGORITHM=UNDEFINED DEFINER=`sql6501921`@`%` SQL SECURITY INVOKER VIEW `train_dispatched_orders`  AS SELECT `item_order`.`order_id` AS `order_id`, `item_order`.`user_id` AS `user_id`, `item_order`.`route_id` AS `route_id`, `item_order`.`date` AS `date`, `item_order`.`status` AS `status`, `item_order`.`address` AS `address`, `item_order`.`weight` AS `weight`, `city_assignment`.`city_id` AS `city_id`, `train_assignment`.`train_id` AS `train_id`, `train`.`train_name` AS `train_name` FROM (((`item_order` join `city_assignment` on(`item_order`.`route_id` = `city_assignment`.`route_id`)) join `train_assignment` on(`item_order`.`order_id` = `train_assignment`.`order_id`)) join `train` on(`train_assignment`.`train_id` = `train`.`train_id`)) WHERE `item_order`.`status` = 'dtrain' ;

-- --------------------------------------------------------

--
-- Structure for view `turns_in_progress`
--
DROP TABLE IF EXISTS `turns_in_progress`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `turns_in_progress`  AS SELECT `turn`.`turn_id` AS `turn_id`, `turn`.`driver_id` AS `driver_id`, `turn`.`assistant_id` AS `assistant_id`, `turn`.`route_id` AS `route_id`, `turn`.`truck_id` AS `truck_id`, `turn`.`scheduled_date` AS `scheduled_date`, `turn`.`scheduled_time` AS `scheduled_time`, `turn`.`turn_start_time` AS `turn_start_time`, `turn`.`turn_end_time` AS `turn_end_time` FROM `turn` WHERE `turn`.`scheduled_date` = cast(current_timestamp() as date) AND (`turn`.`turn_start_time` is null OR `turn`.`turn_end_time` is null) ;

-- --------------------------------------------------------

--
-- Structure for view `turns_to_dispatch`
--
DROP TABLE IF EXISTS `turns_to_dispatch`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `turns_to_dispatch`  AS SELECT `turn`.`turn_id` AS `turn_id`, `turn`.`driver_id` AS `driver_id`, `turn`.`assistant_id` AS `assistant_id`, `turn`.`route_id` AS `route_id`, `turn`.`truck_id` AS `truck_id`, `city_assignment`.`city_id` AS `city_id`, concat(`d_user`.`first_name`,' ',`d_user`.`last_name`) AS `driver_name`, concat(`da_user`.`first_name`,' ',`da_user`.`last_name`) AS `assistant_name`, `truck`.`truck_no` AS `truck_no` FROM ((((`turn` join `user` `d_user` on(`d_user`.`user_id` = `turn`.`driver_id`)) join `user` `da_user` on(`da_user`.`user_id` = `turn`.`assistant_id`)) join `truck` on(`turn`.`truck_id` = `truck`.`truck_id`)) join `city_assignment` on(`turn`.`route_id` = `city_assignment`.`route_id`)) WHERE `turn`.`turn_start_time` is null ;

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
  ADD KEY `route_id_idx` (`route_id`),
  ADD KEY `idx_order_status` (`status`);

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
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `employee_leave`
--
ALTER TABLE `employee_leave`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT for table `item_order`
--
ALTER TABLE `item_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `route`
--
ALTER TABLE `route`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `train`
--
ALTER TABLE `train`
  MODIFY `train_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1123250;

--
-- AUTO_INCREMENT for table `turn`
--
ALTER TABLE `turn`
  MODIFY `turn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `Reset_turn_count` ON SCHEDULE EVERY 1 DAY STARTS '2022-07-03 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE driver_assistant SET cons_turn_count = 0$$

CREATE DEFINER=`root`@`localhost` EVENT `Reset_last_arrival_time` ON SCHEDULE EVERY 1 DAY STARTS '2022-07-03 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE employee SET last_arrival_time = '00:00:00'$$

CREATE DEFINER=`root`@`localhost` EVENT `Reset_weekly_worked_hours` ON SCHEDULE EVERY 1 WEEK STARTS '2022-07-04 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE employee SET weekly_worked_hours = 0$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

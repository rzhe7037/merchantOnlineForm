-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2019 年 01 月 08 日 00:50
-- 伺服器版本: 10.1.34-MariaDB
-- PHP 版本： 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `shopinfo`
--

-- --------------------------------------------------------

--
-- 資料表結構 `company_address`
--

CREATE TABLE `company_address` (
  `company_address_id` int(11) NOT NULL,
  `address_street` varchar(20) NOT NULL,
  `address_suburb` varchar(20) NOT NULL,
  `address_postcode` int(11) NOT NULL,
  `address_state` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `company_address`
--

INSERT INTO `company_address` (`company_address_id`, `address_street`, `address_suburb`, `address_postcode`, `address_state`) VALUES
(105, '27 George Street', 'Sydney', 2000, 'NSW'),
(106, '706 Pitt Street', 'Haymarket', 2000, 'NSW'),
(107, '532-536 Canterbury R', 'Campsie', 2194, 'NSW'),
(108, '99A Burwood Road', 'Enfield', 2136, 'NSW'),
(109, '487-503 George Stree', 'Sydney', 2000, 'NSW'),
(110, '739A Princes Highway', 'Tempe', 2044, 'NSW'),
(111, '353 Princes Highway', 'Newtown', 2042, 'NSW'),
(112, '27 George Street', 'Sydney', 2000, 'NSW'),
(113, '99A Burwood Road', 'Enfield', 2136, 'NSW'),
(114, '307 George Street', 'Haymarket', 2000, 'NSW'),
(115, '27 George Street', 'Sydney', 2000, 'NSW'),
(116, '81 Parramatta', 'Concord', 2137, 'NSW'),
(117, '77 Burwood Road', 'Burwood', 2134, 'NSW'),
(118, '10 Bridge', 'Sydney', 2000, 'NSW'),
(119, '1226 Massachusetts A', 'Arlington', 2476, 'MA'),
(120, '2261 Santa Fe', 'Rosario', 0, 'Santa Fe'),
(121, '143A George', 'The', 2000, 'NSW'),
(122, '129-135 George Stree', 'The Rocks', 2000, 'NSW'),
(123, '2329 Massachusetts A', 'Cambridge', 2140, 'MA'),
(124, '2329 Massachusetts A', 'Cambridge', 2140, 'MA'),
(125, '289-307 George Stree', 'Sydney', 2000, 'NSW'),
(126, '143A George Street', 'The Rocks', 2000, 'NSW'),
(127, '90 Parramatta Road', 'Summer Hill', 2130, 'NSW');

-- --------------------------------------------------------

--
-- 資料表結構 `company_business`
--

CREATE TABLE `company_business` (
  `business_type_id` int(11) NOT NULL,
  `business_type` varchar(20) NOT NULL,
  `business_subtype` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `company_business`
--

INSERT INTO `company_business` (`business_type_id`, `business_type`, `business_subtype`) VALUES
(1, 'hospitality', 'ä¸­å¼å¿«é¤'),
(2, 'retail', 'retail_subtype'),
(3, 'hospitality', 'hospitality_subtype'),
(4, 'service', 'service_subtype'),
(5, 'education', 'education_subtype'),
(6, 'real estate', 'real estate_subtype'),
(7, 'agent2', 'agent_subtype'),
(8, 'retail', 'retail_subtype2'),
(9, 'hospitality', 'hospitality_subtype2'),
(10, 'service', 'service_subtype2'),
(11, 'education', 'education_subtype2'),
(12, 'real estate', 'real estate_subtype2'),
(13, 'agent', 'agent_subtype2');

-- --------------------------------------------------------

--
-- 資料表結構 `company_info`
--

CREATE TABLE `company_info` (
  `company_id` int(11) NOT NULL,
  `trading_name` varchar(20) NOT NULL,
  `company_name` varchar(20) DEFAULT NULL,
  `company_address_id` int(11) NOT NULL,
  `business_type_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `nationality` varchar(20) NOT NULL,
  `creator` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `company_info`
--

INSERT INTO `company_info` (`company_id`, `trading_name`, `company_name`, `company_address_id`, `business_type_id`, `owner_id`, `nationality`, `creator`) VALUES
(125, 'testShop234', '', 105, 0, 129, 'Aussie', 'test'),
(126, 'testshop444', '', 106, 6, 130, 'Thai', 'test'),
(127, 'testShop5', '', 107, 4, 131, 'japan', 'test'),
(142, 'testshop100', NULL, 108, 10, 146, 'Chinese', 'test'),
(143, 'testShop', '', 109, 2, 147, 'Thai', 'test'),
(144, 'testShop6', '', 110, 4, 148, 'japan', 'test'),
(145, 'testShop2222', '', 111, 2, 149, 'japan', 'test'),
(146, 'testshop1111', NULL, 112, 2, 150, 'Chinese', 'test'),
(147, 'etwet11131', '', 113, 7, 151, 'japan', 'test'),
(148, 'testShop5', '', 114, 2, 152, 'Thai', 'test'),
(149, 'testshop111', '', 115, 4, 153, 'Thai', 'test'),
(150, 'testshop100', '', 116, 5, 154, 'Thai', 'test'),
(151, 'testshop250', '', 117, 4, 155, 'japan', 'test'),
(152, 'Rongrongzheng', '', 118, 1, 156, 'Chinese', 'test'),
(153, 'testShop111', '', 119, 3, 157, 'Thai', 'test'),
(154, 'testShop1111', '', 120, 1, 158, 'Chinese', 'test'),
(155, 'testshop1122', '', 121, 2, 159, 'Chinese', 'test'),
(156, 'testShop', '', 122, 1, 160, 'Chinese', 'test'),
(157, 'testShop2', '', 123, 1, 161, 'Chinese', 'test'),
(158, 'testShop3', '', 124, 1, 162, 'Chinese', 'test'),
(159, 'testshop100', '', 125, 2, 163, 'Chinese', 'test'),
(160, 'Trading', 'Company', 126, 1, 164, 'Chinese', 'test'),
(161, 'mmmmmm', 'mmmmmm', 127, 2, 165, 'Chinese', 'test');

-- --------------------------------------------------------

--
-- 資料表結構 `company_owner`
--

CREATE TABLE `company_owner` (
  `owner_id` int(11) NOT NULL,
  `owner_name` varchar(30) NOT NULL,
  `owner_mobile` varchar(12) NOT NULL,
  `shop_number` varchar(12) DEFAULT NULL,
  `managed_by` varchar(10) NOT NULL,
  `manager_name` varchar(20) DEFAULT NULL,
  `manager_phone` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `company_owner`
--

INSERT INTO `company_owner` (`owner_id`, `owner_name`, `owner_mobile`, `shop_number`, `managed_by`, `manager_name`, `manager_phone`) VALUES
(129, 'SDF', '1111111112', '1111111111', 'manager', 'DDSSD', '1111111111'),
(130, 'GSG', '1111111111', '0', 'owner', '', '0'),
(131, 'FSDF', '2222222222', '0', 'owner', '', '0'),
(132, 'AAAA', '1111111111', '0', 'owner', '', '0'),
(133, 'AAAA', '1111111111', '0', 'owner', '', '0'),
(134, 'AAAA', '1111111111', '0', 'owner', '', '0'),
(135, 'AAAA', '1111111111', '0', 'owner', '', '0'),
(136, 'AAAA', '1111111111', '0', 'owner', '', '0'),
(137, 'AAAA', '1111111111', '0', 'owner', '', '0'),
(138, 'AAAA', '1111111111', '0', 'owner', '', '0'),
(139, 'AAAA', '1111111111', '0', 'owner', '', '0'),
(140, 'AAAA', '1111111111', '0', 'owner', '', '0'),
(141, 'AAAA', '1111111111', '0', 'owner', '', '0'),
(142, 'AAAA', '1111111111', '0', 'owner', '', '0'),
(143, 'AAAA', '1111111111', '0', 'owner', '', '0'),
(144, 'AAAA', '1111111111', '0', 'owner', '', '0'),
(145, 'AAAA', '1111111111', '0', 'owner', '', '0'),
(146, 'eeeee', '1111111111', '', 'owner', '', ''),
(147, 'ssssss', '1111111111', '0', 'owner', '', '0'),
(148, 'fhd', '1111111111', '0', 'owner', '', '0'),
(149, 'wfawef', '1111111111', '0', 'owner', '', '0'),
(150, 'sdsd', '1111111111', '', 'owner', '', ''),
(151, 'seryery', '1111111111', '1111111111', 'owner', '', ''),
(152, 'dfsdf', '0401027519', '', 'owner', '', ''),
(153, 'dasdasd', '0401027519', '', 'owner', '', ''),
(154, 'biugbiu', '0401027519', '', 'manager', 'jijio', '0401027519'),
(155, 'ffafsf', '0401027519', '0402010305', 'manager', 'uhoho', '0402010305'),
(156, 'Rongrong', '0402017519', '', 'owner', '', ''),
(157, 'rqwq', '0401027519', '0401027519', 'owner', '', ''),
(158, 'Rongrong ', '0401027519', '', 'owner', '', ''),
(159, 'Rongrong', '0401027519', '', 'owner', '', ''),
(160, 'afdsf', '0401027519', '', 'owner', '', ''),
(161, 'sdfasdf', '0401027519', '', 'owner', '', ''),
(162, 'dfdf', '0401027519', '', 'owner', '', ''),
(163, 'Tom', '0401027519', '', 'owner', '', ''),
(164, 'Rrz', '0401027519', '', 'owner', '', ''),
(165, 'asdddf', '0401027519', '', 'owner', '', '');

-- --------------------------------------------------------

--
-- 資料表結構 `company_system`
--

CREATE TABLE `company_system` (
  `company_id` int(11) NOT NULL,
  `pos` varchar(20) DEFAULT NULL,
  `QR_payment` varchar(20) DEFAULT NULL,
  `satisfaction` varchar(20) DEFAULT NULL,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `company_system`
--

INSERT INTO `company_system` (`company_id`, `pos`, `QR_payment`, `satisfaction`, `comment`) VALUES
(125, 'None', 'None', 'Yes', ''),
(126, 'None', 'None', 'Yes', ''),
(127, 'AUPOS', 'Red payment', 'Yes', ''),
(128, 'None', 'None', 'Yes', ''),
(129, 'None', 'None', 'Yes', ''),
(130, 'None', 'None', 'Yes', ''),
(131, 'None', 'None', 'Yes', ''),
(132, 'None', 'None', 'Yes', ''),
(133, 'None', 'None', 'Yes', ''),
(134, 'None', 'None', 'Yes', ''),
(135, 'None', 'None', 'Yes', ''),
(136, 'None', 'None', 'Yes', ''),
(137, 'None', 'None', 'Yes', ''),
(138, 'None', 'None', 'Yes', ''),
(139, 'None', 'None', 'Yes', ''),
(140, 'None', 'None', 'Yes', ''),
(141, 'None', 'None', 'Yes', ''),
(142, 'None', 'None', 'Yes', ''),
(143, 'AUPOS', 'Red payment', 'Yes', '2222'),
(144, 'AUPOS', 'Red payment', 'Yes', ''),
(145, 'AUPOS', 'Red payment', 'Yes', ''),
(146, 'aupos', 'red_payment', 'No', ''),
(147, 'AUPOS', 'Red payment', 'Yes', ''),
(148, 'AUPOS', 'Red payment', 'No', 'wette'),
(149, 'AUPOS', 'Red payment', 'Yes', ''),
(150, 'AUPOS', 'Red payment', 'Yes', ''),
(151, 'None', 'None', 'No', ''),
(152, 'AUPOS', 'Red payment', 'Yes', ''),
(153, 'AUPOS', 'Red payment', 'Intermediate', 'qwrwr'),
(154, 'AUPOS', 'Red Payment', 'Poor', '12124'),
(155, '', '', 'Poor', 'asdfghjkl'),
(156, 'fdd', 'sdfas', 'Poor', 'fsdfas'),
(157, 'aupos', '', 'Poor', ''),
(158, 'aupos', 'red_payment', 'Intermediate', '111'),
(159, 'aupos', 'Other', 'Poor', 'ewwww'),
(160, 'aupos', 'red_payment', 'Satisfied', '11111'),
(161, 'POS', 'Alipay', 'Satisfied', 'None');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `privilege` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `privilege`) VALUES
(1, 'test', '098f6bcd4621d373cade4e832627b4f6', ''),
(2, 'test5', 'e3d704f3542b44a621ebed70dc0efe13', ''),
(3, 'test5', 'e3d704f3542b44a621ebed70dc0efe13', ''),
(4, 'admin', '4a7d1ed414474e4033ac29ccb8653d9b', 'admin'),
(5, 'test3', '8ad8757baa8564dc136c1e07507f4a98', 'normal'),
(6, 'test4', '86985e105f79b95d6bc918fb45ec7727', 'normal'),
(7, 'test6', '4cfad7076129962ee70c36839a1e3e15', 'normal'),
(8, 'test7', 'b04083e53e242626595e2b8ea327e525', 'normal'),
(9, 'test8', '5e40d09fa0529781afd1254a42913847', 'normal'),
(10, 'test', '098f6bcd4621d373cade4e832627b4f6', 'normal'),
(11, 'test6', '4cfad7076129962ee70c36839a1e3e15', 'normal');

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `company_address`
--
ALTER TABLE `company_address`
  ADD PRIMARY KEY (`company_address_id`);

--
-- 資料表索引 `company_business`
--
ALTER TABLE `company_business`
  ADD PRIMARY KEY (`business_type_id`);

--
-- 資料表索引 `company_info`
--
ALTER TABLE `company_info`
  ADD PRIMARY KEY (`company_id`);

--
-- 資料表索引 `company_owner`
--
ALTER TABLE `company_owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- 資料表索引 `company_system`
--
ALTER TABLE `company_system`
  ADD PRIMARY KEY (`company_id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `company_address`
--
ALTER TABLE `company_address`
  MODIFY `company_address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- 使用資料表 AUTO_INCREMENT `company_business`
--
ALTER TABLE `company_business`
  MODIFY `business_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用資料表 AUTO_INCREMENT `company_info`
--
ALTER TABLE `company_info`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- 使用資料表 AUTO_INCREMENT `company_owner`
--
ALTER TABLE `company_owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- 使用資料表 AUTO_INCREMENT `company_system`
--
ALTER TABLE `company_system`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- 使用資料表 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

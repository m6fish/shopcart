-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 
-- 伺服器版本: 5.6.16
-- PHP 版本： 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫： `shopcar`
--

-- --------------------------------------------------------

--
-- 資料表結構 `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `uid` int(255) NOT NULL COMMENT 'User ID',
  `pid` int(255) NOT NULL COMMENT 'Product ID',
  `nums` int(255) NOT NULL COMMENT 'numbers of product',
  PRIMARY KEY (`pid`,`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `cart`
--

INSERT INTO `cart` (`uid`, `pid`, `nums`) VALUES
(0, 1, 1),
(2, 1, 2),
(0, 2, 1),
(2, 2, 5),
(2, 3, 1),
(2, 4, 1),
(0, 5, 1);

-- --------------------------------------------------------

--
-- 資料表結構 `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `pid` int(255) NOT NULL,
  `name` varchar(10) NOT NULL,
  `kind` varchar(10) NOT NULL,
  `price` mediumtext NOT NULL,
  `deadline` date NOT NULL,
  `des` varchar(100) NOT NULL COMMENT 'describe',
  `pic` varchar(150) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `product`
--

INSERT INTO `product` (`pid`, `name`, `kind`, `price`, `deadline`, `des`, `pic`) VALUES
(1, '咖啡', '飲料', '30', '2014-07-01', '好喝的咖啡', ''),
(2, '紅茶', '飲料', '10', '2014-07-02', 'GOOD', ''),
(3, '綠茶', '飲料', '10', '2014-07-03', '123', ''),
(4, '青茶', '飲料', '10', '2014-07-05', '123', ''),
(5, '白開水', '贈送', '0', '2015-07-05', '000', '');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `pw` varchar(100) NOT NULL,
  `salt` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`id`, `user`, `pw`, `salt`) VALUES
(0, 'admin', 'c295cebc454bf9a1106e28543987fae6be472c3df1d526bc6f6d73bd49ae2efb', 'ca1ec0eebe1ffda6e5a7164a2f5bc1b2a965359729e69e3301db2481e0d073d6'),
(2, 'user01', 'c29b69930454653171dead29b056e34ea8db6bcfe4bf33aa61c699badbff996d', 'a5ef9b021c4d5b9bcdb0dac7359619c4522f782502dc1916470114d4ecb8d130'),
(3, 'user02', '25e9efdc15a9826a85266e7fc4dda1ddbd89cd8d2280d9483ba9b0552f914d73', '95487cb65ff843a6a7d3926f9e973151b244df8216e063f01306e31676e6ef92'),
(4, 'testA_I', '30532acbbca96e7cd39b36529831b3c83aec36cb7abf3c7e093648c17b5c1027', '361c2adc351a1d3a8472bca52642807d69e116db0e07d267d50f69cb5375a99a');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

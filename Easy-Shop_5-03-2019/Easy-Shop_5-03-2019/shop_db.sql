-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2019 at 04:48 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shop_db`
--
CREATE DATABASE IF NOT EXISTS `shop_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `shop_db`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_details_tbl`
--

CREATE TABLE IF NOT EXISTS `admin_details_tbl` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin_details_tbl`
--

INSERT INTO `admin_details_tbl` (`admin_id`, `username`, `pass`) VALUES
(1, 'admin', 'admin@123'),
(2, 'annu', 'annu@123');

-- --------------------------------------------------------

--
-- Table structure for table `brand_details_tbl`
--

CREATE TABLE IF NOT EXISTS `brand_details_tbl` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(100) NOT NULL,
  `brand_desc` varchar(100) NOT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `brand_details_tbl`
--

INSERT INTO `brand_details_tbl` (`brand_id`, `brand_name`, `brand_desc`) VALUES
(1, 'm_levis', 'Gurrented Clothes.'),
(2, 'W_Denim', 'Good Quality.'),
(3, 'E_Akg', 'Good Voice And Clear voice.'),
(4, 'HONOU 9 lite Headset', 'Honor 9 Lite (Sapphire Blue, 32 GB)  (3 GB RAM)');

-- --------------------------------------------------------

--
-- Table structure for table `cart_tbl`
--

CREATE TABLE IF NOT EXISTS `cart_tbl` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_id` varchar(10) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `size` varchar(100) NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cart_tbl`
--

INSERT INTO `cart_tbl` (`cart_id`, `prod_id`, `qty`, `color`, `size`) VALUES
(4, '4', '2', 'black', '9');

-- --------------------------------------------------------

--
-- Table structure for table `category_details_tbl`
--

CREATE TABLE IF NOT EXISTS `category_details_tbl` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) NOT NULL,
  `cat_desc` varchar(500) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `category_details_tbl`
--

INSERT INTO `category_details_tbl` (`cat_id`, `cat_name`, `cat_desc`) VALUES
(1, 'MEN', 'All Men Products.'),
(2, 'WOMEN', 'All Women products.'),
(3, 'Electronic', 'All Electronic Products.');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(3) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(50) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`) VALUES
(1, 'sanand');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(3) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(50) NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(1, 'india');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_details_tbl`
--

CREATE TABLE IF NOT EXISTS `feedback_details_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `sub` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `feedback_details_tbl`
--

INSERT INTO `feedback_details_tbl` (`id`, `name`, `email`, `mobile`, `sub`) VALUES
(1, 'mitesh', 'mitesh@gmail.com', '78787', ' nmnmn'),
(4, 'm', 'janimiten@gmail.com', '8347724344', 'asdklask;smc '),
(5, 'miten', 'janimiten@gmail.com', '8347724344', 'lzxmklmckl\r\n '),
(6, 'viraj', 'viraj.sangani@gmail.com', '8530569104', 'material '),
(7, 'deep', 'deeppatel@gmail.com', '7069506510', 'Good Quality Website ');

-- --------------------------------------------------------

--
-- Table structure for table `product_details_tbl`
--

CREATE TABLE IF NOT EXISTS `product_details_tbl` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_name` varchar(100) NOT NULL,
  `sdate` varchar(100) NOT NULL,
  `edate` varchar(100) NOT NULL,
  `bprice` varchar(100) NOT NULL,
  `cat_id` varchar(100) NOT NULL,
  `sub_cat_id` varchar(100) NOT NULL,
  `brand_id` varchar(100) NOT NULL,
  `img_path` varchar(100) NOT NULL,
  `prod_desc` varchar(500) NOT NULL,
  `prod_size` varchar(50) NOT NULL,
  `prod_color` varchar(50) NOT NULL,
  `prod_quantity` int(3) NOT NULL,
  PRIMARY KEY (`prod_id`),
  KEY `cat_id` (`cat_id`,`sub_cat_id`,`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `product_details_tbl`
--

INSERT INTO `product_details_tbl` (`prod_id`, `prod_name`, `sdate`, `edate`, `bprice`, `cat_id`, `sub_cat_id`, `brand_id`, `img_path`, `prod_desc`, `prod_size`, `prod_color`, `prod_quantity`) VALUES
(3, 'ADIDAS', '01/01/2019', '02/14/2019', '399', '1', '1', '1', 'upload/coscocmouse-11-asian-brown-original-imaf78gxmkzgxg7p.jpeg', 'ADIDAS \r\nYAMO 1.0 M Running Shoe For Men  (Navy)', '7,8,9,10,11', 'black', 8),
(4, 'Spread Shirt', '01/01/2019', '31/1/2019', '299', '1', '2', '1', 'upload/m-hlsh008864-navy-blue-highlander-original-imaf5g63byj8jsn2.jpeg', 'Men Solid Casual Spread Shirt\r\n', '9', 'black,yellow', 15),
(5, 'Clothing', '01/01/2019', '31/1/2019', '249', '1', '3', '1', 'upload/32-sht02blue-lee-cooper-original-imafavz5mdqkj7n4.jpeg', '32-sht02blue-lee-cooper-original', '9,10,11', 'black,yellow,blue', 10),
(6, 'Ledish_TIE', '01/01/2019', '05/08/2019', '99', '2', '4', '2', 'upload/free-tie-5-the-ethnic-wears-original-imaeyyranhswrcpp.jpeg', 'The Ethnic Wears Printed Tie', '10,11', 'red,white', 8),
(7, 'Legish', '01/01/2019', '01/09/2019', '149', '2', '5', '2', 'upload/s-ss18p020-red-anmi-original-imaf9jvsr96mewje.jpeg', 'Anmi Legging  (Red, Solid', '10,11', 'red', 10),
(8, 'Kepri', '01/01/2019', '03/01/2019', '99', '2', '6', '2', 'upload/8-9-years-multicolor-gc-capri-1-blk-yel-red-blu-bro-pin-6-pcs-original-imaewx55zwyyhh7x.jpeg', 'good choice Capri For Girls Casual Self Design Cotton  (Multicolor Pack of 6)', '6,7,8,9,10,11', 'red,white,black,yellow,blue,green', 50),
(10, 'AKG Handspree', '01/01/2019', '31/1/2019', '299', '3', '9', '3', 'upload/black-akg-samsung-earphones-headphones-headset-handsfree-for-samsung-galaxy-s8-500x500.jpg', 'MOBILE Wired Headset with Mic  (Black, In the Ear)', '', 'black', 15),
(11, 'HONOR', '01/01/2019', '31/1/2019', '9999', '3', '8', '4', 'upload/honor-9-lite-lld-al10-original-imaffh2qdpanuhp9.jpeg', 'Honor 9 Lite (Sapphire Blue, 32 GB)  (3 GB RAM)', '', 'black', 15);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int(3) NOT NULL AUTO_INCREMENT,
  `state_name` varchar(50) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`) VALUES
(1, 'gujarat');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category_details_tbl`
--

CREATE TABLE IF NOT EXISTS `sub_category_details_tbl` (
  `sub_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_cat_name` varchar(100) NOT NULL,
  `sub_cat_desc` varchar(500) NOT NULL,
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_cat_id`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `sub_category_details_tbl`
--

INSERT INTO `sub_category_details_tbl` (`sub_cat_id`, `sub_cat_name`, `sub_cat_desc`, `cat_id`) VALUES
(1, 'shoes', 'Shoes Is Very Good Quality.', 1),
(2, 'Shart', 'Good Quality.', 1),
(3, 'clothing', 'Good Clothes.', 1),
(4, 'Tie', 'Good Clothe.', 1),
(5, 'Legish', 'Good Clothe and gurrented.', 2),
(6, 'Kepri', 'Short And Good.', 2),
(7, ' Women watch', 'Good Quality.', 2),
(8, 'headset', 'Good Company.', 3),
(9, 'Handspree', 'High Sound And Full Voice.', 3),
(10, 'Winter Wear', 'Winter Wear', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_details_tbl`
--

CREATE TABLE IF NOT EXISTS `user_details_tbl` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `gen` varchar(30) NOT NULL,
  `pass` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_details_tbl`
--

INSERT INTO `user_details_tbl` (`user_id`, `fname`, `lname`, `email`, `mobile`, `gen`, `pass`) VALUES
(1, 'viraj', 'sangani', 'sanganiviraj000@gmail.com', '8530569104', 'male', 'viraj@1234567890'),
(2, 'mitesh', 'mitesh', 'miteshdarji1112@gmail.com', '9687112390', 'male', 'mitesh');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

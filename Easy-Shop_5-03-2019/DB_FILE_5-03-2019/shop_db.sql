-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2019 at 06:13 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details_tbl`
--

CREATE TABLE `admin_details_tbl` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `brand_details_tbl` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(100) NOT NULL,
  `brand_desc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `cart_tbl` (
  `cart_id` int(11) NOT NULL,
  `prod_id` varchar(10) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `color` varchar(100) NOT NULL,
  `size` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category_details_tbl`
--

CREATE TABLE `category_details_tbl` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL,
  `cat_desc` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category_details_tbl`
--

INSERT INTO `category_details_tbl` (`cat_id`, `cat_name`, `cat_desc`) VALUES
(1, 'MEN', 'All Men Products.'),
(2, 'WOMEN', 'All Women products.'),
(3, 'Electronic', 'All Electronic Products.'),
(4, 'KIDS WARE', 'Kids Ware');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(3) NOT NULL,
  `city_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`) VALUES
(1, 'sanand');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(3) NOT NULL,
  `country_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `country_name`) VALUES
(1, 'india');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_details_tbl`
--

CREATE TABLE `feedback_details_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `sub` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `product_details_tbl` (
  `prod_id` int(11) NOT NULL,
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
  `prod_quantity` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_details_tbl`
--

INSERT INTO `product_details_tbl` (`prod_id`, `prod_name`, `sdate`, `edate`, `bprice`, `cat_id`, `sub_cat_id`, `brand_id`, `img_path`, `prod_desc`, `prod_size`, `prod_color`, `prod_quantity`) VALUES
(4, 'Spread Shirt', '01/01/2019', '31/1/2019', '299', '1', '2', '1', 'upload/m-hlsh008864-navy-blue-highlander-original-imaf5g63byj8jsn2.jpeg', 'Men Solid Casual Spread Shirt\r\n', '9', 'black,yellow', 15),
(7, 'Legish', '01/01/2019', '01/09/2019', '149', '2', '5', '2', 'upload/s-ss18p020-red-anmi-original-imaf9jvsr96mewje.jpeg', 'Anmi Legging  (Red, Solid', '10,11', 'red', 10),
(10, 'AKG Handspree', '01/01/2019', '31/1/2019', '299', '3', '9', '3', 'upload/black-akg-samsung-earphones-headphones-headset-handsfree-for-samsung-galaxy-s8-500x500.jpg', 'MOBILE Wired Headset with Mic  (Black, In the Ear)', '', 'black', 15),
(15, 'boys Shorts Kepri', '01/01/2019', '31/1/2019', '349', '1', '3', '1', 'upload/32-sht02blue-lee-cooper-original-imafavz5nch3rukh.jpeg', 'Very Good', '10,11', 'black', 56),
(16, 'shoes', '01/01/2019', '31/1/2019', '249', '1', '1', '2', 'upload/bbmg8129-10-bacca-bucci-grey-original-imaf5th453tndkcs.jpeg', 'Good Quality.', '9,10,11', 'black', 8),
(19, 'Watch', '01/01/2019', '31/1/2019', '99', '2', '7', '2', 'upload/new-stylish-black-red-gift-combo-watch-for-women-and-girl-original-imaezqybheksdssz.jpeg', 'Good Watch', '', 'black', 50),
(20, 'watch Branded', '01/01/2019', '31/1/2019', '249', '2', '7', '2', 'upload/71toZtiM0bL._UX342_.jpg', 'Good And Smartness.', '', 'red', 8),
(22, 'AKG Laptop', '12/04/2018', '31/1/2019', '29999', '3', '15', '3', 'upload/item_XL_27911849_68571437.jpg', 'good Lookable.', '', 'red', 56),
(24, 'sarees', '12/04/2018', '31/1/2019', '999', '2', '16', '2', 'upload/sri-s-393.jpg', 'Good Quality.', '11', 'blue', 15),
(25, 'sarees', '01/01/2019', '31/1/2019', '999', '2', '16', '2', 'upload/1495463983646_1495463912905-origin80prcnt.jpg', 'Good', '11', 'blue', 15),
(26, 'sarees', '01/01/2019', '01/05/2019', '299', '2', '16', '1', 'upload/1483779989089_1483779986662-origin80prcnt.jpg', 'Good', '11', 'red', 10),
(27, 'sarees', '01/01/2019', '31/1/2019', '999', '2', '16', '2', 'upload/36780588_1090944947736751_2572081052570877952_n.jpg', 'Saree', '11', 'red', 56),
(28, 'Television', '01/01/2019', '31/1/2019', '30000', '3', '11', '3', 'upload/Activa-6003-98-cm-40-SDL047538599-1-6f232.jpg', 'Hd ', '11', 'yellow', 8),
(29, 'Honor Mobile', '01/01/2019', '31/1/2019', '11000', '3', '8', '4', 'upload/141.jpg', 'HD RESULT', '11', 'black', 56),
(30, 'Handset', '01/01/2019', '31/1/2019', '19000', '3', '8', '4', 'upload/cart2.jpg', 'Honor', '11', 'black', 10),
(31, 'Mobile', '01/01/2019', '02/12/2019', '11000', '3', '8', '4', 'upload/cart3.jpg', 'Good chargable', '11', 'yellow', 50),
(33, 'sarees', '01/01/2019', '31/1/2019', '999', '2', '16', '2', 'upload/kerala-special-pleats-stiched-kasavu-saree-600x600.jpg', 'Very good.', '10,11', 'yellow', 15),
(34, 'lED TV', '01/01/2019', '31/1/2019', '19999', '3', '11', '4', 'upload/61nv6lW9WdL._SX425_.jpg', 'HD SOUND', '', 'black', 10),
(35, 'LAPTOP', '02/01/2019', '31/1/2019', '29999', '3', '15', '3', 'upload/u_10180974.jpg', 'VERY CONFIDENT', '10,11', 'black', 15),
(37, 'Shart', '01/01/2019', '31/1/2019', '999', '1', '3', '2', 'upload/80b8c147defd3af66a7b30b64095ba01--denim-shirts-skinny.jpg', 'GOODABLE', '11', 'black', 50),
(38, 'MOBILE PHONE', '01/01/2019', '31/1/2019', '19000', '3', '8', '4', 'upload/CL660HX_02_Design_439px_en-skybridgedomains.jpg', 'OLD vERSION mOBILE', '11', 'red,white,black', 15),
(39, 'lED TV', '01/01/2019', '31/1/2019', '29999', '3', '11', '3', 'upload/61nv6lW9WdL._SX425_.jpg', 'clear and HD', '11', 'blue', 10),
(40, 'shart', '02/07/2019', '11/30/2019', '299', '1', '3', '2', 'upload/3f5da5538cb27b91a42d1d1f1a7b12d8--mens-casual-shirts-men-shirts.jpg', 'Blue shart', '11', 'blue', 15),
(41, 'kepri', '01/01/2019', '01/31/2019', '999', '3', '6', '2', 'upload/m-dp6354-adidas-original-imafagrzaf9frxjz.jpeg', 'goodable', '11', 'yellow', 15),
(42, 'shoes', '01/01/2019', '31/1/2019', '999', '1', '1', '2', 'upload/wonder13cgryfrz-super113cblk-7-asian-multicolor-original-imaenr72umpytcgz.jpeg', 'good quality', '9,10,11', 'white,black,yellow,blue', 50),
(43, 'shoes', '01/01/2019', '02/03/2019', '999', '1', '1', '2', 'upload/oxygen-7-beerock-white-navy-original-imafccebah5hd3e7.jpeg', 'disable goodness', '8,11', 'black,blue,green', 15),
(44, 'punjabi sarii', '01/01/2019', '31/1/2019', '999', '2', '16', '2', 'upload/free-7944-snh-export-original-imaf8hwb4hxhvszz.jpeg', 'very good', '11', 'yellow', 10),
(45, 'gujarati saree', '01/01/2019', '31/1/2019', '999', '2', '16', '2', 'upload/free-mango-black-ng-creation-original-imaf5hhxdvaefcpy.jpeg', 'good', '11', 'blue', 15),
(46, 'Shart', '01/01/2019', '31/1/2019', '999', '1', '2', '1', 'upload/m-dp2961blusla-reebok-original-imafagmyhenhrzy9.jpeg', 'good', '', 'red,white,black,yellow,blue,green', 10),
(47, 'Shart', '01/01/2019', '31/1/2019', '299', '1', '2', '1', 'upload/l-pukpcsgfr06789-peter-england-university-original-imafagvf9nptxgjx.jpeg', 'qualitible', '10', 'white', 15),
(48, 'Shart', '01/01/2019', '31/1/2019', '349', '1', '2', '1', 'upload/xl-p-60-xl-rekha-fashion-hub-original-imaepgktqnzhhncs.jpeg', 'good', '11', 'blue', 56),
(49, 'Shart', '01/01/2019', '31/1/2019', '999', '1', '2', '1', 'upload/m-mss18p042-metronaut-original-imafc7bmyfsfsech.jpeg', 'good', '11', 'yellow', 15),
(50, 'Kepri', '01/01/2019', '31/1/2019', '299', '2', '6', '1', 'upload/413mB-T2dgL._SX342_QL70_.jpg', 'very good', '11', 'blue', 50),
(51, 'Kepri', '01/01/2019', '31/1/2019', '99', '2', '6', '2', 'upload/apl666pur-rp-pur-tp-zee555rd-rd-tp-sinimini-original-imae9zptsgkykvgw.jpeg', 'good', '11', 'yellow', 56),
(52, 'Kepri', '01/01/2019', '12/04/2018', '299', '2', '6', '2', 'upload/adesh-250x250.png', 'good', '8,9,10', 'yellow', 50),
(53, 'Kepri', '01/01/2019', '02/16/2019', '349', '2', '6', '2', 'upload/d4bd57ba-9c66-4cb4-84dd-d23aafe51d681525976706925-1.jpg', 'good', '11', 'blue', 10),
(54, 'Kepri', '12/04/2018', '12/12/2018', '299', '2', '6', '2', 'upload/d944e9f6-e2ec-4a0e-aa2e-81d7b0345e0a1539083601051-Palm-Tree-Girls-Blue-Solid-Regular-Fit-Capr', 'good', '11', 'yellow,blue', 15),
(55, 'legij', '01/01/2019', '31/1/2019', '349', '2', '5', '1', 'upload/blue-color-legging-500x500.jpg', 'very good', '10,11', 'yellow', 15),
(56, 'legij', '01/01/2019', '31/1/2019', '249', '2', '5', '1', 'upload/awesome-sky-blue-leggings-bba1a222-product.jpg', 'good', '11', 'yellow', 56),
(57, 'legij', '01/01/2019', '31/1/2019', '249', '2', '5', '1', 'upload/lavennder-womens-cotton-lycra-leggings-set-of-2-medium_5eceb9a6d0f98fbd2c4f85d293b25d67.jpg', 'goodable', '10', 'black', 10),
(58, 'honor nine lite', '01/01/2019', '31/1/2019', '12000', '3', '8', '4', 'upload/huawei_honor_7s_16gb_dual_sim_black_-_official_warranty_1.jpg', 'HAUAWi mobile', '11', 'blue', 10),
(59, 'AKG Handspree', '02/01/2019', '31/1/2019', '299', '3', '9', '3', 'upload/24875.jpg', 'Good Sound', '11', 'yellow', 50),
(60, 'Man Shorts', '01/01/2019', '31/1/2019', '299', '1', '3', '2', 'upload/s-mt003-billion-original-imaf5s5b3ekypaxk.jpeg', 'Good Clothes', '11', 'yellow', 10),
(62, 'TIE', '01/01/2019', '31/1/2019', '99', '1', '4', '1', 'upload/school-ties-250x250.jpg', 'Good Tie for Comfort', '11', 'red,white,black,yellow,blue,green', 10),
(63, 'TIE', '01/01/2019', '31/1/2019', '99', '1', '4', '2', 'upload/2352173503_1762479061.jpg', 'Good', '11', 'yellow,blue,green', 56),
(64, 'TIE', '02/06/2019', '31/1/2019', '199', '1', '4', '2', 'upload/school-tie-250x250.jpg', 'good', '11', 'yellow,blue,green', 10),
(65, 'Kepri', '01/01/2019', '31/1/2019', '249', '2', '6', '1', 'upload/3902830_1-product.jpg', 'good Kapad', '9', 'black,yellow', 50);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(3) NOT NULL,
  `state_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`) VALUES
(1, 'gujarat');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category_details_tbl`
--

CREATE TABLE `sub_category_details_tbl` (
  `sub_cat_id` int(11) NOT NULL,
  `sub_cat_name` varchar(100) NOT NULL,
  `sub_cat_desc` varchar(500) NOT NULL,
  `cat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(11, 'Television', 'Television', 3),
(15, 'Laptop', 'Laptop', 3),
(16, 'Sarees', 'sarees', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `gen` varchar(30) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `fname`, `lname`, `email`, `mobile`, `gen`, `pass`, `status`) VALUES
(1, 'viraj', 'sangani', 'sanganiviraj000@gmail.com', '8530569104', 'male', 'viraj@1234567890', 'Inactive'),
(2, 'mmn', 'mnmn', 'mnmnm', '56456', 'FeMale', 'nmnmn', 'Inactive'),
(3, 'Miteshkumar', 'mn', 'miteshdarji1112@gmail.com', '9687112390', 'FeMale', 'mitesh', 'Inactive'),
(4, 'vj', 'vj', 'viraj@gmail.com', '8787878', 'FeMale', 'viraj123', 'Inactive'),
(5, '', '', '', '', 'Male', '', 'Inactive'),
(9, 'viraj', 'sangani', 'sanganiviraj@gmail.com', '8530569104', 'Male', '1234567890', 'Inactive'),
(15, 'cvxcv', 'xcvxc', 'miteshdarji11412@gmail.com', '9687112390', 'Male', 'cvxcv', 'Inactive');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_details_tbl`
--
ALTER TABLE `admin_details_tbl`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brand_details_tbl`
--
ALTER TABLE `brand_details_tbl`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category_details_tbl`
--
ALTER TABLE `category_details_tbl`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `feedback_details_tbl`
--
ALTER TABLE `feedback_details_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_details_tbl`
--
ALTER TABLE `product_details_tbl`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `cat_id` (`cat_id`,`sub_cat_id`,`brand_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `sub_category_details_tbl`
--
ALTER TABLE `sub_category_details_tbl`
  ADD PRIMARY KEY (`sub_cat_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_details_tbl`
--
ALTER TABLE `admin_details_tbl`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brand_details_tbl`
--
ALTER TABLE `brand_details_tbl`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart_tbl`
--
ALTER TABLE `cart_tbl`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_details_tbl`
--
ALTER TABLE `category_details_tbl`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback_details_tbl`
--
ALTER TABLE `feedback_details_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_details_tbl`
--
ALTER TABLE `product_details_tbl`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_category_details_tbl`
--
ALTER TABLE `sub_category_details_tbl`
  MODIFY `sub_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

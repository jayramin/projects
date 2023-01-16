-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2017 at 08:50 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `b_agent_book_stock`
--

CREATE TABLE `b_agent_book_stock` (
  `AgentBookStockID` int(11) NOT NULL,
  `BookID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `BookPrice` int(11) NOT NULL,
  `AgentID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `AgentOrderStatus` varchar(5) NOT NULL,
  `is_active` varchar(11) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_agent_book_stock`
--

INSERT INTO `b_agent_book_stock` (`AgentBookStockID`, `BookID`, `CategoryID`, `BookPrice`, `AgentID`, `Quantity`, `Amount`, `AgentOrderStatus`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`) VALUES
(1, 9, 2, 200, 2, 5, 1000, 'S', 'Y', 1, 1, '2017-08-06 12:42:38', '2017-08-06'),
(2, 8, 3, 500, 2, 5, 2500, 'S', 'Y', 1, 1, '2017-08-06 12:42:44', '2017-08-06'),
(3, 5, 7, 5000, 2, 5, 25000, 'S', 'Y', 1, 1, '2017-08-06 01:43:14', '2017-08-06'),
(4, 5, 7, 5000, 2, 2, 10000, 'S', 'Y', 1, 1, '2017-08-06 01:43:22', '2017-08-06'),
(5, 4, 8, 200, 2, 5, 1000, 'S', 'Y', 1, 1, '2017-08-06 01:43:32', '2017-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `b_agent_book_stock_master`
--

CREATE TABLE `b_agent_book_stock_master` (
  `AgentBookStockMasterID` int(11) NOT NULL,
  `AgentBookStockID` varchar(50) NOT NULL,
  `BookID` varchar(100) NOT NULL,
  `AgentID` int(11) NOT NULL,
  `TotalBookQuantity` int(11) NOT NULL,
  `PayableAmount` int(11) NOT NULL,
  `is_active` varchar(11) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_agent_book_stock_master`
--

INSERT INTO `b_agent_book_stock_master` (`AgentBookStockMasterID`, `AgentBookStockID`, `BookID`, `AgentID`, `TotalBookQuantity`, `PayableAmount`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`) VALUES
(1, '1,2', '9,8', 2, 10, 3500, 'Y', 1, 1, '2017-08-06 00:00:00', '2017-08-06'),
(2, '3,4,5', '5,5,4', 2, 12, 36000, 'Y', 1, 1, '2017-08-06 00:00:00', '2017-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `b_agent_client`
--

CREATE TABLE `b_agent_client` (
  `ClientID` int(11) NOT NULL,
  `ClientName` varchar(200) NOT NULL,
  `ClientAddressLine1` varchar(200) NOT NULL,
  `ClientAddressLine2` varchar(200) NOT NULL,
  `ClientAddressArea` varchar(200) NOT NULL,
  `ClientAddressCity` varchar(200) NOT NULL,
  `ClientAddressPincode` int(11) NOT NULL,
  `ClientMobileNumber` varchar(15) NOT NULL,
  `ClientEmailID` varchar(200) NOT NULL,
  `AgentID` int(11) NOT NULL,
  `is_active` varchar(5) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_agent_client`
--

INSERT INTO `b_agent_client` (`ClientID`, `ClientName`, `ClientAddressLine1`, `ClientAddressLine2`, `ClientAddressArea`, `ClientAddressCity`, `ClientAddressPincode`, `ClientMobileNumber`, `ClientEmailID`, `AgentID`, `is_active`, `EntryBy`, `EntryDate`, `ModificationBy`, `ModificationDate`) VALUES
(1, 'New Client', 'address', 'address', 'area', 'city', 380013, '8798798787', 'email@id.com', 78, 'Y', 78, '2017-08-04', 0, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `b_area`
--

CREATE TABLE `b_area` (
  `AreaID` int(11) NOT NULL,
  `CountryID` int(11) NOT NULL,
  `StateID` int(11) NOT NULL,
  `CityID` int(11) NOT NULL,
  `AreaName` varchar(32) NOT NULL,
  `ZIPCode` int(6) NOT NULL,
  `is_active` varchar(4) NOT NULL COMMENT 'Y/N/D',
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is for area and zip code list';

--
-- Dumping data for table `b_area`
--

INSERT INTO `b_area` (`AreaID`, `CountryID`, `StateID`, `CityID`, `AreaName`, `ZIPCode`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`) VALUES
(1, 4, 1, 1, 'area', 123, 'Y', 0, 0, '2016-11-04', '2016-11-04'),
(2, 4, 1, 1, 'new', 124, 'Y', 0, 0, '2016-11-04', '2016-11-04'),
(3, 5, 2, 3, 'Ambawadi', 380, 'Y', 1, 0, '2016-12-06', '2016-12-06'),
(4, 5, 2, 3, 'Vastrapur', 380, 'Y', 1, 0, '2016-12-06', '2016-12-06'),
(5, 5, 2, 3, 'Vastrapur', 888, 'Y', 1, 0, '2016-12-06', '2016-12-06'),
(6, 1, 2, 4, 'Rander Road', 899, 'Y', 1, 0, '2016-12-07', '2016-12-07'),
(12, 1, 2, 3, 'asdf', 123456, 'Y', 1, 1, '2017-02-21', '2017-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `b_bookmaster`
--

CREATE TABLE `b_bookmaster` (
  `BookID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `BookTitle` varchar(200) NOT NULL,
  `BookPrice` int(11) NOT NULL,
  `BookMRP` int(11) NOT NULL,
  `BookDescription` text NOT NULL,
  `BookCode` varchar(20) NOT NULL,
  `BookAutherName` varchar(200) NOT NULL,
  `BookPublisher` varchar(200) NOT NULL,
  `BookImage` varchar(200) NOT NULL,
  `is_active` varchar(5) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_bookmaster`
--

INSERT INTO `b_bookmaster` (`BookID`, `CategoryID`, `BookTitle`, `BookPrice`, `BookMRP`, `BookDescription`, `BookCode`, `BookAutherName`, `BookPublisher`, `BookImage`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`) VALUES
(4, 8, 'Law Books', 200, 300, 'This is the book Description', '786', 'Jay Amin', 'Amin''s', '1490772806-13346371_1123994304308699_892634521086497979_o.jpg', 'Y', 1, 1, '2017-03-04', '2017-03-31'),
(5, 7, 'Supreme Court & Gujarat High Court Criminal Digest ', 5000, 5500, 'Supreme Court & Gujarat High Court Criminal Digest  For Refer all Criminal act regarding gujarat government  ', '5', 'Kishor R Trivedi', 'Bar Counciler', '1489037305-BookImage (12).jpeg', 'Y', 1, 1, '2017-03-09', '2017-03-31'),
(6, 8, 'Civil Minor Act', 600, 700, 'Civil Minor Act \r\nWritten by Jayendra M Shah, M Feyaz F. Shekh, J.K.Motiyani, Amit B. Soni ', '2', 'Jayendra M Shah, M Feyaz F. Shekh, J.K.Motiyani, Amit B. Soni ', 'Punhahl Law House', '1489127055-BookImage (1).jpeg', 'Y', 1, 1, '2017-03-10', '2017-03-31'),
(7, 9, 'Land-Law In Guajrat', 300, 330, 'Land-Law In Guajrat', '5', 'Shree C.K.Thakker, Najmuddin Meghani, Rajendra sinh, Subhash Advani', 'Punahal Law House', '1489209742-BookImage (3).jpeg', 'Y', 1, 1, '2017-03-11', '2017-03-31'),
(8, 3, 'new book', 500, 0, 'this is the short description', '6', 'punhal', 'PUNHAL', '1490934830-BookImage (5).jpeg', 'Y', 1, 1, '2017-03-31', '2017-03-31'),
(9, 2, 'New Book For Law', 200, 250, 'Punhal law House', '6', 'Punhal law House', 'Punhal law House', '1501350529-19990241_1461910850536643_8796329107640139895_n.jpg', 'Y', 1, 1, '2017-07-29', '2017-07-29'),
(10, 2, 'new book', 500, 600, 'Punhal law House', '4', 'Punhal law House', 'Punhal law House', '1501350573-19990241_1461910850536643_8796329107640139895_n.jpg', 'Y', 1, 1, '2017-07-29', '2017-07-29'),
(11, 9, 'Sit quia amet sint rem qui unde labore amet placeat quisquam magna irure totam sunt exercitationem dolore', 585, 0, 'Nam iusto excepturi quod laudantium aut modi omnis veritatis anim repellendus Reprehenderit', '0', 'Jana Wells', 'In dolores asperiores eum ex vel duis ab nobis sunt eum omnis error', '1501350660-19990241_1461910850536643_8796329107640139895_n.jpg', 'D', 1, 1, '2017-07-29', '2017-08-23'),
(12, 9, 'new punhal book', 600, 700, 'nothing', '5', 'punhal', 'punhal', '1501517417-ahmedabad-img.png', 'Y', 1, 1, '2017-07-31', '2017-07-31'),
(13, 2, 'new For Image', 5000, 6000, 'abc', '1', 'abc', 'abc', '1501865154-15894245_1211624728890918_8059511333705935162_n.jpg', 'Y', 1, 1, '2017-08-04', '2017-08-04');

-- --------------------------------------------------------

--
-- Table structure for table `b_cart`
--

CREATE TABLE `b_cart` (
  `CartID` int(11) NOT NULL,
  `BookID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Date` date NOT NULL,
  `OrderStatus` varchar(5) NOT NULL COMMENT '''P'' For Pendding',
  `is_active` varchar(5) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_cart`
--

INSERT INTO `b_cart` (`CartID`, `BookID`, `UserID`, `Quantity`, `Date`, `OrderStatus`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`) VALUES
(2, 9, 80, 1, '2017-08-04', 'S', 'Y', 1, 80, '2017-08-04', '2017-08-04'),
(3, 5, 42, 1, '2017-08-26', 'S', 'Y', 1, 42, '2017-08-26', '2017-08-26');

-- --------------------------------------------------------

--
-- Table structure for table `b_category`
--

CREATE TABLE `b_category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryTitle` varchar(200) NOT NULL,
  `is_active` varchar(5) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_category`
--

INSERT INTO `b_category` (`CategoryID`, `CategoryTitle`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`) VALUES
(2, 'Law', 'Y', 1, 1, '2017-03-04', '2017-03-04'),
(3, 'Women Empower', 'Y', 1, 1, '2017-03-04', '2017-03-04'),
(7, 'Criminal', 'Y', 1, 1, '2017-03-09', '2017-03-09'),
(8, 'Gujarat Civil Law', 'Y', 1, 1, '2017-03-10', '2017-03-10'),
(9, 'Land Law', 'Y', 1, 1, '2017-03-11', '2017-03-11');

-- --------------------------------------------------------

--
-- Table structure for table `b_city`
--

CREATE TABLE `b_city` (
  `CityID` int(11) NOT NULL,
  `CountryID` int(11) NOT NULL,
  `StateID` int(11) NOT NULL,
  `CityName` varchar(16) NOT NULL,
  `is_active` varchar(4) NOT NULL COMMENT 'Y/N/D',
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is for city list';

--
-- Dumping data for table `b_city`
--

INSERT INTO `b_city` (`CityID`, `CountryID`, `StateID`, `CityName`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`) VALUES
(3, 1, 2, 'Ahmedabad', 'Y', 1, 1, '2016-12-06', '2016-12-08'),
(4, 1, 2, 'Surat', 'Y', 1, 0, '2016-12-06', '2016-12-06'),
(5, 1, 2, 'Anand', 'Y', 1, 0, '2016-12-06', '2016-12-06'),
(6, 1, 2, 'City Name', 'D', 1, 1, '2016-12-06', '2016-12-08'),
(7, 1, 3, 'Jodhpur', 'Y', 1, 0, '2016-12-06', '2016-12-06'),
(8, 1, 2, 'Maheshana', 'Y', 1, 0, '2016-12-06', '2016-12-06'),
(9, 1, 2, 'name', 'Y', 1, 0, '2016-12-06', '2016-12-06'),
(10, 1, 2, 'Baroda', 'Y', 1, 0, '2016-12-07', '2016-12-07'),
(11, 1, 2, 'Surat', 'Y', 1, 0, '2016-12-07', '2016-12-07'),
(12, 1, 2, 'Rajkot', 'Y', 1, 0, '2016-12-07', '2016-12-07'),
(13, 1, 2, 'Junagadh', 'Y', 1, 0, '2016-12-07', '2016-12-07'),
(14, 1, 2, 'Kalol', 'Y', 1, 1, '2016-12-07', '2016-12-08'),
(15, 1, 2, 'Nadiad', 'Y', 1, 1, '2016-12-07', '2016-12-08'),
(16, 1, 2, 'Junagadh', 'Y', 1, 0, '2016-12-23', '2016-12-23'),
(17, 1, 2, 'ABC', 'Y', 1, 1, '2017-02-20', '2017-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `b_client_book_stock`
--

CREATE TABLE `b_client_book_stock` (
  `ClientBookStockID` int(11) NOT NULL,
  `BookID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `BookPrice` int(11) NOT NULL,
  `AgentID` int(11) NOT NULL,
  `ClientID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `ClientOrderStatus` varchar(5) NOT NULL,
  `is_active` varchar(11) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `b_client_book_stock_master`
--

CREATE TABLE `b_client_book_stock_master` (
  `ClientBookStockMasterID` int(11) NOT NULL,
  `ClientBookStockID` varchar(50) NOT NULL,
  `BookID` varchar(100) NOT NULL,
  `AgentID` int(11) NOT NULL,
  `ClientID` int(11) NOT NULL,
  `TotalBookQuantity` int(11) NOT NULL,
  `PayableAmount` int(11) NOT NULL,
  `is_active` varchar(11) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_client_book_stock_master`
--

INSERT INTO `b_client_book_stock_master` (`ClientBookStockMasterID`, `ClientBookStockID`, `BookID`, `AgentID`, `ClientID`, `TotalBookQuantity`, `PayableAmount`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`) VALUES
(1, '', '8', 78, 1, 5, 2500, 'Y', 1, 0, '2017-08-04 00:00:00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `b_country`
--

CREATE TABLE `b_country` (
  `CountryID` int(11) NOT NULL,
  `CountryName` varchar(16) NOT NULL,
  `is_active` varchar(11) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is for country list';

--
-- Dumping data for table `b_country`
--

INSERT INTO `b_country` (`CountryID`, `CountryName`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`) VALUES
(1, 'India', 'Y', 1, 1, '2016-12-06', '2017-01-06'),
(6, 'United States', 'Y', 1, 1, '2016-12-06', '2016-12-08'),
(8, 'Canada', 'Y', 1, 1, '2016-12-06', '2016-12-07'),
(9, 'South Africa', 'Y', 1, 0, '2016-12-07', '2016-12-07'),
(10, 'U.K.', 'Y', 1, 0, '2016-12-07', '2016-12-07'),
(11, 'Srilanka', 'Y', 1, 0, '2016-12-07', '2016-12-07'),
(13, 'Sweden', 'D', 1, 1, '2016-12-07', '2016-12-08'),
(14, 'India', 'D', 1, 1, '2016-12-13', '2016-12-13');

-- --------------------------------------------------------

--
-- Table structure for table `b_credit_notes`
--

CREATE TABLE `b_credit_notes` (
  `CreditNoteID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BookID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` varchar(200) DEFAULT NULL,
  `Discount` varchar(200) NOT NULL,
  `NetAmount` varchar(200) NOT NULL,
  `GrandTotal` varchar(200) NOT NULL,
  `Date` date NOT NULL,
  `is_active` varchar(200) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_credit_notes`
--

INSERT INTO `b_credit_notes` (`CreditNoteID`, `UserID`, `BookID`, `Quantity`, `Price`, `Discount`, `NetAmount`, `GrandTotal`, `Date`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`) VALUES
(1, 2, 8, 2, NULL, '5', '950', '', '2017-08-06', 'Y', 1, 1, '2017-08-06', '2017-08-06'),
(2, 3, 9, 2, NULL, '0', '400', '', '2017-08-06', 'Y', 1, 1, '2017-08-06', '2017-08-06'),
(3, 42, 8, 2, NULL, '0', '1000', '', '2017-08-06', 'Y', 1, 1, '2017-08-06', '2017-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `b_expense`
--

CREATE TABLE `b_expense` (
  `ExpenseID` int(11) NOT NULL,
  `ExpenseTitle` varchar(200) NOT NULL,
  `ExpenseDescription` text NOT NULL,
  `ExpenseDate` date NOT NULL,
  `ExpenseAmount` int(11) NOT NULL,
  `is_active` varchar(5) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_expense`
--

INSERT INTO `b_expense` (`ExpenseID`, `ExpenseTitle`, `ExpenseDescription`, `ExpenseDate`, `ExpenseAmount`, `is_active`, `EntryBy`, `EntryDate`, `ModificationBy`, `ModificationDate`) VALUES
(1, 'abcd', 'abc', '2017-03-14', 50000, 'Y', 1, '2017-03-14', 2, '2017-03-14');

-- --------------------------------------------------------

--
-- Table structure for table `b_general_user_balance`
--

CREATE TABLE `b_general_user_balance` (
  `GeneralUserBalanceID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL COMMENT 'UserID',
  `OpeningBalance` int(11) NOT NULL,
  `BalanceType` varchar(20) NOT NULL COMMENT 'Cash Or Cheque',
  `ChequeNo` int(11) DEFAULT NULL,
  `BankName` varchar(100) DEFAULT NULL,
  `Comment` text,
  `Flag` varchar(100) DEFAULT 'General' COMMENT 'for is opening balance or not ',
  `Date` datetime NOT NULL,
  `is_active` varchar(5) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationBY` int(11) NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_general_user_balance`
--

INSERT INTO `b_general_user_balance` (`GeneralUserBalanceID`, `UserID`, `OpeningBalance`, `BalanceType`, `ChequeNo`, `BankName`, `Comment`, `Flag`, `Date`, `is_active`, `EntryBy`, `EntryDate`, `ModificationBY`, `ModificationDate`) VALUES
(1, 45, 2500, 'Cash', 0, 'null', 'Debit Entry of general user ', 'Payment', '2017-08-12 00:00:00', 'Y', 1, '2017-08-12', 1, '2017-08-12'),
(2, 46, 800, 'Cash', 0, 'null', 'Debit Entry of general user ', 'Payment', '2017-08-12 00:00:00', 'Y', 1, '2017-08-12', 1, '2017-08-12'),
(3, 45, 5000, 'Cash', 0, 'null', 'Debit Entry of general user ', 'Payment', '2017-08-12 00:00:00', 'Y', 1, '2017-08-12', 1, '2017-08-12'),
(4, 46, 100, 'Cash', NULL, NULL, 'no', 'Payment', '2017-08-15 00:00:00', 'Y', 1, '2017-08-23', 1, '2017-08-23'),
(5, 46, 100, 'Cash', NULL, NULL, '', 'Payment', '2017-08-22 00:00:00', 'Y', 1, '2017-08-23', 1, '2017-08-23'),
(6, 46, 100, 'Cash', NULL, NULL, 'no', 'Payment', '2017-08-25 00:00:00', 'Y', 1, '2017-08-25', 1, '2017-08-25'),
(7, 45, 100, 'Cash', NULL, NULL, 'no', 'Payment', '2017-08-26 00:00:00', 'Y', 1, '2017-08-26', 1, '2017-08-26');

-- --------------------------------------------------------

--
-- Table structure for table `b_general_user_invoice_balance_rele`
--

CREATE TABLE `b_general_user_invoice_balance_rele` (
  `UserInvoiceBalanceReleID` int(11) NOT NULL,
  `UserBookStockMasterID` varchar(50) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `PayableAmount` int(11) NOT NULL,
  `is_active` varchar(11) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_general_user_invoice_balance_rele`
--

INSERT INTO `b_general_user_invoice_balance_rele` (`UserInvoiceBalanceReleID`, `UserBookStockMasterID`, `UserID`, `Date`, `PayableAmount`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`) VALUES
(1, '17', 45, '2017-08-12', 2500, 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12'),
(2, '18', 45, '2017-08-12', 1000, 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12'),
(3, '19', 45, '2017-08-12', 2500, 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12'),
(4, '20', 46, '2017-08-12', 800, 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12'),
(5, '21', 45, '2017-08-12', 5000, 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12');

-- --------------------------------------------------------

--
-- Table structure for table `b_menus`
--

CREATE TABLE `b_menus` (
  `MenuID` int(11) NOT NULL,
  `OrderNo` int(11) NOT NULL,
  `Name` varchar(64) NOT NULL,
  `Description` varchar(128) NOT NULL,
  `MenuURL` varchar(100) NOT NULL,
  `MenuAlias` varchar(100) NOT NULL,
  `MenuType` varchar(32) NOT NULL,
  `Level` int(11) NOT NULL,
  `ParentID` int(11) NOT NULL,
  `IconClass` varchar(100) NOT NULL,
  `is_active` varchar(8) NOT NULL COMMENT 'Y/N/D',
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is for admin panel menu list';

--
-- Dumping data for table `b_menus`
--

INSERT INTO `b_menus` (`MenuID`, `OrderNo`, `Name`, `Description`, `MenuURL`, `MenuAlias`, `MenuType`, `Level`, `ParentID`, `IconClass`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`) VALUES
(1, 2, 'Location', 'Menu For Location', 'view_location.php', 'view_location', 'main', 1, 0, 'fa fa-map-marker ', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(2, 1, 'Home', 'home', 'home.php', 'home', 'main', 1, 0, 'fa fa-dashboard', 'Y', 1, 0, '0000-00-00', '0000-00-00'),
(3, 1, 'State', 'Menu For State', 'view_state.php', 'view_state', 'main', 2, 1, 'fa fa-map-marker ', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(4, 1, 'City', 'Menu For City', 'view_city.php', 'view_city', 'main', 2, 1, 'fa fa-map-marker ', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(5, 1, 'Area', 'Menu For Area', 'view_area.php', 'view_area', 'main', 2, 1, 'fa fa-map-marker ', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(6, 3, 'Book Master', 'Menu For Book', 'view_book_master.php', 'view_book_master', 'main', 1, 0, 'fa fa-book', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(7, 3, 'Category', 'Menu For Category', 'view_category_master.php', 'view_category_master', 'main', 2, 6, 'fa fa-bars', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(8, 3, 'Quantity Master', 'Menu For Quantity', 'view_book_quantity.php', 'view_book_quantity', 'main', 2, 6, 'fa fa-shopping-cart ', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(9, 3, 'Users', 'Menu For Users List', 'view_users_master.php', 'view_users_master', 'main', 1, 0, 'fa fa-users', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(10, 3, 'Placed Orders', 'Menu For Placed Orders List', 'view_plcaed_order_list.php', 'view_plcaed_order_list', 'main', 1, 0, 'fa fa-check', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(11, 3, 'Orders Details', 'Menu For Placed Orders Details', 'view_order_wise_details.php', 'view_order_wise_details', 'main', 0, 0, 'fa fa-list', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(12, 3, 'Expense Details', 'Menu For Expense Details', 'view_expense_details.php', 'view_expense_details', 'main', 1, 0, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(13, 3, 'Agents', 'Menu For Agents Details', 'view_agents_details.php', 'view_agents_details', 'main', 1, 0, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(14, 3, 'Book Seller', 'Menu For Retailers Details', 'view_retailers_details.php', 'view_retailers_details', 'main', 1, 0, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(15, 3, 'Client', 'Menu For Add Client', 'view_add_clients.php', 'view_add_clients', 'main', 1, 0, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(16, 3, 'Agent Stock', 'Menu For Agent Stock', 'view_agent_stock.php', 'view_agent_stock', 'main', 1, 0, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(17, 3, 'Send Book To Agent', 'Menu For Send Book To Agent', 'view_agent_books.php', 'view_agent_books', 'main', 2, 13, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(18, 3, 'Send Book To Agent', 'Menu For Send Book To Agent', 'send_book_to_agent.php', 'send_book_to_agent', 'main', 0, 0, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(19, 3, 'view_agent_books_orders', 'Menu For Send Book To Agent', 'view_agent_books_orders.php', 'view_agent_books_orders', 'main', 0, 0, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(20, 2, 'Book Seller Balance', 'Menu For Retailers Details', 'view_retailers_balance_details.php', 'view_retailers_balance_details', 'main', 2, 14, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(21, 1, 'Add New Book Seller', 'Menu For Retailers Details', 'view_retailers_details.php', 'view_retailers_details', 'main', 2, 14, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(22, 3, 'Send Book To Book Seller', 'Menu For Send Book To Retailer', 'view_retailer_books.php', 'view_retailer_books', 'main', 2, 14, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(23, 3, 'Send Book To Book Seller', 'Menu For Send Book To Retailer', 'send_book_to_retailer.php', 'send_book_to_retailer', 'main', 0, 0, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(24, 3, 'view_retailer_books_orders', 'Menu For Send Book To Agent', 'view_retailer_books_orders.php', 'view_retailer_books_orders', 'main', 0, 0, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(25, 1, 'Add Agents', 'Menu For Agents Details', 'view_agents_details.php', 'view_agents_details', 'main', 2, 13, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(26, 1, 'Sell Book', 'Menu For sell books on behalf of Agents', 'view_sell_books_behalf_of_agent.php', 'view_sell_books_behalf_of_agent', 'main', 2, 13, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(27, 3, 'Book Seller Payment', 'Menu For Retailers payment Details', 'view_retailers_payment.php', 'view_retailers_payment', 'main', 1, 0, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(28, 3, 'Book Seller Placed Orders ', 'Menu For Placed Retailer Orders List', 'view_retailer_plcaed_order_list.php', 'view_retailer_plcaed_order_list', 'main', 2, 14, 'fa fa-check', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(29, 3, 'view_retailers_wise_order_details', 'view_retailers_wise_order_details', 'view_retailers_wise_order_details.php', 'view_retailers_wise_order_details', 'main', 0, 0, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(30, 10, 'Retailer Management', 'Menu For General Users Details', 'view_general_user_details.php', 'view_general_user_details', 'main', 1, 0, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(36, 1, 'Generate New Bill', 'Menu For General User Details', 'view_general_user_details.php', 'view_general_user_details', 'main', 2, 30, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(37, 1, 'Payment Rupee', 'Menu For Make Payment For', 'view_general_user_make_payment.php', 'view_general_user_make_payment', 'main', 2, 30, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(38, 1, 'Retailers Balance Sheet', 'Menu ForGeneral User Balance Sheet', 'general_user_invoice.php', 'general_user_invoice', 'main', 2, 30, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(39, 11, 'Credit Note', 'Menu For Credit Note', 'view_credit_note.php', 'view_credit_note', 'main', 1, 0, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(40, 12, 'Reports', 'Menu For Reports', 'view_reports.php', 'view_reports', 'main', 1, 0, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(41, 12, 'Book Sell Reports', 'Menu For Book Sell Reports', 'view_book_sell_reports.php', 'view_book_sell_reports', 'main', 2, 40, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(42, 11, 'Send SMS', 'Menu For Send SMS', 'view_sms.php', 'view_sms', 'main', 1, 0, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(43, 11, 'Send SMS new', 'Menu For Send SMS', 'view_sms_send.php', 'view_sms_send', 'main', 1, 0, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(44, 1, 'Book Master', 'Menu For Book', 'view_book_master.php', 'view_book_master', 'main', 2, 6, 'fa fa-book', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(45, 2, 'Opening Balance', 'Menu For Bookseller Opening Balance Details', 'view_retailers_opening_balance_details.php', 'view_retailers_opening_balance_details', 'main', 2, 14, 'fa fa-money', 'Y', 1, 0, '2017-02-15', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `b_menu_access`
--

CREATE TABLE `b_menu_access` (
  `AccessID` int(11) NOT NULL,
  `RoleID` int(100) NOT NULL,
  `MenuID` varchar(512) NOT NULL,
  `is_active` varchar(8) NOT NULL COMMENT 'Y/N/D',
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is for menu access by different roles';

--
-- Dumping data for table `b_menu_access`
--

INSERT INTO `b_menu_access` (`AccessID`, `RoleID`, `MenuID`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`) VALUES
(1, 1, '1,2,3,4,5,6,7,8,9,10,11,12,14,17,18,19,20,21,22,23,24,25,26,28,29,30,36,37,38,39,40,41,43,44,45', 'Y', 1, 0, '2017-02-15', '0000-00-00'),
(2, 2, '2,15,16', 'Y', 1, 0, '2017-02-15', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `b_order_details`
--

CREATE TABLE `b_order_details` (
  `OrderDetailsID` int(11) NOT NULL,
  `OrderNo` int(11) NOT NULL,
  `BookID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `OrderPrice` varchar(20) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `PurchaseDate` date NOT NULL,
  `Status` varchar(10) NOT NULL,
  `is_active` varchar(5) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_order_details`
--

INSERT INTO `b_order_details` (`OrderDetailsID`, `OrderNo`, `BookID`, `UserID`, `OrderPrice`, `Quantity`, `PurchaseDate`, `Status`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`) VALUES
(1, 22446, 9, 80, '200', 1, '2017-08-04', 'P', 'Y', 80, 0, '2017-08-04', '0000-00-00'),
(2, 69402, 5, 42, '5000', 1, '2017-08-26', 'P', 'Y', 42, 0, '2017-08-26', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `b_order_master`
--

CREATE TABLE `b_order_master` (
  `OrderID` int(11) NOT NULL,
  `BookID` int(11) DEFAULT NULL,
  `OrderNo` int(11) NOT NULL,
  `OrderDate` date NOT NULL,
  `UserID` int(11) NOT NULL,
  `OrderPrice` varchar(20) NOT NULL,
  `AddressID` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `OrderDeliveryStatus` varchar(200) NOT NULL,
  `is_active` varchar(5) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_order_master`
--

INSERT INTO `b_order_master` (`OrderID`, `BookID`, `OrderNo`, `OrderDate`, `UserID`, `OrderPrice`, `AddressID`, `Quantity`, `OrderDeliveryStatus`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`) VALUES
(1, NULL, 22446, '2017-08-04', 80, '200', 1, NULL, 'P', 'Y', 80, 0, '2017-08-04', '0000-00-00'),
(2, NULL, 69402, '2017-08-26', 42, '5000', 10, NULL, 'P', 'Y', 42, 0, '2017-08-26', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `b_retailer_balance`
--

CREATE TABLE `b_retailer_balance` (
  `RetailerBalanceID` int(11) NOT NULL,
  `RetailerID` int(11) NOT NULL COMMENT 'UserID',
  `OpeningBalance` int(11) NOT NULL,
  `BalanceType` varchar(20) NOT NULL COMMENT 'Cash Or Cheque',
  `ChequeNo` int(11) DEFAULT NULL,
  `BankName` varchar(100) DEFAULT NULL,
  `Comment` text,
  `Flag` varchar(100) DEFAULT 'General' COMMENT 'for is opening balance or not ',
  `Date` datetime NOT NULL,
  `is_active` varchar(5) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationBY` int(11) NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_retailer_balance`
--

INSERT INTO `b_retailer_balance` (`RetailerBalanceID`, `RetailerID`, `OpeningBalance`, `BalanceType`, `ChequeNo`, `BankName`, `Comment`, `Flag`, `Date`, `is_active`, `EntryBy`, `EntryDate`, `ModificationBY`, `ModificationDate`) VALUES
(1, 43, 5000, 'Cash', NULL, NULL, 'asd', 'Payment', '2017-07-29 00:00:00', 'Y', 1, '2017-07-29', 1, '2017-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `b_retailer_balance_transaction`
--

CREATE TABLE `b_retailer_balance_transaction` (
  `BalanceTransactionID` int(11) NOT NULL,
  `RetailerBookStockMasterID` int(11) NOT NULL,
  `RetailerID` int(11) NOT NULL,
  `RetailerBalanceID` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  `ChequeNo` int(11) NOT NULL,
  `CreditAmount` int(11) NOT NULL,
  `InvoiceDate` datetime NOT NULL,
  `InvoiceNo` int(11) NOT NULL,
  `DebitAmount` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `b_retailer_book_stock`
--

CREATE TABLE `b_retailer_book_stock` (
  `RetailerBookStockID` int(11) NOT NULL,
  `BookID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `BookPrice` int(11) NOT NULL,
  `RetailerID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `RetailerOrderStatus` varchar(5) NOT NULL,
  `is_active` varchar(11) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_retailer_book_stock`
--

INSERT INTO `b_retailer_book_stock` (`RetailerBookStockID`, `BookID`, `CategoryID`, `BookPrice`, `RetailerID`, `Quantity`, `Amount`, `RetailerOrderStatus`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`) VALUES
(1, 9, 2, 200, 43, 5, 1000, 'S', 'Y', 1, 1, '2017-07-29 11:56:46', '2017-07-29'),
(2, 5, 7, 5000, 43, 2, 10000, 'S', 'Y', 1, 1, '2017-07-29 11:56:55', '2017-07-29'),
(3, 5, 7, 5000, 43, 5, 25000, 'S', 'Y', 1, 1, '2017-07-29 11:58:02', '2017-07-29'),
(4, 4, 8, 200, 43, 5, 1000, 'S', 'Y', 1, 1, '2017-07-29 11:58:09', '2017-07-29'),
(5, 8, 3, 500, 43, 5, 2500, 'S', 'Y', 1, 1, '2017-07-29 11:58:41', '2017-07-29'),
(6, 8, 3, 500, 43, 5, 2500, 'P', 'Y', 1, 1, '2017-08-18 11:32:35', '2017-08-18');

-- --------------------------------------------------------

--
-- Table structure for table `b_retailer_book_stock_master`
--

CREATE TABLE `b_retailer_book_stock_master` (
  `RetailerBookStockMasterID` int(11) NOT NULL,
  `RetailerBookStockID` varchar(50) NOT NULL,
  `BookID` varchar(100) NOT NULL,
  `RetailerID` int(11) NOT NULL,
  `TotalBookQuantity` int(11) NOT NULL,
  `PayableAmount` int(11) NOT NULL,
  `Type` varchar(200) NOT NULL,
  `is_active` varchar(11) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `ModificationDate` date NOT NULL,
  `OrderDeliveryStatus` varchar(255) NOT NULL DEFAULT 'P'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_retailer_book_stock_master`
--

INSERT INTO `b_retailer_book_stock_master` (`RetailerBookStockMasterID`, `RetailerBookStockID`, `BookID`, `RetailerID`, `TotalBookQuantity`, `PayableAmount`, `Type`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`, `OrderDeliveryStatus`) VALUES
(1, '1,2', '9,5', 43, 7, 11000, '', 'Y', 1, 1, '2017-07-29 00:00:00', '2017-07-29', 'P'),
(2, '3,4', '5,4', 43, 10, 26000, '', 'Y', 1, 1, '2017-07-29 00:00:00', '2017-07-29', 'P'),
(3, '5', '8', 43, 5, 2500, '', 'Y', 1, 1, '2017-07-29 00:00:00', '2017-07-29', 'P'),
(4, '0', '0', 43, 0, 123, 'Opening Balance', 'Y', 1, 1, '2017-08-16 00:00:00', '2017-08-16', 'P');

-- --------------------------------------------------------

--
-- Table structure for table `b_retailer_invoice_balance_rele`
--

CREATE TABLE `b_retailer_invoice_balance_rele` (
  `InvoiceBalanceReleID` int(11) NOT NULL,
  `RetailerBookStockMasterID` varchar(50) NOT NULL,
  `RetailerID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `PayableAmount` int(11) NOT NULL,
  `is_active` varchar(11) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `ModificationDate` date NOT NULL,
  `Type` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_retailer_invoice_balance_rele`
--

INSERT INTO `b_retailer_invoice_balance_rele` (`InvoiceBalanceReleID`, `RetailerBookStockMasterID`, `RetailerID`, `Date`, `PayableAmount`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`, `Type`) VALUES
(1, '1', 43, '2017-07-29', 11000, 'Y', 1, 1, '2017-07-29 00:00:00', '2017-07-29', NULL),
(2, '2', 43, '2017-07-29', 26000, 'Y', 1, 1, '2017-07-29 00:00:00', '2017-07-29', NULL),
(3, '3', 43, '2017-07-29', 2500, 'Y', 1, 1, '2017-07-29 00:00:00', '2017-07-29', NULL),
(4, '0', 43, '2017-08-17', 100, 'Y', 1, 1, '2017-08-17 00:00:00', '2017-08-17', 'Opening Balance'),
(5, '0', 44, '2017-08-17', 50000, 'Y', 1, 1, '2017-08-17 00:00:00', '2017-08-17', 'Opening Balance');

-- --------------------------------------------------------

--
-- Table structure for table `b_retailer_payment`
--

CREATE TABLE `b_retailer_payment` (
  `RetailerPaymentID` int(11) NOT NULL,
  `RetailerID` int(11) NOT NULL COMMENT 'UserID',
  `Balance` int(11) NOT NULL,
  `BalanceType` varchar(20) NOT NULL COMMENT 'Cash Or Cheque',
  `ChequeNo` int(11) DEFAULT NULL,
  `BankName` varchar(100) DEFAULT NULL,
  `Comment` text,
  `Flag` varchar(100) DEFAULT 'General' COMMENT 'for is opening balance or not ',
  `Date` datetime NOT NULL,
  `is_active` varchar(5) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationBY` int(11) NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `b_sms`
--

CREATE TABLE `b_sms` (
  `SmsID` int(11) NOT NULL,
  `SmsText` text NOT NULL,
  `User` varchar(255) NOT NULL,
  `RoleID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `b_state`
--

CREATE TABLE `b_state` (
  `StateID` int(11) NOT NULL,
  `CountryID` int(11) NOT NULL,
  `StateName` varchar(32) NOT NULL,
  `StateCode` varchar(8) NOT NULL,
  `is_active` varchar(4) NOT NULL COMMENT 'Y/N/D',
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is for list of states';

--
-- Dumping data for table `b_state`
--

INSERT INTO `b_state` (`StateID`, `CountryID`, `StateName`, `StateCode`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`) VALUES
(1, 4, 'tats', '', 'D', 0, 1, '2016-11-04', '2016-12-06'),
(2, 1, 'Gujarat', '', 'Y', 1, 1, '2016-12-06', '2016-12-08'),
(3, 1, 'Rajasthan', '', 'Y', 1, 1, '2016-12-06', '2016-12-08'),
(4, 1, 'Madhya Pradesh', '', 'Y', 1, 1, '2016-12-06', '2016-12-06'),
(5, 1, 'J & K', '', 'Y', 1, 1, '2016-12-06', '2016-12-08'),
(6, 1, 'Kerala', '', 'Y', 1, 0, '2016-12-07', '2016-12-07'),
(7, 1, 'Karnataka', '', 'Y', 1, 0, '2016-12-07', '2016-12-07'),
(8, 1, 'Punjab', '', 'Y', 1, 0, '2016-12-07', '2016-12-07'),
(9, 12, 'Karachi', '', 'Y', 1, 1, '2016-12-07', '2016-12-07'),
(10, 1, 'Aasam', '', 'Y', 1, 0, '2016-12-07', '2016-12-07'),
(11, 6, 'asdfasdf', '', 'Y', 1, 1, '2016-12-07', '2016-12-08'),
(12, 1, 'Bihar', '', 'Y', 1, 1, '2016-12-08', '2016-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `b_stock_master`
--

CREATE TABLE `b_stock_master` (
  `StockID` int(11) NOT NULL,
  `BookID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Date` date NOT NULL,
  `is_active` varchar(11) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationDate` date NOT NULL,
  `purchase_amount` varchar(20) NOT NULL COMMENT 'actual purchase cost',
  `PurchaseDate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_stock_master`
--

INSERT INTO `b_stock_master` (`StockID`, `BookID`, `CategoryID`, `Quantity`, `Date`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`, `purchase_amount`, `PurchaseDate`) VALUES
(1, 9, 2, 200, '2017-07-29', 'Y', 1, 1, '2017-07-29', '2017-07-29', '', ''),
(2, 12, 9, 200, '2017-07-31', 'Y', 1, 1, '2017-07-31', '2017-07-31', '', ''),
(3, 13, 2, 500, '2017-08-04', 'Y', 1, 1, '2017-08-04', '2017-08-04', '', ''),
(4, 7, 9, 200, '2017-08-25', 'Y', 1, 1, '2017-08-25', '2017-08-25', '20000', '');

-- --------------------------------------------------------

--
-- Table structure for table `b_stock_transaction`
--

CREATE TABLE `b_stock_transaction` (
  `StockTransID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `BookID` int(11) NOT NULL,
  `Qauntity` int(11) NOT NULL,
  `OrderDate` date NOT NULL,
  `is_active` varchar(5) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `b_user`
--

CREATE TABLE `b_user` (
  `UserID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL COMMENT '1 For Admin , 2 For Agent, 3For Retailers,4 WEb Users,5For General User',
  `UserName` varchar(200) NOT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `MobileNumber` varchar(15) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Address` text NOT NULL,
  `Gender` varchar(5) DEFAULT NULL,
  `ProfilePicture` varchar(200) DEFAULT NULL,
  `Terms` varchar(5) DEFAULT NULL,
  `is_active` varchar(5) NOT NULL,
  `EntryBy` int(11) DEFAULT NULL,
  `EntryDate` date DEFAULT NULL,
  `ModificationBy` int(11) DEFAULT NULL,
  `ModificationDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_user`
--

INSERT INTO `b_user` (`UserID`, `RoleID`, `UserName`, `Password`, `MobileNumber`, `Email`, `Address`, `Gender`, `ProfilePicture`, `Terms`, `is_active`, `EntryBy`, `EntryDate`, `ModificationBy`, `ModificationDate`) VALUES
(1, 1, 'Admin', 'qgSvjXor41GuZK4tlUuMWNfUKQvLXumtWd2iEVXS7uM=', '0', 'vidofuzuxi@gmail.com', '', 'Male', '', 'on', 'Y', NULL, NULL, 2, '2017-03-09'),
(2, 2, 'bhargav', 'qgSvjXor41GuZK4tlUuMWNfUKQvLXumtWd2iEVXS7uM=', '9898417397', 'bhargav@gmail.com', '', 'Male', 'placeholder1.png', 'on', 'Y', NULL, NULL, NULL, NULL),
(3, 2, 'New', 'qgSvjXor41GuZK4tlUuMWNfUKQvLXumtWd2iEVXS7uM=', '1237894560', 'new@gmail.com', '', 'Male', '', 'on', 'Y', NULL, NULL, NULL, NULL),
(41, 5, 'Final ', 'WcAQ45MTYHyIMVwrmytbPEx3L33hbq3HcDganwRZIWc=', '0', 'abc@123', '', 'Male', '1489300376-career image2.jpg', 'on', 'Y', NULL, NULL, NULL, NULL),
(42, 4, 'Jay', 'qgSvjXor41GuZK4tlUuMWNfUKQvLXumtWd2iEVXS7uM=', '1234567890', 'fuvacipol@yahoo.com', '', 'Male', '1490338942-p7.jpg', '', 'Y', 1, '2017-03-19', 1, '2017-03-24'),
(43, 3, 'Ronit', 'Czp9w3g6CmMPnMVXxL0CzJklAbjiXXVj0k5P2Ws7VLE=', '2147483647', 'ronitcom4u@gmail.com', '', 'Male', '', '', 'Y', 1, '2017-03-24', 1, '2017-03-24'),
(44, 3, 'Rajput', 'X5G5Z9LG11VHmq6bv9xVeMjfZz614xJNjbelnLFJ65Q=', '45687912', 'com4u@gmail.com', '', 'Femal', '', '', 'Y', 1, '2017-03-24', 1, '2017-03-24'),
(45, 5, 'new', NULL, '9898989898', 'email@gmail.com', '', NULL, NULL, NULL, 'Y', 1, '2017-08-12', NULL, NULL),
(46, 5, 'nsadfg', NULL, '9898989899', 'SDF@zdf.dfg', '', NULL, NULL, NULL, 'Y', 1, '2017-08-12', NULL, NULL),
(47, 3, '', '93xf8PwxggMahOLhrcY96X6t5CYdWPZ7lk9RlvmKDcs=', '', '', '', 'Male', '', NULL, 'D', 1, '2017-08-27', 1, '2017-08-27');

-- --------------------------------------------------------

--
-- Table structure for table `b_user_address`
--

CREATE TABLE `b_user_address` (
  `AddressID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `AddressLine1` text NOT NULL,
  `AddressLine2` text NOT NULL,
  `Area` varchar(50) NOT NULL,
  `CityID` int(11) NOT NULL,
  `Pincode` int(11) NOT NULL,
  `MobileNumber` varchar(15) NOT NULL,
  `EmailID` varchar(255) DEFAULT NULL,
  `is_active` varchar(5) NOT NULL,
  `EntryBY` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_user_address`
--

INSERT INTO `b_user_address` (`AddressID`, `UserID`, `AddressLine1`, `AddressLine2`, `Area`, `CityID`, `Pincode`, `MobileNumber`, `EmailID`, `is_active`, `EntryBY`, `EntryDate`, `ModificationBy`, `ModificationDate`) VALUES
(2, 76, '123', '123', '321', 3, 380121, '9898989898', NULL, 'Y', 1, '2017-07-28', 0, '0000-00-00'),
(3, 43, 'new address', 'address', 'area', 3, 380013, '9898984545', NULL, 'Y', 1, '2017-07-29', 1, '2017-07-29'),
(4, 78, 'Myaddress', 'new', 'area', 3, 380013, '9898989845', NULL, 'Y', 1, '2017-08-04', 1, '2017-08-04'),
(5, 79, 'ad', 'ad', 'ad', 3, 123132, '9999999999', NULL, 'Y', 1, '2017-08-04', 0, '0000-00-00'),
(6, 80, 'addreess', 'new', 'area', 3, 383213, '1234567890', NULL, 'Y', 80, '2017-08-04', 80, '2017-08-04'),
(7, 2, 'address', 'addres', 'AREA', 3, 380000, '9879879877', NULL, 'Y', 1, '2017-08-06', 1, '2017-08-06'),
(8, 45, 'add', 'add', 'ad', 3, 321231, '9898989898', NULL, 'Y', 1, '2017-08-12', 0, '0000-00-00'),
(9, 46, 'ZXD', 'ZXCV', 'DFG', 3, 456456, '9898989899', NULL, 'Y', 1, '2017-08-12', 0, '0000-00-00'),
(10, 42, 'ADDRESS', 'NEW', '123', 3, 123123, '1235468790', NULL, 'Y', 42, '2017-08-26', 1, '2017-08-26');

-- --------------------------------------------------------

--
-- Table structure for table `b_user_balance`
--

CREATE TABLE `b_user_balance` (
  `UserBalanceID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL COMMENT 'UserID',
  `Balance` int(11) NOT NULL,
  `BalanceType` varchar(200) DEFAULT NULL,
  `ChequeNo` int(11) DEFAULT NULL,
  `BankName` varchar(100) DEFAULT NULL,
  `Comment` text,
  `Flag` varchar(100) DEFAULT 'General' COMMENT 'for is opening balance or not ',
  `Date` datetime NOT NULL,
  `is_active` varchar(5) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `EntryDate` date NOT NULL,
  `ModificationBY` int(11) NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_user_balance`
--

INSERT INTO `b_user_balance` (`UserBalanceID`, `UserID`, `Balance`, `BalanceType`, `ChequeNo`, `BankName`, `Comment`, `Flag`, `Date`, `is_active`, `EntryBy`, `EntryDate`, `ModificationBY`, `ModificationDate`) VALUES
(1, 45, 2500, NULL, NULL, NULL, NULL, 'General', '0000-00-00 00:00:00', 'Y', 1, '2017-08-12', 1, '2017-08-12'),
(2, 45, 1000, NULL, NULL, NULL, NULL, 'General', '0000-00-00 00:00:00', 'Y', 1, '2017-08-12', 1, '2017-08-12'),
(3, 45, 2500, NULL, NULL, NULL, NULL, 'General', '0000-00-00 00:00:00', 'Y', 1, '2017-08-12', 1, '2017-08-12'),
(4, 46, 800, NULL, NULL, NULL, NULL, 'General', '0000-00-00 00:00:00', 'Y', 1, '2017-08-12', 1, '2017-08-12'),
(5, 45, 5000, NULL, NULL, NULL, NULL, 'General', '0000-00-00 00:00:00', 'Y', 1, '2017-08-12', 1, '2017-08-12');

-- --------------------------------------------------------

--
-- Table structure for table `b_user_book_stock`
--

CREATE TABLE `b_user_book_stock` (
  `UserBookStockID` int(11) NOT NULL,
  `BookID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `BookPrice` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT '0',
  `Amount` int(11) NOT NULL,
  `UserOrderStatus` varchar(5) NOT NULL,
  `is_active` varchar(11) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `ModificationDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_user_book_stock`
--

INSERT INTO `b_user_book_stock` (`UserBookStockID`, `BookID`, `CategoryID`, `BookPrice`, `UserID`, `Quantity`, `discount`, `Amount`, `UserOrderStatus`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`) VALUES
(1, 9, 2, 200, 76, 5, 0, 1000, 'D', 'Y', 1, 1, '2017-07-31 10:43:54', '2017-07-31'),
(2, 12, 9, 600, 76, 5, 0, 3000, 'D', 'Y', 1, 1, '2017-07-31 10:44:01', '2017-07-31'),
(3, 8, 3, 500, 76, 2, 0, 1000, 'D', 'Y', 1, 1, '2017-07-31 10:44:10', '2017-07-31'),
(4, 8, 3, 500, 76, 5, 0, 2500, 'D', 'Y', 1, 1, '2017-08-04 10:07:34', '2017-08-04'),
(5, 5, 7, 5000, 76, 10, 0, 50000, 'D', 'Y', 1, 1, '2017-08-04 10:07:41', '2017-08-04'),
(6, 4, 8, 200, 76, 5, 0, 1000, 'D', 'Y', 1, 1, '2017-08-04 10:07:50', '2017-08-04'),
(7, 9, 2, 200, 79, 4, 0, 800, 'P', 'Y', 1, 1, '2017-08-04 10:18:32', '2017-08-04'),
(8, 8, 3, 500, 45, 5, 0, 2500, 'D', 'Y', 1, 1, '2017-08-12 01:00:53', '2017-08-12'),
(9, 5, 7, 5000, 45, 5, 0, 25000, 'D', 'Y', 1, 1, '2017-08-12 01:05:22', '2017-08-12'),
(10, 9, 2, 200, 45, 2, 0, 400, 'D', 'Y', 1, 1, '2017-08-12 01:06:53', '2017-08-12'),
(11, 9, 2, 200, 45, 2, 0, 400, 'D', 'Y', 1, 1, '2017-08-12 01:07:00', '2017-08-12'),
(12, 8, 3, 500, 45, 5, 0, 2500, 'D', 'Y', 1, 1, '2017-08-12 01:08:12', '2017-08-12'),
(13, 8, 3, 500, 45, 5, 0, 2500, 'D', 'Y', 1, 1, '2017-08-12 01:13:00', '2017-08-12'),
(14, 9, 2, 200, 45, 5, 0, 1000, 'D', 'Y', 1, 1, '2017-08-12 01:16:41', '2017-08-12'),
(15, 9, 2, 200, 45, 5, 0, 1000, 'D', 'Y', 1, 1, '2017-08-12 01:19:11', '2017-08-12'),
(16, 9, 2, 200, 45, 5, 0, 1000, 'D', 'Y', 1, 1, '2017-08-12 01:40:51', '2017-08-12'),
(17, 9, 2, 200, 45, 5, 0, 1000, 'D', 'Y', 1, 1, '2017-08-12 01:42:51', '2017-08-12'),
(18, 8, 3, 500, 45, 1, 0, 500, 'D', 'Y', 1, 1, '2017-08-12 01:44:57', '2017-08-12'),
(19, 9, 2, 200, 45, 2, 0, 400, 'D', 'Y', 1, 1, '2017-08-12 01:46:29', '2017-08-12'),
(20, 9, 2, 200, 45, 2, 0, 400, 'D', 'Y', 1, 1, '2017-08-12 01:46:30', '2017-08-12'),
(21, 8, 3, 500, 45, 5, 0, 2500, 'D', 'Y', 1, 1, '2017-08-12 01:48:38', '2017-08-12'),
(22, 8, 3, 500, 45, 2, 0, 1000, 'D', 'Y', 1, 1, '2017-08-12 01:49:05', '2017-08-12'),
(23, 8, 3, 500, 45, 5, 0, 2500, 'D', 'Y', 1, 1, '2017-08-12 01:51:07', '2017-08-12'),
(24, 8, 3, 500, 45, 2, 0, 1000, 'D', 'Y', 1, 1, '2017-08-12 01:51:31', '2017-08-12'),
(25, 8, 3, 500, 45, 5, 0, 2500, 'D', 'Y', 1, 1, '2017-08-12 01:52:03', '2017-08-12'),
(26, 8, 3, 500, 45, 5, 0, 2500, 'D', 'Y', 1, 1, '2017-08-12 09:29:21', '2017-08-12'),
(27, 9, 2, 200, 46, 4, 0, 800, 'D', 'Y', 1, 1, '2017-08-12 09:30:48', '2017-08-12'),
(28, 8, 3, 500, 45, 5, 0, 2500, 'D', 'Y', 1, 1, '2017-08-12 09:31:18', '2017-08-12'),
(29, 8, 3, 500, 45, 5, 0, 2500, 'P', 'Y', 1, 1, '2017-08-12 09:31:37', '2017-08-12'),
(30, 9, 2, 200, 45, 5, 10, 900, 'P', 'Y', 1, 1, '2017-08-18 11:54:43', '2017-08-18');

-- --------------------------------------------------------

--
-- Table structure for table `b_user_book_stock_master`
--

CREATE TABLE `b_user_book_stock_master` (
  `UserBookStockMasterID` int(11) NOT NULL,
  `UserBookStockID` varchar(50) NOT NULL,
  `BookID` varchar(100) NOT NULL,
  `UserID` int(11) NOT NULL,
  `TotalBookQuantity` int(11) NOT NULL,
  `PayableAmount` int(11) NOT NULL,
  `Type` varchar(200) NOT NULL,
  `is_active` varchar(11) NOT NULL,
  `EntryBy` int(11) NOT NULL,
  `ModificationBy` int(11) NOT NULL,
  `EntryDate` datetime NOT NULL,
  `ModificationDate` date NOT NULL,
  `OrderDeliveryStatus` varchar(255) NOT NULL DEFAULT 'P'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b_user_book_stock_master`
--

INSERT INTO `b_user_book_stock_master` (`UserBookStockMasterID`, `UserBookStockID`, `BookID`, `UserID`, `TotalBookQuantity`, `PayableAmount`, `Type`, `is_active`, `EntryBy`, `ModificationBy`, `EntryDate`, `ModificationDate`, `OrderDeliveryStatus`) VALUES
(1, '3', '9,12,8', 76, 12, 5000, '', 'Y', 1, 1, '2017-07-31 00:00:00', '2017-07-31', 'P'),
(2, '6', '8,5,4', 76, 20, 53500, '', 'Y', 1, 1, '2017-08-04 00:00:00', '2017-08-04', 'P'),
(3, '9', '8,5', 45, 10, 27500, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P'),
(4, '11', '9,9', 45, 4, 800, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P'),
(5, '12', '8', 45, 5, 2500, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P'),
(6, '13', '8', 45, 5, 2500, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P'),
(7, '13', '8', 45, 5, 2500, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P'),
(8, '14', '9', 45, 5, 1000, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P'),
(9, '15', '9', 45, 5, 1000, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P'),
(10, '15', '9', 45, 5, 1000, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P'),
(11, '16', '9', 45, 5, 1000, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P'),
(12, '17', '9', 45, 5, 1000, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P'),
(13, '18', '8', 45, 1, 500, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P'),
(14, '20', '9,9', 45, 4, 800, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P'),
(15, '21', '8', 45, 5, 2500, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P'),
(16, '22', '8', 45, 2, 1000, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P'),
(17, '23', '8', 45, 5, 2500, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P'),
(18, '24', '8', 45, 2, 1000, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P'),
(19, '25', '8', 45, 5, 2500, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P'),
(20, '27', '9', 46, 4, 800, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P'),
(21, '28', '8,8', 45, 10, 5000, '', 'Y', 1, 1, '2017-08-12 00:00:00', '2017-08-12', 'P');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `b_agent_book_stock`
--
ALTER TABLE `b_agent_book_stock`
  ADD PRIMARY KEY (`AgentBookStockID`);

--
-- Indexes for table `b_agent_book_stock_master`
--
ALTER TABLE `b_agent_book_stock_master`
  ADD PRIMARY KEY (`AgentBookStockMasterID`);

--
-- Indexes for table `b_agent_client`
--
ALTER TABLE `b_agent_client`
  ADD PRIMARY KEY (`ClientID`);

--
-- Indexes for table `b_area`
--
ALTER TABLE `b_area`
  ADD PRIMARY KEY (`AreaID`);

--
-- Indexes for table `b_bookmaster`
--
ALTER TABLE `b_bookmaster`
  ADD PRIMARY KEY (`BookID`);

--
-- Indexes for table `b_cart`
--
ALTER TABLE `b_cart`
  ADD PRIMARY KEY (`CartID`);

--
-- Indexes for table `b_category`
--
ALTER TABLE `b_category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `b_city`
--
ALTER TABLE `b_city`
  ADD PRIMARY KEY (`CityID`),
  ADD KEY `country_id` (`CountryID`),
  ADD KEY `state_id` (`StateID`),
  ADD KEY `city_name` (`CityName`),
  ADD KEY `is_active` (`is_active`),
  ADD KEY `created_by` (`EntryDate`);

--
-- Indexes for table `b_client_book_stock`
--
ALTER TABLE `b_client_book_stock`
  ADD PRIMARY KEY (`ClientBookStockID`);

--
-- Indexes for table `b_client_book_stock_master`
--
ALTER TABLE `b_client_book_stock_master`
  ADD PRIMARY KEY (`ClientBookStockMasterID`);

--
-- Indexes for table `b_country`
--
ALTER TABLE `b_country`
  ADD PRIMARY KEY (`CountryID`),
  ADD KEY `country_id` (`CountryName`),
  ADD KEY `is_active` (`is_active`),
  ADD KEY `created_by` (`EntryDate`);

--
-- Indexes for table `b_credit_notes`
--
ALTER TABLE `b_credit_notes`
  ADD PRIMARY KEY (`CreditNoteID`);

--
-- Indexes for table `b_expense`
--
ALTER TABLE `b_expense`
  ADD PRIMARY KEY (`ExpenseID`);

--
-- Indexes for table `b_general_user_balance`
--
ALTER TABLE `b_general_user_balance`
  ADD PRIMARY KEY (`GeneralUserBalanceID`);

--
-- Indexes for table `b_general_user_invoice_balance_rele`
--
ALTER TABLE `b_general_user_invoice_balance_rele`
  ADD PRIMARY KEY (`UserInvoiceBalanceReleID`);

--
-- Indexes for table `b_menus`
--
ALTER TABLE `b_menus`
  ADD PRIMARY KEY (`MenuID`),
  ADD KEY `menu_id` (`MenuID`,`MenuAlias`,`Level`,`ParentID`);

--
-- Indexes for table `b_menu_access`
--
ALTER TABLE `b_menu_access`
  ADD PRIMARY KEY (`AccessID`);

--
-- Indexes for table `b_order_details`
--
ALTER TABLE `b_order_details`
  ADD PRIMARY KEY (`OrderDetailsID`);

--
-- Indexes for table `b_order_master`
--
ALTER TABLE `b_order_master`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `b_retailer_balance`
--
ALTER TABLE `b_retailer_balance`
  ADD PRIMARY KEY (`RetailerBalanceID`);

--
-- Indexes for table `b_retailer_book_stock`
--
ALTER TABLE `b_retailer_book_stock`
  ADD PRIMARY KEY (`RetailerBookStockID`);

--
-- Indexes for table `b_retailer_book_stock_master`
--
ALTER TABLE `b_retailer_book_stock_master`
  ADD PRIMARY KEY (`RetailerBookStockMasterID`);

--
-- Indexes for table `b_retailer_invoice_balance_rele`
--
ALTER TABLE `b_retailer_invoice_balance_rele`
  ADD PRIMARY KEY (`InvoiceBalanceReleID`);

--
-- Indexes for table `b_retailer_payment`
--
ALTER TABLE `b_retailer_payment`
  ADD PRIMARY KEY (`RetailerPaymentID`);

--
-- Indexes for table `b_sms`
--
ALTER TABLE `b_sms`
  ADD PRIMARY KEY (`SmsID`);

--
-- Indexes for table `b_state`
--
ALTER TABLE `b_state`
  ADD PRIMARY KEY (`StateID`),
  ADD KEY `state_id` (`StateID`),
  ADD KEY `country_id` (`CountryID`),
  ADD KEY `state_name` (`StateName`),
  ADD KEY `state_short_name` (`StateCode`),
  ADD KEY `is_active` (`is_active`),
  ADD KEY `created_by` (`EntryDate`);

--
-- Indexes for table `b_stock_master`
--
ALTER TABLE `b_stock_master`
  ADD PRIMARY KEY (`StockID`);

--
-- Indexes for table `b_stock_transaction`
--
ALTER TABLE `b_stock_transaction`
  ADD PRIMARY KEY (`StockTransID`);

--
-- Indexes for table `b_user`
--
ALTER TABLE `b_user`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `b_user_address`
--
ALTER TABLE `b_user_address`
  ADD PRIMARY KEY (`AddressID`);

--
-- Indexes for table `b_user_balance`
--
ALTER TABLE `b_user_balance`
  ADD PRIMARY KEY (`UserBalanceID`);

--
-- Indexes for table `b_user_book_stock`
--
ALTER TABLE `b_user_book_stock`
  ADD PRIMARY KEY (`UserBookStockID`);

--
-- Indexes for table `b_user_book_stock_master`
--
ALTER TABLE `b_user_book_stock_master`
  ADD PRIMARY KEY (`UserBookStockMasterID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `b_agent_book_stock`
--
ALTER TABLE `b_agent_book_stock`
  MODIFY `AgentBookStockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `b_agent_book_stock_master`
--
ALTER TABLE `b_agent_book_stock_master`
  MODIFY `AgentBookStockMasterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `b_agent_client`
--
ALTER TABLE `b_agent_client`
  MODIFY `ClientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `b_area`
--
ALTER TABLE `b_area`
  MODIFY `AreaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `b_bookmaster`
--
ALTER TABLE `b_bookmaster`
  MODIFY `BookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `b_cart`
--
ALTER TABLE `b_cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `b_category`
--
ALTER TABLE `b_category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `b_city`
--
ALTER TABLE `b_city`
  MODIFY `CityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `b_client_book_stock`
--
ALTER TABLE `b_client_book_stock`
  MODIFY `ClientBookStockID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `b_client_book_stock_master`
--
ALTER TABLE `b_client_book_stock_master`
  MODIFY `ClientBookStockMasterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `b_country`
--
ALTER TABLE `b_country`
  MODIFY `CountryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `b_credit_notes`
--
ALTER TABLE `b_credit_notes`
  MODIFY `CreditNoteID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `b_expense`
--
ALTER TABLE `b_expense`
  MODIFY `ExpenseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `b_general_user_balance`
--
ALTER TABLE `b_general_user_balance`
  MODIFY `GeneralUserBalanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `b_general_user_invoice_balance_rele`
--
ALTER TABLE `b_general_user_invoice_balance_rele`
  MODIFY `UserInvoiceBalanceReleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `b_menus`
--
ALTER TABLE `b_menus`
  MODIFY `MenuID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `b_menu_access`
--
ALTER TABLE `b_menu_access`
  MODIFY `AccessID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `b_order_details`
--
ALTER TABLE `b_order_details`
  MODIFY `OrderDetailsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `b_order_master`
--
ALTER TABLE `b_order_master`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `b_retailer_balance`
--
ALTER TABLE `b_retailer_balance`
  MODIFY `RetailerBalanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `b_retailer_book_stock`
--
ALTER TABLE `b_retailer_book_stock`
  MODIFY `RetailerBookStockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `b_retailer_book_stock_master`
--
ALTER TABLE `b_retailer_book_stock_master`
  MODIFY `RetailerBookStockMasterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `b_retailer_invoice_balance_rele`
--
ALTER TABLE `b_retailer_invoice_balance_rele`
  MODIFY `InvoiceBalanceReleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `b_retailer_payment`
--
ALTER TABLE `b_retailer_payment`
  MODIFY `RetailerPaymentID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `b_sms`
--
ALTER TABLE `b_sms`
  MODIFY `SmsID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `b_state`
--
ALTER TABLE `b_state`
  MODIFY `StateID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `b_stock_master`
--
ALTER TABLE `b_stock_master`
  MODIFY `StockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `b_stock_transaction`
--
ALTER TABLE `b_stock_transaction`
  MODIFY `StockTransID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `b_user`
--
ALTER TABLE `b_user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `b_user_address`
--
ALTER TABLE `b_user_address`
  MODIFY `AddressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `b_user_balance`
--
ALTER TABLE `b_user_balance`
  MODIFY `UserBalanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `b_user_book_stock`
--
ALTER TABLE `b_user_book_stock`
  MODIFY `UserBookStockID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `b_user_book_stock_master`
--
ALTER TABLE `b_user_book_stock_master`
  MODIFY `UserBookStockMasterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

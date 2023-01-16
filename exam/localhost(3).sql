-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 13, 2015 at 04:48 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `exam`
--
CREATE DATABASE `exam` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `exam`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE IF NOT EXISTS `admin_tbl` (
  `admin_id` int(5) NOT NULL AUTO_INCREMENT,
  `uname` varchar(30) NOT NULL,
  `pass` varchar(20) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`admin_id`, `uname`, `pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_tbl`
--

CREATE TABLE IF NOT EXISTS `faculty_tbl` (
  `f_id` int(5) NOT NULL AUTO_INCREMENT,
  `uname` varchar(20) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(30) NOT NULL,
  `cno` varchar(13) NOT NULL,
  `qua` varchar(10) NOT NULL,
  `passyear` varchar(10) NOT NULL,
  `joinyear` varchar(10) NOT NULL,
  `totalexp` varchar(10) NOT NULL,
  `stream_id` int(5) NOT NULL,
  `sub1` int(5) NOT NULL,
  `sub2` int(5) DEFAULT NULL,
  `sub3` int(5) DEFAULT NULL,
  `line1` varchar(30) NOT NULL,
  `line2` varchar(30) NOT NULL,
  `dis` varchar(20) NOT NULL,
  `pin` int(6) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  PRIMARY KEY (`f_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `faculty_tbl`
--

INSERT INTO `faculty_tbl` (`f_id`, `uname`, `pass`, `fname`, `lname`, `gender`, `email`, `cno`, `qua`, `passyear`, `joinyear`, `totalexp`, `stream_id`, `sub1`, `sub2`, `sub3`, `line1`, `line2`, `dis`, `pin`, `city`, `state`) VALUES
(1, 'faculty', 'faculty', 'k', 'k', '', 'g@mail.com', '0', 'bca', '15', '15', '0', 2, 9, 5, 4, 'lkjh', 'hjkl', 'hjk', 987789, 'jkllkj', 'jkllkj'),
(3, 'pk', 'pppkkk', 'kkk', 'ppp', '', 'k@gmail.com', '0', 'bca', '15', '15', '0', 1, 1, 3, 2, 'poiiop', 'poiop', 'jh', 98890, 'jkllkj', 'jklk'),
(4, 'Krishna', 'kpatel', 'kisna', 'patel', '', 'k@gmail.com', '909090909', 'cba', '17', '16', '0', 1, 5, 1, 10, 'kkkk', 'pppp', 'hhhhh', 909009, 'hkjhjhkjh', 'hjkh');

-- --------------------------------------------------------

--
-- Table structure for table `semester_tbl`
--

CREATE TABLE IF NOT EXISTS `semester_tbl` (
  `sem_id` int(5) NOT NULL AUTO_INCREMENT,
  `sem_name` varchar(20) NOT NULL,
  `sem_desc` varchar(100) NOT NULL,
  `stream_id` int(5) NOT NULL,
  PRIMARY KEY (`sem_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `semester_tbl`
--

INSERT INTO `semester_tbl` (`sem_id`, `sem_name`, `sem_desc`, `stream_id`) VALUES
(1, 'Sem 1 B.C.A', '1st sem B.C.A', 1),
(2, 'Sem 2 B.C.A', '2nd sem B.C.A', 1),
(3, 'Sem 3 B.C.A', '3d sem B.C.A', 1),
(4, 'Sem 4 B.C.A', '4th sem B.C.A', 1),
(5, 'Sem 5 B.C.A', '5th sem B.C.A', 1),
(6, 'Sem 6 B.C.A', '6th sem B.C.A', 1),
(7, 'Sem 1 M.C.A', '1st sem M.C.A', 2);

-- --------------------------------------------------------

--
-- Table structure for table `stream_tbl`
--

CREATE TABLE IF NOT EXISTS `stream_tbl` (
  `stream_id` int(5) NOT NULL AUTO_INCREMENT,
  `stream_name` varchar(20) NOT NULL,
  `stream_desc` varchar(20) NOT NULL,
  PRIMARY KEY (`stream_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `stream_tbl`
--

INSERT INTO `stream_tbl` (`stream_id`, `stream_name`, `stream_desc`) VALUES
(1, 'B.C.A', 'Bachlor of computer '),
(2, 'M.C.A', 'Master in computer a');

-- --------------------------------------------------------

--
-- Table structure for table `student_answer`
--

CREATE TABLE IF NOT EXISTS `student_answer` (
  `a_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) NOT NULL,
  `question_id` varchar(20) NOT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE IF NOT EXISTS `student_tbl` (
  `stu_id` int(5) NOT NULL AUTO_INCREMENT,
  `uname` varchar(30) NOT NULL,
  `stu_rno` int(3) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `cno` varchar(13) NOT NULL,
  `email` varchar(30) NOT NULL,
  `f_cno` varchar(13) NOT NULL,
  `f_email` varchar(30) NOT NULL,
  `stream_id` int(5) NOT NULL,
  `sem_id` int(5) NOT NULL,
  `line1` varchar(30) NOT NULL,
  `line2` varchar(30) NOT NULL,
  `city` varchar(20) NOT NULL,
  `dis` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `pin` int(6) NOT NULL,
  PRIMARY KEY (`stu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`stu_id`, `uname`, `stu_rno`, `pass`, `fname`, `lname`, `gender`, `cno`, `email`, `f_cno`, `f_email`, `stream_id`, `sem_id`, `line1`, `line2`, `city`, `dis`, `state`, `pin`) VALUES
(1, 'student', 0, 'student', 'Khyati', 'Pandya', 'female', '0987654321', 'k@gmail.com', '0987654321', 'g@gmail.com', 1, 1, 'line1', 'line2', 'city', 'dis', 'state', 123456),
(2, 'kp', 9, 'kpkp', 'kk', 'ppp', 'male', '0909090909', 'k@gmail.com', '0987654321', 'g@gmail.com', 1, 1, 'jkllkj', 'kllkjj', 'kjl', 'kljl', 'jljl', 8),
(3, 'kp', 9, 'kpkp', 'kk', 'ppp', 'male', '0987654321', 'k@gmail.com', '0987654321', 'g@gmail.com', 1, 1, 'jkllkj', 'kllkjj', 'kjl', 'kljl', 'jljl', 8),
(4, 'kk', 8, 'jlkj', 'jlkj', 'kljl', 'female', '99999', 'khyatipandya.95@gmail.com', '9999', 'g@gmail.co', 2, 1, 'hgjkl', 'hjkl', 'hkjh', 'jkl', 'hk', 5645);

-- --------------------------------------------------------

--
-- Table structure for table `subject_tbl`
--

CREATE TABLE IF NOT EXISTS `subject_tbl` (
  `sub_id` int(5) NOT NULL AUTO_INCREMENT,
  `sub_name` varchar(35) NOT NULL,
  `sub_desc` varchar(50) NOT NULL,
  `stream_id` int(5) NOT NULL,
  `sem_id` int(5) NOT NULL,
  PRIMARY KEY (`sub_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `subject_tbl`
--

INSERT INTO `subject_tbl` (`sub_id`, `sub_name`, `sub_desc`, `stream_id`, `sem_id`) VALUES
(1, 'Fundamental Program', 'B.C.A sem 1', 1, 1),
(2, 'Database Management ', 'B.C.A sem 1', 1, 1),
(3, 'Computer Organizatio', 'B.C.A sem 1', 1, 1),
(4, 'Comunication Skill', 'B.C.A sem 1', 1, 1),
(5, 'Advanced programming', 'B.C.A sem 2', 1, 2),
(6, 'Internet & WebDesign', 'B.C.A sem 2', 1, 2),
(7, 'District Mathamatics', 'B.C.A sem 2', 1, 2),
(8, 'Communication skills', 'B.C.A sem 2', 1, 2),
(9, 'PHP', 'B.C.A sem 6', 1, 6),
(10, 'Internet & web desi', 'M.C.A sem 1', 2, 7),
(11, '.net', '.net bca sem6', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mcq`
--

CREATE TABLE IF NOT EXISTS `tbl_mcq` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `stream` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `subject` varchar(30) NOT NULL,
  `que` varchar(200) NOT NULL,
  `op1` varchar(100) NOT NULL,
  `op2` varchar(100) NOT NULL,
  `op3` varchar(100) NOT NULL,
  `op4` varchar(100) NOT NULL,
  `ans` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=113 ;

--
-- Dumping data for table `tbl_mcq`
--

INSERT INTO `tbl_mcq` (`id`, `stream`, `semester`, `subject`, `que`, `op1`, `op2`, `op3`, `op4`, `ans`) VALUES
(1, '1', '6', '9', '.Which is not an operation system?', '.Windows', '.Linux', '.Micrsoft', '.Android', '.Miscrosoft'),
(2, '1', '6', '9', '.Which is not a programming lnaguage?', '.C', '.PHP', '.Java', '..Net', '..Net'),
(3, '1', '6', '9', '.Which of the following memories is an optical memory?\n', '.Flopy Disk', '.Bubble Memories', '.CD-ROM', '.Core Memories', '.CD-ROM'),
(4, '1', '6', '9', '.DNS refers to', '.Data Number Sequence', '.Digital Network Service', '.Domain Name System', '.Disk Numbering System', '.Digital Network Service'),
(5, '1', '6', '9', '.Java was originally invented by', '.Oracle', '. Microsoft', '. Novell', '.Sun', '.Sun'),
(6, '1', '6', '9', '.The unit of speed used for super computer is', '.KELOPS', '.GELOPS', '.MELOPS', '.None of this', '.GELOPS'),
(7, '1', '6', '9', '.Whose trademark is the operating system UNIX?', '.Motorola', '.Microsoft', '.Bell Laboratories', '.AshtonTate', '.Bell Laboratoris'),
(8, '1', '6', '9', '.The first mechanical computer designed by Charles Babbage was called', '.Abacus', '.Analytical', '.Calcuator', '.Processor', '.Analytical Engine'),
(9, '1', '6', '9', '.Which of the following is the most powerful type of computer?', '.Super–micro', '.Super conductor', '.Super Computer', '.Megaframe', '.Super computer'),
(10, '1', '6', '9', '.Which gate is a single integrated circuit?', '.Gate', '.Mother Board', '.Chip', '.CPU', '.Gate'),
(11, '1', '6', '9', '.C is', '.An assembly language', '.A machine lanugage', '.An assembly language', '.All of this above', '.A third Generation high level language'),
(12, '1', '6', '9', '.Web pages are written using', '.FTP', '.HTTP', '.HTML', '.URL', '.HTML'),
(13, '1', '6', '9', '.Find the odd man out.', '.Coaxial cable', '.Microwaves', '.Optical fibre', '.Twisted pair wire', '. Microwaves'),
(14, '1', '6', '9', '.The parity bit is added for the purpose of', '.Coding', '.Error detection', '.Controlling', '.Indexing', '.Error detection'),
(15, '1', '6', '9', '.India’s first super computer is', '.Agni', '.Flow solver', '.Param', '.Trisul', '.Param'),
(16, '1', '6', '9', '.Which of the following is NOT operating system?', '.Dos', '. Unix', '.Window NT', '.Java', '.JAVA'),
(17, '1', '6', '9', '.The computer that is not considered as a portable computer is', '.None of these', '.Mini computer', '.Notebook computer', '. Laptop computer', '.Mini computer'),
(18, '1', '6', '9', '.UNIVAC is an example of', '.First generation computer', '.Second generation computer', '. Third generation computer', '. Fourth generation computer', '.First generation computer'),
(19, '1', '6', '9', '.The first movie released in 1982 with terrific computer animation and graphics was', '.Star wars', '.Tron', '.Forbidden planet', '.Dark star', '.Star wars'),
(20, '1', '6', '9', '.Which of the following is an example of non volatile memory?', '.VLSI', '.LSI', '.ROM', '.RAM', '.ROM'),
(21, '1', '6', '9', '.One byte is equivalent to', '.4 bits', '.8 bits', '.12 bits', '.32 bits', '.8 bits'),
(22, '1', '6', '9', '.Graphic interfaces were first used in a xerox product is called', '.Ethernet', '.Inter LISP', '.Small talk', '.Zeta LISP', '.Ethernet'),
(23, '1', '6', '9', '.ROM is composed of', '.Floppy disks', '.Magnetic cores', '.Microprocessors', '.Photoelectric cells', '.Photoelectric cells'),
(24, '1', '6', '9', '.Which command combines the contents of one file with another?', '.RESTORE', '.RENAME', '.APPEND', '.ADD', '.APPEND'),
(25, '1', '6', '9', '.Find the odd man out.', '.GOOGLE', '.LYCOS', '.Altavista', '.JAVA', '.Java'),
(26, '1', '6', '9', '.ISDN stands for', '.International Standard Digital Network', '.International Subscriber Dialing Network', '. Integrated Service Digital Network', '.Integrated Service ', '.Integrated Service Digital Network'),
(27, '1', '6', '9', '.The ------ is the administrative section of the computer system.', '.Memory Unit', '.Input Unit', '.Central Processing Unit', '.Control Unit', '.Central Processing Unit'),
(28, '1', '6', '9', '.FPI stands for', '.Faults per inch', '.Frames per inch', '.Film per inch', '.Figure per inch', '.Frames per inch'),
(29, '1', '6', '9', '.CD–ROM is a kind of', '.Optical disk', '. Magnetic disk', '. Magneto–Optical disk', '.None of these', '.Magnetic disk'),
(30, '1', '6', '9', '.What is the full form of lP?', '.Interface program', '.Interface protocol', '. Internet program', '. Internet protocol', '. Internet protocol'),
(31, '1', '6', '9', '.Coded entries which are used to gain access to a computer system are called', '.Codewords', '. Entry codes', '.Entry codes', '. Security commands', '.Security commands'),
(32, '1', '6', '9', '.What is the number of bit patterns provided by a 7 bit code?', '.64', '.256', '.128', '.512', '.128'),
(33, '1', '6', '9', '.The word length of a computer is measured in', '.bits', '.bytes', '.millimetres', '.meters', '.Bytes'),
(34, '1', '1', '2', '.Which of the following option is use to retrieval of data?', '.Stack', '.Data Structure', '.Linked List', '.Query', '.Query'),
(35, '1', '1', '2', '.ODBC stands for___', '.Offline database connection', '.Oriented database connection', '.Open database connection', '.None of Above', '.Open database connection'),
(36, '1', '1', '2', '.Which algebra is widely used in DBMS', '.Relational algebra', '.Arithmetic algebra', '.Both', '.None', '.Relational algebra'),
(37, '1', '1', '2', '.Which of the following option is an unary operation?', '.Selection operation', '.Generation selection', '.Primitive opration', '.Projection operation', '.Generation selection'),
(38, '1', '1', '2', '.Which SQL Query is use to remove a table and all its data from the database?', '.Create Table', '.Alter Table', '.Drop Table', '.None of these', '.Drop Table'),
(39, '1', '1', '2', '.In precedence of set operators the expression is evaluated from:', '.Left to Left', '.Left to Right', '.Right to Right', '.Right to Left', '.Left to Right'),
(40, '1', '1', '2', '.In DBMS FD stands for___', '.Facilitate data', '.Functionality data', '.Facilitate dependency', '.Funcional dependency', '.Funcional dependency'),
(41, '1', '1', '2', '.How many types of keys in Database Design?', '.Candidate key', '.Primary key', '.Foreign key', '.All of these', '.All of these'),
(42, '1', '1', '2', '.Which of the following is based on Multy Valued Dependency?', '.First ', '.Second', '.Third', '.Fourth', '.Fourth'),
(43, '1', '1', '2', '.Which of the following is structure of the Database?', '.Table', '.Schema', '.Relation', '.None of these', '.Schema'),
(44, '1', '1', '2', '.A database Management System is', '.Collection of interrelated data', '.Collection of programs to access data', '.Collection of data describing one particular enterprise', '.All of above', '.Collection of programs to access data'),
(45, '1', '1', '2', '.Which of the following is not level of data abstraction?', '.Physical level ', '.Critical Level', '.Logical Level', '.View Level', '.Critical Level'),
(46, '1', '1', '2', '.Disadvantages of File systems to store data is', '.Data redundancy and inconsistency', '.Difficulty in accessing data', '.Data isolation', '.All of above', '.All of Above'),
(47, '1', '1', '2', '.In an Entity-Relationshop Diagram Rectangles represents', '.Entity sets', '.Attributes', '.Database', '.Tables', '.Entity sets'),
(48, '1', '1', '2', '.Which of the following is not a Storage Manager Component?', '.Transation Manager', '.Logical Manager', '.Buffer Manager', '.File Manager', '.Logical Manager'),
(49, '1', '1', '2', '.Data Manipulation language enables users to ', '.Retrievals of information stored in database', '.Insertion of new information into the database', '.Deletion of information from the database', '.All of above', '.All of above'),
(50, '1', '1', '2', '.Which of the following is not an Schema', '.Database Schema', '.Physical Schema', '.Critical Schema', '.Logical Schema', '.Critical Schema'),
(51, '1', '1', '2', '.Which of the following is Database Language?', '.Database Defination Language', '.Data Manupulation Language', '.Query Language', '.All of above', '.Data Manupulation Language'),
(52, '1', '1', '2', '.Which of the following is not a funtion of DBA?', '.Network Maintenance', '.Routine Maintenance', '.Schema Defination', '.Authorization of data access', '.Network Maintenance'),
(53, '1', '1', '2', '.Which of the following is a Data Model?', '.Entity-Relationship model', '.Relational data model', '.Object-Base data model', '.All of data model', '.All of data model'),
(54, '1', '1', '2', '.Who proposed the relational model?', '.Bill Gates', '.E.F Codd', '.Herman Hollerith', '.Charles Babbage', '.E.F Codd'),
(55, '1', '1', '2', '.Set of permitted values of each attribute is called', '.Domain', '.Tuple', '.Relation', '.Schema', '.Domain'),
(56, '1', '1', '2', '.Which of the following in true regarding Null value?', '.Null=0', '.Null<0', '.Null>0', '.Null<>0', '.Null<>0'),
(57, '1', '1', '2', '.Logical design of database is called', '.Database Instance', '.Database Snapshot', '.Database Schema', '.All of the above', '.Database Schema'),
(58, '1', '1', '2', '.Snapshot of the data in the database at a given instant of time is called', '.Database Schema', '.Database Instance', '.Database Snapshot', '.All of above', '.Database Instance'),
(59, '1', '1', '2', '.Which of the following is not Unary Operation', '.Select', '.Project', '.Rename', '.Union', '.Union'),
(60, '1', '1', '2', '.Which of the following is not binary operation?', '.Union', '.Project', '.Set Difference', '.Cartesian Product', '.Project'),
(61, '1', '1', '2', '.Which of the following is correct regarding Aggregate functions?', '.It takes a list of values and return a singlevalues as result', '.It takes a lists of values and return a list of values as result', '.It takes a single value and returns a list of values as results', '.It takes a single value and return a single value as result', '.It takes a list of values and return a singlevalues as result'),
(62, '1', '1', '2', '.The primary key must be ', '.Not null', '.Unique', '.Option A or B', '.Option A and B', '.Option A and B'),
(63, '1', '1', '2', '.A command to remove a relation from an SQL database', '.Delete table <table name>', '.Drop table <table name>', '.Erase table <table name>', '.Alter table <table name>', '.Drop table <table name>'),
(64, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(65, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(66, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(67, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(68, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(69, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(70, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(71, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(72, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(73, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(74, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(75, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(76, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(77, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(78, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(79, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(80, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(81, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(82, '1', '1', '2', '.', '.', '.', '.', '.', '.'),
(83, '1', '6', '11', '.What is true about Managed Code(MC)?', '.Managed code(MC) is compiled by the JIT(Just In Time) compilers', '.Managed code(MC) where resources are Garbage Collected(GC)', '.Managed code(MC) written to target the services of ', '.Managed code(MC) written to target the services of the Common Language Runtime (CLR).', '.Managed code(MC) written to target the services of the Common Language Runtime (CLR).'),
(84, '1', '6', '11', '.which utility can be used to compile managed assemblies (like Dll’s and EXE) into native code?', '.gacutil', '.ngen', '.sn', '.dumpbin', '.ngen'),
(85, '1', '6', '11', '.Which of the following components used for .NET compliant programming language?', '.Common Type System (CTS)', '.Microsoft Dot NET class libraries', '.Common Language Specifications (CLS)', '.Common Language Runtime (CLR)', '. Microsoft Dot NET class libraries'),
(86, '1', '6', '11', '. Which of the class provides the operation of reading from and writing to the console in C#.NET?', '.System.Array', '.System.Output', '.System.ReadLine', '.System.Console', '.System.Console'),
(87, '1', '6', '11', '.Which of the given stream method provides the access to the output console by default in C#.NET?', '.Console.In', '.Console.Out', '.Console.Error', '.All of the mentioned', '.Console.Out'),
(88, '1', '6', '11', '.Which of the given stream method provides the access to the input console in C#.NET?', '.Console.Out', '.Console.Error', '.Console.In', '.All of the mentioned', '.Console.In'),
(89, '1', '6', '11', '.The number of input methods defined by the stream method Console.In in C#.NET is?', '.4', '.3', '.2', '.1', '.3'),
(90, '1', '6', '11', '.Select the correct methodS provided by Console.In?', '.Read(), ReadLine()', '.ReadKey(), ReadLine()', '.Read(), ReadLine(), ReadKey()', '.ReadKey(), ReadLine()', '.Read(), ReadLine(), ReadKey()'),
(91, '1', '6', '11', '.Choose the output return when read() reads the character from the console?', '.String', '.Char', '.Integer', '.Boolean', '.nteger'),
(92, '1', '6', '11', '. Choose the output returned when error condition generates while read() reads from the console', '.FALSE', '.0', '.-1', '.All of the mentioned', '. -1'),
(93, '1', '6', '11', '.Choose the object of TextReader class', '.Console.In', '.Console.Out', '.Console.Error', '.None of the mentioned', '.Console.In'),
(94, '1', '6', '11', '.On which of the operating system below ASP.NET can run?', '. Windows XP Professional', '.Windows 2000', '.Both A) and B)', '.None of the Above', '.Both A) and B)'),
(95, '1', '6', '11', '.Which of the following denote the web control associated with Table control function of ? ', '.DataList', '.ListBox ', '.TableRow ', '.All the Above', '.TableRow '),
(96, '1', '6', '11', '.of ASP.NET?', '.', '.', '.', '.', '.'),
(97, '1', '6', '11', '.ASP.NET separates the HTML output from program logic using a feature named as', '. Exception', '.Code-behind ', '.Code-front', '.None of the above', '.Code-behind '),
(98, '1', '6', '11', '.If a developer of ASP.NET defines style information in a common location. Then that     location is called as  ', '.Master Page', '.Theme ', '.Customization', '.None of the Above', '.Theme '),
(99, '1', '6', '11', '.In ASP.NET if you want to allows page developers a way to specify static connections in a content page then the class used is ', '.WebPartManager', '.ProxyWebPartManager', '.System.Activator', '.None of the Above', '.ProxyWebPartManager'),
(100, '1', '6', '11', '.The feature in ASP.NET 2.0 that is used to fire a normal postback to a different page in the application is called ', '.Theme', '.Cross Page Posting', '. Code-front', '.None of the above', '.Cross Page Posting'),
(101, '1', '6', '11', '.In ASP.NET if one uses Windows authentication the current request attaches an object called as', '.Serialization', '.WindowsPrincipal', '.WindowDatset ', '.None of the Above', '.WindowsPrincipal'),
(102, '1', '6', '11', '.The GridView control in ASP.NET has which of the following features', '. Automatic data binding ', '.Automatic paging', '.Both A) and B)', '.None of the above', '.Both A) and B)'),
(103, '1', '6', '11', '. If one uses ASP.NET configuration system to restrict access which of the following is TRUE?', '. The access is restricted only to ASP.NET files', '.The access is restricted only to static files and non-ASP.NET resources', '.Both A) and B)', '.None of the Above', '. The access is restricted only to ASP.NET files'),
(104, '1', '6', '11', '.Which of the following denote page code model in ASP.NET?', '.single-file', '.code-behind ', '.Both A) and B)', '.None of the above', '.Both A) and B)'),
(105, '1', '6', '11', '.Which of the following denote New Data-bound Controls used with ASP.NET', '.GridView', '.FormView', '. SqlDataSource ', '.All the Above', '.All the Above'),
(106, '1', '6', '11', '.Which of the following is true about session in ASP.NET?', '.Programmers has to take care of delete sessions after configurable timeout interval', '.ASP.NET automatically delete sessions after configurable timeout interval', '. The default time interval is 5 minutes    ', '. None of the Above', '.ASP.NET automatically delete sessions after configurable timeout interval'),
(107, '1', '6', '11', '.In ASP.NET if one wants to maintain session then which of the following is used?', '. In-process storage', '.Microsoft SQL Server ', '.Session State Service ', '. All the Above ', '. All the Above '),
(108, '1', '6', '11', '. I have an ASP.NET application. I have a page loaded from server memory. At this instance which of the following methods gets fired', '.Unload( )', '.Load()', '.PreRender( )', '.None of the Above', '. Load()'),
(109, '1', '6', '11', '. Give one word: What model does ASP.NET request processing is based on', '.Bottom-up', '.Top-down ', '.Waterfall ', '. Pipeline  ', '. Pipeline  '),
(110, '1', '6', '11', '. If in an ASP.NET application one want to create http handlers which of the interface is used', '.None of the above', '. pipeline ', '. Handler', '.IHttpHandlerFactory', '.IHttpHandlerFactory'),
(111, '1', '6', '11', '.To set page title dynamically in ASP.NET which of the following is used?', '.None of the above', '.< sheet > section', '. < tail > section', '.< head > section', '.< head > section'),
(112, '1', '6', '11', '. In ASP.NET application the Global.asax file lie in which directory', '.Application', '.System ', '.ROOT ', '. None of the Above', '.');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

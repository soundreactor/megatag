-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2017 at 06:16 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dudler_project_tags`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE `tbl_items` (
  `id` int(11) NOT NULL,
  `value` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`id`, `value`) VALUES
(1, 'item1'),
(2, 'item2'),
(3, 'asdfasdf'),
(4, 'ffffff'),
(5, 'globi'),
(6, 'SAMI');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_tag_ref`
--

CREATE TABLE `tbl_item_tag_ref` (
  `tag_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_item_tag_ref`
--

INSERT INTO `tbl_item_tag_ref` (`tag_id`, `item_id`) VALUES
(3, 2),
(2, 4),
(2, 2),
(9, 5),
(17, 2),
(18, 2),
(19, 5),
(12, 2),
(20, 5),
(21, 2),
(22, 5),
(8, 2),
(23, 5),
(13, 2),
(24, 5),
(26, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tags`
--

CREATE TABLE `tbl_tags` (
  `id` int(11) NOT NULL,
  `tag` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tags`
--

INSERT INTO `tbl_tags` (`id`, `tag`) VALUES
(2, 'Naturstein'),
(3, 'Beton'),
(4, 'FleischBeton'),
(5, 'flubi'),
(6, 'hobo'),
(7, 'ggg'),
(8, 'globi'),
(9, 'doggo'),
(10, 'nono'),
(11, 'Alabama'),
(12, 'Nebraska'),
(13, 'frank white'),
(14, 'why do doggos stink?'),
(15, ''),
(16, 'nnnnnnn'),
(17, 'tttt'),
(18, 'fuck yas'),
(19, 'fuck oooii'),
(20, 'nebroni'),
(21, 'hello'),
(22, 'helloli'),
(23, 'modal'),
(24, 'kokok'),
(25, 'hoho'),
(26, 'HEY');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_item_tag_ref`
--
ALTER TABLE `tbl_item_tag_ref`
  ADD KEY `tag_id` (`tag_id`),
  ADD KEY `intem_id` (`item_id`);

--
-- Indexes for table `tbl_tags`
--
ALTER TABLE `tbl_tags`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbl_tags`
--
ALTER TABLE `tbl_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_item_tag_ref`
--
ALTER TABLE `tbl_item_tag_ref`
  ADD CONSTRAINT `tbl_item_tag_ref_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tbl_tags` (`id`),
  ADD CONSTRAINT `tbl_item_tag_ref_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `tbl_items` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

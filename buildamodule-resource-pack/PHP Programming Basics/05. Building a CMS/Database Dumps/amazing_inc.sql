-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 22, 2012 at 12:36 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `amazing_inc`
--

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` longtext NOT NULL,
  `path` text NOT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `title`, `content`, `path`) VALUES
(1, 'About Us', '<div class="right-image"><img src="images/founder.jpg" /></div>\r\n  <h1><?php print $title; ?></h1>\r\n  <p>Hi there, my name is Michael Brown-Schtick, and I''m the founder of AmaZING! When my daughter was little, she wasn''t very good at playing fetch - a common problem with modern children. After a long period of trial and error, I realized that the problem wasn''t with the child, it was with the stick!</p>\r\n  <p>Most sticks make a slight wooshing sound as they are thrown, which is not enough to interest most toddlers. So for months I worked in my basement, trying to find just the right shape that would cause a distinctive noise throughout the entire arc, without adding so much wind resistance that it would sacrifice on distance.</p>\r\n  <p>Finally I emerged with a now patented design, and from the basement we have moved to an 8000 foot warehouse and stick-producing factory. Parents and toddlers all over the world are rejoicing, but they''re not the only ones.</p>\r\n  <p>Our sticks are being used in over 1000 unique ways across the world. Digging up worms, blocking the sun on bright days, and signaling to jet skis when swimming are just a few of the unique ways our sticks have been used.</p>\r\n  <p>We''re happy to have you here, please let us know what we can do to earn your business and improve your world with beautiful, hand-crafted sticks.</p>\r\n  <p>Sincerely,<br />Michael Brown-Schtick</p>', 'about.php'),
(3, 'Welcome to AmaZING!', '<div class="right-image"><img src="images/use-card.png" /></div>\r\n  <h1>$title</h1>\r\n  <p>AmaZING! is the home of <strong>world class throwing sticks</strong>, used in\r\n    stick throwing tournaments across 125 countries. With over 200\r\n    years of stick production under its belt, AmaZING! is more than\r\n    the finest shop to purchase your next stick, it''s the gold (or\r\n    shall we say brown) standard.</p>\r\n  <p>Founded with the principles of distance throwing coupled with\r\n    a striking balance between speed and our trademark satisfying\r\n    <strong>auditory feedback mechanism</strong> (i.e. the ''ZING''), we have continued\r\n    to produce by hand a product unparalleled for its craftsmanship\r\n    and general awesomeness.</p>\r\n  <p>Please peruse the info on our site to learn more about stick\r\n    purchasing, to see a full product list, or to contact\r\n    us.</p>\r\n  <ul>\r\n    <li><a href="products.html">Learn more about our incredible products</a></li>\r\n    <li><a href="about.html">About us and what we do</a></li>\r\n    <li><a href="contact.html">Contact us for more information</a></li>\r\n  </ul>', 'home.php');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `price` float(8,2) NOT NULL,
  `image` varchar(256) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `title`, `price`, `image`) VALUES
(1, 'Mahogany', 29.99, 'product-1.jpg'),
(3, 'Cherry', 39.99, 'product-4.jpg'),
(4, 'Birch', 15.92, 'product-2.jpg'),
(5, 'Hard', 45.99, 'product-5.jpg'),
(6, 'Driftwood', 5.99, 'product-6.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`) VALUES
(1, 'chris', 'test');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

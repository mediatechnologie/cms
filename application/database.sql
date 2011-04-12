-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 12, 2011 at 04:00 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `brookman_db99`
--

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'hidden',
  `title` varchar(222) NOT NULL COMMENT 'text;title for page',
  `content` text NOT NULL COMMENT 'textarea',
  `banner` varchar(222) DEFAULT NULL COMMENT 'file;banner for page( optional )',
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`page_id`, `title`, `content`, `banner`) VALUES
(18, 'home', '<p>Dit is de hoofdpagina, is dat niet geweldig?!?</p>', '4'),
(19, 'testimonials', '<p>WickT</p>', '4'),
(20, 'tips''n''trucs', '', '4'),
(23, 'contact', '<table>\r\n<tr><th>Adres</th><td>Amsterdamseweg zus-en-zoveel</td></tr>\r\n</table>', '4');


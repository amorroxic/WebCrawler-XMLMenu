-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 01, 2013 at 04:21 AM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rational`
--

-- --------------------------------------------------------

--
-- Table structure for table `fetched_url`
--

CREATE TABLE `fetched_url` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `cache` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=132 ;

-- --------------------------------------------------------

--
-- Table structure for table `fetched_url_assets`
--

CREATE TABLE `fetched_url_assets` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `fetched_url_id` mediumint(9) NOT NULL,
  `asset` varchar(255) NOT NULL,
  `asset_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7635 ;

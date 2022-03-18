-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2022 at 08:04 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_baraya`
--

-- --------------------------------------------------------

--
-- Table structure for table `conf_level`
--

CREATE TABLE `conf_level` (
  `id_level` smallint(3) NOT NULL,
  `level` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conf_menu`
--

CREATE TABLE `conf_menu` (
  `id_menu` smallint(3) NOT NULL,
  `menu` varchar(50) NOT NULL,
  `icon` varchar(30) NOT NULL,
  `link` varchar(50) NOT NULL,
  `level` text NOT NULL,
  `position` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conf_submenu`
--

CREATE TABLE `conf_submenu` (
  `id_submenu` smallint(3) NOT NULL,
  `id_menu` smallint(3) NOT NULL,
  `submenu` varchar(50) NOT NULL,
  `icon` varchar(15) NOT NULL,
  `link` varchar(50) NOT NULL,
  `level` text NOT NULL,
  `position` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conf_users`
--

CREATE TABLE `conf_users` (
  `id_user` int(3) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `insert_date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `id_level` tinyint(2) NOT NULL,
  `name` varchar(30) NOT NULL,
  `access` char(1) NOT NULL,
  `salt` char(10) NOT NULL,
  `avatar` varchar(10) DEFAULT NULL,
  `gender` char(1) NOT NULL,
  `repass_token` char(50) DEFAULT NULL,
  `repass_expired` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_family`
--

CREATE TABLE `tbl_family` (
  `id` int(6) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `skill` text DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `link_fb` varchar(100) DEFAULT NULL,
  `link_git` varchar(100) DEFAULT NULL,
  `link_in` varchar(100) DEFAULT NULL,
  `link_img` varchar(100) DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 0,
  `dt_insert` datetime DEFAULT NULL,
  `dt_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conf_level`
--
ALTER TABLE `conf_level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `conf_menu`
--
ALTER TABLE `conf_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `conf_submenu`
--
ALTER TABLE `conf_submenu`
  ADD PRIMARY KEY (`id_submenu`);

--
-- Indexes for table `conf_users`
--
ALTER TABLE `conf_users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tbl_family`
--
ALTER TABLE `tbl_family`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conf_level`
--
ALTER TABLE `conf_level`
  MODIFY `id_level` smallint(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conf_menu`
--
ALTER TABLE `conf_menu`
  MODIFY `id_menu` smallint(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conf_submenu`
--
ALTER TABLE `conf_submenu`
  MODIFY `id_submenu` smallint(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conf_users`
--
ALTER TABLE `conf_users`
  MODIFY `id_user` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_family`
--
ALTER TABLE `tbl_family`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

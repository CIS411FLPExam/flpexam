-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2014 at 11:40 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `flpexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `functions`
--

CREATE TABLE IF NOT EXISTS `functions` (
  `FunctionID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  `Description` text,
  PRIMARY KEY (`FunctionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `functions`
--

INSERT INTO `functions` (`FunctionID`, `Name`, `Description`) VALUES
(1, 'ManageUsers', 'Allows for reading users and interface to add, change, and delete.'),
(3, 'UserEdit', 'Allows for editing of users by enabling link on manage form.'),
(4, 'UserDelete', 'Allows for deleting of users by enabling checkbox on manage form.'),
(5, 'ProcessUserAddEdit', 'Required to process an add, change, or delete of users.'),
(6, 'ManageFunctions', 'Allows for reading functions and interface to add, change, and delete.'),
(7, 'FunctionAdd', 'Allows for adding of functions by enabling link on manage form.'),
(8, 'FunctionEdit', 'Allows for editing of functions by enabling link on manage form.'),
(9, 'FunctionDelete', 'Allows for deleting of functions by enabling checkbox on manage form.'),
(10, 'ProcessFunctionAddEdit', 'Required to process an add, change, or delete of functions.'),
(11, 'ManageRoles', 'Allows for reading roles and interface to add, change, and delete.'),
(12, 'RoleAdd', 'Allows for adding of roles by enabling link on manage form.'),
(13, 'RoleEdit', 'Allows for editing of roles by enabling link on manage form.'),
(14, 'RoleDelete', 'Allows for deleting of roles by enabling checkbox on manage form.'),
(15, 'ProcessRoleAddEdit', 'Required to process an add, change, or delete of roles.'),
(16, 'UserSearch', 'The ability to search through the record of users.'),
(17, 'UserView', 'Enables to the user to view other user''s information.'),
(18, 'LanguageAdd', 'The ability to add a new language.'),
(19, 'LanguageEdit', 'Allows the user to edit an exiting language.'),
(20, 'LanguageDelete', 'Allows the user to delete an existing language.'),
(21, 'LanguageView', 'Allows the user to view an existing language.'),
(22, 'ManageLanguages', 'Allows for displaying all languages and interface to add, change, delete, and view.');

-- --------------------------------------------------------

--
-- Table structure for table `languageexperiences`
--

CREATE TABLE IF NOT EXISTS `languageexperiences` (
  `ExperienceID` int(11) NOT NULL AUTO_INCREMENT,
  `Description` varchar(32) NOT NULL,
  PRIMARY KEY (`ExperienceID`),
  UNIQUE KEY `Description` (`Description`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `languageprofiles`
--

CREATE TABLE IF NOT EXISTS `languageprofiles` (
  `ProfileID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `LanguageID` int(11) NOT NULL,
  `SpokenAtHome` tinyint(1) NOT NULL,
  `JrHighExpID` int(11) NOT NULL,
  `SrHighExpID` int(11) NOT NULL,
  `CollegeExpID` int(11) NOT NULL,
  PRIMARY KEY (`UserID`,`LanguageID`),
  UNIQUE KEY `ProfileID` (`ProfileID`),
  KEY `JrHighExpID` (`JrHighExpID`),
  KEY `SrHighExpID` (`SrHighExpID`),
  KEY `CollegeExpID` (`CollegeExpID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `LanguageID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`LanguageID`),
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rolefunctions`
--

CREATE TABLE IF NOT EXISTS `rolefunctions` (
  `RoleID` int(11) NOT NULL,
  `FunctionID` int(11) NOT NULL,
  KEY `RoleID` (`RoleID`),
  KEY `FunctionID` (`FunctionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rolefunctions`
--

INSERT INTO `rolefunctions` (`RoleID`, `FunctionID`) VALUES
(3, 1),
(3, 16),
(3, 17),
(1, 7),
(1, 9),
(1, 8),
(1, 18),
(1, 20),
(1, 19),
(1, 21),
(1, 6),
(1, 11),
(1, 1),
(1, 10),
(1, 15),
(1, 5),
(1, 12),
(1, 14),
(1, 13),
(1, 4),
(1, 3),
(1, 16),
(1, 17),
(1, 22);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  `Description` text,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`RoleID`, `Name`, `Description`) VALUES
(1, 'admin', 'Full privileges.'),
(2, 'guest', 'An un-identified user.'),
(3, 'manager', 'Granted all neccessary permission to manage the site.');

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE IF NOT EXISTS `userroles` (
  `UserID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  KEY `UserID` (`UserID`),
  KEY `RoleID` (`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`UserID`, `RoleID`) VALUES
(1, 1),
(2, 1),
(4, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(32) NOT NULL,
  `LastName` varchar(32) NOT NULL,
  `UserName` varchar(32) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `Email` varchar(32) NOT NULL,
  PRIMARY KEY (`UserID`),
  FULLTEXT KEY `nombre` (`FirstName`,`LastName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FirstName`, `LastName`, `UserName`, `Password`, `Email`) VALUES
(1, 'Wesley', 'Garey', 'wdgarey', '9c22f986c7a4149924fb8b016ef2958687f9f6b2', 'w.d.garey@eagle.clarion.edu'),
(2, 'admin', 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@flpexam.com'),
(3, 'manager', 'manager', 'manager', '1a8565a9dc72048ba03b4156be3e569f22771f23', 'manager@flpexam.com'),
(4, 'guest', 'guest', 'guest', '35675e68f4b5af7b995d9205ad0fc43842f16450', 'guest@flpexam.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `languageprofiles`
--
ALTER TABLE `languageprofiles`
  ADD CONSTRAINT `languageprofiles_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `languageprofiles_ibfk_2` FOREIGN KEY (`JrHighExpID`) REFERENCES `languageexperiences` (`ExperienceID`),
  ADD CONSTRAINT `languageprofiles_ibfk_3` FOREIGN KEY (`SrHighExpID`) REFERENCES `languageexperiences` (`ExperienceID`),
  ADD CONSTRAINT `languageprofiles_ibfk_4` FOREIGN KEY (`CollegeExpID`) REFERENCES `languageexperiences` (`ExperienceID`);

--
-- Constraints for table `rolefunctions`
--
ALTER TABLE `rolefunctions`
  ADD CONSTRAINT `rolefunctions_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`) ON DELETE CASCADE,
  ADD CONSTRAINT `rolefunctions_ibfk_2` FOREIGN KEY (`FunctionID`) REFERENCES `functions` (`FunctionID`) ON DELETE CASCADE;

--
-- Constraints for table `userroles`
--
ALTER TABLE `userroles`
  ADD CONSTRAINT `userroles_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `userroles_ibfk_2` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

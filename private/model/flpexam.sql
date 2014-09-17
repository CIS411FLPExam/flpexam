-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2014 at 02:55 AM
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
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `AnswerID` int(11) NOT NULL AUTO_INCREMENT,
  `QuestionID` int(11) NOT NULL,
  `Correct` tinyint(1) NOT NULL DEFAULT '0',
  `Name` text NOT NULL,
  PRIMARY KEY (`AnswerID`,`QuestionID`),
  UNIQUE KEY `AnswerID` (`AnswerID`),
  KEY `questionid_fk` (`QuestionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`AnswerID`, `QuestionID`, `Correct`, `Name`) VALUES
(16, 3, 1, 'The sky.'),
(17, 3, 0, 'Chilling hard.'),
(22, 14, 1, 'Answers'),
(23, 15, 1, 'doe'),
(25, 16, 1, 'Answer.'),
(27, 17, 1, 'An');

-- --------------------------------------------------------

--
-- Table structure for table `examparameters`
--

CREATE TABLE IF NOT EXISTS `examparameters` (
  `ParameterID` int(11) NOT NULL AUTO_INCREMENT,
  `KeyCode` varchar(40) NOT NULL,
  `QuestionCount` int(11) NOT NULL DEFAULT '10',
  `IncLevelScore` decimal(5,4) NOT NULL DEFAULT '0.8000',
  `DecLevelScore` decimal(5,4) NOT NULL DEFAULT '0.8000',
  PRIMARY KEY (`ParameterID`),
  UNIQUE KEY `ParameterID` (`ParameterID`),
  UNIQUE KEY `KeyCode` (`KeyCode`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `examparameters`
--

INSERT INTO `examparameters` (`ParameterID`, `KeyCode`, `QuestionCount`, `IncLevelScore`, `DecLevelScore`) VALUES
(1, 'cis411', 10, '0.8000', '0.5000');

-- --------------------------------------------------------

--
-- Table structure for table `functions`
--

CREATE TABLE IF NOT EXISTS `functions` (
  `FunctionID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  `Description` text,
  PRIMARY KEY (`FunctionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

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
(22, 'ManageLanguages', 'Allows for displaying all languages and interface to add, change, delete, and view.'),
(23, 'QuestionAdd', 'Allows the user to add a question to a language.'),
(24, 'QuestionEdit', 'Allows a user to edit an existing questinon.'),
(25, 'QuestionDelete', 'Allows the user to delete a question.'),
(26, 'QuestionView', 'Allows the user to view a question.'),
(27, 'ManageQuestions', 'Allows the user access to the panel to manage questions.'),
(28, 'QuestionSearch', 'Allows the user to search questions.'),
(29, 'ExamParametersView', 'Allows the user to view the exam parameters.'),
(30, 'ExamParametersEdit', 'Allows the user to edit the exam parameters.'),
(31, 'ManageTests', 'Allows the user to manage test scores.'),
(32, 'TestView', 'Allows the user to view a test.');

-- --------------------------------------------------------

--
-- Table structure for table `languageexperiences`
--

CREATE TABLE IF NOT EXISTS `languageexperiences` (
  `ExperienceID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  PRIMARY KEY (`Name`),
  UNIQUE KEY `ExperienceID` (`ExperienceID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `languageexperiences`
--

INSERT INTO `languageexperiences` (`ExperienceID`, `Name`) VALUES
(1, 'None'),
(2, '1 - 2 years'),
(3, '2 - 3 years'),
(4, '3 - 4 years'),
(5, '4+ years');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `LanguageID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Name`),
  UNIQUE KEY `LanguageID` (`LanguageID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`LanguageID`, `Name`, `Active`) VALUES
(1, 'French', 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `QuestionID` int(11) NOT NULL AUTO_INCREMENT,
  `Level` int(11) NOT NULL,
  `Name` text NOT NULL,
  `LanguageID` int(11) NOT NULL,
  `Instructions` text NOT NULL,
  PRIMARY KEY (`QuestionID`),
  KEY `question_language_fk` (`LanguageID`),
  FULLTEXT KEY `question_ft` (`Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`QuestionID`, `Level`, `Name`, `LanguageID`, `Instructions`) VALUES
(3, 1, 'Sup yo?', 1, 'Tell me what''s really good.'),
(14, 1, 'Questions', 1, ''),
(15, 1, 'sup', 1, ''),
(16, 1, 'Question.', 1, 'Instructions.'),
(17, 2, 'Ques', 1, 'Instruc');

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
(1, 30),
(1, 29),
(1, 7),
(1, 9),
(1, 8),
(1, 18),
(1, 20),
(1, 19),
(1, 21),
(1, 6),
(1, 22),
(1, 27),
(1, 11),
(1, 31),
(1, 1),
(1, 10),
(1, 15),
(1, 5),
(1, 23),
(1, 25),
(1, 24),
(1, 28),
(1, 26),
(1, 12),
(1, 14),
(1, 13),
(1, 32),
(1, 4),
(1, 3),
(1, 16),
(1, 17),
(3, 18),
(3, 20),
(3, 19),
(3, 21),
(3, 22),
(3, 27),
(3, 31),
(3, 1),
(3, 23),
(3, 25),
(3, 24),
(3, 28),
(3, 26),
(3, 32),
(3, 16),
(3, 17);

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
(1, 'Admin', 'Full privileges.'),
(3, 'Manager', 'Granted all neccessary permission to manage the site.');

-- --------------------------------------------------------

--
-- Table structure for table `testeeexperiences`
--

CREATE TABLE IF NOT EXISTS `testeeexperiences` (
  `TestID` int(11) NOT NULL,
  `SpokenAtHome` tinyint(1) NOT NULL,
  `JrHighExp` varchar(32) NOT NULL,
  `SrHighExp` varchar(32) NOT NULL,
  `CollegeExp` varchar(32) NOT NULL,
  PRIMARY KEY (`TestID`),
  UNIQUE KEY `TestID` (`TestID`),
  KEY `jrhighexp_languageexperience_fk` (`JrHighExp`),
  KEY `srhighexp_languageexperience_fk` (`SrHighExp`),
  KEY `collegeexp_languageexperience_fk` (`CollegeExp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testeeexperiences`
--

INSERT INTO `testeeexperiences` (`TestID`, `SpokenAtHome`, `JrHighExp`, `SrHighExp`, `CollegeExp`) VALUES
(10, 1, 'None', '1 - 2 years', '2 - 3 years'),
(11, 1, '2 - 3 years', '3 - 4 years', '1 - 2 years'),
(12, 0, 'None', 'None', 'None'),
(13, 0, 'None', 'None', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `testees`
--

CREATE TABLE IF NOT EXISTS `testees` (
  `TestID` int(11) NOT NULL,
  `FirstName` varchar(32) NOT NULL,
  `LastName` varchar(32) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Major` varchar(32) NOT NULL,
  `HighSchool` varchar(32) NOT NULL,
  PRIMARY KEY (`TestID`),
  UNIQUE KEY `TestID` (`TestID`),
  FULLTEXT KEY `name_ft` (`FirstName`,`LastName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testees`
--

INSERT INTO `testees` (`TestID`, `FirstName`, `LastName`, `Email`, `Major`, `HighSchool`) VALUES
(10, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', 'Computer Science', 'Urbana'),
(11, 'Victoria', 'Snelick', 'vpsnelick@gmail.com', 'Computer Information Systems', 'Urbana'),
(12, '', '', '', '', ''),
(13, 'blayze', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `testentries`
--

CREATE TABLE IF NOT EXISTS `testentries` (
  `TestID` int(11) NOT NULL AUTO_INCREMENT,
  `Language` varchar(32) NOT NULL,
  `Score` decimal(6,4) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TestID`),
  UNIQUE KEY `TestID` (`TestID`),
  KEY `testentry_language_fk` (`Language`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `testentries`
--

INSERT INTO `testentries` (`TestID`, `Language`, `Score`, `Date`) VALUES
(10, 'French', '0.0000', '2014-09-14 13:32:59'),
(11, 'French', '0.0000', '2014-09-15 20:00:53'),
(12, 'French', '0.0000', '2014-09-16 11:26:13'),
(13, 'French', '0.0000', '2014-09-16 11:45:19');

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
(4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(32) NOT NULL,
  `Password` varchar(40) NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Password`) VALUES
(1, 'wdgarey', '9c22f986c7a4149924fb8b016ef2958687f9f6b2'),
(2, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(4, 'manager', '1a8565a9dc72048ba03b4156be3e569f22771f23');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `questionid_fk` FOREIGN KEY (`QuestionID`) REFERENCES `questions` (`QuestionID`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `question_language_fk` FOREIGN KEY (`LanguageID`) REFERENCES `languages` (`LanguageID`);

--
-- Constraints for table `rolefunctions`
--
ALTER TABLE `rolefunctions`
  ADD CONSTRAINT `rolefunctions_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`) ON DELETE CASCADE,
  ADD CONSTRAINT `rolefunctions_ibfk_2` FOREIGN KEY (`FunctionID`) REFERENCES `functions` (`FunctionID`) ON DELETE CASCADE;

--
-- Constraints for table `testeeexperiences`
--
ALTER TABLE `testeeexperiences`
  ADD CONSTRAINT `collegeexp_languageexperience_fk` FOREIGN KEY (`CollegeExp`) REFERENCES `languageexperiences` (`Name`),
  ADD CONSTRAINT `jrhighexp_languageexperience_fk` FOREIGN KEY (`JrHighExp`) REFERENCES `languageexperiences` (`Name`),
  ADD CONSTRAINT `srhighexp_languageexperience_fk` FOREIGN KEY (`SrHighExp`) REFERENCES `languageexperiences` (`Name`),
  ADD CONSTRAINT `testeeexperiences_testee_fk` FOREIGN KEY (`TestID`) REFERENCES `testentries` (`TestID`);

--
-- Constraints for table `testees`
--
ALTER TABLE `testees`
  ADD CONSTRAINT `testes_testentry_fk` FOREIGN KEY (`TestID`) REFERENCES `testentries` (`TestID`);

--
-- Constraints for table `testentries`
--
ALTER TABLE `testentries`
  ADD CONSTRAINT `testentry_language_fk` FOREIGN KEY (`Language`) REFERENCES `languages` (`Name`);

--
-- Constraints for table `userroles`
--
ALTER TABLE `userroles`
  ADD CONSTRAINT `userroles_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `userroles_ibfk_2` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

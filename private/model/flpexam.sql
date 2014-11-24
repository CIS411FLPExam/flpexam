-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2014 at 01:09 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cis411_flpexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `AnswerID` int(11) NOT NULL AUTO_INCREMENT,
  `QuestionID` int(11) NOT NULL,
  `Correct` tinyint(1) NOT NULL DEFAULT '0',
  `Name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Chosen` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`AnswerID`,`QuestionID`),
  UNIQUE KEY `AnswerID` (`AnswerID`),
  KEY `questionid_fk` (`QuestionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `ContactID` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(32) NOT NULL,
  `LastName` varchar(32) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Primary` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ContactID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `examparameters`
--

CREATE TABLE IF NOT EXISTS `examparameters` (
  `ParameterID` int(11) NOT NULL AUTO_INCREMENT,
  `KeyCode` varchar(40) NOT NULL,
  `QuestionCount` int(11) NOT NULL DEFAULT '10',
  `IncLevelScore` decimal(5,4) NOT NULL DEFAULT '0.8000',
  `DecLevelScore` decimal(5,4) NOT NULL DEFAULT '0.5000',
  `SpokenAtHomeInitLevel` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ParameterID`),
  UNIQUE KEY `ParameterID` (`ParameterID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `examparameters`
--

INSERT INTO `examparameters` (`ParameterID`, `KeyCode`, `QuestionCount`, `IncLevelScore`, `DecLevelScore`, `SpokenAtHomeInitLevel`) VALUES
(1, 'cis411', 10, '0.8000', '0.5000', 4);

-- --------------------------------------------------------

--
-- Table structure for table `experienceoptions`
--

CREATE TABLE IF NOT EXISTS `experienceoptions` (
  `OptionID` int(11) NOT NULL AUTO_INCREMENT,
  `ExperienceID` int(11) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `InitLevel` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ExperienceID`,`Name`),
  UNIQUE KEY `OptionID` (`OptionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `experienceoptions`
--

INSERT INTO `experienceoptions` (`OptionID`, `ExperienceID`, `Name`, `InitLevel`) VALUES
(9, 1, '1 Year', 1),
(10, 1, '2 Years', 1),
(11, 1, '3 Years', 1),
(6, 1, 'None', 1),
(13, 2, '1 Year', 1),
(14, 2, '2 Years', 1),
(15, 2, '3 Years', 2),
(16, 2, '4+ Years', 2),
(8, 2, 'None', 1),
(17, 3, '1 Semester', 1),
(18, 3, '2 Semesters', 1),
(19, 3, '3 Semesters', 1),
(20, 3, '4+ Semesters', 1),
(7, 3, 'None', 1);

-- --------------------------------------------------------

--
-- Table structure for table `functions`
--

CREATE TABLE IF NOT EXISTS `functions` (
  `FunctionID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  `Description` text,
  PRIMARY KEY (`FunctionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

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
(31, 'ManageTestEntries', 'Allows the user to manage test scores.'),
(32, 'TestEntryView', 'Allows the user to view a test.'),
(33, 'LanguageImport', 'Allows the user to import the questions for a langauge.'),
(34, 'LanguageExport', 'Allows the user to export the questions of a language.'),
(35, 'ContactAdd', 'Allows the user to add a contact.'),
(36, 'ManageContacts', 'Allows the user to manage contacts.'),
(37, 'ContactEdit', 'Allows the user to edit a contact.'),
(38, 'ContactDelete', 'Allows the user to delete a contact.'),
(39, 'LevelInfoAdd', 'Allows for adding of level infos.'),
(40, 'LevelInfoView', 'Allows for viewing level infos.'),
(41, 'LevelInfoEdit', 'Allows for editing level infos.'),
(42, 'LevelInfoDelete', 'Allows for deleting level infos.'),
(43, 'ManageLevelInfos', 'Allows for viewing interface to add, edit, and delete level infos.'),
(44, 'LanguageExperiencesEdit', 'Allows the user to edit the language experiences.'),
(45, 'LanguageExperiencesView', 'Allows the user to view the language experiences.'),
(46, 'TestEntryDelete', 'Allows the user to delete test records.'),
(47, 'TestEntrySearch', 'Allows the user to search test entries.'),
(48, 'TestView', 'Allows the user to view an actual test.'),
(49, 'LanguageStatisticsExport', 'Allows the user to export the statistics for a language.'),
(50, 'LanguageExperiencesAdd', 'Allows the user to add a language experience'),
(51, 'LanguageExperiencesDelete', 'Allows the user to delete a language experience'),
(52, 'ManageLanguageExperiences', 'Allows the user to manage language experiences'),
(53, 'ExperienceOptionAdd', 'Allows the user to add an experience option'),
(54, 'ExperienceOptionEdit', 'Allows the user to edit an experience option'),
(55, 'ExperienceOptionView', 'Allows the user to view an experience option.'),
(56, 'ExperienceOptionDelete', 'Allows the user to delete an experience option.'),
(57, 'ManageExperienceOptions', 'Allows the user to manage the experience options.'),
(58, 'TestResultsExport', 'Allows the user to export basic test information.'),
(59, 'UserAdd', 'Allows the user to add users.');

-- --------------------------------------------------------

--
-- Table structure for table `languageexperiences`
--

CREATE TABLE IF NOT EXISTS `languageexperiences` (
  `ExperienceID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`Name`),
  UNIQUE KEY `ExperienceID` (`ExperienceID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `languageexperiences`
--

INSERT INTO `languageexperiences` (`ExperienceID`, `Name`, `Description`) VALUES
(3, 'College', 'The estimated amount of college experience you have had with the language.'),
(2, 'High School', 'The estimated amount of high school experience you have had with the language.'),
(1, 'Middle School', 'The estimated amount of middle school experience you have with the language.');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `LanguageID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  `Active` tinyint(1) NOT NULL DEFAULT '0',
  `Feedback` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Name`),
  UNIQUE KEY `LanguageID` (`LanguageID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `levelinfos`
--

CREATE TABLE IF NOT EXISTS `levelinfos` (
  `LevelInfoID` int(11) NOT NULL AUTO_INCREMENT,
  `LanguageID` int(11) NOT NULL,
  `Level` int(11) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Course` varchar(32) NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`Level`,`LanguageID`),
  UNIQUE KEY `LevelInfoID` (`LevelInfoID`),
  KEY `levels_language_fk` (`LanguageID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `questioncomments`
--

CREATE TABLE IF NOT EXISTS `questioncomments` (
  `CommentID` int(11) NOT NULL AUTO_INCREMENT,
  `QuestionID` int(11) NOT NULL,
  `Com` varchar(110) NOT NULL DEFAULT '',
  PRIMARY KEY (`CommentID`),
  KEY `questioncomments_question_fk` (`QuestionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `QuestionID` int(11) NOT NULL AUTO_INCREMENT,
  `Level` int(11) NOT NULL,
  `Name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `LanguageID` int(11) NOT NULL,
  `Instructions` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Flagged` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`QuestionID`),
  KEY `question_language_fk` (`LanguageID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

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
(1, 35),
(1, 38),
(1, 37),
(1, 30),
(1, 29),
(1, 53),
(1, 56),
(1, 54),
(1, 55),
(1, 7),
(1, 9),
(1, 8),
(1, 18),
(1, 19),
(1, 50),
(1, 51),
(1, 44),
(1, 45),
(1, 34),
(1, 33),
(1, 49),
(1, 21),
(1, 39),
(1, 42),
(1, 41),
(1, 40),
(1, 36),
(1, 57),
(1, 6),
(1, 52),
(1, 22),
(1, 43),
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
(1, 46),
(1, 47),
(1, 32),
(1, 58),
(1, 48),
(1, 4),
(1, 3),
(1, 16),
(1, 17),
(1, 20),
(3, 35),
(3, 38),
(3, 37),
(3, 30),
(3, 29),
(3, 53),
(3, 56),
(3, 54),
(3, 55),
(3, 18),
(3, 19),
(3, 50),
(3, 51),
(3, 44),
(3, 45),
(3, 34),
(3, 33),
(3, 49),
(3, 21),
(3, 39),
(3, 42),
(3, 41),
(3, 40),
(3, 36),
(3, 57),
(3, 52),
(3, 22),
(3, 43),
(3, 27),
(3, 31),
(3, 23),
(3, 25),
(3, 24),
(3, 28),
(3, 26),
(3, 46),
(3, 47),
(3, 32),
(3, 58),
(3, 48),
(1, 59);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `RoleID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  `Description` text,
  `Vital` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`RoleID`, `Name`, `Description`, `Vital`) VALUES
(1, 'Admin', 'Full privileges.', 1),
(3, 'Manager', 'Granted all neccessary permission to manage the site.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `testeeanswers`
--

CREATE TABLE IF NOT EXISTS `testeeanswers` (
  `TestID` int(11) NOT NULL,
  `QuestionNo` int(11) NOT NULL,
  `AnswerNo` int(11) NOT NULL,
  `Answer` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Chosen` tinyint(1) NOT NULL DEFAULT '0',
  `Correct` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`TestID`,`QuestionNo`,`AnswerNo`),
  KEY `testeeanswers_testeequestion_fk` (`TestID`,`QuestionNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testeeexperiences`
--

CREATE TABLE IF NOT EXISTS `testeeexperiences` (
  `TestID` int(11) NOT NULL,
  `Experience` varchar(32) NOT NULL,
  `ExperienceOption` varchar(32) NOT NULL,
  PRIMARY KEY (`TestID`,`Experience`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testeequestions`
--

CREATE TABLE IF NOT EXISTS `testeequestions` (
  `TestID` int(11) NOT NULL,
  `QuestionNo` int(11) NOT NULL,
  `Level` int(11) NOT NULL,
  `Instructions` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Question` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`TestID`,`QuestionNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testees`
--

CREATE TABLE IF NOT EXISTS `testees` (
  `TestID` int(11) NOT NULL,
  `FirstName` varchar(32) NOT NULL,
  `LastName` varchar(32) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Major` varchar(32) NOT NULL DEFAULT 'Not Listed',
  `HighSchool` varchar(32) NOT NULL DEFAULT 'Not Listed',
  `SpokenAtHome` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`TestID`),
  UNIQUE KEY `TestID` (`TestID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testentries`
--

CREATE TABLE IF NOT EXISTS `testentries` (
  `TestID` int(11) NOT NULL AUTO_INCREMENT,
  `Language` varchar(32) NOT NULL,
  `Score` int(11) NOT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`TestID`),
  UNIQUE KEY `TestID` (`TestID`),
  KEY `testentry_language_fk` (`Language`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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
  `Vital` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `UserName`, `Password`, `Vital`) VALUES
(2, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1),
(4, 'manager', '1a8565a9dc72048ba03b4156be3e569f22771f23', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `questionid_fk` FOREIGN KEY (`QuestionID`) REFERENCES `questions` (`QuestionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `experienceoptions`
--
ALTER TABLE `experienceoptions`
  ADD CONSTRAINT `languageexperienceoptions_languageexperience_fk` FOREIGN KEY (`ExperienceID`) REFERENCES `languageexperiences` (`ExperienceID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `levelinfos`
--
ALTER TABLE `levelinfos`
  ADD CONSTRAINT `levels_language_fk` FOREIGN KEY (`LanguageID`) REFERENCES `languages` (`LanguageID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questioncomments`
--
ALTER TABLE `questioncomments`
  ADD CONSTRAINT `questioncomments_question_fk` FOREIGN KEY (`QuestionID`) REFERENCES `questions` (`QuestionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `question_language_fk` FOREIGN KEY (`LanguageID`) REFERENCES `languages` (`LanguageID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rolefunctions`
--
ALTER TABLE `rolefunctions`
  ADD CONSTRAINT `rolefunctions_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`) ON DELETE CASCADE,
  ADD CONSTRAINT `rolefunctions_ibfk_2` FOREIGN KEY (`FunctionID`) REFERENCES `functions` (`FunctionID`) ON DELETE CASCADE;

--
-- Constraints for table `testeeanswers`
--
ALTER TABLE `testeeanswers`
  ADD CONSTRAINT `testeeanswers_testeequestion_fk` FOREIGN KEY (`TestID`, `QuestionNo`) REFERENCES `testeequestions` (`TestID`, `QuestionNo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testeeexperiences`
--
ALTER TABLE `testeeexperiences`
  ADD CONSTRAINT `testeeexperiences_testentry_fk` FOREIGN KEY (`TestID`) REFERENCES `testees` (`TestID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testeequestions`
--
ALTER TABLE `testeequestions`
  ADD CONSTRAINT `testeequestions_testentry_fk` FOREIGN KEY (`TestID`) REFERENCES `testentries` (`TestID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testees`
--
ALTER TABLE `testees`
  ADD CONSTRAINT `testes_testentry_fk` FOREIGN KEY (`TestID`) REFERENCES `testentries` (`TestID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `testentries`
--
ALTER TABLE `testentries`
  ADD CONSTRAINT `testentry_language_fk` FOREIGN KEY (`Language`) REFERENCES `languages` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userroles`
--
ALTER TABLE `userroles`
  ADD CONSTRAINT `userroles_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `userroles_ibfk_2` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

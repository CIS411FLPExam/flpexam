-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2014 at 07:01 PM
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
-- Table structure for table `ambiguousquestions`
--

CREATE TABLE IF NOT EXISTS `ambiguousquestions` (
  `QuestionID` int(11) NOT NULL,
  `Count` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`QuestionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `AnswerID` int(11) NOT NULL AUTO_INCREMENT,
  `QuestionID` int(11) NOT NULL,
  `Correct` tinyint(1) NOT NULL DEFAULT '0',
  `Name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`AnswerID`,`QuestionID`),
  UNIQUE KEY `AnswerID` (`AnswerID`),
  KEY `questionid_fk` (`QuestionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=829 ;

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

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`ContactID`, `FirstName`, `LastName`, `Email`, `Primary`) VALUES
(1, 'Katy', 'O''Donnell', 'kodonnell@clarion.edu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `CourseID` int(11) NOT NULL AUTO_INCREMENT,
  `LanguageID` int(11) NOT NULL,
  `Name` varchar(32) NOT NULL,
  PRIMARY KEY (`LanguageID`,`Name`),
  UNIQUE KEY `CourseID` (`CourseID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`CourseID`, `LanguageID`, `Name`) VALUES
(1, 2, 'Spanish 151'),
(2, 2, 'Spanish 152'),
(3, 2, 'Spanish 251'),
(4, 2, 'Spanish 252'),
(5, 2, 'Spanish 270'),
(6, 2, 'Spanish 300');

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
(1, 'cis411', 2, '0.8000', '0.5000');

-- --------------------------------------------------------

--
-- Table structure for table `functions`
--

CREATE TABLE IF NOT EXISTS `functions` (
  `FunctionID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  `Description` text,
  PRIMARY KEY (`FunctionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

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
(49, 'LanguageStatisticsExport', 'Allows the user to export the statistics for a language.');

-- --------------------------------------------------------

--
-- Table structure for table `languageexperiences`
--

CREATE TABLE IF NOT EXISTS `languageexperiences` (
  `ExperienceID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  `InitLevel` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`Name`),
  UNIQUE KEY `ExperienceID` (`ExperienceID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `languageexperiences`
--

INSERT INTO `languageexperiences` (`ExperienceID`, `Name`, `InitLevel`) VALUES
(2, '1 - 2 years', 1),
(3, '2 - 3 years', 1),
(4, '3 - 4 years', 2),
(5, '4+ years', 2),
(1, 'None', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`LanguageID`, `Name`, `Active`) VALUES
(2, 'Spanish', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `levelinfos`
--

INSERT INTO `levelinfos` (`LevelInfoID`, `LanguageID`, `Level`, `Name`, `Course`, `Description`) VALUES
(5, 2, 1, 'Beginners Spanish 1', 'Spanish 151', 'This level is for people who have little to no experience speaking Spanish.'),
(6, 2, 2, 'Beginning Spanish 2', 'Spanish 152', 'This level is for people who have a some experience speaking Spanish.'),
(7, 2, 3, 'Intermediate Spanish 1', 'Spanish 251', 'This is level is for people who have a fair amount of experience speaking Spanish.'),
(8, 2, 4, 'Intermediate Spanish 2', 'Spanish 252', 'This level is for more advanced Spanish speakers.');

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
  PRIMARY KEY (`QuestionID`),
  KEY `question_language_fk` (`LanguageID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=153 ;

-- --------------------------------------------------------

--
-- Table structure for table `questionstatistics`
--

CREATE TABLE IF NOT EXISTS `questionstatistics` (
  `AnswerID` int(11) NOT NULL,
  `Count` int(11) NOT NULL DEFAULT '1',
  UNIQUE KEY `AnswerID` (`AnswerID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(3, 35),
(3, 38),
(3, 37),
(3, 18),
(3, 20),
(3, 19),
(3, 34),
(3, 33),
(3, 21),
(3, 39),
(3, 42),
(3, 41),
(3, 40),
(3, 36),
(3, 22),
(3, 43),
(3, 27),
(3, 31),
(3, 23),
(3, 25),
(3, 24),
(3, 28),
(3, 26),
(3, 32),
(3, 47),
(1, 35),
(1, 38),
(1, 37),
(1, 30),
(1, 29),
(1, 7),
(1, 9),
(1, 8),
(1, 18),
(1, 20),
(1, 19),
(1, 44),
(1, 45),
(1, 34),
(1, 33),
(1, 21),
(1, 39),
(1, 42),
(1, 41),
(1, 40),
(1, 36),
(1, 6),
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
(1, 48),
(1, 4),
(1, 3),
(1, 16),
(1, 17),
(1, 49);

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
-- Table structure for table `spokenathomeinitlevel`
--

CREATE TABLE IF NOT EXISTS `spokenathomeinitlevel` (
  `InitLevel` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spokenathomeinitlevel`
--

INSERT INTO `spokenathomeinitlevel` (`InitLevel`) VALUES
(4);

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
  `SpokenAtHome` tinyint(1) NOT NULL,
  `JrHighExp` varchar(32) NOT NULL,
  `SrHighExp` varchar(32) NOT NULL,
  `CollegeExp` varchar(32) NOT NULL,
  `CurrentCourse` varchar(32) NOT NULL DEFAULT 'Nothing',
  PRIMARY KEY (`TestID`),
  UNIQUE KEY `TestID` (`TestID`),
  KEY `collegeexp_languageexperience_fk` (`CollegeExp`),
  KEY `jrhighexp_languageexperience_fk` (`JrHighExp`),
  KEY `srhighexp_languageexperience_fk` (`SrHighExp`)
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

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
-- Constraints for table `ambiguousquestions`
--
ALTER TABLE `ambiguousquestions`
  ADD CONSTRAINT `ambiguousquestions_question_fk` FOREIGN KEY (`QuestionID`) REFERENCES `questions` (`QuestionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `questionid_fk` FOREIGN KEY (`QuestionID`) REFERENCES `questions` (`QuestionID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `course_language_fk` FOREIGN KEY (`LanguageID`) REFERENCES `languages` (`LanguageID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `levelinfos`
--
ALTER TABLE `levelinfos`
  ADD CONSTRAINT `levels_language_fk` FOREIGN KEY (`LanguageID`) REFERENCES `languages` (`LanguageID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `question_language_fk` FOREIGN KEY (`LanguageID`) REFERENCES `languages` (`LanguageID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questionstatistics`
--
ALTER TABLE `questionstatistics`
  ADD CONSTRAINT `questionstatistic_answers_fk` FOREIGN KEY (`AnswerID`) REFERENCES `answers` (`AnswerID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `collegeexp_languageexperience_fk` FOREIGN KEY (`CollegeExp`) REFERENCES `languageexperiences` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jrhighexp_languageexperience_fk` FOREIGN KEY (`JrHighExp`) REFERENCES `languageexperiences` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `srhighexp_languageexperience_fk` FOREIGN KEY (`SrHighExp`) REFERENCES `languageexperiences` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `testeeexperiences_testee_fk` FOREIGN KEY (`TestID`) REFERENCES `testentries` (`TestID`) ON DELETE CASCADE ON UPDATE CASCADE;

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

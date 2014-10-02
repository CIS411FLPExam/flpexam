-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2014 at 05:39 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=101 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`AnswerID`, `QuestionID`, `Correct`, `Name`) VALUES
(53, 2, 1, 'La'),
(54, 2, 0, 'Las'),
(55, 2, 0, 'El'),
(56, 2, 0, 'Los'),
(57, 3, 1, 'una, la'),
(58, 3, 0, 'un, el'),
(59, 3, 0, 'una, el'),
(60, 3, 0, 'un, la'),
(61, 4, 1, 'interesante'),
(62, 4, 0, 'grande'),
(63, 4, 0, 'simpÃ¡tica'),
(64, 4, 0, 'pequeÃ±a'),
(65, 5, 1, 'se cepilla'),
(66, 5, 0, 'me lavo'),
(67, 5, 0, 'te vistes'),
(68, 5, 0, 'nos levantamos'),
(69, 6, 1, 'duermo'),
(70, 6, 0, 'como'),
(71, 6, 0, 'habla'),
(72, 6, 0, 'escuchas'),
(73, 7, 1, 'me levantÃ©'),
(74, 7, 0, 'me levanto'),
(75, 7, 0, 'te acostaste'),
(76, 7, 0, 'te acuestas'),
(77, 12, 1, 'visitamos'),
(78, 12, 0, 'hablamos'),
(79, 12, 0, 'fueron'),
(80, 12, 0, 'dormimos'),
(81, 8, 1, 'un piloto'),
(82, 8, 0, 'un veterinario'),
(83, 8, 0, 'un mÃ©dico'),
(84, 8, 0, 'un psicÃ³logo'),
(85, 9, 1, 'una psicÃ³loga'),
(86, 9, 0, 'una ejecutiva'),
(87, 9, 0, 'una veterinaria'),
(88, 9, 0, 'una mÃ©dica'),
(89, 10, 1, 'sea'),
(90, 10, 0, 'seas'),
(91, 10, 0, 'es'),
(92, 10, 0, 'eres'),
(93, 11, 1, 'sea'),
(94, 11, 0, 'seas'),
(95, 11, 0, 'es'),
(96, 11, 0, 'eres'),
(97, 1, 1, 'una'),
(98, 1, 0, 'un'),
(99, 1, 0, 'unas'),
(100, 1, 0, 'unos');

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
(1, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', 1);

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
(1, 'cis411', 2, '1.0000', '0.0000');

-- --------------------------------------------------------

--
-- Table structure for table `functions`
--

CREATE TABLE IF NOT EXISTS `functions` (
  `FunctionID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(32) NOT NULL,
  `Description` text,
  PRIMARY KEY (`FunctionID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

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
(32, 'TestView', 'Allows the user to view a test.'),
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
(43, 'ManageLevelInfos', 'Allows for viewing interface to add, edit, and delete level infos.');

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
  `Name` text NOT NULL,
  `LanguageID` int(11) NOT NULL,
  `Instructions` text NOT NULL,
  PRIMARY KEY (`QuestionID`),
  KEY `question_language_fk` (`LanguageID`),
  FULLTEXT KEY `question_ft` (`Name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`QuestionID`, `Level`, `Name`, `LanguageID`, `Instructions`) VALUES
(1, 1, 'Estudio en  _____  universidad muy buena.', 2, 'Indicate whether the noun in this sentence is masculine or feminine, singular or plural by filling in the correct form of the indefinite article.'),
(2, 1, '__________  universidad es pequeÃ±a y muy bonita.', 2, 'Complete the following sentence with the correct form of the definite article in Spanish.'),
(3, 1, 'Â¿Hay  ______________  biblioteca grande en  ______________  universidad?', 2, 'Complete the following question a correct form of the definite or indefinite article.'),
(4, 1, 'Â¿Es la clase de espaÃ±ol aburrida? No, es muy  _____________________________ .', 2, 'Complete the answer to the question that Laura asks Eric about his first impressions of his Spanish class by providing the antonym (opposite) of the adjective in italics.'),
(5, 2, 'AndrÃ©s _____ los dientes despuÃ©s de desayunar.', 2, 'Complete the following sentence with the correct form of the appropriate verb. '),
(6, 2, 'Yo siempre tengo sueÃ±o en clase pero nunca __________ en clase.	', 2, 'Read the sentence and choose the logical word.'),
(7, 3, 'Mi esposo durmiÃ³ tarde pero yo _____ muy temprano.', 2, 'Complete the sentence with the correct form of the appropriate reflexive verb in the preterit. '),
(8, 4, 'Un hombre que conduce aviones es _______.', 2, 'Complete the sentence with the logical word.'),
(9, 4, 'Una mujer que cuida la salud mental de sus pacientes es _______', 2, 'Complete the sentence with the logical word.'),
(10, 4, 'Mi padre bajÃ³ de peso sin razÃ³n y siempre tiene sed. Es posible que _____ diabÃ©tico', 2, 'Read the descriptions of the symptoms and complete the sentences with the logical phrase.'),
(11, 4, 'Mi padre bajÃ³ de peso sin razÃ³n y siempre tiene sed. Es posible que _____ diabÃ©tico', 2, 'Read the descriptions of the symptoms and complete the sentences with the logical phrase.'),
(12, 3, 'El aÃ±o pasado, fuimos de vacaciones a MÃ©xico. Primero mi esposo y yo _____ a la agencia de viajes.', 2, 'Complete the sentence in a logical way.');

-- --------------------------------------------------------

--
-- Table structure for table `questionstatistics`
--

CREATE TABLE IF NOT EXISTS `questionstatistics` (
  `AnswerID` int(11) NOT NULL,
  `Count` int(11) NOT NULL DEFAULT '0',
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
(1, 32),
(1, 4),
(1, 3),
(1, 16),
(1, 17),
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
(3, 32);

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
(26, 0, '2 - 3 years', '1 - 2 years', 'None'),
(27, 0, 'None', 'None', 'None'),
(28, 0, 'None', 'None', 'None'),
(29, 0, 'None', 'None', 'None'),
(30, 0, 'None', 'None', 'None'),
(31, 0, 'None', 'None', 'None'),
(33, 0, 'None', 'None', 'None'),
(34, 1, '1 - 2 years', '2 - 3 years', '4+ years'),
(35, 0, 'None', 'None', 'None'),
(36, 0, 'None', 'None', 'None'),
(37, 0, 'None', 'None', 'None'),
(38, 0, 'None', 'None', 'None'),
(39, 0, 'None', 'None', 'None'),
(40, 0, 'None', 'None', 'None'),
(41, 0, 'None', 'None', 'None'),
(42, 0, 'None', 'None', 'None'),
(43, 0, 'None', 'None', 'None'),
(44, 0, 'None', 'None', 'None'),
(45, 0, 'None', 'None', 'None'),
(46, 0, 'None', 'None', 'None'),
(47, 0, 'None', 'None', 'None');

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
  UNIQUE KEY `TestID` (`TestID`),
  FULLTEXT KEY `name_ft` (`FirstName`,`LastName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testees`
--

INSERT INTO `testees` (`TestID`, `FirstName`, `LastName`, `Email`, `Major`, `HighSchool`) VALUES
(26, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', '', ''),
(27, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', '', ''),
(28, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', '', ''),
(29, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', 'Computer Science', 'Urbana'),
(30, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', 'Computer Science', 'Urbana'),
(31, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', 'Computer Science', 'Urbana'),
(33, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', 'Computer Science', 'Urbana'),
(34, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', 'Computer Science', 'Urbana'),
(35, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', 'Computer Science', 'Urbana'),
(36, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', '', ''),
(37, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', '', ''),
(38, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', '', ''),
(39, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', '', ''),
(40, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', '', ''),
(41, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', '', ''),
(42, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', '', ''),
(43, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', '', ''),
(44, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', '', ''),
(45, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', '', ''),
(46, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', '', ''),
(47, 'Wesley', 'Garey', 'w.d.garey@eagle.clarion.edu', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `testentries`
--

CREATE TABLE IF NOT EXISTS `testentries` (
  `TestID` int(11) NOT NULL AUTO_INCREMENT,
  `Language` varchar(32) NOT NULL,
  `Score` int(11) NOT NULL,
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`TestID`),
  UNIQUE KEY `TestID` (`TestID`),
  KEY `testentry_language_fk` (`Language`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `testentries`
--

INSERT INTO `testentries` (`TestID`, `Language`, `Score`, `Date`) VALUES
(26, 'Spanish', 0, '2014-09-24 14:48:10'),
(27, 'Spanish', 3, '2014-09-24 16:43:11'),
(28, 'Spanish', 2, '2014-10-01 15:41:33'),
(29, 'Spanish', 2, '2014-10-01 15:43:03'),
(30, 'Spanish', 2, '2014-10-01 15:44:41'),
(31, 'Spanish', 2, '2014-10-01 15:46:24'),
(33, 'Spanish', 2, '2014-10-01 16:59:09'),
(34, 'Spanish', 2, '2014-10-01 17:01:27'),
(35, 'Spanish', 2, '2014-10-01 17:02:34'),
(36, 'Spanish', 2, '2014-10-01 17:04:19'),
(37, 'Spanish', 2, '2014-10-01 17:06:05'),
(38, 'Spanish', 2, '2014-10-01 17:08:43'),
(39, 'Spanish', 2, '2014-10-01 17:10:32'),
(40, 'Spanish', 2, '2014-10-01 17:11:29'),
(41, 'Spanish', 2, '2014-10-01 17:18:50'),
(42, 'Spanish', 2, '2014-10-01 17:20:37'),
(43, 'Spanish', 2, '2014-10-01 17:21:59'),
(44, 'Spanish', 2, '2014-10-01 17:23:34'),
(45, 'Spanish', 2, '2014-10-01 17:24:58'),
(46, 'Spanish', 2, '2014-10-01 17:27:20'),
(47, 'Spanish', 2, '2014-10-01 17:28:46');

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
  ADD CONSTRAINT `questionid_fk` FOREIGN KEY (`QuestionID`) REFERENCES `questions` (`QuestionID`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `testeeexperiences`
--
ALTER TABLE `testeeexperiences`
  ADD CONSTRAINT `collegeexp_languageexperience_fk` FOREIGN KEY (`CollegeExp`) REFERENCES `languageexperiences` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jrhighexp_languageexperience_fk` FOREIGN KEY (`JrHighExp`) REFERENCES `languageexperiences` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `srhighexp_languageexperience_fk` FOREIGN KEY (`SrHighExp`) REFERENCES `languageexperiences` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `testeeexperiences_testee_fk` FOREIGN KEY (`TestID`) REFERENCES `testentries` (`TestID`) ON DELETE CASCADE ON UPDATE CASCADE;

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

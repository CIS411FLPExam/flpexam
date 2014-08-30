-- The functions table contains all available role functions.

-- Create funtions table.
CREATE TABLE IF NOT EXISTS `functions` (
  `functionid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` text,
  PRIMARY KEY (`functionid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- Add in all basic functions.
INSERT INTO `functions` (`functionid`, `name`, `description`) VALUES
(1, 'manageusers', 'Allows for reading users and interface to add, change, and delete.'),
(2, 'useradd', 'Allows for adding of users by enabling link on manage form.'),
(3, 'useredit', 'Allows for editing of users by enabling link on manage form.'),
(4, 'userdelete', 'Allows for deleting of users by enabling checkbox on manage form.'),
(5, 'processuseraddedit', 'Required to process an add, change, or delete of users.'),
(6, 'managefunctions', 'Allows for reading functions and interface to add, change, and delete.'),
(7, 'functionadd', 'Allows for adding of functions by enabling link on manage form.'),
(8, 'functionedit', 'Allows for editing of functions by enabling link on manage form.'),
(9, 'functiondelete', 'Allows for deleting of functions by enabling checkbox on manage form.'),
(10, 'processfunctionaddedit', 'Required to process an add, change, or delete of functions.'),
(11, 'manageroles', 'Allows for reading roles and interface to add, change, and delete.'),
(12, 'roleadd', 'Allows for adding of roles by enabling link on manage form.'),
(13, 'roleedit', 'Allows for editing of roles by enabling link on manage form.'),
(14, 'roledelete', 'Allows for deleting of roles by enabling checkbox on manage form.'),
(15, 'processRoleaddedit', 'Required to process an add, change, or delete of roles.');

-- -----------------------------------------------------------------------------

-- The rolefunctions table relates each role to the appropriate functions.

-- Create the rolefunctions table.
CREATE TABLE IF NOT EXISTS `rolefunctions` (
  `roleid` int(11) NOT NULL,
  `functionid` int(11) NOT NULL,
  KEY `roleid` (`roleid`),
  KEY `functionid` (`functionid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Add all available functions to the admin role.
INSERT INTO `rolefunctions` (`roleid`, `functionid`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15);

-- -----------------------------------------------------------------------------

-- The roles table contains all available user roles

-- Create the roles tables.
CREATE TABLE IF NOT EXISTS `roles` (
  `roleid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` text,
  PRIMARY KEY (`roleid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- Add the administrative role.
INSERT INTO `roles` (`roleid`, `name`, `description`) VALUES
(1, 'admin', 'Full privileges.');

-- -----------------------------------------------------------------------------

-- The userroles table relates each user to their appropriate roles.

-- Create the userroles table.
CREATE TABLE IF NOT EXISTS `userroles` (
  `userid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL,
  KEY `userid` (`userid`),
  KEY `roleid` (`roleid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Add the admin user and assign it the admin role.
INSERT INTO `userroles` (`userid`, `roleid`) VALUES
(1, 1);

-- -----------------------------------------------------------------------------

-- The users table contains all registered users.

-- Create the user table.
CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(32) NOT NULL,
  `lastname` varchar(32) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(32) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- Add in the 
INSERT INTO `users` (`userID`, `firstname`, `lastname`, `username`, `password`, `email`) VALUES
(1, 'wdgarey', 'Wesley', 'Garey', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'w.d.garey@eagle.clarion.edu');
-- -----------------------------------------------------------------------------

-- Constraints for table `rolefunctions`
ALTER TABLE `rolefunctions`
  ADD CONSTRAINT `rolefunctions_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `roles` (`Roleid`) ON DELETE CASCADE,
  ADD CONSTRAINT `rolefunctions_ibfk_2` FOREIGN KEY (`functionid`) REFERENCES `functions` (`functionid`) ON DELETE CASCADE;

-- Constraints for table `userroles`
ALTER TABLE `userroles`
  ADD CONSTRAINT `userroles_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE,
  ADD CONSTRAINT `userroles_ibfk_2` FOREIGN KEY (`roleid`) REFERENCES `roles` (`roleid`) ON DELETE CASCADE;
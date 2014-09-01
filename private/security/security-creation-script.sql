CREATE TABLE functions ( FunctionID INT NOT NULL AUTO_INCREMENT,
                         Name VARCHAR(32) NOT NULL,
                         Description TEXT,	 
                         PRIMARY KEY (FunctionID) );


CREATE TABLE roles ( RoleID INT NOT NULL AUTO_INCREMENT,
                     Name VARCHAR(32) NOT NULL,
                     Description TEXT,
                     PRIMARY KEY (RoleID) );


CREATE TABLE users ( UserID INT NOT NULL AUTO_INCREMENT,
                     FirstName VARCHAR(32) NOT NULL,
                     LastName VARCHAR(32) NOT NULL,
                     UserName VARCHAR(32) NOT NULL,
                     Password VARCHAR(40) NOT NULL,
                     Email VARCHAR(32) NOT NULL,
                     PRIMARY KEY (UserID) );

CREATE TABLE rolefunctions ( RoleID INT NOT NULL,
                             FunctionID INT NOT NULL,
                             FOREIGN KEY (RoleID) REFERENCES Roles(RoleID) ON DELETE CASCADE,
                             FOREIGN KEY (FunctionID) REFERENCES Functions(FunctionID) ON DELETE CASCADE );

CREATE TABLE userroles ( UserID INT NOT NULL,
                         RoleID INT NOT NULL,
                         FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE,
                         FOREIGN KEY (RoleID) REFERENCES Roles(RoleID) ON DELETE CASCADE);
						 
INSERT INTO functions (Name,Description) VALUES ("ManageUsers","Allows for reading users and interface to add, change, and delete.");
INSERT INTO functions (Name,Description) VALUES ("UserAdd","Allows for adding of users by enabling link on manage form.");
INSERT INTO functions (Name,Description) VALUES ("UserEdit","Allows for editing of users by enabling link on manage form.");
INSERT INTO functions (Name,Description) VALUES ("UserDelete","Allows for deleting of users by enabling checkbox on manage form.");
INSERT INTO functions (Name,Description) VALUES ("ProcessUserAddEdit","Required to process an add, change, or delete of users.");
INSERT INTO functions (Name,Description) VALUES ("ManageFunctions","Allows for reading functions and interface to add, change, and delete.");
INSERT INTO functions (Name,Description) VALUES ("FunctionAdd","Allows for adding of functions by enabling link on manage form.");
INSERT INTO functions (Name,Description) VALUES ("FunctionEdit","Allows for editing of functions by enabling link on manage form.");
INSERT INTO functions (Name,Description) VALUES ("FunctionDelete","Allows for deleting of functions by enabling checkbox on manage form.");
INSERT INTO functions (Name,Description) VALUES ("ProcessFunctionAddEdit","Required to process an add, change, or delete of functions.");
INSERT INTO functions (Name,Description) VALUES ("ManageRoles","Allows for reading roles and interface to add, change, and delete.");
INSERT INTO functions (Name,Description) VALUES ("RoleAdd","Allows for adding of roles by enabling link on manage form.");
INSERT INTO functions (Name,Description) VALUES ("RoleEdit","Allows for editing of roles by enabling link on manage form.");
INSERT INTO functions (Name,Description) VALUES ("RoleDelete","Allows for deleting of roles by enabling checkbox on manage form.");
INSERT INTO functions (Name,Description) VALUES ("ProcessRoleAddEdit","Required to process an add, change, or delete of roles.");

INSERT INTO roles (Name,Description) VALUES ("admin","Full privileges.");

INSERT INTO users (FirstName,LastName,UserName,Password,Email) VALUES ("Wesley","Garey","wdgarey",SHA1('admin'),"w.d.garey@eagle.clarion.edu");
			
INSERT INTO rolefunctions (RoleID,FunctionID) VALUES (1,1);
INSERT INTO rolefunctions (RoleID,FunctionID) VALUES (1,2);
INSERT INTO rolefunctions (RoleID,FunctionID) VALUES (1,3);
INSERT INTO rolefunctions (RoleID,FunctionID) VALUES (1,4);
INSERT INTO rolefunctions (RoleID,FunctionID) VALUES (1,5);
INSERT INTO rolefunctions (RoleID,FunctionID) VALUES (1,6);
INSERT INTO rolefunctions (RoleID,FunctionID) VALUES (1,7);
INSERT INTO rolefunctions (RoleID,FunctionID) VALUES (1,8);
INSERT INTO rolefunctions (RoleID,FunctionID) VALUES (1,9);
INSERT INTO rolefunctions (RoleID,FunctionID) VALUES (1,10);
INSERT INTO rolefunctions (RoleID,FunctionID) VALUES (1,11);
INSERT INTO rolefunctions (RoleID,FunctionID) VALUES (1,12);
INSERT INTO rolefunctions (RoleID,FunctionID) VALUES (1,13);
INSERT INTO rolefunctions (RoleID,FunctionID) VALUES (1,14);
INSERT INTO rolefunctions (RoleID,FunctionID) VALUES (1,15);

INSERT INTO userroles (UserID,RoleID) VALUES (1,1);
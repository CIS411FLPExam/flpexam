CREATE TABLE Functions ( FunctionID INT NOT NULL AUTO_INCREMENT,
                         Name VARCHAR(32) NOT NULL,
                         Description TEXT,	 
                         PRIMARY KEY (FunctionID) );


CREATE TABLE Roles ( RoleID INT NOT NULL AUTO_INCREMENT,
                     Name VARCHAR(32) NOT NULL,
                     Description TEXT,
                     PRIMARY KEY (RoleID) );


CREATE TABLE Users ( UserID INT NOT NULL AUTO_INCREMENT,
                     FirstName VARCHAR(32) NOT NULL,
                     LastName VARCHAR(32) NOT NULL,
                     UserName VARCHAR(32) NOT NULL,
                     Password VARCHAR(40) NOT NULL,
                     Email VARCHAR(32) NOT NULL,
                     PRIMARY KEY (UserID) );

CREATE TABLE RoleFunctions ( RoleID INT NOT NULL,
                             FunctionID INT NOT NULL,
                             FOREIGN KEY (RoleID) REFERENCES Roles(RoleID) ON DELETE CASCADE,
                             FOREIGN KEY (FunctionID) REFERENCES Functions(FunctionID) ON DELETE CASCADE );

CREATE TABLE UserRoles ( UserID INT NOT NULL,
                         RoleID INT NOT NULL,
                         FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE CASCADE,
                         FOREIGN KEY (RoleID) REFERENCES Roles(RoleID) ON DELETE CASCADE);
						 
INSERT INTO Functions (Name,Description) VALUES ("ManageUsers","Allows for reading users and interface to add, change, and delete.");
INSERT INTO Functions (Name,Description) VALUES ("UserAdd","Allows for adding of users by enabling link on manage form.");
INSERT INTO Functions (Name,Description) VALUES ("UserEdit","Allows for editing of users by enabling link on manage form.");
INSERT INTO Functions (Name,Description) VALUES ("UserDelete","Allows for deleting of users by enabling checkbox on manage form.");
INSERT INTO Functions (Name,Description) VALUES ("ProcessUserAddEdit","Required to process an add, change, or delete of users.");
INSERT INTO Functions (Name,Description) VALUES ("ManageFunctions","Allows for reading functions and interface to add, change, and delete.");
INSERT INTO Functions (Name,Description) VALUES ("FunctionAdd","Allows for adding of functions by enabling link on manage form.");
INSERT INTO Functions (Name,Description) VALUES ("FunctionEdit","Allows for editing of functions by enabling link on manage form.");
INSERT INTO Functions (Name,Description) VALUES ("FunctionDelete","Allows for deleting of functions by enabling checkbox on manage form.");
INSERT INTO Functions (Name,Description) VALUES ("ProcessFunctionAddEdit","Required to process an add, change, or delete of functions.");
INSERT INTO Functions (Name,Description) VALUES ("ManageRoles","Allows for reading roles and interface to add, change, and delete.");
INSERT INTO Functions (Name,Description) VALUES ("RoleAdd","Allows for adding of roles by enabling link on manage form.");
INSERT INTO Functions (Name,Description) VALUES ("RoleEdit","Allows for editing of roles by enabling link on manage form.");
INSERT INTO Functions (Name,Description) VALUES ("RoleDelete","Allows for deleting of roles by enabling checkbox on manage form.");
INSERT INTO Functions (Name,Description) VALUES ("ProcessRoleAddEdit","Required to process an add, change, or delete of roles.");

INSERT INTO Roles (Name,Description) VALUES ("admin","Full privileges.");
INSERT INTO Roles (Name,Description) VALUES ("updater","Update/Read privileges.");
INSERT INTO Roles (Name,Description) VALUES ("reader","Read-only privileges.");
INSERT INTO Roles (Name,Description) VALUES ("guest","Read-only privileges.");

INSERT INTO Users (FirstName,LastName,UserName,Password,Email) VALUES ("Jon","ODonnell","admin",SHA1('admin'),"jodonnell@clarion.edu");
INSERT INTO Users (FirstName,LastName,UserName,Password,Email) VALUES ("Bill","Updater","bill",SHA1('bill'),"bill@localhost");
INSERT INTO Users (FirstName,LastName,UserName,Password,Email) VALUES ("Joe","Reader","joe",SHA1('joe'),"joe@localhost");
INSERT INTO Users (FirstName,LastName,UserName,Password,Email) VALUES ("updater","updater","updater",SHA1('updater'),"updater@localhost");
INSERT INTO Users (FirstName,LastName,UserName,Password,Email) VALUES ("reader","reader","reader",SHA1('reader'),"reader@localhost");
INSERT INTO Users (FirstName,LastName,UserName,Password,Email) VALUES ("guest","guest","guest",SHA1('guest'),"guest@localhost");
			
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (1,1);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (1,2);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (1,3);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (1,4);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (1,5);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (1,6);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (1,7);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (1,8);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (1,9);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (1,10);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (1,11);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (1,12);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (1,13);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (1,14);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (1,15);

INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (2,1);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (2,6);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (2,7);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (2,8);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (2,9);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (2,10);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (2,11);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (2,12);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (2,13);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (2,14);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (2,15);

INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (3,1);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (3,6);
INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (3,11);

INSERT INTO RoleFunctions (RoleID,FunctionID) VALUES (4,11);

INSERT INTO UserRoles (UserID,RoleID) VALUES (1,1);
INSERT INTO UserRoles (UserID,RoleID) VALUES (2,2);
INSERT INTO UserRoles (UserID,RoleID) VALUES (3,3);
INSERT INTO UserRoles (UserID,RoleID) VALUES (4,2);
INSERT INTO UserRoles (UserID,RoleID) VALUES (5,3);
INSERT INTO UserRoles (UserID,RoleID) VALUES (6,4);
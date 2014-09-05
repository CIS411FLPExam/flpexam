<?php

    include(MODEL_FILE);
    
    function getUserRoles($ID) {
        try {
            $db = GetDBConnection();
            $query = "SELECT roles.RoleID, roles.Name
		   FROM roles, userroles
		   WHERE userroles.UserID = :ID AND roles.RoleID = userroles.RoleID
                   ORDER BY roles.Name";
            $statement = $db->prepare($query);
            $statement->bindValue(':ID', $ID);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch (PDOException $e) {
            displayDBError($e->getMessage());
        }
    }
    
    function getNotUserRoles($ID) {
        try {
            $db = GetDBConnection();
            $query = "SELECT RoleID, Name
		   FROM roles WHERE RoleID NOT IN
			(SELECT roles.RoleID
			 FROM roles, userroles
			 WHERE userroles.UserID = :ID AND roles.RoleID = userroles.RoleID)
                   ORDER BY roles.Name";
            $statement = $db->prepare($query);
            $statement->bindValue(':ID', $ID);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch (PDOException $e) {
            displayDBError($e->getMessage());
        }
    }
    
    function getAllUsers() {
        try {
            $db = GetDBConnection();
            $query = "SELECT FirstName, LastName, UserName, Password, Email, UserID FROM users order by LastName";
            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch (PDOException $e) {
            displayDBError($e->getMessage());
        }
    }
    
    function getUser($UserID){
        try {
            $db = getDBConnection();
            $query = 'select * from users where UserID = :UserID';
            $statement = $db->prepare($query);
            $statement->bindValue(':UserID', $UserID);
            $statement->execute();
            $result = $statement->fetch();  // Should be zero or one row
            $statement->closeCursor();
            return $result;
        } catch (PDOException $e) {
            displayDBError($e->getMessage());
        }
    }
    
    function addUser($firstName, $lastName, $userName, $password, $email){
        try {
            $db = GetDBConnection();
            $query = 'INSERT INTO users (FirstName, LastName, UserName, Password, Email)
                      VALUES (:FirstName, :LastName, :UserName, :Password, :Email)';
            $statement = $db->prepare($query);

            $statement->bindValue(':FirstName', $firstName);
            $statement->bindValue(':LastName', $lastName);
            $statement->bindValue(':UserName', $userName);
            $statement->bindValue(':Password', sha1($password));
            $statement->bindValue(':Email', $email);

            $success = $statement->execute();
            $row_count = $statement->rowCount();
            $statement->closeCursor();

            $UserID = $db->lastInsertId();    // Get the last User ID that was generated
            return $UserID;
        } catch (PDOException $e) {
            displayError($e->getMessage());
        }
    }
    
    function updateUser($userID, $firstName, $lastName, $userName, $password, $email, $hasAttributes){
        try {
            $db = GetDBConnection();
            $query = 'UPDATE users SET FirstName = :FirstName,
                                       LastName = :LastName,
                                       UserName = :UserName,
                                       Email = :Email
                                   WHERE UserID = :UserID';
            $statement = $db->prepare($query);
            $statement->bindValue(':UserID', $userID);
            $statement->bindValue(':FirstName', $firstName);
            $statement->bindValue(':LastName', $lastName);
            $statement->bindValue(':UserName', $userName);
            $statement->bindValue(':Email', $email);
            $row_count = $statement->execute();

            if (!empty($password)) {    // Only change password if one is provided
                $query = 'UPDATE users SET Password = :Password
                                       WHERE UserID = :UserID';
                $statement = $db->prepare($query);
                $statement->bindValue(':Password',  sha1($password));
                $statement->bindValue(':UserID', $userID);
                $success = $statement->execute();
            }

            // Now we must remove all old Roles and add in the new ones.
            $query = "DELETE FROM userroles WHERE UserID = :UserID";
            $statement = $db->prepare($query);
            $statement->bindValue(':UserID', $userID);
            $row_count = $statement->execute();

            for($i = 0; $i < count($hasAttributes); ++$i) {
                $attribute = $hasAttributes[$i];
                $query = "INSERT INTO userroles (UserID, RoleID) VALUES (:UserID, :RoleID)";
                $statement = $db->prepare($query);
                $statement->bindValue(':UserID', $userID);
                $statement->bindValue(':RoleID', $attribute);
                $success = $statement->execute();
            }

            $statement->closeCursor();
        } catch (PDOException $e) {
            displayError($e->getMessage());
        }
    }
    
    function deleteUser($UserID) {
        try{
            $db = getDBConnection();
            $query = "DELETE FROM users WHERE UserID = :UserID";
            $statement = $db->prepare($query);
            $statement->bindValue(':UserID', $UserID);
            $row_count = $statement->execute();
            $statement->closeCursor();
            return $row_count;
        } catch (PDOException $e) {
            displayDBError($e->getMessage());
        }
    }

    function getAllFunctions() {
        try {
            $db = GetDBConnection();
            $query = "SELECT FunctionID, Name, Description FROM functions ORDER BY Name";
            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch (PDOException $e) {
            displayDBError($e->getMessage());
        }
    }
    
    function getFunction($FunctionID){
        try {
            $db = getDBConnection();
            $query = 'select * from functions where FunctionID = :FunctionID';
            $statement = $db->prepare($query);
            $statement->bindValue(':FunctionID', $FunctionID);
            $statement->execute();
            $result = $statement->fetch();  // Should be zero or one row
            $statement->closeCursor();
            return $result;
        } catch (PDOException $e) {
            displayDBError($e->getMessage());
        }
    }
    
    function addFunction($name, $desc){
        try {
            $db = GetDBConnection();
            $query = 'INSERT INTO functions (Name, Description)
                      VALUES (:Name, :Description)';
            $statement = $db->prepare($query);
            $statement->bindValue(':Name', $name);
            $statement->bindValue(':Description', $desc);

            $success = $statement->execute();
            $row_count = $statement->rowCount();
            $statement->closeCursor();
            $ID = $db->lastInsertId();    // Get the last ID that was generated
            return $ID;
        } catch (PDOException $e) {
            displayError($e->getMessage());
        }
    }
    
    function updateFunction($functionID, $name, $desc){
        try {
            $db = GetDBConnection();
            $query = 'UPDATE functions SET Name = :Name,
                                       Description = :Description
                                   WHERE FunctionID = :FunctionID';
            $statement = $db->prepare($query);
            $statement->bindValue(':FunctionID', $functionID);
            $statement->bindValue(':Description', $desc);
            $statement->bindValue(':Name', $name);
            $row_count = $statement->execute();
            $statement->closeCursor();
        } catch (PDOException $e) {
            displayError($e->getMessage());
        }
    }
    
    function deleteFunction($FunctionID) {
        try{
            $db = getDBConnection();
            $query = "DELETE FROM functions WHERE FunctionID = :FunctionID";
            $statement = $db->prepare($query);
            $statement->bindValue(':FunctionID', $FunctionID);
            $row_count = $statement->execute();
            $statement->closeCursor();
            return $row_count;
        } catch (PDOException $e) {
            displayDBError($e->getMessage());
        }
    }

    function getAllRoles() {
        try {
            $db = GetDBConnection();
            $query = "SELECT RoleID, Name, Description FROM roles ORDER BY Name";
            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch (PDOException $e) {
            displayDBError($e->getMessage());
        }
    }
    
    function getRole($RoleID){
        try {
            $db = getDBConnection();
            $query = 'select * from roles where RoleID = :RoleID';
            $statement = $db->prepare($query);
            $statement->bindValue(':RoleID', $RoleID);
            $statement->execute();
            $result = $statement->fetch();  // Should be zero or one row
            $statement->closeCursor();
            return $result;
        } catch (PDOException $e) {
            displayDBError($e->getMessage());
        }
    }
    
    function addRole($name, $desc){
        try {
            $db = GetDBConnection();
            $query = 'INSERT INTO roles (Name, Description)
                      VALUES (:Name, :Description)';
            $statement = $db->prepare($query);
            $statement->bindValue(':Name', $name);
            $statement->bindValue(':Description', $desc);
            $success = $statement->execute();
            $row_count = $statement->rowCount();
            $statement->closeCursor();
            $ID = $db->lastInsertId();    // Get the last ID that was generated
            return $ID;
        } catch (PDOException $e) {
            displayError($e->getMessage());
        }
    }
    
    function updateRole($roleID, $name, $desc, $hasAttributes){
        try {
            $db = GetDBConnection();
            $query = 'UPDATE roles SET Name = :Name,
                                       Description = :Description
                                   WHERE RoleID = :RoleID';
            $statement = $db->prepare($query);
            $statement->bindValue(':RoleID', $roleID);
            $statement->bindValue(':Description', $desc);
            $statement->bindValue(':Name', $name);
            $row_count = $statement->execute();

            // Now we must remove all old role_Functions and add in the new ones.
            $query = "DELETE FROM rolefunctions WHERE RoleID = :RoleID";
            $statement = $db->prepare($query);
            $statement->bindValue(':RoleID', $roleID);
            $row_count = $statement->execute();

            for($i = 0; $i < count($hasAttributes); ++$i) {
                $attribute = $hasAttributes[$i];
                $query = "INSERT INTO rolefunctions (RoleID, FunctionID) VALUES (:RoleID, :FunctionID)";
                $statement = $db->prepare($query);
                $statement->bindValue(':RoleID', $roleID);
                $statement->bindValue(':FunctionID', $attribute);
                $success = $statement->execute();
            }

            $statement->closeCursor();
        } catch (PDOException $e) {
            displayError($e->getMessage());
        }
    }
    
    function deleteRole($RoleID) {
        try{
            $db = getDBConnection();
            $query = "DELETE FROM roles WHERE RoleID = :RoleID";
            $statement = $db->prepare($query);
            $statement->bindValue(':RoleID', $RoleID);
            $row_count = $statement->execute();
            $statement->closeCursor();
            return $row_count;
        } catch (PDOException $e) {
            displayDBError($e->getMessage());
        }
    }
    
    function getRoleFunctions($ID) {
        try {
            $db = GetDBConnection();
            $query = "SELECT functions.FunctionID, functions.Name
		 FROM functions, rolefunctions
		 WHERE rolefunctions.RoleID = :ID AND functions.FunctionID = rolefunctions.FunctionID
                 ORDER BY functions.Name";
            $statement = $db->prepare($query);
            $statement->bindValue(':ID', $ID);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch (PDOException $e) {
            displayDBError($e->getMessage());
        }
    }
    
    function getNotRoleFunctions($ID) {
        try {
            $db = GetDBConnection();
            $query = "SELECT FunctionID, Name
		   FROM functions WHERE FunctionID NOT IN
		   (SELECT functions.FunctionID
		   FROM functions, rolefunctions
		   WHERE rolefunctions.RoleID = :ID AND functions.FunctionID = rolefunctions.FunctionID)
                   ORDER BY functions.Name";
            $statement = $db->prepare($query);
            $statement->bindValue(':ID', $ID);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        } catch (PDOException $e) {
            displayDBError($e->getMessage());
        }
    }
?>
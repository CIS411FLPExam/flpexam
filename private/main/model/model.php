<?php

    //Need this file because it contains functions that will be use here.
    include(MODEL_FILE);
    
    /**
     * Adds a user account to the records.
     * @param string $firstName The first name of the user.
     * @param string $lastName The last name of the user.
     * @param string $userName The user name that the user will use with the site.
     * @param string $password The password that the user will use for authentication.
     * @param string $email The user's e-mail address.
     * @return int The user id of the added user.
     */
    function AddUser($firstName, $lastName, $userName, $password, $email)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = "INSERT INTO " . USERS_IDENTIFIER 
                    . " (" . FIRSTNAME_IDENTIFIER 
                    . ", " . LASTNAME_IDENTIFIER 
                    . ", " . USERNAME_IDENTIFIER 
                    . ", " . PASSWORD_IDENTIFIER
                    . ", " . EMAIL_IDENTIFIER . ") VALUES "
                    . "(:" . FIRSTNAME_IDENTIFIER
                    . ", :" . LASTNAME_IDENTIFIER 
                    . ", :" . USERNAME_IDENTIFIER 
                    . ", :" . PASSWORD_IDENTIFIER
                    . ", :" . EMAIL_IDENTIFIER . ")";
                        
            $statement = $db->prepare($query);

            $statement->bindValue(':' . FIRSTNAME_IDENTIFIER, $firstName);
            $statement->bindValue(':' . LASTNAME_IDENTIFIER, $lastName);
            $statement->bindValue(':' . USERNAME_IDENTIFIER, $userName);
            $statement->bindValue(':' . PASSWORD_IDENTIFIER, sha1($password));
            $statement->bindValue(':' . EMAIL_IDENTIFIER, $email);

            $success = $statement->execute();
            
            $row_count = $statement->rowCount();
            
            $statement->closeCursor();

            $userID = $db->lastInsertId(); // Get the last User ID that was generated.
            
            return $userID;
        }
        catch (PDOException $e)
        {
            displayError($e->getMessage());
        }
    }
    
    /**
     * Updates a user's account information.
     * @param int $userID The user ID of the user account to update.
     * @param string $firstName The new first name of the user.
     * @param string $lastName The new last name of the user.
     * @param string $userName The new user name that the user will use with the site.
     * @param string $password The new password that the user will use for authentication.
     * @param string $email The new e-mail address of the user.
     * @param array $hasAttributes The new collection of role ID's that the user will have.
     */
    function UpdateUser($userID, $firstName, $lastName, $userName, $email, $password = "", $hasAttributes = array())
    {
        try
        {
            $db = GetDBConnection();
            
            $query = "UPDATE " . USERS_IDENTIFIER . " SET "
                    . FIRSTNAME_IDENTIFIER . " = :" . FIRSTNAME_IDENTIFIER
                    . LASTNAME_IDENTIFIER . " = :" . LASTNAME_IDENTIFIER
                    . USERNAME_IDENTIFIER . " = :" . USERNAME_IDENTIFIER
                    . EMAIL_IDENTIFIER . " = :" . EMAIL_IDENTIFIER . " WHERE "
                    . USERID_IDENTIFIER . " = :" . USERID_IDENTIFIER . ";";
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . USERID_IDENTIFIER, $userID);
            $statement->bindValue(':' . FIRSTNAME_IDENTIFIER, $firstName);
            $statement->bindValue(':' . LASTNAME_IDENTIFIER, $lastName);
            $statement->bindValue(':' . USERNAME_IDENTIFIER, $userName);
            $statement->bindValue(':' . EMAIL_IDENTIFIER, $email);
            
            $row_count = $statement->execute();

            if (!empty($password))
            {    // Only change password if one is provided
                $query = 'UPDATE users SET Password = :Password
                                       WHERE UserID = :UserID';
                
                $statement = $db->prepare($query);
                
                $statement->bindValue(':' . PASSWORD_IDENTIFIER, sha1($password));
                $statement->bindValue(':' . USERID_IDENTIFIER, $userID);
                
                $success = $statement->execute();
            }

            // Now we must remove all old Roles and add in the new ones.
            $query = "DELETE FROM " . USERROLES_IDENTIFIER . " WHERE "
                    . USERID_IDENTIFIER . " = :" . USERID_IDENTIFIER . ";";
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . USERID_IDENTIFIER, $userID);
            $row_count = $statement->execute();

            for($i = 0; $i < count($hasAttributes); ++$i)
            {
                $attribute = $hasAttributes[$i];
                
                $query = "INSERT INTO " . USERROLES_IDENTIFIER
                        . " (" . USERID_IDENTIFIER
                        . ", " . ROLEID_IDENTIFIER . ") VALUES "
                        . "(:" . USERID_IDENTIFIER
                        . ", :" . ROLEID_IDENTIFIER . ");";
                
                
                $statement = $db->prepare($query);
                $statement->bindValue(':' . USERID_IDENTIFIER, $userID);
                $statement->bindValue(':' . ROLEID_IDENTIFIER, $attribute);
                
                $success = $statement->execute();
            }

            $statement->closeCursor();
        }
        catch (PDOException $e)
        {
            displayError($e->getMessage());
        }
    }
    
    /**
     * Validates that the given string is a valid first name.
     * @param string $firstName The given string.
     * @return \ValidationInfo Validation info about the first name.
     */
    function ValidateFirstName($firstName)
    {
        $valid = TRUE;
        $errors = array();
        
        if (empty($firstName))
        {
            $valid = FALSE;
            $errors[] = "First name can't be blank.";
        }
        else
        {
            if (strlen($firstName) > 32)
            {
                $valid = FALSE;
                $errors[] = "The entered first name is too long.";
            }
        }
        
        $vi = new ValidationInfo($valid, $errors);
        
        return $vi;
    }
    
    /**
     * Validates that the given string is a last name.
     * @param string $lastName The given string.
     * @return \ValidationInfo Validation info about the last name.
     */
    function ValidateLastName($lastName)
    {
        $valid = TRUE;
        $errors = array();
        
        if (empty($lastName))
        {
            $valid = FALSE;
            $errors[] = "Last name can't be blank.";
        }
        else
        {
            if (strlen($lastName) > 32)
            {
                $valid = FALSE;
                $errors[] = "The entered last name is too long.";
            }
        }
        
        $vi = new ValidationInfo($valid, $errors);
        
        return $vi;
    }
    
    /**
     * Validates that the given string is a valid user name.
     * @param string $userName The given name.
     * @return \ValidationInfo Validation info about the user name.
     */
    function ValidateUsername($userName)
    {
        $valid = TRUE;
        $errors = array();
        
        if (empty($userName))
        {
            $valid = FALSE;
            $errors[] = "User name can't be blank.";
        }
        else
        {
            if (strlen($userName) > 32)
            {
                $valid = FALSE;
                $errors[] = "The entered user name is too long.";
            }

            if(UserNameExists($userName))
            {
                $valid = FALSE;
                $errors[] = "The User Name \"" . $userName . "\" already exists.";
            }
        }
        
        $vi = new ValidationInfo($valid, $errors);
        
        return $vi;
    }
    
    /**
     * Validates that the given string is a valid password.
     * @param string $password The string.
     * @param string $retype The retyped string.
     * @return \ValidationInfo Validation info about the password.
     */
    function ValidatePassword($password, $retype)
    {
        $valid = TRUE;
        $errors = array();
        
        if(empty($password))
        {
            $valid = FALSE;
            $errors[] = "Password can't be blank.";
        }
        else
        {
            if (strlen($password) > 40)
            {
                $valid = FALSE;
                $errors[] = "The entered password is too long.";
            }
            
            if ($password != $retype)
            {
                $valid = FALSE;
                $errors[] = "The re-typed password does not match the entered password.";
            }
        }
        
        $vi = new ValidationInfo($valid, $errors);
        
        return $vi;
    }
    
    /**
     * Validates that the given string is a valid email.
     * @param string $email The given string.
     * @return \ValidationInfo Validation info about the email.
     */
    function ValidateEmail($email)
    {
        $valid = TRUE;
        $errors = array();
        
        if (empty($email))
        {
            $valid = FALSE;
            $errors[] = "Email can't be blank.";
        }
        else
        {
            if (!preg_match(VALID_EMAIL_PATTERN, $email))
            {
                $valid = FALSE;
                $errors[] = "The email address \"" . $email . "\" is not valid.";
            }

            if (strlen($email) > 32)
            {
                $valid = FALSE;
                $errors[] = "The entered email is too long.";
            }
        }
        
        $vi = new ValidationInfo($valid, $errors);
        
        return $vi;
    }
    
    /**
     * Checks if the given user name already exists in the records.
     * @param string $userName The user name.
     * @return boolean True, if the user name already exists, or false it does not.
     */
    function UserNameExists($userName)
    {
        $exists = FALSE;
        $db = GetDBConnection( );
        
        try
        {
            $query = "select * from users where UserName = :" . USERNAME_IDENTIFIER . ";";

            $statement = $db->prepare($query);
            $statement->bindValue(":" . USERNAME_IDENTIFIER, $userName);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();

            if (count($results) > 0)
            {
                $exists = true;
            }
        }
        catch (PDOException $e)
        {
            displayError($e->getMessage());
        }
        
        return $exists;
    }
?>
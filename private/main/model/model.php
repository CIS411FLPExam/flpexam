<?php
    include(MODEL_FILE);
    
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
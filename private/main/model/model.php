<?php

    //Need this file because it contains functions that will be use here.
    require_once(MODEL_FILE);
    
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
?>
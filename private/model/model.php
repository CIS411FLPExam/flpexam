<?php
    
    /**
     * Require this file because we use the ValidationInfo class for validation here.
     */
    require_once(VALIDATIONINFOCLASS_FILE);
    
    /**
     * Gets a connection fo the database.
     * @return \PDO The connection to the database.
     */
    function GetDBConnection( )
    {
        $dsn = 'mysql:host=localhost;dbname=flpexam';
        $username = 'webuser';
        $password = 'webuser411';

        try
        {
            $db = new PDO( $dsn, $username, $password );
        }
        catch ( PDOException $e )
        {
            $message = $e->getMessage( );
            displayError($message);
            die;
        }
        
        return $db;            
    }
    
    /**
     * Starts a PHP session if one hasn't already been started.
     */
    function StartSession( )
    {
        if (!isset($_SESSION))
        {
            session_start( );
        }
    }
    
    /**
     * Gets a user's account information.
     * @param int $UserID The user's id.
     * @return array The user's information.
     */
    function getUser($UserID)
    {
        try
        {
            $db = getDBConnection();
            
            $query = 'select * from users where UserID = :UserID';
            $statement = $db->prepare($query);
            $statement->bindValue(':UserID', $UserID);
            $statement->execute();
            $result = $statement->fetch();  // Should be zero or one row
            $statement->closeCursor();
            
            return $result;
        
        }
        catch (PDOException $e)
        {
            displayDBError($e->getMessage());
        }
    }
    
    /**
     * Indicates whether or not the current user is the given role.
     * @param string $roleName The name of the role.
     * @return boolean True, if the current user is that of a certain role.
     */
    function userIs($roleName)
    {
        $is = FALSE;
        
        if(loggedIn())
        {
            $userID = $_SESSION[USERID_IDENTIFIER];
            
            try
            {
                $db = GetDBConnection();
                
                $query = "SELECT * FROM " . USERROLES_IDENTIFIER 
                        . " INNER JOIN " . USERS_IDENTIFIER 
                        . " ON " . USERS_IDENTIFIER 
                        . "." . USERID_IDENTIFIER 
                        . " = " . USERROLES_IDENTIFIER 
                        . "." . USERID_IDENTIFIER 
                        . " INNER JOIN " . ROLES_IDENTIFIER 
                        . " ON " . USERROLES_IDENTIFIER 
                        . "." . ROLEID_IDENTIFIER 
                        . " = " .ROLES_IDENTIFIER 
                        . "." . ROLEID_IDENTIFIER 
                        . " WHERE " . ROLES_IDENTIFIER 
                        . "." . ROLENAME_IDENTIFIER 
                        . " = :" . ROLENAME_IDENTIFIER
                        . " AND " . USERS_IDENTIFIER
                        . "." . USERID_IDENTIFIER
                        . " = :". USERID_IDENTIFIER;
                
                $statement = $db->prepare($query);
                $statement->bindValue(':' . ROLENAME_IDENTIFIER, $roleName);
                $statement->bindValue(':' . USERID_IDENTIFIER, $userID);
                $statement->execute();
                
                $results = $statement->fetchAll();
                
                $statement->closeCursor();
                
                if (count($results) > 0)
                {   // This means the user has been assigned the given role.
                    $is = true;
                }
            }
            catch (PDOException $e)
            {
                displayError($e->getMessage());
            }
        }
        
        return $is;
    }
    
    /**
     * Indicates whether or not the current user can carry out the given function.
     * @param string $function The name of the function.
     * @return boolean True, if the user can carry out the given function, or false otherwise.
     */
    function userIsAuthorized($function)
    {   
        $authorized = false;
        if (guestAccess($function))
        {
            $authorized = true;                   // all Users have access even if not logged in. 
        }
        else if(!isset($_SESSION[USERID_IDENTIFIER]))
        {   // If no current user then don't have access as a guest
            $authorized = false;
        }
        else
        {                  
            $userID = $_SESSION[USERID_IDENTIFIER];       // Get current userid from session variable to check access.

            try
            {
                $db = GetDBConnection();
                
                $query = "select functions.Name
                    from users inner join userroles on users.UserID = userroles.UserID
                    inner join roles on userroles.RoleID = roles.RoleID
                    inner join rolefunctions on roles.RoleID = rolefunctions.RoleID
                    inner join functions on rolefunctions.FunctionID = functions.FunctionID
                    where users.UserID = :userID and functions.Name = :function";
                
                $statement = $db->prepare($query);
                $statement->bindValue(':userID', $userID);
                $statement->bindValue(':function', $function);
                $statement->execute();
                
                $results = $statement->fetchAll();
                
                $statement->closeCursor();
                
                if (count($results) > 0)
                {   // This means we explicitly gave current user access to that function.
                    $authorized = true;
                }
            }
            catch (PDOException $e)
            {
                displayError($e->getMessage());
            }
        }

        return $authorized;
    }

    /**
     * Checks if a guest (or unidentified user can perform a function.
     * @param string $function The name of the function.
     * @return boolean True, if the guest can carry out the given function, or false otherwise.
     */
    function guestAccess($function)
    {
        $authorized = false;
        try
        {
            $db = GetDBConnection();
            
            $query = "select functions.Name
                from roles inner join rolefunctions on roles.RoleID = rolefunctions.RoleID
                inner join functions on rolefunctions.FunctionID = functions.FunctionID
                where roles.Name = 'guest' and functions.Name = :function";
            
            $statement = $db->prepare($query);
            $statement->bindValue(':function', $function);
            $statement->execute();
            
            $results = $statement->fetchAll();
            
            $statement->closeCursor();
            
            if (count($results) > 0)
            {   // This means we explicitly gave guest access to that function.
                $authorized = true;
            }
            else
            {
                // Here we could check to see if the function was not listed at all and default to all access
               $query = "select functions.Name
                    from functions 
                    where functions.Name = :function";
               
                $statement = $db->prepare($query);
                $statement->bindValue(':function', $function);
                $statement->execute();
                
                $results = $statement->fetchAll();
                
                $statement->closeCursor();

                if (count($results) == 0)
                {   // This means we don't know anything about that function.
                    $authorized = true;
                }
            }
        }
        catch (PDOException $e)
        {
            displayError($e->getMessage());
        }

        return $authorized;
    }
    
    /**
     * Indicates whether or not the given ID matches that of the current user.
     * @param int $userID The ID to compare the current user's ID to.
     * @return boolean True, if the given ID matches the current user's ID, or false otherwise.
     */
    function userIsAuthentic($userID)
    {
        $authentic = FALSE;
        
        if (loggedIn() && $userID == $_SESSION[USERID_IDENTIFIER])
        {
            $authentic = TRUE;
        }
        
        return $authentic;
    }

    /**
     * Validates a user based on user credentials.
     * @param string $username The user's user name.
     * @param string $password The user's password.
     * @return array The user's information if the provided user name and password match an existing account.
     */
    function validateUser($username,$password)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = "SELECT UserID, UserName FROM users where UserName = :Username AND Password = :Password";
            
            $statement = $db->prepare($query);
            $statement->bindValue(':Username', $username);
            $statement->bindValue(':Password', sha1($password));
            $statement->execute();
            
            $result = $statement->fetch();  // Should be zero or one row
            
            $statement->closeCursor();
            
            return $result;
        }
        catch (PDOException $e)
        {
            displayError($query . "\n" . $e->getMessage());
        }
    }

    /**
     * Tries to log a user in.
     * @param string $username The user's user name.
     * @param string $password The user's password.
     * @return boolean True, if the user was signed in successfully, or false otherwise.
     */
    function login($username,$password)
    {
        StartSession();
        $result = validateUser($username,$password);
        if($result[USERNAME_IDENTIFIER] == $username) // Make sure a User row was returned
        {
            $_SESSION[USERNAME_IDENTIFIER] = $result[USERNAME_IDENTIFIER];
            $_SESSION[USERID_IDENTIFIER] = $result[USERID_IDENTIFIER];
            return true;
        }
        return false;
    }

    /**
     * Indicates whether or not the current user is logged in.
     * @return boolean True, if the user is logged in, or false otherwise.
     */
    function loggedIn()
    {
        StartSession();
        return isset($_SESSION[USERID_IDENTIFIER]);
    }
    
    /**
     * Log's the current user out.
     */
    function logOut()
    {
        unset($_SESSION[USERID_IDENTIFIER]);
        
        session_destroy();
    }
    
    /**
     * Displays an error message.
     * @param string $error The error message.
     */
    function displayError($error)
    {
        $message = $error;
        include(MESSAGEFORM_FILE);
        
        exit();
    }
    
    /**
     * Displays an error message and the specific errors.
     * @param string $message The main message.
     * @param array $errors The errors.
     */
    function displayErrors($message, $errors)
    {
        $collection = $errors;
        
        include(MESSAGEFORM_FILE);
        
        exit();
    }
?>
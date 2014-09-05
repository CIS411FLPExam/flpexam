<?php
    
    require_once(VALIDATIONINFOCLASS_FILE);
    
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
    
    function StartSession( )
    {
        if (!isset($_SESSION))
        {
            session_start( );
        }
    }
    
    function userIsAuthorized($function) {
        
        $authorized = false;
        if (guestAccess($function)) {
            $authorized = true;                   // all Users have access even if not logged in. 
        } else if(!isset($_SESSION["UserID"])) {  // If no current user then don't have access as a guest
                $authorized = false;
        } else {                  
            $userID = $_SESSION["UserID"];       // Get current userid from session variable to check access.

            try {
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
                if (count($results) > 0) {  // This means we explicitly gave current user access to that function.
                    $authorized = true;
                }
            } catch (PDOException $e) {
                displayError($e->getMessage());
            }
        }

        return $authorized;
    }

    function guestAccess($function) {
        $authorized = false;
        try {
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
            
            if (count($results) > 0) {  // This means we explicitly gave guest access to that function.
                $authorized = true;
            } else {
                // Here we could check to see if the function was not listed at all and default to all access
               $query = "select functions.Name
                    from functions 
                    where functions.Name = :function";
                $statement = $db->prepare($query);
                $statement->bindValue(':function', $function);
                $statement->execute();
                $results = $statement->fetchAll();
                $statement->closeCursor();

                if (count($results) == 0) {  // This means we don't know anything about that function.
                    $authorized = true;
                }
            }
        } catch (PDOException $e) {
            displayError($e->getMessage());
        }

        return $authorized;
    }
    
    function userIsAuthentic($userID)
    {
        $authentic = FALSE;
        
        if (loggedIn() && $userID == $_POST[USERID_IDENTIFIER])
        {
            $authentic = TRUE;
        }
        
        return $authentic;
    }

    function validateUser($username,$password) {
        try {
            $db = GetDBConnection();
            $query = "SELECT UserID, UserName FROM users where UserName = :Username AND Password = :Password";
            $statement = $db->prepare($query);
            $statement->bindValue(':Username', $username);
            $statement->bindValue(':Password', sha1($password));
            $statement->execute();
            $result = $statement->fetch();  // Should be zero or one row
            $statement->closeCursor();
            
            return $result;
        } catch (PDOException $e) {
            displayError($query . "\n" . $e->getMessage());
        }
    }

    function login($username,$password) {
        StartSession();
        $result = validateUser($username,$password);
        if($result['UserName'] == $username) // Make sure a User row was returned
        {
            $_SESSION[USERNAME_IDENTIFIER] = $result[USERNAME_IDENTIFIER];
            $_SESSION[USERID_IDENTIFIER] = $result[USERID_IDENTIFIER];
            return true;
        }
        return false;
    }

    function loggedIn() {
        StartSession();
        return isset($_SESSION["UserID"]);
    }

    function logOut() {
        unset($_SESSION["UserID"]);
        session_destroy();
    }
    
    function displayError($error)
    {
        $message = $error;
        include(MESSAGEFORM_FILE);
        
        exit();
    }
    
    function displayErrors($message, $errors)
    {
        $collection = $errors;
        
        include(MESSAGEFORM_FILE);
        
        exit();
    }
?>
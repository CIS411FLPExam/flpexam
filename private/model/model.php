<?php
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
            include ( MESSAGE_FILE );
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
    
    function connectToMySQL() {

        $db = GetDBConnection( );	// Should be provided in other model.php file for your project
        return $db;
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
                $db = connectToMySQL();
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
            $db = connectToMySQL();
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

    function validateUser($username,$password) {
        try {
            $db = connectToMySQL();
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
            $_SESSION["UserName"] = $result['UserName'];
            $_SESSION["UserID"] = $result['UserID'];
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
        include(MESSAGE_FILE);
        
        exit;
    }
?>
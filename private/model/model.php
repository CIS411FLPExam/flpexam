<?php
    
    require_once(EXAMPARAMETERSCLASS_FILE);

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
            LogError($e);
            die();
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
                LogError($e);
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
            LogError($e);
        }

        return $authorized;
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
            LogError($e);
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
    
    /**
     * Logs a database error.
     * @param PDOException $error The sql error.
     */
    function LogError($error)
    {
        displayError($error->getMessage());
    }
    
    /**
     * Gets a language from the record of languages.
     * @param int $langaugeID The ID of the language to get.
     * @return array The language.
     */
    function GetLanguage($langaugeID)
    {
        try
        {
            $db = GetDBConnection( );
            
            $query = 'SELECT * FROM ' . LANGUAGES_IDENTIFIER . ' WHERE'
                    . ' ' . LANGUAGEID_IDENTIFIER
                    . ' = :' . LANGUAGEID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . LANGUAGEID_IDENTIFIER, $langaugeID);
            
            $statement->execute();
            
            $language = $statement->fetch();
            
            return $language;
        } 
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets a languages I.D.
     * @param string $language The name of the language.
     * @return int The I.D. of the language or 0 if the language was not found.
     */
    function GetLanguageID($language)
    {
        try
        {
            $languageID = 0;
            $db = GetDBConnection();
            
            $query = 'SELECT ' . LANGUAGEID_IDENTIFIER . ' FROM'
                    . ' ' . LANGUAGES_IDENTIFIER . ' WHERE'
                    . ' ' . NAME_IDENTIFIER
                    . ' = :' . NAME_IDENTIFIER;
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . NAME_IDENTIFIER, $language);
            
            $statement->execute();
            
            $language = $statement->fetch();
            
            $statement->closeCursor();
            
            if(!empty($language))
            {
                $languageID = $language[LANGUAGEID_IDENTIFIER];
            }
            
            return $languageID;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets all active languages on record.
     * @return array The collection of all active languages.
     */
    function GetAllActiveLanguages()
    {
        try
        {
            $db = GetDBConnection( );
            
            $query = 'SELECT * FROM ' . LANGUAGES_IDENTIFIER . ' WHERE'
                    . ' Active = TRUE;';
            
            $statement = $db->prepare($query);
            
            $statement->execute();
            
            $languages = $statement->fetchAll();
            
            return $languages;
        } 
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets all languages on record.
     * @return array The collection of all languages.
     */
    function GetAllLanguages()
    {
        try
        {
            $db = GetDBConnection( );
            
            $query = 'SELECT * FROM ' . LANGUAGES_IDENTIFIER;
            
            $statement = $db->prepare($query);
            
            $statement->execute();
            
            $languages = $statement->fetchAll();
            
            return $languages;
        } 
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets language experience.
     * @param int $experienceID The ID of the language experience.
     * @return array The language experience.
     */
    function GetLanguageExperience($experienceID)
    {
        try
        {
            $db = GetDBConnection();
        
            $query = 'SELECT * FROM ' . LANGUAGEEXPERIENCES_IDENTIFIER . ' WHERE'
                    . ' ' . LANGUAGEEXPERIENCEID_IDENTIFIER 
                    . ' = :' . LANGUAGEEXPERIENCEID_IDENTIFIER  . ';';

            $statement = $db->prepare($query);
            $statement->bindValue(':' . LANGUAGEEXPERIENCEID_IDENTIFIER, $experienceID);
            
            $statement->execute();
            
            $experiences = $statement->fetch();
            
            $statement->closeCursor();
            
            return $experiences;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets the collection of all language experiences on record.
     * @return array The collection of all language experiences.
     */
    function GetAllLanguageExperiences()
    {
        try
        {
            $db = GetDBConnection();
        
            $query = 'SELECT * FROM ' . LANGUAGEEXPERIENCES_IDENTIFIER . ';';

            $statement = $db->prepare($query);
            
            $statement->execute();
            
            $experiences = $statement->fetchAll();
            
            $statement->closeCursor();
            
            return $experiences;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
?>
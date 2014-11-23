<?php
    
    require_once(GetContactClassFile());
    require_once(GetLevelInfoClassFile());
    require_once(GetExamParametersClassFile());
    require_once(GetValidationInfoClassFile());
    require_once(GetLanguageExperiencesClassFile());
    
    /**
     * Gets a connection fo the database.
     * @return \PDO The connection to the database.
     */
    function GetDBConnection( )
    {
        $dsn = 'mysql:host=localhost;dbname=cis411_flpexam';
        $username = 's_wdgarey';
        $password = 'Pimp9919';

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
     * Gets the mailer used for sending emails.
     * @return Mailer The mailer to use to send emails.
     */
    function GetEmailMailer( )
    {
        require_once 'Mail.php';
        
        $options = array();
        $options['host'] = 'ssl://smtp.gmail.com';
        $options['port'] = 465;
        $options['auth'] = true;
        $options['username'] = 'flpexam@gmail.com';
        $options['password'] = 'flpexam411';
        $mailer = Mail::factory('smtp', $options);
        
        return $mailer;
    }
    
    /**
     * Gets the level info.
     * @param int $levelInfoID The I.D. of the level info.
     * @return \LevelInfo The level info.
     */
    function GetLevelInfo($levelInfoID)
    {
        try
        {
            $levelInfo = new LevelInfo();
            $idKey = $levelInfo->GetIdKey();
            
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . GetLevelInfosIdentifier() . ' WHERE'
                    . ' ' . $idKey
                    . ' = :' . $idKey;
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $idKey, $levelInfoID);
            
            $statement->execute();
            
            $result = $statement->fetch();
            
            $statement->closeCursor();
            
            $levelInfo->Initialize($result);
            
            return $levelInfo;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    function GetLevelInfoID($languageID, $level)
    {
        try
        {
            $levelInfoID = 0;
            $levelInfo = new LevelInfo();
            $idKey = $levelInfo->GetIdKey();
            $languageIdKey = $levelInfo->GetLanguageIdKey();
            $levelKey = $levelInfo->GetLevelKey();
            
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . GetLevelInfosIdentifier() . ' WHERE'
                    . ' ' . $languageIdKey
                    . ' = :' . $languageIdKey . ' AND'
                    . ' ' . $levelKey
                    . ' = :' . $levelKey . ';' ;
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $languageIdKey, $languageID);
            $statement->bindValue(':' . $levelKey, $level);
            
            $statement->execute();
            
            $result = $statement->fetch();
            
            $statement->closeCursor();
            
            if ($result != FALSE)
            {
                $levelInfoID = $result[$idKey];
            }
            
            return $levelInfoID;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Indicates whether or not the level information for a particular language already exists.
     * @param int $languageID The I.D. of the language.
     * @param int $level The level.
     * @return boolean True, if the level information already exists.
     */
    function LevelInfoExists($languageID, $level)
    {
        try
        {
            $exists = FALSE;
            $db = GetDBConnection();
            $levelInfo = new LevelInfo();
            $langaugeIdKey = $levelInfo->GetLanguageIdKey();
            $levelKey = $levelInfo->GetLevelKey();
            
            $query = 'SELECT * FROM ' . GetLevelInfosIdentifier() . ' WHERE'
                    . ' ' . $langaugeIdKey
                    . ' = :' . $langaugeIdKey . ' AND'
                    . ' ' . $levelKey
                    . ' = :' . $levelKey . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $langaugeIdKey, $languageID);
            $statement->bindValue(':' . $levelKey, $level);
            
            $statement->execute();
            
            $results = $statement->fetchAll();
            
            if (count($results) > 0)
            {
                $exists = TRUE;
            }
            
            return $exists;
        }
        catch(PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets the primary contact on record.
     * @return \Contact The primary contact.
     */
    function GetPrimaryContact()
    {
        try
        {
            $contact = new Contact();
            $primaryIndex = $contact->GetPrimaryIndex();
            
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . GetContactsIdentifier() . ' WHERE'
                    . '`' . $primaryIndex . '` = 1;';
            
            $statement = $db->prepare($query);
            
            $statement->execute();
            
            $row = $statement->fetch();
            
            $statement->closeCursor();
            
            if ($row != FALSE)
            {
                $contact->Initialize($row);
            }
            
            return $contact;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets the exam parameters.
     * @return type
     */
    function GetExamParameters()
    {
        try
        {
            $examParameters = new ExamParameters();
            
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM'
                    . ' ' . GetExamParametersIdentifier();
            
            $statement = $db->prepare($query);
            
            $statement->execute();
            
            $row = $statement->fetch();
            
            $statement->closeCursor();
            
            $examParameters->Initialize($row);
            
            return $examParameters;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
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
        else if(!isset($_SESSION[GetUserIdIdentifier()]))
        {   // If no current user then don't have access as a guest
            $authorized = false;
        }
        else
        {                  
            $userID = $_SESSION[GetUserIdIdentifier()];       // Get current userid from session variable to check access.

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
        if($result[GetUserNameIdentifier()] == $username) // Make sure a User row was returned
        {
            $_SESSION[GetUserNameIdentifier()] = $result[GetUserNameIdentifier()];
            $_SESSION[GetUserIdIdentifier()] = $result[GetUserIdIdentifier()];
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
        return isset($_SESSION[GetUserIdIdentifier()]);
    }
    
    /**
     * Log's the current user out.
     */
    function logOut()
    {
        unset($_SESSION[GetUserIdIdentifier()]);
        
        session_destroy();
    }
    
    /**
     * Displays an error message.
     * @param string $error The error message.
     */
    function displayError($error)
    {
        $message = $error;
        include(GetMessageFormFile());
        
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
        
        include(GetMessageFormFile());
        
        exit();
    }
    
    /**
     * Logs a database error.
     * @param Exception $error The sql error.
     */
    function LogError($error)
    {
        $handle = fopen(GetErrorLogFile(), 'a');
        
        fwrite($handle, $error->getMessage());
        
        fclose($handle);
        
        displayError('A fatal error has occured. Please contact an administrator.');
    }
    
    /**
     * Indicates whether or not a language is active.
     * @param int $languageID The I.D. of the language.
     * @return boolean True, if the language is active.
     */
    function IsActive($languageID)
    {
        try
        {
            $isActive = FALSE;
            $db = GetDBConnection( );
            
            $query = 'SELECT * FROM ' . GetLanguagesIdentifier() . ' WHERE'
                    . ' ' . GetLanguageIdIdentifier()
                    . ' = :' . GetLanguageIdIdentifier() . ' AND'
                    . ' ' . 'Active'
                    . ' = :' . 'Active' . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . GetLanguageIdIdentifier(), $languageID);
            $statement->bindValue(':' . 'Active', 1); //"1" because "1" means true (or active).
            
            $statement->execute();
            
            $activeLanguages = $statement->fetchAll();
            
            if (count($activeLanguages) > 0)
            {
                $isActive = TRUE;
            }
            
            return $isActive;
        } 
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets a language from the record of languages.
     * @param int $languageID The ID of the language to get.
     * @return array The language.
     */
    function GetLanguage($languageID)
    {
        try
        {
            $db = GetDBConnection( );
            
            $query = 'SELECT * FROM ' . GetLanguagesIdentifier() . ' WHERE'
                    . ' ' . GetLanguageIdIdentifier()
                    . ' = :' . GetLanguageIdIdentifier() . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . GetLanguageIdIdentifier(), $languageID);
            
            $statement->execute();
            
            $language = $statement->fetch();
            
            $statement->closeCursor();
            
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
            
            $query = 'SELECT ' . GetLanguageIdIdentifier() . ' FROM'
                    . ' ' . GetLanguagesIdentifier() . ' WHERE'
                    . ' ' . GetNameIdentifier()
                    . ' = :' . GetNameIdentifier();
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . GetNameIdentifier(), $language);
            
            $statement->execute();
            
            $language = $statement->fetch();
            
            $statement->closeCursor();
            
            if(!empty($language))
            {
                $languageID = $language[GetLanguageIdIdentifier()];
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
            
            $query = 'SELECT * FROM ' . GetLanguagesIdentifier() . ' WHERE'
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
     * Gets the names of all active languages.
     * @return array The collection of names.
     */
    function GetActiveLanguageNames()
    {
        $languageNames = array();
        $activeLanguages = GetAllActiveLanguages();
        
        foreach ($activeLanguages as $language)
        {
            $languageNames[] = $language[GetNameIdentifier()];
        }
        
        return $languageNames;
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
            
            $query = 'SELECT * FROM ' . GetLanguagesIdentifier();
            
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
     * Gets the name of all languages on record.
     * @return array The collection of language names.
     */
    function GetAllLanguagesNames()
    {
        $languageNames = array();
        $languages = GetAllLanguages();
        
        foreach ($languages as $language)
        {
            $languageNames[] = $language[GetNameIdentifier()];
        }
        
        return $languageNames;
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
        
            $query = 'SELECT * FROM ' . GetLanguageExperiencesIdentifier() . ' WHERE'
                    . ' ' . GetLanguageExperienceIdIdentifier() 
                    . ' = :' . GetLanguageExperienceIdIdentifier()  . ';';

            $statement = $db->prepare($query);
            $statement->bindValue(':' . GetLanguageExperienceIdIdentifier(), $experienceID);
            
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
            $experiences = array();
            $db = GetDBConnection();
        
            $query = 'SELECT * FROM ' . GetLanguageExperiencesIdentifier() . ' ORDER BY'
                    . ' ' . GetLanguageExperienceIdIdentifier() . ';';

            $statement = $db->prepare($query);
            
            $statement->execute();
            
            $rows = $statement->fetchAll();
            
            $statement->closeCursor();
            
            foreach($rows as $row)
            {
                $experience = new LanguageExperience();
                $experience->Initialize($row);
                
                $experiences[] = $experience;
            }
            
            return $experiences;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets all language experience names.
     * @return array The collection of names.
     */
    function GetLanguageExperienceNames()
    {
        $names = array();
        $languageExperiences = GetAllLanguageExperiences();
        
        foreach ($languageExperiences as $experience)
        {
            $names[] = $experience->GetName();
        }
        
        return $names;
    }
    
    /**
     * Gets the I.D. of a language experience.
     * @param string $experience The name.
     * @return int The I.D. of the language experience or 0 if the corresponding language experience was not found.
     */
    function GetLanguageExperienceID($experience)
    {
        try
        {
            $experienceID = 0;
            $db = GetDBConnection();
        
            $query = 'SELECT ' . GetLanguageExperienceIdIdentifier() . ' FROM'
                    . ' ' . GetLanguageExperiencesIdentifier() . ' WHERE'
                    . ' ' . GetNameIdentifier()
                    . ' = :' . GetNameIdentifier() . ';';

            $statement = $db->prepare($query);
            $statement->bindValue(':' . GetNameIdentifier(), $experience);
            
            $statement->execute();
            
            $result = $statement->fetch();
            
            if(count($result) > 0)
            {
                $experienceID = $result[0];
            }
            
            $statement->closeCursor();
            
            return $experienceID;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    
    /**
     * Gets question from the records.
     * @param int $questionID The I.D. of the question to get.
     * @return array The question.
     */
    function GetQuestion($questionID)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . GetQuestionsIdentifier() . ' WHERE'
                    . ' ' . GetQuestionIdIdentifier()
                    . ' = :' . GetQuestionIdIdentifier() .';';
            
            $statement = $db->prepare($query);
            
            $statement->bindValue(':' . GetQuestionIdIdentifier(), $questionID);
            
            $statement->execute();
            
            $question = $statement->fetch();
            
            $statement->closeCursor();
            
            return $question;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets all possible answers for a question.
     * @param int $questionID The I.D. of the question.
     * @return array The collection of answers.
     */
    function GetQuestionAnswers($questionID)
    {
        try
        {
            $db = GetDBConnection();
            
            //Order by Correct because WE ALWAYS WANT THE CORRECT ANSWER FIRST.
            $query = 'SELECT * FROM ' . GetAnswersIdentifier() . ' WHERE'
                    . ' ' . GetQuestionIdIdentifier()
                    . ' = :' . GetQuestionIdIdentifier()
                    . ' ORDER BY Correct DESC';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . GetQuestionIdIdentifier(), $questionID);
            
            $statement->execute();
            
            $answers = $statement->fetchAll();
            
            $statement->closeCursor();
            
            return $answers;
            
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
?>
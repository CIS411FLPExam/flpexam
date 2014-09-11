<?php

    //Include the base model file becasue functions from that files will be used here.
    require_once(MODEL_FILE);
    
    /**
     * Activates a language.
     * @param int $languageID The I.D. of the language to Activate.
     */
    function ActivateLanguage($languageID)
    {
        SetLanguageState($languageID, 'TRUE');
    }
    
    /**
     * Deactivates a language.
     * @param int $languageID The I.D. of the language to deactivate.
     */
    function DeactivateLanguage($languageID)
    {
        SetLanguageState($languageID, 'FALSE');
    }
    
    /**
     * Sets a languages state to either TRUE or FALSE.
     * @param int $languageID The I.D. of the language to activate/deactivate.
     * @param int $active The flag that indicates whether the language should be active or deactive.
     * @return int The number of languages that were activated/deactivated
     */
    function SetLanguageState($languageID, $active)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . LANGUAGES_IDENTIFIER . ' SET'
                    . ' ' . 'Active'
                    . ' = :' . 'Active WHERE'
                    . ' ' . LANGUAGEID_IDENTIFIER
                    . ' = :' . LANGUAGEID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . LANGUAGEID_IDENTIFIER, $languageID);
            $statement->bindValue(':' . 'Active', $active);
            
            $effectedCount = $statement->execute();
            
            $statement->closeCursor();
            
            return $effectedCount;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Adds a language to the records.
     * @param string $name The name of the new language.
     * @return int The I.D. of the new language.
     */
    function AddLanguage($name)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'INSERT INTO ' . LANGUAGES_IDENTIFIER
                    . ' (' . '`Name`' . ') VALUES'
                    . '(:' . 'Name' . ');';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . 'Name', $name);
            
            $statement->execute();
            
            $languageID = $db->lastInsertId();
            
            $statement->closeCursor();
            
            return $languageID;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Updates an existing language.
     * @param int $languageID The I.D. of the language to udpate.
     * @param string $name The new name of the language.
     * @param boolean $active Flag indicating whether or not the language is active.
     * @return int The number of languages updated.
     */
    function UpdateLanguage($languageID, $name, $active)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . LANGUAGES_IDENTIFIER . ' SET'
                    . ' ' . '`Name`'
                    . ' = :' . 'Name'
                    . ', ' . 'Active'
                    . ' = :' . 'Active WHERE'
                    . ' ' . LANGUAGEID_IDENTIFIER
                    . ' = :' . LANGUAGEID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . LANGUAGEID_IDENTIFIER, $languageID);
            $statement->bindValue(':' . 'Name', $name);
            $statement->bindValue(':' . 'Active', $active);
            
            $effectedCount = $statement->execute();
            
            $statement->closeCursor();
            
            return $effectedCount;
        }
        catch (PDOException $ex)
        {
            LogError($ex); 
        }
    }
    
    /**
     * Deletes a language from the records.
     * @param int $languageID The I.D. of the language to delete.
     */
    function DeleteLanguage($languageID)
    {
        try
        {
            $db = GetDBConnection();
            
            
        }
        catch(PDOException $ex)
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
            
            $query = 'SELECT * FROM ' . QUESTIONS_IDENTIFIER . ' WHERE'
                    . ' ' . QUESTIONID_IDENTIFIER
                    . ' = :' . QUESTIONID_IDENTIFIER .';';
            
            $statement = $db->prepare($query);
            
            $statement->bindValue(':' . QUESTIONID_IDENTIFIER, $questionID);
            
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
     * Deletes a question and it's answers from the records.
     * @param int $questionID The I.D. of the question to delete.
     * @return int The number of questions that were deleted.
     */
    function DeleteQuestion($questionID)
    {
        try
        {
            DeleteQuestionAnswers($questionID);
            
            $db = GetDBConnection();
            
            $query = 'DELETE FROM ' . QUESTIONS_IDENTIFIER . ' WHERE'
                    . ' ' . QUESTIONID_IDENTIFIER
                    . ' = :' . QUESTIONID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . QUESTIONID_IDENTIFIER , $questionID);

            $questionsDeleted = $statement->execute();

            $statement->closeCursor();
            
            return $questionsDeleted;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Updates an existing question.
     * @param int $questionID The I.D. of the questio nto update.
     * @param string $name The name of the question.
     * @param int $level The difficulty of the question.
     * @param array $answers The question's collection of answers.
     * @return int The number of questions effected by the update.
     */
    function UpdateQuestion($questionID, $name, $level, $answers)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . QUESTIONS_IDENTIFIER . ' SET'
                    . ' ' . '`Level`'
                    . ' = :' . 'Level'
                    . ', ' . '`Name`'
                    . ' = :' . 'Name WHERE'
                    . ' ' . QUESTIONID_IDENTIFIER
                    . ' = :' . QUESTIONID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . QUESTIONID_IDENTIFIER, $questionID);
            $statement->bindValue(':' . 'Name', $name);
            $statement->bindValue(':' . 'Level', $level);
            
            $effectedCount = $statement->execute();
            
            $statement->closeCursor();
            
            UpdateQuestionAnswers($questionID, $answers);
            
            return $effectedCount;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Adds a question to the record of questions.
     * @param string $name The question.
     * @param int $level The questions level.
     * @param array $answers The answers to the question.
     * @return int The I.D. of the new question.
     */
    function AddQuestion($name, $level, $answers)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'INSERT INTO ' . QUESTIONS_IDENTIFIER
                    . ' (' . '`Level`'
                    . ', ' . '`Name`' . ') VALUES'
                    . ' (:' . 'Level'
                    . ', :' . 'Name' . ');';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . 'Name', $name);
            $statement->bindValue(':' . 'Level', $level);
            
            $statement->execute();
            
            $statement->closeCursor();
            
            $questionID = $db->lastInsertId();
            
            UpdateQuestionAnswers($questionID, $answers);
            
            return $questionID;
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
            $query = 'SELECT * FROM ' . ANSWERS_IDENTIFIER . ' WHERE'
                    . ' ' . QUESTIONID_IDENTIFIER
                    . ' = :' . QUESTIONID_IDENTIFIER
                    . ' ORDER BY Correct DESC';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . QUESTIONID_IDENTIFIER, $questionID);
            
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
    
    /**
     * Removes any existing answers and inserts the given answers for a question.
     * @param int $questionID The I.D. of the question's answer to change.
     * @param array $answers The collection of answers.
     */
    function UpdateQuestionAnswers($questionID, $answers)
    {
        try
        {
            $db = GetDBConnection();
            
            if(is_array($answers) && count($answers) > 0)
            {
                DeleteQuestionAnswers($questionID);
                
                //Answer, $answers[0], is the first answer SO IT IS THE CORRECT ANSWER.
                $answer = $answers[0];
                
                //Insert the first answer and set CORRECT = TRUE since it is the correct answer.
                $query = 'INSER INTO ' . ANSWERS_IDENTIFIER
                            . '(' . QUESTIONID_IDENTIFIER
                            . ', ' . 'Correct'
                            . ', ' . '`Name`' . ') VALUES'
                            . ' (: ' . QUESTIONID_IDENTIFIER
                            . ', :' .'Correct'
                            . ', :' . 'Name' . ');';
                
                $statement = $db->prepare($query);
                $statement->bindValue(':' . QUESTIONID_IDENTIFIER ,$questionID);
                $statement->bindValue(':' . 'Correct', 'TRUE');
                $statement->bindValue(':' . 'Name', $answer);
                
                $statement->execute();
                
                $statement->closeCursor();
                
                //Now answer all of the other answers which are inccorect.
                for($i = 1; $i < count($answers); $i++)
                {
                    $answer = $answers[$i];
                    
                    $query = 'INSER INTO ' . ANSWERS_IDENTIFIER
                            . '(' . QUESTIONID_IDENTIFIER
                            . ', ' . 'Correct'
                            . ', ' . '`Name`' . ') VALUES'
                            . ' (: ' . QUESTIONID_IDENTIFIER
                            . ', :' .'Correct'
                            . ', :' . 'Name' . ');';
                
                    $statement = $db->prepare($query);
                    $statement->bindValue(':' . QUESTIONID_IDENTIFIER , $questionID);
                    $statement->bindValue(':' . 'Correct', 'FALSE');
                    $statement->bindValue(':' . 'Name', $answer);

                    $statement->execute();
                    
                    $statement->closeCursor();
                }
            }
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Deletes all answers associated with a question.
     * @param int $questionID The I.D. of the question's answers to delete.
     * @return int The number of answers that were deleted.
     */
    function DeleteQuestionAnswers($questionID)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'DELETE FROM ' . ANSWERS_IDENTIFIER . ' WHERE'
                    . ' ' . QUESTIONID_IDENTIFIER
                    . ' = :' . QUESTIONID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . QUESTIONID_IDENTIFIER , $questionID);

            $answersDeleted = $statement->execute();

            $statement->closeCursor();
            
            return $answersDeleted;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Searches all users for the given name.
     * @param string $name The user's first and/or last name.
     * @return array The collection of users found in the search.
     */
    function SearchForUser($name)
    {
        try
        {
            $db = GetDBConnection();

            $query = "SELECT * FROM " . USERS_IDENTIFIER . " WHERE"
                    . " MATCH (" . FIRSTNAME_IDENTIFIER 
                    . ", " . LASTNAME_IDENTIFIER. ") AGAINST" 
                    . " (:" . NAME_IDENTIFIER . " IN BOOLEAN MODE);";

            $statement = $db->prepare($query);
            $statement->bindValue(':' . NAME_IDENTIFIER, $name);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();

            return $results;
        }
        catch(PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets the roles that are currently assigned to a user.
     * @param int $ID The user ID of the user.
     * @return array The collection of roles assigned to the user.
     */
    function getUserRoles($ID)
    {
        try
        {
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
        }
        catch (PDOException $e)
        {
            displayDBError($e->getMessage());
        }
    }
    
    /**
     * Gets all roles that are NOT assigned to a user.
     * @param int $ID The id of the user
     * @return arrary The collection of roles that a user does not have.
     */
    function getNotUserRoles($ID)
    {
        try
        {
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
        }
        catch (PDOException $e)
        {
            displayDBError($e->getMessage());
        }
    }
    
    /**
     * Gets all user accounts on record.
     * @return array The information of all users.
     */
    function getAllUsers()
    {
        try
        {
            $db = GetDBConnection();
            
            $query = "SELECT FirstName, LastName, UserName, Password, Email, UserID FROM users order by LastName";
            
            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            return $results;
        }
        catch (PDOException $e)
        {
            displayDBError($e->getMessage());
        }
    }
    
    /**
     * Adds a user account to the records.
     * @param string $firstName The first name of the user.
     * @param string $lastName The last name of the user.
     * @param string $userName The user name that the user will use with the site.
     * @param string $password The password that the user will use for authentication.
     * @param string $email The user's e-mail address.
     * @return int The user id of the added user.
     */
    function addUser($firstName, $lastName, $userName, $password, $email)
    {
        try
        {
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
        }
        catch (PDOException $e)
        {
            LogError($e);
        }
    }
    
    /**
     * Updates a user's account information.
     * @param int $userID The user ID of the user account to update.
     * @param array $hasAttributes The new collection of role ID's that the user will have.
     */
    function updateUser($userID, $hasAttributes)
    {
        try
        {
            $db = GetDBConnection();
            
            // Now we must remove all old Roles and add in the new ones.
            $query = "DELETE FROM userroles WHERE UserID = :UserID";
            $statement = $db->prepare($query);
            $statement->bindValue(':UserID', $userID);
            $row_count = $statement->execute();

            for($i = 0; $i < count($hasAttributes); ++$i)
            {
                $attribute = $hasAttributes[$i];
                
                $query = "INSERT INTO userroles (UserID, RoleID) VALUES (:UserID, :RoleID)";
                
                $statement = $db->prepare($query);
                $statement->bindValue(':UserID', $userID);
                $statement->bindValue(':RoleID', $attribute);
                
                $success = $statement->execute();
            }

            $statement->closeCursor();
        }
        catch (PDOException $e)
        {
            LogError($e);
        }
    }
    
    /**
     * Deletes a user account from the records.
     * @param int $UserID The user ID of the user to delete.
     * @return int The number of users deleted.
     */
    function deleteUser($UserID)
    {
        try
        {
            $db = getDBConnection();
            
            $query = "DELETE FROM users WHERE UserID = :UserID";
            
            $statement = $db->prepare($query);
            $statement->bindValue(':UserID', $UserID);
            $row_count = $statement->execute();
            $statement->closeCursor();
            
            return $row_count;
        }
        catch (PDOException $e)
        {
            displayDBError($e->getMessage());
        }
    }

    /**
     * Gets all functions on record.
     * @return array The collection of functions on record.
     */
    function getAllFunctions()
    {
        try
        {
            $db = GetDBConnection();
            
            $query = "SELECT FunctionID, Name, Description FROM functions ORDER BY Name";
            
            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchAll();
            $statement->closeCursor();
            
            return $results;
        }
        catch (PDOException $e)
        {
            displayDBError($e->getMessage());
        }
    }
    
    /**
     * Gets a function's information from the record.
     * @param int $FunctionID The ID of the function.
     * @return array The function's information.
     */
    function getFunction($FunctionID)
    {
        try
        {
            $db = getDBConnection();
            
            $query = 'select * from functions where FunctionID = :FunctionID';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':FunctionID', $FunctionID);
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
     * Adds a function to the records.
     * @param string $name The name of the function.
     * @param string $desc The function's description.
     * @return int The ID of the newly added function.
     */
    function addFunction($name, $desc)
    {
        try
        {
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
        }
        catch (PDOException $e)
        {
            LogError($e);
        }
    }
    
    /**
     * Updates a function's information.
     * @param int $functionID The ID of the function to update.
     * @param string $name The new name of the function.
     * @param string $desc The new description of the function.
     */
    function updateFunction($functionID, $name, $desc)
    {
        try
        {
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
        }
        catch (PDOException $e)
        {
            LogError($e);
        }
    }
    
    /**
     * Deletes a function's information from the records.
     * @param int $FunctionID The ID of the function to delete.
     * @return int The number of functions that were deleted.
     */
    function deleteFunction($FunctionID)
    {
        try
        {
            $db = getDBConnection();
            
            $query = "DELETE FROM functions WHERE FunctionID = :FunctionID";
            
            $statement = $db->prepare($query);
            $statement->bindValue(':FunctionID', $FunctionID);
            
            $row_count = $statement->execute();
            
            $statement->closeCursor();
            
            return $row_count;
        }
        catch (PDOException $e)
        {
            displayDBError($e->getMessage());
        }
    }

    /**
     * Gets all roles on record.
     * @return array The collection of roles.
     */
    function getAllRoles()
    {
        try
        {
            $db = GetDBConnection();
            
            $query = "SELECT RoleID, Name, Description FROM roles ORDER BY Name";
            
            $statement = $db->prepare($query);
            $statement->execute();
            
            $results = $statement->fetchAll();
            
            $statement->closeCursor();
            
            return $results;
        }
        catch (PDOException $e)
        {
            displayDBError($e->getMessage());
        }
    }
    
    /**
     * Gets the information of a role from the records.
     * @param int $RoleID The ID of the role's information to get.
     * @return array The collection of the role's information.
     */
    function getRole($RoleID)
    {
        try
        {
            $db = getDBConnection();
            
            $query = 'select * from roles where RoleID = :RoleID';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':RoleID', $RoleID);
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
     * Adds a role to the records.
     * @param string $name The name of the role.
     * @param string $desc The description of the role.
     * @return int The ID of the newly added role.
     */
    function addRole($name, $desc)
    {
        try 
        {
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
        }
        catch (PDOException $e)
        {
            LogError($e);
        }
    }
    
    /**
     * Updates a role's information in the records.
     * @param int $roleID The ID of the role to update.
     * @param string $name The new name of the role.
     * @param string $desc The new description of the role.
     * @param array $hasAttributes The collection function ID's associated with the role.
     */
    function updateRole($roleID, $name, $desc, $hasAttributes)
    {
        try
        {
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

            for($i = 0; $i < count($hasAttributes); ++$i)
            {
                $attribute = $hasAttributes[$i];
                
                $query = "INSERT INTO rolefunctions (RoleID, FunctionID) VALUES (:RoleID, :FunctionID)";
                
                $statement = $db->prepare($query);
                $statement->bindValue(':RoleID', $roleID);
                $statement->bindValue(':FunctionID', $attribute);
                
                $success = $statement->execute();
            }

            $statement->closeCursor();
        }
        catch (PDOException $e)
        {
            LogError($e);
        }
    }
    
    /**
     * Delets a role from the records.
     * @param int $RoleID The ID of the role to delete.
     * @return int The number of role's deleted.
     */
    function deleteRole($RoleID)
    {
        try
        {
            $db = getDBConnection();
            
            $query = "DELETE FROM roles WHERE RoleID = :RoleID";
            
            $statement = $db->prepare($query);
            $statement->bindValue(':RoleID', $RoleID);
            
            $row_count = $statement->execute();
            
            $statement->closeCursor();
            
            return $row_count;
        }
        catch (PDOException $e)
        {
            displayDBError($e->getMessage());
        }
    }
    
    /**
     * Gets the collection of functions associated with a role.
     * @param int $ID The id of the role.
     * @return array The collection of function information on record for the role.
     */
    function getRoleFunctions($ID)
    {
        try
        {
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
        }
        catch (PDOException $e)
        {
            displayDBError($e->getMessage());
        }
    }
    
    /**
     * Gets all functions NOT associated with a role.
     * @param int $ID The ID of the role.
     * @return array The collection of functions NOT associated with the role.
     */
    function getNotRoleFunctions($ID)
    {
        try
        {
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
        }
        catch (PDOException $e)
        {
            displayDBError($e->getMessage());
        }
    }
?>
<?php

    //Include the base model file becasue functions from that files will be used here.
    require_once(MODEL_FILE);
    require_once(TESTINFOCLASS_FILE);
    require_once(DETAILEDTESTINFOCLASS_FILE);
    require_once(PHPEXCELCLASS_FILE);
    require_once(PHPEXCELIOFACTORYCLASS_FILE);
    require_once(CONTACTCLASS_FILE);
    require_once(LEVELINFOCLASS_FILE);
    require_once(LANGUAGEEXPERIENCECLASS_FILE);
    
    /**
     * Sets the initial level that corresponds to a language spoken at home.
     * @param int $initLevel The initial level.
     */
    function SetSpokenAtHomeInitLevel($initLevel)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . SPOKENATHOMEINITLEVEL_IDENTIFIER . ' SET'
                    . ' ' . 'InitLevel'
                    . ' = :' . 'InitLevel';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . 'InitLevel', $initLevel);
            
            $statement->execute();
            
            $statement->closeCursor();
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Updates the language experiences on the records.
     * @param array $languageExperiences The collection of language experiences.
     */
    function SetLanguageExperiences($languageExperiences)
    {
        try
        {
            $db = GetDBConnection();
            
            $experience = New LanguageExperience();
            $idKey = $experience->GetIdKey();
            $nameKey = $experience->GetNameKey();
            $initLevelKey = $experience->GetInitLevelKey();
            
            $query = 'UPDATE ' . LANGUAGEEXPERIENCES_IDENTIFIER . ' SET'
                    . ' ' . $nameKey . ' = :' . $nameKey
                    . ', ' . $initLevelKey . ' = :' . $initLevelKey . ' WHERE'
                    . ' ' . $idKey
                    . ' = :' . $idKey;
            
            foreach ($languageExperiences as $languageExperience)
            {
                $statement = $db->prepare($query);
                
                $statement->bindValue(':' . $idKey, $languageExperience->GetId());
                $statement->bindValue(':' . $nameKey, $languageExperience->GetName());
                $statement->bindValue(':' . $initLevelKey, $languageExperience->GetInitLevel());
                
                $statement->execute();
                
                $statement->closeCursor();
            }
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets the collection of all language experiences on record.
     * @return array The collection of language experiences.
     */
    function GetLanguageExperiences()
    {
        try
        {
            $languageExperiences = array();
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . LANGUAGEEXPERIENCES_IDENTIFIER . ' ORDER BY'
                    . ' ' . LANGUAGEEXPERIENCEID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            
            $statement->execute();
            
            $results = $statement->fetchAll();
            
            $statement->closeCursor();
            
            foreach ($results as $result)
            {
                $languageExperience = new LanguageExperience();
                $languageExperience->Initialize($result);
                
                $languageExperiences[] = $languageExperience;
            }
            
            return $languageExperiences;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets the total number of times each answer has been submited for a question.
     * @param int $questionID The I.D. of the question.
     * @return array The collection answer counts indexed by their answer I.D.
     */
    function GetQuestionStatisticTotalAnswerCounts($questionID)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'SELECT ' . QUESTIONSTATISTICS_IDENTIFIER . '.' . ANSWERID_IDENTIFIER
                    . ', ' . QUESTIONSTATISTICS_IDENTIFIER . '.' . 'Count' . ' FROM'
                    . ' ' . QUESTIONS_IDENTIFIER . ' INNER JOIN'
                    . ' ' . ANSWERS_IDENTIFIER . ' ON'
                    . ' ' . ANSWERS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER
                    . ' = ' . QUESTIONS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER . ' INNER JOIN'
                    . ' ' . QUESTIONSTATISTICS_IDENTIFIER . ' ON'
                    . ' ' . QUESTIONSTATISTICS_IDENTIFIER . '.' . ANSWERID_IDENTIFIER
                    . ' = ' . ANSWERS_IDENTIFIER . '.' . ANSWERID_IDENTIFIER . ' WHERE'
                    . ' ' . QUESTIONS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER
                    . ' = :' . QUESTIONID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . QUESTIONID_IDENTIFIER, $questionID);
            
            $statement->execute();
            
            $results = $statement->fetchAll();
            
            $statement->closeCursor();
            
            return $results;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets the total number of times a question has been answered correctly.
     * @param int $questionID The I.D. of the question.
     * @return mixed The total number of a times a question has been answered correctly, or FALSE if no question was found.
     */
    function GetQuestionStatisticTotalTimesAnsweredCorrectly($questionID)
    {
        try
        {
            $totalTimesAnsweredCorrectly = FALSE;
            $db = GetDBConnection();
            
            $query = 'SELECT ' . QUESTIONSTATISTICS_IDENTIFIER . '.' . 'Count' . ' FROM'
                    . ' ' . QUESTIONS_IDENTIFIER . ' INNER JOIN'
                    . ' ' . ANSWERS_IDENTIFIER . ' ON'
                    . ' ' . ANSWERS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER
                    . ' = ' . QUESTIONS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER . ' INNER JOIN'
                    . ' ' . QUESTIONSTATISTICS_IDENTIFIER . ' ON'
                    . ' ' . QUESTIONSTATISTICS_IDENTIFIER . '.' . ANSWERID_IDENTIFIER
                    . ' = ' . ANSWERS_IDENTIFIER . '.' . ANSWERID_IDENTIFIER . ' WHERE'
                    . ' ' . QUESTIONS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER
                    . ' = :' . QUESTIONID_IDENTIFIER . ' AND'
                    . ' ' . ANSWERS_IDENTIFIER . '.' . 'Correct'
                    . ' = ' . 'TRUE' . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . QUESTIONID_IDENTIFIER, $questionID);
            
            $statement->execute();
            
            $result = $statement->fetch();
            
            $statement->closeCursor();
            
            if ($result != FALSE)
            {
                $totalTimesAnsweredCorrectly = $result['Count'];
            }
            
            return $totalTimesAnsweredCorrectly;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets the total number of times a question has been answered.
     * @param int $questionID The I.D. of the question.
     * @return mixed The total number of times the question has been answered, or FALSE when the question was not found.
     */
    function GetQuestionStatisticTotalTimesAnswered($questionID)
    {
        try
        {
            $totalTimesAnswered = FALSE;
            $db = GetDBConnection();
            
            $query = 'SELECT SUM(' . QUESTIONSTATISTICS_IDENTIFIER . '.' . 'Count' . ') AS'
                    . ' ' . 'TotalAnswers' . ' FROM'
                    . ' ' . QUESTIONS_IDENTIFIER . ' INNER JOIN'
                    . ' ' . ANSWERS_IDENTIFIER . ' ON'
                    . ' ' . ANSWERS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER
                    . ' = ' . QUESTIONS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER . ' INNER JOIN'
                    . ' ' . QUESTIONSTATISTICS_IDENTIFIER . ' ON'
                    . ' ' . QUESTIONSTATISTICS_IDENTIFIER . '.' . ANSWERID_IDENTIFIER
                    . ' = ' . ANSWERS_IDENTIFIER . '.' . ANSWERID_IDENTIFIER . ' WHERE'
                    . ' ' . QUESTIONS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER
                    . ' = :' . QUESTIONID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . QUESTIONID_IDENTIFIER, $questionID);
            
            $statement->execute();
            
            $result = $statement->fetch();
            
            $statement->closeCursor();
            
            if ($result != FALSE)
            {
                $totalTimesAnswered = $result['TotalAnswers'];
            }
            
            return $totalTimesAnswered;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Resets the statistics for every question of a language.
     * @param int $languageID The I.D. of the language.
     */
    function ResetLanguageQuestionStatistics($languageID)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . QUESTIONSTATISTICS_IDENTIFIER . ' INNER JOIN'
                    . ' ' . ANSWERS_IDENTIFIER . ' ON'
                    . ' ' . ANSWERS_IDENTIFIER . '.' . ANSWERID_IDENTIFIER
                    . ' = ' . QUESTIONSTATISTICS_IDENTIFIER  . '.' . ANSWERID_IDENTIFIER . ' INNER JOIN'
                    . ' ' . QUESTIONS_IDENTIFIER . ' ON'
                    . ' ' . QUESTIONS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER
                    . ' = ' . ANSWERS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER . ' INNER JOIN'
                    . ' ' . LANGUAGES_IDENTIFIER . ' ON'
                    . ' ' . LANGUAGES_IDENTIFIER . '.' . LANGUAGEID_IDENTIFIER
                    . ' = ' . QUESTIONS_IDENTIFIER . '.' . LANGUAGEID_IDENTIFIER . ' SET'
                    . ' ' . 'Count'
                    . ' = ' . '0' . ' WHERE'
                    . ' ' . LANGUAGES_IDENTIFIER . '.' . LANGUAGEID_IDENTIFIER
                    . ' = :' . LANGUAGEID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . LANGUAGEID_IDENTIFIER, $languageID);
            
            $statement->execute();
            
            $statement->closeCursor();
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Resets the statistics for a question.
     * @param int $questionID The I.D. of the question to reset.
     */
    function ResetQuestionStatistics($questionID)
    {
        try
        {
            $db = GetDBConnection();
            
            //UPDATE questionstatistics INNER JOIN answers ON answers.AnswerID = questionstatistics.AnswerID INNER JOIN questions ON questions.QuestionID = answers.QuestionID SET Count = 0 WHERE questions.QuestionID = 4;
            $query = 'UPDATE ' . QUESTIONSTATISTICS_IDENTIFIER . ' INNER JOIN'
                    . ' ' . ANSWERS_IDENTIFIER . ' ON'
                    . ' ' . ANSWERS_IDENTIFIER . '.' . ANSWERID_IDENTIFIER
                    . ' = ' . QUESTIONSTATISTICS_IDENTIFIER  . '.' . ANSWERID_IDENTIFIER . ' INNER JOIN'
                    . ' ' . QUESTIONS_IDENTIFIER . ' ON'
                    . ' ' . QUESTIONS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER
                    . ' = ' . ANSWERS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER . ' SET'
                    . ' ' . 'Count'
                    . ' = ' . '0' . ' WHERE'
                    . ' ' . QUESTIONS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER
                    . ' = :' . QUESTIONID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . QUESTIONID_IDENTIFIER, $questionID);
            
            $statement->execute();
            
            $statement->closeCursor();
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Creates an answer statistic
     * @param int $answerID The I.D. of the answer.
     */
    function InsertQuestionStatisticsAnswer($answerID)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'INSERT INTO ' . QUESTIONSTATISTICS_IDENTIFIER
                    . ' (' . ANSWERID_IDENTIFIER
                    . ', ' . 'Count' . ') VALUES'
                    . ' (:' . ANSWERID_IDENTIFIER
                    . ', :' . 'Count' . ');';

            $statement = $db->prepare($query);

            $statement->bindValue(':' . ANSWERID_IDENTIFIER, $answerID);
            $statement->bindValue(':' . 'Count', '0', PDO::PARAM_INT);

            $statement->execute();
            
            $statement->closeCursor();
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Reads a word document and retursn the plain text.
     * @param string $filename The file path of the word document.
     * @return mixed The content of the word document, FALSE otherwise.
     */
    function GetWordDocContents($filename)
    {
        $striped_content = '';
        $content = ''; 
        
        if(!$filename || !file_exists($filename))
        {
            return false; 
        }
        
        $zip = zip_open($filename);

        if (!$zip || is_numeric($zip))
        {
            return false;
        }
        
        while ($zip_entry = zip_read($zip))
        { 
            if (zip_entry_open($zip, $zip_entry) == FALSE)
            {
                    continue;
            }
            
            if (zip_entry_name($zip_entry) != "word/document.xml")
            {
                continue; 
            }
            
            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry)); 

            zip_entry_close($zip_entry);

        }

        zip_close($zip);

        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
        $content = str_replace('</w:r></w:p>', "\r\n", $content);
        $striped_content = strip_tags($content);

        return $striped_content;
    }
    
    /**
     * Adds a level's information to the records.
     * @param LevelInfo $levelInfo The level information.
     * @return int The I.D. of the newly inserted information.
     */
    function AddLevelInfo(LevelInfo $levelInfo)
    {
        try
        {
            $levelKey = $levelInfo->GetLevelKey();
            $languageIdKey = $levelInfo->GetLanguageIdKey();
            $nameKey = $levelInfo->GetNameKey();
            $courseKey = $levelInfo->GetCourseKey();
            $descriptionKey = $levelInfo->GetDescriptionKey();
            
            $db = GetDBConnection();
            $query = 'INSERT INTO ' . LEVELINFOS_IDENTIFIER
                    . ' (' . $levelKey
                    . ', ' . $languageIdKey
                    . ', ' . $nameKey
                    . ', ' . $courseKey
                    . ', ' . $descriptionKey . ') VALUES'
                    . ' (:' . $levelKey
                    . ', :' . $languageIdKey
                    . ', :' . $nameKey
                    . ', :' . $courseKey
                    . ', :' . $descriptionKey . ');';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $levelKey, $levelInfo->GetLevel());
            $statement->bindValue(':' . $languageIdKey, $levelInfo->GetLanguageId());
            $statement->bindValue(':' . $nameKey, $levelInfo->GetName());
            $statement->bindValue(':' . $courseKey, $levelInfo->GetCourse());
            $statement->bindValue(':' . $descriptionKey,$levelInfo->GetDescription());
            
            $statement->execute();
            
            $statement->closeCursor();
            
            $levelInfoID = $db->lastInsertId();
            
            return $levelInfoID;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets the collection of level information for a language.
     * @return \LevelInfo The collection of level information.
     */
    function GetLevelInfos($languageID)
    {
        try
        {
            $levelInfos = array();
            $levelInfo = new LevelInfo();
            $languagekey = $levelInfo->GetLanguageIdKey();
            $levelKey = $levelInfo->GetLevelKey();
            
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . LEVELINFOS_IDENTIFIER . ' WHERE'
                    . ' ' . $languagekey
                    . ' = :' . $languagekey . ' ORDER BY'
                    . ' ' . $levelKey . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $languagekey, $languageID);
            
            $statement->execute();
            
            $results = $statement->fetchAll();
            
            $statement->closeCursor();
            
            foreach ($results as $result)
            {
                $levelInfo = new LevelInfo();
                
                $levelInfo->Initialize($result);
                
                $levelInfos[] = $levelInfo;
            }
            
            return $levelInfos;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Updates level information.
     * @param LevelInfo $levelInfo The level inforamtion.
     * @return int The number of rows effected by the update.
     */
    function UpdateLevelInfo(LevelInfo $levelInfo)
    {
        try
        {
            $idKey = $levelInfo->GetIdKey();
            $levelKey = $levelInfo->GetLevelKey();
            $languageIdKey = $levelInfo->GetLanguageIdKey();
            $nameKey = $levelInfo->GetNameKey();
            $classKey = $levelInfo->GetCourseKey();
            $descriptionKey = $levelInfo->GetDescriptionKey();
            
            $db = GetDBConnection();
            $query = 'UPDATE ' . LEVELINFOS_IDENTIFIER . ' SET'
                    . ' ' . $levelKey . ' = :' . $levelKey
                    . ', ' . $languageIdKey . ' = :' . $languageIdKey
                    . ', ' . $nameKey . ' = :' . $nameKey
                    . ', ' . $classKey . ' = :' . $classKey
                    . ', ' . $descriptionKey . ' = :' . $descriptionKey . ' WHERE'
                    . ' ' . $idKey
                    . ' = :' . $idKey . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $idKey, $levelInfo->GetId());
            $statement->bindValue(':' . $levelKey, $levelInfo->GetLevel());
            $statement->bindValue(':' . $languageIdKey, $levelInfo->GetLanguageId());
            $statement->bindValue(':' . $nameKey, $levelInfo->GetName());
            $statement->bindValue(':' . $classKey, $levelInfo->GetCourse());
            $statement->bindValue(':' . $descriptionKey,$levelInfo->GetDescription());
            
            $rowsEffected = $statement->execute();
            
            $statement->closeCursor();
            
            return $rowsEffected;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Deletes level information from the records.
     * @param int $levelInfoId The I.D. of the level information.
     * @return int The number of rows effected.
     */
    function DeleteLevelInfo($levelInfoId)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'DELETE FROM ' . LEVELINFOS_IDENTIFIER . ' WHERE'
                    . ' ' . LEVELINFOID_IDENTIFIER
                    . ' = :' . LEVELINFOID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . LEVELINFOID_IDENTIFIER, $levelInfoId);
            
            $rowsEffected = $statement->execute();
            
            $statement->closeCursor();
            
            return $rowsEffected;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Opens an excel file.
     * @param string $filePath The file path of the excel file.
     * @return \PHPExcel The PHPExcel representation of the excel file.
     */
    function OpenExcelFile($filePath)
    {
        $objPHPExcel = PHPExcel_IOFactory::load($filePath);
        
        return $objPHPExcel;
    }
    
    /**
     * Deletes a file.
     * @param string $filePath The file path of the file.
     * @return bool True, if the delete was succesfull.
     */
    function DeleteFile($filePath)
    {
        return unlink($filePath);
    }
    
    /**
     * Activates a contact.
     * @param int $contactID The I.D. of the contact.
     */
    function ActivateContact($contactID)
    {
        SetContactState($contactID, TRUE);
    }
    
    /**
     * Deactivates a contact.
     * @param int $contactID The I.D. of the contact.
     */
    function DeactivateContact($contactID)
    {
        SetContactState($contactID, FALSE);
    }
    
    /**
     * Sets the state of a contact.
     * @param int $contactID
     * @param int $primary The flag that indicates whether or not the 
     * @return int The number of contacts effected by the update.
     */
    function SetContactState($contactID, $primary)
    {
        try
        {
            $contact = new Contact();
            $primaryIndex = $contact->GetPrimaryIndex();
            
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . CONTACTS_IDENTIFIER . ' SET'
                    . ' `' . $primaryIndex . '` = :' . $primaryIndex . ' WHERE'
                    . ' ' . CONTACTID_IDENTIFIER 
                    . ' = :' . CONTACTID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . CONTACTID_IDENTIFIER, $contactID);
            $statement->bindValue(':' . $primaryIndex, $primary, PDO::PARAM_BOOL);
            
            $contactsEffected = $statement->execute();
            
            $statement->closeCursor();
            
            return $contactsEffected;
            
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Adds a contacts to the records.
     * @param \Contact $contact The contact.
     * @return int The I.D. of the newly inserted contact.
     */
    function AddContact($contact)
    {
        try
        {
            $firstNameIndex = $contact->GetFirstNameIndex();
            $lastNameIndex = $contact->GetLastNameIndex();
            $emailIndex = $contact->GetEmailIndex();
            
            $db = GetDBConnection();
            
            $query = 'INSERT INTO ' . CONTACTS_IDENTIFIER
                    . ' (' . $firstNameIndex
                    . ', ' . $lastNameIndex
                    . ', ' . $emailIndex . ') VALUES'                    
                    . ' (:' . $firstNameIndex
                    . ', :' . $lastNameIndex
                    . ', :' . $emailIndex . ');';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $firstNameIndex, $contact->GetFirstName());
            $statement->bindValue(':' . $lastNameIndex, $contact->GetLastName());
            $statement->bindValue(':' . $emailIndex, $contact->GetEmail());
            
            $statement->execute();
            
            $contactID = $db->lastInsertId();
            
            $statement->closeCursor();
            
            return $contactID;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets a contact from the records.
     * @param int $contactID The I.D. of the contact to get.
     * @return \Contact The contact.
     */
    function GetContact($contactID)
    {
        try
        {
            $contact = new Contact();
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . CONTACTS_IDENTIFIER . ' WHERE'
                    . ' ' . CONTACTID_IDENTIFIER
                    . ' = :' . CONTACTID_IDENTIFIER;
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . CONTACTID_IDENTIFIER, $contactID);
            
            $statement->execute();
            
            $row = $statement->fetch();
            
            $statement->closeCursor();
            
            $contact->Initialize($row);
            
            return $contact;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Updates a contact on the records.
     * @param int $contactID The I.D. of the contact to update.
     * @param \Contact $contact The contact.
     * @return int The number of contacts effected by the update.
     */
    function UpdateContact($contactID, $contact)
    {
        try
        {
            $firstNameIndex = $contact->GetFirstNameIndex();
            $lastNameIndex = $contact->GetLastNameIndex();
            $emailIndex = $contact->GetEmailIndex();
            
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . CONTACTS_IDENTIFIER . ' SET'
                    . ' ' . $firstNameIndex . ' = :' . $firstNameIndex
                    . ', ' . $lastNameIndex . ' = :' . $lastNameIndex
                    . ', ' . $emailIndex . ' = :' . $emailIndex . ' WHERE'
                    . ' ' . CONTACTID_IDENTIFIER
                    . ' = :' . CONTACTID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . CONTACTID_IDENTIFIER, $contactID);
            $statement->bindValue(':' . $firstNameIndex, $contact->GetFirstName());
            $statement->bindValue(':' . $lastNameIndex, $contact->GetLastName());
            $statement->bindValue(':' . $emailIndex, $contact->GetEmail());
            
            $contactsEffected = $statement->execute();
            
            $statement->closeCursor();
            
            return $contactsEffected;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Deletes a contact from the records.
     * @param int $contactID The I.D. of the contact to delete.
     * @return int The number contacts deleted.
     */
    function DeleteContact($contactID)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'DELETE FROM ' . CONTACTS_IDENTIFIER . ' WHERE'
                    . ' ' . CONTACTID_IDENTIFIER
                    . ' = :' . CONTACTID_IDENTIFIER;
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . CONTACTID_IDENTIFIER, $contactID);
            
            $contactsDeleted = $statement->execute();
            
            $statement->closeCursor();
            
            return $contactsDeleted;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets a collection of all contacts on record.
     * @return \Contact Array of contacts.
     */
    function GetContacts()
    {
        try
        {
            $contacts = array();
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . CONTACTS_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            
            $statement->execute();
            
            $rows = $statement->fetchAll();
            
            $statement->closeCursor();
            
            foreach ($rows as $row)
            {
                $contact = new Contact();
                $contact->Initialize($row);
                
                $contacts[] = $contact;
            }
            
            return $contacts;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Creates an excel file of questions for the given language.
     * @param int $languageID The I.D. of the language to export.
     * @return string The file path of the file.
     */
    function ExportLanguageQuestions($languageID)
    {
        try
        {
            $fileName = TEMP_DIR . 'langauge_' . date("m-d-Y-G-i-s") . '.xlsx';
			$language = GetLanguage($languageID);
            $languageName = $language[NAME_IDENTIFIER];
            $objPHPExcel = new PHPExcel();
                
            // Set properties
            $properties = $objPHPExcel->getProperties();
            $properties->setCreator("FLPExam site");
            $properties->setLastModifiedBy("FLPExam site");
            $properties->setTitle($languageName . " Exam Questions");
            $properties->setSubject($languageName . " Exam Questions");
            $properties->setDescription("Exam questions for " . $languageName . ".");
            $properties->setKeywords("foreign language placement exam " . $languageName);
            $properties->setCategory("Exam Questions");
            
            $workSheet = $objPHPExcel->setActiveSheetIndex(0);
            $workSheet->setTitle('Questions');
            
            $workSheet->getColumnDimensionByColumn(0)->setVisible(false);
            
            $questions = GetQuestions($languageID);
            
            $row = 1;
            $column = 0;
            
            $workSheet->setCellValueByColumnAndRow($column++, $row, 'Question ID');
            $workSheet->setCellValueByColumnAndRow($column++, $row, 'Level');
            $workSheet->setCellValueByColumnAndRow($column++, $row, 'Instructions');
            $workSheet->setCellValueByColumnAndRow($column++, $row, 'Question');
            $workSheet->setCellValueByColumnAndRow($column++, $row, 'Correct Answer');
            
            foreach ($questions as $question)
            {
                $row++;
                $column = 0;
                
                $questionID = $question[QUESTIONID_IDENTIFIER];
                $level = $question['Level'];
                $instructions = $question['Instructions'];
                $quesName = $question[NAME_IDENTIFIER];
                
                $answers = GetQuestionAnswers($questionID);
                
                $workSheet->setCellValueByColumnAndRow($column++, $row, $questionID);
                $workSheet->setCellValueByColumnAndRow($column++, $row, $level);
                $workSheet->setCellValueByColumnAndRow($column++, $row, $instructions);
                $workSheet->setCellValueByColumnAndRow($column++, $row, $quesName);
                
                foreach ($answers as $answer)
                {
                    $ansName = $answer[NAME_IDENTIFIER];
                    $workSheet->setCellValueByColumnAndRow($column++, $row, $ansName);
                }
            }
            
            $workSheet->getProtection()->setSheet(true);
            
            $highestCol = $workSheet->getHighestDataColumn();
            $highestRow = $workSheet->getHighestDataRow();
            
            $workSheet->getStyle('B2:' . $highestCol . $highestRow)->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED); 
            
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save($fileName);
            
            return $fileName;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets the collection of test information from the records.
     * @return \TestInfo
     */
    function GetTests()
    {
        try
        {
            $testInfo = new TestInfo();
            $testInfos = array();
            $testIdIndex = $testInfo->GetIdIndex();
            $firstNameIndex = $testInfo->GetFirstNameIndex();
            $lastNameIndex = $testInfo->GetLastNameIndex();
            $languageIndex = $testInfo->GetLanguageIndex();
            $scoreIndex = $testInfo->GetScoreIndex();
            $dateIndex = $testInfo->GetDateIndex();
            
            $db = GetDBConnection();
            
            $query = 'SELECT ' . TESTENTIRES_IDENTIFIER . '.' . $testIdIndex
                    . ', ' . $firstNameIndex
                    . ', ' . $lastNameIndex
                    . ', ' . $languageIndex
                    . ', ' . $scoreIndex
                    . ', ' . $dateIndex . ' FROM'
                    . ' ' . TESTENTIRES_IDENTIFIER . ' INNER JOIN'
                    . ' ' . TESTEES_IDENTIFIER . ' ON'
                    . ' ' . TESTEES_IDENTIFIER . '.' . $testIdIndex
                    . ' = ' . TESTENTIRES_IDENTIFIER . '.' . $testIdIndex
                    . ' ORDER BY ' . $dateIndex . ' DESC;';
            
            $statement = $db->prepare($query);
            
            $statement->execute();
            
            $results = $statement->fetchAll();
            
            $statement->closeCursor();
            
            foreach ($results as $result)
            {
                $testInfo = new TestInfo();
                $testInfo->Initialize($result);
                
                $testInfos[] = $testInfo;
            }
            
            return $testInfos;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets the detailed test information.
     * @param int $testID The I.D. of the test.
     * @return \DetailedTestInfo The detailed test information.
     */
    function GetDetailedTest($testID)
    {
        try
        {
            $testInfo = new DetailedTestInfo();
            $testIdIndex = $testInfo->GetIdIndex();
            $firstNameIndex = $testInfo->GetFirstNameIndex();
            $lastNameIndex = $testInfo->GetLastNameIndex();
            $languageIndex = $testInfo->GetLanguageIndex();
            $scoreIndex = $testInfo->GetScoreIndex();
            $dateIndex = $testInfo->GetDateIndex();
            $emailIndex = $testInfo->GetEmailIndex();
            $majorIndex = $testInfo->GetMajorIndex();
            $highSchoolIndex = $testInfo->GetHighSchoolIndex();
            $spokenAtHomeIndex = $testInfo->GetSpokenAtHomeIndex();
            $jrHighExpIndex = $testInfo->GetJrHighExpIndex();
            $srHighExpIndex = $testInfo->GetSrHighExpIndex();
            $collegeExpIndex = $testInfo->GetCollegeExpIndex();
            $currentCourseIndex = $testInfo->GetCurrentCourseIndex();
            
            
            $db = GetDBConnection();
            
            $query = 'SELECT ' . TESTENTIRES_IDENTIFIER . '.' . $testIdIndex
                    . ', ' . $firstNameIndex
                    . ', ' . $lastNameIndex
                    . ', ' . $languageIndex
                    . ', ' . $scoreIndex
                    . ', ' . $emailIndex
                    . ', ' . $majorIndex
                    . ', ' . $highSchoolIndex
                    . ', ' . $spokenAtHomeIndex
                    . ', ' . $jrHighExpIndex
                    . ', ' . $srHighExpIndex
                    . ', ' . $collegeExpIndex
                    . ', ' . $currentCourseIndex
                    . ', ' . $dateIndex . ' FROM'
                    . ' ' . TESTENTIRES_IDENTIFIER . ' INNER JOIN'
                    . ' ' . TESTEES_IDENTIFIER . ' ON'
                    . ' ' . TESTEES_IDENTIFIER . '.' . $testIdIndex
                    . ' = ' . TESTENTIRES_IDENTIFIER . '.' . $testIdIndex . ' INNER JOIN'
                    . ' ' . TESTEEEXPERIENCES_IDENTIFIER . ' ON'
                    . ' ' . TESTEEEXPERIENCES_IDENTIFIER . '.' . $testIdIndex
                    . ' = ' . TESTENTIRES_IDENTIFIER . '.' . $testIdIndex . ' WHERE'
                    . ' ' . TESTENTIRES_IDENTIFIER . '.' . $testIdIndex
                    . ' = :' . $testIdIndex . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $testIdIndex, $testID);
            
            $statement->execute();
            
            $results = $statement->fetch();
            
            $statement->closeCursor();
            
            if (count($results) > 0)
            {
                $testInfo->Initialize($results);
            }
            
            return $testInfo;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Sets the exam parameters.
     * @param ExamParameters $parameters The parameters.
     * @return int The number of exam parameter rows effected by the update.
     */
    function SetExamParameters(ExamParameters $parameters)
    {
        try
        {
            $db = GetDBConnection();
            
            $keyCodeIndex = $parameters->GetKeyCodeIndex();
            $questionCountIndex = $parameters->GetQuestionCountIndex();
            $incLevelScoreIndex = $parameters->GetIncLevelScoreIndex();
            $decLevelScoreIndex = $parameters->GetDecLevelScoreIndex();
            
            $query = 'UPDATE ' . EXAMPARAMETERS_IDENTIFIER . ' SET'
                    . ' ' . $keyCodeIndex . ' = :' . $keyCodeIndex
                    . ', ' . $questionCountIndex . ' = :' . $questionCountIndex
                    . ', ' . $incLevelScoreIndex . ' = :' . $incLevelScoreIndex
                    . ', ' . $decLevelScoreIndex . ' = :' . $decLevelScoreIndex . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $keyCodeIndex, $parameters->GetKeyCode());
            $statement->bindValue(':' . $questionCountIndex, $parameters->GetQuestionCount());
            $statement->bindValue(':' . $incLevelScoreIndex, $parameters->GetIncLevelScore());
            $statement->bindValue(':' . $decLevelScoreIndex, $parameters->GetDecLevelScore());
            
            $paramsEffected = $statement->execute();
            
            $statement->closeCursor();
            
            return $paramsEffected;
            
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Searches all users for the given name.
     * @param int $languageID The I.D. of the language to search.
     * @param string $name The user's first and/or last name.
     * @return array The collection of users found in the search.
     */
    function SearchForQuestion($languageID, $name)
    {
        try
        {
            $db = GetDBConnection();

            $query = 'SELECT ' . QUESTIONS_IDENTIFIER . '.* FROM'
                    . ' ' . QUESTIONS_IDENTIFIER . ' INNER JOIN'
                    . ' ' . ANSWERS_IDENTIFIER . ' ON'
                    . ' ' . QUESTIONS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER
                    . ' = ' . ANSWERS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER . ' WHERE'
                     . ' ' . LANGUAGEID_IDENTIFIER
                    . ' = :'. LANGUAGEID_IDENTIFIER . ' AND ('
                    . QUESTIONS_IDENTIFIER . '.' . NAME_IDENTIFIER . ' LIKE'
                    . ' :' . NAME_IDENTIFIER . ' OR' 
                    . ' ' . 'Instructions' . ' LIKE'
                    . ' :' . NAME_IDENTIFIER . ' OR'
                    . ' ' . ANSWERS_IDENTIFIER . '.' . NAME_IDENTIFIER . ' LIKE'
                    . ' :' . NAME_IDENTIFIER . ') GROUP BY'
                    . ' '. QUESTIONS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER . ';';
            

            $statement = $db->prepare($query);
            $statement->bindValue(':' . LANGUAGEID_IDENTIFIER, $languageID);
            $statement->bindValue(':' . NAME_IDENTIFIER, '%' . $name . '%');
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
     * Activates a language.
     * @param int $languageID The I.D. of the language to Activate.
     */
    function ActivateLanguage($languageID)
    {
        SetLanguageState($languageID, TRUE);
    }
    
    /**
     * Deactivates a language.
     * @param int $languageID The I.D. of the language to deactivate.
     */
    function DeactivateLanguage($languageID)
    {
        SetLanguageState($languageID, FALSE);
    }
    
    /**
     * Sets a languages state to either TRUE or FALSE.
     * @param int $languageID The I.D. of the language to activate/deactivate.
     * @param boolean $active The flag that indicates whether the language should be active or deactive.
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
            $statement->bindValue(':' . 'Active', $active, PDO::PARAM_BOOL);
            
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
            
            $query = 'DELETE FROM ' . LANGUAGES_IDENTIFIER . ' WHERE'
                    . ' ' . LANGUAGEID_IDENTIFIER
                    . ' = :' . LANGUAGEID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . LANGUAGEID_IDENTIFIER, $languageID);
            
            $languagesDeleted = $statement->execute();
            
            $statement->closeCursor();
            
            return $languagesDeleted;
        }
        catch(PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets the language that a question belongs to.
     * @param int $questionID The I.D. of the question.
     * @return array The language that the question belongs to.
     */
    function GetQuestionLanguage($questionID)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'SELECT ' . LANGUAGES_IDENTIFIER . '.* FROM'
                    . ' ' . LANGUAGES_IDENTIFIER . ' INNER JOIN'
                    . ' ' . QUESTIONS_IDENTIFIER .' ON'
                    . ' ' . LANGUAGES_IDENTIFIER . '.' . LANGUAGEID_IDENTIFIER
                    . ' = ' . QUESTIONS_IDENTIFIER . '.' . LANGUAGEID_IDENTIFIER . ' WHERE'
                    . ' ' . QUESTIONID_IDENTIFIER
                    . ' = :' . QUESTIONID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            
            $statement->bindValue(':' . QUESTIONID_IDENTIFIER, $questionID);
            
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
     * Gets all the questions of a specific language.
     * @param int $languageID The I.D. of the language questions to get.
     * @param int $level The level of the questions to get.
     * @return array The collection of questions.
     */
    function GetQuestions($languageID, $level = 0)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . QUESTIONS_IDENTIFIER . ' WHERE'
                    . ' ' . LANGUAGEID_IDENTIFIER
                    . ' = :' . LANGUAGEID_IDENTIFIER;
            
            if ($level > 0)
            {
                $query .= ' AND ' . 'Level' . ' = :' . 'Level';
            }
            
            $query .= ' ORDER BY' . ' ' . 'Level' . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . LANGUAGEID_IDENTIFIER, $languageID);
            
            if ($level > 0)
            {
                $statement->bindValue(':' . 'Level', $level);
            }
            
            $statement->execute();
            
            $questions = $statement->fetchAll();
            
            $statement->closeCursor();
            
            return $questions;
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
    function UpdateQuestion($questionID, $name, $instructions, $level, $answers)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . QUESTIONS_IDENTIFIER . ' SET'
                    . ' ' . '`Level`'
                    . ' = :' . 'Level'
                    . ', ' . 'Instructions'
                    . ' = :' . 'Instructions'
                    . ', ' . '`Name`'
                    . ' = :' . 'Name WHERE'
                    . ' ' . QUESTIONID_IDENTIFIER
                    . ' = :' . QUESTIONID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . QUESTIONID_IDENTIFIER, $questionID);
            $statement->bindValue(':' . 'Name', $name);
            $statement->bindValue(':' . 'Instructions', $instructions);
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
     * @param int $languageID The I.D. of the language the question belongs to.
     * @param string $name The question.
     * @param int $level The questions level.
     * @param array $answers The answers to the question.
     * @return int The I.D. of the new question.
     */
    function AddQuestion($languageID, $name, $instructions, $level, $answers)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'INSERT INTO ' . QUESTIONS_IDENTIFIER
                    . ' (' . 'Level'
                    . ', ' . LANGUAGEID_IDENTIFIER
                    . ', ' . 'Instructions'
                    . ', ' . 'Name' . ') VALUES'
                    . ' (:' . 'Level'
                    . ', :' . LANGUAGEID_IDENTIFIER
                    . ', :' . 'Instructions'
                    . ', :' . 'Name' . ');';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . 'Name', $name);
            $statement->bindValue(':' . LANGUAGEID_IDENTIFIER, $languageID);
            $statement->bindValue(':' . 'Instructions', $instructions);
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
                $query = 'INSERT INTO ' . ANSWERS_IDENTIFIER
                        . ' ('. QUESTIONID_IDENTIFIER
                        . ', ' . 'Correct'
                        . ', ' . 'Name' . ') VALUES'
                        . ' (:' . QUESTIONID_IDENTIFIER
                        . ', :' . 'Correct'
                        . ', :' . 'Name' . ');';
                
                $statement = $db->prepare($query);
                $statement->bindValue(':' . QUESTIONID_IDENTIFIER ,$questionID);
                $statement->bindValue(':' . 'Correct', '1');
                $statement->bindValue(':' . 'Name', $answer);
                
                $statement->execute();
                
                $statement->closeCursor();
                
                $answerID = $db->lastInsertId();
                    
                InsertQuestionStatisticsAnswer($answerID);
                
                //Now answer all of the other answers which are inccorect.
                for($i = 1; $i < count($answers); $i++)
                {
                    $answer = $answers[$i];
                    
                    $query = 'INSERT INTO ' . ANSWERS_IDENTIFIER
                        . ' ('. QUESTIONID_IDENTIFIER
                        . ', ' . 'Correct'
                        . ', ' . 'Name' . ') VALUES'
                        . ' (:' . QUESTIONID_IDENTIFIER
                        . ', :' . 'Correct'
                        . ', :' . 'Name' . ');';
                
                    $statement = $db->prepare($query);
                    $statement->bindValue(':' . QUESTIONID_IDENTIFIER , $questionID);
                    $statement->bindValue(':' . 'Correct', '0');
                    $statement->bindValue(':' . 'Name', $answer);

                    $statement->execute();
                    
                    $statement->closeCursor();
                    
                    $answerID = $db->lastInsertId();
                    
                    InsertQuestionStatisticsAnswer($answerID);
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
                    . " " . "UserName" . " LIKE"
                    . " :" . "UserName";

            $statement = $db->prepare($query);
            $statement->bindValue(':' . 'UserName', $name);
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
            $query = 'SELECT * FROM ' . USERS_IDENTIFIER . ' WHERE'
                    . ' ' . USERID_IDENTIFIER
                    . ' = :' . USERNAME_IDENTIFIER . ';';

            $statement = $db->prepare($query);
            $statement->bindValue(':'. USERNAME_IDENTIFIER, $userName);
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
            LogError($e);
        }
        
        return $exists;
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
            
            $query = "SELECT * FROM users order by UserName";
            
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
     * @param string $userName The user name that the user will use with the site.
     * @param string $password The password that the user will use for authentication.
     * @return int The user id of the added user.
     */
    function addUser($userName, $password)
    {
        try
        {
            $db = GetDBConnection();
            $query = 'INSERT INTO ' . USERS_IDENTIFIER
                    . ' (' . USERNAME_IDENTIFIER
                    . ', ' . PASSWORD_IDENTIFIER . ') VALUES'
                    . ' (:' . USERNAME_IDENTIFIER
                    . ', :' . PASSWORD_IDENTIFIER . ');';
            
            $statement = $db->prepare($query);

            $statement->bindValue(':UserName', $userName);
            $statement->bindValue(':Password', sha1($password));

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
     * Updates a user's information
     * @param int $userID The I.D. of the user to update.
     * @param string $firstName The first name of the user.
     * @param string $lastName The last name of the user.
     * @param string $userName The username of the user.
     * @param string $password The user's password
     * @param string $email The email of the user.
     * @return int The number of users that were effected by the update.
     */
    function UpdateUser($userID, $userName, $password)
    {
        try
        {
            if(!empty($password))
            {
                UpdateUserPassword($userID, $password);
            }
            
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . USERS_IDENTIFIER . ' SET'
                    . ' ' . USERNAME_IDENTIFIER
                    . ' = :' . USERNAME_IDENTIFIER . ' WHERE'
                    . ' ' . USERID_IDENTIFIER
                    . ' = :' . USERID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . USERID_IDENTIFIER, $userID);
            $statement->bindValue(':' . USERNAME_IDENTIFIER, $userName);
            
            $rowsEffected = $statement->execute();
            
            $statement->closeCursor();
            
            return $rowsEffected;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    function UpdateUserPassword($userID, $password)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . USERS_IDENTIFIER . ' SET'
                    . ' ' . PASSWORD_IDENTIFIER
                    . ' = :' . PASSWORD_IDENTIFIER . ' WHERE'
                    . ' ' . USERID_IDENTIFIER
                    . ' = :' . USERID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . USERID_IDENTIFIER, $userID);
            $statement->bindValue(':' . PASSWORD_IDENTIFIER, sha1($password));
            
            $rowsEffected = $statement->execute();
            
            $statement->closeCursor();
            
            return $rowsEffected;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Updates a user's account information.
     * @param int $userID The user ID of the user account to update.
     * @param array $hasAttributes The new collection of role ID's that the user will have.
     */
    function updateUserAttributes($userID, $hasAttributes)
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
    
    /**
     * Searches the tests.
     * @param string $name The name.
     * @param string $language The language.
     * @param float $minScore The minimum score.
     * @param float $maxScore The maximum score.
     * @param float $minDate The minimum date.
     * @param float $maxDate The maximum date.
     * @return \TestInfo The collection of test entries found
     */
    function SearchForTest($name, $language, $minScore, $maxScore, $minDate, $maxDate)
    {
        try
        {
            $testInfo = new TestInfo();
            $testInfos = array();
            $testIdIndex = $testInfo->GetIdIndex();
            $firstNameIndex = $testInfo->GetFirstNameIndex();
            $lastNameIndex = $testInfo->GetLastNameIndex();
            $languageIndex = $testInfo->GetLanguageIndex();
            $scoreIndex = $testInfo->GetScoreIndex();
            $dateIndex = $testInfo->GetDateIndex();
            
            $db = GetDBConnection();
            
            $query = 'SELECT ' . TESTENTIRES_IDENTIFIER . '.' . $testIdIndex
                    . ', ' . $firstNameIndex
                    . ', ' . $lastNameIndex
                    . ', ' . $languageIndex
                    . ', ' . $scoreIndex
                    . ', ' . $dateIndex . ' FROM'
                    . ' ' . TESTENTIRES_IDENTIFIER . ' INNER JOIN'
                    . ' ' . TESTEES_IDENTIFIER . ' ON'
                    . ' ' . TESTEES_IDENTIFIER . '.' . $testIdIndex
                    . ' = ' . TESTENTIRES_IDENTIFIER . '.' . $testIdIndex;
                    
            if(!empty($name))
            {
                $whereClause = '';
                $namePieces = explode(' ', $name);
                
                if (count($namePieces) > 0)
                {
                    
                    $whereClause = ' WHERE (' . $firstNameIndex . ' LIKE'
                                    . ' :' . NAME_IDENTIFIER . '0' . ' OR'
                                    . ' ' . $lastNameIndex . ' LIKE'
                                    . ' :' . NAME_IDENTIFIER . '0';
                }
                
                for ($i = 1; $i < count($namePieces); $i++)
                {
                    $namePiece = $namePieces[$i];
                    
                    if (!empty($namePiece))
                    {
                        $whereClause .= ' OR ' . $firstNameIndex . ' LIKE'
                                    . ' :' . NAME_IDENTIFIER . $i . ' OR'
                                    . ' ' . $lastNameIndex . ' LIKE'
                                    . ' :' . NAME_IDENTIFIER . $i;
                    }
                }
                
                if (!empty($whereClause))
                {
                    $whereClause .= ')';
                }
            }
            
            if(!empty($language))
            {
                if(empty($whereClause))
                {
                    $whereClause = ' WHERE ' . $languageIndex . ' = :' . $languageIndex;
                }
                else
                {
                    $whereClause .= ' AND ' . $languageIndex . ' = :' . $languageIndex;
                }
            }
            
            if((!empty($minScore) || $minScore == 0.0) && !empty($maxScore))
            {
               if(empty($whereClause))
                {
                    $whereClause = ' WHERE ' . $scoreIndex . ' >= :MinScore';
                }
                else
                {
                    $whereClause .= ' AND ' . $scoreIndex . ' >= :MinScore';
                }
                
                $whereClause .= ' AND ' . $scoreIndex . ' <= :MaxScore';
            }
            
            if(!empty($minDate) && !empty($maxDate))
            {
                if(empty($whereClause))
                {
                    $whereClause = ' WHERE ' . $dateIndex . ' >= :MinDate';
                }
                else
                {
                    $whereClause .= ' AND ' . $dateIndex . ' >= :MinDate';
                }
                
                $whereClause .= ' AND ' . $dateIndex . ' <= :MaxDate';
            }
            
            if(!empty($whereClause))
            {
                $query .= $whereClause;
            }
            
            $query = $query . ' ORDER BY ' . $dateIndex . ' DESC;';
            
            $statement = $db->prepare($query);
            
            if(!empty($name))
            {
                for ($i = 0; $i < count($namePieces); $i++)
                {
                    $namePiece = $namePieces[$i];
                    
                    if (!empty($namePiece))
                    {
                        $statement->bindValue(':' . NAME_IDENTIFIER . $i, '%' . $namePiece . '%');
                    }
                }
            }
            
            if(!empty($language))
            {
                $statement->bindValue(':' . $languageIndex, $language);
            }
            
            if((!empty($minScore) || $minScore == 0.0 ) && !empty($maxScore))
            {
               $statement->bindValue(':' . 'MinScore', $minScore);
               $statement->bindValue(':' . 'MaxScore', $maxScore);
            }
            
            if(!empty($minDate) && !empty($maxDate))
            {
                $statement->bindValue(':' . 'MinDate', ToMySQLDate($minDate));
                $statement->bindValue(':' . 'MaxDate', ToMySQLDate($maxDate));
            }
            
            $statement->execute();
            
            $results = $statement->fetchAll();
            
            $statement->closeCursor();
            
            foreach ($results as $result)
            {
                $testInfo = new TestInfo();
                $testInfo->Initialize($result);
                
                $testInfos[] = $testInfo;
            }
            
            return $testInfos;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
?>
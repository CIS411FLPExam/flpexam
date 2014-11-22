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
    require_once(QUESTIONCOMMENTCLASS_FILE);
    require_once(EXPERIENCEOPTIONCLASS_FILE);
    require_once(LEOPAIRCLASS_FILE);
    
    /**
     * Indicates whether or not a user is vital.
     * @param int $userID The I.D. of the user.
     * @return boolean TRUE, if the user is vital, or FALSE otherwise.
     */
    function UserIsVital($userID)
    {
        try
        {
            $isVital = FALSE;
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . USERS_IDENTIFIER . ' WHERE'
                    . ' ' . USERID_IDENTIFIER
                    . ' = :' . USERID_IDENTIFIER . ' AND'
                    . ' ' . 'Vital'
                    . ' = :' . 'Vital' . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . USERID_IDENTIFIER, $userID);
            $statement->bindValue(':' . 'Vital', 1);
            
            $statement->execute();
            
            $vitalUser = $statement->fetch();
            
            $statement->closeCursor();
            
            if ($vitalUser != FALSE)
            {
                $isVital = TRUE;
            }
            
            return $isVital;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Indicates whether or not a role is vital.
     * @param int $roleID The I.D. of the role.
     * @return boolean TRUE, if the role is vital, or FALSE otherwise.
     */
    function RoleIsVital($roleID)
    {
        try
        {
            $isVital = FALSE;
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . ROLES_IDENTIFIER . ' WHERE'
                    . ' ' . ROLEID_IDENTIFIER
                    . ' = :' . ROLEID_IDENTIFIER . ' AND'
                    . ' ' . 'Vital'
                    . ' = :' . 'Vital' . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . ROLEID_IDENTIFIER, $roleID);
            $statement->bindValue(':' . 'Vital', 1);
            
            $statement->execute();
            
            $vitalRole = $statement->fetch();
            
            $statement->closeCursor();
            
            if ($vitalRole != FALSE)
            {
                $isVital = TRUE;
            }
            
            return $isVital;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Exports the test results of the given test I.D.s into an excel file.
     * @param array $testIDs The collection of test I.D.s.
     * @return mixed The file path of the excel file, or FALSE if no test entries were retrieved.
     */
    function ExportTestResults($testIDs)
    {
        $testEntries = GetBasicTestEntries($testIDs);
        
        if ($testEntries == FALSE)
        {
            return $testEntries;
        }
        
        $fileName = TEMP_DIR . 'test_results_' . date("m-d-Y-G-i-s") . '.xlsx';
        $objPHPExcel = new PHPExcel();

        // Set properties
        $properties = $objPHPExcel->getProperties();
        $properties->setCreator("FLPExam site");
        $properties->setLastModifiedBy("FLPExam site");
        $properties->setTitle("Test Results");
        $properties->setSubject("Test Results");
        $properties->setDescription("Test results.");
        $properties->setKeywords("foreign language placement exam test results");
        $properties->setCategory("Test Results");

        $workSheet = $objPHPExcel->setActiveSheetIndex(0);
        $workSheet->setTitle('Test Results');

        $row = 1;
        $column = 0;

        $workSheet->setCellValueByColumnAndRow($column++, $row, 'First Name');
        $workSheet->setCellValueByColumnAndRow($column++, $row, 'Last Name');
        $workSheet->setCellValueByColumnAndRow($column++, $row, 'High School');
        $workSheet->setCellValueByColumnAndRow($column++, $row, 'Language');
        $workSheet->setCellValueByColumnAndRow($column++, $row, 'Score');
        $workSheet->setCellValueByColumnAndRow($column++, $row, 'Date');


        foreach ($testEntries as $testEntry)
        {
            $row++;
            $column = 0;

            $firstName = $testEntry[FIRSTNAME_IDENTIFIER];
            $lastName = $testEntry[LASTNAME_IDENTIFIER];
            $highSchool = $testEntry['HighSchool'];
            $language = $testEntry['Language'];
            $score = $testEntry['Score'];
            $date = ToDisplayDate($testEntry['Date']);

            $workSheet->setCellValueByColumnAndRow($column++, $row, $firstName);
            $workSheet->setCellValueByColumnAndRow($column++, $row, $lastName);
            $workSheet->setCellValueByColumnAndRow($column++, $row, $highSchool);
            $workSheet->setCellValueByColumnAndRow($column++, $row, $language);
            $workSheet->setCellValueByColumnAndRow($column++, $row, $score);
            $workSheet->setCellValueByColumnAndRow($column++, $row, $date);
        }

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save($fileName);

        return $fileName;
    }
    
    /**
     * Deletes an experience option from the records.
     * @param int $optionID The I.D. of the experience option.
     * @return int The number of rows that was deleted.
     */
    function DeleteExperienceOption($optionID)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'DELETE FROM ' . EXPERIENCEOPTIONS_IDENTIFIER . ' WHERE'
                    . ' ' . EXPERIENCEOPTIONID_IDENTIFIER
                    . ' = :' . EXPERIENCEOPTIONID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . EXPERIENCEOPTIONID_IDENTIFIER, $optionID);
            
            $rowsDeleted = $statement->execute();
            
            $statement->closeCursor();
            
            return $rowsDeleted;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Adds an expreince option to the records.
     * @param int $experienceID The I.D. of the language experience to add the option to.
     * @param ExperienceOption $option The exprience option.
     * @return int The new I.D. of the experience option.
     */
    function AddExperienceOption(ExperienceOption $option)
    {
        try
        {
            $experienceIdKey = $option->GetExperienceIdKey();
            $nameKey = $option->GetNameKey();
            $initLevelKey = $option->GetInitLevelKey();
            
            $db = GetDBConnection();
            
            $query = 'INSERT INTO ' . EXPERIENCEOPTIONS_IDENTIFIER
                    . ' (' . $experienceIdKey
                    . ', ' . $nameKey
                    . ', ' . $initLevelKey . ') VALUES'
                    . ' (:' . $experienceIdKey
                    . ', :' . $nameKey
                    . ', :' . $initLevelKey . ');';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $experienceIdKey, $option->GetExperienceId());
            $statement->bindValue(':' . $nameKey, $option->GetName());
            $statement->bindValue(':' . $initLevelKey, $option->GetInitLevel());
            
            $statement->execute();
            
            $optionID = $db->lastInsertId();
            
            $statement->closeCursor();
            
            return $optionID;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Updates an experience option.
     * @param ExperienceOption $option The experience option to update with the updated values.
     * @return int The number of rows affected by the update.
     */
    function UpdateExperienceOption(ExperienceOption $option)
    {
        try
        {
            $idKey = $option->GetIdKey();
            $experienceIdKey = $option->GetExperienceIdKey();
            $nameKey = $option->GetNameKey();
            $initLevelKey = $option->GetInitLevelKey();
            
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . EXPERIENCEOPTIONS_IDENTIFIER . ' SET'
                    . ' ' . $experienceIdKey . ' = :' . $experienceIdKey 
                    . ', ' . $nameKey . ' = :' . $nameKey
                    . ', ' . $initLevelKey . ' = :' . $initLevelKey . ' WHERE'
                    . ' ' . $idKey
                    . ' = :' . $idKey . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $idKey, $option->GetId());
            $statement->bindValue(':' . $experienceIdKey, $option->GetExperienceId());
            $statement->bindValue(':' . $nameKey, $option->GetName());
            $statement->bindValue(':' . $initLevelKey, $option->GetInitLevel());
            
            $rowsAffected = $statement->execute();
            
            $statement->closeCursor();
            
            return $rowsAffected;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets an experience option.
     * @param int $optionID The I.D. of the experience option.
     * @return \ExperienceOption The experience option.
     */
    function GetExperienceOption($optionID)
    {
        try
        {
            $option = new ExperienceOption();
            $idKey = $option->GetIdKey();
            
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . EXPERIENCEOPTIONS_IDENTIFIER . ' WHERE'
                    . ' ' . $idKey
                    . ' = :' . $idKey .';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $idKey, $optionID);
            
            $statement->execute();
            
            $row = $statement->fetch();
            
            $statement->closeCursor();
            
            if ($row != FALSE)
            {
                $option->Initialize($row);
            }
            
            return $option;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets the collection of options that correspond to the an experience.
     * @param int $experienceID The I.D. of the experience.
     * @return \ExperienceOption The collection of experience options.
     */
    function GetExperienceOptions($experienceID)
    {
        try
        {
            $options = array();
            $option = new ExperienceOption();
            $experienceIdKey = $option->GetExperienceIdKey();
            
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . EXPERIENCEOPTIONS_IDENTIFIER . ' WHERE'
                    . ' ' . $experienceIdKey
                    . ' = :' . $experienceIdKey
                    . ' ORDER BY ' . EXPERIENCEOPTIONID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $experienceIdKey, $experienceID);
            
            $statement->execute();
            
            $rows = $statement->fetchAll();
            
            $statement->closeCursor();
            
            foreach($rows as $row)
            {
                $option = new ExperienceOption();
                $option->Initialize($row);
                
                $options[] = $option;
            }
            
            return $options;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets the I.D. of the language experience for an option.
     * @param int $optionID The I.D. of the option.
     * @return int The I.D. of the language experience.
     */
    function GetOptionExperienceID($optionID)
    {
        try
        {
            $experienceID = 0;
            $option = new ExperienceOption();
            $idKey = $option->GetIdKey();
            $experienceIdKey = $option->GetExperienceIdKey();
            
            $db = GetDBConnection();
            
            $query  = 'SELECT ' . $experienceIdKey . ' FROM ' . EXPERIENCEOPTIONS_IDENTIFIER . ' WHERE'
                    . ' ' . $idKey
                    . ' = :' . $idKey . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $idKey, $optionID);
            
            $statement->execute();
            
            $row = $statement->fetch();
            
            $statement->closeCursor();
            
            if ($row != FALSE)
            {
                $experienceID = $row[0];
            }
            
            return $experienceID;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets all the comments on record for a question.
     * @param int $questionID The I.D. of the question.
     * @return array The collection of question comments.
     */
    function GetQuestionComments($questionID)
    {
        try
        {
            $qcs = array();
            $qc = new QuestionComment();
            $questionIdKey = $qc->GetQuestionIdKey();
            
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . QUESTIONCOMMENTS_IDENTIFIER . ' WHERE'
                    . ' ' . $questionIdKey
                    . ' = :' . $questionIdKey . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $questionIdKey, $questionID);
            
            $statement->execute();
            
            $rows = $statement->fetchAll();
            
            $statement->closeCursor();
            
            foreach($rows as $row)
            {
                $qc = new QuestionComment();
                $qc->Initialize($row);
                
                $qcs[] = $qc;
            }
            
            return $qcs;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Deletes all comments on record for each question of a language.
     * @param int $languageID The I.D. of the lanuage.
     * @return int The number of comments deleted.
     */
    function DeleteLanguageQuestionComments($languageID)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'DELETE ' . QUESTIONCOMMENTS_IDENTIFIER . '.* FROM ' . LANGUAGES_IDENTIFIER . ' INNER JOIN'
                    . ' ' . QUESTIONS_IDENTIFIER . ' ON'
                    . ' ' . QUESTIONS_IDENTIFIER . '.' . LANGUAGEID_IDENTIFIER
                    . ' = ' . LANGUAGES_IDENTIFIER . '.' . LANGUAGEID_IDENTIFIER . ' INNER JOIN'
                    . ' ' . QUESTIONCOMMENTS_IDENTIFIER . ' ON'
                    . ' ' . QUESTIONCOMMENTS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER
                    . ' = ' . QUESTIONS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER . ' WHERE'
                    . ' ' . LANGUAGES_IDENTIFIER . '.' . LANGUAGEID_IDENTIFIER
                    . ' = :' . LANGUAGEID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . LANGUAGEID_IDENTIFIER, $languageID);
            
            $rowsDeleted = $statement->execute();
            
            $statement->closeCursor();
            
            return $rowsDeleted;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Deletes all comments on record for a question.
     * @param int $questionID The I.D. of the question.
     * @return int The number of comments deleted.
     */
    function DeleteQuestionComments($questionID)
    {
        try
        {
            $qc = new QuestionComment();
            $questionIdKey = $qc->GetQuestionIdKey();
            
            $db = GetDBConnection();
            
            $query = 'DELETE FROM ' . QUESTIONCOMMENTS_IDENTIFIER . ' WHERE'
                    . ' ' . $questionIdKey
                    . ' = :' . $questionIdKey . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $questionIdKey, $questionID);
            
            $rowsDeleted = $statement->execute();
            
            $statement->closeCursor();
            
            return $rowsDeleted;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Activates a language's feedback.
     * @param int $languageID The I.D. of the language.
     */
    function ActivateLanguageFeedback($languageID)
    {
        SetLanguageFeedbackState($languageID, TRUE);
    }
    
    /**
     * Deactivates a language's feedback.
     * @param int $languageID The I.D. of the language.
     */
    function DeactivateLanguageFeedback($languageID)
    {
        SetLanguageFeedbackState($languageID, FALSE);
    }
    
    /**
     * Sets the state of a languages feedback.
     * @param int $languageID The I.D. of the language.
     * @param boolean $feedback The flag that indicates whether or no the language is taking feedback.
     * @return int The number of languages that had their feedback state changed.
     */
    function SetLanguageFeedbackState($languageID, $feedback)
    {
        try
        {
            if ($feedback == TRUE)
            {
                $feedback = 1;
            }
            else
            {
                $feedback = 0;
            }
            
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . LANGUAGES_IDENTIFIER . ' SET'
                    . ' ' . 'Feedback'
                    . ' = :' . 'Feedback' . ' WHERE'
                    . ' ' . LANGUAGEID_IDENTIFIER
                    . ' = :' . LANGUAGEID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . LANGUAGEID_IDENTIFIER, $languageID);
            $statement->bindValue(':' . 'Feedback', $feedback);
            
            $rowsAffected = $statement->execute();
            
            $statement->closeCursor();
            
            return $rowsAffected;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Exports the statistics for a language into an excel sheet.
     * @param int $languageID The I.D. of the language.
     * @return string The file path of the excel sheet with the statistics.
     */
    function ExportLanguageStatistics($languageID)
    {
        try
        {
            $fileName = TEMP_DIR . 'langauge_statistics_' . date("m-d-Y-G-i-s") . '.xlsx';
            $language = GetLanguage($languageID);
            $languageName = $language[NAME_IDENTIFIER];
            $objPHPExcel = new PHPExcel();
                
            // Set properties
            $properties = $objPHPExcel->getProperties();
            $properties->setCreator("FLPExam site");
            $properties->setLastModifiedBy("FLPExam site");
            $properties->setTitle($languageName . " Exam Statistics");
            $properties->setSubject($languageName . " Exam Statistics");
            $properties->setDescription("Exam statistics for " . $languageName . ".");
            $properties->setKeywords("foreign language placement exam " . $languageName);
            $properties->setCategory("Exam Statistics");
            
            $workSheet = $objPHPExcel->setActiveSheetIndex(0);
            $workSheet->setTitle('Statistics');
            
            $row = 1;
            $column = 0;
            
            $workSheet->setCellValueByColumnAndRow($column++, $row, 'Question I.D.');
            $workSheet->setCellValueByColumnAndRow($column++, $row, 'Level');
            $workSheet->setCellValueByColumnAndRow($column++, $row, 'Question');
            $workSheet->setCellValueByColumnAndRow($column++, $row, 'Avg Score');
            $workSheet->setCellValueByColumnAndRow($column++, $row, 'Flag Count');
            
            $levels = GetAllLevels($languageID);
            
            foreach ($levels as $level)
            {
                $number = $level['Level'];
                
                $questions = GetQuestions($languageID, $number);
                
                foreach ($questions as $question)
                {
                    $row++;
                    $column = 0;

                    $questionID = $question[QUESTIONID_IDENTIFIER];
                    $level = $question['Level'];
                    $questionName = $question[NAME_IDENTIFIER];
                    $avgScore = GetQuestionAvgScore($questionID);
                    $flagCount = $question['Flagged'];

                    $workSheet->setCellValueByColumnAndRow($column++, $row, $questionID);
                    $workSheet->setCellValueByColumnAndRow($column++, $row, $level);
                    $workSheet->setCellValueByColumnAndRow($column++, $row, $questionName);
                    $workSheet->setCellValueByColumnAndRow($column++, $row, number_format($avgScore, 2));
                    $workSheet->setCellValueByColumnAndRow($column++, $row, $flagCount);
                }
                
                unset($questions);
                $questions = NULL;
            }
            
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
     * Adds the average score to each question.
     * @param array $questions The collection of questions.
     */
    function AppendQuestionAvgScores(&$questions)
    {
        for($i = 0; $i < count($questions); $i++)
        {
            $question = $questions[$i];
            $questionID = $question[QUESTIONID_IDENTIFIER];
            
            $avgScore = GetQuestionAvgScore($questionID);
            
            $question['AvgScore'] = $avgScore;
            $questions[$i] = $question;
        }
    }
    
    /**
     * Gets the average score of a question.
     * @param int $questionID The I.D. of a question.
     * @return float The percent score.
     */
    function GetQuestionAvgScore($questionID)
    {
        $avgScore = 100.0;
        $answers = GetQuestionAnswers($questionID);
        
        $totalCount = 0;
        $correctCount = 0;
        foreach($answers as $answer)
        {
            $count = (int)$answer['Chosen'];
            $totalCount = $totalCount + $count;
            
            if ((boolean)$answer['Correct'] == TRUE)
            {
                $correctCount = $count;
            }
        }
        
        if ($totalCount > 0)
        {
            $avgScore = ((float)$correctCount / (float)$totalCount) * 100.0;
        }
        
        return $avgScore;
    }
    
    /**
     * Resets the ambiguous question statistics for an entire language.
     * @param int $languageID The I.D. of the language.
     */
    function ResetLanguageQuestionsFlagCount($languageID)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . LANGUAGES_IDENTIFIER . ' INNER JOIN'
                    . ' ' . QUESTIONS_IDENTIFIER . ' ON'
                    . ' ' . QUESTIONS_IDENTIFIER . '.' . LANGUAGEID_IDENTIFIER
                    . ' = ' . LANGUAGES_IDENTIFIER . '.' . LANGUAGEID_IDENTIFIER . ' SET'
                    . ' ' . 'Flagged'
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
     * Resets the ambiguous questions statistics for a question.
     * @param int $questionID The I.D. of the question.
     */
    function ResetQuestionFlagCount($questionID)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . QUESTIONS_IDENTIFIER . ' SET'
                    . ' ' . 'Flagged'
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
     * Gets the questions and answers for a particular test.
     * @param int $testID The I.D. of the test.
     * @return array The collection of questions and answers.
     */
    function GetTestQAs($testID)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . TESTEEQUESTIONS_IDENTIFIER . ' WHERE'
                    . ' ' . TESTID_IDENTIFIER
                    . ' = :' . TESTID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . TESTID_IDENTIFIER, $testID);
            
            $statement->execute();
            
            $testQAs = $statement->fetchAll();
            
            $statement->closeCursor();
            
            for($i = 0; $i < count($testQAs); $i++)
            {
                $testQuestion = $testQAs[$i];
                
                $questionNo = $testQuestion['QuestionNo'];
                
                $questionAnswers = GetTestQuestionAnswers($testID, $questionNo);
                
                $testQuestion['Answers'] = $questionAnswers;
                
                $testQAs[$i] = $testQuestion;
            }
            
            return $testQAs;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets all the answers associated with a particular test's question. 
     * @param int $testID The I.D. of the test.
     * @param int $questionNo The I.D. of the question for that test.
     * @return array The collection of answers.
     */
    function GetTestQuestionAnswers($testID, $questionNo)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . TESTEEANSWERS_IDENTIFIER . ' WHERE'
                    . ' ' . TESTID_IDENTIFIER
                    . ' = :' . TESTID_IDENTIFIER . ' AND'
                    . ' ' . 'QuestionNo'
                    . ' = :' . 'QuestionNo' . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . TESTID_IDENTIFIER, $testID);
            $statement->bindValue(':' .'QuestionNo', $questionNo);
            
            $statement->execute();
            
            $questionAnswers = $statement->fetchAll();
            
            $statement->closeCursor();
            
            return $questionAnswers;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Deletes a test from the records.
     * @param int $testID The I.D. of the test.
     * @return int The number of test that were deleted.
     */
    function DeleteTestEntry($testID)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'DELETE FROM ' . TESTENTIRES_IDENTIFIER . ' WHERE'
                    . ' ' . TESTID_IDENTIFIER
                    . ' = :' . TESTID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . TESTID_IDENTIFIER, $testID);
            
            $rowsDeleted = $statement->execute();
            
            $statement->closeCursor();
            
            return $rowsDeleted;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Adds a language experience to the record of language experiences.
     * @param LanguageExperience $experience The language experience to add.
     * @return int The new I.D. of the language experience.
     */
    function AddLanguageExperience(LanguageExperience $experience)
    {
        try
        {
            $nameKey = $experience->GetNameKey();
            $descKey = $experience->GetDescriptionKey();
            
            $db = GetDBConnection();
            
            $query = 'INSERT INTO ' . LANGUAGEEXPERIENCES_IDENTIFIER
                    . ' (' . $nameKey
                    . ', ' . $descKey . ') VALUES'
                    . ' (:' . $nameKey
                    . ', :' . $descKey . ');';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $nameKey, $experience->GetName());
            $statement->bindValue(':' . $descKey, $experience->GetDescription());
            
            $statement->execute();
            
            $experienceID = $db->lastInsertId();
            
            $statement->closeCursor();
            
            return $experienceID;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Updates a language experience
     * @param LanguageExperience $experience The language experience to update.
     * @return int The number of rows effected by the update.
     */
    function UpdateLanguageExperience(LanguageExperience $experience)
    {
        try
        {
            $nameKey = $experience->GetNameKey();
            $descKey = $experience->GetDescriptionKey();
            
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . LANGUAGEEXPERIENCES_IDENTIFIER . ' SET'
                    . ' ' . $nameKey . ' = :' . $nameKey
                    . ', ' . $descKey . ' = :' . $descKey . ' WHERE'
                    . ' ' . LANGUAGEEXPERIENCEID_IDENTIFIER
                    . ' = :' . LANGUAGEEXPERIENCEID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $nameKey, $experience->GetName());
            $statement->bindValue(':' . $descKey, $experience->GetDescription());
            $statement->bindValue(':' . LANGUAGEEXPERIENCEID_IDENTIFIER, $experience->GetId());
            
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
     * Deletes the language experience from the records.
     * @param int $experienceID The I.D. of the language experience.
     * @return int The number of experiences deleted.
     */
    function DeleteLanguageExperience($experienceID)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'DELETE FROM ' . LANGUAGEEXPERIENCES_IDENTIFIER . ' WHERE'
                    . ' ' . LANGUAGEEXPERIENCEID_IDENTIFIER
                    . ' = :' . LANGUAGEEXPERIENCEID_IDENTIFIER;
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . LANGUAGEEXPERIENCEID_IDENTIFIER, $experienceID);
            
            $rowsDeleted = $statement->execute();
            
            $statement->closeCursor();
            
            return $rowsDeleted;
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
     * Resets the statistics for every question of a language.
     * @param int $languageID The I.D. of the language.
     */
    function ResetLanguageQuestionStatistics($languageID)
    {
        try
        {
            DeleteLanguageQuestionComments($languageID);
            ResetLanguageQuestionsFlagCount($languageID);
            
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . LANGUAGES_IDENTIFIER . ' INNER JOIN'
                    . ' ' . QUESTIONS_IDENTIFIER . ' ON'
                    . ' ' . QUESTIONS_IDENTIFIER . '.' . LANGUAGEID_IDENTIFIER
                    . ' = ' . LANGUAGES_IDENTIFIER  . '.' . LANGUAGEID_IDENTIFIER . ' INNER JOIN'
                    . ' ' . ANSWERS_IDENTIFIER . ' ON'
                    . ' ' . ANSWERS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER
                    . ' = ' . QUESTIONS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER . ' SET'
                    . ' ' . ANSWERS_IDENTIFIER . '.' . 'Chosen'
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
            DeleteQuestionComments($questionID);
            ResetQuestionFlagCount($questionID);
            
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . QUESTIONS_IDENTIFIER . ' INNER JOIN'
                    . ' ' . ANSWERS_IDENTIFIER . ' ON'
                    . ' ' . ANSWERS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER
                    . ' = ' . QUESTIONS_IDENTIFIER  . '.' . QUESTIONID_IDENTIFIER . ' SET'
                    . ' ' . ANSWERS_IDENTIFIER . '.' . 'Chosen'
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
            $fileName = TEMP_DIR . 'langauge_questions_' . date("m-d-Y-G-i-s") . '.xlsx';
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
            
            $row = 1;
            $column = 0;
            
            $workSheet->setCellValueByColumnAndRow($column++, $row, 'Question ID');
            $workSheet->setCellValueByColumnAndRow($column++, $row, 'Level');
            $workSheet->setCellValueByColumnAndRow($column++, $row, 'Instructions');
            $workSheet->setCellValueByColumnAndRow($column++, $row, 'Question');
            $workSheet->setCellValueByColumnAndRow($column++, $row, 'Correct Answer');
            
            $levels = GetAllLevels($languageID);
            
            foreach ($levels as $level)
            {
                $number = $level['Level'];
                
                $questions = GetQuestions($languageID, $number);

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
                
                unset($questions);
                $questions = NULL;
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
     * Gets the collectoin of experiences on record for a previous testee.
     * @param int $testID The I.D.
     * @return \LEOPair The collection LEOPairs.
     */
    function GetTesteeExperiences($testID)
    {
        try
        {
            $leopairs = array();
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . TESTEEEXPERIENCES_IDENTIFIER . ' WHERE'
                    . ' ' . TESTID_IDENTIFIER
                    . ' = :' . TESTID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . TESTID_IDENTIFIER, $testID);
            
            $statement->execute();
            
            $rows = $statement->fetchAll();
            
            foreach($rows as $row)
            {
                $leopair = new LEOPair();
                $leopair->Initialize($row);
                
                $leopairs[] = $leopair;
            }
            
            return $leopairs;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets a collection of basic test entries.
     * @param array $testIDs The collection of test I.D.s
     * @return mixed The collection of testentires, or FALSE if no test entries were retrived.
     */
    function GetBasicTestEntries($testIDs)
    {
        try
        {
            $testEntries = array();
            
            if (count($testIDs) > 0)
            {   
                $db = GetDBConnection();

                $query = 'SELECT * FROM ' . TESTENTIRES_IDENTIFIER . ' INNER JOIN'
                        . ' ' . TESTEES_IDENTIFIER . ' ON'
                        . ' ' . TESTEES_IDENTIFIER . '.' . TESTID_IDENTIFIER
                        . ' = ' . TESTENTIRES_IDENTIFIER . '.' . TESTID_IDENTIFIER . ' WHERE';
                
                for ($i = 0; $i < count($testIDs); $i++)
                {
                    $query .= ' ' . TESTEES_IDENTIFIER . '.' . TESTID_IDENTIFIER . ' = :' . TESTID_IDENTIFIER . $i . ' OR';
                }
                
                $query = rtrim($query, ' OR');

                $query .= ';';
                
                $statement = $db->prepare($query);
                
                $count = 0;
                foreach ($testIDs as $testID)
                {
                    $statement->bindValue(':' . TESTID_IDENTIFIER . $count, $testID);
                    $count++;
                }
                
                $statement->execute();
                
                $testEntries = $statement->fetchAll();
                
                $statement->closeCursor();
            }
            
            return $testEntries;
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
    function GetDetailedTestEntry($testID)
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
            $spokenAtHomeInitLevelIndex = $parameters->GetSpokenAtHomeInitLevelIndex();
            
            $query = 'UPDATE ' . EXAMPARAMETERS_IDENTIFIER . ' SET'
                    . ' ' . $keyCodeIndex . ' = :' . $keyCodeIndex
                    . ', ' . $questionCountIndex . ' = :' . $questionCountIndex
                    . ', ' . $incLevelScoreIndex . ' = :' . $incLevelScoreIndex
                    . ', ' . $spokenAtHomeInitLevelIndex . ' = :' . $spokenAtHomeInitLevelIndex
                    . ', ' . $decLevelScoreIndex . ' = :' . $decLevelScoreIndex . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . $keyCodeIndex, $parameters->GetKeyCode());
            $statement->bindValue(':' . $questionCountIndex, $parameters->GetQuestionCount());
            $statement->bindValue(':' . $incLevelScoreIndex, $parameters->GetIncLevelScore());
            $statement->bindValue(':' . $decLevelScoreIndex, $parameters->GetDecLevelScore());
            $statement->bindValue(':' . $spokenAtHomeInitLevelIndex, $parameters->GetSpokenAtHomeInitLevel());
            
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
     * Gets all the questions that have been flagged in a language.
     * @param int $languageID The I.D. of the language.
     * @return array The collection of flagged questions.
     */
    function SearchForFlaggedQuestions($languageID)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . QUESTIONS_IDENTIFIER . ' WHERE'
                    . ' ' . 'Flagged'
                    . ' > ' . '0' . ' AND'
                    . ' ' . LANGUAGEID_IDENTIFIER
                    . ' = :' . LANGUAGEID_IDENTIFIER . ' ORDER BY'
                    . ' ' . 'Flagged' . ' DESC';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . LANGUAGEID_IDENTIFIER, $languageID);
            
            $statement->execute();
            
            $flaggedQuestions = $statement->fetchAll();
            
            $statement->closeCursor();
            
            return $flaggedQuestions;
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
                    . QUESTIONS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER
                    . ' = :' . QUESTIONID_IDENTIFIER . ' OR'
                    . ' ' . QUESTIONS_IDENTIFIER . '.' . NAME_IDENTIFIER . ' LIKE'
                    . ' :' . NAME_IDENTIFIER . ' OR' 
                    . ' ' . 'Instructions' . ' LIKE'
                    . ' :' . NAME_IDENTIFIER . ' OR'
                    . ' ' . ANSWERS_IDENTIFIER . '.' . NAME_IDENTIFIER . ' LIKE'
                    . ' :' . NAME_IDENTIFIER . ') GROUP BY'
                    . ' '. QUESTIONS_IDENTIFIER . '.' . QUESTIONID_IDENTIFIER . ';';
            

            $statement = $db->prepare($query);
            $statement->bindValue(':' . LANGUAGEID_IDENTIFIER, $languageID);
            $statement->bindValue(':' . NAME_IDENTIFIER, '%' . $name . '%');
            $statement->bindValue(':' . QUESTIONID_IDENTIFIER, $name);
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
     * @param boolean $feedback Flag indicating whether or not feedback should be collected.
     * @return int The number of languages updated.
     */
    function UpdateLanguage($languageID, $name, $active, $feedback)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . LANGUAGES_IDENTIFIER . ' SET'
                    . ' ' . '`Name`'
                    . ' = :' . 'Name'
                    . ', ' . 'Feedback'
                    . ' = :' . 'Feedback'
                    . ', ' . 'Active'
                    . ' = :' . 'Active WHERE'
                    . ' ' . LANGUAGEID_IDENTIFIER
                    . ' = :' . LANGUAGEID_IDENTIFIER . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . LANGUAGEID_IDENTIFIER, $languageID);
            $statement->bindValue(':' . 'Name', $name);
            $statement->bindValue(':' . 'Feedback', $feedback);
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
     * Gets the distinct levels of a language.
     * @param int $languageID The I.D. of the language.
     * @return mixed The collection of distinct levels.
     */
    function GetAllLevels($languageID)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'SELECT Distinct(' . 'Level' . ') FROM ' . QUESTIONS_IDENTIFIER . ' WHERE'
                    . ' ' . LANGUAGEID_IDENTIFIER
                    . ' = :' . LANGUAGEID_IDENTIFIER;
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . LANGUAGEID_IDENTIFIER, $languageID);
            
            $statement->execute();
            
            $levels = $statement->fetchAll();
            
            $statement->closeCursor();
            
            if ($levels == FALSE)
            {
                $levels = array();
            }
            
            return $levels;
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
            DeleteQuestionComments($questionID);
            ResetQuestionFlagCount($questionID);
            
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
                    . ' ' . USERNAME_IDENTIFIER
                    . ' = :' . USERNAME_IDENTIFIER . ';';

            $statement = $db->prepare($query);
            $statement->bindValue(':'. USERNAME_IDENTIFIER, $userName);
            $statement->execute();
            $results = $statement->fetch();
            $statement->closeCursor();

            if ($results != FALSE)
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
            LogError($e);
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
            LogError($e);
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
            LogError($e);
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
    
    /**
     * Updates a user's password.
     * @param int $userID The I.D. of the user whose password to change.
     * @param string $password The new user password.
     * @return int The number of records affected.
     */
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
            LogError($e);
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
            LogError($e);
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
            
            $query = "SELECT RoleID, Name, Description, Vital FROM roles ORDER BY Name";
            
            $statement = $db->prepare($query);
            $statement->execute();
            
            $results = $statement->fetchAll();
            
            $statement->closeCursor();
            
            return $results;
        }
        catch (PDOException $e)
        {
            LogError($e);
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
            LogError($e);
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
            LogError($e);
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
            LogError($e);
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
    function SearchForTestEntry($name, $language, $minScore, $maxScore, $minDate, $maxDate)
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
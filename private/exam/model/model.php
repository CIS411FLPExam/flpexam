<?php

    //Need this because functions from this file will be called.
    require_once(GetModelFile());
    require_once(GetQuestionAnswerClassFile());
    require_once(GetExperienceOptionClassFile());
    
    /**
     * Gets all language experiences with their options.
     * @return array The collection of  language experiences.
     */
    function GetAllLanguageExperiencesWithOptions()
    {
        $expOptions = array();
        $experiences = GetAllLanguageExperiences();
        $options = GetAllExperienceOptions();
        
        foreach($experiences as $experience)
        {
            $expID = $experience->GetId();
            $expOptions["$expID"] = $experience;
        }
        
        foreach($options as $option)
        {
            $expID = $option->GetExperienceId();
            $exp = $expOptions["$expID"];
            
            $exp->AddOption($option);
            
            $expOptions["$expID"] = $exp;
        }
        
        return $expOptions;
    }
    
    /**
     * Gets all possible experience options.
     * @return ExperienceOption A collection of experience options.
     */
    function GetAllExperienceOptions()
    {
        try
        {
            $options = array();
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM '  . GetExperinceOptionsIdentifier()
                    . ' ORDER BY ' . GetExperienceOptionIdIdentifier() . ';';
            
            $statement = $db->prepare($query);
            
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
     * Records the comments for a question.
     * @param array $questionComments The collection of question comments.
     */
    function RecordQuestionComments($questionComments)
    {
        try
        {
            if (count($questionComments) < 1)
            {
                return;
            }
            
            $quesCom = new QuestionComment();
            $questionIdKey= $quesCom->GetQuestionIdKey();
            $commentKey = $quesCom->GetCommentKey();
            
            $db = GetDBConnection();
            
            $query = 'INSERT INTO ' . GetQuestionCommentsIdentifier()
                    . ' (' . $questionIdKey
                    . ', ' . $commentKey . ') VALUES'
                    . ' (:' . $questionIdKey . '0'
                    . ', :' . $commentKey . '0' . ')';
            
            for ($i = 1; $i < count($questionComments); $i++)
            {
                $query .= ', (:' . $questionIdKey . $i
                        . ', :' . $commentKey . $i . ')';
            }
            
            $query .= ';';
            
            $statement = $db->prepare($query);
            
            for ($i = 0; $i < count($questionComments); $i++)
            {
                $qc = $questionComments[$i];
                
                $statement->bindValue(':' . $questionIdKey . $i, $qc->GetQuestionId());
                $statement->bindvalue(':' . $commentKey . $i, $qc->GetComment());
            }
            
            $statement->execute();
            
            $statement->closeCursor();
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gest the email header for sending exam results.
     * @param string $language The name of the language.
     * @return array The header info for the email. 
     */
    function GetExamResultsEmailHeader($language = 'Foreign Language')
    {
        $headers = array ( );
        $headers['From'] = 'FLP Exam <flpexam@gmail.com>';
        $headers['Subject'] = $language . ' Exam Results';
        $headers['Content-type'] = 'text/plain';

        return $headers;
    }
    
    /**
     * Records that the collection of questions have been flagged.
     * @param array $questionIDs The collection of question I.D.'s.
     */
    function IncrementQuestionFlagCounts($questionIDs)
    {
        try
        {
            if (count($questionIDs) < 1)
            {
                return;
            }
            
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . GetQuestionsIdentifier() . ' SET'
                    . ' ' . 'Flagged'
                    . ' = '. 'Flagged' . ' + 1' . ' WHERE'
                    . ' ' . GetQuestionIdIdentifier()
                    . ' = :' . GetQuestionIdIdentifier() . '0';
            
            for($count = 1; $count < count($questionIDs); $count++)
            {
                $query .= ' OR ' . GetQuestionIdIdentifier() . ' = :' . GetQuestionIdIdentifier() . $count;
            }
            
            $query .= ';';
            
            $statement = $db->prepare($query);
            
            for($count = 0; $count < count($questionIDs); $count++)
            {
                $questionID = $questionIDs[$count];
                $statement->bindValue(':' . GetQuestionIdIdentifier() . $count, $questionID);
            }
            
            $statement->execute();
            
            $statement->closeCursor();
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Indicates whether or not the given level exists.
     * @param int $languageID The I.D. of the language.
     * @param int $level The level of the questions.
     * @return boolean True, if the level exists.
     */
    function LevelExists($languageID, $level)
    {
        try
        {
            $levelExists = FALSE;
            $db = GetDBConnection();
            
            $query = 'SELECT ' . GetQuestionIdIdentifier() . ' FROM'
                    . ' ' . GetQuestionsIdentifier() . ' WHERE'
                    . ' ' . GetLanguageIdIdentifier()
                    . ' = :' . GetLanguageIdIdentifier() . ' AND'
                    . ' ' . 'Level'
                    . ' = :' . 'Level' . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . GetLanguageIdIdentifier(), $languageID);
            $statement->bindValue(':' . 'Level', $level);
            
            $statement->execute();
            
            $rows = $statement->fetchAll();
            
            $statement->closeCursor();
            
            if ($rows != FALSE && count($rows) > 0)
            {
                $levelExists = TRUE;
            }
            
            return $levelExists;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets the intial level that corresponds to the given language experiences.
     * @param string $languageExperience The name of the experience.
     * @return int The intitial level.
     */
    function GetLanguageExperienceInitLevel($experienceName, $optionName)
    {
        try
        {
            $initLevel = 1;
            $db = GetDBConnection();
            
            $query = 'SELECT InitLevel FROM ' . GetLanguageExperiencesIdentifier() . ' INNER JOIN'
                    . ' ' . GetExperinceOptionsIdentifier() . ' ON'
                    . ' ' . GetExperinceOptionsIdentifier() . '.' . GetLanguageExperienceIdIdentifier()
                    . ' = ' . GetLanguageExperiencesIdentifier() . '.' . GetLanguageExperienceIdIdentifier() . ' WHERE'
                    . ' ' . GetLanguageExperiencesIdentifier() . '.' . GetNameIdentifier()
                    . ' = :' . 'ExperienceName' . ' AND'
                    . ' ' . GetExperinceOptionsIdentifier() . '.' . GetNameIdentifier()
                    . ' = :' . 'OptionName' . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . 'ExperienceName', $experienceName);
            $statement->bindValue(':' . 'OptionName', $optionName);
            
            $statement->execute();
            
            $row = $statement->fetch();
            
            $statement->closeCursor();
            
            if ($row != FALSE)
            {
                $initLevel = (int)$row[0];
            }
            
            return $initLevel;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Records that a collection of answers have been chosen.
     * @param array $answerIDs The I.D. of the answer that was submitted.
     */
    function IncrementAnswerChosenCounts($answerIDs)
    {
        try
        {
            if (count($answerIDs) < 1)
            {
                return;
            }
            
            $db = GetDBConnection();
            
            $query = 'UPDATE ' . GetAnswersIdentifier() . ' SET'
                    . ' ' . 'Chosen'
                    . ' = '. 'Chosen' . ' + 1' . ' WHERE'
                    . ' ' . GetAnswerIdIdentifier()
                    . ' = :' . GetAnswerIdIdentifier() . '0';
            
            for($count = 1; $count < count($answerIDs); $count++)
            {
                $query .= ' OR ' . GetAnswerIdIdentifier() . ' = :' . GetAnswerIdIdentifier() . $count;
            }
            
            $query .= ';';
            
            $statement = $db->prepare($query);
            
            for($count = 0; $count < count($answerIDs); $count++)
            {
                $answerID = $answerIDs[$count];
                $statement->bindValue(':' . GetAnswerIdIdentifier() . $count, $answerID);
            }
            
            $statement->execute();
            
            $statement->closeCursor();
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets the test results for a test.
     * @param int $testID The I.D. of the test.
     * @return mixed The array of test info, or FALSE otherwise.
     */
    function GetTestResults($testID)
    {
        try
        {
            $db = GetDBConnection();
            
            $query = 'SELECT * FROM ' . GetTestEntriesIdentifier() . ' WHERE'
                    . ' ' . GetTestIdIdentifier()
                    . ' = :' . GetTestIdIdentifier() . ';';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . GetTestIdIdentifier(), $testID);
            
            $statement->execute();
            
            $row = $statement->fetch();
            
            $statement->closeCursor();
            
            return $row;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Indicates whether or not an answer is the correct answer.
     * @param int $questionID The I.D. of the question.
     * @param int $answerID The I.D. of the answer.
     * @return boolean True, if the answer is the correct answer.
     */
    function IsAnswerCorrect($questionID, $answerID)
    {
        try
        {
            $correctAnswer = FALSE;
            $db = GetDBConnection();
            
            $query = 'SELECT ' . GetAnswerIdIdentifier() . ' FROM'
                    . ' ' . GetAnswersIdentifier() . ' WHERE'
                    . ' ' . GetQuestionIdIdentifier()
                    . ' = :' . GetQuestionIdIdentifier() . ' AND'
                    . ' ' . GetAnswerIdIdentifier()
                    . ' = :' . GetAnswerIdIdentifier() . ' AND'
                    . ' ' . 'Correct'
                    . ' = :' . 'Correct';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':'. GetQuestionIdIdentifier(), $questionID);
            $statement->bindValue(':' . GetAnswerIdIdentifier(), $answerID);
            $statement->bindValue(':' . 'Correct', 1);
            
            $statement->execute();
            
            $answerIDs = $statement->fetchAll();
            
            $statement->closeCursor();
            
            if (count($answerIDs) > 0)
            {
                $correctAnswer = TRUE;
            }
            
            return $correctAnswer;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Gets a random collection of question I.D.'s.
     * @param int $languageID The I.D. of the language to get the questions from.
     * @param int $level The level of the questions to get.
     * @param int $limit The maximum number of question I.D.'s to return.
     * @param array $idsToExclude A collection of question I.D.'s to exclude.
     * @return array The collection of question I.D.'s that were retrieved.
     */
    function GetRandomQuestionIDs($languageID, $level, $limit, $idsToExclude)
    {
        try
        {
            $questionIDs = array();
            $db = GetDBConnection();
            
            $query = 'SELECT ' . GetQuestionIdIdentifier() . ' FROM'
                    . ' ' . GetQuestionsIdentifier() . ' WHERE';
            
            if (count($idsToExclude) > 0)
            {
                $query .= ' ' . GetQuestionIdIdentifier() . ' NOT IN (';
                
                $query .= ':' . GetQuestionIdIdentifier() . 0;
                
                for ($index = 1; $index < count($idsToExclude); $index++)
                {
                    $query .= ', :' . GetQuestionIdIdentifier() . $index;
                }
                
                $query .= ') AND';
            }
            
            $query .= ' ' . GetLanguageIdIdentifier()
                    . ' = :' . GetLanguageIdIdentifier() . ' AND'
                    . ' ' . 'Level'
                    . ' = :' . 'Level' . ' ORDER BY RAND() LIMIT'
                    . ' :' . 'Limit' ;
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . GetLanguageIdIdentifier(), (int)$languageID, PDO::PARAM_INT);
            $statement->bindValue(':' . 'Level', (int)$level, PDO::PARAM_INT);
            $statement->bindValue(':' . 'Limit', (int)$limit, PDO::PARAM_INT);
            
            for ($index = 0; $index < count($idsToExclude); $index++)
            {
                $statement->bindValue(':' . GetQuestionIdIdentifier() . $index, (int)$idsToExclude[$index], PDO::PARAM_INT);
            }
            
            $statement->execute();
            
            $questions = $statement->fetchAll();
            
            $statement->closeCursor();
            
            foreach ($questions as $question)
            {
                $questionIDs[] = $question[GetQuestionIdIdentifier()];
            }
            
            return $questionIDs;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Store the I.D. of the committed test.
     * @param int $testID The I.D. of the test.
     */
    function StoreTestId($testID)
    {
        StartSession();
        
        $_SESSION[GetTestIdIdentifier()] = $testID;
    }
    
    /**
     * Gets the I.D. of the committed test.
     * @return mixed The I.D. of the comitted, or FALSE other if no I.D. is set.
     */
    function GetTestId()
    {
        if (isset($_SESSION[GetTestIdIdentifier()]))
        {
            return $_SESSION[GetTestIdIdentifier()];
        }
        
        return FALSE;
    }
    
    /**
     * Gets the current exam.
     * @return Exam The current exam or FALSE if the current exam is not set.
     */
    function GetCurrentExam()
    {
        if(isset($_SESSION[GetExamIdentifier()]))
        {
            return $_SESSION[GetExamIdentifier()];
        }
        
        return FALSE;
    }
    
    /*
     * Sets the current exam.
     */
    function SetCurrentExam($exam)
    {
        StartSession();
        $_SESSION[GetExamIdentifier()] = $exam;
    }
    
    /**
     * Destroys the current exam information.
     */
    function DisposeCurrentExam()
    {
        if(isset($_SESSION[GetExamIdentifier()]))
        {
            unset($_SESSION[GetExamIdentifier()]);
        }
    }

    /**
     * Attemps to clear a user to take the exam.
     * @param string $keycode The key code of the exam.
     * @return boolean True, if the user is cleared.
     */
    function ClearUser($keycode)
    {
        $cleared = FALSE;
        $examParams = GetExamParameters();
        
        if($keycode == $examParams->GetKeyCode())
        {
            $exam = new Exam($examParams);
            SetCurrentExam($exam);
            $cleared = TRUE;
        }
        
        return $cleared;
    }
    
    /**
     * Indicates whether or not the user has entered a valid key code.
     * @return boolean True, if the user has entered the key code.
     */
    function UserIsClear()
    {
        StartSession();
        $isClear = isset($_SESSION[GetExamIdentifier()]);
        
        return $isClear;
    }
    
    /**
     * Adds a testee's questions and answers to the records.
     * @param int $testEntryID The I.D. of the test entry.
     * @param array $examQAs The collection of QuestionAnswers.
     */
    function AddTesteeQuestions($testEntryID, $examQAs)
    {
        try
        {
            if (count($examQAs) < 1)
            {
                return;
            }
            
            $db = GetDBConnection();
            
            $qCount = 1;
            $questions = array();
            foreach ($examQAs as $qa)
            {
                $questionID = $qa->GetQuestionId();
                $question = GetQuestion($questionID);
                
                if ($question != FALSE)
                {
                    $aCount = 1;
                    $answers = GetQuestionAnswers($questionID);
                    
                    for ($i = 0; $i < count($answers); $i++)
                    {
                        $chosen = '0';
                        $answer = $answers[$i];
                        $answer['AnswerNo'] = $aCount;
                        
                        if ($answer[GetAnswerIdIdentifier()] == $qa->GetAnswerId())
                        {
                            $chosen = '1';
                        }
                        
                        $answer['Chosen'] = $chosen;
                        
                        $answers[$i] = $answer;
                        
                        $aCount++;
                    }
                    
                    $question['QuestionNo'] = $qCount;
                    $question['Answers'] = $answers;
                    
                    $questions[] = $question;
                    
                    $qCount++;
                }
            }
            
            $qQuery = 'INSERT INTO ' . GetTesteeQuestionsIdentifier()
                            . ' (' . GetTestIdIdentifier()
                            . ', ' . 'QuestionNo'
                            . ', ' . 'Level'
                            . ', ' . 'Instructions'
                            . ', ' . 'Question' . ') VALUES';
            
            $aQuery = 'INSERT INTO ' . GetTesteeAnswersIdentifier()
                                . ' (' . GetTestIdIdentifier()
                                . ', ' . 'QuestionNo'
                                . ', ' . 'AnswerNo'
                                . ', ' . 'Answer'
                                . ', ' . 'Correct'
                                . ', ' . 'Chosen' . ') VALUES';
            
            foreach($questions as $question)
            {
                $answers = $question['Answers'];
                $questionNo = $question['QuestionNo'];
                
                $qQuery .= ' (:' . GetTestIdIdentifier()
                        . ', :' . 'QuestionNo' . $questionNo
                        . ', :' . 'Level' . $questionNo
                        . ', :' . 'Instructions' . $questionNo
                        . ', :' . 'Question' . $questionNo . '),';
                
                foreach($answers as $answer)
                {
                    $answerNo = $answer['AnswerNo'];
                    
                    $aQuery .= ' (:' . GetTestIdIdentifier()
                                . ', :' . 'QuestionNo' . $questionNo . $answerNo
                                . ', :' . 'AnswerNo' . $questionNo . $answerNo
                                . ', :' . 'Answer' . $questionNo . $answerNo
                                . ', :' . 'Correct' . $questionNo . $answerNo
                                . ', :' . 'Chosen' . $questionNo . $answerNo . '),';
                }
            }
            
            $qQuery = rtrim($qQuery, ',') . ';';
            $aQuery = rtrim($aQuery, ',') . ';';
            
            $qStatement = $db->prepare($qQuery);
            $aStatement = $db->prepare($aQuery);
            
            foreach($questions as $question)
            {
                $answers = $question['Answers'];
                $questionNo = $question['QuestionNo'];
                
                foreach($answers as $answer)
                {
                    $answerNo = $answer['AnswerNo'];
                    
                    $aStatement->bindValue(':' . GetTestIdIdentifier(), $testEntryID);
                    $aStatement->bindValue(':' . 'QuestionNo' . $questionNo . $answerNo, $questionNo);
                    $aStatement->bindValue(':' . 'AnswerNo' . $questionNo . $answerNo, $answerNo);
                    $aStatement->bindValue(':' . 'Answer' . $questionNo . $answerNo, $answer[GetNameIdentifier()]);
                    $aStatement->bindValue(':' . 'Chosen' . $questionNo . $answerNo, $answer['Chosen']);
                    $aStatement->bindValue(':' . 'Correct' . $questionNo . $answerNo, $answer['Correct']);
                }
                
                $qStatement->bindValue(':' . GetTestIdIdentifier(), $testEntryID);
                $qStatement->bindValue(':' . 'QuestionNo' . $questionNo, $questionNo);
                $qStatement->bindValue(':' . 'Level' . $questionNo, $question['Level']);
                $qStatement->bindValue(':' . 'Instructions' . $questionNo, $question['Instructions']);
                $qStatement->bindValue(':' . 'Question' . $questionNo, $question[GetNameIdentifier()]);
            }
            
            $qStatement->execute();
            $qStatement->closeCursor();
            
            $aStatement->execute();
            $aStatement->closeCursor();
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Adds a test entry to the records.
     * @param Exam $exam The exam to add.
     * @return int The I.D. of the newly added test entry.
     */
    function AddTestEntry(Exam $exam)
    {
        try
        {
            $score = $exam->GetLevel();
            $languageName = $exam->GetLanguage()->GetName();
            
            $db = GetDBConnection();
            
            $query = 'INSERT INTO ' . GetTestEntriesIdentifier()
                    . ' (' . 'Language'
                    . ', ' . '`Date`'
                    . ', ' . 'Score' . ') VALUES'
                    . ' (:' . 'Language'
                    . ' , ' . 'NOW()'
                    . ', :' . 'Score' . ');';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . 'Language', $languageName);
            $statement->bindValue(':' . 'Score', $score);
            
            
            $statement->execute();
            
            $testentryID = $db->lastInsertId();
            
            $statement->closeCursor();
            
            return $testentryID;
        }
        catch (PDException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Adds a testee to the records.
     * @param int $testentryID The I.D. of the test entry.
     * @param Profile $profile The profile of the testee.
     */
    function AddTestee($testentryID, Profile $profile)
    {
        try
        {
            $firstNameIndex = $profile->GetFirstNameIndex();
            $lastNameIndex = $profile->GetLastNameIndex();
            $emailIndex = $profile->GetEmailIndex();
            $majorIndex = $profile->GetMajorIndex();
            $highSchoolIndex = $profile->GetHighSchoolIndex();
            $spokenAtHomeIndex = $profile->GetSpokenAtHomeIndex();
            
            $db = GetDBConnection();
            
            $query = 'INSERT INTO ' . GetTesteesIdentifier()
                    . ' ('  . GetTestIdIdentifier()
                    . ', ' . $spokenAtHomeIndex
                    . ', ' . $firstNameIndex
                    . ', ' . $lastNameIndex
                    . ', ' . $emailIndex
                    . ', ' . $majorIndex
                    . ', ' . $highSchoolIndex . ') VALUES'
                    . ' (:' . GetTestIdIdentifier()
                    . ', :' . $spokenAtHomeIndex
                    . ', :' . $firstNameIndex
                    . ', :' . $lastNameIndex
                    . ', :' . $emailIndex
                    . ', :' . $majorIndex
                    . ', :' . $highSchoolIndex . ');';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . GetTestIdIdentifier(), $testentryID);
            $statement->bindValue(':' . $spokenAtHomeIndex, $profile->GetSpokenAtHome());
            $statement->bindValue(':' . $firstNameIndex, $profile->GetFirstName());
            $statement->bindValue(':' . $lastNameIndex, $profile->GetLastName());
            $statement->bindValue(':' . $emailIndex, $profile->GetEmail());
            $statement->bindValue(':' . $majorIndex, $profile->GetMajor());
            $statement->bindValue(':' . $highSchoolIndex, $profile->GetHighSchool());
            
            $statement->execute();
            
            $statement->closeCursor();
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    /**
     * Adds a testee's expereiences to the records.
     * @param int $testeeID The I.D. of the testee.
     * @param Profile $profile The testee's profile.
     */
    function AddTesteeExperiences($testeeID, Profile $profile)
    {
        try
        {
            $leoP = new LEOPair();
            $experienceNameKey = $leoP->GetExperienceNameKey();
            $optionNameKey = $leoP->GetOptionNameKey();
            
            $leopairs = $profile->GetLeoPairs();
            
            if (count($leopairs) < 1)
            {
                return;
            }
            
            $db = GetDBConnection();
            
            $query = 'INSERT INTO ' . GetTesteeExperiencesIdentifier()
                    . ' ('  . GetTestIdIdentifier()
                    . ', ' . $experienceNameKey
                    . ', ' . $optionNameKey . ') VALUES';
            
            for ($i = 0; $i < count($leopairs); $i++)
            {
                $query .= ' (:' . GetTestIdIdentifier()
                        . ', :' . $experienceNameKey . $i
                        . ', :' . $optionNameKey . $i . '),';
            }
            
            $query = rtrim($query, ',') . ';';
            
            $statement = $db->prepare($query);
            
            $statement->bindValue(':' . GetTestIdIdentifier(), $testeeID);
            
            $count = 0;
            foreach($leopairs as $leopair)
            {
                $statement->bindValue(':' . $experienceNameKey . $count, $leopair->GetExperienceName());
                $statement->bindValue(':' . $optionNameKey . $count, $leopair->GetOptionName());
                
                $count++;
            }
            
            $statement->execute();
            
            $statement->closeCursor();
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
?>
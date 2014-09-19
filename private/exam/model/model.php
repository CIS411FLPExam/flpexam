<?php

    //Need this because functions from this file will be called.
    require_once(MODEL_FILE);
    
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
            
            $query = 'SELECT ' . ANSWERID_IDENTIFIER . ' FROM'
                    . ' ' . ANSWERS_IDENTIFIER . ' WHERE'
                    . ' ' . QUESTIONID_IDENTIFIER
                    . ' = :' . QUESTIONID_IDENTIFIER . ' AND'
                    . ' ' . ANSWERID_IDENTIFIER
                    . ' = :' . ANSWERID_IDENTIFIER . ' AND'
                    . ' ' . 'Correct'
                    . ' = :' . 'Correct';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':'. QUESTIONID_IDENTIFIER, $questionID);
            $statement->bindValue(':' . ANSWERID_IDENTIFIER, $answerID);
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
            
            $query = 'SELECT ' . QUESTIONID_IDENTIFIER . ' FROM'
                    . ' ' . QUESTIONS_IDENTIFIER . ' WHERE';
            
            if (count($idsToExclude) > 0)
            {
                $query .= ' ' . QUESTIONID_IDENTIFIER . ' NOT IN (';
                
                $query .= ':' . QUESTIONID_IDENTIFIER . 0;
                
                for ($index = 1; $index < count($idsToExclude); $index++)
                {
                    $query .= ', :' . QUESTIONID_IDENTIFIER . $index;
                }
                
                $query .= ') AND';
            }
            
            $query .= ' ' . LANGUAGEID_IDENTIFIER
                    . ' = :' . LANGUAGEID_IDENTIFIER . ' AND'
                    . ' ' . 'Level'
                    . ' = :' . 'Level' . ' ORDER BY RAND() LIMIT'
                    . ' :' . 'Limit' ;
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . LANGUAGEID_IDENTIFIER, (int)$languageID, PDO::PARAM_INT);
            $statement->bindValue(':' . 'Level', (int)$level, PDO::PARAM_INT);
            $statement->bindValue(':' . 'Limit', (int)$limit, PDO::PARAM_INT);
            
            for ($index = 0; $index < count($idsToExclude); $index++)
            {
                $statement->bindValue(':' . QUESTIONID_IDENTIFIER . $index, (int)$idsToExclude[$index], PDO::PARAM_INT);
            }
            
            $statement->execute();
            
            $questions = $statement->fetchAll();
            
            $statement->closeCursor();
            
            foreach ($questions as $question)
            {
                $questionIDs[] = $question[QUESTIONID_IDENTIFIER];
            }
            
            return $questionIDs;
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
    
    
    /**
     * Gets the current exam.
     * @return Exam The current exam or FALSE if the current exam is not set.
     */
    function GetCurrentExam()
    {
        if(isset($_SESSION[EXAM_IDENTIFIER]))
        {
            return $_SESSION[EXAM_IDENTIFIER];
        }
        
        return FALSE;
    }
    
    /*
     * Sets the current exam.
     */
    function SetCurrentExam($exam)
    {
        StartSession();
        $_SESSION[EXAM_IDENTIFIER] = $exam;
    }
    
    /**
     * Destroys the current exam information.
     */
    function DisposeCurrentExam()
    {
        if(isset($_SESSION[EXAM_IDENTIFIER]))
        {
            unset($_SESSION[EXAM_IDENTIFIER]);
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
        $isClear = isset($_SESSION[EXAM_IDENTIFIER]);
        
        return $isClear;
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
            
            $query = 'INSERT INTO ' . TESTENTIRES_IDENTIFIER
                    . ' (' . 'Language'
                    . ', ' . 'Score' . ') VALUES'
                    . ' (:' . 'Language'
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
            
            $db = GetDBConnection();
            
            $query = 'INSERT INTO ' . TESTEES_IDENTIFIER
                    . ' ('  . TESTID_IDENTIFIER
                    . ', ' . $firstNameIndex
                    . ', ' . $lastNameIndex
                    . ', ' . $emailIndex
                    . ', ' . $majorIndex
                    . ', ' . $highSchoolIndex . ') VALUES'
                    . ' (:' . TESTID_IDENTIFIER
                    . ', :' . $firstNameIndex
                    . ', :' . $lastNameIndex
                    . ', :' . $emailIndex
                    . ', :' . $majorIndex
                    . ', :' . $highSchoolIndex . ');';
            
            $statement = $db->prepare($query);
            $statement->bindValue(':' . TESTID_IDENTIFIER, $testentryID);
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
            $spokenAtHomeIndex = $profile->GetSpokenAtHomeIndex();
            $jrHighExpIndex = $profile->GetJrHighExpIndex();
            $srHighExpIndex = $profile->GetSrHighExpIndex();
            $collegeExpIndex = $profile->GetCollegeExpIndex();
            
            $db = GetDBConnection();
            
            $query = 'INSERT INTO ' . TESTEEEXPERIENCES_IDENTIFIER
                    . ' ('  . TESTID_IDENTIFIER
                    . ', ' . $spokenAtHomeIndex
                    . ', ' . $jrHighExpIndex
                    . ', ' . $srHighExpIndex
                    . ', ' . $collegeExpIndex . ') VALUES'
                    . ' (:' . TESTID_IDENTIFIER
                    . ', :' . $spokenAtHomeIndex
                    . ', :' . $jrHighExpIndex
                    . ', :' . $srHighExpIndex
                    . ', :' . $collegeExpIndex . ');';
            
            
            $statement = $db->prepare($query);
            
            $statement->bindValue(':' . TESTID_IDENTIFIER, $testeeID);
            $statement->bindValue(':' . $spokenAtHomeIndex, $profile->GetSpokenAtHome());
            $statement->bindValue(':' . $jrHighExpIndex, $profile->GetJrHighExp());
            $statement->bindValue(':' . $srHighExpIndex, $profile->GetSrHighExp());
            $statement->bindValue(':' . $collegeExpIndex, $profile->GetCollegeExp());
            
            $statement->execute();
            
            $statement->closeCursor();
        }
        catch (PDOException $ex)
        {
            LogError($ex);
        }
    }
?>
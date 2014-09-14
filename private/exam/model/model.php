<?php

    //Need this because functions from this file will be called.
    require_once(MODEL_FILE);
    
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
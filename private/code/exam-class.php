<?php

/**
 * The exam class.
 */
class Exam
{
    /**
     * The flag that indicates whether or not the test has been started.
     * @var boolean 
     */
    private $started;
    
    /**
     * The current level that the user is on.
     * @var int 
     */
    private $level;
    
    
    /**
     * The previous level that the user was on.
     * @var int
     */
    private $prevLevel;
    
    /**
     * The user's information profile.
     * @var Profile 
     */
    private $profile;
    
    /**
     * The language that the user's is taking the exam for.
     * @var Language 
     */
    private $language;
    
    /**
     * The exam parameters to use to administer the test.
     * @var ExamParameters
     */
    private $parameters;
    
    /**
     * The questions and answers for the current level.
     * @var array of QuestionAnswer
     */
    private $lvlQAs;
    
    /**
     * The questions and answers for the entire exam.
     * @var array of QuestionAnswer 
     */
    private $allQAs;
    
    /**
     * The collection of questions that were flagged.
     * @var array of question I.D.'s
     */
    private $flaggedQuestions;
    
    /**
     * Gets the flag that indicates whether or not the exam has been started.
     * @return boolean The flag that indicates whether or not the exam has been started.
     */
    protected function GetStarted()
    {
        return $this->started;
    }
    
    /**
     * Sets the flag that indicates whether or not the exam has been started.
     * @param boolean $started The flag that indicates whether or not the exam has been started.
     */
    protected function SetStarted($started)
    {
        $this->started = $started;
    }

    /**
     * Gets the current level of the exam.
     * @return int The level.
     */
    public function GetLevel()
    {
        return $this->level;
    }
    
    /**
     * Sets the current level of the exam.
     * @param int $level The level.
     */
    public function SetLevel($level)
    {
        $this->level = $level;
    }
    
    /**
     * Gets the level that the user was previously on.
     * @return int The user's previous level.
     */
    public function GetPrevLevel()
    {
        return $this->prevLevel;
    }
    
    /**
     * Sets the level that the user was previously on.
     * @param int $prevLevel The user's previous level.
     */
    public function SetPrevLevel($prevLevel)
    {
        $this->prevLevel = $prevLevel;
    }
    
    /**
     * Gets the profile of the user who is taking this exam.
     * @return Profile The profile.
     */
    public function GetProfile()
    {
        return $this->profile;
    }
    
    /**
     * Sets the profile of the user who is taking this exam.
     * @param Profile $profile The profile.
     */
    public function SetProfile($profile)
    {
        $this->profile = $profile;
    }
    
    /**
     * Gets the language of the exam.
     * @return Language The language.
     */
    public function GetLanguage()
    {
        return $this->language;
    }
    
    /**
     * Sets the language of the exam.
     * @param Language $language The language.
     */
    public function SetLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * Gets the exam paramaters.
     * @return ExamParameters The parameters
     */
    public function GetParameters()
    {
        return $this->parameters;
    }
    
    /**
     * Sets the exam parameters.
     * @param ExamParameters $parameters The parameters.
     */
    public function SetParameters($parameters)
    {
        $this->parameters = $parameters;
    }
    
    /**
     * Gets the collection of questions and answers for the current level.
     * @return array The collection of questions and answers.
     */
    public function GetLvlQAs()
    {
        return $this->lvlQAs;
    }
    
    /**
     * Sets the collection of questions and answers for the current level.
     * @param array $lvlQAs The collection of questions and answers.
     */
    public function SetLvlQAs($lvlQAs)
    {
        $this->lvlQAs = $lvlQAs;
    }
    
    /**
     * Gets the collection of questions and answers for the entire exam.
     * @return array The collection of questions and answers.
     */
    public function GetAllQAs()
    {
        return $this->allQAs;
    }
    
    /**
     * Sets the collection of questions and answers for the entire exam.
     * @param array $allQAs The collection of questions and answers.
     */
    public function SetAllQAs($allQAs)
    {
        $this->allQAs = $allQAs;
    }
    
    /**
     * Gets the collection of flagged questions.
     * @return array The collection of question I.D.'s.
     */
    public function GetFlaggedQuestions()
    {
        return $this->flaggedQuestions;
    }
    
    /**
     * Sets the collection of flagged questions.
     * @param array $flaggedQuestions The collection of question I.D.'s.
     */
    public function SetFlaggedQuestions($flaggedQuestions)
    {
        $this->flaggedQuestions = $flaggedQuestions;
    }
    
    /**
     * Creates an instance of an exam.
     * @param ExamParameters $parameters The paramaters.
     * @param Language $language The language.
     * @param Profile $profile The profile.
     */
    public function Exam(ExamParameters $parameters = NULL, Language $language = NULL, Profile $profile = NULL)
    {
        $this->SetStarted(FALSE);
        $this->SetLevel(1);
        $this->SetPrevLevel(1);
        $this->SetParameters($parameters);
        $this->SetLanguage($language);
        $this->SetProfile($profile);
        $this->SetLvlQAs(array());
        $this->SetAllQAs(array());
        $this->SetFlaggedQuestions(array());
    }
    
    /**
     * Indicates whether or not the test has been started.
     * @return boolean True, if the test has been started.
     */
    public function IsStarted()
    {
        $started = $this->GetStarted();
        
        return $started;
    }
    
    /**
     * Indicates whether or not the exam parameters have been set.
     * @return boolean True, if the exam parameters have been set.
     */
    public function IsParametersSet()
    {
        $parameters = $this->GetParameters();
        
        $isSet = !is_null($parameters);
        
        return $isSet;
    }
    
    /**
     * Indicates whether or not the language for the exam has been set.
     * @return boolean True, if the language has been set.
     */
    public function IsLanguageSet()
    {
        $language = $this->GetLanguage();
        
        $isSet = !is_null($language);
        
        return $isSet;
    }
    
    /**
     * Indicates whether or not the profile for the exam has been set.
     * @return boolean True, if the profile for the exam has been set.
     */
    public function IsProfileSet()
    {
        $profile = $this->GetProfile();
        
        $isSet = !is_null($profile);
        
        return $isSet;
    }
    
    /**
     * Indicates whether or not the exam is over.
     * @return boolean True, if the exam is over.
     */
    public function IsDone()
    {
        $isDone = !$this->IsNotDone();
        
        return $isDone;
    }
    
    /**
     * Indicates whether or not the exam is over.
     * @return boolean True, if the exam is NOT over.
     */
    public function IsNotDone()
    {
        $isStarted = $this->IsStarted();
        $questionsLeft = $this->IsQuestionsLeft();
        $validNumQuestions = $this->IsLvlQAsCountValid();
        
        $isNotDone = !$isStarted || ($questionsLeft && $validNumQuestions);
        
        return $isNotDone;
    }
    
    /**
     * Indicates whether or not the there is valid number of questions for the level.
     * @return boolean True, if there is a valid number of questions.
     */
    protected function IsLvlQAsCountValid()
    {
        $lvlQAs = $this->GetLvlQAs();
        $parameters = $this->GetParameters();
        
        $isValid = count($lvlQAs) == $parameters->GetQuestionCount();
        
        return $isValid;
    }
    
    /**
     * Indicates whether or not there are unanswered quetsions.
     * @return boolean True, if there ARE unanswered questions.
     */
    protected function IsQuestionsLeft()
    {
        $isLeft = FALSE;
        $lvlQAs = $this->GetLvlQAs();
        
        for($index = 0; $index < count($lvlQAs) && !$isLeft; $index++)
        {
            $qa = $lvlQAs[$index];
            
            $isLeft = !$qa->IsAnswerIdSet();
        }
        
        return $isLeft;
    }
    
    /**
     * Gets the cumulative collection of question I.D.'s from all previous levels.
     * @return The collection of question I.D.'s from the previous level.
     */
    protected function GetPreviousQuestionIDs()
    {
        $previousQuesIds = array();
        $allQAs = $this->GetAllQAs();
        
        foreach ($allQAs as $qa)
        {
            $previousQuesIds[] = $qa->GetQuestionId();
        }
        
        return $previousQuesIds;
    }
    
    /**
     * Uses the profile to compute an initial level for the exam, and sets it to the current level.
     */
    public function SetInitialLevel()
    {
        $initLvls = array(1);
        $profile = $this->GetProfile();
        $spokenAtHome = $profile->GetSpokenAtHome();
        $leopairs = $profile->GetLeoPairs();
        
        if ($spokenAtHome)
        {
            $parameters = $this->GetParameters();
            $initLvls[] = $parameters->GetSpokenAtHomeInitLevel();
        }
        
        foreach($leopairs as $leopair)
        {
            $experienceName = $leopair->GetExperienceName();
            $optionName = $leopair->GetOptionName();
            
            $initLvls[] = GetLanguageExperienceInitLevel($experienceName, $optionName);
        }
        
        $initLvl = max($initLvls);
        
        $this->SetLevel($initLvl);
        $this->SetPrevLevel($initLvl);
    }
    
    /**
     * Stores the current questions, increases the level, and gets new questions.
     */
    protected function IncreaseLevel()
    {
        $level = $this->GetLevel();
        
        $this->RecordLvlQAs();
        
        $nextLevel = $level + 1;
        
        $this->SetLevel($nextLevel);
        $this->SetPrevLevel($level);
        $this->GetNewLvlQAs();
    }
    
    /**
     * Stores the current questions, decreases the level, and gets new questions.
     */
    protected function DecreaseLevel()
    {
        $level = $this->GetLevel();
        $prevLevel = $this->GetPrevLevel();
        $languageID = $this->GetLanguage()->GetId();
        
        $this->RecordLvlQAs();
        
        $nextLevel = $level - 1;
        
        if (LevelExists($languageID, $nextLevel))
        {
            $this->SetLevel($nextLevel);
            $this->SetPrevLevel($level);
            
            if ($prevLevel != $nextLevel)
            {
                $this->GetNewLvlQAs();
            }
        }
    }
    
    /**
     * Gets a new set of level questions and answers and assigns them.
     */
    protected function GetNewLvlQAs()
    {
        $level = $this->GetLevel();
        $languageID = $this->GetLanguage()->GetId();
        $idsToExclude = $this->GetPreviousQuestionIDs();
        $limit = $this->GetParameters()->GetQuestionCount();
        
        $newQuesIDs = GetRandomQuestionIDs($languageID, $level, $limit, $idsToExclude);
        
        $lvlQAs = array();
        
        foreach ($newQuesIDs as $questionID)
        {
            $lvlQAs[] = new QuestionAnswer($questionID);
        }
        
        $this->SetLvlQAs($lvlQAs);
    }
    
    /**
     * Stores the current set of level question answers into all the question answers collection.
     */
    protected function RecordLvlQAs()
    {
        $lvlQAs = $this->GetLvlQAs();
        $allQAs = $this->GetAllQAs();
        
        foreach ($lvlQAs as $lvlQA)
        {
            if ($lvlQA->IsAnswerIdSet())
            {
                $questionID = $lvlQA->GetQuestionId();
                
                $allQAs[$questionID] = $lvlQA;
            }
        }
        
        $this->SetAllQAs($allQAs);
    }
    
    /**
     * Assess the score of the exam and decides whether to decrease, increase, or do nothing to the level.
     * If nothing is done then the exam is done and the questions for the level are recorded.
     */
    protected function AssessLvlAnswers()
    {
        $lvlDecreased = $this->TryToDecreaseLevel();
        
        if (!$lvlDecreased)
        {
            $lvlIncreased = $this->TryToIncreaseLevel();
            
            if (!$lvlIncreased && $this->IsDone())
            {
                $this->RecordLvlQAs();
            }
        }
    }
    
    /**
     * Tries to increase the current level based on the current answers.
     * @return boolean True, if the level was decreased, or false otherwise.
     */
    protected function TryToIncreaseLevel()
    {
        $success = FALSE;
        $correctAnsCount = 0;
        $lvlQAs = $this->GetLvlQAs();
        $parameters = $this->GetParameters();
        $questionCount = count($lvlQAs);
        
        foreach ($lvlQAs as $lvlQA)
        {
            if ($lvlQA->IsAnswerIdSet())
            {
                $answerID = $lvlQA->GetAnswerId();
                $questionID = $lvlQA->GetQuestionId();

                if (IsAnswerCorrect($questionID, $answerID))
                {
                    $correctAnsCount++;
                }
            }
        }
        
        $percentCorrect = floatval($correctAnsCount) / floatval($questionCount);
        
        if ($percentCorrect >= $parameters->GetIncLevelScore())
        {
            $this->IncreaseLevel();
            $success = TRUE;
        }
        
        return $success;
    }
    
    /**
     * Tries to decrease the current level based on the current answers.
     * @return boolean True, if the level was decreased, or false otherwise.
     */
    protected function TryToDecreaseLevel()
    {
        $success = FALSE;
        $lvlQAs = $this->GetLvlQAs();
        $parameters = $this->GetParameters();
        
        $incorrectAnsCount = 0;
        $questionCount = count($lvlQAs);
        
        foreach ($lvlQAs as $lvlQA)
        {
            if ($lvlQA->IsAnswerIdSet())
            {
                $answerID = $lvlQA->GetAnswerId();
                $questionID = $lvlQA->GetQuestionId();

                if (!IsAnswerCorrect($questionID, $answerID))
                {
                    $incorrectAnsCount++;
                }
            }
        }
        
        $percentScore = 1.0 - (floatval($incorrectAnsCount) / floatval($questionCount));
        
        if ($percentScore <= $parameters->GetDecLevelScore())
        {
            $this->DecreaseLevel();
            $success = TRUE;
        }
        
        return $success;
    }
    
    /**
     * Indicates whether or not the question is in current level's question collection.
     * @param int $questionID The I.D. of the question.
     * @return boolean True, if the question is in the current level's question collection, or false otherwise.
     */
    protected function IsInLvlQAs($questionID)
    {
        $found = FALSE;
        $lvlQAs = $this->GetLvlQAs();
        
        for ($i = 0; $i < count($lvlQAs) && !$found; $i++)
        {
            $lvlQA = $lvlQAs[$i];
            
            if ($lvlQA->IsQuestionIdSet() && $lvlQA->GetQuestionId() == $questionID)
            {
                $found = TRUE;
            }
        }
        
        return $found;
    }
    
    /**
     * Indicates whether or not the question is in the exam's past question collection.
     * @param int $questionID The I.D. of the question.
     * @return boolean True, if the question is in the exam's past question collection, or false otherwise.
     */
    protected function IsInAllQAs($questionID)
    {
        $found = FALSE;
        $allQAs = $this->GetAllQAs();
        
        for ($i = 0; $i < count($allQAs) && !$found; $i++)
        {
            $lvlQA = $allQAs[$i];
            
            if ($lvlQA->IsQuestionIdSet() && $lvlQA->GetQuestionId() == $questionID)
            {
                $found = TRUE;
            }
        }
        
        return $found;
    }
    
    /**
     * Indciates whether or not a question is currently in the exam.
     * @param int $questionID The I.D. of the question.
     * @return boolean True, if the question is currently in the exam, or false otherwise.
     */
    protected function IsInExam($questionID)
    {
        $isInExam = ($this->IsInLvlQAs($questionID) || $this->IsInAllQAs($questionID));
        
        return $isInExam;
    }
    
    /**
     * Gets the next unanswered question I.D. from the level of questions.
     * @return int The question I.D. of the next question or 0 if there are not more unanswered questions.
     */
    public function PullNextQuestionID()
    {
        $questionID = 0;
        
        $foundNextQues = FALSE;
        $lvlQAs = $this->GetLvlQAs();
        
        for($index = 0; $index < count($lvlQAs) && !$foundNextQues; $index++)
        {
            $lvlQA = $lvlQAs[$index];
            
            if(!$lvlQA->IsAnswerIdSet())
            {
                $foundNextQues = TRUE;
                $questionID = $lvlQA->GetQuestionId();
            }
        }
        
        return $questionID;
    }
    
    /**
     * Pairs the give answer I.D. with the first question that does not have an answer.
     * @param int $questionID The I.D. of the question that the answer is for.
     * @param int $answerID The I.D. of the answer.
     */
    public function PushQuestionAnswerID($questionID, $answerID)
    {
        $foundPulledQues = FALSE;
        $lvlQAs = $this->GetLvlQAs();
        
        for($index = 0; $index < count($lvlQAs) && !$foundPulledQues; $index++)
        {
            $lvlQA = $lvlQAs[$index];
            
            if($questionID == $lvlQA->GetQuestionId() && !$lvlQA->IsAnswerIdSet())
            {
                $foundPulledQues = TRUE;
                $lvlQA->SetAnswerId($answerID);
            }
        }
        
        $this->AssessLvlAnswers();
    }
    
    /**
     * Starts the exam.
     */
    public function Start()
    {
        $this->SetInitialLevel();
        $this->GetNewLvlQAs();
        $this->SetStarted(TRUE);
    }
    
    /**
     * Adds a question comment to the flagged question collection.
     * @param QuestionComment $qc The question comment.
     */
    public function FlagQuestion(QuestionComment $qc)
    {
        $flaggedQuestions = $this->GetFlaggedQuestions();
        
        $questionID = $qc->GetQuestionId();
        
        if ($this->IsInExam($questionID))
        {
            $flaggedQuestions[] = $qc;
        }
        
        $this->SetFlaggedQuestions($flaggedQuestions);
    }
}
?>
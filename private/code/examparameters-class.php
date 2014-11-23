<?php
require_once(GetValidationInfoClassFile());

/**
 * The exam parameters class.
 */
class ExamParameters
{
    /**
     * The key code used to acces the exam.
     * @var string 
     */
    private $keyCode;
    
    /**
     * The number of questions that need to be asked per-level of the exam.
     * @var int 
     */
    private $questionCount;
    
    /**
     * The decimal score that user must get in order to increase their current level.
     * @var decimal 
     */
    private $incLevelScore;
    
    /**
     * The decimal score that a user must get less than in order to decrease their current level.
     * @var decimal 
     */
    private $decLevelScore;
    
    /**
     * The initial leve that a test taker should start if they speak the language at home.
     * @var int 
     */
    private $spokenAtHomeInitLevel;
    
    /**
     * Gets the key code that is used to access the exam.
     * @return string The key code
     */
    public function GetKeyCode()
    {
        return $this->keyCode;
    }
    
    /**
     * Sets the key code that is used to access the exam.
     * @param string $keyCode The key code.
     */
    public function SetKeyCode($keyCode)
    {
        $this->keyCode = trim($keyCode);
    }
    
    /**
     * Gets the number of questions that must be asked per-level of the exam.
     * @return int The question count.
     */
    public function GetQuestionCount()
    {
        return $this->questionCount;
    }
    
    /**
     * Sets the number of questions that must be asked per-level of the exam.
     * @param int $questionCount The question count.
     */
    public function SetQuestionCount($questionCount)
    {
        $this->questionCount = trim($questionCount);
    }
    
    /**
     * Gets the decimal score that a user must attain in order to advance to the next level.
     * @return decimal The decimal score.
     */
    public function GetIncLevelScore()
    {
        return $this->incLevelScore;
    }
    
    /**
     * Sets the decimal score that a user must attain in order to advance to the next level.
     * @param decimal $incLevelScore The deciaml score.
     */
    public function SetIncLevelScore($incLevelScore)
    {
        $this->incLevelScore = $incLevelScore;
    }
    
    /**
     * Gets the decimal score that a user must score less than in order to go down a level.
     * @return decimal The decimal score.
     */
    public function GetDecLevelScore()
    {
        return $this->decLevelScore;
    }
    
    /**
     * Sets the decimal score that a user must score less than in order to go down a level.
     * @param decimal $decLevelScore The decimal score.
     */
    public function SetDecLevelScore($decLevelScore)
    {
        $this->decLevelScore = $decLevelScore;
    }
    
    /**
     * Gets the initial level of a test taker who speaks the language at home.
     * @return int The initial level.
     */
    public function GetSpokenAtHomeInitLevel()
    {
        return $this->spokenAtHomeInitLevel;
    }
    
    /**
     * Sets the initial level of a test taker who speaks the language at home.
     * @param int $initLevel The initial level.
     */
    public function SetSpokenAtHomeInitLevel($initLevel)
    {
        $this->spokenAtHomeInitLevel = $initLevel;
    }
    
    /**
     * Creates an instance of exam parameters.
     * @param string $keyCode The key code used to access the exam.
     * @param int $questionCount The number of questions that a user must be asked per-level of the exam.
     * @param decimal $incLevelScore The deciaml score that a user must attain in order to advance to the next level.
     * @param decimal $decLevelScore The decimal score that a user must score less than in order to decrease levels.
     * @param int $spokenAtHomeInitLevel The initial level of a test taker who speaks the language at home.
     */
    public function ExamParameters($keyCode = '', $questionCount = 0, $incLevelScore = 0.0, $decLevelScore = 0.0, $spokenAtHomeInitLevel = 1)
    {
        $this->SetKeyCode($keyCode);
        $this->SetQuestionCount($questionCount);
        $this->SetIncLevelScore($incLevelScore);
        $this->SetDecLevelScore($decLevelScore);
        $this->SetSpokenAtHomeInitLevel($spokenAtHomeInitLevel);
    }
    
    /**
     * Initializes the exam parameters.
     * @param array $row The row of exam parameters.
     */
    public function Initialize($row)
    {
        if (isset($row[$this->GetKeyCodeIndex()]))
        {
            $keyCode = $row[$this->GetKeyCodeIndex()];
            $this->SetKeyCode($keyCode);
        }
        
        if (isset($row[$this->GetQuestionCountIndex()]))
        {
            $questionCount = (int)$row[$this->GetQuestionCountIndex()];
            $this->SetQuestionCount($questionCount);
        }
        
        if (isset($row[$this->GetIncLevelScoreIndex()]))
        {
            $incLevelScore = (float)$row[$this->GetIncLevelScoreIndex()];
            $this->SetIncLevelScore($incLevelScore);
        }
        
        if (isset($row[$this->GetDecLevelScoreIndex()]))
        {
            $decLevelScore = (float)$row[$this->GetDecLevelScoreIndex()];
            $this->SetDecLevelScore($decLevelScore);
        }
        
        if (isset($row[$this->GetSpokenAtHomeInitLevelIndex()]))
        {
            $initLevel = (int)$row[$this->GetSpokenAtHomeInitLevelIndex()];
            
            $this->SetSpokenAtHomeInitLevel($initLevel);
        }
    }


    /**
     * Gets the index of the key code value.
     * @return string The index.
     */
    public function GetKeyCodeIndex()
    {
        return 'KeyCode';
    }
    
    /**
     * Gets the index of the question count value.
     * @return string The index.
     */
    public function GetQuestionCountIndex()
    {
        return 'QuestionCount';
    }
    
    /**
     * Gets the index of the increment level score value.
     * @return string The index.
     */
    public function GetIncLevelScoreIndex()
    {
        return 'IncLevelScore';
    }
    
    /**
     * Gets the index of the decrement level score value.
     * @return string The index.
     */
    public function GetDecLevelScoreIndex()
    {
        return 'DecLevelScore';
    }
    
    /**
     * Gets the index of the spoken at home initial level value.
     * @return string The index.
     */
    public function GetSpokenAtHomeInitLevelIndex()
    {
        return 'SpokenAtHomeInitLevel';
    }
    
    /**
     * Gets the percent value of incLevelScore
     * @return float The percent value.
     */
    public function GetIncLevelScorePercent()
    {
        $incLevelScore = $this->GetIncLevelScore();
        
        return $incLevelScore * 100.0;
    }
    
     /**
     * Gets the percent value of decLevelScore
     * @return float The percent value.
     */
    public function GetDecLevelScorePercent()
    {
        $decLevelScore = $this->GetDecLevelScore();
        
        return $decLevelScore * 100.0;
    }
    
    /**
     * Sets the percent value of incLevelScore
     * @param float $incLvlScorePct The percent value.
     */
    public function SetIncLevelScorePercent($incLvlScorePct)
    {
        $this->SetIncLevelScore($incLvlScorePct / 100.0);
    }
    
     /**
     * Sets the percent value of decLevelScore
     * @param float $decLvlScorePct The percent value.
     */
    public function SetDecLevelScorePercent($decLvlScorePct)
    {
        $this->SetDecLevelScore($decLvlScorePct / 100.0);
    }
    
    
    /**
     * Validates the key code.
     * @return \ValidationInfo The validation info.
     */
    protected function ValidateKeyCode()
    {
        $valid = TRUE;
        $errors = array();
        
        $keyCode = $this->GetKeyCode();
        
        if (!empty($keyCode))
        {
            if (strlen($keyCode) > 40)
            {
                $valid = FALSE;
                $errors[] = 'The key code is too long.';
            }
        }
        
        $vInfo = new ValidationInfo($valid, $errors);
        
        return $vInfo;
    }
    
    /**
     * Validates the question count field.
     * @return \ValidationInfo The validation info.
     */
    protected function ValidateQuestionCount()
    {
        $valid = TRUE;
        $errors = array();
        
        $questionCount = $this->GetQuestionCount();
        
        if (!is_int($questionCount) && (string)(int)$questionCount != $questionCount)
        {
            $valid = FALSE;
            $errors[] = 'The question count must be an integer greater than or equal to 1.';
        }
        else
        {
            if ($questionCount < 1)
            {
                $valid = FALSE;
                $errors[] = 'The question count must be greater than or equal to 1.';
            }
        }
        
        $vInfo = new ValidationInfo($valid, $errors);
        
        return $vInfo;
    }
    
    /**
     * Validates the increment level score field
     * @return \ValidationInfo The validation info.
     */
    protected function ValidateIncLevelScore()
    {
        $valid = TRUE;
        $errors = array();
        
        $incLevelScore = $this->GetIncLevelScore();
        
        if (!is_float($incLevelScore))
        {
            $valid = FALSE;
            $errors[] = 'The increment level score value must be a real number.';
        }
        else
        {
            if ($incLevelScore < 0 || $incLevelScore > 1)
            {
                $valid = FALSE;
                $errors[] = 'The increment level score must be a value between 0 and 1.';
            }
        }
        
        $vInfo = new ValidationInfo($valid, $errors);
        
        return $vInfo;
    }
    
    /**
     * Validates the decrement level score field
     * @return \ValidationInfo The validation info.
     */
    protected function ValidateDecLevelScore()
    {
        $valid = TRUE;
        $errors = array();
        
        $incLevelScore = $this->GetIncLevelScore();
        $decLevelScore = $this->GetDecLevelScore();
        
        if (!is_float($decLevelScore))
        {
            $valid = FALSE;
            $errors[] = 'The decrement level score value must be a real number.';
        }
        else
        {
            if ($decLevelScore < 0 || $decLevelScore > 1)
            {
                $valid = FALSE;
                $errors[] = 'The decrement level score must be a value between 0 and 1.';
            }
            else if ($decLevelScore >= $incLevelScore)
            {
                $valid = FALSE;
                $errors[] = 'The decrement level score must be less than the increment level score.';
            }
        }
        
        $vInfo = new ValidationInfo($valid, $errors);
        
        return $vInfo;
    }
/**
     * Validates the spoken at home init level field.
     * @return \ValidationInfo The validation info.
     */
    protected function ValidateSpokenAtHomeInitLevel()
    {
        $valid = TRUE;
        $errors = array();
        
        $initLevel = $this->GetSpokenAtHomeInitLevel();
        
        if (!is_int($initLevel) && (string)(int)$initLevel != $initLevel)
        {
            $valid = FALSE;
            $errors[] = 'The initial level for someone who speaks the language at home must be an integer greater than or equal to 1.';
        }
        else
        {
            if ($initLevel < 1)
            {
                $valid = FALSE;
                $errors[] = 'The initial level for someone who speaks the language at home must be greater than or equal to 1.';
            }
        }
        
        $vInfo = new ValidationInfo($valid, $errors);
        
        return $vInfo;
    }
    /**
     * Validates the exam parameters;
     * @return \ValidationInfo The validatio info.
     */
    public function Validate()
    {
        $vInfo = new ValidationInfo();
        
        $vInfo->Merge($this->ValidateKeyCode());
        $vInfo->Merge($this->ValidateQuestionCount());
        $vInfo->Merge($this->ValidateIncLevelScore());
        $vInfo->Merge($this->ValidateDecLevelScore());
        $vInfo->Merge($this->ValidateSpokenAtHomeInitLevel());
        
        return $vInfo;
    }
}
?>
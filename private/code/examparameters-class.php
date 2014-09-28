<?php
require_once(VALIDATIONINFOCLASS_FILE);

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
        $this->keyCode = $keyCode;
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
        $this->questionCount = $questionCount;
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
        while($incLevelScore > 1)
        {
            $incLevelScore = $incLevelScore / 10.0;
        }
        
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
        while($decLevelScore > 1)
        {
            $decLevelScore = $decLevelScore / 10.0;
        }
        
        $this->decLevelScore = $decLevelScore;
    }
    
    /**
     * Creates an instance of exam parameters.
     * @param string $keyCode The key code used to access the exam.
     * @param int $questionCount The number of questions that a user must be asked per-level of the exam.
     * @param decimal $incLevelScore The deciaml score that a user must attain in order to advance to the next level.
     * @param decimal $decLevelScore The decimal score that a user must score less than in order to decrease levels.
     */
    public function ExamParameters($keyCode = '', $questionCount = 0, $incLevelScore = 0.0, $decLevelScore = 0.0)
    {
        $this->SetKeyCode($keyCode);
        $this->SetQuestionCount($questionCount);
        $this->SetIncLevelScore($incLevelScore);
        $this->SetDecLevelScore($decLevelScore);
    }
    
    /**
     * Initializes the exam parameters.
     * @param array $row The row of exam parameters.
     */
    public function Initialize($row)
    {
        $keyCode = $row[$this->GetKeyCodeIndex()];
        $questionCount = (int)$row[$this->GetQuestionCountIndex()];
        $incLevelScore = (float)$row[$this->GetIncLevelScoreIndex()];
        $decLevelScore = (float)$row[$this->GetDecLevelScoreIndex()];
        
        $this->SetKeyCode($keyCode);
        $this->SetQuestionCount($questionCount);
        $this->SetIncLevelScore($incLevelScore);
        $this->SetDecLevelScore($decLevelScore);
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
     * Gets the percent value of incLevelScore
     * @return float The percent value.
     */
    public function GetIncLevelScorePercent()
    {
        $incLevelScore = $this->GetIncLevelScore();
        
        return $incLevelScore * 100;
    }
    
     /**
     * Gets the percent value of decLevelScore
     * @return float The percent value.
     */
    public function GetDecLevelScorePercent()
    {
        $decLevelScore = $this->GetDecLevelScore();
        
        return $decLevelScore * 100;
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
        
        if ((string)(int)$questionCount != $questionCount)
        {
            $valid = FALSE;
            $errors[] = 'The question count must be an integer.';
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
        
        $decLevelScore = $this->GetDecLevelScore();
        
        if (!is_float($decLevelScore))
        {
            $valid = FALSE;
            $errors[] = 'The decrement level score value must be a real number.';
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
        
        return $vInfo;
    }
}
?>
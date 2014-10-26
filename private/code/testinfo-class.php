<?php

/**
 * The test info class.
 */
class TestInfo
{
    /**
     * The I.D. of the test.
     * @var int 
     */
    private $id;
    
    /**
     * The first name of the person who took the test.
     * @var string 
     */
    private $firstName;
    
    /**
     *  The last name of the person who took the test.
     * @var string 
     */
    private $lastName;
    
    /**
     * The name of the language that the test was for.
     * @var string. 
     */
    private $language;
    
    /**
     * The resulting score of the test.
     * @var float 
     */
    private $score;
    
    /**
     * The date that the test was submitted.
     * @var string 
     */
    private $date;
    
    /**
     * Get's the test I.D.
     * @return int The test I.D.
     */
    public function GetId()
    {
        return $this->id;
    }
    
    /**
     * Sets the test I.D.
     * @param int $id The test I.D.
     */
    public function SetId($id)
    {
        $this->id = trim($id);
    }
    
    /**
     * Gets the first name of the person who took the test.
     * @return string The first name.
     */
    public function GetFirstName()
    {
        return $this->firstName;
    }
    
    /**
     * Sets the first name of the person who took the test.
     * @param string $firstName The first name.
     */
    public function SetFirstName($firstName)
    {
        $this->firstName = trim($firstName);
    }
    
    /**
     * Gets the last name of the person who took the test.
     * @return strin The last name.
     */
    public function GetLastName()
    {
        return $this->lastName;
    }
    
    /**
     * Sets the last name of the person who took the test.
     * @param string $lastName The last name.
     */
    public function SetLastName($lastName)
    {
        $this->lastName = trim($lastName);
    }
    
    /**
     * Gets the name of the language that the test was for.
     * @return Language The language.
     */
    public function GetLanguage()
    {
        return $this->language;
    }
    
    /**
     * Sets the name of the language that the test was for.
     * @param Language $language The language.
     */
    public function SetLanguage($language)
    {
        $this->language = $language;
    }
    
    /**
     * Gets the final score of the test.
     * @return flat The final score.
     */
    public function GetScore()
    {
        return $this->score;
    }
    
    /**
     * Sets the final score of the test.
     * @param float $score The final score.
     */
    public function SetScore($score)
    {
        $this->score = trim($score);
    }
    
    /**
     * Gets the date that the test was submitted on.
     * @return string The date.
     */
    public function GetDate()
    {
        return $this->date;
    }
    
    /**
     * Sets the date that the test was submitted on.
     * @param string $date The date.
     */
    public function SetDate($date)
    {
        $this->date = trim($date);
    }
    
    /**
     * Creates an instance of TestInfo.
     * @param int $id The I.D. of the test.
     * @param string $firstName The first name of the person who took the test.
     * @param string $lastName The last name of the person who took the test.
     * @param string $language The name of language that the test was for.
     * @param float $score The final score of the test.
     * @param string $date The date that the test was submitted on.
     */
    public function TestInfo($id = 0, $firstName = '', $lastName = '', $language = '', $score = 0.0, $date = '')
    {
        $this->SetId($id);
        $this->SetFirstName($firstName);
        $this->SetLastName($lastName);
        $this->SetLanguage($language);
        $this->SetScore($score);
        $this->SetDate($date);
    }
    
    /**
     * Initializes the test info.
     * @param array $row A collection of all of the test information.
     */
    public function Initialize($row)
    {
        if(isset($row[$this->GetIdIndex()]))
        {
            $id = $row[$this->GetIdIndex()];
            $this->SetId($id);
        }
        
        if(isset($row[$this->GetFirstNameIndex()]))
        {
            $firstName = $row[$this->GetFirstNameIndex()];
            $this->SetFirstName($firstName);
        }
        
        if(isset($row[$this->GetLastNameIndex()]))
        {
            $lastName = $row[$this->GetLastNameIndex()];
            $this->SetLastName($lastName);
        }
        
        if(isset($row[$this->GetLanguageIndex()]))
        {
            $language = $row[$this->GetLanguageIndex()];
            $this->SetLanguage($language);
        }
        
        if(isset($row[$this->GetScoreIndex()]))
        {
            $score = $row[$this->GetScoreIndex()];
            $this->SetScore($score);
        }
        
        if(isset($row[$this->GetDateIndex()]))
        {
            $date = $row[$this->GetDateIndex()];
            $date = ToDisplayDate($date);
            $this->SetDate($date);
        }
    }
    
    /**
     * Gets the index identifier for the test I.D.
     * @return string The I.D. index identifier.
     */
    public function GetIdIndex()
    {
        return 'TestID';
    }
    
    /**
     * Gets the index indentifier for the first name.
     * @return string The first name index identifier.
     */
    public function GetFirstNameIndex()
    {
        return 'FirstName';
    }
    
    /**
     * Gets the index indentifier for the last name.
     * @return string The last name index identifier.
     */
    public function GetLastNameIndex()
    {
        return 'LastName';
    }
    
    /**
     * Gets the index identifier for the language name.
     * @return string The language name index identifier.
     */
    public function GetLanguageIndex()
    {
        return 'Language';
    }
    
    /**
     * Gets the index identifier for the score.
     * @return string The score index identifier.
     */
    public function GetScoreIndex()
    {
        return 'Score';
    }
    
    /**
     * Gets the date index identifier.
     * @return string The date index identifier.
     */
    public function GetDateIndex()
    {
        return 'Date';
    }
}
?>
<?php

/**
 * The exam class.
 */
class Exam
{
    /**
     * The current level tha the user is on.
     * @var float 
     */
    private $level;
    
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
     * The I.D.'s of each answer for the current level.
     * @var array 
     */
    private $lvlAnswers;
    
    /**
     * The I.D.'s of each answer for the entire exam.
     * @var array 
     */
    private $allAnswers;
    
    /**
     * The I.D.'s of each question for the current level.
     * @var array
     */
    private $lvlQuestions;
    
    /**
     * The I.D.'s of each question for the entire exam.
     * @var type 
     */
    private $allQuestions;
    
    /**
     * Gets the current level of the exam.
     * @return float The level.
     */
    public function GetLevel()
    {
        return $this->level;
    }
    
    /**
     * Sets the current level of the exam.
     * @param float $level The level.
     */
    public function SetLevel($level)
    {
        $this->level = $level;
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
     * Gets the collection of answer I.D.'s for this level.
     * @return array The collection of answer I.D.'s
     */
    public function GetLvlAnswers()
    {
        return $this->lvlAnswers;
    }
    
    /**
     * Sets the collection of answer I.D.'s for this level.
     * @param array $lvlAnswers The collection of answer I.D.'s.
     */
    public function SetLvlAnswers($lvlAnswers)
    {
        $this->lvlAnswers = $lvlAnswers;
    }
    
    /**
     * Gets the collection of answer I.D.'s for the entire exam.
     * @return array The collection of answer I.D.'s
     */
    public function GetAllAnswers()
    {
        return $this->allAnswers;
    }
    
    /**
     * Sets the collection of answer I.D.'s for the entire exam.
     * @param array $lvlAnswers The collection of answer I.D.'s.
     */
    public function SetAllAnswers($allAnswers)
    {
        $this->allAnswers = $allAnswers;
    }
    
    /**
     * Gets the collection of question I.D's for this level.
     * @return array The collection of question I.D.'s.
     */
    public function GetLvlQuestions()
    {
        return $this->lvlQuestions;
    }
    
    /**
     * Sets the collection of question I.D.'s for this level.
     * @param array $lvlQuestions The collection of question I.D.'s.
     */
    public function SetLvlQuestions($lvlQuestions)
    {
        $this->lvlQuestions = $lvlQuestions;
    }
    
    /**
     * Gets the collection of question I.D's for the entire exam.
     * @return array The collection of question I.D.'s.
     */
    public function GetAllQuestions()
    {
        return $this->allQuestions;
    }
    
    /**
     * Sets the collection of question I.D.'s for the entire exam.
     * @param array $lvlQuestions The collection of question I.D.'s.
     */
    public function SetAllQuestions($allQuestions)
    {
        $this->allQuestions = $allQuestions;
    }
    
    /**
     * Creates an instance of an exam.
     * @param ExamParameters $parameters The paramaters.
     * @param Language $language The language.
     * @param Profile $profile The profile.
     */
    public function Exam(ExamParameters $parameters = NULL, Language $language = NULL, Profile $profile = NULL)
    {
        $this->SetLevel(0.0);
        $this->SetParameters($parameters);
        $this->SetLanguage($language);
        $this->SetProfile($profile);
        $this->SetLvlAnswers(array());
        $this->SetLvlQuestions(array());
        $this->SetAllAnswers(array());
        $this->SetAllQuestions(array());
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
}
?>
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
        $this->SetLvlQAs(array());
        $this->SetAllQAs(array());
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
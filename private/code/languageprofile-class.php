<?php

/**
 * A language profile.
 */
class LanguageProfile
{
    /**
     * The I.D. of the language profile.
     * @var int
     */
    private $id;
    
    /**
     * The I.D. of the user this profile belongs to.
     * @var int
     */
    private $userID;
    
    /**
     * The language that this profile is for.
     * @var string
     */
    private $language;
    
    /**
     * The flag that indicates whether or not the language is spoken at home.
     * @var boolean 
     */
    private $spokenAtHome;
    
    /**
     * The name of the junior high experience.
     * @var string 
     */
    private $jrHighExp;
    
    /**
     * The name of the high school experience.
     * @var string 
     */
    private $srHighExp;
    
    /**
     * The name of the college experience.
     * @var string 
     */
    private $collegeExp;
    
    /**
     * Gets the I.D. of this profile.
     * @return int The I.D.
     */
    public function GetID()
    {
        return $this->id;
    }
    
    /**
     * Sets the I.D. of the profile.
     * @param int $id The I.D. of the profile.
     */
    public function SetID($id)
    {
        $this->id = $id;
    }
    
    /**
     * Gets the I.D. of user this profile belongs to.
     * @return int The I.D. of the user.
     */
    public function GetUserID()
    {
        return $this->user;
    }
    
    /**
     * Sets the I.D. of the user this profile belongs to.
     * @param int $userID The user I.D.
     */
    public function SetUserID($userID)
    {
        $this->userID = $userID;
    }
    
    /**
     * Gets the name of the language that this profile is for.
     * @return string The name of the language.
     */
    public function GetLanguage()
    {
        return $this->language;
    }
    
    /**
     * Sets the name of the language that this profile belongs to.
     * @param string $language The name of the language.
     */
    public function SetLanguage($language)
    {
        $this->language = $language;
    }
    
    /**
     * Gets the flag that indicates whether or not the language is spoken at home.
     * @return bolean True, if the language is spoken at home.
     */
    public function GetSpokenAtHome()
    {
        return $this->spokenAtHome;
    }
    
    /**
     * Sets the flag that indicates whether or not the language is spoken at home.
     * @param boolean $spokenAtHome The flag indicating whether or not the language is spoken at home.
     */
    public function SetSpokenAtHome($spokenAtHome)
    {
        $this->spokenAtHome = $spokenAtHome;
    }
    
    /**
     * Gets the name of the junior high experience the user has with the language.
     * @return string The name of the experience.
     */
    public function GetJrHighExp()
    {
        return $this->jrHighExp;
    }
    
    /**
     * Sets the name of the junior high experience the user has with the language.
     * @param string $jrHighExp The name of the experience.
     */
    public function SetJrHighExp($jrHighExp)
    {
        $this->jrHighExp = $jrHighExp;
    }
    
    /**
     * Gets the name of the high school experience the user has with the language.
     * @return string The name of the experience.
     */
    public function GetSrHighExp()
    {
        return $this->srHighExp;
    }
    
    /**
     * Sets the name of the high school experience the user has with the language.
     * @param string $srHighExp The name of the experience.
     */
    public function SetSrHighExp($srHighExp)
    {
        $this->srHighExp = $srHighExp;
    }
    
    /**
     * Gets the name of the college experience the user has with the language.
     * @return string The name of the experience.
     */
    public function GetCollegeExp()
    {
        return $this->collegeExp;
    }
    
    /**
     * Sets the name of the college experience the user has with the language.
     * @param string $collegeExp The name of the experience.
     */
    public function SetCollegeExp($collegeExp)
    {
        $this->collegeExp = $collegeExp;
    }
    
    /**
     * Creates an instance of a language profile.
     * @param int $id The I.D. of the profile.
     * @param int $userID The I.D. of the user this profile belongs to.
     * @param string $language The name of the language this profile is for.
     * @param boolean $spokenAtHome The flag indicating whether or not the language is spoken at home.
     * @param string $jrHighExp The name of the experience gained from junior high.
     * @param string $srHighExp The name of the experience gained from high school.
     * @param string $collegeExp The name of the experience gained from college.
     */
    public function LanguageProfile($id = 0, $userID = 0, $language = '', $spokenAtHome = '', $jrHighExp = '', $srHighExp = '', $collegeExp = '')
    {
        $this->SetID($id);
        $this->SetUserID($userID);
        $this->SetLanguage($language);
        $this->SetSpokenAtHome($spokenAtHome);
        $this->SetJrHighExp($jrHighExp);
        $this->SetSrHighExp($srHighExp);
        $this->SetCollegeExp($collegeExp);
    }
}
?>
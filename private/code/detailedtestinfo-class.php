<?php

/**
 * The detailed test info class.
 */
class DetailedTestInfo extends TestInfo
{
    /**
     * Their email address.
     * @var string 
     */
    private $email;
    
    /**
     * The name of their major.
     * @var string 
     */
    private $major;
    
    /**
     * The name of their high school
     * @var string 
     */
    private $highSchool;
    
    /**
     * The flag that indicates whether or not the language is spoken at home.
     * @var boolean 
     */
    private $spokenAtHome;
    
    /**
     * Gets the email address.
     * @return string The email address.
     */
    public function GetEmail()
    {
        return $this->email;
    }
    
    /**
     * Sets the email address.
     * @param string $email The email address.
     */
    public function SetEmail($email)
    {
        $this->email = trim($email);
    }
    
    /**
     * Gets the name of the major.
     * @return string The name of the major.
     */
    public function GetMajor()
    {
        return $this->major;
    }
    
    /**
     * Sets the name of the major.
     * @param string $major The major.
     */
    public function SetMajor($major)
    {
        $this->major = trim($major);
    }
    
    /**
     * Gets the name of the high school.
     * @return string The name of the high school.
     */
    public function GetHighSchool()
    {
        return $this->highSchool;
    }
    
    /**
     * Sets the name of the high school.
     * @param string $highSchool The name of the high school.
     */
    public function SetHighSchool($highSchool)
    {
        $this->highSchool = trim($highSchool);
    }
    
    /**
     * Gets the flag that indicates whether or not the language is spoken at home.
     * @return boolean True, if the language is spoken at home.
     */
    public function GetSpokenAtHome()
    {
        return $this->spokenAtHome;
    }
    
    /**
     * Sets the flat that indicates whether or not the language is spoken at home.
     * @param boolean $spokenAtHome The flag.
     */
    public function SetSpokenAtHome($spokenAtHome)
    {
        $this->spokenAtHome = $spokenAtHome;
    }
    
    /**
     * Creates an instance of DetailedTestInfo.
     * @param int $id The I.D. of the test.
     * @param string $firstName The first name of the person who took the test.
     * @param string $lastName The last name of the person who took the test.
     * @param string $language The name of language that the test was for.
     * @param float $score The final score of the test.
     * @param string $date The date that the test was submitted on.
     * @param string $email The email.
     * @param string $major The major.
     * @param string $highSchool The high school.
     * @param boolean $spokenAtHome The flag that indicates whether or not the language is spoken at home.
     */
    public function DetailedTestInfo($id = 0, $firstName = '', $lastName = '', $language = '', $score = 0.0, $date = '', $email = "", $major = "", $highSchool = "", $spokenAtHome = FALSE)
    {
        parent::TestInfo($id, $firstName, $lastName, $language, $score, $date);
        
        $this->SetEmail($email);
        $this->SetMajor($major);
        $this->SetHighSchool($highSchool);
        $this->SetSpokenAtHome($spokenAtHome);
    }
    
    /**
     * Initializes the profile.
     * @param array $row A collection of all of the profile information.
     */
    public function Initialize($row)
    {
        parent::Initialize($row);
        
        if(isset($row[$this->GetEmailIndex()]))
        {
            $email = $row[$this->GetEmailIndex()];
            $this->SetEmail($email);
        }
        
        if(isset($row[$this->GetMajorIndex()]))
        {
            $major = $row[$this->GetMajorIndex()];
            $this->SetMajor($major);
        }
        
        if(isset($row[$this->GetHighSchoolIndex()]))
        {
            $highSchool = $row[$this->GetHighSchoolIndex()];
            $this->SetHighSchool($highSchool);
        }
        
        if($row[$this->GetSpokenAtHomeIndex()] == 1)
        {
            $spokenAtHome = TRUE;
            $this->SetSpokenAtHome($spokenAtHome);
        }
    }
    
    /**
     * Gets the index indentifier for the email.
     * @return string The email index identifier.
     */
    public function GetEmailIndex()
    {
        return 'Email';
    }
    
    /**
     * Gets the index indentifier for the major name.
     * @return string The major index identifier.
     */
    public function GetMajorIndex()
    {
        return 'Major';
    }
    
    /**
     * Gets the index indentifier for the high school name.
     * @return string The high school name index identifier.
     */
    public function GetHighSchoolIndex()
    {
        return 'HighSchool';
    }
    
    /**
     * Gets the index indentifier for the spoken at home flag.
     * @return string The index identifier for the flag.
     */
    public function GetSpokenAtHomeIndex()
    {
        return 'SpokenAtHome';
    }
}
?>
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
     * The name of the junior high experience with the language.
     * @var string 
     */
    private $jrHighExp;
    
    /**
     * The name of the senior high experience with the language.
     * @var string 
     */
    private $srHighExp;
    
    /**
     * The name of the college experience with the language.
     * @var string 
     */
    private $collegeExp;
    
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
        $this->email = $email;
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
        $this->major = $major;
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
        $this->highSchool = $highSchool;
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
     * Gets the name of the junior high experience with the language.
     * @return strng The name of the experience.
     */
    public function GetJrHighExp()
    {
        return $this->jrHighExp;
    }
    
    /**
     * Sets the name of the junior high experience with the language.
     * @param string $jrHighExp The name of the junior high exp.
     */
    public function SetJrHighExp($jrHighExp)
    {
        $this->jrHighExp = $jrHighExp;
    }
    
    /**
     * Gets the name of the senior high experience with the language.
     * @return string The name.
     */
    public function GetSrHighExp()
    {
        return $this->srHighExp;
    }
    
    /**
     * Sets the name of the senior high experience with the language.
     * @param string $srHighExp The name.
     */
    public function SetSrHighExp($srHighExp)
    {
        $this->srHighExp = $srHighExp;
    }
    
    /**
     * Gets the name of the college experience with the language.
     * @return string The name.
     */
    public function GetCollegeExp()
    {
        return $this->collegeExp;
    }
    
    /**
     * Sets the name of the college experience with the language.
     * @param string $collegeExp The name.
     */
    public function SetCollegeExp($collegeExp)
    {
        $this->collegeExp = $collegeExp;
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
     * @param string $jrHighExp The name of the junior high experience with the language.
     * @param string $srHighExp The name of the senior high experience with the language.
     * @param string $collegeExp The name of the college experience with the language.
     */
    public function DetailedTestInfo($id = 0, $firstName = '', $lastName = '', $language = '', $score = 0.0, $date = '', $email = "", $major = "", $highSchool = "", $spokenAtHome = FALSE, $jrHighExp = "", $srHighExp = "", $collegeExp = "")
    {
        parent::TestInfo($id, $firstName, $lastName, $language, $score, $date);
        
        $this->SetEmail($email);
        $this->SetMajor($major);
        $this->SetHighSchool($highSchool);
        $this->SetSpokenAtHome($spokenAtHome);
        $this->SetJrHighExp($jrHighExp);
        $this->SetSrHighExp($srHighExp);
        $this->SetCollegeExp($collegeExp);
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
        
        if(isset($row[$this->GetJrHighExpIndex()]))
        {
            $jrHighExp = $row[$this->GetJrHighExpIndex()];
            $this->SetJrHighExp($jrHighExp);
        }
        
        if(isset($row[$this->GetSrHighExpIndex()]))
        {
            $srHighExp = $row[$this->GetSrHighExpIndex()];
            $this->SetSrHighExp($srHighExp);
        }
        
        if(isset($row[$this->GetCollegeExpIndex()]))
        {
            $collegeExp = $row[$this->GetCollegeExpIndex()];
            $this->SetCollegeExp($collegeExp);
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
    
    /**
     * Gets the index indentifier for the junior high experience name.
     * @return string The junior high experience name index identifier.
     */
    public function GetJrHighExpIndex()
    {
        return 'JrHighExp';
    }
    
    /**
     * Gets the index indentifier for the senior high experience name.
     * @return string The senior high experience name index identifier.
     */
    public function GetSrHighExpIndex()
    {
        return 'SrHighExp';
    }
    
    /**
     * Gets the index indentifier for the college experience name.
     * @return string The college experience name index identifier.
     */
    public function GetCollegeExpIndex()
    {
        return 'CollegeExp';
    }
}
?>
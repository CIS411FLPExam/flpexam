<?php

require_once(VALIDATIONINFOCLASS_FILE);

/**
 * The profile class.
 */
class Profile
{
    /**
     * Their first name.
     * @var string
     */
    private $firstName;
    
    /**
     * Their last name.
     * @var string 
     */
    private $lastName;
    
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
     * The name of the course that the student is currently enrolled in.
     * @var string 
     */
    private $currentCourse;
    
    /**
     * Gets the first name.
     * @return string The first name.
     */
    public function GetFirstName()
    {
        return $this->firstName;
    }
    
    /**
     * Sets the first name.
     * @param string $firstName The first name.
     */
    public function SetFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    
    /**
     * Gets the last name.
     * @return string The last name.
     */
    public function GetLastName()
    {
        return $this->lastName;
    }
    
    /**
     * Sets the last name.
     * @param string $lastName The last name.
     */
    public function SetLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    
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
     * Gets the name of the current course for the language.
     * @return string The name.
     */
    public function GetCurrentCourse()
    {
        return $this->currentCourse;
    }
    
    /**
     * Sets the name of the current course for the language.
     * @param string $currentCourse The name.
     */
    public function SetCurrentCourse($currentCourse)
    {
        $this->currentCourse = $currentCourse;
    }
    
    /**
     * Creates an instance of a Profile.
     * @param string $firstName The first name.
     * @param string $lastName The last name.
     * @param string $email The email.
     * @param string $major The major.
     * @param string $highSchool The high school.
     * @param boolean $spokenAtHome The flag that indicates whether or not the language is spoken at home.
     * @param string $jrHighExp The name of the junior high experience with the language.
     * @param string $srHighExp The name of the senior high experience with the language.
     * @param string $collegeExp The name of the college experience with the language.
     * @param string $currentCourse The name of the current course in the language.
     */
    public function Profile($firstName = "", $lastName = "", $email = "", $major = "", $highSchool = "", $spokenAtHome = FALSE, $jrHighExp = "", $srHighExp = "", $collegeExp = "", $currentCourse = "")
    {
        $this->SetFirstName($firstName);
        $this->SetLastName($lastName);
        $this->SetEmail($email);
        $this->SetMajor($major);
        $this->SetHighSchool($highSchool);
        $this->SetSpokenAtHome($spokenAtHome);
        $this->SetJrHighExp($jrHighExp);
        $this->SetSrHighExp($srHighExp);
        $this->SetCollegeExp($collegeExp);
        $this->SetCurrentCourse($currentCourse);
    }

    /**
     * Initializes the profile.
     * @param array $row A collection of all of the profile information.
     */
    public function Initialize($row)
    {
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
        
        if(isset($row[$this->GetSpokenAtHomeIndex()]) && $row[$this->GetSpokenAtHomeIndex()] == 'Y')
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
        
        if (isset($row[$this->GetCurrentCourseIndex()]))
        {
            $currentCourse = $row[$this->GetCurrentCourseIndex()];
            $this->SetCurrentCourse($currentCourse);
        }
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
     * Gets the index identifier for the current course name.
     * @return string The current course name index identifier.
     */
    public function GetCurrentCourseIndex()
    {
        return 'CurrentCourse';
    }
    
    /**
     * Gets the index indentifier for the college experience name.
     * @return string The college experience name index identifier.
     */
    public function GetCollegeExpIndex()
    {
        return 'CollegeExp';
    }
    
    /**
     * Validates the first name field.
     * @return \ValidationInfo The validitaion info.
     */
    protected function ValidateFirstName()
    {
        $valid = TRUE;
        $errors = array();
        
        $firstName = $this->GetFirstName();
        
        if (empty($firstName))
        {
            $valid = FALSE;
            $errors[] = "First name can't be blank.";
        }
        else
        {
            if (strlen($firstName) > 32)
            {
                $valid = FALSE;
                $errors[] = "The first name is too long.";
            }
        }
        
        $vInfo = new ValidationInfo($valid, $errors);
        
        return $vInfo;
    }
    
    /**
     * Validates the last name field.
     * @return \ValidationInfo The validation info.
     */
    protected function ValidateLastName()
    {
        $valid = TRUE;
        $errors = array();
        
        $lastName = $this->GetLastName();
        
        if (empty($lastName))
        {
            $valid = FALSE;
            $errors[] = "Last name can't be blank.";
        }
        else
        {
            if (strlen($lastName) > 32)
            {
                $valid = FALSE;
                $errors[] = "The last name is too long.";
            }
        }
        
        $vInfo = new ValidationInfo($valid, $errors);
        
        return $vInfo;
    }
    
    /**
     * Validates the email field.
     * @return \ValidationInfo The validation email.
     */
    protected function ValidateEmail()
    {
        $valid = TRUE;
        $errors = array();
        
        $email = $this->GetEmail();
        
        if (empty($email))
        {
            $valid = FALSE;
            $errors[] = "Email can't be blank.";
        }
        else
        {
            if (!preg_match(VALID_EMAIL_PATTERN, $email))
            {
                $valid = FALSE;
                $errors[] = "The email address \"" . $email . "\" is not valid.";
            }

            if (strlen($email) > 40)
            {
                $valid = FALSE;
                $errors[] = "The email is too long.";
            }
        }
        
        $vInfo = new ValidationInfo($valid, $errors);
        
        return $vInfo;
    }
    
    /**
     * Validates the major field.
     * @return \ValidationInfo The validation information.
     */
    protected function ValidateMajor()
    {
        $valid = TRUE;
        $errors = array();
        
        $major = $this->GetMajor();
        
        if (!empty($major))
        {
            if(strlen($major) > 32)
            {
                $valid = FALSE;
                $errors[] = "The name of the major is too long.";
            }
        }
        
        $vInfo = new ValidationInfo($valid, $errors);
        
        return $vInfo;
    }
    
    /**
     * Validates the high school field.
     * @return \ValidationInfo The validation info.
     */
    protected function ValidateHighSchool()
    {
        $valid = TRUE;
        $errors = array();
        
        $highSchool = $this->GetHighSchool();
        
        if (!empty($highSchool))
        {
            if(strlen($highSchool) > 32)
            {
                $valid = FALSE;
                $errors[] = "The name of the high school is too long.";
            }
        }
        
        $vInfo = new ValidationInfo($valid, $errors);
        
        return $vInfo;
    }
    
    /**
     * Validates the junior high experience field.
     * @return \ValidationInfo The validation info.
     */
    protected function ValidateJrHighExp()
    {
        $valid = TRUE;
        $errors = array();
        
        $jrHighExp = $this->GetJrHighExp();
        
        if (empty($jrHighExp))
        {
            $valid = FALSE;
            $errors[] = "Junior high experience can't be blank.";
        }
        
        $vInfo = new ValidationInfo($valid, $errors);
        
        return $vInfo;
    }
    
    /**
     * Validates the high school experience field.
     * @return \ValidationInfo The validation info.
     */
    protected  function ValidateSrHighExp()
    {
        $valid = TRUE;
        $errors = array();
        
        $srHighExp = $this->GetSrHighExp();
        
        if (empty($srHighExp))
        {
            $valid = FALSE;
            $errors[] = "High school experience can't be blank.";
        }
        
        $vInfo = new ValidationInfo($valid, $errors);
        
        return $vInfo;
    }
    
    /**
     * Validates the college experience field
     * @return \ValidationInfo The validation info.
     */
    protected function ValidateCollegeExp()
    {
        $valid = TRUE;
        $errors = array();
        
        $collegeExp = $this->GetCollegeExp();
        
        if (empty($collegeExp))
        {
            $valid = FALSE;
            $errors[] = "College experience can't be blank.";
        }
        
        $vInfo = new ValidationInfo($valid, $errors);
        
        return $vInfo;
    }
    
    /**
     * Validates the profile.
     * @return \ValidationInfo The validation info.
     */
    public function Validate()
    {
        $validInfo = new ValidationInfo();
        
        $validInfo->Merge($this->ValidateFirstName());
        $validInfo->Merge($this->ValidateLastName());
        $validInfo->Merge($this->ValidateEmail());
        $validInfo->Merge($this->ValidateMajor());
        $validInfo->Merge($this->ValidateHighSchool());
        $validInfo->Merge($this->ValidateJrHighExp());
        $validInfo->Merge($this->ValidateSrHighExp());
        $validInfo->Merge($this->ValidateCollegeExp());
        
        return $validInfo;
    }
}
?>
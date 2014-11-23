<?php

require_once(GetValidationInfoClassFile());

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
     * The collection of language experince option pairs.
     * @var array
     */
    private $leopairs;
    
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
        $this->firstName = trim($firstName);
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
        $this->lastName = trim($lastName);
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
     * Gets the collection of language experience option pairs.
     * @return array The collection of LEOPairs.
     */
    public function GetLeoPairs()
    {
        return $this->leopairs;
    }
    
    /**
     * Sets the collection of language experience option pairs.
     * @param array $leopairs The collection of LEOPairs.
     */
    public function SetLeoPairs($leopairs)
    {
        $this->leopairs = $leopairs;
    }
    
    /**
     * Creates an instance of a Profile.
     * @param string $firstName The first name.
     * @param string $lastName The last name.
     * @param string $email The email.
     * @param string $major The major.
     * @param string $highSchool The high school.
     * @param boolean $spokenAtHome The flag that indicates whether or not the language is spoken at home.
     * @param array $leopairs The collection of language experience option pairs.
     */
    public function Profile($firstName = "", $lastName = "", $email = "", $major = "", $highSchool = "", $spokenAtHome = FALSE, $leopairs = array())
    {
        $this->SetFirstName($firstName);
        $this->SetLastName($lastName);
        $this->SetEmail($email);
        $this->SetMajor($major);
        $this->SetHighSchool($highSchool);
        $this->SetSpokenAtHome($spokenAtHome);
        $this->SetLeoPairs($leopairs);
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
        
        $leopairs = $this->GetLeoPairs();
        $leoP = new LEOPair();
        $sig = $leoP->GetLEOPairSignature();
        $keys = array_keys($row);
        
        foreach ($keys as $key)
        {
            if (strpos($key, $sig) !== FALSE)
            {
                $bareKey = str_replace($sig, '', $key);
                $experienceName = str_replace('_', ' ', $bareKey);
                $optionName = $row[$key];
                
                $leopair = new LEOPair();
                $leopair->SetExperienceName($experienceName);
                $leopair->SetOptionName($optionName);
                
                $leopairs[$key] = $leopair;
            }
        }
        
        $this->SetLeoPairs($leopairs);
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
        
        return $validInfo;
    }
    
    /**
     * Adds an language experience option pair to the collection of language experience option pairs.
     * @param LEOPair $leopair The language experience option pair.
     */
    public function AddLeoPair($leopair)
    {
        $leopairs = $this->GetLeoPairs();
        $key = $leopair->GetExperienceName();
        
        $leopairs[$key] = $leopair;
        
        $this->SetLeoPairs($leopairs);
    }
    
    /**
     * Initializes the collection language experience options to the default.
     */
    public function InitializeLEOs()
    {
        $languageExperiences = GetAllLanguageExperiencesWithOptions();
        
        $count = 1;
        foreach($languageExperiences as $languageExperience)
        {
            $leopair = new LEOPair($count);
            $optionName = '';
            $experienceName = $languageExperience->GetName();
            $options = $languageExperience->GetOptions();
            
            if (count($options) > 0)
            {
                $option1 = $options[0];
                $optionName = $option1->GetName();
            }
            
            $leopair->SetExperienceName($experienceName);
            $leopair->SetOptionName($optionName);
            
            $count++;
            
            $this->AddLeoPair($leopair);
        }
    }
}
?>
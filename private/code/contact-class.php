<?php

/**
 * The contact class.
 */
class Contact
{
    /**
     * The I.D. of the contact.
     * @var int 
     */
    private $id;
    
    /**
     * The first name.
     * @var string 
     */
    private $firstName;
    
    /**
     * The last name.
     * @var string 
     */
    private $lastName;
    
    /**
     * The email.
     * @var string 
     */
    private $email;
    
    /**
     * The flag that indicates whether are not the contact is a primary contact.
     * @var boolean 
     */
    private $primary;
   
    /**
     * Get's the I.D.
     * @return int The I.D.
     */
    public function GetId()
    {
        return $this->id;
    }
    
    /**
     * Sets the I.D.
     * @param int $id The I.D.
     */
    public function SetId($id)
    {
        $this->id = $id;
    }
     
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
     * Gets the flag that indicates whether or not the contact is a primary contact.
     * @return boolean True, if the contact is a primary contact.
     */
    public function GetPrimary()
    {
        return $this->primary;
    }
    
    /**
     * Sets the flag that indicates whether or not the contact is a primary contact.
     * @param boolean $primary True, if the contact is a priarmy contact.
     */
    public function SetPrimary($primary)
    {
        if(is_string($primary))
        {
            if($primary == '0')
            {
                $primary = FALSE;
            }
            else 
            {
                $primary = TRUE;
            }
        }
        
        $this->primary = $primary;
    }
    
    /**
     * Creates an instance of a Contact.
     * @param int $id The I.D.
     * @param string $firstName The first name.
     * @param string $lastName The last name.
     * @param string $email The email.
     * @param boolean $primary The flag that indicates whether or not the contact is a primary contact.
     */
    public function Contact($id = 0, $firstName = '', $lastName = '', $email = '', $primary = FALSE)
    {
        $this->SetId($id);
        $this->SetFirstName($firstName);
        $this->SetLastName($lastName);
        $this->SetEmail($email);
        $this->SetPrimary($primary);
    }
    
    /**
     * Initializes the contact.
     * @param array $array The collection of contact information.
     */
    public function Initialize($array)
    {
        $idIndex = $this->GetIdIndex();
        $firstNameIndex = $this->GetFirstNameIndex();
        $lastNameIndex = $this->GetLastNameIndex();
        $emailIndex = $this->GetEmailIndex();
        $primaryIndex = $this->GetPrimaryIndex();
        
        if(isset($array[$idIndex]))
        {
            $id = $array[$idIndex];
            $this->SetId($id);
        }
        
        if (isset($array[$firstNameIndex]))
        {
            $firstName = $array[$firstNameIndex];
            $this->SetFirstName($firstName);
        }
        
        if (isset($array[$lastNameIndex]))
        {
            $lastName = $array[$lastNameIndex];
            $this->SetLastName($lastName);
        }
        
        if (isset($array[$emailIndex]))
        {
            $email = $array[$emailIndex];
            $this->SetEmail($email);
        }
        
        if(isset($array[$primaryIndex]))
        {
            $primary = $array[$primaryIndex];
            
            $this->SetPrimary($primary);
        }
    }
    
    /**
     * Gets the index identifier for the I.D.
     * @return string The I.D. index identifier.
     */
    public function GetIdIndex()
    {
        return 'ContactID';
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
     * Gets the index identifier for the primary flag indicator.
     * @return string The primary flag index identifier.
     */
    public function GetPrimaryIndex()
    {
        return 'Primary';
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
     * @return \ValidationInfo The validation info.
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
     * Validates all fields of the contact.
     * @return \ValidationInfo The validation info.
     */
    public function Validate()
    {
        $vInfo = new ValidationInfo();
        
        $vInfo->Merge($this->ValidateFirstName());
        $vInfo->Merge($this->ValidateLastName());
        $vInfo->Merge($this->ValidateEmail());
        
        return $vInfo;
    }
}
?>
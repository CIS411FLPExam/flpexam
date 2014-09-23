<?php

/**
 * The contact class.
 */
class Contact
{
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
     * The phone number.
     * @var string 
     */
    private $phoneNumber;
    
    /**
     * The email.
     * @var string 
     */
    private $email;
    
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
     * Gets the phone number.
     * @return string The phone number.
     */
    public function GetPhoneNumber()
    {
        return $this->phoneNumber;
    }
    
    /**
     * Sets the phone number.
     * @param string $phoneNumber The phone number.
     */
    public function SetPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
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
     * Creates an instance of a Contact.
     * @param string $firstName The first name.
     * @param string $lastName The last name.
     * @param string $phoneNumber The phone number.
     * @param string $email The email.
     */
    public function Contact($firstName = '', $lastName = '', $phoneNumber = '', $email = '')
    {
        $this->SetFirstName($firstName);
        $this->SetLastName($lastName);
        $this->SetPhoneNumber($phoneNumber);
        $this->SetEmail($email);
    }
    
    /**
     * Initializes the contact.
     * @param array $array The collection of contact information.
     */
    public function Initialize($array)
    {
        $firstNameIndex = $this->GetFirstNameIndex();
        $lastNameIndex = $this->GetLastNameIndex();
        $phoneNumberIndex = $this->GetPhoneNumberIndex();
        $emailIndex = $this->GetEmailIndex();
        
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
        
        if (isset($array[$phoneNumberIndex]))
        {
            $phoneNumber = $array[$phoneNumberIndex];
            $this->SetPhoneNumber($phoneNumber);
        }
        
        if (isset($array[$emailIndex]))
        {
            $email = $array[$emailIndex];
            $this->SetEmail($email);
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
     * Gets the index identifier for the phone number.
     * @return string The phone number index identifier.
     */
    public function GetPhoneNumberIndex()
    {
        return 'PhoneNumber';
    }
    
    /**
     * Gets the index indentifier for the email.
     * @return string The email index identifier.
     */
    public function GetEmailIndex()
    {
        return 'Email';
    }
}
?>
<?php

/**
 * A user.
 */
class User
{
    /**
     * The I.D. of the user.
     * @var int 
     */
    private $id;
    
    /**
     * The user's first name.
     * @var string 
     */
    private $firstName;
    
    /**
     * The user's last name.
     * @var string 
     */
    private $lastName;
    
    /**
     * The user's user name.
     * @var string 
     */
    private $userName;
    
    /**
     * The user's email.
     * @var string
     */
    private $email;
    
    /**
     * The major of the user.
     * @var string 
     */
    private $major;
    
    /**
     * The high school the user went to.
     * @var string the name of the high school
     */
    private $highSchool;
    
    /**
     * Gets the user's I.D.
     * @return int The I.D.
     */
    public function GetID()
    {
        return $this->id;
    }
    
    /**
     * Set's the user's I.D.
     * @param int $id The I.D.
     */
    public function SetID($id)
    {
        $this->id = $id;
    }
    
    /**
     * Gets the user's first name.
     * @return string The first name.
     */
    public function GetFirstName()
    {
        return $this->firstName;
    }
    
    /**
     * Sets the user's first name.
     * @param string $firstName The first name.
     */
    public function SetFirstName($firstName)
    {
        $this->firstName = $firstName;
    }
    
    /**
     * Gets the user's last name.
     * @return string The last name.
     */
    public function GetLastName()
    {
        return $this->lastName;
    }
    
    /**
     * Sets the user's last name.
     * @param string $lastName The last name.
     */
    public function SetLastName($lastName)
    {
        $this->lastName = $lastName;
    }
    
    /**
     * Gets the user's user name.
     * @return string The user name.
     */
    public function GetUserName()
    {
        return $this->userName;
    }
    
    /**
     * Sets the user's user name.
     * @param string $userName The user name.
     */
    public function SetUserName($userName)
    {
        $this->userName = $userName;
    }
    
    /**
     * Gets the user's email.
     * @return string The email.
     */
    public function GetEmail()
    {
        return $this->email;
    }
    
    /**
     * Sets the user's email.
     * @param string $email The email.
     */
    public function SetEmail($email)
    {
        $this->email = $email;
    }
    
    /**
     * Gets the name of the user's major.
     * @return string The name of the major.
     */
    public function GetMajor()
    {
        return $this->major;
    }
    
    /**
     * Sets the name of the user's major.
     * @param string $major The name of the major.
     */
    public function SetMajor($major)
    {
        $this->major = $major;
    }
    
    /**
     * Gets the name of the user's high school.
     * @return string The name of the high school.
     */
    public function GetHighSchool()
    {
        return $this->highSchool;
    }
    
    /**
     * Sets the name of the user's high school.
     * @param string $highSchool The name of the high school.
     */
    public function SetHighSchool($highSchool)
    {
        $this->highSchool = $highSchool;
    }
    
    /**
     * Creates an instance of a user.
     * @param int $id The I.D. of the user.
     * @param string $firstName The user's first name.
     * @param string $lastName The user's last name.
     * @param string $userName The user's user name.
     * @param string $email The user's email.
     * @param string $major The user's major.
     * @param string $highSchool The user's high school.
     */
    public function User($id = 0, $firstName = '', $lastName = '', $userName = '', $email = '', $major = '', $highSchool = '')
    {
        $this->SetID($id);
        $this->SetFirstName($firstName);
        $this->SetLastName($lastName);
        $this->SetUserName($userName);
        $this->SetEmail($email);
        $this->SetMajor($major);
        $this->SetHighSchool($highSchool);
    }
}

?>
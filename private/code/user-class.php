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
     * The user's password.
     * @var string 
     */
    private $password;

    /**
     * The user's email.
     * @var string
     */
    private $email;

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
     * Gets the user's password.
     * @return string The password.
     */
    public function GetPassword()
    {
        return $this->password;
    }
    
    /**
     * Sets the user's password
     * @param string $password The password.
     */
    public function SetPassword($password)
    {
        $this->password = $password;
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
     * Creates an instance of a user.
     * @param int $id The I.D. of the user.
     * @param string $firstName The user's first name.
     * @param string $lastName The user's last name.
     * @param string $userName The user's user name.
     * @param string $password The user's password.
     * @param string $email The user's email.
     */
    public function User($id = 0, $firstName = '', $lastName = '', $userName = '', $password = '', $email = '')
    {
        $this->SetID($id);
        $this->SetFirstName($firstName);
        $this->SetLastName($lastName);
        $this->SetUserName($userName);
        $this->SetPassword($password);
        $this->SetEmail($email);
    }
    
    /**
     * The user record.
     * @param array $record The collection of user attributes.
     */
    public function Initialize($record)
    {
        $userIdIndex = $this->GetUserNameIndex();
        $firstNameIndex = $this->GetFirstNameIndex();
        $lastNameIndex = $this->GetLastNameIndex();
        $userNameIndex = $this->GetUserNameIndex();
        $passwordIndex = $this->GetPasswordIndex();
        $emailIndex = $this->GetEmailIndex();
        
        $userID = $record[$userIdIndex];
        $firstName = $record[$firstNameIndex];
        $lastName = $record[$lastNameIndex];
        $userName = $record[$userNameIndex];
        $password = $record[$passwordIndex];
        $email = $record[$emailIndex];
        
        $this->SetID($userID);
        $this->SetFirstName($firstName);
        $this->SetLastName($lastName);
        $this->SetUserName($userName);
        $this->SetPassword($password);
        $this->SetEmail($email);
    }
    
    /**
     * Gets the name of the table user's are stored on.
     * @return string The table name.
     */
    public function GetTableName()
    {
        return 'users';
    }
    
    /**
     * Gets the user I.D. identifier.
     * @return string The I.D. identifier.
     */
    public function GetIdIndex()
    {
        return 'UserID';
    }

    /**
     * Gets the first name identifier.
     * @return string The first name identifier.
     */
    public function GetFirstNameIndex()
    {
        return 'FirstName';
    }

    /**
     * Gets the last name identifier.
     * @return string The last name identifier.
     */
    public function GetLastNameIndex()
    {
        return 'LastName';
    }

    /**
     * Gets the user name identifier.
     * @return string The user name identifier.
     */
    public function GetUserNameIndex()
    {
        return 'UserName';
    }

    /**
     * Gets the password identifier.
     * @return string The password identifier.
     */
    public function GetPasswordIndex()
    {
        return 'Password';
    }
    
    /**
     * Gets the email identifier.
     * @return string The email identifier.
     */
    public function GetEmailIndex()
    {
        return 'Email';
    }
}
?>
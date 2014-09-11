<?php
    
class Profile
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

    public  function Profile()
    {
        
    }
    
    
    /**
     * Gets the major identifier.
     * @return string The major identifier.
     */
    public function GetMajorIndex()
    {
        return 'Major';
    }
    
    /**
     * Gets the high school identifier.
     * @return string The high school identifier.
     */
    public function GetHighSchoolIndex()
    {
        return 'HighSchool';
    }
}

?>
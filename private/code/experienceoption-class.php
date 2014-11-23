<?php
require_once(GetValidationInfoClassFile());

/**
 * The experience option class.
 */
class ExperienceOption
{
    /**
     * The unique I.D. of the option.
     * @var int
     */
    private $id;
    
    /**
     * The unique I.D. of the language experience this option belongs to.
     * @var int
     */
    private $exprienceID;
    
    /**
     * The name of this option.
     * @var string
     */
    private $name;
    
    /**
     * The initial level that corresponds to this option.
     * @var int
     */
    private $initLevel;
    
    /**
     * Gets the unique I.D. of the option.
     * @return int The I.D.
     */
    public function GetId()
    {
        return $this->id;
    }
    
    /**
     * Sets the unique I.D. of the option.
     * @param int $id The I.D.
     */
    public function SetId($id)
    {
        $this->id = trim($id);
    }
    
    /**
     * Gets the unique I.D. of the language experience this option belongs to.
     * @return int The unique I.D. of the language experience.
     */
    public function GetExperienceId()
    {
        return $this->exprienceID;
    }
    
    /**
     * Sets the unique I.D. of the language experience this option belongs to.
     * @param int $experienceID The unique I.D. of the language experience.
     */
    public function SetExperienceId($experienceID)
    {
        $this->exprienceID = trim($experienceID);
    }
    
    /**
     * Gets the name of the option.
     * @return string The name.
     */
    public function GetName()
    {
        return $this->name;
    }
    
    /**
     * Sets the name of the option.
     * @param string $name The name.
     */
    public function SetName($name)
    {
        $this->name = trim($name);
    }
    
    /**
     * Gets the initial level that this option corresponds to.
     * @return int The initial level.
     */
    public function GetInitLevel()
    {
        return $this->initLevel;
    }
    
    /**
     * Sets the initial level that this option corresponds to.
     * @param int $initLevel The initial level.
     */
    public function SetInitLevel($initLevel)
    {
        $this->initLevel = trim($initLevel);
    }
    
    /**
     * Creates an instance of an experience option.
     * @param int $id The unique I.D. of the option.
     * @param int $experienceID The unique I.D. of the language experience this option belongs to.
     * @param string $name The name of the option.
     * @param int $initLevel The initial level that this option corresponds to.
     */
    public function ExperienceOption($id = 0, $experienceID = 0, $name = '', $initLevel = 1)
    {
        $this->SetId($id);
        $this->SetExperienceId($experienceID);
        $this->SetName($name);
        $this->SetInitLevel($initLevel);
    }
    
    /**
     * Initializes the option given a collection of data.
     * @param array $row The collection of data.
     */
    public function Initialize($row)
    {
        $idKey = $this->GetIdKey();
        $experieneIdKey = $this->GetExperienceIdKey();
        $nameKey = $this->GetNameKey();
        $initLevelKey = $this->GetInitLevelKey();
        
        if (isset($row[$idKey]))
        {
            $id = $row[$idKey];
            $this->SetId($id);
        }
        
        if (isset($row[$experieneIdKey]))
        {
            $experienceID = $row[$experieneIdKey];
            $this->SetExperienceId($experienceID);
        }
        
        if (isset($row[$nameKey]))
        {
            $name = $row[$nameKey];
            $this->SetName($name);
        }
        
        if (isset($row[$initLevelKey]))
        {
            $initLevel = $row[$initLevelKey];
            $this->SetInitLevel($initLevel);
        }
    }
    
    /**
     * Gets the index key of the I.D.
     * @return string The index key.
     */
    public function GetIdKey()
    {
        return 'OptionID';
    }
    
    /**
     * Gets the index key of the experiene I.D.
     * @return string The index key.
     */
    public function GetExperienceIdKey()
    {
        return 'ExperienceID';
    }
    
    /**
     * Gets the index key of the name.
     * @return string The index key.
     */
    public function GetNameKey()
    {
        return 'Name';
    }
    
    /**
     * Gets the index key of the init level.
     * @return string The index key.
     */
    public function GetInitLevelKey()
    {
        return 'InitLevel';
    }
    
    
    /**
     * Validates the name field of the experience.
     * @return \ValidationInfo The validation info.
     */
    public function ValidateName()
    {
        $valid = TRUE;
        $errors = array();
        
        $name = $this->GetName();
        
        if (empty($name))
        {
            $valid = FALSE;
            $errors[] = 'Name cannot be blank.';
        }
        else
        {
            if (strlen($name) > 32)
            {
                $valid = FALSE;
                $errors[] = 'The name is too long.';
            }
        }
        
        $vi = new ValidationInfo($valid, $errors);
        
        return $vi;
    }
    
    /**
     * Validates the initital level field of the experience.
     * @return \ValidationInfo The validation info.
     */
    public function ValidateInitLevel()
    {
        $valid = TRUE;
        $errors = array();
        
        $initLevel = $this->GetInitLevel();
        
        if ((string)(int)$initLevel != $initLevel)
        {
            $valid = FALSE;
            $errors[] = 'The initial level must be an integer.';
        }
        else if ($initLevel < 1)
        {
            $valid = FALSE;
            $errors[] = 'The initial level must be greater than or equal to 1.';
        }
        
        $vi = new ValidationInfo($valid, $errors);
        
        return $vi;
    }
    
    /**
     * Validates the language experience.
     * @return \ValidationInfo The validation info.
     */
    public function Validate()
    {
        $vi = new ValidationInfo();
        
        $vi->Merge($this->ValidateName());
        $vi->Merge($this->ValidateInitLevel());
        
        return $vi;
    }
}
?>
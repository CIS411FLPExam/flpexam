<?php

require_once(VALIDATIONINFOCLASS_FILE);

class LanguageExperience
{
    /**
     * The I.D. of the language experience.
     * @var int
     */
    private $id;
    
    /**
     * The name of the language experience.
     * @var string
     */
    private $name;
    
    /**
     * The initial level that corresponds to the experience.
     * @var int 
     */
    private $initLevel;
    
    /**
     * Gets the I.D. of the language experience.
     * @return int The I.D.
     */
    public function GetId()
    {
        return $this->id;
    }
    
    /**
     * Sets the I.D. of the language experience.
     * @param int $id
     */
    public function SetId($id)
    {
        $this->id = trim($id);
    }
    
    /**
     * Gets the name of the language experience.
     * @return string The name.
     */
    public function GetName()
    {
        return $this->name;
    }
    
    /**
     * Sets the name of the language experience.
     * @param string $name The name.
     */
    public function SetName($name)
    {
        $this->name = trim($name);
    }
    
    /**
     * Gets the initial level that corresponds to this experience.
     * @return int The initial level.
     */
    public function GetInitLevel()
    {
        return $this->initLevel;
    }
    
    /**
     * Sets the initial level that corresponds to this experience.
     * @param int $initLevel The initial level.
     */
    public function SetInitLevel($initLevel)
    {
        $this->initLevel = trim($initLevel);
    }
    
    /**
     * Creates an instance of LanguageExperience.
     * @param int $id The I.D. of the experience.
     * @param string $name The name of the experience.
     * @param int $initLevel The initial level that corresponds to the experience.
     */
    public function LanguageExperience($id = 0, $name = '', $initLevel = 0)
    {
        $this->SetId($id);
        $this->SetName($name);
        $this->SetInitLevel($initLevel);
    }
    
    /**
     * Initializes the language experience.
     * @param array $row The collection of language experience information.
     */
    public function Initialize($row)
    {
        $idKey = $this->GetIdKey();
        $nameKey = $this->GetNameKey();
        $initLevelKey = $this->GetInitLevelKey();
        
        if (isset($row[$idKey]))
        {
            $id = $row[$idKey];
            
            $this->SetId($id);
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
     * Gets the index identifier of the I.D.
     * @return string The index identifier.
     */
    public function GetIdKey()
    {
        return 'ExperienceID';
    }
    
    /**
     * Gets the index identifier for the Name.
     * @return string The index identifier.
     */
    public function GetNameKey()
    {
        return 'Name';
    }
    
    /**
     * Gets the index identifier for the initial level.
     * @return string The index identifier.
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
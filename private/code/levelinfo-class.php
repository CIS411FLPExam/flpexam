<?php
require_once(VALIDATIONINFOCLASS_FILE);

/**
 * The level info class.
 */
class LevelInfo
{
    /**
     * The level.
     * @var int
     */
    private $level;
    
    /**
     * The I.D. of the language the level is for.
     * @var int 
     */
    private $languageID;
    
    /**
     * The name of the level.
     * @var string 
     */
    private $name;
    
    /**
     * The name of the class that corresponds to the level.
     * @var string 
     */
    private $class;
    
    /**
     * A description of the level.
     * @var string 
     */
    private $description;
    
    /**
     * Gets the level.
     * @return int The level.
     */
    public function GetLevel()
    {
        return $this->level;
    }
    
    /**
     * Sets the level.
     * @param int $level The level.
     */
    public function SetLevel($level)
    {
        $this->level = $level;
    }
    
    /**
     * Gets the language I.D.
     * @return int The I.D. of the language.
     */
    public function GetLanguageId()
    {
        return $this->languageID;
    }
    
    /**
     * Sets the language I.D.
     * @param int $languageID The I.D. of the language.
     */
    public function SetLanguageId($languageID)
    {
        $this->languageID = $languageID;
    }
    
    /**
     * Gets the name.
     * @return string The name.
     */
    public function GetName()
    {
        return $this->name;
    }
    
    /**
     * Sets the name.
     * @param string $name The name.
     */
    public function SetName($name)
    {
        $this->name = $name;
    }
    
    /**
     * Gets the class.
     * @return string The class.
     */
    public function GetClass()
    {
        return $this->class;
    }
    
    /**
     * Sets the class.
     * @param string $class The class.
     */
    public function SetClass($class)
    {
        $this->class = $class;
    }
    
    /**
     * Gets the description.
     * @return string The description.
     */
    public function GetDescription()
    {
        return $this->description;
    }
    
    /**
     * Sets the description.
     * @param string $description The description.
     */
    public function SetDescription($description)
    {
        $this->description = $description;
    }
    
    /**
     * Creates an instance of a LevelInfo.
     * @param int $level The level.
     * @param int $languageID The language I.D.
     * @param string $name The name.
     * @param string $class The class.
     * @param string $description The description.
     */
    public function LevelInfo($level = 0, $languageID = 0, $name = '', $class = '', $description = '')
    {
        $this->SetLevel($level);
        $this->SetLanguageId($languageID);
        $this->SetName($name);
        $this->SetClass($class);
        $this->SetDescription($description);
    }
    
    /**
     * Initializes the level info.
     * @param array $row The array of level info data.
     */
    public function Initialize($row)
    {
        $levelKey = $this->GetLevelKey();
        $languageIdKey = $this->GetLanguageIdKey();
        $nameKey = $this->GetNameKey();
        $classKey = $this->GetClassKey();
        $descriptionKey = $this->GetDescriptionKey();
        
        if (isset($row[$levelKey]))
        {
            $level = $row[$levelKey];
            
            $this->SetLevel($level);
        }
        
        if (isset($row[$languageIdKey]))
        {
            $languageID = $row[$languageIdKey];
            
            $this->SetLanguageId($languageID);
        }
        
        if (isset($row[$nameKey]))
        {
            $name = $this->GetName();
            
            $this->SetName($name);
        }
        
        if (isset($row[$classKey]))
        {
            $class = $this->GetClass();
            
            $this->SetClass($class);
        }
        
        if (isset($row[$descriptionKey]))
        {
            $description = $this->GetDescription();
            
            $this->SetDescription($description);
        }
    }
    
    /**
     * Gets the level key index.
     * @return string The key index.
     */
    public function GetLevelKey()
    {
        return 'Level';
    }
    
    /**
     * Gets the language I.D. key index.
     * @return string The key index.
     */
    public function GetLanguageIdKey()
    {
        return LANGUAGEID_IDENTIFIER;
    }
    
    /**
     * Gets the name key index.
     * @return string The key index.
     */
    public function GetNameKey()
    {
        return 'Name';
    }
    
    /**
     * Gets the class key index.
     * @return string The key index.
     */
    public function GetClassKey()
    {
        return 'Class';
    }
    
    /**
     * Gets the description key index.
     * @return string The key index.
     */
    public function GetDescriptionKey()
    {
        return 'Description';
    }
    
    /**
     * Validates the level field.
     * @return \ValidationInfo The validation info.
     */
    protected function ValidateLevel()
    {
        $valid = TRUE;
        $errors = array();
        
        $level = $this->GetLevel();
        
        if (!is_numeric($level) || (string)(int)$level != $level)
        {
            $valid = FALSE;
            $errors[] = 'Level must be an integer.';
        }
        
        $vi = new ValidationInfo($valid, $errors);
        
        return $vi;
    }
    
    /**
     * Validates the language I.D. field.
     * @return \ValidationInfo The validation info.
     */
    protected function ValidateLanguageId()
    {
        $valid = TRUE;
        $errors = array();
        
        $languageID = $this->GetLanguageId();
        
        if ((string)(int)$languageID != $languageID && !is_int($languageID))
        {
            $valid = FALSE;
            $errors[] = 'The language I.D. must be an integer.';
        }
        
        $vi = new ValidationInfo($valid, $errors);
        
        return $vi;
    }
    
    /**
     * Validates the name field.
     * @return \ValidationInfo The validation info.
     */
    protected function ValidateName()
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
     * Validates the class field.
     * @return \ValidationInfo The validation info.
     */
    protected function ValidateClass()
    {
        $valid = TRUE;
        $errors = array();
        
        $class = $this->GetClass();
        
        if (empty($class))
        {
            $valid = FALSE;
            $errors[] = 'Class cannot be blank.';
        }
        else
        {
            if (strlen($class) > 32)
            {
                $valid = FALSE;
                $errors[] = 'The class name is too long.';
            }
        }
        
        $vi = new ValidationInfo($valid, $errors);
        
        return $vi;
    }
    
    /**
     * Validates the description field.
     * @return \ValidationInfo The validation info.
     */
    protected function ValidateDescription()
    {
        $valid = TRUE;
        $errors = array();
        
        $vi = new ValidationInfo($valid, $errors);
        
        return $vi;
    }
    
    /**
     * Validates the level info.
     * @return \ValidationInfo The validation info.
     */
    public function Validate()
    {
        $vi = new ValidationInfo();
        
        $vi->Merge($this->ValidateLevel());
        $vi->Merge($this->ValidateLanguageId());
        $vi->Merge($this->ValidateName());
        $vi->Merge($this->ValidateClass());
        $vi->Merge($this->ValidateDescription());
        
        return $vi;
    }
}
?>
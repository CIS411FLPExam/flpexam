<?php
require_once(VALIDATIONINFOCLASS_FILE);

/**
 * The level info class.
 */
class LevelInfo
{
    /**
     * The I.D. of the level information.
     * @var int 
     */
    private $id;
    
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
    private $course;
    
    /**
     * A description of the level.
     * @var string 
     */
    private $description;
    
    /**
     * Gets the I.D.
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
        $this->id = trim($id);
    }
    
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
        $this->level = trim($level);
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
        $this->languageID = trim($languageID);
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
        $this->name = trim($name);
    }
    
    /**
     * Gets the course.
     * @return string The course.
     */
    public function GetCourse()
    {
        return $this->course;
    }
    
    /**
     * Sets the course.
     * @param string $course The course.
     */
    public function SetCourse($course)
    {
        $this->course = trim($course);
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
        $this->description = trim($description);
    }
    
    /**
     * Creates an instance of a LevelInfo.
     * @param int $id The I.D.
     * @param int $level The level.
     * @param int $languageID The language I.D.
     * @param string $name The name.
     * @param string $class The class.
     * @param string $description The description.
     */
    public function LevelInfo($id = 0, $level = 1, $languageID = 0, $name = '', $class = '', $description = '')
    {
        $this->SetId($id);
        $this->SetLevel($level);
        $this->SetLanguageId($languageID);
        $this->SetName($name);
        $this->SetCourse($class);
        $this->SetDescription($description);
    }
    
    /**
     * Initializes the level info.
     * @param array $row The array of level info data.
     */
    public function Initialize($row)
    {
        $idKey = $this->GetIdKey();
        $levelKey = $this->GetLevelKey();
        $languageIdKey = $this->GetLanguageIdKey();
        $nameKey = $this->GetNameKey();
        $classKey = $this->GetCourseKey();
        $descriptionKey = $this->GetDescriptionKey();
        
        if (isset($row[$idKey]))
        {
            $id = $row[$idKey];
            
            $this->SetId($id);
        }
        
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
            $name = $row[$nameKey];
            
            $this->SetName($name);
            
        }
        
        if (isset($row[$classKey]))
        {
            $class = $row[$classKey];
            
            $this->SetCourse($class);
        }
        
        if (isset($row[$descriptionKey]))
        {
            $description = $row[$descriptionKey];
            
            $this->SetDescription($description);
        }
    }
    
    /**
     * Gets the I.D. key index.
     * @return string The key index.
     */
    public function GetIdKey()
    {
        return 'LevelInfoID';
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
    public function GetCourseKey()
    {
        return 'Course';
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
        
        $class = $this->GetCourse();
        
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
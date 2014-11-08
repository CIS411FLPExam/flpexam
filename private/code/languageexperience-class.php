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
     * Creates an instance of LanguageExperience.
     * @param int $id The I.D. of the experience.
     * @param string $name The name of the experience.
     */
    public function LanguageExperience($id = 0, $name = '')
    {
        $this->SetId($id);
        $this->SetName($name);
    }
    
    /**
     * Initializes the language experience.
     * @param array $row The collection of language experience information.
     */
    public function Initialize($row)
    {
        $idKey = $this->GetIdKey();
        $nameKey = $this->GetNameKey();
        
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
     * Validates the language experience.
     * @return \ValidationInfo The validation info.
     */
    public function Validate()
    {
        $vi = new ValidationInfo();
        
        $vi->Merge($this->ValidateName());
        
        return $vi;
    }
}
?>
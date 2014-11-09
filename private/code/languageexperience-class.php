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
     * A description of the language experience.
     * @var string
     */
    private $description;
    
    /**
     * The options that correspond this language experience.
     * @var array 
     */
    private $options;
    
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
     * Gets the description of the language experience.
     * @return string The description.
     */
    public function GetDescription()
    {
        return $this->description;
    }
    
    /**
     * Sets the description of the language experience.
     * @param string $description The description.
     */
    public function SetDescription($description)
    {
        $this->description = trim($description);
    }
    
    /**
     * Gets the collection of options.
     * @return array The collection of options.
     */
    public function GetOptions()
    {
        return $this->options;
    }
    
    /**
     * Sets the collection of options.
     * @param array $options The collection of options.
     */
    public function SetOptions($options)
    {
        $this->options = $options;
    }
    
    /**
     * Creates an instance of LanguageExperience.
     * @param int $id The I.D. of the experience.
     * @param string $name The name of the experience.
     * @param string $description A description of the experience.
     * @param array $options The collection of options.
     */
    public function LanguageExperience($id = 0, $name = '', $description = '', $options = array())
    {
        $this->SetId($id);
        $this->SetName($name);
        $this->SetDescription($description);
        $this->SetOptions($options);
    }
    
    /**
     * Initializes the language experience.
     * @param array $row The collection of language experience information.
     */
    public function Initialize($row)
    {
        $idKey = $this->GetIdKey();
        $nameKey = $this->GetNameKey();
        $descKey = $this->GetDescriptionKey();
        
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
        
        if (isset($row[$descKey]))
        {
            $desc = $row[$descKey];
            $this->SetDescription($desc);
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
     * Gets the index identifier for the Description.
     * @return string The index identifier.
     */
    public function GetDescriptionKey()
    {
        return 'Description';
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
            
            if (strpos($name, "_") !== FALSE)
            {
                $valid = FALSE;
                $errors[] = 'The name cannot contain any "_".';
            }
        }
        
        $vi = new ValidationInfo($valid, $errors);
        
        return $vi;
    }
    
    /**
     * Validates the description of the experience.
     * @return \ValidationInfo The validation info.
     */
    public function ValidateDescription()
    {
        $valid = TRUE;
        $errors = array();
        
        $desc = $this->GetDescription();
        
        if (empty($desc))
        {
            $valid = FALSE;
            $errors[] = 'The description cannot be blank.';
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
    
    /**
     * Adds an option to the language experience.
     * @param ExperienceOption $option The option to add.
     */
    public function AddOption(ExperienceOption $option)
    {
        $options = $this->GetOptions();
        
        $options[] = $option;
        
        $this->SetOptions($options);
    }
}
?>
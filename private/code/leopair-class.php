<?php
require_once(GetValidationInfoClassFile());

/**
 * The language experience option pair class.
 */
class LEOPair
{
    /**
     * The unique I.D. of the pair.
     * @var int
     */
    private $id;
    
    /**
     * The name of the language experience.
     * @var string
     */
    private $experienceName;
    
    /**
     * The name of the experience option.
     * @var string
     */
    private $optionName;
    
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
        $this->id = $id;
    }
    
    /**
     * Gets the language experience name.
     * @return string The name.
     */
    public function GetExperienceName()
    {
        return $this->experienceName;
    }
    
    /**
     * Sets the language experience name.
     * @param string $experienceName The name.
     */
    public function SetExperienceName($experienceName)
    {
        $this->experienceName = trim($experienceName);
    }
    
    /**
     * Gets the langauge experience option name.
     * @return string The name.
     */
    public function GetOptionName()
    {
        return $this->optionName;
    }
    
    /**
     * Sets the language experience option name.
     * @param string $optionName The name.
     */
    public function SetOptionName($optionName)
    {
        $this->optionName = trim($optionName);
    }
    
    /**
     * Creates an instance of a LEOPair.
     * @param int $id The I.D.
     * @param string $experienceName The name of the language experience.
     * @param string $optionName The name of the experience option.
     */
    public function LEOPair($id = 0, $experienceName = '', $optionName = '')
    {
        $this->SetId($id);
        $this->SetExperienceName($experienceName);
        $this->SetOptionName($optionName);
    }
    
    /**
     * Initializes the LEOPair given a collection of data.
     * @param array $row The collection of data.
     */
    public function Initialize($row)
    {
        $experienceNameKey = $this->GetExperienceNameKey();
        $optionNameKey = $this->GetOptionNameKey();
        
        if (isset($row[$experienceNameKey]))
        {
            $experienceName = $row[$experienceNameKey];
            $this->SetExperienceName($experienceName);
        }
        
        if (isset($row[$optionNameKey]))
        {
            $optionName = $row[$optionNameKey];
            $this->SetOptionName($optionName);
        }
    }
    
    /**
     * Gets the key of the LEOPair that is specific to this object.
     * @return string The key.
     */
    public function GetLEOPairKey()
    {
        $name = $this->GetExperienceName();
        $signature = $this->GetLEOPairSignature();
        
        $key = $signature . preg_replace('/\s+/', '_', $name);
        
        return $key;
    }
    
    /**
     * Gets the signature of an LEOPair.
     * @return string The signature.
     */
    public function GetLEOPairSignature()
    {
        return 'LEOPair';
    }
    
    /**
     * Validates the experience name.
     * @return \ValidationInfo The validation info.
     */
    public function ValidateExperienceName()
    {
        $valid = TRUE;
        $errors = array();
        
        $name = $this->GetExperienceName();
        
        if (empty($name))
        {
            $valid = FALSE;
            $errors[] = 'The language experience name cannot be blank.';
        }
        else
        {
            if (strlen($name) > 32)
            {
                $valid = FALSE;
                $errors[] = 'The language experience name is too long.';
            }
        }
        
        $vi = new ValidationInfo($valid, $errors);
        
        return $vi;
    }
    
    /**
     * Validates the option name.
     * @return \ValidationInfo The validation info.
     */
    public function ValidateOptionName()
    {
        $valid = TRUE;
        $errors = array();
        
        $name = $this->GetOptionName();
        
        if (!empty($name))
        {
            if (strlen($name) > 32)
            {
                $valid = FALSE;
                $errors[] = 'The experience option name is too long.';
            }
        }
        
        $vi = new ValidationInfo($valid, $errors);
        
        return $vi;
    }
    
    /**
     * Validates the LEOPair.
     * @return \ValidationInfo The validation info.
     */
    public function Validate()
    {
        $vi = new ValidationInfo();
        
        $vi->Merge($this->ValidateExperienceName());
        $vi->Merge($this->ValidateOptionName());
        
        return $vi;
    }
    
    /**
     * The experience name key.
     * @return string The key.
     */
    public function GetExperienceNameKey()
    {
        return 'Experience';
    }
    
    /**
     * The option name key.
     * @return string The key.
     */
    public function GetOptionNameKey()
    {
        return 'ExperienceOption';
    }
}
?>
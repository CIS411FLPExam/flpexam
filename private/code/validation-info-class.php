<?php

/**
 * Holds information about a validation.
 */
class ValidationInfo
{
    /**
     * The flag that indicates whether or not there were errors.
     * @var boolean 
     */
    private $valid;
    
    /**
     * The collection of errors that were recorded.
     * @var array 
     */
    private $errors;
    
    /**
     * Gets the valid data member.
     * @return boolean True if valid, or false otherwise.
     */
    public function GetValid()
    {
        return $this->valid;
    }
    
    /**
     * Sets the valid data member.
     * @param boolean $valid The value to set valid to.
     */
    public function SetValid($valid)
    {
        $this->valid = $valid;
    }
    
    /**
     * Gets errors data member.
     * @return array The collection of recorded errors.
     */
    public function GetErrors()
    {
        return $this->errors;
    }
    
    /**
     * Sets the errors data member.
     * @param array $errors The collection of recorded errors.
     */
    public function SetErrors($errors)
    {
        $this->errors = $errors;
    }
    
    /**
     * Creates an instance of ValidationInfo.
     * @param boolean $valid A flag to indicate whether or not there are errors.
     * @param array $errors A collection of string errors.
     */
    public function ValidationInfo($valid = TRUE, $errors = array())
    {
        $this->SetErrors($errors);
        $this->SetValid($valid);
    }
    
    /**
     * Indicates whether or not the there are errors.
     * @return boolean True if valid, or false otherwise.
     */
    public function IsValid()
    {
        $valid = $this->GetValid();
        
        return $valid;
    }
    
    /**
     * Merges this validation info with another.
     * @param ValidationInfo $vi The other validation info.
     */
    public function Merge(ValidationInfo $vi)
    {
        $valid = $this->IsValid() && $vi->IsValid();
        $errors = array_merge($this->GetErrors(), $vi->GetErrors());
        
        $this->SetValid($valid);
        $this->SetErrors($errors);
    }
}
?>
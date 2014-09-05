<?php

class ValidationInfo
{
    private $valid;
    
    private $errors;
    
    public function GetValid()
    {
        return $this->valid;
    }
    
    public function SetValid($valid)
    {
        $this->valid = $valid;
    }
    
    public function GetErrors()
    {
        return $this->errors;
    }
    
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
     * @return boolean
     */
    public function IsValid()
    {
        $valid = $this->GetValid();
        
        return $valid;
    }
}
?>
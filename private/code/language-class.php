<?php

/**
 * The class that represents a language.
 */
class Language
{
    /**
     * The I.D. of the language.
     * @var int 
     */
    private $id;
    
    /**
     * The name of the language.
     * @var string 
     */
    private $name;
    
    /**
     * The flag that indicates whether or not the language is active.
     * @var boolean 
     */
    private $active;
    
    /**
     * The flag that indicates whether or not the language is accepting feedback.
     * @var boolean 
     */
    private $feedback;
    
    /**
     * Gets the I.D. of the language.
     * @return int The I.D.
     */
    public function GetId()
    {
        return $this->id;
    }
    
    /**
     * Sets the I.D. of the language.
     * @param int $id The I.D.
     */
    public function SetId($id)
    {
        $this->id = trim($id);
    }
    
    /**
     * Gets the name of the language.
     * @return string The name.
     */
    public function GetName()
    {
        return $this->name;
    }
    
    /**
     * Sets the name of the language.
     * @param string $name The name.
     */
    public function SetName($name)
    {
        $this->name = trim($name);
    }
    
    /**
     * Gets the flag that indicates whether or not this language is active.
     * @return boolean True, if the language is active, or false otherwise.
     */
    public function GetActive()
    {
        return $this->active;
    }
    
    /**
     * Sets the flag that indicates whether or not this language is active.
     * @param boolean $active True, if the language is active, or false otherwise.
     */
    public function SetActive($active)
    {
        $this->active = $active;
    }
    
    /**
     * Gets the flag that indicates whether or not the language is accepting feedback.
     * @return boolean True, if the language is accepting feedback.
     */
    public function GetFeedback()
    {
        return $this->feedback;
    }
    
    /**
     * Sets the flag that indicates whether or not the language is accepting feedback.
     * @param boolean $feedback True, if the language is accepting feedback, or false otherwise.
     */
    public function SetFeedback($feedback)
    {
        $this->feedback = $feedback;
    }
    /**
     * Creates an instance of a language.
     * @param int $id The I.D. of the langauge.
     * @param string $name The name of the language.
     * @param boolean $active The flag that indicates whether or not the language is active.
     * @param boolean $feedback The flag that indicates whether or not the language is accepting feedback.
     */
    public function Language($id = 0, $name = '', $active = FALSE, $feedback = FALSE)
    {
        $this->SetId($id);
        $this->SetName($name);
        $this->SetActive($active);
        $this->SetFeedback($feedback);
    }
    
    /**
     * Initializes the language using its collection of data.
     * @param array $row The collection.
     */
    public function Initialze($row)
    {
        $idKey = $this->GetIdKey();
        $nameKey = $this->GetNameKey();
        $activeKey = $this->GetActiveKey();
        $feedbackKey = $this->GetFeedbackKey();
        
        if (isset($row[$idKey]))
        {
            $id = (int)$row[$idKey];
            
            $this->SetId($id);
        }
        
        if (isset($row[$nameKey]))
        {
            $name = (string)$row[$nameKey];
            
            $this->SetName($name);
        }
        
        if (isset($row[$activeKey]))
        {
            $active = (boolean)$row[$activeKey];
            
            $this->SetActive($active);
        }
        
        if (isset($row[$feedbackKey]))
        {
            $feedback = (boolean)$row[$feedbackKey];
            
            $this->SetFeedback($feedback);
        }
    }
    
    /**
     * Gets the index key used to access the language's I.D..
     * @return string The key.
     */
    public function GetIdKey()
    {
        return 'LanguageID';
    }
    
    /**
     * Gets the index key used to access the language's name.
     * @return string The key.
     */
    public function GetNameKey()
    {
        return 'Name';
    }
    
    /**
     * Gets the index key used to access the language's active flag.
     * @return string The key.
     */
    public function GetActiveKey()
    {
        return 'Active';
    }
    
    /**
     * Gets the index key used to access the languages feedback flag.
     * @return string The key.
     */
    public function GetFeedbackKey()
    {
        return 'Feedback';
    }
    
    /**
     * Indicates whether or not the language is active.
     * @return boolean True, if the language is active, or false otherwise.
     */
    public function IsActive()
    {
        $isActive = $this->GetActive();
        
        return $isActive;
    }
    
    /**
     * Indicates whether or not the language is accepting feedback.
     * @return boolean True, if the language is accepting feedback.
     */
    public function IsAcceptingFeedback()
    {
        $isAcceptingFeedback = $this->GetFeedback();
        
        return $isAcceptingFeedback;
    }
}
?>
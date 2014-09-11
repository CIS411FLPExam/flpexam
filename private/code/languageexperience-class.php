<?php

/**
 * A language experience.
 */
class LanguageExperience
{
    /**
     * The unique I.D. of the language experience.
     * @var int
     */
    private $id;
    
    /**
     * The name of the experience.
     * @var string 
     */
    private $name;
    
    /**
     * Gets the language experience's I.D.
     * @return int The unique I.D.
     */
    public function GetID()
    {
        return $this->id;
    }
    
    /**
     * Sets the I.D. of the language experience
     * @param int $id The Unique I.D.
     */
    public function SetID($id)
    {
        $this->id = $id;
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
        $this->name = $name;
    }
    
    /**
     * Creates an instance of a LanguageExperience.
     * @param int $id The unique I.D. of the language experience.
     * @param string $name The name of the language experience.
     */
    public function LanguageExperience($id = 0, $name = '')
    {
        $this->SetID($id);
        $this->SetName($name);
    }
}
?>
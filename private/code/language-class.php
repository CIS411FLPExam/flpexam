<?php

/**
 * A language.
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
     * The flag that indicates whether or not the langauge is active.
     * @var boolean 
     */
    private $active;
    
    /**
     * Gets the I.D. of the language.
     * @return int
     */
    public function GetID()
    {
        return $this->id;
    }
    
    /**
     * Sets the I.D. of the language.
     * @param int $id The I.D.
     */
    public function SetID($id)
    {
        $this->id = $id;
    }
    
    /**
     * Gets the name of the language.
     * @return string The name of the language.
     */
    public function GetName()
    {
        return $this->name;
    }
    
    /**
     * Sets the name of the language.
     * @param string $name The name of the language.
     */
    public function SetName($name)
    {
        $this->name = $name;
    }
    
    /**
     * Gets the flag that indicates whether or not this language is active.
     * @return boolean True, if the language is active.
     */
    public function GetActive()
    {
        return $this->active;
    }
    
    /**
     * Sets the flag that indicates whether or not this language is active.
     * @param boolean $active The flag that indicates whether or not this langauge is active.
     */
    public function SetActive($active)
    {
        $this->active = $active;
    }
    
    /**
     * Creates an instance of a Language.
     * @param int $id The I.D. of the language.
     * @param string $name The name of the language.
     * @param boolean $active The flag that indicates whether or not this langauge is active.
     */
    public function Language($id = 0, $name = '', $active = FALSE)
    {
        $this->SetID($id);
        $this->SetName($name);
        $this->SetActive($active);
    }
}
?>
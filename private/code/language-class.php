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
        $this->id = $id;
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
        $this->name = $name;
    }
    
    /**
     * Creates an instance of a language.
     * @param int $id The I.D. of the langauge.
     * @param string $name The name of the language.
     */
    public function Language($id = 0 ,$name = '')
    {
        $this->SetId($id);
        $this->SetName($name);
    }
}
?>
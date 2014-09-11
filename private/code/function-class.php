<?php
/**
 * A function.
 */
class Func
{
    /**
     * The unique I.D. of the function.
     * @var int 
     */
    private $id;
    
    /**
     * The name of the function.
     * @var string 
     */
    private $name;
    
    /**
     * A description of the function.
     * @var string 
     */
    private $description;
    
    /**
     * Gets the unique I.D. of the function.
     * @return int The I.D.
     */
    public function GetID()
    {
        return $this->id;
    }
    
    /**
     * Sets the unique I.D. of the function.
     * @param int $id The I.D. of the function.
     */
    public function SetID($id)
    {
        $this->id = $id;
    }
    
    /**
     * Gets the name of the function.
     * @return string The name of the function.
     */
    public function GetName()
    {
        return $this->name;
    }
    
    /**
     * Sets the name of the function.
     * @param string $name The name of the function.
     */
    public function SetName($name)
    {
        $this->name = $name;
    }
    
    /**
     * Gets the description of the function.
     * @return string The description.
     */
    public function GetDescription()
    {
        return $this->description;
    }
    
    /**
     * Sets the function's description.
     * @param string $description The description.
     */
    public function SetDescription($description)
    {
        $this->description = $description;
    }
    
    /**
     * Creates an instance of a Func
     * @param int $id The I.D. of the function.
     * @param string $name The name of the function.
     * @param string $description A description of the function.
     */
    function Func($id = 0, $name = '', $description = '')
    {
        $this->SetID($id);
        $this->SetName($name);
        $this->SetDescription($description);
    }
}

?>
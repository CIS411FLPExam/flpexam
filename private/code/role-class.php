<?php
/**
 * A role.
 */
class Role
{
    /**
     * The unique I.D. of the role.
     * @var int 
     */
    private $id;
    
    /**
     * The name of the role.
     * @var string 
     */
    private $name;
    
    /**
     * A description of the role.
     * @var string 
     */
    private $description;
    
    /**
     * Gets the unique I.D. of the role.
     * @return int The I.D.
     */
    public function GetID()
    {
        return $this->id;
    }
    
    /**
     * Sets the unique I.D. of the role.
     * @param int $id The I.D. of the role.
     */
    public function SetID($id)
    {
        $this->id = $id;
    }
    
    /**
     * Gets the name of the role.
     * @return string The name of the role.
     */
    public function GetName()
    {
        return $this->name;
    }
    
    /**
     * Sets the name of the role.
     * @param string $name The name of the role.
     */
    public function SetName($name)
    {
        $this->name = $name;
    }
    
    /**
     * Gets the description of the role.
     * @return string The description.
     */
    public function GetDescription()
    {
        return $this->description;
    }
    
    /**
     * Sets the role's description.
     * @param string $description The description.
     */
    public function SetDescription($description)
    {
        $this->description = $description;
    }
    
    /**
     * Creates an instance of a Role
     * @param int $id The I.D. of the role.
     * @param string $name The name of the role.
     * @param string $description A description of the role.
     */
    function Role($id = 0, $name = '', $description = '')
    {
        $this->SetID($id);
        $this->SetName($name);
        $this->SetDescription($description);
    }
}
?>
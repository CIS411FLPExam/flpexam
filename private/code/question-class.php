<?php

/**
 * A question.
 */
class Question
{
    /**
     * The I.D. of the question.
     * @var int
     */
    private $id;
    
    /**
     * The difficulty level of the question.
     * @var int 
     */
    private $level;
    
    /**
     * The name of the question.
     * @var string
     */
    private $name;
    
    /**
     * Gets the I.D. of the question.
     * @return int The I.D.
     */
    public function GetID()
    {
        return $this->id;
    }
    
    /**
     * Sets the I.D. of the question.
     * @param int $id The I.D.
     */
    public function SetID($id)
    {
        $this->id = $id;
    }
    
    /**
     * Gets the difficulty level of the question.
     * @return int The difficulty level.
     */
    public function GetLevel()
    {
        return $this->level;
    }
    
    /**
     * Sets the difficulty level of the question.
     * @param int $level The difficulty level.
     */
    public function SetLevel($level)
    {
        $this->level = $level;
    }
    
    /**
     * Gets the name of the question.
     * @return strin The name.
     */
    public function GetName()
    {
        return $this->name;
    }
    
    /**
     * Sets the name of the question.
     * @param string $name The name.
     */
    public function SetName($name)
    {
        $this->name = $name;
    }
    
    /**
     * Creates an instance of a Question.
     * @param int $id The I.D. of the question.
     * @param int $level The difficulty level of the question.
     * @param int $name The name of the question.
     */
    public function Question($id = 0, $level = 0, $name = '')
    {
        $this->SetID($id);
        $this->SetLevel($level);
        $this->SetName($name);
    }
}
?>
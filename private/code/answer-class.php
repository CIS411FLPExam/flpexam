<?php
/**
 * An answer.
 */
class Answer
{
    /**
     * The answer's unique I.D.
     * @var int 
     */
    private $id;
    
    /**
     * The I.D. of the question this answer belongs to.
     * @var int 
     */
    private $questionID;
    
    /**
     * The flag that indicates whether or not this answer is to the question.
     * @var boolean 
     */
    private $correct;
    
    /**
     * The name of the answer.
     * @var string 
     */
    private $name;
    
    /**
     * Gets the unique I.D. of the answer.
     * @return int The I.D.
     */
    public function GetID()
    {
        return $this->id;
    }
    
    /**
     * Sets the unique I.D. of the answer.
     * @param int $id The I.D. to use for this answer.
     */
    public function SetID($id)
    {
        $this->id = $id;
    }
    
    /**
     * Gets the I.D. of the question this answer belongs to.
     * @return int The I.D. of the question.
     */
    public function GetQuestionID()
    {
        return $this->questionID;
    }
    
    /**
     * Sets the I.D. of the question that this answer belongs to.
     * @param int $questionID The I.D. of the question.
     */
    public function SetQuestionID($questionID)
    {
        $this->questionID = $questionID;
    }
    
    /**
     * Gets the flag that indicates whether or not this is the correct answer.
     * @return boolean True, if this answer is the correct answer.
     */
    public function GetCorrect()
    {
        return $this->correct;
    }
    
    /**
     * Sets the flag that indicates whether or not this answer is the correct one.
     * @param boolean $correct The flag that indicates whether this answer is correct.
     */
    public function SetCorrect($correct)
    {
        $this->correct = $correct;
    }
    
    /**
     * Gets the name of this answer.
     * @return string The name of the answer.
     */
    public function GetName()
    {
        return $this->name;
    }
    
    /**
     * Sets the name of this answer.
     * @param string $name The name to use for this answer.
     */
    public function SetName($name)
    {
        $this->name = $name;
    }
    
    /**
     * Creates an instance of an Answer
     * @param int $id The unique I.D. of the answer.
     * @param int $questionID The I.D. of the question this answer belongs to.
     * @param int $correct The flag indicating whether or not this answer is the correct one.
     * @param string $name The name of the answer.
     */
    public function Answer($id = 0, $questionID = 0, $correct = FALSE, $name = '')
    {
        $this->SetID($id);
        $this->SetQuestionID($questionID);
        $this->SetCorrect($correct);
        $this->SetName($name);
    }
}
?>
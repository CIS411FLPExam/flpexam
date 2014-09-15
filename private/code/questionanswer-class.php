<?php

/**
 * The question answer class.
 */
class QuestionAnswer
{
    /**
     * The I.D. of the question.
     * @var int 
     */
    private $questionId;
    
    /**
     * The I.D. of the question.
     * @var int 
     */
    private $answerId;
    
    /**
     * Gets the I.D. of the question.
     * @return int The I.D. of the question.
     */
    public function GetQuestionId()
    {
        return $this->questionId;
    }
    
    /**
     * Sets the I.D. of the question.
     * @param int $questionId The I.D. of the question.
     */
    public function SetQuestionId($questionId)
    {
        $this->questionId = $questionId;
    }
    
    /**
     * Gets the I.D. of the answer.
     * @return int The I.D. of the answer.
     */
    public function GetAnswerId()
    {
        return $this->answerId;
    }
    
    /**
     * Sets the I.D. of the answer.
     * @param int $answerId The I.D. of the answer.
     */
    public function SetAnswerId($answerId)
    {
        $this->answerId = $answerId;
    }
    
    /**
     * Creates an instance of QuestionAnswer.
     * @param int $questionId The I.D. of the question.
     * @param int $answerId The I.D. of the answer.
     */
    public function QuestionAnswer($questionId = 0, $answerId = 0)
    {
        $this->SetQuestionId($questionId);
        $this->SetAnswerId($answerId);
    }
    
    /**
     * Indicates whether or not the question I.D. has been set.
     * @return boolean True, if the question I.D. has been set.
     */
    public function IsQuestionIdSet()
    {
        $questionId = $this->GetQuestionId();
        
        $isSet = $questionId > 0;
        
        return $isSet;
    }
    
    /**
     * Indicates whether or not the answer I.D. has been set.
     * @return boolean True, if the answer I.D. has been set.
     */
    public function IsAnswerIdSet()
    {
        $answerId = $this->GetAnswerId();
        
        $isSet = $answerId > 0;
        
        return $isSet;
    }
}
?>
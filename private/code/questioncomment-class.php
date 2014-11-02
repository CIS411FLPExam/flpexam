<?php
require_once(VALIDATIONINFOCLASS_FILE);

/**
 * The question comment class.
 */
class QuestionComment
{
    /**
     * The unique identifier of the question comment.
     * @var int 
     */
    private $id;
    
    /**
     * The unique identifier of the question the comment is for.
     * @var int 
     */
    private $questionID;
    
    /**
     * The actual comment.
     * @var string
     */
    private $comment;
    
    /**
     * Gets the unique identifier of the question comment.
     * @return int The I.D.
     */
    public function GetId()
    {
        return $this->id;
    }
    
    /**
     * Sets the unique identifier of the question comment.
     * @param int $id The I.D.
     */
    public function SetId($id)
    {
        $this->id = $id;
    }
    
    /**
     * Gets the I.D. of the question this comment is for.
     * @return int The I.D.
     */
    public function GetQuestionId()
    {
        return $this->questionID;
    }
    
    /**
     * Sets the I.D. of the question this comment is for.
     * @param int $questionID The I.D.
     */
    public function SetQuestionId($questionID)
    {
        $this->questionID = $questionID;
    }
    
    /**
     * Gets the actual comment for the question.
     * @return string The comment.
     */
    public function GetComment()
    {
        return $this->comment;
    }
    
    /**
     * Sets the actual comment about the question.
     * @param string $comment The comment.
     */
    public function SetComment($comment)
    {
        $comment = trim($comment);
        
        if (strlen($comment) > 110)
        {
            $comment = substr($comment, 0, 110);
        }
        
        $this->comment = $comment;
    }
    
    /**
     * Creates an instance of a question comment.
     * @param int $id The I.D. of the question comment.
     * @param int $questionID The I.D. of the question the comment is for.
     * @param string $comment The actual comment about the question.
     */
    public function QuestionComment($id = 0, $questionID = 0, $comment = '')
    {
        $this->SetId($id);
        $this->SetQuestionId($questionID);
        $this->SetComment($comment);
    }
    
    /**
     * Initializes the question comment from a collection of data.
     * @param array $row The collection of data.
     */
    public function Initialize($row)
    {
        $idKey = $this->GetIdKey();
        $questionIdKey = $this->GetQuestionIdKey();
        $commentKey = $this->GetCommentKey();
        
        if (isset($row[$idKey]))
        {
            $id = $row[$idKey];
            $this->SetId($id);
        }
        
        if (isset($row[$questionIdKey]))
        {
            $questionID = $row[$questionIdKey];
            $this->SetQuestionId($questionID);
        }
        
        if (isset($row[$commentKey]))
        {
            $comment = $row[$commentKey];
            $this->SetComment($comment);
        }
    }
    
    /**
     * Gets the index key of the I.D.
     * @return string The index key.
     */
    public function GetIdKey()
    {
        return 'CommentID';
    }
    
    /**
     * Gets the index key of the question I.D.
     * @return string The index key.
     */
    public function GetQuestionIdKey()
    {
        return 'QuestionID';
    }
    
    /**
     * Gets the index key of the comment.
     * @return string The index key.
     */
    public function GetCommentKey()
    {
        return 'Com';
    }
    
    /**
     * Validates the comment data member.
     * @return \ValidationInfo The validation info.
     */
    protected function ValidateComment()
    {
        $valid = TRUE;
        $errors = array();
        
        $comment = $this->GetComment();
        
        if (strlen($comment) > 110)
        {
            $valid  = FALSE;
            $errors[] = 'The comment is too long.';
        }
        
        $vi = new ValidationInfo();
        
        return $vi;
    }
    
    /**
     * Validates the question comment.
     * @return \ValidationInfo The valdation info.
     */
    public function Validate()
    {
        $vi = new ValidationInfo();
        
        $vi->Merge($this->ValidateComment());
        
        return $vi;
    }
}
?>
<?php
    

    $qs = array();
    $records = explode('{', $fileConents); //Break the document down into the individual questions.
    
    foreach ($records as $record)
    {
        $qs[] = explode('|', $record); //Break down each question into its fields.
    }
    
    foreach($qs as $q)
    {
        if (count($q) > 1)
        {
            $column = 0;
            $answers = array();

            $level = trim($q[$column++]);
            $instructions = trim($q[$column++]);
            $name = trim($q[$column++]);

            while($column < count($q))
            {
                $answers[] = trim($q[$column++]);
            }
            
            if (count($answers > 0))
            {
                $answers[count($answers) - 1] = trim(str_replace('}','', $answers[count($answers) - 1]));
            }
            
            $question = array('Level' => $level, 'Instructions' => $instructions, 'Name' => $name, 'Answers' => $answers);
            $questions[] = $question;
        }
    }
    
    $count = 1;
    foreach($questions as $question) //Here, we collect each question field and do some validation.
    {
        $level = $question['Level'];
        $instructions = $question['Instructions'];
        $name = $question['Name'];
        $answers = $question['Answers'];
        
        if(!is_int($level) && (string)(int)$level != $level)
        {
            $errors[] = '(Question ' . $count . ') The level must be an integer value.';
        }
        else if ($level < 1)
        {
            $errors[] = '(Question ' . $count . ') The level must be greater than or equal to 1.';
        }
        
        if (empty($name))
        {
            $errors[] = '(Question ' . $count . ') The question cannot be blank.';
        }
        
        if(count($answers) < 1)
        {
            $errors[] = '(Question ' . $count . ') At least one answer needs to be provided.';
        }
        else
        {
            foreach ($answers as $answer)
            {
                if (strlen($answer) < 1)
                {
                    $errors[] = '(Question ' . $count . ') An answer cannot be blank.';
                    break;
                }
            }
        }
        
        $count++;
    }
?>
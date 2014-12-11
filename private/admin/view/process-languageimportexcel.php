<?php

    for ($row = 1; $row < count($list); $row++)
    {
        $csvs = $list[$row];
        
        $column = 0;
        $questionID = '';
        $level = '';
        $instructions = '';
        $quesName = '';
        $answers = array();
        
        if (isset($csvs[$column]))
        {
           $questionID = trim($csvs[$column++]);
        }
        
        if (isset($csvs[$column]))
        {
            $level = trim($csvs[$column++]);
        }
        
        if (isset($csvs[$column]))
        {
            $instructions = trim($csvs[$column++]);
        }
        
        if (isset($csvs[$column]))
        {
            $quesName = trim($csvs[$column++]);
        }
        
        while (isset($csvs[$column]))
        {
            $answer = trim($csvs[$column++]);
            
            if (!empty($answer))
            {
                $answers[] = $answer;
            }
        }
        
        if(empty($questionID))
        {
            $errors[] = 'Row "' . $row . '" Question I.D. cannont be empty.';
        }
        else if ((string)(int)$questionID != $questionID)
        {
             $errors[] = 'Row "' . $row . '" I.D. must be numeric.';
        }

        if (empty($level))
        {
            $errors[] = 'Row "' . $row . '" level cannot be empty.';
        }
        else if((string)(int)$level != $level)
        {
            $errors[] = 'Row "' . $row . '" level must be numeric.';
        }

        if (empty($quesName))
        {
            $errors[] = 'Row "' . $row . '" question cannot be empty.';
        }

        if (empty($instructions))
        {
            $errors[] = 'Row "' . $row . '" instructions cannot be empty.';
        }
        
        if (count($answers) < 1)
        {
            $errors[] = 'Row "' . $row . '" must have at least one answer.';
        }

        $questions[] = array(GetQuestionIdIdentifier() => $questionID, 'Level' => $level, 'Instructions' => $instructions, GetNameIdentifier() => $quesName, 'Answers' => $answers);
        
        $row++;
    }
?>
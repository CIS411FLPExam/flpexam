<?php
    require_once(PHPEXCELCLASS_FILE);
    
    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet)
    {
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

        for ($row = 2; $row <= $highestRow; ++$row)
        {
            $column = 0;

            $cell = $worksheet->getCellByColumnAndRow(0, $row);
            $val = $cell->getValue();
            $column1DataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
            $cell = $worksheet->getCellByColumnAndRow(1, $row);
            $val = $cell->getValue();
            $column2DataType = PHPExcel_Cell_DataType::dataTypeForValue($val);

            //Check to see if a question I.D. and a level exists.
            if($column1DataType == PHPExcel_Cell_DataType::TYPE_NUMERIC && $column2DataType == PHPExcel_Cell_DataType::TYPE_NUMERIC)
            {//If both  exists then we are doing an update.
                $questionID = $worksheet->getCellByColumnAndRow($column++, $row)->getValue();
            }
            else
            {
                $errors[] = 'Row "' . $row . '" is not formated properly (missing level and/or I.D.).';
            }
            
            if(isset($questionID))
            {
                $level = $worksheet->getCellByColumnAndRow($column++, $row)->getValue();
                $instructions = $worksheet->getCellByColumnAndRow($column++, $row)->getValue();
                $quesName = $worksheet->getCellByColumnAndRow($column++, $row)->getValue();

                if(PHPExcel_Cell_DataType::dataTypeForValue($questionID) != PHPExcel_Cell_DataType::TYPE_NUMERIC || empty(trim($questionID)))
                {
                    $errors[] = 'Row "' . $row . '" I.D. must be numeric.';
                }

                if (PHPExcel_Cell_DataType::dataTypeForValue($level) == PHPExcel_Cell_DataType::TYPE_NULL || empty(trim($level)))
                {
                    $errors[] = 'Row "' . $row . '" level cannot be empty.';
                }
                else if(PHPExcel_Cell_DataType::dataTypeForValue($level) != PHPExcel_Cell_DataType::TYPE_NUMERIC)
                {
                    $errors[] = 'Row "' . $row . '" level must be numeric.';
                }

                if (PHPExcel_Cell_DataType::dataTypeForValue($quesName) == PHPExcel_Cell_DataType::TYPE_NULL || empty(trim($quesName)))
                {
                    $errors[] = 'Row "' . $row . '" question cannot be empty.';
                }
                
                if (PHPExcel_Cell_DataType::dataTypeForValue($instructions) == PHPExcel_Cell_DataType::TYPE_NULL || empty(trim($instructions)))
                {
                    $errors[] = 'Row "' . $row . '" instructions cannot be empty.';
                }
                
                $answers = array();

                for ($col = $column; $col < $highestColumnIndex; ++$col)
                {
                    $cell = $worksheet->getCellByColumnAndRow($col, $row);
                    $answer = $cell->getValue();
                    
                    if (PHPExcel_Cell_DataType::dataTypeForValue($answer) != PHPExcel_Cell_DataType::TYPE_NULL && !empty(trim($answer)))
                    {
                        $answers[] = $answer;
                    }
                }
                
                if (count($answers) < 1)
                {
                    $errors[] = 'Row "' . $row . '" must have at least one answer.';
                }

                $questions[] = array(QUESTIONID_IDENTIFIER => $questionID, 'Level' => $level, 'Instructions' => $instructions, NAME_IDENTIFIER => $quesName, 'Answers' => $answers);
            }
            
            unset($questionID);
        }
    }
?>
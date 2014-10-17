<?php
    include( HEADER_FILE );
    include( CONTROLPANEL_FILE );
?>
<!-- Start main content here -->
<h1>Question</h1>

<div class="formGroup">   
    <div class="formSection">
        <label>Level:</label><?php echo(htmlspecialchars($level)); ?>
    </div>

    <div class="divider"></div>

    <div class="formSection">
        <label>Instructions:</label><div class="displayBox"><?php echo(htmlspecialchars($instructions)); ?></div>
        <div class="clear"></div>
    </div>

    <div class="divider"></div>

    <div class="formSection">
        <label>Question:</label><div class="displayBox"><pre><?php echo(htmlspecialchars($name)); ?></pre></div>
        <div class="clear"></div>
    </div>

    <div class="divider"></div>
    
    <?php
        $i = 1;
        foreach ($answers as $answer)
        { 
    ?>
        <div class="formSection">
            <label>Answer <?php echo(htmlspecialchars($i)); ?>:</label>
            <div class="displayBox"><?php echo(htmlspecialchars($answer[NAME_IDENTIFIER])); ?></div>
            <div class="clear"></div>
        </div>

        <div class="divider"></div>
    <?php
            $i++;
        } 
    ?>
</div>

<h2>Question Statistics</h2>

<div class="formGroup">
    <div class="formSection">
        The question has been asked
        <b>
            <?php echo(htmlspecialchars($totalTimesAnswered)); ?>
        </b>
        time(s).
    </div>
    
    <div class="divider"></div>
    
    <div class="formSection">
        The question has been answered correctly
        <b>
            <?php echo(htmlspecialchars($totalTimesAnsweredCorrectly)); ?>
        </b>
        time(s).
    </div>
    
    <?php
        $i = 1;
        foreach ($answers as $answer)
        { 
            $answerID = $answer[ANSWERID_IDENTIFIER];
    ?>
        <div class="divider"></div>
        
        <div class="formSection">
            The answer
            <b>"<?php echo(htmlspecialchars($answer[NAME_IDENTIFIER])); ?>"</b>
            has been chosen 
            <b>
                <?php
                    $found = FALSE;
                    for ($j = 0; $j < count($answerCounts) && !$found; $j++)
                    {
                        $answerCount = $answerCounts[$j];

                        if ($answerID == $answerCount[ANSWERID_IDENTIFIER])
                        {
                            $found = TRUE;
                            echo(htmlspecialchars($answerCount['Count']));
                        }
                    }
                ?>
            </b>
            time(s).
        </div>
    <?php
            $i++;
        } 
    ?>
</div>

<br />

<form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONEDIT_ACTION)); ?>" method="post">
    <input type="hidden" name="<?php echo(QUESTIONID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
    <input type="submit" value="Edit" />
</form>

<form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONADD_ACTION)); ?>" method="post">
    <input type="hidden" name="<?php echo(QUESTIONID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
    <input type="submit" value="Add New Question" />
</form>

<form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEVIEW_ACTION)); ?>" method="post">
    <input type="hidden" name="<?php echo(QUESTIONID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
    <input type="submit" value="View Language" />
</form>

<form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEQUESTIONS_ACTION)); ?>" method="post">
    <input type="hidden" name="<?php echo(QUESTIONID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
    <input type="hidden" name="Level" value="<?php echo(htmlspecialchars($level)); ?>" />
    <input type="submit" value="Manage Questions" />
</form>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<h1>Question</h1>

<div class="formGroup">
    <?php if (!empty($instructions)) { ?>
        <div class="formSection">
            <label>Instructions:</label>
            <div class="displayBox"><b><?php echo(htmlspecialchars($instructions)); ?></b></div>
            <div class="clear"></div>
        </div>
    
        <div class="divider"></div>
    <?php } ?>
    
    <div class="formSection">
        <div class="question">
            <pre class="questionText"><b><?php echo(htmlspecialchars($name)); ?></b></pre>
            <div class="clear"></div>
            <form onsubmit="return IsOneRadChecked('You must select an answer.');" action="<?php echo(GetControllerScript(EXAMCONTROLLER_FILE, SUBMITANSWER_ACTION)); ?>" method="post">
                <input type="hidden" name ="<?php echo(QUESTIONID_IDENTIFIER) ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
                <?php if (!empty($message)) { ?>
                    <span class="redText"><b><?php echo(htmlspecialchars($message)); ?></b></span>
                <?php } ?>
                <div class="formSection">
                    <?php
                        $answerOptionAsciiVal = 97;
                        for ($index = 0; $index < count($answers); $index++)
                        {
                            $answer = $answers[$index];
                    ?>
                        <input class="floatLeft" type="radio" name="<?php echo(ANSWERID_IDENTIFIER) ?>" value="<?php echo(htmlspecialchars($answer[ANSWERID_IDENTIFIER])) ?>" />
                        <span class="floatLeft">
                            <b>
                                <?php
                                    echo(chr($answerOptionAsciiVal++));
                                ?>)
                            </b>
                        </span>
                        <div class="inline floatLeft">&nbsp;</div>
                        <div class="displayBox"><?php echo(htmlspecialchars($answer[NAME_IDENTIFIER])); ?></div>
                        <div class="clear"></div>
                        <br />
                    <?php
                        }
                    ?>
                </div>

                <br />

                <input type="submit" value="Submit" />
                Is there something wrong with this question?
                <input type="checkbox" name="AmbiguousQuestion" />
                Yes
            </form>
        </div>
    </div>
    <div class="clear"></div>
</div>

<!-- End main content here -->
<?php
    include( PLAINFOOTER_FILE );
?>
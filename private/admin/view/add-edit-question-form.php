<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<?php
    if (isset($message))
    {
        include(MESSAGE_FILE);
    }
?>

<?php if (isset($questionID)) { ?>
    <h1>Edit Question</h1>
<?php } else { ?>
    <h1>Add Question</h1>
<?php } ?>

<form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, PROCESSQUESTIONADDEDIT_ACTION)); ?>" method="post">
    <?php if (isset($questionID)) { ?>
        <input type="hidden" name="<?php echo(QUESTIONID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
    <?php } else {?>
        <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo($languageID); ?>" />
    <?php } ?>
    <div class="formGroup">
        <div class="formSection">
            <label>Level<span class="redText">*</span>:</label>
            <input type="number" name="Level" value="<?php echo(htmlspecialchars($level)); ?>" autofocus required min="1" />
            <div class="clear"></div>
        </div>
        
        <div class='divider'></div>
        
        <div class="formSection">
            <label>Instructions:</label>
            <textarea name="Instructions" class='qa' rows="5" cols="70"><?php echo(htmlspecialchars($instructions)); ?></textarea>
            <div class="clear"></div>
        </div>
        
        <div class='divider'></div>
        
        <div class="formSection">
            <label>Question<span class="redText">*</span>:</label>
            <textarea name="<?php echo(NAME_IDENTIFIER); ?>" class='qa' rows="5" cols="70" required><?php echo(htmlspecialchars($name)); ?></textarea>
            <div class="clear"></div>
        </div>
        
        <div class='divider'></div>
        
        <div id="collection">

            <?php
                $i = 0;
                foreach ($answers as $answer)
                { 
            ?>      
                <div id='contnr<?php echo($i); ?>' class="formSection">
                    <b>Answer:</b>
                    <br />
                    <textarea id='input<?php echo($i); ?>' type='text' class='qa' name='input<?php echo($i); ?>' required><?php if (isset($answer[NAME_IDENTIFIER])) { echo(htmlspecialchars($answer[NAME_IDENTIFIER])); } ?></textarea>
                    <input id='btn<?php echo($i); ?>' type='button' value='Remove Answer' onclick='RemoveItem(<?php echo($i); ?>);' />
                    <br />
                    <br />
                    <div class='divider'></div>
                </div>
            <?php
                    $i++;
                } 
            ?>
        </div>
    </div>
    <br />
    <input type="button" onclick="AddItem();" value="Add Answer" />
    <input type="submit" value="Submit" />
</form>
    


<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
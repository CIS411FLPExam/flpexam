<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<?php if (isset($questionID)) { ?>
    <h1>Edit Question</h1>
<?php } else { ?>
    <h1>Add Question</h1>
<?php } ?>

<form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, PROCESSQUESTIONADDEDIT_ACTION)); ?>" method="post">
    <?php if (isset($questionID)) { ?>
    <input type="hidden" name="<?php echo(QUESTIONID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
    <?php } ?>
    <div class="formGroup">
        <div class="formSection">
            <label>Level:</label>
            <input type="number" name="Level" value="<?php echo(htmlspecialchars($level)); ?>"/>
        </div>
        
        <div class='divider'></div>
        
        <div class="formSection">
            <label>Question:</label>
            <textarea name="<?php echo(NAME_IDENTIFIER); ?>" class='qa'><?php echo(htmlspecialchars($name)); ?></textarea>
        </div>
        
        <div class='divider'></div>
        
        <div id="collection">

            <?php
                $i = 0;
                foreach ($answers as $answer)
                { 
            ?>      
                <div id='contnr<?php echo($i); ?>' class="formSection">
                    <label id='lbl<?php echo($i); ?>'>Answer:</label>
                    <textarea id='input<?php echo($i); ?>' type='text' class='qa' name='input<?php echo($i); ?>'><?php echo(htmlspecialchars($answer)); ?></textarea>
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
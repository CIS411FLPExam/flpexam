<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<h1>Question</h1>

<div class="formGroup">
    <?php if (!empty($instructions)) { ?>
        <div class="formSection">
            <label>Instructions:</label>
            <div class="displayBox"><span class="crimText"><?php echo(htmlspecialchars($instructions)); ?></span></div>
            <div class="clear"></div>
        </div>
    
        <div class="divider"></div>
    <?php } ?>
    
    
    <div class="formSection">
        <label>Question:</label>
        <div class="clear"></div>
        <h3><?php echo(htmlspecialchars($name)); ?></h3>
    </div>
    
    <form action="<?php echo(GetControllerScript(EXAMCONTROLLER_FILE, SUBMITANSWER_ACTION)); ?>" method="post">
        <input type="hidden" name ="<?php echo(QUESTIONID_IDENTIFIER) ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
        <div class="formSection">
            <input type="radio" name="<?php echo(ANSWERID_IDENTIFIER) ?>" value="<?php echo(htmlspecialchars($answers[0][ANSWERID_IDENTIFIER])) ?>" checked="checked" />
            <?php
                echo(htmlspecialchars($answers[0][NAME_IDENTIFIER]));
                for ($index = 1; $index < count($answers); $index++)
                {
                    $answer = $answers[$index];
            ?>
            <br />
            <br />
            <input type="radio" name="<?php echo(ANSWERID_IDENTIFIER) ?>" value="<?php echo(htmlspecialchars($answer[ANSWERID_IDENTIFIER])) ?>" />
                <?php echo(htmlspecialchars($answer[NAME_IDENTIFIER])); ?>
            <?php
                }
            ?>
        </div>
        
        <br />
        
        <input type="submit" value="Submit" />
    </form>
</div>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
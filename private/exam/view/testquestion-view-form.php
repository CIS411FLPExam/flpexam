<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<h1>Question</h1>

<div class="formGroup">
    
    <div class="formSection">
        <label>Instructions:</label><?php echo(htmlspecialchars($instructions)); ?>
    </div>
    
    <div class="divider"></div>
    
    <div class="formSection">
        <label>Question:</label>
        <h3><?php echo(htmlspecialchars($name)); ?></h3>
    </div>
    
    <form action="<?php echo(GetControllerScript(EXAMCONTROLLER_FILE, SUBMITANSWER_ACTION)); ?>" method="post">
        <div class="formSection">
            <?php
                for ($index = 1; $index < count($answers); $index++)
                {
                    $answer = $answers[$index];
            ?>
            <input type="radio" name="<?php echo(ANSWERID_IDENTIFIER) ?>" value="<?php echo(htmlspecialchars($answer[ANSWERID_IDENTIFIER])) ?>" />
                <?php echo(htmlspecialchars($answer[NAME_IDENTIFIER])); ?>
            <?php
                }
            ?>
        </div>
        
        <br />
        
        <input type="submit" name="Submit" />
    </form>
</div>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
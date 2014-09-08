<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->
<form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONEDIT_ACTION)); ?>" method="post">
    <input type="hidden" name="<?php echo(QUESTIONID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
    <div class="formGroup">   
        <div class="formSection">
            <label>Level:</label><label><?php echo(htmlspecialchars($level)); ?></label>
        </div>
        <?php
            $i = 0;
            foreach ($answers as $answer)
            { 
        ?>
            <div class="formSection">
                <label id='lbl<?php echo(htmlspecialchars($i)); ?>'>Answer:</label>
                <label><?php echo(htmlspecialchars($answer)); ?></label>
            </div>
        <?php
                $i++;
            } 
        ?>
    </div>
        
    <br />
    
    <input type="submit" value="Submit" />
</form>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
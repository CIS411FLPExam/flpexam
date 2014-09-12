<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->
<h1>Question</h1>
<form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONEDIT_ACTION)); ?>" method="post">
    <input type="hidden" name="<?php echo(QUESTIONID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
    <div class="formGroup">   
        <div class="formSection">
            <label>Level:</label><label><?php echo(htmlspecialchars($level)); ?></label>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Question:</label><label><?php echo(htmlspecialchars($name)); ?></label>
        </div>
        
        <div class="divider"></div>
        
        <?php
            $i = 1;
            foreach ($answers as $answer)
            { 
        ?>
            <div class="formSection">
                <label>Answer <?php echo(htmlspecialchars($i)); ?>:</label>
                <label><?php echo(htmlspecialchars($answer[NAME_IDENTIFIER])); ?></label>
            </div>
        
            <div class="divider"></div>
        <?php
                $i++;
            } 
        ?>
                
        <br />
        
        <input type="submit" value="Edit" />
    </div>
</form>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
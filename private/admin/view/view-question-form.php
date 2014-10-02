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
        <label>Question:</label><div class="displayBox"><?php echo(htmlspecialchars($name)); ?></div>
        <div class="clear"></div>
    </div>

    <div class="divider"></div>

    <div class="formSection">
        <label>Instructions:</label><div class="displayBox"><?php echo(htmlspecialchars($instructions)); ?></div>
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
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
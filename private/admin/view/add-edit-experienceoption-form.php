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

<?php if ($option->GetId() > 0) { ?>
    <h1>Edit Language Experience</h1>
<?php } else { ?>
    <h1>Add Language Experience</h1>
<?php } ?>
<div class="formGroup">
    <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, PROCESSEXPERIENCEOPTIONADDEDIT_ACTION)); ?>" method="post">
        <?php if ($option->GetId() > 0) { ?>
            <input type="hidden" name="<?php echo($option->GetIdKey()); ?>" value="<?php echo(htmlspecialchars($option->GetId())); ?>" />
        <?php } ?>
        <input type="hidden" name="<?php echo(LANGUAGEEXPERIENCEID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($experienceID)); ?>" />
        <div class="formSection">
            <label>Name<span class="redText">*</span>:</label>
            <input type="text" name="<?php echo($option->GetNameKey()); ?>" value="<?php echo(htmlspecialchars($option->GetName())); ?>" required maxlength="32" autofocus />
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Initial Level<span class="redText">*</span>:</label>
            <input type="number" name="<?php echo($option->GetInitLevelKey()); ?>" value="<?php echo(htmlspecialchars($option->GetInitLevel())); ?>" required maxlength="32" min="1"/>
        </div>
        
        <input type="submit" value="Submit" />
    </form>
    <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEEXPERIENCEOPTIONS_ACTION) . '&' . LANGUAGEEXPERIENCEID_IDENTIFIER . '=' . urlencode($experienceID)); ?>" method="post">
        <input type="submit" value="Cancel" />
    </form>
</div>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
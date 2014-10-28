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

<?php if ($experience->GetId() > 0) { ?>
    <h1>Edit Language Experience</h1>
<?php } else { ?>
    <h1>Add Language Experience</h1>
<?php } ?>
<div class="formGroup">
    <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, PROCESSLANGUAGEEXPERIENCESADDEDIT_ACTION)); ?>" method="post">
        <?php if ($experience->GetId() > 0) { ?>
            <input type="hidden" name="<?php echo($experience->GetIdKey()); ?>" value="<?php echo(htmlspecialchars($experience->GetId())); ?>" />
        <?php } ?>
        <div class="formSection">
            <label>Name<span class="redText">*</span>:</label>
            <input type="text" name="<?php echo($experience->GetNameKey()); ?>" value="<?php echo(htmlspecialchars($experience->GetName())); ?>" required maxlength="32" />
        </div>
            
        <div class="divider"></div>
            
        <div class="formSection">
            <label>Initial Level<span class="redText">*</span>:</label>
            <input type="number" name="<?php echo($experience->GetInitLevelKey()); ?>" value="<?php echo(htmlspecialchars($experience->GetInitLevel())); ?>" required min="1"/>
        </div>
        
        <br />
        
        <input type="submit" value="Submit" />
    </form>
    <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGELANGUAGEEXPERIENCES_ACTION)); ?>" method="post">
        <input type="submit" value="Cancel" />
    </form>
</div>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
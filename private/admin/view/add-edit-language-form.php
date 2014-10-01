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

<?php if (isset($languageID)) { ?>
    <h1>Edit Language</h1>
<?php } else { ?>
    <h1>Add Language</h1>    
<?php } ?>
    
<form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, PROCESSLANGUAGEADDEDIT_ACTION)); ?>" method="post">
    <?php if (isset($languageID)) { ?>
        <input type="hidden" name="LanguageID" value="<?php echo(htmlspecialchars($languageID)); ?>" />
    <?php } ?>
    <div class="formGroup">
        <div class="formSection">
            <label>Name<span class="redText">*</span>:</label>
            <input type="text" name="Name" class="formInput" value="<?php echo(htmlspecialchars($name)); ?>" autofocus required maxlength="32" />
        </div>
        
        <?php if (isset($languageID)) { ?>
                <div class="divider"></div>
        
                <div class="formSection">
                    <label>Active:</label>
                    <input type="checkbox" name="Active" <?php if ($active) { echo('checked'); } ?> />
                </div>
        <?php } ?>    
    </div>
    <input type="submit" value="Submit" />
</form>
    
<div class="formSection">
    <?php if (isset($languageID) && userIsAuthorized(MANAGEQUESTIONS_ACTION)) {?>
        <form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEQUESTIONS_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo($languageID); ?>" />
            <input type="submit" value="Manage Questions" />
        </form>
    <?php } ?>
</div>
    
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
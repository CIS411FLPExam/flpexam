<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->
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
            <label>Name:</label>
            <input type="text" name="Name" class="formInput" value="<?php echo(htmlspecialchars($name)); ?>" />
        </div>
        <?php if (isset($languageID)) { ?>
                <div class="formSection">
                    <label>Active:</label>
                    <input type="checkbox" name="Active" <?php if ($active) { echo('checked'); } ?> />
                </div>
        <?php } ?>    
    </div>
    <input type="submit" value="Submit" />
</form>
    
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
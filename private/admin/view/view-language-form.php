<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->
<form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEEDIT_ACTION)); ?>" method="post">
    <input type="hidden" name="LanguageID" value="<?php echo(htmlspecialchars($languageID)); ?>" />
    <div class="formGroup">
        <div class="formSection">
            <label>Name:</label>
            <label><?php echo(htmlspecialchars($name)); ?></label>
        </div>
        <div class="formSection">
            <label>Active:</label><label><?php if ($active) { echo('Yes'); } else { echo ('No'); } ?></label>
        </div>
    </div>
</form>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
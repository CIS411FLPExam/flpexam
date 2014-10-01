<?php
    include( HEADER_FILE );
    include( CONTROLPANEL_FILE );
?>
 <!-- Start main content here -->
 
<div class="formGroup">
    <h1>Language</h1>
    <div class="formGroup">
        <div class="formSection">
            <label>Name:</label><?php echo(htmlspecialchars($name)); ?>
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>Active:</label><?php if ($active) { echo('Yes'); } else { echo ('No'); } ?>
        </div>
    </div>
    <?php if (userIsAuthorized(LANGUAGEEDIT_ACTION)) {?>
        <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEEDIT_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo($languageID); ?>" />
            <input type="submit" value="Edit" />
        </form>
    <?php } ?>
    <?php if (userIsAuthorized(MANAGEQUESTIONS_ACTION)) {?>
    <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEQUESTIONS_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo($languageID); ?>" />
            <input type="submit" value="Manage Questions" />
        </form>
    <?php } ?>
    <?php if (userIsAuthorized(MANAGELEVELINFOS_ACTION)) {?>
        <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGELEVELINFOS_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo($languageID); ?>" />
            <input type="submit" value="Manage Level Info" />
        </form>
    <?php } ?>
</div>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
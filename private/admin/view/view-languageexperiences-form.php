<?php
    include( HEADER_FILE );
    include( CONTROLPANEL_FILE );
?>
<!-- Start main content here -->
<h1>View Language Experience</h1>

<div class="formGroup">
    <div class="formSection">
        <label>Name:</label>
        <?php echo(htmlspecialchars($experience->GetName())); ?>
    </div>
    
    <div class="divider"></div>
    
    <div class="formSection">
        <label>Description:</label>
        <div class="displayBox"><?php echo(htmlspecialchars($experience->GetDescription())); ?></div>
    </div>
    
    <br />
    
    <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEEXPERIENCESEDIT_ACTION)); ?>" method="post">
        <input type="hidden" name="<?php echo(LANGUAGEEXPERIENCEID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($experience->GetId())); ?>" />
        <input type="submit" value="Edit" />
    </form>
    <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEEXPERIENCEOPTIONS_ACTION)); ?>" method="post">
        <input type="hidden" name="<?php echo(LANGUAGEEXPERIENCEID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($experience->GetId())); ?>" />
        <input type="submit" value="Options" />
    </form>
    <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGELANGUAGEEXPERIENCES_ACTION)); ?>" method="post">
        <input type="submit" value="Experiences" />
    </form>
</div>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
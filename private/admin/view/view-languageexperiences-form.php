<?php
    include( GetHeaderFile() );
    include( GetControlPanelFile() );
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
    
    <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetLanguageExperienceEditAction())); ?>" method="post">
        <input type="hidden" name="<?php echo(GetLanguageExperienceIdIdentifier()); ?>" value="<?php echo(htmlspecialchars($experience->GetId())); ?>" />
        <input type="submit" value="Edit" />
    </form>
    <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageExperienceOptionsAction())); ?>" method="post">
        <input type="hidden" name="<?php echo(GetLanguageExperienceIdIdentifier()); ?>" value="<?php echo(htmlspecialchars($experience->GetId())); ?>" />
        <input type="submit" value="Options" />
    </form>
    <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageLanguageExperiencesAction())); ?>" method="post">
        <input type="submit" value="Experiences" />
    </form>
</div>
<!-- End main content here -->
<?php
    include( GetFooterFile() ); 
?>
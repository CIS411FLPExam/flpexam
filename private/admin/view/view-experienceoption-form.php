<?php
    include( HEADER_FILE );
    include( CONTROLPANEL_FILE );
?>
<!-- Start main content here -->
<h1>View Experience Option</h1>
<div class="formGroup">
    <div class="formSection">
        <label>Name:</label>
        <?php echo(htmlspecialchars($option->GetName())); ?>
    </div>

    <div class="divider"></div>

    <div class="formSection">
        <label>Initial Level:</label>
        <?php echo(htmlspecialchars($option->GetInitLevel())); ?>
    </div>
    <?php if (userIsAuthorized(EXPERIENCEOPTIONEDIT_ACTION)) { ?>
        <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, EXPERIENCEOPTIONEDIT_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo($option->GetIdKey()); ?>" value="<?php echo(htmlspecialchars($option->GetId())); ?>" />
            <input type="submit" value="Edit" />
        </form>
    <?php } ?>
    <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEEXPERIENCEOPTIONS_ACTION)); ?>" method="post">
        <input type="hidden" name="<?php echo($option->GetIdKey()); ?>" value="<?php echo(htmlspecialchars($option->GetId())); ?>" />
        <input type="submit" value="Options" />
    </form>
    <?php if (userIsAuthorized(EXPERIENCEOPTIONADD_ACTION)) { ?>
        <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, EXPERIENCEOPTIONADD_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo($option->GetExperienceIdKey()); ?>" value="<?php echo(htmlspecialchars($option->GetExperienceId())); ?>" />
            <input type="submit" value="Add New Option" />
        </form>
    <?php } ?>
</div>
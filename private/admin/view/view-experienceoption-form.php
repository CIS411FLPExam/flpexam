<?php
    include( GetHeaderFile() );
    include( GetControlPanelFile() );
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
    <?php if (userIsAuthorized(GetExperienceOptionEditAction())) { ?>
        <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetExperienceOptionEditAction())); ?>" method="post">
            <input type="hidden" name="<?php echo($option->GetIdKey()); ?>" value="<?php echo(htmlspecialchars($option->GetId())); ?>" />
            <input type="submit" value="Edit" />
        </form>
    <?php } ?>
    <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageExperienceOptionsAction())); ?>" method="post">
        <input type="hidden" name="<?php echo($option->GetIdKey()); ?>" value="<?php echo(htmlspecialchars($option->GetId())); ?>" />
        <input type="submit" value="Options" />
    </form>
    <?php if (userIsAuthorized(GetExperienceOptionAddAction())) { ?>
        <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetExperienceOptionAddAction())); ?>" method="post">
            <input type="hidden" name="<?php echo($option->GetExperienceIdKey()); ?>" value="<?php echo(htmlspecialchars($option->GetExperienceId())); ?>" />
            <input type="submit" value="Add New Option" />
        </form>
    <?php } ?>
</div>
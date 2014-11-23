<?php
    include(GetHeaderFile());
    include(GetControlPanelFile());
?>
<!--Start main content-->

<h1>Level Info</h1>

<div class="formGroup">
        <div class="formSection">
            <label>Level:</label>
            <?php echo(htmlspecialchars($levelInfo->GetLevel())); ?>
        </div>
        
        <div class='divider'></div>
        
        <div class="formSection">
            <label>Name:</label>
            <div class="displayBox"><?php echo(htmlspecialchars($levelInfo->GetName())); ?></div>
            <div class="clear"></div>
        </div>
        
        <div class='divider'></div>
        
        <div class="formSection">
            <label>Course Name:</label>
            <div class="displayBox"><?php echo(htmlspecialchars($levelInfo->GetCourse())); ?></div>
            <div class="clear"></div>
        </div>
        
        <div class='divider'></div>
        
        <div class="formSection">
            <label>Description:</label>
            <div class="displayBox"><?php echo(htmlspecialchars($levelInfo->GetDescription())); ?></div>
            <div class="clear"></div>
        </div>
        
        <br />
        
        <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetLevelInfoEditAction())); ?>" method="post">
            <input type="hidden" name="<?php echo(GetLevelInfoIdIdentifier()); ?>" value="<?php echo(htmlspecialchars($levelInfo->GetId())); ?>" />
            <input type="submit" value="Edit" />
        </form>
        
        <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageLevelInfosAction())); ?>" method="post">
            <input type="hidden" name="<?php echo(GetLanguageIdIdentifier()); ?>" value="<?php echo(htmlspecialchars($levelInfo->GetLanguageId())); ?>" />
            <input type="submit" value="Levels Info" />
        </form>
</div>

<!--End main content-->
<?php
    include(GetFooterFile());
?>
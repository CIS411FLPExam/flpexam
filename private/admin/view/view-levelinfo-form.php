<?php
    include(HEADER_FILE);
    include(CONTROLPANEL_FILE);
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
            <?php echo(htmlspecialchars($levelInfo->GetName())); ?>
        </div>
        
        <div class='divider'></div>
        
        <div class="formSection">
            <label>Course Name:</label>
            <?php echo(htmlspecialchars($levelInfo->GetCourse())); ?>
        </div>
        
        <div class='divider'></div>
        
        <div class="formSection">
            <label>Description:</label>
            <?php echo(htmlspecialchars($levelInfo->GetDescription())); ?>
        </div>
        
        <br />
        
        <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LEVELINFOEDIT_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(LEVELINFOID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($levelInfo->GetId())); ?>" />
            <input type="submit" value="Edit" />
        </form>
        
        <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGELEVELINFOS_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($levelInfo->GetLanguageId())); ?>" />
            <input type="submit" value="Manage Level Infos" />
        </form>
</div>

<!--End main content-->
<?php
    include(FOOTER_FILE);
?>
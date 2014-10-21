<?php
    include(HEADER_FILE);
?>
<!--Start main content-->

<?php
    if (isset($message))
    {
        include(MESSAGE_FILE);
    }
?>

<?php if (isset($levelInfoID)) { ?>
    <h1>Edit Level Information</h1>
<?php } else { ?>
    <h1>Add Level Information</h1>
<?php } ?>

<div class="formGroup">
    <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, PROCESSLEVELINFOADDEDIT_ACTION)) ?>" method="post">
        <?php if (isset($levelInfoID)) { ?>
            <input type="hidden" name="<?php echo(LEVELINFOID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($levelInfoID)); ?>" />
        <?php } ?>
        <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER) ?>" value="<?php echo(htmlspecialchars($languageID)); ?>" />
        
        <div class="formSection">
            <label>Level<span class="redText">*</span>:</label>
            <input type="number" class="formInput" name="<?php echo($levelInfo->GetLevelKey()); ?>" value="<?php echo(htmlspecialchars($levelInfo->GetLevel())); ?>" autofocus required min="1" />
            (The level that this information is for.)
            <div class="clear"></div>
        </div>
        
        <div class='divider'></div>
        
        <div class="formSection">
            <label>Name<span class="redText">*</span>:</label>
            <input type="text" class="formInput" name="<?php echo($levelInfo->GetNameKey()); ?>" value="<?php echo(htmlspecialchars($levelInfo->GetName())); ?>" required />
            (The name of the level.)
            <div class="clear"></div>
        </div>
        
        <div class='divider'></div>
        
        <div class="formSection">
            <label>Course Name<span class="redText">*</span>:</label>
            <input type="text" class="formInput" name="<?php echo($levelInfo->GetCourseKey()); ?>" value="<?php echo(htmlspecialchars($levelInfo->GetCourse())); ?>" required />
            (The class that corresponds to this level.)
            <div class="clear"></div>
        </div>
        
        <div class='divider'></div>
        
        <div class="formSection">
            <label>Description:</label>
            <textarea type="text" class="qa" name="<?php echo($levelInfo->GetDescriptionKey()); ?>" rows="5" cols="70"><?php echo(htmlspecialchars($levelInfo->GetDescription())); ?></textarea>
            <div class="clear"></div>
        </div>
        
        <br />
        
        <input type="submit" value="Submit" />
    </form>
    <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGELEVELINFOS_ACTION) . '&' . LANGUAGEID_IDENTIFIER . '=' . urlencode($languageID)); ?>" method="post">
        <input type="submit" value="Cancel" />
    </form>
</div>
<!--End main content-->
<?php
    include(FOOTER_FILE);
?>
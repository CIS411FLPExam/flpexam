<?php
    include( GetHeaderFile() );
?>
<!-- Start main content here -->

<?php
    if (isset($message))
    {
        include(GetMessageFile());
    }
?>

<?php if (isset($languageID)) { ?>
    <h1>Edit Language</h1>
<?php } else { ?>
    <h1>Add Language</h1>    
<?php } ?>

<div class="formGroup">
    <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetProcessLanguageAddEditAction())); ?>" method="post">
        <?php if (isset($languageID)) { ?>
            <input type="hidden" name="<?php echo(GetLanguageIdIdentifier()); ?>" value="<?php echo(htmlspecialchars($languageID)); ?>" />
        <?php } ?>

        <div class="formSection">
            <label>Name<span class="redText">*</span>:</label>
            <input type="text" name="Name" class="formInput" value="<?php echo(htmlspecialchars($name)); ?>" autofocus required maxlength="32" />
            <div class="clear"></div>
        </div>

        <?php if (isset($languageID)) { ?>
                <div class="divider"></div>

                <div class="formSection">
                    <label>Active:</label>
                    <input type="checkbox" name="Active" <?php if ($active) { echo('checked'); } ?> />
                    <div class="clear"></div>
                </div>
                
                <div class="divider"></div>

                <div class="formSection">
                    <label>Feedback:</label>
                    <input type="checkbox" name="Feedback" <?php if ($feedback) { echo('checked'); } ?> />
                    <div class="clear"></div>
                </div>
        <?php } ?>    

        <input type="submit" value="Submit" />
    </form>
    <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageLanguagesAction())); ?>" method="post">
        <input type="submit" value="Cancel" />
    </form>
</div>
<!-- End main content here -->
<?php
    include( GetFooterFile() ); 
?>
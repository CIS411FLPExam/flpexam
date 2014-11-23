<?php
    include( GetHeaderFile() );
    include( GetControlPanelFile() );
?>
 <!-- Start main content here -->
 
<div class="formGroup">
    <h1>Language</h1>
    <div class="formGroup">
        <div class="formSection">
            <label>Name:</label>
            <div class="displayBox"><?php echo(htmlspecialchars($name)); ?></div>
            <div class="clear"></div>
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>Active:</label><?php if ($active) { echo('Yes'); } else { echo ('No'); } ?>
            <div class="clear"></div>
        </div>
        
        <div class="divider"></div>

        <div class="formSection">
            <label>Feedback:</label><?php if ($feedback) { echo('Yes'); } else { echo ('No'); } ?>
            <div class="clear"></div>
        </div>
    </div>
    <?php if (userIsAuthorized(GetLanguageEditAction())) {?>
        <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetLanguageEditAction())); ?>" method="post">
            <input type="hidden" name="<?php echo(GetLanguageIdIdentifier()); ?>" value="<?php echo($languageID); ?>" />
            <input type="submit" value="Edit" />
        </form>
    <?php } ?>
    <?php if (userIsAuthorized(GetManageQuestionsAction())) {?>
    <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageQuestionsAction())); ?>" method="post">
            <input type="hidden" name="<?php echo(GetLanguageIdIdentifier()); ?>" value="<?php echo($languageID); ?>" />
            <input type="submit" value="Questions" />
        </form>
    <?php } ?>
    <?php if (userIsAuthorized(GetManageLevelInfosAction())) {?>
        <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageLevelInfosAction())); ?>" method="post">
            <input type="hidden" name="<?php echo(GetLanguageIdIdentifier()); ?>" value="<?php echo($languageID); ?>" />
            <input type="submit" value="Level Info" />
        </form>
    <?php } ?>
</div>
<!-- End main content here -->
<?php
    include( GetFooterFile() ); 
?>
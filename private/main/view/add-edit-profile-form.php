<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->
<div class="formGroup">
    <?php if (isset($userID)) { ?>
        <h1>Edit Profile</h1>
    <?php } else { ?>
        <h1>Add Profile</h1>
    <?php } ?>
        
    <form action="<?php echo(GetControllerScript(MAINCONTROLLER_FILE, PROCESSPROFILEADDEDIT_ACTION)); ?>" method="post">
        <?php if (isset($userID)) { ?>
            <input type="hidden" name="<?php echo(USERID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($userID)); ?>" />
        <?php } ?>
        <?php if (isset($requestedPage)) { ?>
            <input type="hidden" name="<?php echo(REQUESTEDPAGE_IDENTIFIER); ?>" value="<?php echo($requestedPage); ?>" />
        <?php } ?>
        <div class="formSection">
            <label>Major:</label>
            <input type="text" name="Major" class="formInput" value="<?php echo(htmlspecialchars($major)); ?>" />
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>High School:</label>
            <input type="text" name="HighSchool" class="formInput" value="<?php echo(htmlspecialchars($highSchool)); ?>" />
        </div>
        
        <input type="submit" value="Submit" />
    </form>
</div>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
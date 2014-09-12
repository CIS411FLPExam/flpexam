<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->
<div class="formGroup">
    <h1>Profile</h1>
    <?php if($profile == false) { ?>
        <h3>No profile on record</h3>
        <form action="<?php echo(GetControllerScript(MAINCONTROLLER_FILE, PROFILEADD_ACTION)); ?>" method="post">
            <input type="submit" value="Add Profile" />
        </form>
    <?php } else { ?>
        <form action="<?php echo(GetControllerScript(MAINCONTROLLER_FILE, PROFILEEDIT_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(USERID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($userID)); ?>" />
            <div class="formSection">
                <label>Major:</label>
                <b><?php echo(htmlspecialchars($major)); ?></b>
            </div>

            <div class="divider"></div>

            <div class="formSection">
                <label>High School:</label>
                <b><?php echo(htmlspecialchars($highSchool)); ?></b>
            </div>
            <input type="submit" value="Edit" />
        </form>
    <?php }?>
</div>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
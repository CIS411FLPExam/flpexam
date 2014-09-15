<h1>Control Panel</h1>

<?php if (userIsAuthorized(MANAGEUSERS_ACTION)) {  ?>
    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGEUSERS_ACTION ) ) ?>">Manage Users</a> &nbsp;
<?php } ?>
<?php if (userIsAuthorized(MANAGELANGUAGES_ACTION) ) { ?>
    <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGELANGUAGES_ACTION)); ?>">Manage Languages</a> &nbsp;
<?php } ?>
<?php if (userIsAuthorized(EXAMPARAMETERSVIEW_ACTION) ) { ?>
    <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, EXAMPARAMETERSVIEW_ACTION)); ?>">Manage Exam Parameters</a> &nbsp;
<?php } ?>
<?php if (userIsAuthorized(MANAGEFUNCTIONS_ACTION)) {  ?>
    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGEFUNCTIONS_ACTION ) ) ?>">Manage Functions</a> &nbsp;
<?php } ?>
<?php if (userIsAuthorized(MANAGEROLES_ACTION)) {  ?>
    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGEROLES_ACTION ) ) ?>">Manage Roles</a> &nbsp;
<?php } ?>
<?php if (userIsAuthorized(MANAGETESTS_ACTION)) {  ?>
    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGETESTS_ACTION ) ) ?>">Manage Tests</a> &nbsp;
<?php } ?>
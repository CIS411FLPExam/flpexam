<h1>Control Panel</h1>

<?php if (userIsAuthorized(MANAGEUSERS_ACTION)) {  ?>
<a href="<?php echo( GetControllerScript( MANAGEUSERS_ACTION ) ) ?>">Manage Users</a> &nbsp;
<?php } 
    if (userIsAuthorized(MANAGEFUNCTIONS_ACTION)) {  ?>
        <a href="<?php echo( GetControllerScript( MANAGEFUNCTIONS_ACTION ) ) ?>">Manage Functions</a> &nbsp;
<?php } 
    if (userIsAuthorized(MANAGEROLES_ACTION)) {  ?>
        <a href="<?php echo( GetControllerScript( MANAGEROLES_ACTION ) ) ?>">Manage Roles</a> &nbsp;
<?php } ?>
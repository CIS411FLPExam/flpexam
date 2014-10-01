<div id='cssmenu'>
    <ul>
        <li><a href="<?php echo( GetControllerScript( MAINCONTROLLER_FILE, HOME_ACTION ) ); ?>"><span>Home</span></a></li>
        <?php if (loggedIn()) {  ?>
            <li class='active has-sub'><a href='#'><span>Admin</span></a>
            <ul>
                <li><a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, CONTROLPANEL_ACTION)) ?>"><span>Control Panel</span></a></li>
                <li><a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEROLES_ACTION)) ?>"><span>Manage Roles</span></a></li>
                <li><a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEUSERS_ACTION)) ?>"><span>Manage Users</span></a></li>
                <li><a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGETESTS_ACTION ) ) ?>"><span>Manage Tests</span></a></li>
                <li><a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGECONTACTS_ACTION)) ?>"><span>Manage Contacts</span></a></li>
                <li><a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGELANGUAGES_ACTION)) ?>"><span>Manage Languages</span></a></li>
                <?php //<li><a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEFUNCTIONS_ACTION)) ?"><span>Manage Functions</span></a></li>?>
                <li class='last'><a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, EXAMPARAMETERSVIEW_ACTION)) ?>"><span>Manage Exam Parameters</span></a></li>
            </ul>
            </li>
            <li><a href="<?php echo( GetControllerScript( ADMINCONTROLLER_FILE, LOGOUT_ACTION ) ) ?>"><span>Logout</span></a></li>
        <?php } else { ?>
            <li><a href="<?php echo( GetControllerScript( ADMINCONTROLLER_FILE, LOGIN_ACTION ) . '&' . REQUESTEDPAGE_IDENTIFIER .'=' . GetRequestedURI( ) ); ?>"><span>Login</span></a></li>
        <?php } ?>
    </ul>
</div>
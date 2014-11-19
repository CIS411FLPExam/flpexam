<div id='cssmenu'>
    <ul>
        <li><a href="<?php echo( GetControllerScript( MAINCONTROLLER_FILE, HOME_ACTION ) ); ?>"><span>Home</span></a></li>
        <?php if (loggedIn()) {  ?>
            <li class='active has-sub'><a href='#'><span>Admin</span></a>
            <ul>
                <?php if (userIsAuthorized(CONTROLPANEL_ACTION)) { ?>
                    <li><a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, CONTROLPANEL_ACTION)) ?>"><span>Control Panel</span></a></li>
                <?php } ?>
                <?php if (userIsAuthorized(MANAGEROLES_ACTION)) { ?>
                    <li><a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEROLES_ACTION)) ?>"><span>Roles</span></a></li>
                <?php } ?>
                <?php if (userIsAuthorized(MANAGEUSERS_ACTION)) { ?>
                    <li><a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEUSERS_ACTION)) ?>"><span>Users</span></a></li>
                <?php } ?>
                <?php if (userIsAuthorized(MANAGETESTENTRIES_ACTION)) { ?>
                    <li><a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGETESTENTRIES_ACTION ) ) ?>"><span>Tests</span></a></li>
                <?php } ?>
                <?php if (userIsAuthorized(MANAGECONTACTS_ACTION)) { ?>
                    <li><a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGECONTACTS_ACTION)) ?>"><span>Contacts</span></a></li>
                <?php } ?>
                <?php if (userIsAuthorized(MANAGELANGUAGES_ACTION)) { ?>
                    <li><a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGELANGUAGES_ACTION)) ?>"><span>Languages</span></a></li>
                <?php } ?>
                <?php if (userIsAuthorized(EXAMPARAMETERSVIEW_ACTION)) { ?>
                    <li><a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, EXAMPARAMETERSVIEW_ACTION)) ?>"><span>Exam Params</span></a></li>
                <?php } ?>
                <?php if (userIsAuthorized(LANGUAGEEXPERIENCESVIEW_ACTION)) { ?>
                    <li><a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGELANGUAGEEXPERIENCES_ACTION)) ?>"><span>Experiences</span></a></li>
                <?php } ?>
            </ul>
            </li>
            <li><a href="<?php echo( GetControllerScript( ADMINCONTROLLER_FILE, LOGOUT_ACTION ) ) ?>"><span>Logout</span></a></li>
        <?php } else { ?>
            <li><a href="<?php echo( GetControllerScript( ADMINCONTROLLER_FILE, LOGIN_ACTION ) . '&' . REQUESTEDPAGE_IDENTIFIER .'=' . GetRequestedURI( ) ); ?>"><span>Login</span></a></li>
        <?php } ?>
    </ul>
</div>
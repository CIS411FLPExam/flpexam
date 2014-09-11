<div id='cssmenu'>
    <ul>
        <li><a href="<?php echo( GetControllerScript( MAINCONTROLLER_FILE, HOME_ACTION ) ); ?>"><span>Home</span></a></li>
        
        <?php if (loggedIn()) {  ?>
            <li class='active has-sub'><a href='#'><span>Account</span></a>
                <ul>
                    <li><a href="<?php echo(GetControllerScript(MAINCONTROLLER_FILE, SELFVIEW_ACTION)) ?>"><span>Info</span></a></li>
                    <li><a href="<?php echo(GetControllerScript(MAINCONTROLLER_FILE, PROFILEVIEW_ACTION)) ?>"><span>Profile</span></a></li>
                    <li class='last'><a href='<?php echo(GetControllerScript(MAINCONTROLLER_FILE, MANAGELANGUAGEPROFILES_ACTION)); ?>'><span>Language Profiles</span></a></li>
                </ul>
            </li>
            <?php if (userIs(MANAGERROLE_IDENTIFIER) || userIs(ADMINROLE_IDENTIFIER)) {  ?>
                <li><a href="<?php echo( GetControllerScript( ADMINCONTROLLER_FILE, CONTROLPANEL_ACTION ) ); ?>"><span>Admin</span></a></li>
            <?php } ?>
            <li><a href="<?php echo( GetControllerScript( MAINCONTROLLER_FILE, LOGOUT_ACTION ) ) ?>"><span>Logout</span></a></li>
            
        <?php } else { ?>
            <li><a href="<?php echo( GetControllerScript( MAINCONTROLLER_FILE, LOGIN_ACTION ) . '&RequestedPage=' . GetRequestedURI( ) ); ?>"><span>Login</span></a></li>
        <?php } ?>
    </ul>
</div>
<div id='cssmenu'>
    <ul>
        <li><a href="<?php echo( GetControllerScript( MAINCONTROLLER_FILE, HOME_ACTION ) ); ?>"><span>Home</span></a></li>
        <li><a href="<?php echo( GetControllerScript( ADMINCONTROLLER_FILE, CONTROLPANEL_ACTION ) ); ?>"><span>Admin</span></a></li>
        <?php
        if (loggedIn()) { 
        ?>
               <li><a href="<?php echo( GetControllerScript( MAINCONTROLLER_FILE, LOGOUT_ACTION ) ) ?>"><span>Logout</span></a></li>
        <?php } else { ?>
                 <li><a href="<?php echo( GetControllerScript( MAINCONTROLLER_FILE, LOGIN_ACTION ) . '&RequestedPage=' . GetRequestedURI( ) ); ?>"><span>Login</span></a></li>
        <?php } ?>
    </ul>
</div>
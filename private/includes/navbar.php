<div id='cssmenu'>
<ul>
    <li><a href="<?php echo( GetControllerScript( HOME_ACTION ) ); ?>"><span>Home</span></a></li>
    <li><a href="<?php echo( GetControllerScript( CONTROLPANEL_ACTION ) ); ?>"><span>Admin</span></a></li>
    <?php
    if (loggedIn()) { 
    ?>
           <li><a href="<?php echo( GetControllerScript( LOGOUT_ACTION ) ) ?>"><span>Logout</span></a></li>
    <?php } else { ?>
             <li><a href="<?php echo( GetControllerScript(LOGIN_ACTION) . '&RequestedPage=' . GetRequestedURI( ) ); ?>"><span>Login</span></a></li>
    <?php } ?>
</div>
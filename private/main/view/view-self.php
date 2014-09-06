<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

First Name: <label><?php echo(htmlspecialchars($firstName)); ?></label>

<br />

Last Name: <label><?php echo(htmlspecialchars($lastName)); ?></label>

<br />

User Name: <label><?php echo(htmlspecialchars($userName)); ?></label>

<br />

<?php if(userIsAuthentic($userID)) { ?>
    <form action="<?php echo(GetControllerScript(MAINCONTROLLER_FILE,CHANGEPASSWORD_ACTION)) ?>" method="post">
        <input type="hidden" name="<?php echo(USERID_IDENTIFIER) ?>" value="<?php echo($userID); ?>" />
        <input type="submit" value="Change Password" />
    </form>
<?php } ?>

Email: <label><?php echo(htmlspecialchars($email)); ?></label>

<br />

<?php if(userIsAuthentic($userID) || userIsAuthorized(USEREDIT_ACTION)) { ?>
    <form action="<?php echo(GetControllerScript(MAINCONTROLLER_FILE,SELFEDIT_ACTION)) ?>" method="post">
        <input type="hidden" name="<?php echo(USERID_IDENTIFIER) ?>" value="<?php echo($userID); ?>" />
        <input type="submit" value="Edit" />
    </form>
<?php } ?>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
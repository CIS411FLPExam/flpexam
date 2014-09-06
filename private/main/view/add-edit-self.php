<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<h1>Sign up</h1>

<?php
    if (isset($message) && !empty($message))
    {
        include (MESSAGE_FILE);
    }
?>

<form action="<?php echo(GetControllerScript(MAINCONTROLLER_FILE,PROCESSSELFADDEDIT_ACTION)) ?>" method="post">
    
    <?php if (isset($userID)) { ?>
        <input type="hidden" name="<?php echo(USERID_IDENTIFIER) ?>" value="<?php echo(htmlspecialchars($userID)); ?>" />
    <?php } ?>
    
        First Name*: <input type="text" name="<?php echo(FIRSTNAME_IDENTIFIER); ?>" maxlength="32" value="<?php echo(htmlspecialchars($firstName)); ?>" /><br/>

    Last Name*: <input type="text" name="<?php echo(LASTNAME_IDENTIFIER); ?>" maxlength="32" value="<?php echo(htmlspecialchars($lastName)); ?>" /><br/>

    User Name*: <input type="text" name="<?php echo(USERNAME_IDENTIFIER); ?>" maxlength="32" value="<?php echo(htmlspecialchars($userName)); ?>" /><br/>

    <?php if (isset($userID)) { ?>
   
    <?php } else { ?>
        Password*: <input type="password" name="<?php echo(PASSWORD_IDENTIFIER); ?>" maxlength="40" value="" /><br/>
    
        Re-type Password*: <input type="password" name="<?php echo(PASSWORDRETYPE_IDENTIFIER); ?>" maxlength="40" value="" /><br />
    <?php } ?>
    
    Email*: <input type="text" name="<?php echo(EMAIL_IDENTIFIER); ?>" maxlength="32" value="<?php echo(htmlspecialchars($email)); ?>" /><br/>

    <br/>

    <input type="submit" value="Submit" />

</form>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->


<?php if (isset($userID)) { ?>
        <h1>Edit</h1>
<?php } else { ?>
        <h1>Sign up</h1>
<?php } ?>

<?php
    if (isset($message) && !empty($message))
    {
        include (MESSAGE_FILE);
    }
?>

<form action="<?php echo(GetControllerScript(MAINCONTROLLER_FILE, PROCESSSELFADDEDIT_ACTION)) ?>" method="post">
    
    <?php if (isset($userID)) { ?>
        <input type="hidden" name="<?php echo(USERID_IDENTIFIER) ?>" value="<?php echo(htmlspecialchars($userID)); ?>" />
    <?php } ?>
    
    <div class="formGroup">
        <div class="formSection">
            <label>First Name*:</label><input class="formInput" type="text" name="<?php echo(FIRSTNAME_IDENTIFIER); ?>" maxlength="32" value="<?php echo(htmlspecialchars($firstName)); ?>" /><br/>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Last Name*:</label><input class="formInput" type="text" name="<?php echo(LASTNAME_IDENTIFIER); ?>" maxlength="32" value="<?php echo(htmlspecialchars($lastName)); ?>" /><br/>
        </div>
        
        <?php if (!isset($userID)) { ?>            
            <div class="divider"></div>
        
            <div class="formSection">
                <label>User Name*:</label><input class="formInput" type="text" name="<?php echo(USERNAME_IDENTIFIER); ?>" maxlength="32" value="<?php echo(htmlspecialchars($userName)); ?>" /><br/>
            </div>
            
            <div class="divider"></div>
            
            <div class="formSection">
                <label>Password*:</label><input class="formInput" type="password" name="<?php echo(PASSWORD_IDENTIFIER); ?>" maxlength="40" value="" /><br/>
            </div>
        
            <div class="divider"></div>
        
            <div class="formSection">
                <label>Re-type Password*:</label><input class="formInput" type="password" name="<?php echo(PASSWORDRETYPE_IDENTIFIER); ?>" maxlength="40" value="" /><br />
            </div>
        <?php } ?>
            
        <div class="divider"></div>

        <div class="formSection">
            <label>Email*:</label><input class="formInput" type="text" name="<?php echo(EMAIL_IDENTIFIER); ?>" maxlength="32" value="<?php echo(htmlspecialchars($email)); ?>" /><br/>
        </div>
            
        <br />

        <input type="submit" value="Submit" />
    </div>
</form>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
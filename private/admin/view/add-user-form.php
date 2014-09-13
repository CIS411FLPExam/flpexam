<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->
<h1>Add User</h1>

<div class="formGroup">
    <form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, PROCESSUSERADD_ACTION)); ?>" method="post">
        <div class="formSection">
            <label>Username:</label>
            <input name="<?php echo(USERNAME_IDENTIFIER) ?>" class="formInput" type="text" value="<?php echo(htmlspecialchars($userName)); ?>" />
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Password:</label>
            <input name="<?php echo(PASSWORD_IDENTIFIER) ?>" class="formInput" type="password" />
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Password Retype:</label>
            <input name="<?php echo(PASSWORDRETYPE_IDENTIFIER) ?>" class="formInput" type="password" />
        </div>
        
        <br />
        
        <input type="submit" value="Submit" />
    </form>
</div>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<?php
    if (isset($message))
    {
        include(MESSAGE_FILE);
    }
?>
<h1>Add User</h1>

<div class="formGroup">
    <form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, PROCESSUSERADD_ACTION)); ?>" method="post">
        <div class="formSection">
            <label>Username<span class="redText">*</span>:</label>
            <input name="<?php echo(USERNAME_IDENTIFIER) ?>" class="formInput" type="text" value="<?php echo(htmlspecialchars($userName)); ?>" autofocus required  maxlength="32"/>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Password<span class="redText">*</span>:</label>
            <input name="<?php echo(PASSWORD_IDENTIFIER) ?>" class="formInput" type="password" required maxlength="40"/>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Password Retype<span class="redText">*</span>:</label>
            <input name="<?php echo(PASSWORDRETYPE_IDENTIFIER) ?>" class="formInput" type="password" required maxlength="40" />
        </div>
        
        <br />
        
        <input type="submit" value="Submit" />
    </form>
</div>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
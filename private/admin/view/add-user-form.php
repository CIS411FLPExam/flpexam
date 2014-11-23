<?php
    include( GetHeaderFile() );
?>
<!-- Start main content here -->

<?php
    if (isset($message))
    {
        include(GetMessageFile());
    }
?>
<h1>Add User</h1>

<div class="formGroup">
    <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetProcessUserAddAction())); ?>" method="post">
        <div class="formSection">
            <label>Username<span class="redText">*</span>:</label>
            <input name="<?php echo(GetUserNameIdentifier()) ?>" class="formInput" type="text" value="<?php echo(htmlspecialchars($userName)); ?>" autofocus required  maxlength="32"/>
            <div class="clear"></div>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Password<span class="redText">*</span>:</label>
            <input name="<?php echo(GetPasswordIdentifier()) ?>" class="formInput" type="password" required maxlength="40"/>
            <div class="clear"></div>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Password Retype<span class="redText">*</span>:</label>
            <input name="<?php echo(GetPasswordRetypeIdentifier()) ?>" class="formInput" type="password" required maxlength="40" />
            <div class="clear"></div>
        </div>
        
        <br />
        
        <input type="submit" value="Submit" />
    </form>
    <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageUsersAction())); ?>" method="post">
        <input type="submit" value="Cancel" />
    </form>
</div>
<!-- End main content here -->
<?php
    include( GetFooterFile() ); 
?>
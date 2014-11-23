<?php
    include( GetHeaderFile() );
?>
<!-- Start main content here -->

<h1>Login</h1>

<form action="<?php echo( GetControllerScript(GetAdminControllerFile(), GetProcessLoginAction() ) ); ?>" method="post">
    <div class="formGroup">
        <div class="formSection">
            <label>Username:</label><input class="formInput" type="text" name="username" autofocus required maxlength="32"/>
            <div class="clear"></div>
        </div>

        <div class="formSection">
            <label>Password:</label><input class="formInput" type="password" name="password" required maxlength="40"/>
            <div class="clear"></div>
        </div>

        <?php if (isset($_GET[GetRequestedPageIdentifier()])) { ?>
            <input type="hidden" name="<?php echo(GetRequestedPageIdentifier()); ?>" value="<?php echo($_GET[GetRequestedPageIdentifier()]); ?>" />
        <?php } ?>
        <input type="submit" value="Login"/>
    </div>
    
    <?php if (isset($_GET['LoginFailure'])) { ?>
        <h4 class="redText">Invalid Username or Password.  Please try again.</h4>
    <?php } ?>

</form>
<!-- End main content here -->
<?php
    include( GetFooterFile() ); 
?>
<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<h1>Login</h1>

<form action="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, PROCESSLOGIN_ACTION ) ); ?>" method="post">
    <div class="formGroup">
        <div class="formSection">
            <label>Username:</label><input class="formInput" type="text" name="username" autofocus />
        </div>

        <div class="formSection">
            <label>Password:</label><input class="formInput" type="password" name="password" />
        </div>

        <input type="hidden" name="<?php echo(REQUESTEDPAGE_IDENTIFIER); ?>" value="<?php echo($_GET[REQUESTEDPAGE_IDENTIFIER]); ?>" />

        <input type="submit" value="Login"/>
    </div>
    
    <?php
        if (isset($_GET['LoginFailure']))
        {
            echo '<p/><h4> Invalid Username or Password.  Please try again.</h4>';
        }
    ?>

</form>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
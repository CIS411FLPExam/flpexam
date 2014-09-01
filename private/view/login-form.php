<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<h1>Login</h1>

<form action=<?php echo( GetControllerScript( PROCESSLOGIN_ACTION ) ); ?> method="post">

    Username: <input type="text" name="username" /><br/>
    Password: <input type="password" name="password" /><br/><br/>
    <input type="hidden" name="RequestedPage" value="<?php echo $_GET['RequestedPage'] ?>" />

    <input type="submit" value="Login"/>

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
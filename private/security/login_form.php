<?php
    require_once ( "../php/DocInfo.php" );
    
    $docInfo = new wg\custom\DocInfo( );
    $docInfo->SetTitle( "VP Desings Login" );
    $docInfo->SetAuthor( "Wesley Garey" );
    $docInfo->SetDescription( "Fashion Designs" );
    
    $docInfo->SetTags( array( "desings", "clothes" ) );
    
    include( "../includes/header.php" );
?>
<!-- Start main content here -->

<h1>Login</h1>

<form action="index.php?action=ProcessLogin" method="post">

    Username: <input type="text" name="username" /><br/>
    Password: <input type="password" name="password" /><br/><br/>
    <input type="hidden" name="RequestedPage" value="<?php echo $_GET['RequestedPage'] ?>" />

    <input type="submit" value="Submit"/>

    <?php
        if (isset($_GET['LoginFailure'])) {
            echo '<p/><h4> Invalid Username or Password.  Please try again.</h4>';
        }
    ?>

</form>

<!-- End main content here -->
<?php
    include( "../includes/footer.php" ); 
?>
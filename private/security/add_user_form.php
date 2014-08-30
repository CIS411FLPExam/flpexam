<?php
    require_once ( "../php/DocInfo.php" );
    
    $docInfo = new wg\custom\DocInfo( );
    $docInfo->SetTitle( "VP Desings Add User" );
    $docInfo->SetAuthor( "Wesley Garey" );
    $docInfo->SetDescription( "Fashion Designs" );
    
    $docInfo->SetTags( array( "desings", "clothes" ) );
    
    include( "../includes/header.php" );
?>
<!-- Start main content here -->

<h1>Add User</h1>

<form action="index.php?action=ProcessUserAddEdit" method="post">

    First Name*: <input type="text" name="FirstName" size="20" value=""><br/>

    Last Name*: <input type="text" name="LastName" size="20" value=""><br/>

    User Name*: <input type="text" name="UserName" size="20" value=""><br/>

    Password*: <input type="password" name="Password" size="20" value=""><br/>

    Email*: <input type="text" name="Email" size="20" value=""><br/>

    <br/>

    <input type="submit" value="Submit" />

</form>

<!-- End main content here -->
<?php
    include( "../includes/footer.php" ); 
?>
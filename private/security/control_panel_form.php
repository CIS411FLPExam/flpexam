<?php
    require_once ( "../php/DocInfo.php" );
    
    $docInfo = new wg\custom\DocInfo( );
    $docInfo->SetTitle( "VP Desings Control Panel - Manage Users" );
    $docInfo->SetAuthor( "Wesley Garey" );
    $docInfo->SetDescription( "Fashion Designs" );
    
    $docInfo->SetTags( array( "desings", "clothes" ) );
    
    include( "../includes/header.php" );
    include('control_panel.php');
?>
<!-- Start main content here -->



<!-- End main content here -->
<?php
    include( "../includes/footer.php" ); 
?>
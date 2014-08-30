<?php
    require_once ( "../php/DocInfo.php" );
    
    $docInfo = new wg\custom\DocInfo( );
    $docInfo->SetTitle( "FLP Exam" );
    $docInfo->SetAuthor( "FLP Exam Group" );
    $docInfo->SetDescription( "Foreign language examination for Clarion University." );
    
    $docInfo->SetTags( array( "foreign", "language", "palcement", "exam", "clarion", "university") );
    
    include( "../includes/header.php" );
?>
<!-- Start main content here -->



<!-- End main content here -->
<?php
    include( "../includes/footer.php" ); 
?>
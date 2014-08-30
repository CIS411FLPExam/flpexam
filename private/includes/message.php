<?php
    require_once ( "../php/DocInfo.php" );
    
    $docInfo = new wg\custom\DocInfo( );
    $docInfo->SetTitle( "VP Desings" );
    $docInfo->SetAuthor( "Wesley Garey" );
    $docInfo->SetDescription( "Fashion Designs" );
    
    $docInfo->SetTags( array( "desings", "clothes" ) );
    
    include( "../includes/header.php" );
?>
<!-- Start main content here -->

<?php
    echo('<p>');
    echo( htmlspecialchars( $message ) );
    echo('</p>');
    
    if ( !empty( $collection ) && is_array( $collection ) && count ( $collection ) > 0 )
    {
        echo( '<ul>' );
        
        foreach ( $collection as $item )
        {
            echo ( '<li>' . $item . '</li>' );
        }
        
        echo( '</ul>' );
    }
?>

<!-- End main content here -->
<?php
    include( "../includes/footer.php" ); 
?>
<?php
    include(HEADER_FILE);
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
    include( FOOTER_FILE ); 
?>
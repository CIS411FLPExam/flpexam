<?php
    echo('<p><b>');
    echo( htmlspecialchars( $message ) );
    echo('</b></p>');
    
    if ( !empty( $collection ) && is_array( $collection ) && count ( $collection ) > 0 )
    {
        echo( '<ul>' );
        
        foreach ( $collection as $item )
        {
            echo ( '<li>' . htmlspecialchars($item) . '</li>' );
        }
        
        echo( '</ul>' );
    }
?>
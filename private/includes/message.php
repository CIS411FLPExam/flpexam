<?php
    echo('<p>');
    echo( htmlspecialchars( $message ) );
    echo('</p>');
    
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
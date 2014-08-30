<?php
    function ToDisplayDate( $dateIn )
    {
        $phpDate = strtotime( $dateIn );
        
        if ( $phpDate == FALSE )
        {
            return "";
        }
        else
        {
            return date( 'm/d/Y', $phpDate );
        }		
    }
    
    function ToMySQLDate( $dateIn )
    {
        $phpDate = strtotime( $dateIn );
        
        if ( $phpDate == FALSE )
        {
            return "";
        }
        else
        {
            return date( 'Y-m-d', $phpDate );
        }		
    }
    
    function AdjustQuotes( )
    {
        if ( get_magic_quotes_gpc( ) == true )
        {
            array_walk_recursive( $_GET, 'StripSlashes_GPC' );
            array_walk_recursive( $_POST, 'StripSlashes_GPC' );
            array_walk_recursive( $_COOKIE, 'StripSlashes_GPC' );
            array_walk_recursive( $_REQUEST, 'StripSlashes_GPC' );
        }
    }
    
    function StripSlashes_GPC( &$value )
    {
        $value = stripslashes( $value );
    }
?>
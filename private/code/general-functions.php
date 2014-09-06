<?php

    /**
     * The validation pattern for a valid e-mail address.
     */
    define( "VALID_EMAIL_PATTERN", "/^[^@]*@[^@]*\.[^@]*$/" );
    
    /**
     * Redirects to a new page.
     * @param string $url The relative or absolute url of the page to go to.
     */
    function Redirect( $url )
    {
        header( "Location:" . $url );
    }
    
    /**
     * Gets the relative url for a controller action.
     * @param string $controller The controller file.
     * @param string $action The action to request from the controller.
     * @return string The relative url.
     */
    function GetControllerScript( $controller, $action )
    {
        $script = $controller . "?" . ACTION_KEYWORD . "=" . $action;
        
        return $script;
    }
    
    /**
     * Get the requested URI.
     * @return string The requested URI.
     */
    function GetRequestedURI( )
    {
        $uri = urlencode($_SERVER['REQUEST_URI']);
        
        return $uri;
    }
    
    /**
     * Converts a date string to the convientional format.
     * @param string $dateIn The current date string.
     * @return string The reformated date string.
     */
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
    
    /**
     * Converts a date string to the mySQL format.
     * @param string $dateIn The date string.
     * @return string The mySQL fomrated date string.
     */
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
    
    /**
     * Removes all special character slashes from information collected from the server.
     */
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
    
    /**
     * Removes all special character slashes from a string.
     * @param string $value The string to remove slashes.
     */
    function StripSlashes_GPC( &$value )
    {
        $value = stripslashes( $value );
    }
    
    /**
     * Redircts the user through a secured connection.
     */
    function SecureConnection( )
    {
        if ( !isset( $_SERVER['HTTPS'] ) )
        {
            $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            Redirect($url);
        }
    }
    
    /**
     * Redirects the user through an un-secure connection.
     */
    function UnsecureConnection($requestedPage = "")
    {
        if (isset($_SERVER['HTTPS']))
        {
            $url = "";
            
            if(empty($requestedPage))
            {
                $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            }
            else
            {
                $url = 'http://' . $_SERVER['HTTP_HOST'] .$requestedPage;
            }
            
            Redirect($url);
        }
    }
?>
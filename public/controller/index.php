<?php
    require_once('../../private/definitions/paths.php');
    require_once(PATHS_FILE);
    require_once(IDENTIFIER_FILE);
    require_once(GENERALFUNCTIONS_FILE);
    require_once(ACTIONS_FILE);
    require_once(MAINMODEL_FILE);
    
    error_reporting(E_ALL);
    
    StartSession( );
    AdjustQuotes();
    
    if (isset($_POST[ACTION_KEYWORD]))
    {
        $action = $_POST[ACTION_KEYWORD];
    }
    else if (isset($_GET[ACTION_KEYWORD]))
    {
        $action = $_GET[ACTION_KEYWORD];
    }
    else
    {
        $action = "";
    }
    
    if ($action != PROCESSLOGIN_ACTION && !userIsAuthorized($action))
    {
        if(!loggedIn())
        {
            $url = GetControllerScript(ADMINCONTROLLER_FILE, LOGIN_ACTION) . '&' . REQUESTEDPAGE_IDENTIFIER . '=' . GetRequestedURI( );
            Redirect( $url );
        }
        else
        {
            include( NOTAUTHORIZED_FILE );
        }
    }
    else
    {
        switch ($action)
        {
            case ABOUT_ACTION :
                ProcessAboutUs();
                break;
            case CONTACT_ACTION :
                ProcessContactUs();
                break;
            default :
                ProcessHome();
                break;
        }
    }
    
    function ProcessAboutUs()
    {
        include(ABOUT_FILE);
    }
    
    function ProcessContactUs()
    {
        $contact = GetPrimaryContact();
        
        include(CONTACT_FILE);
    }
    
    function ProcessHome()
    {
        include(HOME_FILE);
    }
?>
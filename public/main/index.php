<?php
    require_once('../../private/definitions/paths.php');
    require_once(GetPathsFile());
    require_once(GetIdentifierFile());
    require_once(GetGeneralFunctionsFile());
    require_once(GetActionsFile());
    require_once(GetMainModelFile());

    error_reporting(0);
    
    StartSession( );
    AdjustQuotes();
    
    if (isset($_POST[GetActionKeyWord()]))
    {
        $action = $_POST[GetActionKeyWord()];
    }
    else if (isset($_GET[GetActionKeyWord()]))
    {
        $action = $_GET[GetActionKeyWord()];
    }
    else
    {
        $action = "";
    }
    
    if ($action != GetProcessLoginAction() && !userIsAuthorized($action))
    {
        if(!loggedIn())
        {
            $url = GetControllerScript(GetAdminControllerFile(), GetLoginAction()) . '&' . GetRequestedPageIdentifier() . '=' . GetRequestedURI( );
            Redirect( $url );
        }
        else
        {
            include( GetNotAuthorizedFile() );
        }
    }
    else
    {
        switch ($action)
        {
            case GetAboutAction() :
                ProcessAboutUs();
                break;
            case GetContactAction() :
                ProcessContactUs();
                break;
            default :
                ProcessHome();
                break;
        }
    }
    
    function ProcessAboutUs()
    {
        include(GetAboutFormFile());
    }
    
    function ProcessContactUs()
    {
        $contact = GetPrimaryContact();
        
        include(GetContactFormFile());
    }
    
    function ProcessHome()
    {
        include(GetHomeFormFile());
    }
?>
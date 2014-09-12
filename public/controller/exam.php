<?php
    require_once('../../private/definitions/paths.php');
    require_once(MODEL_FILE);
    require_once(PATHS_FILE);
    require_once(IDENTIFIER_FILE);
    require_once(GENERALFUNCTIONS_FILE);
    require_once(ACTIONS_FILE);
    
    //error_reporting(E_ALL ^ E_NOTICE);
    
    StartSession( );
    
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
        $action ="";
    }
    
    if(!loggedIn())
    {
        $url = GetControllerScript(MAINCONTROLLER_FILE,LOGIN_ACTION) . "&" . REQUESTEDPAGE_IDENTIFIER . "=" . GetRequestedURI( );
        Redirect( $url );        
    }
    else
    {
        switch ($action)
        {
            case STARTEXAM_ACTION :
                ProcessStartExam();
                break;
            case SELECTEXAMLANGUAGE_ACTION :
                SelectExamLanguage();
                break;
            case PROCESSEXAMLANGUAGESELECT_ACTION :
                ProcessExamLanguageSelect();
                break;
            default :
                Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
                break;
        }
    }
    
    exit();
    
    function ProcessExamLanguageSelect()
    {
        $languageName = $_POST['Language'];
        
        Redirect(GetControllerScript(EXAMCONTROLLER_FILE, STARTEXAM_ACTION) . '&' . NAME_IDENTIFIER . '=' . $languageName);
    }
    
    function SelectExamLanguage()
    {
        $languages = GetAllActiveLanguages();
        $language = $languages[0][NAME_IDENTIFIER];
        
        include(SELECTLANGUAGEFORM_FILE);
    }
    
    function ProcessStartExam()
    {
        if(isset($_POST[NAME_IDENTIFIER]))
        {
            $language = $_POST[NAME_IDENTIFIER];
        }
        else if (isset ($_GET[NAME_IDENTIFIER]))
        {
            $language = $_GET[NAME_IDENTIFIER];
        }
        else
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, SELECTEXAMLANGUAGE_ACTION));
            exit();
        }
        
        $userID = $_SESSION[USERID_IDENTIFIER];
        
        $profile = GetProfile($userID);
        
        if(empty($profile))
        {
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, PROFILEADD_ACTION) . '&' . REQUESTEDPAGE_IDENTIFIER . '=' . GetRequestedURI());
            exit();
        }
        
        if(!userLanguageProfileExists($userID, $language))
        {
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, LANGUAGEPROFILEADD_ACTION) . '&' . REQUESTEDPAGE_IDENTIFIER . '=' . GetRequestedURI());
            exit();
        }
        
        echo('Exam');
    }
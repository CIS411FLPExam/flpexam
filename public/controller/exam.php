<?php
    require_once('../../private/definitions/paths.php');
    require_once(PATHS_FILE);
    require_once(IDENTIFIER_FILE);
    require_once(GENERALFUNCTIONS_FILE);
    require_once(ACTIONS_FILE);
    require_once(MODEL_FILE);
    require_once(EXAMMODEL_FILE);
    require_once(EXAMCLASS_FILE);
    require_once(LANGUAGECLASS_FILE);
    require_once(PROFILECLASS_FILE);
    require_once(QUESTIONANSWERCLASS_FILE);

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
        $action = "";
    }
    
    if (!UserIsClear() && $action!= ENTERKEYCODE_ACTION && $action != PROCESSKEYCODE_ACTION)
    {
        include(NOTAUTHORIZED_FILE);
        exit();
    }
    else
    {
        switch ($action)
        {
            case ENTERKEYCODE_ACTION :
                EnterKeyCode();
                break;
            case PROCESSKEYCODE_ACTION :
                ProcessKeyCode();
                break;
            case LANGUAGESELECT_ACTION :
                SelectLanguage();
                break;
            case PROCESSLANGUAGESELECT_ACTION :
                ProcessLanguageSelect();
                break;
            case PROFILECREATE_ACTION :
                ProfileCreate();
                break;
            case PROCESSPROFILECREATE_ACTION :
                ProcessProfileCreate();
                break;
            case STARTEXAM_ACTION :
                StartExam();
                break;
            default :
                Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
    }
    
    function EnterKeyCode()
    {
        include(KEYCODEFORM_FILE);
    }
    
    function ProcessKeyCode()
    {
        if (isset($_POST['KeyCode']))
        {
            $keyCode = $_POST['KeyCode'];

            if(ClearUser($keyCode))
            {
                Redirect(GetControllerScript(EXAMCONTROLLER_FILE, LANGUAGESELECT_ACTION));
            }
        }
        
        $message = 'Invalid key code.';
        
        include(KEYCODEFORM_FILE);
    }
    
    function SelectLanguage()
    {
        $exam = GetCurrentExam();
        
        if(!$exam->IsParametersSet())
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, ENTERKEYCODE_ACTION));
        }
        
        $languageNames = GetActiveLanguageNames();
        
        include(SELECTLANGUAGEFORM_FILE);
    }
    
    function ProcessLanguageSelect()
    {
        $exam = GetCurrentExam();
        
        if(!$exam->IsParametersSet())
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, ENTERKEYCODE_ACTION));
        }
        
        if(isset($_POST[NAME_IDENTIFIER]))
        {
            $languageName = $_POST[NAME_IDENTIFIER];
            
            $languageID = GetLanguageID($languageName);
            $isActive = IsActive($languageID);
            
            if($isActive)
            {
                $language = new Language($languageID, $languageName);
                
                $exam->SetLanguage($language);
                
                Redirect(GetControllerScript(EXAMCONTROLLER_FILE, PROFILECREATE_ACTION));
            }
        }
        
        $languageNames = GetActiveLanguageNames();
        
        $message = "An error occured when selecting the language.";
        
        include(SELECTLANGUAGEFORM_FILE);
    }
    
    function ProfileCreate()
    {
        $exam = GetCurrentExam();
        
        if(!$exam->IsLanguageSet())
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, LANGUAGESELECT_ACTION));
        }
        
        $experiences = GetLanguageExperienceNames();
        $initExpName = $experiences[0];
        
        $language = $exam->GetLanguage();        
        $profile = new Profile();
        
        $profile->SetJrHighExp($initExpName);
        $profile->SetSrHighExp($initExpName);
        $profile->SetCollegeExp($initExpName);
        
        include(CREATEPROFILEFORM_FILE);
    }
    
    function ProcessProfileCreate()
    {
        $exam = GetCurrentExam();
        
        if(!$exam->IsLanguageSet())
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, LANGUAGESELECT_ACTION));
        }
        
        $language = $exam->GetLanguage();
        $profile = new Profile();
        
        $profile->Initialize($_POST);
        
        
        if(true)
        {
            $exam->SetProfile($profile);
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, STARTEXAM_ACTION));
        }
        
        $experiences = GetLanguageExperienceNames();
        
        include(CREATEPROFILEFORM_FILE);
    }
    
    function StartExam()
    {
        CommitExam();
    }
    
    function CommitExam()
    {
        $exam = GetCurrentExam();
        $profile = $exam->GetProfile();
        
        $testEntryID = AddTestEntry($exam);
        AddTestee($testEntryID, $profile);
        AddTesteeExperiences($testEntryID, $profile);
        
        echo('Exam committed.');
        exit();
    }
?>
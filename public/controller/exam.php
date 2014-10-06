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
    error_reporting(E_ALL);
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
            case SUBMITANSWER_ACTION :
                SubmitAnswer();
                break;
            case TESTRESULTSVIEW_ACTION :
                TestResultsView();
                break;
            default :
                Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
    }
    
    function EnterKeyCode()
    {
        if(UserIsClear())
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, LANGUAGESELECT_ACTION));
        }
        
        include(KEYCODEFORM_FILE);
    }
    
    function ProcessKeyCode()
    {
        if(UserIsClear())
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, LANGUAGESELECT_ACTION));
        }
        
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
        
        if($exam == FALSE || !$exam->IsParametersSet())
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, ENTERKEYCODE_ACTION));
        }
        else if ($exam->IsLanguageSet())
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, PROFILECREATE_ACTION));
        }
        
        $languageNames = GetActiveLanguageNames();
        
        include(SELECTLANGUAGEFORM_FILE);
    }
    
    function ProcessLanguageSelect()
    {
        $exam = GetCurrentExam();
        
        if($exam == FALSE || !$exam->IsParametersSet())
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, ENTERKEYCODE_ACTION));
        }
        else if ($exam->IsLanguageSet())
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, PROFILECREATE_ACTION));
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
        
        if($exam == FALSE || !$exam->IsLanguageSet())
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, LANGUAGESELECT_ACTION));
        }
        else if ($exam->IsProfileSet())
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, STARTEXAM_ACTION));
        }
        
        $experiences = GetLanguageExperienceNames();
        $initExpName = $experiences[0];
        
        $language = $exam->GetLanguage();        
        
        $courses = GetLanguageCourses($language->GetId());
        
        $profile = new Profile();
        
        $profile->SetJrHighExp($initExpName);
        $profile->SetSrHighExp($initExpName);
        $profile->SetCollegeExp($initExpName);
        
        $profile->SetCurrentCourse($courses[0]);
        
        include(CREATEPROFILEFORM_FILE);
    }
    
    function ProcessProfileCreate()
    {
        $exam = GetCurrentExam();
        
        if($exam == FALSE || !$exam->IsLanguageSet())
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, LANGUAGESELECT_ACTION));
        }
        else if ($exam->IsProfileSet())
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, STARTEXAM_ACTION));
        }
        
        $language = $exam->GetLanguage();
        $profile = new Profile();
        
        $profile->Initialize($_POST);
        
        $profileVI = $profile->Validate();
        
        if($profileVI->IsValid())
        {
            $exam->SetProfile($profile);
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, STARTEXAM_ACTION));
        }
        else
        {
            $message = 'Profile Errors';
            $collection = $profileVI->GetErrors();
        }
        
        $experiences = GetLanguageExperienceNames();
        
        include(CREATEPROFILEFORM_FILE);
    }
    
    function StartExam()
    {
        $exam = GetCurrentExam();
        
        if ($exam == FALSE || !$exam->IsProfileSet())
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, PROFILECREATE_ACTION));
        }
        
        if(!$exam->IsStarted())
        {
            $exam->Start();
        }
        
        PresentNextQuestion();
    }
    
    function PresentNextQuestion()
    {
        $exam = GetCurrentExam();
        
        if($exam == FALSE || !$exam->IsStarted())
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, STARTEXAM_ACTION));
        }
        
        $questionID = $exam->PullNextQuestionID();
        
        $question = GetQuestion($questionID);
        
        $name = $question[NAME_IDENTIFIER];
        $instructions = $question['Instructions'];
        
        $answers = GetQuestionAnswers($questionID);
        
        shuffle($answers);
        
        include(TESTQUESTIONVIEWFORM_FILE);
    }
    
    function SubmitAnswer()
    {
        $exam = GetCurrentExam();
        
        if($exam == FALSE || !$exam->IsStarted())
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, STARTEXAM_ACTION));
        }
        
        if (isset($_POST[QUESTIONID_IDENTIFIER]) && isset($_POST[ANSWERID_IDENTIFIER]))
        {
            $questionID = $_POST[QUESTIONID_IDENTIFIER];
            $answerID = $_POST[ANSWERID_IDENTIFIER];

            $exam->PushQuestionAnswerID($questionID, $answerID);

            if($exam->IsDone() )
            {
                CommitExam();
            }
            else
            {
                PresentNextQuestion();
            }
        }
        else
        {
            $message = 'ERROR: Question and/or answer not sent to server.';
            
            include(MESSAGEFORM_FILE);
        }
    }
    
    function CommitExam()
    {
        $exam = GetCurrentExam();
        
        if ($exam == FALSE)
        {
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
        
        $profile = $exam->GetProfile();
        
        $testEntryID = AddTestEntry($exam);
        AddTestee($testEntryID, $profile);
        AddTesteeExperiences($testEntryID, $profile);
        
        $examQAs = $exam->GetAllQAs();
        foreach ($examQAs as $examQA)
        {
            $answerID = $examQA->GetAnswerId();
            IncrementQuestionStatisticAnswerCount($answerID);
        }
        
        DisposeCurrentExam();
        
        StoreTestId($testEntryID);
        
        TestResultsView();
    }
    
    function TestResultsView()
    {
        $testID = GetTestId();
        
        if ($testID == FALSE)
        {
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
        
        $testEntry = GetTestResults($testID);
        
        if ($testEntry == FALSE)
        {
            $message = 'Test not found.';
            
            include(MESSAGEFORM_FILE);
        }
        
        $score = $testEntry['Score'];
        $languageName = $testEntry['Language'];
        $languageID = GetLanguageID($languageName);
        
        $levelInfoID = GetLevelInfoID($languageID, $score);
        
        $levelInfo = GetLevelInfo($levelInfoID);
        $contact = GetPrimaryContact();
        
        include(VIEWTESTRESULTSFORM_FILE);
    }
?>
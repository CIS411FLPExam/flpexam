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
    require_once(QUESTIONCOMMENTCLASS_FILE);

    error_reporting(0);
    
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
    
    if (!UserIsClear() && $action!= ENTERKEYCODE_ACTION && $action != PROCESSKEYCODE_ACTION && $action != TESTRESULTSVIEW_ACTION)
    {
        $action = ENTERKEYCODE_ACTION;
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
        
        $contact = GetPrimaryContact();
        
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
                $language = new Language();
                $languageRow = GetLanguage($languageID);
                
                $language->Initialze($languageRow);
                
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
        
        $curCouse = $courses[0];
        $curCourseName = $curCouse['Name'];
        
        $profile->SetCurrentCourse($curCourseName);
        
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
        
        if (!$exam->IsDone())
        {
            PresentNextQuestion();
        }
        else
        {
            $message = 'Sorry for the inconvenience, but there are no questions for this exam.';
            include(MESSAGEFORM_FILE);
            exit();
        }
    }
    
    function PresentNextQuestion($message = '')
    {
        $exam = GetCurrentExam();
        
        if($exam == FALSE || !$exam->IsStarted())
        {
            Redirect(GetControllerScript(EXAMCONTROLLER_FILE, STARTEXAM_ACTION));
        }
        
        $language = $exam->GetLanguage();
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
            
            if (isset($_POST['FlagQuestion']))
            {
                $comment = '';
                
                if (isset($_POST['Comment']))
                {
                    $comment = $_POST['Comment'];
                }
                
                $qc = new QuestionComment();
                $qc->SetQuestionId($questionID);
                $qc->SetComment($comment);
                
                $exam->FlagQuestion($qc);
            }

            $exam->PushQuestionAnswerID($questionID, $answerID);

            if($exam->IsDone())
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
            $message = '* You must select an answer.';
            
            PresentNextQuestion($message);
        }
    }
    
    function CommitExam()
    {
        $exam = GetCurrentExam();
        
        if ($exam == FALSE)
        {
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
        
        DisposeCurrentExam();
        
        $language = $exam->GetLanguage();
        $profile = $exam->GetProfile();
        $examQAs = $exam->GetAllQAs();
        
        $testEntryID = AddTestEntry($exam);
        AddTestee($testEntryID, $profile);
        AddTesteeExperiences($testEntryID, $profile);
        AddTesteeQuestions($testEntryID, $examQAs);
        
        if ($language->IsAcceptingFeedback())
        {
            $questionIDs = array();
            $questionCommnents = array();
            $flaggedQuestions = $exam->GetFlaggedQuestions();
            
            foreach($flaggedQuestions as $qc)
            {
                $questionIDs[] = $qc->GetQuestionId();
                $commentTxt = $qc->GetComment();
                
                if (!empty($commentTxt))
                {
                    $questionCommnents[] = $qc;
                }
            }
            
            IncrementQuestionFlagCounts($questionIDs);
            RecordQuestionComments($questionCommnents);
        }
        
        $answerIDs = array();
        
        foreach ($examQAs as $examQA)
        {
            $answerID = $examQA->GetAnswerId();
            $answerIDs[] = $answerID;
        }
        
        IncrementAnswerChosenCounts($answerIDs);
        
        StoreTestId($testEntryID);
        
        //EmailTestResults($exam);//TODO: Uncomment this because it is for testing purposes only.
        
        Redirect(GetControllerScript(EXAMCONTROLLER_FILE, TESTRESULTSVIEW_ACTION));
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
            exit();
        }
        
        $score = $testEntry['Score'];
        $languageName = $testEntry['Language'];
        $languageID = GetLanguageID($languageName);
        
        $levelInfoID = GetLevelInfoID($languageID, $score);
        
        
        $levelInfoID = 0;//TODO: Get rid of this because it is for testing purposes only.
        
        $levelInfo = GetLevelInfo($levelInfoID);
        $contact = GetPrimaryContact();
        
        include(VIEWTESTRESULTSFORM_FILE);
    }
    
    function EmailTestResults($exam = FALSE)
    {
        if ($exam != FALSE)
        {
            $level = $exam->GetLevel();
            $profile = $exam->GetProfile();
            $language = $exam->GetLanguage();
            
            $name = $profile->GetFirstName();
            $email = $profile->GetEmail();
            $languageName = $language->GetName();
            
            $mailer = GetEmailMailer();
            $header = GetExamResultsEmailHeader();
            
            $contact = GetPrimaryContact();
            
            $message = "Hello " . $name . ",";
            $message .= "\r\n";
            $message .= "\r\n";
            $message .= "\tYou scored a " . $level . " on the " . $languageName . " placement exam.";
            $message .= " ";
            $message .= "This score, along with the additional information you submitted, will allow us to assess your " . $languageName;
            $message .= " ";
            $message .= "language skills. More importantly, it will help us with placing you in the appropriate level " . $languageName . " class.";
            $message .= " ";
            
            if ($contact->GetId() > 0)
            {
                $message .= "If you have any further questions or comments, please contact " . $contact->GetFirstName() . " " . $contact->GetLastName();
                $message .= " ";
                $message .= "at \"" . $contact->GetEmail() . "\".";
                $message .= " ";
            }
            
            $message .= "Thank you for taking one of Clarion University's Foreign Language placement exams.";
            $message .= "\r\n";
            $message .= "\r\n";
            $message .= "DO NOT REPLY";
            
            $recipients = array($email);
            $mailer->send($recipients, $header, $message);
        }
    }
?>
<?php
    require_once('../../private/definitions/paths.php');
    require_once(GetPathsFile());
    require_once(GetIdentifierFile());
    require_once(GetGeneralFunctionsFile());
    require_once(GetActionsFile());
    require_once(GetModelFile());
    require_once(GetExamModelFile());
    require_once(GetExamClassFile());
    require_once(GetLanguageClassFile());
    require_once(GetProfileClassFile());
    require_once(GetQuestionAnswerClassFile());
    require_once(GetQuestionCommentClassFile());
    require_once(GetLeoPairClassFile());

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
    
    if (!UserIsClear() && $action!= GetEnterKeyCodeAction() && $action != GetProcessKeyCodeAction() && $action != GetTestResultsViewAction())
    {
        Redirect(GetControllerScript(GetExamControllerFile(), GetEnterKeyCodeAction()));
    }
    else
    {
        switch ($action)
        {
            case GetEnterKeyCodeAction() :
                EnterKeyCode();
                break;
            case GetProcessKeyCodeAction() :
                ProcessKeyCode();
                break;
            case GetLanguageSelectAction() :
                SelectLanguage();
                break;
            case GetProcessLanguageSelectAction() :
                ProcessLanguageSelect();
                break;
            case GetProfileCreateAction() :
                ProfileCreate();
                break;
            case GetProcessProfileCreateAction() :
                ProcessProfileCreate();
                break;
            case GetStartExamAction() :
                StartExam();
                break;
            case GetSubmitAnswerAction() :
                SubmitAnswer();
                break;
            case GetTestResultsViewAction() :
                TestResultsView();
                break;
            default :
                Redirect(GetControllerScript(GetMainControllerFile(), GetHomeAction()));
        }
    }
    
    function EnterKeyCode()
    {
        if(UserIsClear())
        {
            Redirect(GetControllerScript(GetExamControllerFile(), GetLanguageSelectAction()));
        }
        
        include(GetKeyCodeFormFile());
    }
    
    function ProcessKeyCode()
    {
        if(UserIsClear())
        {
            Redirect(GetControllerScript(GetExamControllerFile(), GetLanguageSelectAction()));
        }
        
        if (isset($_POST['KeyCode']))
        {
            $keyCode = $_POST['KeyCode'];

            if(ClearUser($keyCode))
            {
                Redirect(GetControllerScript(GetExamControllerFile(), GetLanguageSelectAction()));
            }
        }
        
        $contact = GetPrimaryContact();
        
        include(GetKeyCodeFormFile());
    }
    
    function SelectLanguage()
    {
        $exam = GetCurrentExam();
        
        if($exam == FALSE || !$exam->IsParametersSet())
        {
            Redirect(GetControllerScript(GetExamControllerFile(), GetEnterKeyCodeAction()));
        }
        else if ($exam->IsLanguageSet())
        {
            Redirect(GetControllerScript(GetExamControllerFile(), GetProfileCreateAction()));
        }
        
        $languageNames = GetActiveLanguageNames();
        
        include(GetSelectLanguageFormFile());
    }
    
    function ProcessLanguageSelect()
    {
        $exam = GetCurrentExam();
        
        if($exam == FALSE || !$exam->IsParametersSet())
        {
            Redirect(GetControllerScript(GetExamControllerFile(), GetEnterKeyCodeAction()));
        }
        else if ($exam->IsLanguageSet())
        {
            Redirect(GetControllerScript(GetExamControllerFile(), GetProfileCreateAction()));
        }
        
        if(isset($_POST[GetNameIdentifier()]))
        {
            $languageName = $_POST[GetNameIdentifier()];
            
            $languageID = GetLanguageID($languageName);
            $isActive = IsActive($languageID);
            
            if($isActive)
            {
                $language = new Language();
                $languageRow = GetLanguage($languageID);
                
                $language->Initialze($languageRow);
                
                $exam->SetLanguage($language);
                
                Redirect(GetControllerScript(GetExamControllerFile(), GetProfileCreateAction()));
            }
        }
        
        $languageNames = GetActiveLanguageNames();
        
        $message = "An error occured when selecting the language.";
        
        include(GetSelectLanguageFormFile());
    }
    
    function ProfileCreate()
    {
        $exam = GetCurrentExam();
        
        if($exam == FALSE || !$exam->IsLanguageSet())
        {
            Redirect(GetControllerScript(GetExamControllerFile(), GetLanguageSelectAction()));
        }
        else if ($exam->IsProfileSet())
        {
            Redirect(GetControllerScript(GetExamControllerFile(), GetStartExamAction()));
        }
        
        $languageExperiences = GetAllLanguageExperiencesWithOptions();
        
        $language = $exam->GetLanguage();        
        
        $profile = new Profile();
        
        $profile->InitializeLEOs();
        
        include(GetCreateProfileFormFile());
    }
    
    function ProcessProfileCreate()
    {
        $exam = GetCurrentExam();
        
        if($exam == FALSE || !$exam->IsLanguageSet())
        {
            Redirect(GetControllerScript(GetExamControllerFile(), GetLanguageSelectAction()));
        }
        else if ($exam->IsProfileSet())
        {
            Redirect(GetControllerScript(GetExamControllerFile(), GetStartExamAction()));
        }
        
        $language = $exam->GetLanguage();
        $profile = new Profile();
        
        $profile->Initialize($_POST);
        
        $profileVI = $profile->Validate();
        
        if ($profileVI->IsValid())
        {
            $exam->SetProfile($profile);
            Redirect(GetControllerScript(GetExamControllerFile(), GetStartExamAction()));
        }
        
        $message = 'Profile Errors';
        $collection = $profileVI->GetErrors();
        
        $profile->InitializeLEOs();
        $languageExperiences = GetAllLanguageExperiencesWithOptions();
        
        include(GetCreateProfileFormFile());
    }
    
    function StartExam()
    {
        $exam = GetCurrentExam();
        
        if ($exam == FALSE || !$exam->IsProfileSet())
        {
            Redirect(GetControllerScript(GetExamControllerFile(), GetProfileCreateAction()));
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
            include(GetMessageFormFile());
            exit();
        }
    }
    
    function PresentNextQuestion($message = '')
    {
        $exam = GetCurrentExam();
        
        if($exam == FALSE || !$exam->IsStarted())
        {
            Redirect(GetControllerScript(GetExamControllerFile(), GetStartExamAction()));
        }
        
        $language = $exam->GetLanguage();
        $questionID = $exam->PullNextQuestionID();
        
        $question = GetQuestion($questionID);
        
        $name = $question[GetNameIdentifier()];
        $instructions = $question['Instructions'];
        
        $answers = GetQuestionAnswers($questionID);
        
        shuffle($answers);
        
        include(GetTestQuestionViewFormFile());
    }
    
    function SubmitAnswer()
    {
        $exam = GetCurrentExam();
        
        if($exam == FALSE || !$exam->IsStarted())
        {
            Redirect(GetControllerScript(GetExamControllerFile(), GetStartExamAction()));
        }
        
        if (isset($_POST[GetQuestionIdIdentifier()]) && isset($_POST[GetAnswerIdIdentifier()]))
        {
            $questionID = $_POST[GetQuestionIdIdentifier()];
            $answerID = $_POST[GetAnswerIdIdentifier()];
            
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
            Redirect(GetControllerScript(GetMainControllerFile(), GetHomeAction()));
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
        
        //EmailTestResults($exam);//TODO: Uncomment this when testing is done.
        
        Redirect(GetControllerScript(GetExamControllerFile(), GetTestResultsViewAction()));
    }
    
    function TestResultsView()
    {
        $testID = GetTestId();
        
        if ($testID == FALSE)
        {
            Redirect(GetControllerScript(GetMainControllerFile(), GetHomeAction()));
        }
        
        $testEntry = GetTestResults($testID);
        
        if ($testEntry == FALSE)
        {
            $message = 'Test not found.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $score = $testEntry['Score'];
        $languageName = $testEntry['Language'];
        $languageID = GetLanguageID($languageName);
        
        $levelInfoID = GetLevelInfoID($languageID, $score);
        
        
        $levelInfoID = 0;//TODO: Get rid of this because it is for testing purposes only.
        
        $levelInfo = GetLevelInfo($levelInfoID);
        $contact = GetPrimaryContact();
        
        include(GetViewTestResultsFormFile());
    }
    
    function EmailTestResults($exam = FALSE)
    {
        if ($exam != FALSE)
        {
            $level = $exam->GetLevel();
            $profile = $exam->GetProfile();
            $language = $exam->GetLanguage();
            
            $levelExists = LevelExists($language->GetId(), $level);
            
            $name = $profile->GetFirstName();
            $email = $profile->GetEmail();
            $languageName = $language->GetName();
            
            $mailer = GetEmailMailer();
            $header = GetExamResultsEmailHeader();
            
            $contact = GetPrimaryContact();
            
            $message = "Hello " . $name . ",";
            $message .= "\r\n";
            $message .= "\r\n";
            
            if ($levelExists == TRUE)
            {
                $message .= "\tYou scored a " . $level . " on the " . $languageName . " placement exam.";
                $message .= " ";
                $message .= "This score, along with the additional information you submitted, will allow us to assess your " . $languageName;
                $message .= " ";
                $message .= "language skills. More importantly, it will help us with placing you in the appropriate level " . $languageName . " class.";

                if ($contact->GetId() > 0)
                {
                    $message .= " ";
                    $message .= "If you have any further questions or comments, please contact " . $contact->GetFirstName() . " " . $contact->GetLastName();
                    $message .= " ";
                    $message .= "at \"" . $contact->GetEmail() . "\".";
                }
            }
            else
            {
                if ($contact->GetId() > 0)
                {
                    $message .= "\tPlease contact " . $contact->GetFirstName() . " " . $contact->GetLastName();
                    $message .= " ";
                    $message .= "at \"" . $contact->GetEmail() . "\" for your test results.";
                }
                else
                {
                    $message .= "\tPlease contact an administrator for your test results.";
                }
            }
            
            $message .= " ";
            $message .= "Thank you for taking one of Clarion University's Foreign Language placement exams.";
            $message .= "\r\n";
            $message .= "\r\n";
            $message .= "DO NOT REPLY";
            
            $recipients = array($email);
            $mailer->send($recipients, $header, $message);
        }
    }
?>
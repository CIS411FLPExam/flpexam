<?php
    require_once('../../private/definitions/paths.php');
    require_once(GetAdminModelFile());
    require_once(GetPathsFile());
    require_once(GetIdentifierFile());
    require_once(GetGeneralFunctionsFile());
    require_once(GetActionsFile());
    require_once(GetPHPExcelClassFile());
    require_once(GetPHPExcelIOFactoryClassFile());
    require_once(GetLevelInfoClassFile());
    require_once(GetExperienceOptionClassFile());

    error_reporting(0);
    
    StartSession();
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
        $action ="";
    }
    
    if(!loggedIn() && $action != GetLoginAction() && $action != GetProcessLoginAction())
    {
        $url = GetControllerScript(GetAdminControllerFile(), GetLoginAction()) . '&' . GetRequestedPageIdentifier() . '=' . GetRequestedURI( );
        Redirect( $url );
    }
    else if (!userIsAuthorized($action))
    {
        include( GetNotAuthorizedFile() );
    }
    else
    {
        switch ($action)
        {
            case GetLoginAction() :
                HandleLogin();
                break;
            case GetProcessLoginAction() :
                ProcessLogin();
                break;
            case GetLogoutAction() :
                logOut();
                Redirect(GetControllerScript(GetAdminControllerFile(), GetControlPanelAction()));
                break;
            case GetControlPanelAction() :
                include(GetControlPanelFormFile());
                break;
            case GetManageUsersAction() :
                ManageUsers();
                break;
            case GetUserAddAction() :
                UserAdd();
                break;
            case GetUserEditAction() :
                UserEdit();
                break;
            case GetUserDeleteAction() :
                UserDelete();
                break;
            case GetProcessUserAddAction() :
                ProcessUserAdd();
                break;
            case GetProcessUserEditAction() :
                ProcessUserEdit();
                break;
            case GetManageRolesAction() :
                ManageRoles();
                break;
            case GetRoleAddAction() :
                RoleAdd();
                break;
            case GetRoleEditAction() :
                RoleEdit();
                break;
            case GetRoleDeleteAction() :
                RoleDelete();
                break;
            case GetProcessRoleAddEditAction() :
                ProcessRoleAddEdit();
                break;
            case GetUserSearchAction() :
                ProcessUserSearch();
                break;
            case GetUserViewAction() :
                ProcessUserView();
                break;
            case GetManageLanguagesAction() :
                ManageLanguages();
                break;
            case GetLanguageAddAction() :
                ProcessLanguageAdd();
                break;
            case GetLanguageEditAction() :
                ProcessLanguageEdit();
                break;
            case GetLanguageViewAction() :
                ProcessLanguageView();
                break;
            case GetLanguageDeleteAction() :
                ProcessLanguageDelete();
                break;
            case GetProcessLanguageAddEditAction() :
                ProcessLanguageAddEdit();
                break;
            case GetManageQuestionsAction() :
                ManageQuestions();
                break;
            case GetQuestionAddAction() :
                ProcessQuestionAdd();
                break;
            case GetQuestionEditAction() :
                ProcessQuestionEdit();
                break;
            case GetQuestionViewAction():
                ProcessQuestionView();
                break;
            case GetQuestionDeleteAction() :
                ProcessQuestionDelete();
                break;
            case GetProcessQuestionAddEditAction() :
                ProcessQuestionAddEdit();
                break;
            case GetQuestionSearchAction() :
                ProcessQuestionSearch();
                break;
            case GetExamParametersViewAction() :
                ExamParametersView();
                break;
            case GetExamParametersEditAction() :
                ExamParametersEdit();
                break;
            case GetProcessExamParametersEditAction() :
                ProcessExamParametersEdit();
                break;
            case GetManageTestEntriesAction() :
                ManageTestEntries();
                break;
            case GetTestEntryViewAction() :
                TestEntryView();
                break;
            case GetTestEntryDeleteAction() :
                TestEntryDelete();
                break;
            case GetTestEntrySearchAction() :
                TestEntrySearch();
                break;
            case GetTestViewAction() :
                TestView();
                break;
            case GetLanguageImportAction() :
                LanguageImport();
                break;
            case GetLanguageExportAction() :
                LanguageExport();
                break;
            case GetLanguageStatisticsExportAction() :
                LanguageStatisticsExport();
                break;
            case GetManageContactsAction() :
                ManageContacts();
                break;
            case GetContactAddAction() :
                ContactAdd();
                break;
            case GetContactEditAction() :
                ContactEdit();
                break;
            case GetProcessContactAddEditAction() :
                ProcessContactAddEdit();
                break;
            case GetContactDeleteAction() :
                ContactDelete();
                break;
            case GetLanguageActivateAction() :
                LanguageActivate();
                break;
            case GetLangaugeDeactivateAction() :
                LanguageDeactivate();
                break;
            case GetContactActivateAction() :
                ContactActivate();
                break;
            case GetContactDeactivateAction() :
                ContactDeactivate();
                break;
            case GetManageLevelInfosAction() :
                ManageLevelInfos();
                break;
            case GetLevelInfoAddAction() :
                LevelInfoAdd();
                break;
            case GetLevelInfoViewAction() :
                LevelInfoView();
                break;
            case GetLevelInfoEditAction() :
                LevelInfoEdit();
                break;
            case GetLevelInfoDeleteAction() :
                LevelInfoDelete();
                break;
            case GetProcessLevelInfoAddEditAction() :
                ProcessLevelInfoAddEdit();
                break;
            case GetManageLanguageExperiencesAction() :
                ManageLanguageExperiences();
                break;
            case GetLanguageExperieneceAddAction() :
                LanguageExperiencesAdd();
                break;
            case GetLanguageExperienceEditAction() :
                LanguageExperiencesEdit();
                break;
            case GetLanguageExperienceViewAction() :
                LanguageExperiencesView();
                break;
            case GetLanguageExperienceDeleteAction() :
                LanguageExperiencesDelete();
                break;
            case GetProcessLanguageExperienceAddEditAction() :
                ProcessLanguageExperiencesAddEdit();
                break;
            case GetQuestionStatisticsResetAction() :
                QuestionStatisticsReset();
                break;
            case GetLanguageFeedbackActivateAction() :
                LanguageFeedbackActivate();
                break;
            case GetLanguageFeedbackDeactivateAction() :
                LanguageFeedbackDeactivate();
                break;
            case GetQuestionCommentsViewAction() :
                QuestionCommentsView();
                break;
            case GetManageExperienceOptionsAction() :
                ManageExperienceOptions();
                break;
            case GetExperienceOptionAddAction() :
                ExperienceOptionAdd();
                break;
            case GetExperienceOptionEditAction() :
                ExperienceOptionEdit();
                break;
            case GetExperienceOptionViewAction() :
                ExperienceOptionView();
                break;
            case GetExperienceOptionDeleteAction() :
                ExperienceOptionDelete();
                break;
            case GetProcessExperienceOptionAddEditAction() :
                ProcessExperienceOptionAddEdit();
                break;
            case GetTestResultsExportAction() :
                TestResultsExport();
                break;
            case GetTestEntriesUploadAction() :
                TestEntriesUpload();
                break;
            default:
                Redirect(GetControllerScript(GetAdminControllerFile(), GetControlPanelAction()));
        }
    }
    
    function TestEntriesUpload()
    {
        if (isset($_POST['Export']))
        {
            TestResultsExport();
        }
        else if (isset($_POST['Delete']))
        {
            TestEntryDelete();
        }
        else
        {
            $message = 'The action you wish to perform could not be resolved.';
            include(GetMessageFormFile());
        }
    }
    
    function TestResultsExport()
    {
        if (!userIsAuthorized(GetTestResultsExportAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $testIDs = array();
        
        if (isset($_POST["numListed"]))
        {
            $numListed = $_POST["numListed"];
            
            for($i = 0; $i < $numListed; ++$i)
            {
                if(isset($_POST["record$i"]))
                {
                    $testID = $_POST["record$i"];
                    
                    $testIDs[] = $testID;
                }
            }
        }
        
        $file = ExportTestResults($testIDs);
        
        if ($file != FALSE)
        {
            ignore_user_abort(true);

            header('Content-type: application/octet-stream');
            header('Content-Length: ' . filesize($file));
            header('Content-Disposition: attachment; filename=Test_Results_' . date("m-d-Y-G-i-s") . '.xlsx');
            readfile($file);

            DeleteFile($file);
        }
        else
        {
            $message = 'No tests were found to export.';
            include(GetMessageFormFile());
        }
    }
    
    function ManageExperienceOptions()
    {
        if (!userIsAuthorized(GetManageExperienceOptionsAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetLanguageExperienceIdIdentifier()]))
        {
            $experienceID = $_POST[GetLanguageExperienceIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageExperienceIdIdentifier()]))
        {
            $experienceID = $_GET[GetLanguageExperienceIdIdentifier()];
        }
        else if (isset($_POST[GetExperienceOptionIdIdentifier()]))
        {
            $optionID = $_POST[GetExperienceOptionIdIdentifier()];
        }
        else if (isset($_GET[GetExperienceOptionIdIdentifier()]))
        {
            $optionID = $_GET[GetExperienceOptionIdIdentifier()];
        }
        
        if (isset($optionID))
        {
            $experienceID = GetOptionExperienceID($optionID);
        }
        
        if (!isset($experienceID))
        {
            $message = 'No language experience or experience option I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $experience = GetLanguageExperience($experienceID);
        
        if ($experience == FALSE)
        {
            $message = 'The language experience\'s options you wish to manage does not exist.';
            include(GetMessageFormFile());
            exit();
        }
        
        $experienceName = $experience[GetNameIdentifier()];
        $options = GetExperienceOptions($experienceID);
        
        include(GetManageExperienceOptionsFormFile());
    }
    
    function ExperienceOptionAdd()
    {
        if(!userIsAuthorized(GetExperienceOptionAddAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetLanguageExperienceIdIdentifier()]))
        {
            $experienceID = $_POST[GetLanguageExperienceIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageExperienceIdIdentifier()]))
        {
            $experienceID = $_GET[GetLanguageExperienceIdIdentifier()];
        }
        else
        {
            $message = 'No lanugage experience I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $option = new ExperienceOption();
        
        include(GetAddEditExperienceOptionFormFile());
    }
    
    function ExperienceOptionEdit()
    {
        if (!userIsAuthorized(GetExperienceOptionEditAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetExperienceOptionIdIdentifier()]))
        {
            $optionID = $_POST[GetExperienceOptionIdIdentifier()];
        }
        else if (isset($_GET[GetExperienceOptionIdIdentifier()]))
        {
            $optionID = $_GET[GetExperienceOptionIdIdentifier()];
        }
        else
        {
            $message = 'No experience option I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $option = GetExperienceOption($optionID);
        
        if ($option->GetId() > 0)
        {
            $experienceID = $option->GetExperienceId();
            include(GetAddEditExperienceOptionFormFile());
        }
        else
        {
            $message = 'The experience option you wish to edit does not exist.';
            include(GetMessageFormFile());
            exit();
        }
    }
    
    function ExperienceOptionView()
    {
        if (!userIsAuthorized(GetExperienceOptionViewAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetExperienceOptionIdIdentifier()]))
        {
            $optionID = $_POST[GetExperienceOptionIdIdentifier()];
        }
        else if (isset($_GET[GetExperienceOptionIdIdentifier()]))
        {
            $optionID = $_GET[GetExperienceOptionIdIdentifier()];
        }
        else
        {
            $message = 'No experience option I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $option = GetExperienceOption($optionID);
        
        if ($option->GetId() > 0)
        {
            include(GetViewExperienceOptionFormFile());
        }
        else
        {
            $message = 'The experience option you wish to view does not exist.';
            include(GetMessageFormFile());
            exit();
        }
    }
    
    function ExperienceOptionDelete()
    {
        if(!userIsAuthorized(GetExperienceOptionDeleteAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $experienceID = 0;
        
        if (isset($_POST[GetLanguageExperienceIdIdentifier()]))
        {
            $experienceID = $_POST[GetLanguageExperienceIdIdentifier()];
        }
        
        if(isset($_POST["numListed"]))
        {
            $numListed = $_POST["numListed"];
            
            for($i = 0; $i < $numListed; ++$i)
            {
                if(isset($_POST["record$i"]))
                {
                    $optionID = $_POST["record$i"];
                    
                    DeleteExperienceOption($optionID);
                }
            }
        }
        
        Redirect(GetControllerScript(GetAdminControllerFile(), GetManageExperienceOptionsAction()) . '&' . GetLanguageExperienceIdIdentifier() . '=' . urlencode($experienceID));
    }
    
    function ProcessExperienceOptionAddEdit()
    {
        if (isset($_POST[GetExperienceOptionIdIdentifier()]))
        {
            $optionID = $_POST[GetExperienceOptionIdIdentifier()];
        }
        else if (isset($_GET[GetExperienceOptionIdIdentifier()]))
        {
            $optionID = $_GET[GetExperienceOptionIdIdentifier()];
        }
        else if (isset($_POST[GetLanguageExperienceIdIdentifier()]))
        {
            $experienceID = $_POST[GetLanguageExperienceIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageExperienceIdIdentifier()]))
        {
            $experienceID = $_GET[GetLanguageExperienceIdIdentifier()];
        }
        
        $option = new ExperienceOption();
        $option->Initialize($_POST);
        $optionVI = $option->Validate();
        
        if ($optionVI->IsValid())
        {
            if (isset($optionID))
            {//We are doing an edit.
                if (userIsAuthorized(GetExperienceOptionEditAction()))
                {
                    UpdateExperienceOption($option);
                }
                else
                {
                    include(GetNotAuthorizedFile());
                    exit();
                }
            }
            else if (isset($experienceID))
            {//We are doing an add.
                
                if (userIsAuthorized(GetExperienceOptionAddAction()))
                {
                    $optionID = AddExperienceOption($option);
                    
                    if ($optionID == 0)
                    {
                        unset($optionID);
                        $message = 'The option already exists.';
                        include(GetAddEditExperienceOptionFormFile());
                        exit();
                    }
                }
                else
                {
                    include(GetNotAuthorizedFile());
                    exit();
                }
            }
            else
            {
                $message = 'No experience option or language experience I.D. provided.';

                include(GetMessageFormFile());
                exit();
            }
            
            Redirect(GetControllerScript(GetAdminControllerFile(), GetExperienceOptionViewAction()) . '&' . GetExperienceOptionIdIdentifier() . '=' . urlencode($optionID));
        }
        
        $message = 'Errors';
        $collection = $optionVI->GetErrors();
        
        include(GetAddEditExperienceOptionFormFile());
    }
    
    function QuestionCommentsView()
    {
        if (!userIsAuthorized(GetQuestionViewAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetQuestionIdIdentifier()]))
        {
            $questionID = $_POST[GetQuestionIdIdentifier()];
        }
        else if (isset($_GET[GetQuestionIdIdentifier()]))
        {
            $questionID = $_GET[GetQuestionIdIdentifier()];
        }
        else
        {
            $message = 'No question I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $comments = GetQuestionComments($questionID);
        
        include(GetViewQuestionCommentsFormFile());
    }
    
    function LanguageFeedbackActivate()
    {
        if(!userIsAuthorized(GetLanguageEditAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if(isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageIdIdentifier()]))
        {
            $languageID = $_GET[GetLanguageIdIdentifier()];
        }
        else
        {
            $message = 'No lanugage I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        ActivateLanguageFeedback($languageID);
            
        Redirect(GetControllerScript(GetAdminControllerFile(), GetManageLanguagesAction()));
    }
    
    function LanguageFeedbackDeactivate()
    {
        if(!userIsAuthorized(GetLanguageEditAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if(isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageIdIdentifier()]))
        {
            $languageID = $_GET[GetLanguageIdIdentifier()];
        }
        else
        {
            $message = 'No lanugage I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        DeactivateLanguageFeedback($languageID);
        
        Redirect(GetControllerScript(GetAdminControllerFile(), GetManageLanguagesAction()));
    }
    
    function TestView()
    {
        if (!userIsAuthorized(GetTestViewAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetTestIdIdentifier()]))
        {
            $testID = $_POST[GetTestIdIdentifier()];
        }
        else if (isset($_GET[GetTestIdIdentifier()]))
        {
            $testID = $_GET[GetTestIdIdentifier()];
        }
        else
        {
            $message = 'No test I.D. provided.';
            exit();
        }
        
        $testQAs = GetTestQAs($testID);
        
        if (count($testQAs) > 0)
        {
            $testInfo = GetDetailedTestEntry($testID);
            $testeeName = $testInfo->GetFirstName() . ' ' . $testInfo->GetLastName();
            
            include(GetViewTestFormFile());
        }
        else
        {
            $message = 'The test you are trying to view does not have any questions or answers.';
            include(GetMessageFormFile());
        }
    }
    
    function QuestionStatisticsReset()
    {
        if(!userIsAuthorized(GetQuestionEditAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetQuestionIdIdentifier()]))
        {
            $questionID = $_POST[GetQuestionIdIdentifier()];
        }
        else if (isset($_GET[GetQuestionIdIdentifier()]))
        {
            $questionID = $_GET[GetQuestionIdIdentifier()];
        }
        else if (isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageIdIdentifier()]))
        {
            $languageID = $_GET[GetLanguageIdIdentifier()];
        }
        else
        {
            $message = 'No language or question I.D. provided.';
            include(GetMessageFormFile());
            exit();
        }
        
        if (isset($questionID))
        {//Reseting the statistics for one question.
            ResetQuestionStatistics($questionID);
            Redirect(GetControllerScript(GetAdminControllerFile(), GetQuestionViewAction()) . '&' . GetQuestionIdIdentifier() . '=' . urlencode($questionID));
        }
        else if (isset($languageID))
        {//Reseting the statistics for an entire language.
            ResetLanguageQuestionStatistics($languageID);
            Redirect(GetControllerScript(GetAdminControllerFile(), GetManageQuestionsAction()) . '&' . GetLanguageIdIdentifier() . '=' . urlencode($languageID));
        }
        
        Redirect(GetControllerScript(GetMainControllerFile(), GetHomeAction()));
    }
    
    function ManageLanguageExperiences()
    {
        if (!userIsAuthorized(GetManageLanguageExperiencesAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $experiences = GetLanguageExperiences();
        
        include(GetManageLanguageExperiencesFormFile());
    }
    
    function LanguageExperiencesAdd()
    {
        if (!userIsAuthorized(GetLanguageExperieneceAddAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $experience = new LanguageExperience();
        
        include(GetAddEditLanguageExperienceFormFile());
    }
    
    function LanguageExperiencesEdit()
    {
        if (!userIsAuthorized(GetLanguageExperienceEditAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetLanguageExperienceIdIdentifier()]))
        {
            $experienceID = $_POST[GetLanguageExperienceIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageExperienceIdIdentifier()]))
        {
            $experienceID =$_GET[GetLanguageExperienceIdIdentifier()];
        }
        else
        {
            $message = 'No language experience I.D. provided.';
            include(GetMessageFormFile());
            exit();
        }
        
        $row = GetLanguageExperience($experienceID);
        
        if ($row != FALSE)
        {
            $experience = new LanguageExperience();
            $experience->Initialize($row);
            
            include(GetAddEditLanguageExperienceFormFile());
        }
        else
        {
            $message = 'The language experience you are trying to edit does not exist.';
            include(GetMessageFormFile());
        }
    }
    
    function LanguageExperiencesView()
    {
        if (!userIsAuthorized(GetLanguageExperienceViewAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetLanguageExperienceIdIdentifier()]))
        {
            $experienceID = $_POST[GetLanguageExperienceIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageExperienceIdIdentifier()]))
        {
            $experienceID =$_GET[GetLanguageExperienceIdIdentifier()];
        }
        else
        {
            $message = 'No language experience I.D. provided.';
            include(GetMessageFormFile());
            exit();
        }
        
        $row = GetLanguageExperience($experienceID);
        
        if ($row != FALSE)
        {
            $experience = new LanguageExperience();
            $experience->Initialize($row);
            
            include(GetViewLanguageExperienceFormFile());
        }
        else
        {
            $message = 'The language experience you are trying to view does not exist.';
            include(GetMessageFormFile());
        }
    }
    
    function ProcessLanguageExperiencesAddEdit()
    {
        $userCanAdd = userIsAuthorized(GetLanguageExperieneceAddAction());
        $userCanEdit = userIsAuthorized(GetLanguageExperienceEditAction());
        
        if (!$userCanAdd && !$userCanEdit)
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $experience = new LanguageExperience();
        
        $experience->Initialize($_POST);
        $experienceVI = $experience->Validate();
        
        if ($experienceVI->IsValid())
        {
            if ($experience->GetId() > 0)
            {//We are doing an edit
                $experienceID = $experience->GetId();
                
                if ($userCanEdit)
                {
                    UpdateLanguageExperience($experience);
                }
                else
                {
                    include(GetNotAuthorizedFile());
                    exit();
                }
            }
            else
            {//We are doing an add
                if ($userCanAdd)
                {
                    $experienceID = AddLanguageExperience($experience);
                    
                    if ($experienceID > 0)
                    {
                        $option = new ExperienceOption();
                        $option->SetExperienceId($experienceID);
                        $option->SetName('None');
                        $option->SetInitLevel(1);
                    
                        AddExperienceOption($option);
                    }
                    else
                    {
                        unset($experienceID);
                        $message = 'The language experience already exists.';
                        
                        include(GetAddEditLanguageExperienceFormFile());
                        exit();
                    }
                }
                else
                {
                    include(GetNotAuthorizedFile());
                    exit();
                }
            }
            
            Redirect(GetControllerScript(GetAdminControllerFile(), GetLanguageExperienceViewAction()) . '&' . GetLanguageExperienceIdIdentifier() . '=' . $experienceID);
        }
        
        $message = 'Errors';
        $collection = $experienceVI->GetErrors();
        
        include(GetAddEditLanguageExperienceFormFile());
    }
    
    function LanguageExperiencesDelete()
    {
        if(!userIsAuthorized(GetLanguageExperienceDeleteAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if(isset($_POST["numListed"]))
        {
            $numListed = $_POST["numListed"];
            
            for($i = 0; $i < $numListed; ++$i)
            {
                if(isset($_POST["record$i"]))
                {
                    $experienceID = $_POST["record$i"];
                    
                    DeleteLanguageExperience($experienceID);
                }
            }
        }
        
        Redirect(GetControllerScript(GetAdminControllerFile(), GetManageLanguageExperiencesAction()));
    }
    
    function ManageLevelInfos()
    {
        if(!userIsAuthorized(GetManageLevelInfosAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageIdIdentifier()]))
        {
            $languageID = $_GET[GetLanguageIdIdentifier()];
        }
        else
        {
            $message = 'No language I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $levelinfos = GetLevelInfos($languageID);
        $language = GetLanguage($languageID);
        
        if ($language != FALSE)
        {
            $languageName = $language[GetNameIdentifier()];
        
            include(GetManageLevelInfosFormFile());
        }
        else
        {
            $message = 'The language you wish to modify does not exist.';
            include(GetMessageFormFile());
        }
    }
    
    function LevelInfoAdd()
    {
        if(!userIsAuthorized(GetLevelInfoAddAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageIdIdentifier()]))
        {
            $languageID = $_GET[GetLanguageIdIdentifier()];
        }
        else
        {
            $message = 'No language I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $levelInfo = new LevelInfo();
        
        include(GetAddEditLevelInfoFormFile());
    }
    
    function LevelInfoView()
    {
        if(!userIsAuthorized(GetLevelInfoViewAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        if (isset($_POST[GetLevelInfoIdIdentifier()]))
        {
            $levelInfoID = $_POST[GetLevelInfoIdIdentifier()];
        }
        else if (isset($_GET[GetLevelInfoIdIdentifier()]))
        {
            $levelInfoID = $_GET[GetLevelInfoIdIdentifier()];
        }
        else
        {
            $message = 'No level information I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $levelInfo = GetLevelInfo($levelInfoID);
        
        if ($levelInfo->GetId() > 0)
        {
            include(GetViewLevelInfoFormFile());
        }
        else
        {
            $message = 'The level information you wish to view does not exist.';
            include(GetMessageFormFile());
        }
    }
    
    function LevelInfoEdit()
    {
        if(!userIsAuthorized(GetLevelInfoEditAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetLevelInfoIdIdentifier()]))
        {
            $levelInfoID = $_POST[GetLevelInfoIdIdentifier()];
        }
        else if (isset($_GET[GetLevelInfoIdIdentifier()]))
        {
            $levelInfoID = $_GET[GetLevelInfoIdIdentifier()];
        }
        else
        {
            $message = 'No level information I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $levelInfo = GetLevelInfo($levelInfoID);
        $languageID = $levelInfo->GetLanguageId();
        
        if ($levelInfo->GetId() > 0)
        {
            include(GetAddEditLevelInfoFormFile());
        }
        else
        {
            $message = 'The level information you wish to edit does not exist.';
            include(GetMessageFormFile());
        }
    }
    
    function ProcessLevelInfoAddEdit()
    {
        if (isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageIdIdentifier()]))
        {
            $languageID = $_GET[GetLanguageIdIdentifier()];
        }
        else
        {
            $message = 'No language I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $language = GetLanguage($languageID);
        $languageName = $language[GetNameIdentifier()];
        
        $levelInfo = new LevelInfo();
        $levelInfo->Initialize($_POST);
        
        $levelInfoVI = $levelInfo->Validate();
        
        if ($levelInfoVI->IsValid())
        {
            if (isset($_POST[GetLevelInfoIdIdentifier()]))
            {//We are doing an edit.
                if (userIsAuthorized(GetLevelInfoEditAction()))
                {
                    UpdateLevelInfo($levelInfo);
                    $levelInfoID = $levelInfo->GetId();
                }
                else
                {
                    include(GetNotAuthorizedFile());
                    exit();
                }
            }
            else
            {//We are doing an add.
                
                $level = $levelInfo->GetLevel();
                
                if (LevelInfoExists($languageID, $level))
                {
                    $message = 'The inforamtion for this level already exists';
                    
                    include(GetAddEditLevelInfoFormFile());
                    exit();
                }
                
                if (userIsAuthorized(GetLevelInfoAddAction()))
                {
                    $levelInfoID = AddLevelInfo($levelInfo);
                }
                else
                {
                    include(GetNotAuthorizedFile());
                    exit();
                }
            }
            
            Redirect(GetControllerScript(GetAdminControllerFile(), GetLevelInfoViewAction()) . '&' . GetLevelInfoIdIdentifier() . '=' . urlencode($levelInfoID));
        }
        
        $message = 'Errors';
        $collection = $levelInfoVI->GetErrors();
        
        include(GetAddEditLevelInfoFormFile());
    }
    
    function LevelInfoDelete()
    {
        if(!userIsAuthorized(GetLevelInfoDeleteAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageIdIdentifier()]))
        {
            $languageID = $_GET[GetLanguageIdIdentifier()];
        }
        else
        {
            $message = 'No language I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        if(isset($_POST["numListed"]))
        {
            $numListed = $_POST["numListed"];
            
            for($i = 0; $i < $numListed; ++$i)
            {
                if(isset($_POST["record$i"]))
                {
                    $levelInfoId = $_POST["record$i"];
                    
                    DeleteLevelInfo($levelInfoId);
                }
            }
        }
        
        Redirect(GetControllerScript(GetAdminControllerFile(), GetManageLevelInfosAction()) . '&' . GetLanguageIdIdentifier() . '=' . urlencode($languageID));
    }
    
    function LanguageActivate()
    {
        if(!userIsAuthorized(GetLanguageEditAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if(isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageIdIdentifier()]))
        {
            $languageID = $_GET[GetLanguageIdIdentifier()];
        }
        else
        {
            $message = 'No lanugage I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        ActivateLanguage($languageID);
            
        Redirect(GetControllerScript(GetAdminControllerFile(), GetManageLanguagesAction()));
    }
    
    function LanguageDeactivate()
    {
        if(!userIsAuthorized(GetLanguageEditAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if(isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageIdIdentifier()]))
        {
            $languageID = $_GET[GetLanguageIdIdentifier()];
        }
        else
        {
            $message = 'No lanugage I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        DeactivateLanguage($languageID);
        
        Redirect(GetControllerScript(GetAdminControllerFile(), GetManageLanguagesAction()));
    }
    
    function ContactActivate()
    {
        if(!userIsAuthorized(GetContactEditAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if(isset($_POST[GetContactsIdIdentifier()]))
        {
            $contactID = $_POST[GetContactsIdIdentifier()];
        }
        else if (isset($_GET[GetContactsIdIdentifier()]))
        {
            $contactID = $_GET[GetContactsIdIdentifier()];
        }
        else
        {
            $message = 'No contact I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $contacts = GetContacts();

        foreach ($contacts as $contact)
        {
            DeactivateContact($contact->GetId());
        }

        ActivateContact($contactID);
        
        Redirect(GetControllerScript(GetAdminControllerFile(), GetManageContactsAction()));
    }
    
    function ContactDeactivate()
    {
        if(!userIsAuthorized(GetContactEditAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if(isset($_POST[GetContactsIdIdentifier()]))
        {
            $contactID = $_POST[GetContactsIdIdentifier()];
        }
        else if (isset($_GET[GetContactsIdIdentifier()]))
        {
            $contactID = $_GET[GetContactsIdIdentifier()];
        }
        else
        {
            $message = 'No contact I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        DeactivateContact($contactID);
        
        Redirect(GetControllerScript(GetAdminControllerFile(), GetManageContactsAction()));
    }
    
    function ContactAdd()
    {
        if (!userIsAuthorized(GetContactAddAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $contact = new Contact();
        
        include(GetAddEditContactFormFile());
    }
    
    function ContactEdit()
    {
        if (!userIsAuthorized(GetContactEditAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if(isset($_POST[GetContactsIdIdentifier()]))
        {
            $contactID = $_POST[GetContactsIdIdentifier()];
        }
        else if (isset($_GET[GetContactsIdIdentifier()]))
        {
            $contactID = $_GET[GetContactsIdIdentifier()];
        }
        else
        {
            $message = 'No contact I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $contact = GetContact($contactID);
        
        if ($contact->GetId() > 0)
        {
            include(GetAddEditContactFormFile());
        }
        else
        {
            $message = 'The contact you wish to edit does not exist.';
            include(GetMessageFormFile());
        }
    }
    
    function ProcessContactAddEdit()
    {
        if(isset($_POST[GetContactsIdIdentifier()]))
        {
            $contactID = $_POST[GetContactsIdIdentifier()];
        }
                
        $contact = new Contact();
        $contact->Initialize($_POST);
        
        $contactVI = $contact->Validate();
        
        if(!$contactVI->IsValid())
        {
            $message = 'Errors';
            $collection = $contactVI->GetErrors();
            
            include(GetAddEditContactFormFile());
        }
        else
        {
            if(isset($contactID))
            {
                if(userIsAuthorized(GetContactEditAction()))
                {
                    UpdateContact($contactID, $contact);
                }
                else
                {
                    include(GetNotAuthorizedFile());
                    exit();
                }
            }
            else
            {
                if(userIsAuthorized(GetContactAddAction()))
                {
                    AddContact($contact);
                }
                else
                {
                    include(GetNotAuthorizedFile());
                    exit();
                }
            }
            
            Redirect(GetControllerScript(GetAdminControllerFile(), GetManageContactsAction()));
        }
    }
    
    function ContactDelete()
    {
        if (!userIsAuthorized(GetContactDeleteAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if(isset($_POST["numListed"]))
        {
            $numListed = $_POST["numListed"];
            
            for($i = 0; $i < $numListed; ++$i)
            {
                if(isset($_POST["record$i"]))
                {
                    $contactID = $_POST["record$i"];
                    
                    DeleteContact($contactID);
                }
            }
        }
        
        Redirect(GetControllerScript(GetAdminControllerFile(), GetManageContactsAction()));
    }
    
    function ManageContacts()
    {
        if(!userIsAuthorized(GetManageContactsAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $contacts = GetContacts();
        
        include(GetManageContactsFormFile());
    }
    
    function LanguageImport()
    {
        if(!userIsAuthorized(GetLanguageImportAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if(isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageIdIdentifier()]))
        {
            $languageID = $_GET[GetLanguageIdIdentifier()];
        }
        else
        {
            $message = 'No lanugage I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        if (isset($_POST['Add']))
        {
            LanguageImportAdd();
        }
        else if (isset($_POST['Update']))
        {
            LanguageImportUpdate();
        }
        else
        {
            $message = 'Could not reslove import type.';
            include(GetMessageFormFile());
            exit();
        }
    }
    
    function LanguageImportAdd()
    {
        if(!userIsAuthorized(GetLanguageImportAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if(isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageIdIdentifier()]))
        {
            $languageID = $_GET[GetLanguageIdIdentifier()];
        }
        else
        {
            $message = 'No lanugage I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $errors = array();
        
        if(isset($_FILES['file']))
        {
            $file = $_FILES['file'];
            $filePath = $file ['tmp_name'];
            $mime = $file['type'];
            $error = $file['error'];
            
            if ($error == UPLOAD_ERR_NO_FILE)
            {
                $errors[] = 'No file selected for upload.';
            }
            else if ($error != 0)
            {
                $errors[] = 'Error uploading file to server.';
            }
            else if ($mime == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document')
            {
                $type = 'Word';
            }
            else
            {
                $errors[] = 'The file type is not of a valid Word format.';
            }
            
            if (count($errors) == 0)
            {
                $questions = array();
                
                if ($type == 'Word')
                {
                    $fileConents = GetWordDocContents($filePath);
                    
                    include(GetProcessLanguageImportWordFile());
                }
                
                if (count($errors) == 0)
                {
                    foreach($questions as $question)
                    {
                        $level = $question['Level'];
                        $instructions = $question['Instructions'];
                        $quesName = $question[GetNameIdentifier()];
                        $answers = $question['Answers'];

                        AddQuestion($languageID, $quesName, $instructions, $level, $answers);
                    }

                    Redirect(GetControllerScript(GetAdminControllerFile(), GetManageQuestionsAction()) . '&' . GetLanguageIdIdentifier() . '=' . $languageID);
                }
            }
        }
        
        $level = 1;
        $lang = GetLanguage($languageID);
        $questions = GetQuestions($languageID, $level);
        
        AppendQuestionAvgScores($questions);
        
        $language = $lang[GetNameIdentifier()];
        
        $message = 'Error Adding Questions.';
        $collection = $errors;
        
        if (isset($name))
        {
            unset($name);
        }
        
        include(GetMangageQuestionsFormFile());
    }
    
    function LanguageImportUpdate()
    {
        if(!userIsAuthorized(GetLanguageImportAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if(isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageIdIdentifier()]))
        {
            $languageID = $_GET[GetLanguageIdIdentifier()];
        }
        else
        {
            $message = 'No lanugage I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $errors = array();
        
        if(isset($_FILES['file']))
        {
            $file = $_FILES['file'];
            $filePath = $file ['tmp_name'];
            $mime = $file['type'];
            $error = $file['error'];
            
            if ($error == UPLOAD_ERR_NO_FILE)
            {
                $errors[] = 'No file selected for upload.';
            }
            else if ($error != 0)
            {
                $errors[] = 'Error uploading file to server.';
            }
            else if($mime == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            {
                $type = 'Excel';
            }
            else
            {
                $errors[] = 'The file type is not of a valid Excel format.';
            }
            
            if (count($errors) == 0)
            {
                $questions = array();
                
                if ($type == 'Excel')
                {
                    $objPHPExcel = OpenExcelFile($filePath);
                    
                    include(GetProcessLanguageImportExcelFile());
                }
                
                if (count($errors) == 0)
                {
                    foreach($questions as $question)
                    {
                        $questionID = $question[GetQuestionIdIdentifier()];
                        $level = $question['Level'];
                        $instructions = $question['Instructions'];
                        $quesName = $question[GetNameIdentifier()];
                        $answers = $question['Answers'];

                        if($questionID > 0)
                        {
                            UpdateQuestion($questionID, $quesName, $instructions, $level, $answers);
                        }
                    }

                    Redirect(GetControllerScript(GetAdminControllerFile(), GetManageQuestionsAction()) . '&' . GetLanguageIdIdentifier() . '=' . $languageID);
                }
            }
        }
        
        $level = 1;
        $lang = GetLanguage($languageID);
        $questions = GetQuestions($languageID, $level);
        
        AppendQuestionAvgScores($questions);
        
        $language = $lang[GetNameIdentifier()];
        
        $message = 'Error Updating Questions.';
        $collection = $errors;
        
        if (isset($name))
        {
            unset($name);
        }
        
        include(GetMangageQuestionsFormFile());
    }
    
    function LanguageExport()
    {
        if(!userIsAuthorized(GetLanguageExportAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if(isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageIdIdentifier()]))
        {
            $languageID = $_GET[GetLanguageIdIdentifier()];
        }
        else
        {
            $message = 'No lanugage I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $language = GetLanguage($languageID);
        
        if ($language != FALSE)
        {
            $languageName = $language[GetNameIdentifier()];

            ignore_user_abort(true);

            $file = ExportLanguageQuestions($languageID);

            header('Content-type: application/octet-stream');
            header('Content-Length: ' . filesize($file));
            header('Content-Disposition: attachment; filename=' . $languageName .'.xlsx');
            readfile($file);

            DeleteFile($file);
        }
        else
        {
            $message = 'The language you wish to export does not exist.';
            include(GetMessageFormFile());
        }
    }
    
    function LanguageStatisticsExport()
    {
        if(!userIsAuthorized(GetLanguageStatisticsExportAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if(isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageIdIdentifier()]))
        {
            $languageID = $_GET[GetLanguageIdIdentifier()];
        }
        else
        {
            $message = 'No lanugage I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $language = GetLanguage($languageID);
        
        if ($language != FALSE)
        {
            $languageName = $language[GetNameIdentifier()];

            ignore_user_abort(true);

            $file = ExportLanguageStatistics($languageID);

            header('Content-type: application/octet-stream');
            header('Content-Length: ' . filesize($file));
            header('Content-Disposition: attachment; filename=' . $languageName .'_stats.xlsx');
            readfile($file);

            DeleteFile($file);
        }
        else
        {
            $message = 'The language you wish to export does not exist.';
            include(GetMessageFormFile());
        }
    }
    
    function TestEntryView()
    {
        if(!userIsAuthorized(GetTestEntryViewAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $testInfo = new DetailedTestInfo();
        $testIdIndex = $testInfo->GetIdIndex();
        
        if(isset($_POST[$testIdIndex]))
        {
            $testID = $_POST[$testIdIndex];
        }
        else if(isset($_GET[$testIdIndex]))
        {
            $testID = $_GET[$testIdIndex];
        }
        else
        {
            $message = 'No test I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $testInfo = GetDetailedTestEntry($testID);
        $leopairs = GetTesteeExperiences($testID);
        
        if ($testInfo->GetId() > 0)
        {
            include(GetViewTestEntryFormFile());
        }
        else
        {
            $message = 'The test you wish to view does not exist.';
            include(GetMessageFormFile());
        }
    }
    
    function TestEntryDelete()
    {
        if (!userIsAuthorized(GetTestEntryDeleteAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if(isset($_POST["numListed"]))
        {
            $numListed = $_POST["numListed"];
            
            for($i = 0; $i < $numListed; ++$i)
            {
                if(isset($_POST["record$i"]))
                {
                    $testID = $_POST["record$i"];
                    
                    DeleteTestEntry($testID);
                }
            }
        }
        
        Redirect(GetControllerScript(GetAdminControllerFile(), GetManageTestEntriesAction()));
    }
    
    function TestEntrySearch()
    {
        if(!userIsAuthorized(GetTestEntrySearchAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $name = '';
        $language = '';
        $minScore = '';
        $maxScore = '';
        $minDate = '';
        $maxDate = '';
        
        if (isset($_POST['Name']))
        {
            $name = $_POST['Name'];
        }
        
        if (isset($_POST['Language']))
        {
            $language = $_POST['Language'];
        }
        
        if (isset($_POST['MinScore']))
        {
            $minScore = $_POST['MinScore'];
        }
        
        if (isset($_POST['MaxScore']))
        {
            $maxScore = $_POST['MaxScore'];
        }
        
        if (isset($_POST['MinDate']))
        {
            $minDate = $_POST['MinDate'];
        }
        
        if (isset($_POST['MaxDate']))
        {
            $maxDate = $_POST['MaxDate'];
        }
        
        $languageNames = GetAllLanguagesNames();
        
        $testInfos = SearchForTestEntry($name, $language, $minScore, $maxScore, $minDate, $maxDate);
        
        include(GetManageTestentriesFormFile());
    }
    
    function ManageTestEntries()
    {
        if(!userIsAuthorized(GetManageTestEntriesAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $name = '';
        $language = '';
        $languageNames = GetAllLanguagesNames();
        
        $minScore = 0.0;
        $maxScore = 10;
        $minDate = ToDisplayDate(date("Y-m-d", strtotime("-7 days")));
        $maxDate = ToDisplayDate(date("Y-m-d", strtotime("+1 days")));
        
        $testInfos = SearchForTestEntry($name, $language, $minScore, $maxScore, $minDate, $maxDate);
        
        include(GetManageTestentriesFormFile());
    }
    
    function ExamParametersView()
    {
        if(!userIsAuthorized(GetExamParametersViewAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $parameters = GetExamParameters();
        
        $keyCode = $parameters->GetKeyCode();
        $questionCount = $parameters->GetQuestionCount();
        $incLevelScore = $parameters->GetIncLevelScorePercent();
        $decLevelScore = $parameters->GetDecLevelScorePercent();
        $spokenAtHomeInitLevel = $parameters->GetSpokenAtHomeInitLevel();
        
        include(GetViewExamParametersFormFile());
    }
    
    function ExamParametersEdit()
    {
        if(!userIsAuthorized(GetExamParametersEditAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $parameters = GetExamParameters();
        
        $keyCode = $parameters->GetKeyCode();
        $questionCount = $parameters->GetQuestionCount();
        $incLevelScore =  $parameters->GetIncLevelScorePercent();
        $decLevelScore =  $parameters->GetDecLevelScorePercent();
        $spokenAtHomeInitLevel = $parameters->GetSpokenAtHomeInitLevel();
        
        include(GetEditExamParametersFormFile());
    }
    
    function ProcessExamParametersEdit()
    {
        if(!userIsAuthorized(GetExamParametersEditAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $parameters = new ExamParameters();

        $parameters->Initialize($_POST);
        
        $incLvlScoreIndex = $parameters->GetIncLevelScoreIndex();
        $decLvlScoreIndex = $parameters->GetDecLevelScoreIndex();
        
        $incLvlScorePct = $_POST[$incLvlScoreIndex];
        $decLvlScorePct = $_POST[$decLvlScoreIndex];
        
        $parameters->SetIncLevelScorePercent($incLvlScorePct);
        $parameters->SetDecLevelScorePercent($decLvlScorePct);
        
        $parametersVI = $parameters->Validate();
        
        if($parametersVI->IsValid())
        {
            SetExamParameters($parameters);
            Redirect(GetControllerScript(GetAdminControllerFile(), GetExamParametersViewAction()));
        }
        
        $message = 'Errors';
        $collection = $parametersVI->GetErrors();
        
        $keyCode = $parameters->GetKeyCode();
        $questionCount = $parameters->GetQuestionCount();
        $incLevelScore =  $parameters->GetIncLevelScorePercent();
        $decLevelScore =  $parameters->GetDecLevelScorePercent();
        $spokenAtHomeInitLevel = $parameters->GetSpokenAtHomeInitLevel();
        
        include(GetEditExamParametersFormFile());
    }
    
    function HandleLogin( )
    {
        if(loggedIn())
        {
            Redirect(GetControllerScript(GetMainControllerFile(),GetHomeAction()));
        }
        
        if (!isset($_SERVER['HTTPS']))
        {
            SecureConnection( );
            exit();
        }
        
        include(GetLoginFormFile());
    }
    
    function ProcessLogin()
    {
        if (isset($_POST["username"]) && isset($_POST["password"]))
        {
            $username = $_POST["username"];
            $password = $_POST["password"];
            
            if(login($username, $password))
            {
                $requestedPage = $_POST["RequestedPage"];
                UnsecureConnection($requestedPage);
            }
            else
            {
                $url = GetControllerScript(GetAdminControllerFile(), GetLoginAction() ) . "&LoginFailure" . '&' . GetRequestedPageIdentifier() . '=' . urlencode($_POST["RequestedPage"]);
                Redirect( $url );
            }
        }
        else
        {
            Redirect(GetControllerScript(GetMainControllerFile(), GetHomeAction()));
        }
    }
    
    function ManageQuestions()
    {
        if (!userIsAuthorized(GetManageQuestionsAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageIdIdentifier()]))
        {
            $languageID = $_GET[GetLanguageIdIdentifier()];
        }
        else if(isset($_GET[GetQuestionIdIdentifier()]))
        {
            $questionID = $_GET[GetQuestionIdIdentifier()];
        }
        else if (isset($_POST[GetQuestionIdIdentifier()]))
        {
            $questionID = $_POST[GetQuestionIdIdentifier()];
        }
        else
        {
            $message = 'No question or languge I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        if(isset($questionID))
        {
            $question = GetQuestion($questionID);
            $language = GetQuestionLanguage($questionID);
            $languageID = $language[GetLanguageIdIdentifier()];
            
            if (isset($question['Level']))
            {
                $level = $question['Level'];
            }
            
            unset($questionID);
        }
        
        if (isset($_POST['Level']))
        {
            $level = $_POST['Level'];
        }
        else if (isset($_GET['Level']))
        {
            $level = $_GET['Level'];
        }
        
        if (!isset($level) || ((string)(int)$level != $level))
        {
            $level = 1;
        }
        
        $lang = GetLanguage($languageID);
        
        if ($lang == FALSE)
        {
            $message = 'The language of the questions you are trying to manage does not exist.';
            include(GetMessageFormFile());
            exit();
        }
        
        $questions = GetQuestions($languageID, $level);
        
        AppendQuestionAvgScores($questions);
        
        $language = $lang[GetNameIdentifier()];
        
        include(GetMangageQuestionsFormFile());
    }
    
    
    function ProcessQuestionAdd()
    {
        if(!userIsAuthorized(GetQuestionAddAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else if(isset($_GET[GetLanguageIdIdentifier()]))
        {
            $languageID = $_GET[GetLanguageIdIdentifier()];
        }
        else if(isset($_GET[GetQuestionIdIdentifier()]))
        {
            $questionID = $_GET[GetQuestionIdIdentifier()];
        }
        else if (isset($_POST[GetQuestionIdIdentifier()]))
        {
            $questionID = $_POST[GetQuestionIdIdentifier()];
        }
        else
        {
            $message = 'No question or languge I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        if(isset($questionID))
        {
            $language = GetQuestionLanguage($questionID);
            $languageID = $language[GetLanguageIdIdentifier()];
            unset($questionID);
        }
        
        $lang = GetLanguage($languageID);
        
        if ($lang == FALSE)
        {
            $message = 'The language of the questions you are trying to manage does not exist.';
            include(GetMessageFormFile());
            exit();
        }
        
        $name = '';
        $level = '1';
        $instructions = '';
        $answers = array();
        $answers[] = array(GetNameIdentifier() => '');
        
        include(GetAddEditQuestionFormFile());
    }
    
    function ProcessQuestionEdit()
    {
        if (!userIsAuthorized(GetContactEditAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetQuestionIdIdentifier()]))
        {
            $questionID = $_POST[GetQuestionIdIdentifier()];
        }
        else if (isset ($_GET[GetQuestionIdIdentifier()]))
        {
            $questionID = $_GET[GetQuestionIdIdentifier()];
        }
        else
        {
            $message = 'No question I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $question = GetQuestion($questionID);
        
        if ($question != FALSE)
        {
            $name = $question[GetNameIdentifier()];
            $level = $question['Level'];
            $instructions = $question['Instructions'];

            $answers = GetQuestionAnswers($questionID);

            include(GetAddEditQuestionFormFile());
        }
        else
        {
            $message = 'The question you wish to edit does not exist.';
            include(GetMessageFormFile());
        }
    }
    
    function ProcessQuestionView()
    {
        if (!userIsAuthorized(GetQuestionViewAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetQuestionIdIdentifier()]))
        {
            $questionID = $_POST[GetQuestionIdIdentifier()];
        }
        else if (isset($_GET[GetQuestionIdIdentifier()]))
        {
            $questionID = $_GET[GetQuestionIdIdentifier()];
        }
        else
        {
            $message = 'Question I.D. not provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $question = GetQuestion($questionID);
        
        if ($question != FALSE)
        {
            $name = $question[GetNameIdentifier()];
            $level = $question['Level'];
            $instructions = $question['Instructions'];
            $totalTimesFlagged = $question['Flagged'];
            
            $answers = GetQuestionAnswers($questionID);
            
            $totalTimesAnswered = 0;
            $totalTimesAnsweredCorrectly = 0;
            
            
            foreach($answers as $answer)
            {
                $count = $answer['Chosen'];
                $totalTimesAnswered += $count;
                
                if ((boolean)$answer['Correct'] == TRUE)
                {
                    $totalTimesAnsweredCorrectly = $count;
                }
            }
            
            include(GetViewQuestionFormFile());
        }
        else
        {
            $message = 'The question you wish to view does not exist.';
            include(GetMessageFormFile());
        }
    }
    
    function ProcessQuestionDelete()
    {
        if (!userIsAuthorized(GetQuestionDeleteAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if(isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        
        if (isset($languageID))
        {
            if(isset($_POST["numListed"]))
            {
                $numListed = $_POST["numListed"];

                for($i = 0; $i < $numListed; ++$i)
                {
                    if(isset($_POST["record$i"]))
                    {
                        $questionID = $_POST["record$i"];
                        
                        DeleteQuestion($questionID);
                    }
                }
            }
            
            Redirect(GetControllerScript(GetAdminControllerFile(), GetManageQuestionsAction()) . '&' . GetLanguageIdIdentifier() . '=' . $languageID);
        }
        
        $message = 'Error retrieving language I.D.';
        include(GetMessageFormFile());
    }
    
    function ProcessQuestionAddEdit()
    {
        $errors = array();
        
        if (isset($_POST[GetQuestionIdIdentifier()]))
        {
            $questionID = $_POST[GetQuestionIdIdentifier()];
        }
        else if (isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else
        {
            $message = 'Could not resolve question or language I.D.';
            include(GetMessageFormFile());
            exit();
        }
        
        if (isset($_POST[GetNameIdentifier()]))
        {
            $name = trim($_POST[GetNameIdentifier()]);
            
            if (empty($name))
            {
                $errors[] = 'The question cannot be blank.';
            }
        }
        else
        {
            $errors[] = 'A question was not provided.';
        }
        
        if (isset($_POST['Level']))
        {
            $level = trim($_POST['Level']);
            
            if(!is_int($level) && (string)(int)$level != $level)
            {
                $errors[] = 'The level must be an integer value.';
            }
            else if ($level < 1)
            {
                $errors[] = 'The level must be greater than or equal to 1.';
            }
        }
        else
        {
            $errors[] = 'A level was not provided.';
        }
        
        if (isset($_POST['Instructions']))
        {
            $instructions = trim($_POST['Instructions']);
        }
        else
        {
            $instructions = '';
        }
        
        $answers = array();
        
        $answerNumber = 0;
        while(isset($_POST['input' . $answerNumber]))
        {
            $answers[] = trim($_POST['input' . $answerNumber]);
            $answerNumber++;
        }
        
        if(count($answers) < 1)
        {
            $errors[] = 'At least one answer needs to be provided.';
        }
        else
        {
            foreach ($answers as $answer)
            {
                if (strlen($answer) < 1)
                {
                    $errors[] = 'An answer cannot be blank.';
                    break;
                }
            }
        }
        
        if(count($errors) < 1)
        {
            if (isset($questionID))
            {
                if(userIsAuthorized(GetQuestionEditAction()))
                {
                    UpdateQuestion($questionID, $name, $instructions, $level, $answers);
                }
                else
                {
                    include(GetNotAuthorizedFile());
                    exit();
                }
            }
            else
            {
                $languageID = $_POST[GetLanguageIdIdentifier()];
                
                if (userIsAuthorized(GetQuestionAddAction()))
                {
                    $questionID = AddQuestion($languageID, $name, $instructions, $level, $answers);
                }
                else
                {
                    include(GetNotAuthorizedFile());
                    exit();
                }
            }
            
            Redirect(GetControllerScript(GetAdminControllerFile(), GetQuestionViewAction() . '&' . GetQuestionIdIdentifier() . '=' . urlencode($questionID)));
        }
        
        $message = 'Errors';
        $collection = $errors;
        
        include(GetAddEditQuestionFormFile());
    }
    
    function ProcessQuestionSearch()
    {
        if (!userIsAuthorized(GetQuestionSearchAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if(isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else
        {
            $message = 'No language I.D. was provided.';
            include(GetMessageFormFile());
            exit();
        }
        
        $flagged = FALSE;
        if (isset($_POST['Flagged']) || isset($_GET['Flagged']))
        {
            $flagged = TRUE;
        }
        
        if (isset($_POST[GetNameIdentifier()]))
        {
            $name = $_POST[GetNameIdentifier()];
        }
        
        if ($flagged == FALSE && !isset($name))
        {
            $message = 'The search criteria could not be resolved.';
            include(GetMessageFormFile());
            exit();
        }
        
        $lang = GetLanguage($languageID);
        
        if ($lang == FALSE)
        {
            $message = 'The language of the questions you are trying to search for does not exist.';
            include(GetMessageFormFile());
            exit();
        }
        
        if ($flagged == TRUE)
        {
            $questions = SearchForFlaggedQuestions($languageID);
        }
        else
        {
            $questions = SearchForQuestion($languageID, $name);
        }
        
        AppendQuestionAvgScores($questions);
        $language = $lang[GetNameIdentifier()];
        
        include(GetMangageQuestionsFormFile());
    }
    
    function ProcessLanguageAdd()
    {
        if (!userIsAuthorized(GetLanguageAddAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $name = "";
        
        include(GetAddEditLangaugeFormFile());
    }
    
    function ProcessLanguageEdit()
    {
        if (!userIsAuthorized(GetLanguageEditAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else if (isset($_GET[GetLanguageIdIdentifier()]))
        {
            $languageID = $_GET[GetLanguageIdIdentifier()];
        }
        else
        {
            $message = 'No language I.D. provided.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        $language = GetLanguage($languageID);
        
        if ($language != FALSE)
        {
            $name = $language[GetNameIdentifier()];
            $active = $language['Active'];
            $feedback = $language['Feedback'];
            
            include(GetAddEditLangaugeFormFile());
        }
        else
        {
            $message = 'The language you wish to edit does not exist.';
            include(GetMessageFormFile());
        }
    }
    
    function ProcessLanguageView()
    {
        if (!userIsAuthorized(GetLanguageViewAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if (isset($_POST[GetLanguageIdIdentifier()]))
        {
            $languageID = $_POST[GetLanguageIdIdentifier()];
        }
        else if(isset($_GET[GetLanguageIdIdentifier()]))
        {
            $languageID = $_GET[GetLanguageIdIdentifier()];
        }
        else if(isset($_GET[GetQuestionIdIdentifier()]))
        {
            $questionID = $_GET[GetQuestionIdIdentifier()];
        }
        else if (isset($_POST[GetQuestionIdIdentifier()]))
        {
            $questionID = $_POST[GetQuestionIdIdentifier()];
        }
        else
        {
            $message = 'The language or question I.D. could not be resolved.';
            
            include(GetMessageFormFile());
            exit();
        }
        
        if(isset($languageID))
        {
            $language = GetLanguage($languageID);
        }
        else if(isset($questionID))
        {
            $language = GetQuestionLanguage($questionID);
            $languageID = $language[GetLanguageIdIdentifier()];
            unset($questionID);
        }
        
        if ($language != FALSE)
        {
            $name = $language[GetNameIdentifier()];
            $active = $language['Active'];
            $feedback = $language['Feedback'];
        
            include(GetViewLanguageFormFile());
        }
        else
        {
            $message = 'The language you wish to view does not exist.';
            include(GetMessageFormFile());
        }
    }
    
    function ProcessLanguageDelete()
    {
        if (!userIsAuthorized(GetLanguageDeleteAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        if(isset($_POST["numListed"]))
        {
            $numListed = $_POST["numListed"];

            for($i = 0; $i < $numListed; ++$i)
            {
                if(isset($_POST["record$i"]))
                {
                    $languageID = $_POST["record$i"];

                    DeleteLanguage($languageID);
                }
            }
        }

        Redirect(GetControllerScript(GetAdminControllerFile(), GetManageLanguagesAction()));
    }
    
    function ProcessLanguageAddEdit()
    {
        $errors = array();
        
        if (isset($_POST[GetNameIdentifier()]))
        {
            $name = trim($_POST[GetNameIdentifier()]);
            
            if (empty($name))
            {
                $errors[] = 'Name cannot be blank.';
            }
            else if (strlen($name) > 32)
            {
                $errors[] = 'The name is too long.';
            }
        }
        else
        {
            $errors[] = 'A name was not provided.';
        }
        
        $active = isset($_POST['Active']);
        $feedback = isset($_POST['Feedback']);
        
        if(count($errors) < 1)
        {
            if(isset($_POST[GetLanguageIdIdentifier()]))
            {
                $languageID = $_POST[GetLanguageIdIdentifier()];
                
                if (userIsAuthorized(GetLanguageEditAction()))
                {
                    UpdateLanguage($languageID, $name, $active, $feedback);
                }
                else
                {
                    include(GetNotAuthorizedFile());
                    exit();
                }
            }
            else
            {
                if (userIsAuthorized(GetLanguageAddAction()))
                {
                    $languageID = AddLanguage($name);
                    
                    if ($languageID == 0)
                    {
                        unset($languageID);
                        $message = 'The language already exists.';
                        include(GetAddEditLangaugeFormFile());
                        exit();
                    }
                }
                else
                {
                    include(GetNotAuthorizedFile());
                    exit();
                }
            }
            
            Redirect(GetControllerScript(GetAdminControllerFile(), GetLanguageViewAction() . '&' . GetLanguageIdIdentifier() . '=' . urlencode($languageID)));
        }
        
        $message = 'Errors';
        $collection = $errors;
        
        include(GetAddEditLangaugeFormFile());
    }
    
    function ManageLanguages()
    {
        if (!userIsAuthorized(GetManageLanguagesAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $languages = GetAllLanguages();
        
        include(GetManageLanguagesFormFile());
    }
    
    function ProcessUserView()
    {
        if (!userIsAuthorized(GetUserViewAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $userID = $_GET[GetUserIdIdentifier()];
        
        $row = getUser($userID);
        
        if ($row != false)
        {
            $hasAttrResults = getUserRoles($userID);
        
            $userName = $row[GetUserNameIdentifier()];
        
            include(GetViewUserFormFile());
        }
        else
        {
            $message = 'The user you wish to view does not exist.';
            include(GetMessageFormFile());
        }
    }
    
    function ProcessUserSearch()
    {
        if (!userIsAuthorized(GetUserSearchAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $name = $_POST[GetNameIdentifier()];
        
        $results = SearchForUser($name);
        
        include(GetManageUsersFormFile());
    }
    
    function ManageUsers()
    {
        if (!userIsAuthorized(GetManageUsersAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $results = getAllUsers();
        
        include(GetManageUsersFormFile());
    }
    
    function UserAdd()
    {
        if (!userIsAuthorized(GetUserAddAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $userName = "";
        
        include(GetAddUserFormFile());
    }
    
    function UserEdit()
    {
        if (!userIsAuthorized(GetUserEditAction()))
        {
            include(GetNotAuthorizedFile());
        }
        else
        {
            $id = $_GET[GetUserIdIdentifier()];
            
            if (empty($id))
            {
                displayError("The user I.D. could not be resolved.");
            }
            else
            {
                $row = getUser($id);
                
                if ($row == false)
                {
                    displayError("The user you wish to edit does not exist.");
                }
                else
                {
                    $hasAttrResults = getUserRoles($id);
                    $hasNotAttrResults = getNotUserRoles($id);
                    
                    $userID = $row[GetUserIdIdentifier()];
                    $userName = $row[GetUserNameIdentifier()];
                    $vital = $row['Vital'];
                    
                    include(GetEditUserFormFile());
                }
            }
        }
        
        Redirect(GetControllerScript(GetMainControllerFile(), GetHomeAction()));
    }
    
    function UserDelete()
    {
        if (!userIsAuthorized(GetUserDeleteAction()))
        {
            include(GetNotAuthorizedFile());
        }
        else
        {
            if(isset($_POST["numListed"]))
            {
                $numListed = $_POST["numListed"];
                for($i = 0; $i < $numListed; ++$i)
                {
                    if(isset($_POST["record$i"]))
                    {
                        $userID = $_POST["record$i"];
                        
                        if (!UserIsVital($userID))
                        {
                            deleteUser($userID);
                        }
                        else
                        {
                            $message = 'Cannot delete a vital user.';
                        }
                    }
                }
            }
            
            $results = getAllUsers();
            
            include(GetManageUsersFormFile());
        }
    }
    
    function ProcessUserAdd()
    {
        if(!userIsAuthorized(GetUserAddAction()))
        {
            include(GetNotAuthorizedFile());
        }
        else
        {
            $errors = array();

            $userName = trim($_POST[GetUserNameIdentifier()]);
            $password = $_POST[GetPasswordIdentifier()];
            $passwordRetype = $_POST[GetPasswordRetypeIdentifier()];
            
            if (empty($userName))
            {
                $errors[] = 'Username cannot be blank.';
            }
            else
            {
                if (strlen($userName) > 32)
                {
                    $errors[] = 'The username is too long.';
                }
                
                if (UserNameExists($userName))
                {
                    $errors[] = 'The user name already exists.';
                }
            }
            
            if (empty($password))
            {
                $errors[] = 'Password cannot be blank.';
            }
            else
            {
                if (strlen($password) > 40)
                {
                    $errors[] = 'Password is too long.';
                }
            }
            
            if ($password != $passwordRetype)
            {
                $errors[] = 'The password and retyped password do not match.';
            }

            if (count($errors) > 0)
            {
                $message = 'Errors';
                $collection = $errors;
            }
            else
            {
                $userID = addUser($userName, $password);

                Redirect(GetControllerScript(GetAdminControllerFile(), GetUserViewAction() . '&' . GetUserIdIdentifier() . '=' . urlencode($userID)));
            }

            include(GetAddUserFormFile());
        }
    }
    
    function ProcessUserEdit()
    {
        if(!userIsAuthorized(GetUserEditAction()))
        {
            include(GetNotAuthorizedFile());
        }
        else
        {
            $errors = array();
            $userName = trim($_POST[GetUserNameIdentifier()]);
            
            if(!empty($_POST[GetUserIdIdentifier()]))
            {
                $userID = $_POST[GetUserIdIdentifier()];
            }
            else
            {
                displayError('User I.D. could not be resolved.');
            }
            
            $user = getUser($userID);
            
            if (empty($userName))
            {
                $errors[] = 'Username cannot be blank.';
            }
            else
            {
                if (strlen($userName) > 32)
                {
                    $errors[] = 'The username is too long.';
                }
                
                if ($userName != $user[GetUserNameIdentifier()] && UserNameExists($userName))
                {
                    $errors[] = 'The user name already exists.';
                }
            }

            if(!empty($_POST[GetPasswordIdentifier()]))
            {
                $password = $_POST[GetPasswordIdentifier()];
                $passwordRetype = $_POST[GetPasswordRetypeIdentifier()];
                
                if (strlen($password) > 40)
                {
                    $errors[] = 'Password is too long.';
                }
                
                if($password != $passwordRetype)
                {
                    $errors[] = 'The password and retyped password do not match.';
                }
            }
            else
            {
                $password = '';
            }

            if(count($errors) > 0)
            {
                $message = 'Errors';
                $collection = $errors;
            }
            else
            {
                $hasAttributes = array();
                
                if(isset($_POST["hasAttributes"]))
                {
                    $hasAttributes = $_POST["hasAttributes"];
                }
                
                if (!UserIsVital($userID))
                {
                    updateUserAttributes($userID, $hasAttributes);
                }
                
                UpdateUser($userID, $userName, $password);

                Redirect(GetControllerScript(GetAdminControllerFile(), GetUserViewAction() . '&' . GetUserIdIdentifier() . '=' . urlencode($userID)));
            }
            
            $vital = $user['Vital'];
            $hasAttrResults = getUserRoles($userID);
            $hasNotAttrResults = getNotUserRoles($userID);
            
            include(GetEditUserFormFile());
        }
    }

    function ManageRoles()
    {
        if (!userIsAuthorized(GetManageRolesAction()))
        {
            include(GetNotAuthorizedFile());
        }
        else
        {
            $results = getAllRoles();
            
            include(GetMangageRolesFormFile());
        }
    }
    
    function RoleAdd()
    {
        if (!userIsAuthorized(GetRoleAddAction()))
        {
            include(GetNotAuthorizedFile());
        }
        else
        {
            include(GetAddRoleFormFile());
        }
    }
    
    function RoleEdit()
    {
        if (!userIsAuthorized(GetRoleEditAction()))
        {
            include(GetNotAuthorizedFile());
            exit();
        }
        
        $id = $_GET[GetRoleIdIDentifier()];
        if (empty($id))
        {
            displayError("An ID is required for this function.");
        }
        else
        {
            $row = getRole($id);
            
            if ($row == false)
            {
                displayError("The role you wish to edit does not exist.");
            }
            else if (RoleIsVital($id))
            {
                displayError('Cannot edit a vital role.');
            }
            else
            {
                $hasAttrResults = getRoleFunctions($id);
                $hasNotAttrResults = getNotRoleFunctions($id);
                $name = $row["Name"];
                $desc = $row["Description"];
                
                include(GetEditRoleFormFile());
            }
        }
    }
    
    function RoleDelete()
    {
        if (!userIsAuthorized(GetRoleDeleteAction()))
        {
            include(GetNotAuthorizedFile());
        }
        else
        {
            if (isset($_POST["numListed"]))
            {
                $numListed = $_POST["numListed"];
                for($i = 0; $i < $numListed; ++$i)
                {
                    if(isset($_POST["record$i"]))
                    {
                        $roleID = $_POST["record$i"];
                        
                        if (!RoleIsVital($roleID))
                        {
                            deleteRole($roleID);
                        }
                        else
                        {
                            $message = 'Cannot delete a vital role.';
                        }
                    }
                }
            }
            
            $results = getAllRoles();
            
            include(GetMangageRolesFormFile());
        }
    }
    
    function ProcessRoleAddEdit()
    {
        $message = "";
        $errors = array( );
        
        if(empty($_POST["Name"]))
        {
            $mesage = "Error";
            $errors[] = "Error, field \"Name\" is blank.";
        }
        
        if($message == "")
        {
            if(!empty($_POST["RoleID"]))
            {
                $RoleID = $_POST["RoleID"];
            }
            $name = trim($_POST["Name"]);
            $desc = trim($_POST["Description"]);
            
            if (empty($RoleID))
            {   // No RoleID means we are processing an ADD
                if(userIsAuthorized(GetRoleAddAction()))
                {
                    $RoleID = addRole($name, $desc);
                }
                else
                {
                    include(GetNotAuthorizedFile());
                }
            }
            else
            {
                if(userIsAuthorized(GetRoleEditAction()))
                {
                    if (!RoleIsVital($RoleID))
                    {
                        $hasAttributes = array();

                        if(!empty($_POST["hasAttributes"]))
                        {
                            $hasAttributes = $_POST["hasAttributes"];
                        }

                        updateRole($RoleID, $name, $desc, $hasAttributes);
                    }
                    else
                    {
                        $message = 'Cannot edit a vital role.';
                        include(GetMessageFormFile());
                        exit();
                    }
                }
                else
                {
                    include(GetNotAuthorizedFile());
                }
            }
            
            $results = getAllRoles();
            
            include(GetMangageRolesFormFile());
        }
        else
        {
            displayErrors($message, $errors);
        }
    }
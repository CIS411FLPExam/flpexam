<?php
    require_once('../../private/definitions/paths.php');
    require_once(ADMINMODEL_FILE);
    require_once(PATHS_FILE);
    require_once(IDENTIFIER_FILE);
    require_once(GENERALFUNCTIONS_FILE);
    require_once(ACTIONS_FILE);
    require_once(PHPEXCELCLASS_FILE);
    require_once(PHPEXCELIOFACTORYCLASS_FILE);
    require_once(LEVELINFOCLASS_FILE);
    
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
        $action ="";
    }
    
    if(!loggedIn() && $action != LOGIN_ACTION && $action != PROCESSLOGIN_ACTION)
    {
        $url = GetControllerScript(ADMINCONTROLLER_FILE, LOGIN_ACTION) . '&' . REQUESTEDPAGE_IDENTIFIER . '=' . GetRequestedURI( );
        Redirect( $url );
    }
    else if (!userIsAuthorized($action))
    {
        include( NOTAUTHORIZED_FILE );
    }
    else
    {
        switch ($action)
        {
            case LOGIN_ACTION :
                HandleLogin();
                break;
            case PROCESSLOGIN_ACTION :
                ProcessLogin();
                break;
            case LOGOUT_ACTION :
                logOut();
                Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
                break;
            case CONTROLPANEL_ACTION :
                include(CONTROLPANELFORM_FILE);
                break;
            case MANAGEUSERS_ACTION :
                ManageUsers();
                break;
            case USERADD_ACTION :
                UserAdd();
                break;
            case USEREDIT_ACTION :
                UserEdit();
                break;
            case USERDELETE_ACTION :
                UserDelete();
                break;
            case PROCESSUSERADD_ACTION :
                ProcessUserAdd();
                break;
            case PROCESSUSEREDIT_ACTION :
                ProcessUserEdit();
                break;
            case MANAGEFUNCTIONS_ACTION :
                ManageFunctions();
                break;
            case FUNCTIONADD_ACTION :
                FunctionAdd();
                break;
            case FUNCTIONEDIT_ACTION :
                FunctionEdit();
                break;
            case FUNCTIONDELETE_ACTION :
                FunctionDelete();
                break;
            case PROCESSFUNCTIONADDEDIT :
                ProcessFunctionAddEdit();
                break;
            case MANAGEROLES_ACTION :
                ManageRoles();
                break;
            case ROLEADD_ACTION :
                RoleAdd();
                break;
            case ROLEEDIT_ACTION :
                RoleEdit();
                break;
            case ROLEDELETE_ACTION :
                RoleDelete();
                break;
            case PROCESSROLEADDEDIT_ACTION :
                ProcessRoleAddEdit();
                break;
            case USERSEARCH_ACTION :
                ProcessUserSearch();
                break;
            case USERVIEW_ACTION :
                ProcessUserView();
                break;
            case MANAGELANGUAGES_ACTION :
                ManageLanguages();
                break;
            case LANGUAGEADD_ACTION :
                ProcessLanguageAdd();
                break;
            case LANGUAGEEDIT_ACTION :
                ProcessLanguageEdit();
                break;
            case LANGUAGEVIEW_ACTION :
                ProcessLanguageView();
                break;
            case LANGUAGEDELETE_ACTION :
                ProcessLanguageDelete();
                break;
            case PROCESSLANGUAGEADDEDIT_ACTION :
                ProcessLanguageAddEdit();
                break;
            case MANAGEQUESTIONS_ACTION :
                ManageQuestions();
                break;
            case QUESTIONADD_ACTION :
                ProcessQuestionAdd();
                break;
            case QUESTIONEDIT_ACTION :
                ProcessQuestionEdit();
                break;
            case QUESTIONVIEW_ACTION:
                ProcessQuestionView();
                break;
            case QUESTIONDELETE_ACTION :
                ProcessQuestionDelete();
                break;
            case PROCESSQUESTIONADDEDIT_ACTION :
                ProcessQuestionAddEdit();
                break;
            case QUESTIONSEARCH_ACTION :
                ProcessQuestionSearch();
                break;
            case EXAMPARAMETERSVIEW_ACTION :
                ExamParametersView();
                break;
            case EXAMPARAMETERSEDIT_ACTION :
                ExamParametersEdit();
                break;
            case PROCESSEXAMPARAMETERSEDIT_ACTION :
                ProcessExamParametersEdit();
                break;
            case MANAGETESTS_ACTION :
                ManageTests();
                break;
            case TESTVIEW_ACTION :
                TestView();
                break;
            case TESTSEARCH_ACTION :
                TestSearch();
                break;
            case LANGUAGEIMPORT_ACTION :
                LanguageImport();
                break;
            case LANGUAGEEXPORT_ACTION :
                LanguageExport();
                break;
            case MANAGECONTACTS_ACTION :
                ManageContacts();
                break;
            case CONTACTADD_ACTION :
                ContactAdd();
                break;
            case CONTACTEDIT_ACTION :
                ContactEdit();
                break;
            case PROCESSCONTACTADDEDIT_ACTION :
                ProcessContactAddEdit();
                break;
            case CONTACTDELETE_ACTION :
                ContactDelete();
                break;
            case LANGUAGEACTIVATE_ACTION :
                LanguageActivate();
                break;
            case LANGUAGEDEACTIVATE_ACTION :
                LanguageDeactivate();
                break;
            case CONTACTACTIVATE_ACTION :
                ContactActivate();
                break;
            case CONTACTDEACTIVATE_ACTION :
                ContactDeactivate();
                break;
            case MANAGELEVELINFOS_ACTION :
                ManageLevelInfos();
                break;
            case LEVELINFOADD_ACTION :
                LevelInfoAdd();
                break;
            case LEVELINFOVIEW_ACTION :
                LevelInfoView();
                break;
            case LEVELINFOEDIT_ACTION :
                LevelInfoEdit();
                break;
            case LEVELINFODELETE_ACTION :
                LevelInfoDelete();
                break;
            case PROCESSLEVELINFOADDEDIT_ACTION :
                ProcessLevelInfoAddEdit();
                break;
            case LANGUAGEEXPERIENCESEDIT_ACTION :
                LanguageExperiencesEdit();
                break;
            case LANGUAGEEXPERIENCESVIEW_ACTION :
                LanguageExperiencesView();
                break;
            case PROCESSLANGUAGEEXPERIENCESEDIT_ACTION :
                ProcessLanguageExperiencesEdit();
                break;
            default:
                Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
    }
    
    function LanguageExperiencesEdit()
    {
        if (!userIsAuthorized(LANGUAGEEXPERIENCESEDIT_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        $languageExperiences = GetLanguageExperiences();
        $spokenAtHomeInitLevel = GetSpokenAtHomeInitLevel();
        
        include(EDITLANGUAGEEXPERIENCESFORM_FILE);
    }
    
    function LanguageExperiencesView()
    {
        if (!userIsAuthorized(LANGUAGEEXPERIENCESVIEW_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        $languageExperiences = GetLanguageExperiences();
        $spokenAtHomeInitLevel = GetSpokenAtHomeInitLevel();
        
        include(VIEWLANGUAGEEXPERIENCESFORM_FILE);
    }
    
    function ProcessLanguageExperiencesEdit()
    {
        if (!userIsAuthorized(LANGUAGEEXPERIENCESEDIT_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        $numListed = 0;
        $errors = array();
        $languageExperiences = array();
        $experience = new LanguageExperience();
        $idKey = $experience->GetIdKey();
        $nameKey = $experience->GetNameKey();
        $initLevelKey = $experience->GetInitLevelKey();
        
        $spokenAtHomeInitLevel = 0;
        
        if (isset($_POST['SpokenAtHomeInitLevel']))
        {
            $spokenAtHomeInitLevel = $_POST['SpokenAtHomeInitLevel'];
        }
        
        if ((string)(int)$spokenAtHomeInitLevel != $spokenAtHomeInitLevel)
        {
            $errors['SpokenAtHomeInitLevel'] = new ValidationInfo(FALSE, array('The initial level must be an integer.'));
        }
        else if ($spokenAtHomeInitLevel < 1)
        {
            $errors['SpokenAtHomeInitLevel'] = new ValidationInfo(FALSE, array('The initial level must be greater than or equal to 1.'));
        }
        
        if (isset($_POST['numListed']))
        {
            $numListed = $_POST['numListed'];
        }
        
        for ($i = 0; $i < $numListed; $i++)
        {
            if (isset($_POST[$idKey . $i]) && isset($_POST[$nameKey . $i]) && isset($_POST[$initLevelKey . $i]))
            {
                $id = $_POST[$idKey . $i];
                $name = $_POST[$nameKey . $i];
                $initLevel = $_POST[$initLevelKey . $i];
                
                $experience = new LanguageExperience($id, $name, $initLevel);
                $experienceVI = $experience->Validate();
                
                $languageExperiences[] = $experience;
                
                if (!$experienceVI->IsValid())
                {
                    $errors['Experience'. $i] = $experienceVI;
                }
            }
        }
        
        if (count($errors) < 1)
        {
            SetSpokenAtHomeInitLevel($spokenAtHomeInitLevel);
            
            SetLanguageExperiences($languageExperiences);
            
            Redirect(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEEXPERIENCESVIEW_ACTION));
        }
        
        include(EDITLANGUAGEEXPERIENCESFORM_FILE);
    }
    
    function ManageLevelInfos()
    {
        if(!userIsAuthorized(MANAGELEVELINFOS_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        if (isset($_POST[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_POST[LANGUAGEID_IDENTIFIER];
        }
        else if (isset($_GET[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_GET[LANGUAGEID_IDENTIFIER];
        }
        else
        {
            $message = 'No language I.D. provided.';
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        $levelinfos = GetLevelInfos($languageID);
        $language = GetLanguage($languageID);
        $languageName = $language[NAME_IDENTIFIER];
        
        include(MANAGELEVELINFOSFORM_FILE);
    }
    
    function LevelInfoAdd()
    {
        if(!userIsAuthorized(LEVELINFOADD_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        if (isset($_POST[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_POST[LANGUAGEID_IDENTIFIER];
        }
        else if (isset($_GET[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_GET[LANGUAGEID_IDENTIFIER];
        }
        else
        {
            $message = 'No language I.D. provided.';
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        $levelInfo = new LevelInfo();
        
        include(ADDEDITLEVELINFOFORM_FILE);
    }
    
    function LevelInfoView()
    {
        if(!userIsAuthorized(LEVELINFOVIEW_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        if (isset($_POST[LEVELINFOID_IDENTIFIER]))
        {
            $levelInfoID = $_POST[LEVELINFOID_IDENTIFIER];
        }
        else if (isset($_GET[LEVELINFOID_IDENTIFIER]))
        {
            $levelInfoID = $_GET[LEVELINFOID_IDENTIFIER];
        }
        else
        {
            $message = 'No level information I.D. provided.';
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        $levelInfo = GetLevelInfo($levelInfoID);
        
        include(VIEWLEVELINFOFORM_FILE);
    }
    
    function LevelInfoEdit()
    {
        if(!userIsAuthorized(LEVELINFOEDIT_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        if (isset($_POST[LEVELINFOID_IDENTIFIER]))
        {
            $levelInfoID = $_POST[LEVELINFOID_IDENTIFIER];
        }
        else if (isset($_GET[LEVELINFOID_IDENTIFIER]))
        {
            $levelInfoID = $_GET[LEVELINFOID_IDENTIFIER];
        }
        else
        {
            $message = 'No level information I.D. provided.';
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        $levelInfo = GetLevelInfo($levelInfoID);
        $languageID = $levelInfo->GetLanguageId();
        
        include(ADDEDITLEVELINFOFORM_FILE);
    }
    
    function ProcessLevelInfoAddEdit()
    {
        if (isset($_POST[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_POST[LANGUAGEID_IDENTIFIER];
        }
        else if (isset($_GET[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_GET[LANGUAGEID_IDENTIFIER];
        }
        else
        {
            $message = 'No language I.D. provided.';
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        $language = GetLanguage($languageID);
        $languageName = $language[NAME_IDENTIFIER];
        
        $levelInfo = new LevelInfo();
        $levelInfo->Initialize($_POST);
        
        $levelInfoVI = $levelInfo->Validate();
        
        if ($levelInfoVI->IsValid())
        {
            if (isset($_POST[LEVELINFOID_IDENTIFIER]))
            {//We are doing an edit.
                if (userIsAuthorized(LEVELINFOEDIT_ACTION))
                {
                    UpdateLevelInfo($levelInfo);
                    $levelInfoID = $levelInfo->GetId();
                }
                else
                {
                    include(NOTAUTHORIZED_FILE);
                    exit();
                }
            }
            else
            {//We are doing an add.
                
                $level = $levelInfo->GetLevel();
                
                if (LevelInfoExists($languageID, $level))
                {
                    $message = 'The inforamtion for this level already exists';
                    
                    include(ADDEDITLEVELINFOFORM_FILE);
                    exit();
                }
                
                if (userIsAuthorized(LEVELINFOADD_ACTION))
                {
                    $levelInfoID = AddLevelInfo($levelInfo);
                }
                else
                {
                    include(NOTAUTHORIZED_FILE);
                    exit();
                }
            }
            
            Redirect(GetControllerScript(ADMINCONTROLLER_FILE, LEVELINFOVIEW_ACTION) . '&' . LEVELINFOID_IDENTIFIER . '=' . urlencode($levelInfoID));
        }
        
        $message = 'Errors';
        $collection = $levelInfoVI->GetErrors();
        
        include(ADDEDITLEVELINFOFORM_FILE);
    }
    
    function LevelInfoDelete()
    {
        if(!userIsAuthorized(LEVELINFODELETE_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        if (isset($_POST[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_POST[LANGUAGEID_IDENTIFIER];
        }
        else if (isset($_GET[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_GET[LANGUAGEID_IDENTIFIER];
        }
        else
        {
            $message = 'No language I.D. provided.';
            
            include(MESSAGEFORM_FILE);
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
        
        Redirect(GetControllerScript(ADMINCONTROLLER_FILE, MANAGELEVELINFOS_ACTION) . '&' . LANGUAGEID_IDENTIFIER . '=' . urldecode($languageID));
    }
    
    function LanguageActivate()
    {
        if(isset($_POST[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_POST[LANGUAGEID_IDENTIFIER];
        }
        else if (isset($_GET[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_GET[LANGUAGEID_IDENTIFIER];
        }
        else
        {
            $message = 'No lanugage I.D. provided.';
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        if(userIsAuthorized(LANGUAGEEDIT_ACTION))
        {
            ActivateLanguage($languageID);
        }
        
        Redirect(GetControllerScript(ADMINCONTROLLER_FILE, MANAGELANGUAGES_ACTION));
    }
    
    function LanguageDeactivate()
    {
        if(isset($_POST[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_POST[LANGUAGEID_IDENTIFIER];
        }
        else if (isset($_GET[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_GET[LANGUAGEID_IDENTIFIER];
        }
        else
        {
            $message = 'No lanugage I.D. provided.';
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        if(userIsAuthorized(LANGUAGEEDIT_ACTION))
        {
            DeactivateLanguage($languageID);
        }
        
        Redirect(GetControllerScript(ADMINCONTROLLER_FILE, MANAGELANGUAGES_ACTION));
    }
    
    function ContactActivate()
    {
        if(isset($_POST[CONTACTID_IDENTIFIER]))
        {
            $contactID = $_POST[CONTACTID_IDENTIFIER];
        }
        else if (isset($_GET[CONTACTID_IDENTIFIER]))
        {
            $contactID = $_GET[CONTACTID_IDENTIFIER];
        }
        else
        {
            $message = 'No contact I.D. provided.';
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        if(userIsAuthorized(CONTACTEDIT_ACTION))
        {
            $contacts = GetContacts();
            
            foreach ($contacts as $contact)
            {
                DeactivateContact($contact->GetId());
            }
            
            ActivateContact($contactID);
        }
        
        Redirect(GetControllerScript(ADMINCONTROLLER_FILE, MANAGECONTACTS_ACTION));
    }
    
    function ContactDeactivate()
    {
        if(isset($_POST[CONTACTID_IDENTIFIER]))
        {
            $contactID = $_POST[CONTACTID_IDENTIFIER];
        }
        else if (isset($_GET[CONTACTID_IDENTIFIER]))
        {
            $contactID = $_GET[CONTACTID_IDENTIFIER];
        }
        else
        {
            $message = 'No contact I.D. provided.';
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        if(userIsAuthorized(CONTACTEDIT_ACTION))
        {
            DeactivateContact($contactID);
        }
        
        Redirect(GetControllerScript(ADMINCONTROLLER_FILE, MANAGECONTACTS_ACTION));
    }
    
    function ContactAdd()
    {
        if (!userIsAuthorized(CONTACTADD_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        $contact = new Contact();
        
        include(ADDEDITCONTACTFORM_FILE);
    }
    
    function ContactEdit()
    {
        if (!userIsAuthorized(CONTACTEDIT_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        if(isset($_POST[CONTACTID_IDENTIFIER]))
        {
            $contactID = $_POST[CONTACTID_IDENTIFIER];
        }
        else if (isset($_GET[CONTACTID_IDENTIFIER]))
        {
            $contactID = $_GET[CONTACTID_IDENTIFIER];
        }
        else
        {
            $message = 'No contact I.D. provided.';
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        $contact = GetContact($contactID);
        
        include(ADDEDITCONTACTFORM_FILE);
    }
    
    function ProcessContactAddEdit()
    {
        if(isset($_POST[CONTACTID_IDENTIFIER]))
        {
            $contactID = $_POST[CONTACTID_IDENTIFIER];
        }
                
        $contact = new Contact();
        $contact->Initialize($_POST);
        
        $contactVI = $contact->Validate();
        
        if(!$contactVI->IsValid())
        {
            $message = 'Errors';
            $collection = $contactVI->GetErrors();
            
            include(ADDEDITCONTACTFORM_FILE);
        }
        else
        {
            if(isset($contactID))
            {
                if(userIsAuthorized(CONTACTEDIT_ACTION))
                {
                    UpdateContact($contactID, $contact);
                }
                else
                {
                    include(NOTAUTHORIZED_FILE);
                    exit();
                }
            }
            else
            {
                if(userIsAuthorized(CONTACTADD_ACTION))
                {
                    AddContact($contact);
                }
                else
                {
                    include(NOTAUTHORIZED_FILE);
                    exit();
                }
            }
            
            Redirect(GetControllerScript(ADMINCONTROLLER_FILE, MANAGECONTACTS_ACTION));
        }
    }
    
    function ContactDelete()
    {
        if (!userIsAuthorized(CONTACTDELETE_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
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
        
        Redirect(GetControllerScript(ADMINCONTROLLER_FILE, MANAGECONTACTS_ACTION));
    }
    
    function ManageContacts()
    {
        if(!userIsAuthorized(MANAGECONTACTS_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        $contacts = GetContacts();
        
        include(MANAGECONTACTSFORM_FILE);
    }
    
    function LanguageImport()
    {
        if(!userIsAuthorized(LANGUAGEIMPORT_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        if(isset($_POST[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_POST[LANGUAGEID_IDENTIFIER];
        }
        else if (isset($_GET[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_GET[LANGUAGEID_IDENTIFIER];
        }
        else
        {
            $message = 'No lanugage I.D. provided.';
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        $errors = array();
        
        if(isset($_FILES['file']))
        {
            $file = $_FILES['file'];
            $filePath = $file ['tmp_name'];
            $type = $file['type'];
            $error = $file['error'];
            
            if ($error == UPLOAD_ERR_NO_FILE)
            {
                $errors[] = 'No file selected for upload.';
            }
            else if ($error != 0)
            {
                $errors[] = 'Error uploading file to server.';
            }
            else if($type != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
            {
                $errors[] = 'The file type is not of a valid Excel format.';
            }
            
            if (count($errors) == 0)
            {
                $objPHPExcel = OpenExcelFile($filePath);
                
                $questions = array();
                include(PROCESSLANGUAGEIMPORT_FILE);
                
                if (count($errors) == 0)
                {
                    foreach($questions as $question)
                    {
                        $questionID = $question[QUESTIONID_IDENTIFIER];
                        $level = $question['Level'];
                        $instructions = $question['Instructions'];
                        $quesName = $question[NAME_IDENTIFIER];
                        $answers = $question['Answers'];

                        if($questionID > 0)
                        {//Doing an update.
                            UpdateQuestion($questionID, $quesName, $instructions, $level, $answers);
                        }
                        else
                        {//Doing an add.
                            AddQuestion($languageID, $quesName, $instructions, $level, $answers);
                        }
                    }

                    Redirect(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEQUESTIONS_ACTION) . '&' . LANGUAGEID_IDENTIFIER . '=' . $languageID);
                }
            }
        }
        
        $lang = GetLanguage($languageID);
        $questions = GetQuestions($languageID);
        
        $language = $lang[NAME_IDENTIFIER];
        
        $message = 'Error Importing Questions.';
        $collection = $errors;
        
        include(MANAGEQUESTIONSFORM_FILE);
    }
    
    function LanguageExport()
    {
        if(!userIsAuthorized(LANGUAGEEXPORT_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        if(isset($_POST[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_POST[LANGUAGEID_IDENTIFIER];
        }
        else if (isset($_GET[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_GET[LANGUAGEID_IDENTIFIER];
        }
        else
        {
            $message = 'No lanugage I.D. provided.';
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        $language = GetLanguage($languageID);
        $languageName = $language[NAME_IDENTIFIER];
        
        ignore_user_abort(true);
        
        $file = ExportLanguageQuestions($languageID);
        
        header('Content-type: application/octet-stream');
        header('Content-Length: ' . filesize($file));
        header('Content-Disposition: attachment; filename=' . $languageName .'.xlsx');
        readfile($file);
        
        DeleteFile($file);
    }
    
    function TestView()
    {
        if(!userIsAuthorized(TESTVIEW_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
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
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        $testInfo = GetDetailedTest($testID);
        
        include(VIEWTESTFORM_FILE);
    }
    
    function TestSearch()
    {
        if(!userIsAuthorized(TESTSEARCH_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        $name = $_POST['Name'];
        $language = $_POST['Language'];
        $minScore = $_POST['MinScore'];
        $maxScore = $_POST['MaxScore'];
        $minDate = $_POST['MinDate'];
        $maxDate = $_POST['MaxDate'];
        
        $languageNames = GetAllLanguagesNames();
        
        $testInfos = SearchForTest($name, $language, $minScore, $maxScore, $minDate, $maxDate);
        
        include(MANAGETESTSFORM_FILE);
    }
    
    function ManageTests()
    {
        if(!userIsAuthorized(MANAGETESTS_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        $name = '';
        $language = '';
        $languageNames = GetAllLanguagesNames();
        
        $minScore = 0.0;
        $maxScore = 100;
        $minDate = ToDisplayDate(date("Y-m-d", strtotime("-7 days")));
        $maxDate = ToDisplayDate(date("Y-m-d", strtotime("+1 days")));
        
        $testInfos = SearchForTest($name, $language, $minScore, $maxScore, $minDate, $maxDate);
        
        include(MANAGETESTSFORM_FILE);
    }
    
    function ExamParametersView()
    {
        if(!userIsAuthorized(EXAMPARAMETERSVIEW_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        $parameters = GetExamParameters();
        
        $keyCode = $parameters->GetKeyCode();
        $questionCount = $parameters->GetQuestionCount();
        $incLevelScore =  $parameters->GetIncLevelScorePercent();
        $decLevelScore =  $parameters->GetDecLevelScorePercent();
        
        include(VIEWEXAMPARAMETERSFORM_FILE);
    }
    
    function ExamParametersEdit()
    {
        if(!userIsAuthorized(EXAMPARAMETERSEDIT_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        $parameters = GetExamParameters();
        
        $keyCode = $parameters->GetKeyCode();
        $questionCount = $parameters->GetQuestionCount();
        $incLevelScore =  $parameters->GetIncLevelScorePercent();
        $decLevelScore =  $parameters->GetDecLevelScorePercent();
        
        include(EDITEXAMPARAMETERSFORM_FILE);
    }
    
    function ProcessExamParametersEdit()
    {
        if(!userIsAuthorized(EXAMPARAMETERSEDIT_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        $parameters = new ExamParameters();

        $parameters->Initialize($_POST);
        
        $parametersVI = $parameters->Validate();
        
        if($parametersVI->IsValid())
        {
            SetExamParameters($parameters);
            Redirect(GetControllerScript(ADMINCONTROLLER_FILE, EXAMPARAMETERSVIEW_ACTION));
        }
        
        $message = 'Errors';
        $collection = $parametersVI->GetErrors();
        
        $keyCode = $parameters->GetKeyCode();
        $questionCount = $parameters->GetQuestionCount();
        $incLevelScore =  $parameters->GetIncLevelScorePercent();
        $decLevelScore =  $parameters->GetDecLevelScorePercent();
        
        include(EDITEXAMPARAMETERSFORM_FILE);
    }
    
    function HandleLogin( )
    {
        if(loggedIn())
        {
            Redirect(GetControllerScript(MAINCONTROLLER_FILE,HOME_ACTION));
        }
        
        if (!isset($_SERVER['HTTPS']))
        {
            SecureConnection( );
            exit();
        }
        
        include(LOGINFORM_FILE);
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
                $url = GetControllerScript(ADMINCONTROLLER_FILE, LOGIN_ACTION ) . "&LoginFailure" . '&' . REQUESTEDPAGE_IDENTIFIER . '=' . urlencode($_POST["RequestedPage"]);
                Redirect( $url );
            }
        }
        else
        {
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
    }
    
    function ManageQuestions()
    {
        if (!userIsAuthorized(MANAGEQUESTIONS_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        if (isset($_POST[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_POST[LANGUAGEID_IDENTIFIER];
        }
        else if (isset($_GET[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_GET[LANGUAGEID_IDENTIFIER];
        }
        else if(isset($_GET[QUESTIONID_IDENTIFIER]))
        {
            $questionID = $_GET[QUESTIONID_IDENTIFIER];
        }
        else if (isset($_POST[QUESTIONID_IDENTIFIER]))
        {
            $questionID = $_POST[QUESTIONID_IDENTIFIER];
        }
        else
        {
            $message = 'No question or languge I.D. provided.';
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        if(isset($questionID))
        {
            $language = GetQuestionLanguage($questionID);
            $languageID = $language[LANGUAGEID_IDENTIFIER];
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
        $questions = GetQuestions($languageID, $level);
        
        $language = $lang[NAME_IDENTIFIER];
        
        include(MANAGEQUESTIONSFORM_FILE);
    }
    
    
    function ProcessQuestionAdd()
    {
        if(!userIsAuthorized(QUESTIONADD_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        if (isset($_POST[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_POST[LANGUAGEID_IDENTIFIER];
        }
        else if(isset($_GET[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_GET[LANGUAGEID_IDENTIFIER];
        }
        else if(isset($_GET[QUESTIONID_IDENTIFIER]))
        {
            $questionID = $_GET[QUESTIONID_IDENTIFIER];
        }
        else if (isset($_POST[QUESTIONID_IDENTIFIER]))
        {
            $questionID = $_POST[QUESTIONID_IDENTIFIER];
        }
        else
        {
            $message = 'No question or languge I.D. provided.';
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        if(isset($questionID))
        {
            $language = GetQuestionLanguage($questionID);
            $languageID = $language[LANGUAGEID_IDENTIFIER];
            unset($questionID);
        }
        
        $name = '';
        $level = '1';
        $instructions = '';
        $answers = array();
        $answers[] = array(NAME_IDENTIFIER => '');
        
        include(ADDEDITQUESTIONFORM_FILE);
    }
    
    function ProcessQuestionEdit()
    {
        if (!userIsAuthorized(CONTACTEDIT_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        if (isset($_POST[QUESTIONID_IDENTIFIER]))
        {
            $questionID = $_POST[QUESTIONID_IDENTIFIER];
        }
        else if (isset ($_GET[QUESTIONID_IDENTIFIER]))
        {
            $questionID = $_GET[QUESTIONID_IDENTIFIER];
        }
        else
        {
            $message = 'No question I.D. provided.';
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        $question = GetQuestion($questionID);
        
        $name = $question[NAME_IDENTIFIER];
        $level = $question['Level'];
        $instructions = $question['Instructions'];
        
        $answers = GetQuestionAnswers($questionID);
        
        include(ADDEDITQUESTIONFORM_FILE);
    }
    
    function ProcessQuestionView()
    {
        if (!userIsAuthorized(QUESTIONVIEW_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        if (isset($_POST[QUESTIONID_IDENTIFIER]))
        {
            $questionID = $_POST[QUESTIONID_IDENTIFIER];
        }
        else if (isset($_GET[QUESTIONID_IDENTIFIER]))
        {
            $questionID = $_GET[QUESTIONID_IDENTIFIER];
        }
        else
        {
            $message = 'Question I.D. not provided.';
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        $question = GetQuestion($questionID);
        
        $name = $question[NAME_IDENTIFIER];
        $level = $question['Level'];
        $instructions = $question['Instructions'];
        
        $answers = GetQuestionAnswers($questionID);
        
        include(VIEWQUESTIONFORM_FILE);
    }
    
    function ProcessQuestionDelete()
    {
        if (!userIsAuthorized(QUESTIONDELETE_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        if(isset($_POST[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_POST[LANGUAGEID_IDENTIFIER];
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
            
            Redirect(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEQUESTIONS_ACTION) . '&' . LANGUAGEID_IDENTIFIER . '=' . $languageID);
        }
        
        $message = 'Error retrieving language I.D.';
        include(MESSAGEFORM_FILE);
    }
    
    function ProcessQuestionAddEdit()
    {
        $errors = array();
        
        if (isset($_POST[QUESTIONID_IDENTIFIER]))
        {
            $questionID = $_POST[QUESTIONID_IDENTIFIER];
        }
        else if (isset($_POST[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_POST[LANGUAGEID_IDENTIFIER];
        }
        else
        {
            $message = 'Could not resolve question or language I.D.';
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        if (isset($_POST[NAME_IDENTIFIER]))
        {
            $name = $_POST[NAME_IDENTIFIER];
            
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
            $level = $_POST['Level'];
            
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
            $instructions = $_POST['Instructions'];
        }
        else
        {
            $errors[] = 'Instructions were not provided.';
        }
        
        $answers = array();
        
        $answerNumber = 0;
        while(isset($_POST['input' . $answerNumber]))
        {
            $answers[] = $_POST['input' . $answerNumber];
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
                if (empty($answer))
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
                if(userIsAuthorized(QUESTIONEDIT_ACTION))
                {
                    UpdateQuestion($questionID, $name, $instructions, $level, $answers);
                }
                else
                {
                    include(NOTAUTHORIZED_FILE);
                    exit();
                }
            }
            else
            {
                $languageID = $_POST[LANGUAGEID_IDENTIFIER];
                
                if (userIsAuthorized(QUESTIONADD_ACTION))
                {
                    $questionID = AddQuestion($languageID, $name, $instructions, $level, $answers);
                }
                else
                {
                    include(NOTAUTHORIZED_FILE);
                    exit();
                }
            }
            
            Redirect(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONVIEW_ACTION . '&' . QUESTIONID_IDENTIFIER . '=' . urldecode($questionID)));
        }
        
        $message = 'Errors';
        $collection = $errors;
        
        include(ADDEDITQUESTIONFORM_FILE);
    }
    
    function ProcessQuestionSearch()
    {
        if (!userIsAuthorized(QUESTIONSEARCH_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        if(isset($_POST[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_POST[LANGUAGEID_IDENTIFIER];
        }
        else
        {
            $message = 'No language I.D. was provided.';
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        if (isset($_POST[NAME_IDENTIFIER]))
        {
            $name = $_POST[NAME_IDENTIFIER];
        }
        else
        {
            $message = 'The search criteria could not be resolved.';
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        $lang = GetLanguage($languageID);
        $questions = SearchForQuestion($languageID, $name);
        
        $language = $lang[NAME_IDENTIFIER];
        
        include(MANAGEQUESTIONSFORM_FILE);
    }
    
    function ProcessLanguageAdd()
    {
        if (!userIsAuthorized(LANGUAGEADD_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        $name = "";
        
        include(ADDEDITLANGUAGEFORM_FILE);
    }
    
    function ProcessLanguageEdit()
    {
        if (!userIsAuthorized(LANGUAGEEDIT_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        if (isset($_POST[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_POST[LANGUAGEID_IDENTIFIER];
        }
        else if (isset($_GET[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_GET[LANGUAGEID_IDENTIFIER];
        }
        else
        {
            $message = 'No language I.D. provided.';
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        $language = GetLanguage($languageID);
        
        $name = $language[NAME_IDENTIFIER];
        $active = $language['Active'];
        
        include(ADDEDITLANGUAGEFORM_FILE);
    }
    
    function ProcessLanguageView()
    {
        if (!userIsAuthorized(LANGUAGEVIEW_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        if (isset($_POST[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_POST[LANGUAGEID_IDENTIFIER];
        }
        else if(isset($_GET[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_GET[LANGUAGEID_IDENTIFIER];
        }
        else if(isset($_GET[QUESTIONID_IDENTIFIER]))
        {
            $questionID = $_GET[QUESTIONID_IDENTIFIER];
        }
        else if (isset($_POST[QUESTIONID_IDENTIFIER]))
        {
            $questionID = $_POST[QUESTIONID_IDENTIFIER];
        }
        else
        {
            $message = 'The language or question I.D. could not be resolved.';
            
            include(MESSAGEFORM_FILE);
            exit();
        }
        
        if(isset($languageID))
        {
            $language = GetLanguage($languageID);
        }
        else if(isset($questionID))
        {
            $language = GetQuestionLanguage($questionID);
            $languageID = $language[LANGUAGEID_IDENTIFIER];
            unset($questionID);
        }
        
        $name = $language[NAME_IDENTIFIER];
        $active = $language['Active'];
        
        include(VIEWLANGUAGEFORM_FILE);
    }
    
    function ProcessLanguageDelete()
    {
        if (!userIsAuthorized(LANGUAGEDELETE_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
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

        Redirect(GetControllerScript(ADMINCONTROLLER_FILE, MANAGELANGUAGES_ACTION));
    }
    
    function ProcessLanguageAddEdit()
    {
        $errors = array();
        
        if (isset($_POST[NAME_IDENTIFIER]))
        {
            $name = $_POST[NAME_IDENTIFIER];
            
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
        
        if(count($errors) < 1)
        {
            if(isset($_POST[LANGUAGEID_IDENTIFIER]))
            {
                $languageID = $_POST[LANGUAGEID_IDENTIFIER];
                
                UpdateLanguage($languageID, $name, $active);
            }
            else
            {
                $languageID = AddLanguage($name);
            }
            
            Redirect(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEVIEW_ACTION . '&' . LANGUAGEID_IDENTIFIER . '=' . urlencode($languageID)));
        }
        
        $message = 'Errors';
        $collection = $errors;
        
        include(ADDEDITLANGUAGEFORM_FILE);
    }
    
    function ManageLanguages()
    {
        if (!userIsAuthorized(MANAGELANGUAGES_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        $languages = GetAllLanguages();
        
        include(MANAGELANGUAGESFORM_FILE);
    }
    
    function ProcessUserView()
    {
        if (!userIsAuthorized(USERVIEW_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        $userID = $_GET[USERID_IDENTIFIER];
        
        $row = getUser($userID);
        
        $hasAttrResults = getUserRoles($userID);
        
        $userName = $row[USERNAME_IDENTIFIER];
        
        include(VIEWUSERFORM_FILE);
    }
    
    function ProcessUserSearch()
    {
        if (!userIsAuthorized(USERSEARCH_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        $name = $_POST[NAME_IDENTIFIER];
        
        $results = SearchForUser($name);
        
        include(MANAGEUSERSFORM_FILE);
    }
    
    function ManageUsers()
    {
        if (!userIsAuthorized(MANAGEUSERS_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        $results = getAllUsers();
        
        include(MANAGEUSERSFORM_FILE);
    }
    
    function UserAdd()
    {
        if (!userIsAuthorized(USERADD_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        $userName = "";
        
        include(ADDUSERFORM_FILE);
    }
    
    function UserEdit()
    {
        if (!userIsAuthorized(USEREDIT_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
        }
        else
        {
            $id = $_GET[USERID_IDENTIFIER];
            
            if (empty($id))
            {
                displayError("The user I.D. could not be resolved.");
            }
            else
            {
                $row = getUser($id);
                
                if ($row == false)
                {
                    displayError("User ID is not on file.");
                }
                else
                {
                    $hasAttrResults = getUserRoles($id);
                    $hasNotAttrResults = getNotUserRoles($id);
                    
                    $userID = $row[USERID_IDENTIFIER];
                    $userName = $row[USERNAME_IDENTIFIER];
                    
                    include(EDITUSERFORM_FILE);
                }
            }
        }
        
        Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
    }
    
    function UserDelete()
    {
        if (!userIsAuthorized(USERDELETE_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
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
                        deleteUser($_POST["record$i"]);
                    }
                }
            }
            
            $results = getAllUsers();
            
            include(MANAGEUSERSFORM_FILE);
        }
    }
    
    function ProcessUserAdd()
    {
        if(!userIsAuthorized(USERADD_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
        }
        else
        {
            $errors = array();

            $userName = $_POST[USERNAME_IDENTIFIER];
            $password = $_POST[PASSWORD_IDENTIFIER];
            $passwordRetype = $_POST[PASSWORDRETYPE_IDENTIFIER];
            
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

                Redirect(GetControllerScript(ADMINCONTROLLER_FILE, USERVIEW_ACTION . '&' . USERID_IDENTIFIER . '=' . urlencode($userID)));
            }

            include(ADDUSERFORM_FILE);
        }
    }
    
    function ProcessUserEdit()
    {
        if(!userIsAuthorized(USEREDIT_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
        }
        else
        {
            $errors = array();
            $userName = $_POST[USERNAME_IDENTIFIER];
            
            if(!empty($_POST[USERID_IDENTIFIER]))
            {
                $userID = $_POST[USERID_IDENTIFIER];
            }
            else
            {
                displayError('User I.D. could not be resolved.');
            }
            
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
            }

            if(!empty($_POST[PASSWORD_IDENTIFIER]))
            {
                $password = $_POST[PASSWORD_IDENTIFIER];
                $passwordRetype = $_POST[PASSWORDRETYPE_IDENTIFIER];
                
                if (strlen($password) > 40)
                {
                    $errors[] = 'Password is too long.';
                }
                
                if($password != $passwordRetype)
                {
                    $errors[] = 'The password and retyped password do not match.';
                }
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
                
                updateUserAttributes($userID, $hasAttributes);
                
                UpdateUser($userID, $userName, $password);

                Redirect(GetControllerScript(ADMINCONTROLLER_FILE, USERVIEW_ACTION . '&' . USERID_IDENTIFIER . '=' . urlencode($userID)));
            }
            
            $hasAttrResults = getUserRoles($userID);
            $hasNotAttrResults = getNotUserRoles($userID);
            
            include(EDITUSERFORM_FILE);
        }
    }

    function ManageFunctions()
    {
        if (!userIsAuthorized(MANAGEFUNCTIONS_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
        }
        else
        {
            $results = getAllFunctions();
            
            include(MANAGEFUNCTIONSFORM_FILE);
        }
    }
    
    function FunctionAdd()
    {
        if (!userIsAuthorized(FUNCTIONADD_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
        }
        else
        {
            include(ADDFUNCTIONFORM_FILE);
        }
    }
    
    function FunctionEdit()
    {
        if (!userIsAuthorized(FUNCTIONEDIT_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
        }
        else
        {
            $id = $_GET["id"];
            
            if (empty($id))
            {
                displayError("An ID is required for this function.");
            }
            else
            {
                $row = getFunction($id);
                
                if ($row == false)
                {
                    displayError("Function ID is not on file.");
                }
                else
                {
                    $id = $row["FunctionID"];
                    $name = $row["Name"];
                    $desc = $row["Description"];
                    
                    include(EDITFUNCTIONFORM_FILE);
                }
            }
        }
    }
    
    function FunctionDelete()
    {
        if (!userIsAuthorized(FUNCTIONDELETE_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
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
                        deleteFunction($_POST["record$i"]);
                    }
                }
            }
            
            $results = getAllFunctions();
            
            include(MANAGEFUNCTIONSFORM_FILE);
        }
    }
    
    function ProcessFunctionAddEdit()
    {
        $message = "";
        $errors = array( );
        
        if(empty($_POST["Name"]))
        {
            $message = "Error";
            $errors[] = "Error, field \"Name\" is blank.";
        }
        
        if($message == "")
        {
            if(!empty($_POST["FunctionID"]))
            {
                $FunctionID = $_POST["FunctionID"];
            }
            
            $name = $_POST["Name"];
            $desc = $_POST["Description"];
            
            if (empty($FunctionID))
            {   // No FunctionID means we are processing an ADD
                if (userIsAuthorized(FUNCTIONADD_ACTION))
                {
                    $FunctionID = addFunction($name, $desc);
                }
                else
                {
                    include(NOTAUTHORIZED_FILE);
                }
            }
            else
            {
                if (userIsAuthorized(FUNCTIONEDIT_ACTION))
                {
                    updateFunction($FunctionID, $name, $desc);
                }
                else
                {
                    include(NOTAUTHORIZED_FILE);
                }
            }
            
            $results = getAllFunctions();
            
            include(MANAGEFUNCTIONSFORM_FILE);
        }
        else
        {
            displayErrors($message, $errors);
        }
    }

    function ManageRoles()
    {
        if (!userIsAuthorized(MANAGEROLES_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
        }
        else
        {
            $results = getAllRoles();
            
            include(MANAGEROLESFORM_FILE);
        }
    }
    
    function RoleAdd()
    {
        if (!userIsAuthorized(ROLEADD_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
        }
        else
        {
            include(ADDROLEFORM_FILE);
        }
    }
    
    function RoleEdit()
    {
        if (!userIsAuthorized(ROLEEDIT_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
            exit();
        }
        
        $id = $_GET["id"];
        if (empty($id))
        {
            displayError("An ID is required for this function.");
        }
        else
        {
            $row = getRole($id);
            
            if ($row == false)
            {
                displayError("Role ID is not on file.");
            }
            else
            {
                $hasAttrResults = getRoleFunctions($id);
                $hasNotAttrResults = getNotRoleFunctions($id);
                $name = $row["Name"];
                $desc = $row["Description"];
                
                include(EDITROLEFORM_FILE);
            }
        }
    }
    
    function RoleDelete()
    {
        if (!userIsAuthorized(ROLEDELETE_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
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
                        deleteRole($_POST["record$i"]);
                    }
                }
            }
            
            $results = getAllRoles();
            
            include(MANAGEROLESFORM_FILE);
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
            $name = $_POST["Name"];
            $desc = $_POST["Description"];
            
            if (empty($RoleID))
            {   // No RoleID means we are processing an ADD
                if(userIsAuthorized(ROLEADD_ACTION))
                {
                    $RoleID = addRole($name, $desc);
                }
                else
                {
                    include(NOTAUTHORIZED_FILE);
                }
            }
            else
            {
                if(userIsAuthorized( ROLEEDIT_ACTION))
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
                    include(NOTAUTHORIZED_FILE);
                }
            }
            
            $results = getAllRoles();
            
            include(MANAGEROLESFORM_FILE);
        }
        else
        {
            displayErrors($message, $errors);
        }
    }
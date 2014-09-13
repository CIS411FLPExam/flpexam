<?php
    require_once('../../private/definitions/paths.php');
    require_once(ADMINMODEL_FILE);
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
            default:
                Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
    }
    
    function ExamParametersView()
    {
        $parameters = GetExamParameters();
        
        $keyCode = $parameters->GetKeyCode();
        $questionCount = $parameters->GetQuestionCount();
        $incLevelScore =  $parameters->GetIncLevelScorePercent();
        $decLevelScore =  $parameters->GetDecLevelScorePercent();
        
        include(VIEWEXAMPARAMETERSFORM_FILE);
    }
    
    function ExamParametersEdit()
    {
        $parameters = GetExamParameters();
        
        $keyCode = $parameters->GetKeyCode();
        $questionCount = $parameters->GetQuestionCount();
        $incLevelScore =  $parameters->GetIncLevelScorePercent();
        $decLevelScore =  $parameters->GetDecLevelScorePercent();
        
        include(EDITEXAMPARAMETERSFORM_FILE);
    }
    
    function ProcessExamParametersEdit()
    {
        if(userIsAuthorized(EXAMPARAMETERSEDIT_ACTION))
        {
            $parameters = new ExamParameters();

            $parameters->Initialize($_POST);
            
            SetExamParameters($parameters);
            Redirect(GetControllerScript(ADMINCONTROLLER_FILE, EXAMPARAMETERSVIEW_ACTION));
        }
        else
        {
            include(NOTAUTHORIZED_FILE);
        }
        
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
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        if(login($username,$password))
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
    
    function ManageQuestions()
    {
        if (isset($_POST[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_POST[LANGUAGEID_IDENTIFIER];
        }
        else
        {
            $languageID = $_GET[LANGUAGEID_IDENTIFIER];
        }
        
        $lang = GetLanguage($languageID);
        $questions = GetQuestions($languageID);
        
        $language = $lang[NAME_IDENTIFIER];
        
        include(MANAGEQUESTIONSFORM_FILE);
    }
    
    
    function ProcessQuestionAdd()
    {
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
        
        if(isset($questionID))
        {
            $language = GetQuestionLanguage($questionID);
            $languageID = $language[LANGUAGEID_IDENTIFIER];
            unset($questionID);
        }
        
        $name = '';
        $level = '1';
        $answers = array();
        $answers[] = array(NAME_IDENTIFIER => '');
        
        include(ADDEDITQUESTIONFORM_FILE);
    }
    
    function ProcessQuestionEdit()
    {
        if (isset($_POST[QUESTIONID_IDENTIFIER]))
        {
            $questionID = $_POST[QUESTIONID_IDENTIFIER];
        }
        else
        {
            $questionID = $_GET[QUESTIONID_IDENTIFIER];
        }
        
        $question = GetQuestion($questionID);
        
        $name = $question[NAME_IDENTIFIER];
        $level = $question['Level'];
        
        $answers = GetQuestionAnswers($questionID);
        
        include(ADDEDITQUESTIONFORM_FILE);
    }
    
    function ProcessQuestionView()
    {
        if (isset($_POST[QUESTIONID_IDENTIFIER]))
        {
            $questionID = $_POST[QUESTIONID_IDENTIFIER];
        }
        else
        {
            $questionID = $_GET[QUESTIONID_IDENTIFIER];
        }
        
        $question = GetQuestion($questionID);
        
        $name = $question[NAME_IDENTIFIER];
        $level = $question['Level'];
        
        $answers = GetQuestionAnswers($questionID);
        
        include(VIEWQUESTIONFORM_FILE);
    }
    
    function ProcessQuestionDelete()
    {
        
    }
    
    function ProcessQuestionAddEdit()
    {
        
        $name = $_POST[NAME_IDENTIFIER];
        
        $level = $_POST['Level'];
        $answers = array();
        
        $answerNumber = 0;
        while(isset($_POST['input' . $answerNumber]))
        {
            $answers[] = $_POST['input' . $answerNumber];
            $answerNumber++;
        }
        
        if(true)
        {
            if (isset($_POST[QUESTIONID_IDENTIFIER]))
            {
                $questionID = $_POST[QUESTIONID_IDENTIFIER];
                
                UpdateQuestion($questionID, $name, $level, $answers);
            }
            else
            {
                $languageID = $_POST[LANGUAGEID_IDENTIFIER];
                
                $questionID = AddQuestion($languageID, $name, $level, $answers);
            }
            
            Redirect(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONVIEW_ACTION . '&' . QUESTIONID_IDENTIFIER . '=' . urldecode($questionID)));
        }
        
        include(VIEWQUESTIONFORM_FILE);
    }
    
    function ProcessQuestionSearch()
    {
        $languageID = $_POST[LANGUAGEID_IDENTIFIER];
        $name = $_POST[NAME_IDENTIFIER];
        
        $lang = GetLanguage($languageID);
        $questions = SearchForQuestion($languageID, $name);
        
        $language = $lang[NAME_IDENTIFIER];
        
        include(MANAGEQUESTIONSFORM_FILE);
    }
    
    function ProcessLanguageAdd()
    {
        $name = "";
        
        include(ADDEDITLANGUAGEFORM_FILE);
    }
    
    function ProcessLanguageEdit()
    {
        if (isset($_POST[LANGUAGEID_IDENTIFIER]))
        {
            $languageID = $_POST[LANGUAGEID_IDENTIFIER];
        }
        else
        {
            $languageID = $_GET[LANGUAGEID_IDENTIFIER];
        }
        
        $language = GetLanguage($languageID);
        
        $name = $language[NAME_IDENTIFIER];
        $active = $language['Active'];
        
        include(ADDEDITLANGUAGEFORM_FILE);
    }
    
    function ProcessLanguageView()
    {
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
        
    }
    
    function ProcessLanguageAddEdit()
    {
        $name = $_POST[NAME_IDENTIFIER];
        $active = isset($_POST['Active']);
        
        if(true)
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
        
        include(ADDEDITLANGUAGEFORM_FILE);
    }
    
    function ManageLanguages()
    {
        $languages = GetAllLanguages();
        
        include(MANAGELANGUAGESFORM_FILE);
    }
    
    function ProcessUserView()
    {
        $userID = $_GET[USERID_IDENTIFIER];
        
        $row = getUser($userID);
        
        $hasAttrResults = getUserRoles($userID);
        
        $userName = $row[USERNAME_IDENTIFIER];
        
        include(VIEWUSERFORM_FILE);
    }
    
    function ProcessUserSearch()
    {
        $name = $_POST[NAME_IDENTIFIER];
        
        $results = SearchForUser($name);
        
        include(MANAGEUSERSFORM_FILE);
    }
    
    function ManageUsers()
    {
        $results = getAllUsers();
        
        include(MANAGEUSERSFORM_FILE);
    }
    
    function UserAdd()
    {
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
                displayError("An ID is required for this function.");
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
        $valid = TRUE;
        
        $userName = $_POST[USERNAME_IDENTIFIER];
        $password = $_POST[PASSWORD_IDENTIFIER];
        $passwordRetype = $_POST[PASSWORDRETYPE_IDENTIFIER];
        
        if($password != $passwordRetype)
        {
            $valid = FALSE;
        }
        
        if($valid)
        {
            $userID = addUser($userName, $password);
            
            Redirect(GetControllerScript(ADMINCONTROLLER_FILE, USERVIEW_ACTION . '&' . USERID_IDENTIFIER . '=' . urlencode($userID)));
        }
        
        include(ADDUSERFORM_FILE);
    }
    
    function ProcessUserEdit()
    {
        $valid = TRUE;
        
        $userName = $_POST[USERNAME_IDENTIFIER];
        
        if(!empty($_POST[USERID_IDENTIFIER]))
        {
            $userID = $_POST[USERID_IDENTIFIER];
        }
        else
        {
            displayError('User ID could not be resolved.');
        }
        
        if(!empty($_POST[PASSWORD_IDENTIFIER]))
        {
            $password = $_POST[PASSWORD_IDENTIFIER];
            $passwordRetype = $_POST[PASSWORDRETYPE_IDENTIFIER];

            if($password != $passwordRetype)
            {
                $valid = FALSE;
            }
        }
        
        if($valid)
        {
            if(userIsAuthorized(USEREDIT_ACTION))
            {
                $hasAttributes = array();

                if(!empty($_POST["hasAttributes"]))
                {
                    $hasAttributes = $_POST["hasAttributes"];

                    updateUserAttributes($userID, $hasAttributes);
                }
                
                UpdateUser($userID, $userName, $password);
                
                Redirect(GetControllerScript(ADMINCONTROLLER_FILE, USERVIEW_ACTION . '&' . USERID_IDENTIFIER . '=' . urlencode($userID)));
            }
            else
            {
                include(NOTAUTHORIZED_FILE);
            }
        }
        
        include(EDITUSERFORM_FILE);
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
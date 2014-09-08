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
    
    if ($action != PROCESSLOGIN_ACTION && !userIsAuthorized($action))
    {
        if(!loggedIn())
        {
            $url = GetControllerScript(MAINCONTROLLER_FILE,LOGIN_ACTION) . "&RequestedPage=" . GetRequestedURI( );
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
            case CONTROLPANEL_ACTION :
                include(CONTROLPANELFORM_FILE);
                break;
            case MANAGEUSERS_ACTION :
                ManageUsers();
                break;
            case USEREDIT_ACTION :
                UserEdit();
                break;
            case USERDELETE_ACTION :
                UserDelete();
                break;
            case PROCESSUSERADDEDIT_ACTION :
                ProcessUserAddEdit();
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
            default:
                Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
    }
    
    function ProcessQuestionAdd()
    {
        $name = 'How are you?';
        
        $answers = array();
        $answers[] = 'Fine.';
        $answers[] = 'Good.';
        $answers[] = 'Well.';
        
        include(ADDEDITQUESTIONFORM_FILE);
    }
    
    function ProcessQuestionEdit()
    {
        
        $questionID = '-1';
        $name = 'How are you?';
        
        $answers = array();
        $answers[] = 'Fine.';
        $answers[] = 'Good.';
        $answers[] = 'Well.';
        
        include(ADDEDITQUESTIONFORM_FILE);
    }
    
    function ProcessQuestionView()
    {
        $questionID = '-1';
        $name = 'How are you?';
        
        $answers = array();
        $answers[] = 'Fine.';
        $answers[] = 'Good.';
        $answers[] = 'Well.';
        
        include(VIEWQUESTIONFORM_FILE);
    }
    
    function ProcessQuestionDelete()
    {
        
    }
    
    function ProcessQuestionAddEdit()
    {
        $questionID = '-1';
        $name = 'How are you?';
        
        $answers = array();
        $answers[] = 'Fine.';
        $answers[] = 'Good.';
        $answers[] = 'Well.';
        
        include(VIEWQUESTIONFORM_FILE);
    }
    
    function ProcessLanguageAdd()
    {
        $name = "";
        
        include(ADDEDITLANGUAGEFORM_FILE);
    }
    
    function ProcessLanguageEdit()
    {
        $languageID = $_GET[LANGUAGEID_IDENTIFIER];
        
        $name = "French";
        $active = FALSE;
        
        include(ADDEDITLANGUAGEFORM_FILE);
    }
    
    function ProcessLanguageView()
    {
        $languageID = $_GET[LANGUAGEID_IDENTIFIER];
        
        $name = "French";
        $active = FALSE;
        
        $questions = array();
        $questions[] = array('QuestionID' => '-1', 'Name' => 'How are you?');
        $questions[] = array('QuestionID' => '-1', 'Name' => 'What are you doing?');
        
        include(VIEWLANGUAGEFORM_FILE);
    }
    
    function ProcessLanguageDelete()
    {
        
    }
    
    function ProcessLanguageAddEdit()
    {
        $name = "French";
        $active = FALSE;
        
        $questions = array();
        $questions[] = array(['QuestionID'] => '-1', ['Name'] => 'How are you?');
        $questions[] = array(['QuestionID'] => '-1', ['Name'] => 'What are you doing?');
        
        include(ADDEDITLANGUAGEFORM_FILE);
    }
    
    function ManageLanguages()
    {
        $french = array();
        $french[LANGUAGEID_IDENTIFIER] = '1';
        $french[NAME_IDENTIFIER] = 'French';
        
        $spanish = array();
        $spanish[LANGUAGEID_IDENTIFIER] = '2';
        $spanish[NAME_IDENTIFIER] = 'Spanish';
        
        $languages = array($french, $spanish);
        
        include(MANAGELANGUAGESFORM_FILE);
    }
    
    function ProcessUserView()
    {
        $userID = $_GET[USERID_IDENTIFIER];
        
        $row = getUser($userID);
        
        $hasAttrResults = getUserRoles($userID);
        
        $firstName = $row[FIRSTNAME_IDENTIFIER];
        $lastName = $row[LASTNAME_IDENTIFIER];
        $userName = $row[USERNAME_IDENTIFIER];
        $email = $row[EMAIL_IDENTIFIER];
        
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
                    $firstName = $row[FIRSTNAME_IDENTIFIER];
                    $lastName = $row[LASTNAME_IDENTIFIER];
                    $userName = $row[USERNAME_IDENTIFIER];
                    $email = $row[EMAIL_IDENTIFIER];
                    
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
    function ProcessUserAddEdit()
    {
        $message = "";
        $collection = array();
        
        if (empty($_POST[FIRSTNAME_IDENTIFIER]))
        {
            $message = "Errors";
            $collection[] = "Error, field \"First Name\" is blank.";
        }
        
        if (empty($_POST[LASTNAME_IDENTIFIER]))
        {
            $message = "Errors";
            $collection[] = "Error, field \"Last Name\" is blank.";
        }
        
        if (empty($_POST[USERNAME_IDENTIFIER]))
        {
            $message = "Errors";
            $collection[] = "Error, field \"User Name\" is blank.";
        }
        
        if (empty($_POST[EMAIL_IDENTIFIER]))
        {
            $message = "Errors";
            $collection[] = "Error, field \"Email\" is blank.";
        }
        
        if ($message == "")
        {
            if(!empty($_POST[USERID_IDENTIFIER]))
            {
                $UserID = $_POST[USERID_IDENTIFIER];
            }
            $firstName = $_POST[FIRSTNAME_IDENTIFIER];
            $lastName = $_POST[LASTNAME_IDENTIFIER];
            $userName = $_POST[USERNAME_IDENTIFIER];
            $password = $_POST[PASSWORD_IDENTIFIER];
            $email = $_POST[EMAIL_IDENTIFIER];
            
            if (empty($UserID))
            {   // No UserID means we are processing an ADD
                if(userIsAuthorized(USERADD_ACTION))
                {
                    $UserID = addUser($firstName, $lastName, $userName, $password, $email);
                }
                else
                {
                    include(NOTAUTHORIZED_FILE);
                }
            }
            else
            {
                if(userIsAuthorized(USEREDIT_ACTION))
                {
                    $hasAttributes = array();
                    
                    if(!empty($_POST["hasAttributes"]))
                    {
                        $hasAttributes = $_POST["hasAttributes"];
                    }
                    
                    updateUser($UserID, $firstName, $lastName, $userName, $password, $email, $hasAttributes);
                }
                else
                {
                    include(NOTAUTHORIZED_FILE);
                }
            }
            
            $results = getAllUsers();
            
            include(MANAGEUSERSFORM_FILE);
            
        }
        else
        {
            displayErrors($message, $collection);
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
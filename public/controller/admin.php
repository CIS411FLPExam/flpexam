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
            $url = GetControllerScript(ADMINCONTROLLER_FILE,LOGIN_ACTION) . "&RequestedPage=" . GetRequestedURI( );
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
            case USERADD_ACTION :
                UserAdd();
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
            default:
                Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
    }
    

    function ManageUsers()
    {
        $results = getAllUsers();
        include(MANAGEUSERSFORM_FILE);
    }
    
    function UserAdd()
    {
        if (!userIsAuthorized(USERADD_ACTION))
        {
            include(NOTAUTHORIZED_FILE);
        }
        else
        {
            include(ADDUSERFORM_FILE);
        }
    }
    
    function UserEdit()
    {
        if (!userIsAuthorized(USEREDIT_ACTION))
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
                $row = getUser($id);
                
                if ($row == false)
                {
                    displayError("User ID is not on file.");
                }
                else
                {
                    $hasAttrResults = getUserRoles($id);
                    $hasNotAttrResults = getNotUserRoles($id);
                    $userID = $row["UserID"];
                    $firstName = $row["FirstName"];
                    $lastName = $row["LastName"];
                    $userName = $row["UserName"];
                    $email = $row["Email"];
                    
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
        $collection = array();
        
        if (empty($_POST["FirstName"]))
        {
            $message = "Errors";
            $collection[] = "Error, field \"First Name\" is blank.";
        }
        
        if (empty($_POST["LastName"]))
        {
            $message = "Errors";
            $collection[] = "Error, field \"Last Name\" is blank.";
        }
        
        if (empty($_POST["UserName"]))
        {
            $message = "Errors";
            $collection[] = "Error, field \"User Name\" is blank.";
        }
        
        if (empty($_POST["Email"]))
        {
            $message = "Errors";
            $collection[] = "Error, field \"Email\" is blank.";
        }
        
        if ($message == "")
        {
            if(!empty($_POST["UserID"]))
            {
                $UserID = $_POST["UserID"];
            }
            $firstName = $_POST["FirstName"];
            $lastName = $_POST["LastName"];
            $userName = $_POST["UserName"];
            $password = $_POST["Password"];
            $email = $_POST["Email"];
            
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
<?php
    error_reporting(E_ALL ^ E_NOTICE);
    session_start();
    require_once ("../model/model.php");
    require_once("../security/model.php");

    if (isset($_POST['action'])) {	    // check get and post
        $action = $_POST['action'];
    } else if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }
    else
    {
        $action ="";
    }

    $randomQuote = GetRandomQuote( );
    
    if ($action != 'ProcessLogin' && !userIsAuthorized($action)) {
        if(!loggedIn()) {
            header("Location:index.php?action=Login&RequestedPage=" . urlencode($_SERVER['REQUEST_URI']));
        } else {
            include('../security/not_authorized.html');
        }
    } else {
        switch ($action) {
            case 'Login':
                HandleLogin();
                break;
            case 'ProcessLogin':
                ProcessLogin();
                break;
            case 'LogOut':
                logOut();
                header("Location:index.php");
                break;
            case 'ManageUsers':
                ManageUsers();
                break;
            case 'UserAdd':
                UserAdd();
                break;
            case 'UserEdit':
                UserEdit();
                break;
            case 'UserDelete':
                UserDelete();
                break;
            case 'ProcessUserAddEdit':
                ProcessUserAddEdit();
                break;
            case 'ManageFunctions':
                ManageFunctions();
                break;
            case 'FunctionAdd':
                FunctionAdd();
                break;
            case 'FunctionEdit':
                FunctionEdit();
                break;
            case 'FunctionDelete':
                FunctionDelete();
                break;
            case 'ProcessFunctionAddEdit':
                ProcessFunctionAddEdit();
                break;
            case 'ManageRoles':
                ManageRoles();
                break;
            case 'RoleAdd':
                RoleAdd();
                break;
            case 'RoleEdit':
                RoleEdit();
                break;
            case 'RoleDelete':
                RoleDelete();
                break;
            case 'ProcessRoleAddEdit':
                ProcessRoleAddEdit();
                break;
            default:
                include('../security/control_panel_form.php');               // default action
        }
    }
    
    function HandleLogin( )
    {
        $randomQuote = GetRandomQuote( );
        
        if (!isset($_SERVER['HTTPS']))
        {
            $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            header("Location: " . $url);
            exit();
        }
        
        include('login_form.php');
    }

    function ProcessLogin(){
        $username = $_POST["username"];
        $password = $_POST["password"];

        if(login($username,$password)){
            header("Location:" . $_POST["RequestedPage"]);
        } else {
            header("Location:../security/index.php?action=Login&LoginFailure&RequestedPage=" . urlencode($_POST["RequestedPage"]));
        }
    }

    function ManageUsers() {
        $randomQuote = GetRandomQuote( );
        $results = getAllUsers();
        include('../security/manage_users_form.php');
    }
    function UserAdd() {
        $randomQuote = GetRandomQuote( );
        if (!userIsAuthorized("UserUpdate")) {
            include('../security/not_authorized.html');
        } else {
            include('../security/add_user_form.php');
        }
    }
    function UserEdit() {
        $randomQuote = GetRandomQuote( );
        if (!userIsAuthorized("UserUpdate")) {
            include('../security/not_authorized.html');
        } else {
            $id = $_GET["id"];
            if (empty($id)) {
                displayError("An ID is required for this function.");
            } else {
                $row = getUser($id);
                if ($row == false) {
                    displayError("<p>User ID is not on file.</p> ");
                } else {
                    $hasAttrResults = getUserRoles($id);
                    $hasNotAttrResults = getNotUserRoles($id);
                    $userID = $row["UserID"];
                    $firstName = $row["FirstName"];
                    $lastName = $row["LastName"];
                    $userName = $row["UserName"];
                    $email = $row["Email"];
                    include('../security/modify_user_form.php');
                }
            }
        }
    }
    function UserDelete() {
        $randomQuote = GetRandomQuote( );
        if (!userIsAuthorized("UserDelete")) {
            include('../security/not_authorized.html');
        } else {
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
            include('../security/manage_users_form.php');
        }
    }
    function ProcessUserAddEdit() {
        $randomQuote = GetRandomQuote( );
        if (!userIsAuthorized("UserUpdate")) {
            include('../security/not_authorized.html');
        } else {
            $errors = "";

            if(empty($_POST["FirstName"]))
                    $errors .= "<li>Error, field \"First Name\" is blank.</li>";
            if(empty($_POST["LastName"]))
                    $errors .= "<li>Error, field \"Last Name\" is blank.</li>";
            if(empty($_POST["UserName"]))
                    $errors .= "<li>Error, field \"User Name\" is blank.</li>";
            if(empty($_POST["Email"]))
                    $errors .= "<li>Error, field \"Email\" is blank.</li>";

            if($errors == "") {
                $UserID = $_POST["UserID"];
                $firstName = $_POST["FirstName"];
                $lastName = $_POST["LastName"];
                $userName = $_POST["UserName"];
                $password = $_POST["Password"];
                $email = $_POST["Email"];
                if (empty($UserID)) {   // No UserID means we are processing an ADD
                    $UserID = addUser($firstName, $lastName, $userName, $password, $email);
                } else {
                    $hasAttributes = $_POST["hasAttributes"];
                    updateUser($UserID, $firstName, $lastName, $userName, $password, $email, $hasAttributes);
                }
                $results = getAllUsers();
                include('../security/manage_users_form.php');
            } else {
                displayError($errors);
            }
        }
    }

    function ManageFunctions() {
        $randomQuote = GetRandomQuote( );
        if (!userIsAuthorized("FunctionRead")) {
            include('../security/not_authorized.html');
        } else {
            $results = getAllFunctions();
            include('../security/manage_functions_form.php');
        }
    }
    function FunctionAdd() {
        $randomQuote = GetRandomQuote( );
        if (!userIsAuthorized("FunctionUpdate")) {
            include('../security/not_authorized.html');
        } else {
            include('../security/add_function_form.php');
        }
    }
    function FunctionEdit() {
        $randomQuote = GetRandomQuote( );
        if (!userIsAuthorized("FunctionUpdate")) {
            include('../security/not_authorized.html');
        } else {
            $id = $_GET["id"];
            if (empty($id)) {
                displayError("An ID is required for this function.");
            } else {
                $row = getFunction($id);
                if ($row == false) {
                    displayError("<p>Function ID is not on file.</p> ");
                } else {
                    $id = $row["FunctionID"];
                    $name = $row["Name"];
                    $desc = $row["Description"];
                    include('../security/modify_function_form.php');
                }
            }
        }
    }
    function FunctionDelete() {
        $randomQuote = GetRandomQuote( );
        if (!userIsAuthorized("FunctionDelete")) {
            include('../security/not_authorized.html');
        } else {
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
            include('../security/manage_functions_form.php');
        }
    }
    function ProcessFunctionAddEdit() {
        $randomQuote = GetRandomQuote( );
        if (!userIsAuthorized("FunctionUpdate")) {
            include('../security/not_authorized.html');
        } else {
            $errors = "";

            if(empty($_POST["Name"]))
                $errors .= "<li>Error, field \"Name\" is blank.</li>";

            if($errors == "") {
                $FunctionID = $_POST["FunctionID"];
                $name = $_POST["Name"];
                $desc = $_POST["Description"];
                if (empty($FunctionID)) {   // No FunctionID means we are processing an ADD
                    $FunctionID = addFunction($name, $desc);
                } else {
                    updateFunction($FunctionID, $name, $desc);
                }
                $results = getAllFunctions();
                include('../security/manage_functions_form.php');
            } else {
                displayError($errors);
            }
        }
    }

    function ManageRoles() {
        $randomQuote = GetRandomQuote( );
        if (!userIsAuthorized("RoleRead")) {
            include('../security/not_authorized.html');
        } else {
            $results = getAllRoles();
            include('../security/manage_roles_form.php');
        }
    }
    function RoleAdd() {
        $randomQuote = GetRandomQuote( );
        if (!userIsAuthorized("RoleUpdate")) {
            include('../security/not_authorized.html');
        } else {
            include('../security/add_role_form.php');
        }
    }
    function RoleEdit() {
        $randomQuote = GetRandomQuote( );
        if (!userIsAuthorized("RoleUpdate")) {
            include('../security/not_authorized.html');
        } else {
            $id = $_GET["id"];
            if (empty($id)) {
                displayError("An ID is required for this function.");
            } else {
                $row = getRole($id);
                if ($row == false) {
                    displayError("<p>Role ID is not on file.</p> ");
                } else {
                    $hasAttrResults = getRoleFunctions($id);
                    $hasNotAttrResults = getNotRoleFunctions($id);
                    $name = $row["Name"];
                    $desc = $row["Description"];
                    include('../security/modify_role_form.php');
                }
            }
        }
    }
    function RoleDelete() {
        $randomQuote = GetRandomQuote( );
        if (!userIsAuthorized("RoleDelete")) {
            include('../security/not_authorized.html');
        } else {
            if(isset($_POST["numListed"]))
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
            include('../security/manage_roles_form.php');
        }
    }
    function ProcessRoleAddEdit() {
        $randomQuote = GetRandomQuote( );
        if (!userIsAuthorized("RoleUpdate")) {
            include('../security/not_authorized.html');
        } else {
            $errors = "";
            if(empty($_POST["Name"]))
                $errors .= "<li>Error, field \"Name\" is blank.</li>";
            if($errors == "") {
                $RoleID = $_POST["RoleID"];
                $name = $_POST["Name"];
                $desc = $_POST["Description"];
                if (empty($RoleID)) {   // No RoleID means we are processing an ADD
                    $RoleID = addRole($name, $desc);
                } else {
                    $hasAttributes = $_POST["hasAttributes"];
                    updateRole($RoleID, $name, $desc, $hasAttributes);
                }
                $results = getAllRoles();
                include('../security/manage_roles_form.php');
            } else {
                displayError($errors);
            }
        }
    }

?>



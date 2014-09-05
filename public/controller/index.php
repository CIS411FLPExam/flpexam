<?php

    require_once('../../private/definitions/paths.php');
    require_once(PATHS_FILE);
    require_once(IDENTIFIER_FILE);
    require_once(GENERALFUNCTIONS_FILE);
    require_once(ACTIONS_FILE);
    require_once(MAINMODEL_FILE);
    
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
            case SELFADD_ACTION :
                ProcessSelfAdd( );
                break;
            case PROCESSSELFADDEDIT_ACTION :
                ProcessSelfAddEdit();
                break;
            default :
                include(HOME_FILE);
                break;
        }
    }
    
    function HandleLogin( )
    {
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
        
        echo("username=" . $username);
        echo("password=" . $password);

        if(login($username,$password)){
            header("Location:" . $_POST["RequestedPage"]);
        } else {
            $url = GetControllerScript(ADMINCONTROLLER_FILE, LOGIN_ACTION ) . "&LoginFailure&RequestedPage=" . urlencode($_POST["RequestedPage"]);
            Redirect( $url );
        }
    }
    
    function ProcessSelfAdd()
    {
        $firstName = "";
        $lastName = "";
        $userName = "";
        $email = "";
        
        include(ADDEDITSELFFORM_FILE);
    }
    
    function ProcessSelfEdit()
    {
        //Get id, first name, last name, user name, and email from the database.
        $userID = "";
        
        $firstName = "";
        $lastName = "";
        $userName = "";
        $email = "";
    }
    
    function ProcessSelfAddEdit()
    {
        $errors = array();
        
        $firstName = $_POST[FIRSTNAME_IDENTIFIER];
        $lastName = $_POST[LASTNAME_IDENTIFIER];
        $userName = $_POST[USERNAME_IDENTIFIER];
        $email = $_POST[EMAIL_IDENTIFIER];
        
        if (isset($_POST[USERID_IDENTIFIER]))
        {
            $userID = $_POST[USERID_IDENTIFIER];
        }
        
        $firstNameVI = ValidateFirstName($firstName);
        $lastNameVI = ValidateLastName($lastName);
        $userNameVI = ValidateUsername($userName);
        $emailVI = ValidateEmail($email);
        
        if(!$firstNameVI->IsValid())
        {
            $errors = array_merge($errors, $firstNameVI->GetErrors());
        }
        
        if(!$lastNameVI->IsValid())
        {
            $errors = array_merge($errors, $lastNameVI->GetErrors());
        }
        
        if(!$userNameVI->IsValid())
        {
            $errors = array_merge($errors, $userNameVI->GetErrors());
        }
        
        if(!$emailVI->IsValid())
        {
            $errors = array_merge($errors, $emailVI->GetErrors());
        }
        
        if (count($errors) > 0)
        {
            $message = "Errors";
            $collection = $errors;
            
            include(ADDEDITSELFFORM_FILE);
        }
        else
        {
            //Checking to see if we are doing an add or an edit.
            if (isset($userID))
            {//We are doing an EDIT.
                
                if(userIsAuthentic($userID))
                {
                    
                }
            }
            else
            {//We are doing and ADD.
                
            }
        }
    }
?>
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
        $action = "";
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
            case SELFVIEW_ACTION :
                ProcessSelfView();
                break;
            case SELFEDIT_ACTION :
                ProcessSelfEdit();
                break;
            case MANAGELANGUAGEPROFILES_ACTION :
                ManageLanguageProfiles();
                break;
            case LANGUAGEPROFILEADD_ACTION :
                ProcessLanguageProfileAdd();
                break;
            case LANGUAGEPROFILEEDIT_ACTION :
                ProcessLanguageProfileEdit();
                break;
            case PROCESSLANGUAGEPROFILEADDEDIT_ACTION :
                ProcessLanguageProfileAddEdit();
                break;
            case LANGUAGEPROFILEVIEW_ACTION :
                ProcessLanguageProfileView();
                break;
            case PROFILEADD_ACTION :
                ProcessProfileAdd();
                break;
            case PROFILEEDIT_ACTION :
                ProcessProfileEdit();
                break;
            case PROFILEVIEW_ACTION :
                ProcessProfileView();
                break;
            case PROCESSPROFILEADDEDIT_ACTION:
                ProcessProfileAddEdit();
                break;
            default :
                include(HOME_FILE);
                break;
        }
    }
    
    function ProcessProfileAdd()
    {
        if(!loggedIn())
        {
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
        
        $major = '';
        $highSchool = '';
        
        include(ADDEDITPROFILEFORM_FILE);
    }
    
    function ProcessProfileEdit()
    {
        if(!loggedIn())
        {
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
        
        $userID = $_SESSION[USERID_IDENTIFIER];
        
        $profile = GetProfile($userID);
        
        $major = $profile['Major'];
        $highSchool = $profile['HighSchool'];
        
        include(ADDEDITPROFILEFORM_FILE);
    }
    
    function ProcessProfileView()
    {
        if(!loggedIn())
        {
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
        
        $userID = $_SESSION[USERID_IDENTIFIER];
        
        $profile = GetProfile($userID);
        
        $major = $profile['Major'];
        $highSchool = $profile['HighSchool'];
        
        include(VIEWPROFILEFORM_FILE);
    }
    
    function ProcessProfileAddEdit()
    {
        if(!loggedIn())
        {
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
        
        $major = $_POST['Major'];
        $highSchool = $_POST['HighSchool'];
        
        if(true)
        {
            if(isset($_POST[USERID_IDENTIFIER]))
            {
                $userID = $_POST[USERID_IDENTIFIER];
                
                if(userIsAuthentic($userID))
                {
                    UpdateProfile($userID, $major, $highSchool);
                }
                else
                {
                    include(NOTAUTHORIZED_FILE);
                    exit();
                }
            }
            else
            {
                $userID = $_SESSION[USERID_IDENTIFIER];
                
                AddProfile($userID, $major, $highSchool);
            }
            
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, PROFILEVIEW_ACTION));
        }
        else
        {
            include(VIEWPROFILEFORM_FILE);
        }
    }
    
    function ProcessLanguageProfileView()
    {
        if(!loggedIn())
        {   //Then we don't want to show a guest anyones user infmormation.
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
        else
        {   //A user is trying to view their own information.
            $userID = $_SESSION[USERID_IDENTIFIER];
        }
        
        $profileID = $_GET[LANGUAGEPROFILEID_IDENTIFIER];
        
        $profile = GetLanguageProfile($userID, $profileID);
        
        $language = $profile['Language'];
        $spokenAtHome = $profile['SpokenAtHome'];
        $jrHighExp = $profile['JrHighExp'];
        $srHighExp = $profile['SrHighExp'];
        $collegeExp = $profile['CollegeExp'];
        
        include(VIEWLANGUAGEPROFILEFORM_FILE);
    }
    
    function ProcessLanguageProfileAddEdit()
    {
        if(!loggedIn())
        {   //Then we don't want to show a guest anyones user infmormation.
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
        else
        {
            $userID = $_SESSION[USERID_IDENTIFIER];
        }
        
        $language = $_POST['Language'];
        $spokenAtHome = isset($_POST['SpokenAtHome']);
        $jrHighExp = $_POST['JrHighExp'];
        $srHighExp = $_POST['SrHighExp'];
        $collegeExp = $_POST['CollegeExp'];
        
        if(true)
        {
            if(isset($_POST[LANGUAGEPROFILEID_IDENTIFIER]))
            {
                $id = $_SESSION[USERID_IDENTIFIER];
                $profileID = $_POST[LANGUAGEPROFILEID_IDENTIFIER];

                if (!userOwnsProfile($id, $profileID))
                {
                    Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
                }
                
                UpdateLanguageProfile($profileID, $spokenAtHome, $jrHighExp, $srHighExp, $collegeExp);
            }
            else
            {
               $profileID = AddLanguageProfile($userID, $language, $spokenAtHome, $jrHighExp, $srHighExp, $collegeExp);
            }
            
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, LANGUAGEPROFILEVIEW_ACTION . '&' . LANGUAGEPROFILEID_IDENTIFIER . '=' . urlencode($profileID)));
        }
        
        $availableLanguages = GetAllLanguages();
        $experiences = GetAllExpeirences();
        
        include(ADDEDITLANGUAGEPROFILEFORM_FILE);
    }
    
    function ProcessLanguageProfileAdd()
    {
        if(!loggedIn())
        {
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
        
        $availableLanguages = GetAllLanguages();
        
        if (count($availableLanguages) < 1)
        {
            displayError("No languages available at this time.");
        }
        
        $experiences = GetAllLanguageExperiences();
        
        $language = $availableLanguages[0][NAME_IDENTIFIER];
        $spokenAtHome = FALSE;
        $jrHighExp = $experiences[0][NAME_IDENTIFIER];
        $srHighExp = $experiences[0][NAME_IDENTIFIER];
        $collegeExp = $experiences[0][NAME_IDENTIFIER];
        
        include(ADDEDITLANGUAGEPROFILEFORM_FILE);
    }
    
    function ProcessLanguageProfileEdit()
    {
        if(!loggedIn())
        {
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
        
        if(isset($_POST[LANGUAGEPROFILEID_IDENTIFIER]))
        {
            $profileID = $_POST[LANGUAGEPROFILEID_IDENTIFIER];
        }
        else
        {
            $profileID = $_GET[LANGUAGEPROFILEID_IDENTIFIER];
        }
        
        
        
        $userID = $_SESSION[USERID_IDENTIFIER];
        
        $experiences = GetAllLanguageExperiences();
        
        $profile = GetLanguageProfile($userID, $profileID);
        
        $language = $profile['Language'];
        $spokenAtHome = $profile['SpokenAtHome'];
        $jrHighExp = $profile['JrHighExp'];
        $srHighExp = $profile['SrHighExp'];
        $collegeExp = $profile['CollegeExp'];
        
        include(ADDEDITLANGUAGEPROFILEFORM_FILE);
    }
    
    function ManageLanguageProfiles()
    {
        if(!loggedIn())
        {
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
        
        $userID = $_SESSION[USERID_IDENTIFIER];
        
        $languageProfiles = GetLanguageProfiles($userID);
        
        include(MANAGELANGUAGEPROFILESFORM_FILE);
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
            $url = GetControllerScript(MAINCONTROLLER_FILE, LOGIN_ACTION ) . "&LoginFailure&RequestedPage=" . urlencode($_POST["RequestedPage"]);
            Redirect( $url );
        }
    }
    
    function ProcessSelfView()
    {
        $userID = "";
        
        if(!loggedIn())
        {   //Then we don't want to show a guest anyones user infmormation.
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
        else
        {   //A user is trying to view their own information.
            $userID = $_SESSION[USERID_IDENTIFIER];
        }
        
        if (!empty($userID))
        {
            $user = getUser($userID);
        
            $firstName = $user[FIRSTNAME_IDENTIFIER];
            $lastName = $user[LASTNAME_IDENTIFIER];
            $userName = $user[USERNAME_IDENTIFIER];
            $email = $user[EMAIL_IDENTIFIER];
            
            include(VIEWSELFFORM_FILE);
        }
    }
    
    function ProcessSelfAdd()
    {
        if(loggedIn())
        {
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
        
        $firstName = "";
        $lastName = "";
        $userName = "";
        $email = "";
        
        include(ADDEDITSELFFORM_FILE);
    }
    
    function ProcessSelfEdit()
    {
        $userID = "";
        
        if(loggedIn())
        {
            if(isset($_POST[USERID_IDENTIFIER]))
            {
                $userID = $_POST[USERID_IDENTIFIER];
            }
            
            if(!userIsAuthentic($userID))
            {
                include(NOTAUTHORIZED_FILE);
                exit();
            } 
        }
        
        if(empty($userID))
        {
            Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
        }
        
        $user = getUser($userID);
        
        $firstName = $user[FIRSTNAME_IDENTIFIER];
        $lastName = $user[LASTNAME_IDENTIFIER];
        $userName = $user[USERNAME_IDENTIFIER];
        $email = $user[EMAIL_IDENTIFIER];
        
        include(ADDEDITSELFFORM_FILE);
    }
    
    function ProcessSelfAddEdit()
    {
        $errors = array();
        
        $firstName = $_POST[FIRSTNAME_IDENTIFIER];
        $lastName = $_POST[LASTNAME_IDENTIFIER];
        $email = $_POST[EMAIL_IDENTIFIER];
        
        if (isset($_POST[USERID_IDENTIFIER]))
        {
            $userID = $_POST[USERID_IDENTIFIER];
        }
        
        $firstNameVI = ValidateFirstName($firstName);
        $lastNameVI = ValidateLastName($lastName);
        $emailVI = ValidateEmail($email);
        
        if(!$firstNameVI->IsValid())
        {
            $errors = array_merge($errors, $firstNameVI->GetErrors());
        }
        
        if(!$lastNameVI->IsValid())
        {
            $errors = array_merge($errors, $lastNameVI->GetErrors());
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
            {   //We are doing an EDIT.
                
                if(userIsAuthentic($userID))
                {
                    SelfUpdate($userID, $firstName, $lastName, $email);
                    Redirect(GetControllerScript(MAINCONTROLLER_FILE, SELFVIEW_ACTION));
                }
                else
                {
                    include(NOTAUTHORIZED_FILE);
                }
            }
            else
            {   //We are doing and ADD.
                $addErrors = array();
                
                
                $userName = $_POST[USERNAME_IDENTIFIER];
                
                $password = $_POST[PASSWORD_IDENTIFIER];
                $passwordRetype = $_POST[PASSWORDRETYPE_IDENTIFIER];
                
                $passwordVI = ValidatePassword($password, $passwordRetype);
                $userNameVI = ValidateUsername($userName);
                
                if(!$userNameVI->IsValid())
                {
                    $addErrors = array_merge($addErrors, $userNameVI->GetErrors());
                }
                else if(UserNameExists($userName))
                {
                    $addErrors[] = "The User Name \"" . $userName . "\" already exists.";
                }
                
                if(!$passwordVI->IsValid())
                {
                    $addErrors = array_merge($addErrors, $passwordVI->GetErrors());
                }
                
                if(count($addErrors) < 1)
                {
                    if(!loggedIn())
                    {
                        SelfAdd($firstName, $lastName, $userName, $password, $email);
                        login($userName, $password);
                        Redirect(GetControllerScript(MAINCONTROLLER_FILE, HOME_ACTION));
                    }
                    else
                    {
                        include(NOTAUTHORIZED_FILE);
                    }
                }
                else
                {
                    $message = "Errors";
                    $collection = $addErrors;

                    include(ADDEDITSELFFORM_FILE);
                }
            }
        }
    }
?>
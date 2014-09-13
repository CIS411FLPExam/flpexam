<?php
//ALL PATHS ARE RELATIVE TO ./flpexam/public/controller/

//Base paths
/******************************************************************************/

    //Base directories.
    /**
     * The file path of the public directory.
     */
    define("PUBLIC_DIR", "../../public/");
    
    /**
     * The file path of the private directory.
     */
    define("PRIVATE_DIR", "../../private/");
    
    /**
     * The file path of the CSS directory.
     */
    define("CSS_DIR", PRIVATE_DIR . "css/");
    
    /**
     * The file path of the javascript directory.
     */
    define("JAVASCRIPT_DIR", PRIVATE_DIR . "js/");
    
    /**
     * The file path of the includes directory.
     */
    define("INCLUDES_DIR", PRIVATE_DIR . "includes/");
    
    /**
     * The file path of the definitions directory.
     */
    define("DEFINITIONS_DIR", PRIVATE_DIR . "definitions/");
    
    /**
     * The file path of the controller directory.
     */
    define("CONTROLLER_DIR", PUBLIC_DIR . "controller/");
    
    /**
     * The file path of the image directory.
     */
    define("IMAGE_DIR", PRIVATE_DIR . "images/");
    
    /**
     * The file path of the icons directory.
     */
    define("ICONS_DIR", IMAGE_DIR . "icons/");
    
    /**
     * The file path of the model directory.
     */
    define("MODEL_DIR", PRIVATE_DIR . "model/");
    
    /**
     * The file path of the view directory.
     */
    define("VIEW_DIR", PRIVATE_DIR . "view/");
    
    /**
     * The file path of the code directory.
     */
    define("CODE_DIR", PRIVATE_DIR . "code/");
    
    //Base file paths.
    /**
     * The file path of the base model file.
     */
    define("MODEL_FILE", MODEL_DIR . "model.php");
    
    /**
     * The file path of the main CSS file.
     */
    define("MAINCSS_FILE", CSS_DIR . "main.css");
    
    /**
     * The file path of the navbar's CSS file.
     */
    define("NAVBARCSS_FILE", CSS_DIR . "navbar.css");
    
    /**
     * The file path of the validateion CSS file.
     */
    define("VALIDATIONCSS_FILE", CSS_DIR . "validation.css");
    
    /**
     * The file path of the site's icon image file.
     */
    define("ICON_FILE", ICONS_DIR . "icon.ico");
    
    /**
     * The file path of the sites logo image file.
     */
    define("LOGO_FILE", IMAGE_DIR . "logo.gif");
    
    /**
     * The file path of the control panel contentes file.
     */
    define("CONTROLPANEL_FILE", INCLUDES_DIR . "control-panel.php");
    
    /**
     * The file path of the default page template.
     */
    define("DEFAULTTEMPLATE_FILE", INCLUDES_DIR . "default-template.php");
    
    /**
     * The file path of the footer file.
     */
    define("FOOTER_FILE", INCLUDES_DIR . "footer.php");
    
    /**
     * The file path of the header file.
     */
    define("HEADER_FILE", INCLUDES_DIR . "header.php");
    
    /**
     * The file path of the message contents file.
     */
    define("MESSAGE_FILE", INCLUDES_DIR . "message.php");
    
    /**
     * The file path of the navbars content file.
     */
    define("NAVBAR_FILE", INCLUDES_DIR . "navbar.php");
    
    /**
     * The file path to the attributes javascript file.
     */
    define("ATTRIBUTES_FILE", JAVASCRIPT_DIR . "attributes.js");
    
    /**
     * The file path of the jquery javascript file.
     */
    define("JQUERY_FILE", JAVASCRIPT_DIR . "jquery-1.11.1-min.js");
    
    /**
     * The file path of the jquery table sorter javasctipt file.
     */
    define("JQUERYTABLESORTER_FILE", JAVASCRIPT_DIR . "jquery.tablesorter.js");
    
    /**
     * The file path of the jquery validation javascript file.
     */
    define("JQUERYVALIDATE_FILE", JAVASCRIPT_DIR . "jquery.validate.js");
    
    /**
     * The file path of the base javacript file.
     */
    define("MAINJS_FILE", JAVASCRIPT_DIR . "main.js");
    
    /**
     * The file path of the navbar's javascript file.
     */
    define("NAVBARJS_FILE", JAVASCRIPT_DIR . "navbar.js");
    
    /**
     * The file path of the dynamic collection javascript file.
     */
    define("DYNAMICCOLLECTIONJS_FILE", JAVASCRIPT_DIR . "dynamic-collection.js");
    
    /**
     * The file path of the actions file.
     */
    define("ACTIONS_FILE", DEFINITIONS_DIR . "actions.php");
    
    /**
     * The file path of the general functions file.
     */
    define("GENERALFUNCTIONS_FILE", CODE_DIR . "general-functions.php");
    
    /**
     * The file path of the paths file.
     */
    define("PATHS_FILE", DEFINITIONS_DIR . "paths.php");
    
    /**
     * The file path of the identifier file.
     */
    define("IDENTIFIER_FILE", DEFINITIONS_DIR . "identifiers.php");
    
    /**
     * The file path of the validitaion info class file.
     */
    define("VALIDATIONINFOCLASS_FILE", CODE_DIR . "validation-info-class.php");
    
    /**
     * The file path of the message form file.
     */
    define("MESSAGEFORM_FILE", VIEW_DIR . "message-form.php");
    
    /**
     * The file path of the not authorized form file.
     */
    define("NOTAUTHORIZED_FILE", VIEW_DIR . "not-authorized.php");
    
//Main paths.
/******************************************************************************/
    
    //Main directories.
    /**
     * The file path of the main directory.
     */
    define("MAIN_DIR", PRIVATE_DIR . "main/");
    
    /**
     * The file path of the main view directory.
     */
    define("MAINVIEW_DIR", MAIN_DIR . "view/");
    
    /**
     * The file path of the main model directory.
     */
    define("MAINMODEL_DIR", MAIN_DIR . "model/");
    
    //Main file paths.
    /**
     * The file path of the main controller file.
     */
    define("MAINCONTROLLER_FILE", CONTROLLER_DIR . "index.php");
    
    /**
     * The file path of the main model file.
     */
    define("MAINMODEL_FILE", MAINMODEL_DIR . "model.php");
    
    /**
     * The file path of the home file.
     */
    define("HOME_FILE", MAINVIEW_DIR . "home.php");
    
//Admin paths.
/******************************************************************************/
    
    //Admin directories.
    /**
     * The file path of the admin directory.
     */
    define("ADMIN_DIR", PRIVATE_DIR . "admin/");
    
    /**
     * The file path of the admin view directory.
     */
    define("ADMINVIEW_DIR", ADMIN_DIR . "view/");
    
    /**
     * The file path of the admin model directory.
     */
    define("ADMINMODEL_DIR", ADMIN_DIR . "model/");
    
    //Admin file paths.
    /**
     * The file path of the admin model file.
     */
    define("ADMINMODEL_FILE", ADMINMODEL_DIR . "model.php");
    
    /**
     * The file path of the admin controller file.
     */
    define("ADMINCONTROLLER_FILE", CONTROLLER_DIR . "admin.php");
    
    /**
     * The file path of the login form file.
     */
    define("LOGINFORM_FILE", ADMINVIEW_DIR . "login-form.php");
    
    /**
     * The file path of the add fucntion form file.
     */
    define("ADDFUNCTIONFORM_FILE", ADMINVIEW_DIR . "add-function-form.php");
    
    /**
     * The file path of the add role form file.
     */
    define("ADDROLEFORM_FILE", ADMINVIEW_DIR . "add-role-form.php");
    
    /**
     * The file path of the add user form file.
     */
    define("ADDUSERFORM_FILE", ADMINVIEW_DIR . "add-user-form.php");
    
    /**
     * The file path of the control panel form file.
     */
    define("CONTROLPANELFORM_FILE", ADMINVIEW_DIR . "control-panel-form.php");
    
    /**
     * The file path of the edit function form file.
     */
    define("EDITFUNCTIONFORM_FILE", ADMINVIEW_DIR . "edit-function-form.php");
    
    /**
     * The file path of the edit role form file.
     */
    define("EDITROLEFORM_FILE", ADMINVIEW_DIR . "edit-role-form.php");
    
    /**
     * The file path of the edit user form file.
     */
    define("EDITUSERFORM_FILE", ADMINVIEW_DIR . "edit-user-form.php");
    
    /**
     * The file path of the manage functions form file.
     */
    define("MANAGEFUNCTIONSFORM_FILE", ADMINVIEW_DIR . "manage-functions-form.php");
    
    /**
     * The file path of the manage roles form file.
     */
    define("MANAGEROLESFORM_FILE", ADMINVIEW_DIR . "manage-roles-form.php");
    
    /**
     * The file path of the manage users form file.
     */
    define("MANAGEUSERSFORM_FILE", ADMINVIEW_DIR . "manage-users-form.php");
    
    /**
     * The file path of the manage languages form file.
     */
    define("MANAGELANGUAGESFORM_FILE", ADMINVIEW_DIR . "manage-languages-form.php");
    
    /**
     * The path of the view user form file.
     */
    define("VIEWUSERFORM_FILE", ADMINVIEW_DIR . "view-user-form.php");
    
    /**
     * The path of the add/edit language form file.
     */
    define("ADDEDITLANGUAGEFORM_FILE", ADMINVIEW_DIR . "add-edit-language-form.php");
    
    /**
     * The file path of the view language form file.
     */
    define("VIEWLANGUAGEFORM_FILE", ADMINVIEW_DIR . "view-language-form.php");
    
    /**
     * The file path of the manage languages form file.
     */
    define("MANAGEQUESTIONSFORM_FILE", ADMINVIEW_DIR . "manage-questions-form.php");
    
    /**
     * The file path of the view question form file.
     */
    define("VIEWQUESTIONFORM_FILE", ADMINVIEW_DIR . "view-question-form.php");
    
    /**
     * The file path of the add/edit question form file.
     */
    define("ADDEDITQUESTIONFORM_FILE", ADMINVIEW_DIR . "add-edit-question-form.php");
?>
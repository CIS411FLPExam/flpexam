<?php
//ALL PATHS ARE RELATIVE TO ./flpexam/public/controller/

//Base paths
/******************************************************************************/

    //Base directories.
    define("PUBLIC_DIR", "../../public/");
    define("PRIVATE_DIR", "../../private/");
    define("CSS_DIR", PRIVATE_DIR . "css/");
    define("JAVASCRIPT_DIR", PRIVATE_DIR . "js/");
    define("INCLUDES_DIR", PRIVATE_DIR . "includes/");
    define("PHP_DIR", PRIVATE_DIR . "php/");
    define("CONTROLLER_DIR", PUBLIC_DIR . "controller/");
    define("IMAGE_DIR", PRIVATE_DIR . "images/");
    define("ICONS_DIR", IMAGE_DIR . "icons/");
    define("MODEL_DIR", PRIVATE_DIR . "model/");
    
    //Base file paths.
    define("MODEL_FILE", MODEL_DIR . "model.php");
    define("MAINCSS_FILE", CSS_DIR . "main.css");
    define("NAVBARCSS_FILE", CSS_DIR . "navbar.css");
    define("VALIDATIONCSS_FILE", CSS_DIR . "validation.css");
    define("ICON_FILE", ICONS_DIR . "icon.ico");
    define("LOGO_FILE", IMAGE_DIR . "logo.gif");
    define("CONTROLPANEL_FILE", INCLUDES_DIR . "control-panel.php");
    define("DEFAULTTEMPLATE_FILE", INCLUDES_DIR . "default-template.php");
    define("FOOTER_FILE", INCLUDES_DIR . "footer.php");
    define("HEADER_FILE", INCLUDES_DIR . "header.php");
    define("MESSAGEFORM_FILE", INCLUDES_DIR . "message-form.php");
    define("MESSAGE_FILE", INCLUDES_DIR . "message.php");
    define("NAVBAR_FILE", INCLUDES_DIR . "navbar.php");
    define("ATTRIBUTES_FILE", JAVASCRIPT_DIR . "attributes.js");
    define("JQUERY_FILE", JAVASCRIPT_DIR . "jquery-1.9.1.min.js");
    define("JQUERYTABLESORTER_FILE", JAVASCRIPT_DIR . "jquery.tablesorter.js");
    define("JQUERYVALIDATE_FILE", JAVASCRIPT_DIR . "jquery.validate.js");
    define("MAINJS_FILE", JAVASCRIPT_DIR . "main.js");
    define("NAVBARJS_FILE", JAVASCRIPT_DIR . "navabar.js");
    define("ACTIONS_FILE", PHP_DIR . "actions.php");
    define("GENERALFUNCTIONS_FILE", PHP_DIR . "general-functions.php");
    define("PATHS_FILE", PHP_DIR . "paths.php");
    define("IDENTIFIER_FILE", PHP_DIR . "identifiers.php");

//Main paths.
/******************************************************************************/
    
    //Main directories.
    define("MAIN_DIR", PRIVATE_DIR . "main/");
    define("MAINVIEW_DIR", MAIN_DIR . "view/");
    define("MAINMODEL_DIR", MAIN_DIR . "model/");
    
    //Main file paths.
    define("MAINCONTROLLER_FILE", CONTROLLER_DIR . "index.php");
    define("MAINMODEL_FILE", MAINMODEL_DIR . "model.php");
    define("HOME_FILE", MAINVIEW_DIR . "home.php");
    define("LOGINFORM_FILE", MAINVIEW_DIR . "login-form.php");
    define("ADDEDITSELFFORM_FILE", MAINVIEW_DIR . "add-edit-self.php");
    
//Admin paths.
/******************************************************************************/
    
    //Admin directories.
    define("ADMIN_DIR", PRIVATE_DIR . "admin/");
    define("ADMINVIEW_DIR", ADMIN_DIR . "view/");
    define("ADMINMODEL_DIR", ADMIN_DIR . "model/");
    
    //Admin file pahts.
    define("ADMINMODEL_FILE", ADMINMODEL_DIR . "model.php");
    define("ADMINCONTROLLER_FILE", CONTROLLER_DIR . "admin.php");
    define("ADDFUNCTIONFORM_FILE", ADMINVIEW_DIR . "add-function-form.php");
    define("ADDROLEFORM_FILE", ADMINVIEW_DIR . "add-role-form.php");
    define("ADDUSERFORM_FILE", ADMINVIEW_DIR . "add-user-form.php");
    define("CONTROLPANELFORM_FILE", ADMINVIEW_DIR . "control-panel-form.php");
    define("EDITFUNCTIONFORM_FILE", ADMINVIEW_DIR . "edit-function-form.php");
    define("EDITROLEFORM_FILE", ADMINVIEW_DIR . "edit-role-form.php");
    define("EDITUSERFORM_FILE", ADMINVIEW_DIR . "edit-user-form.php");
    define("MANAGEFUNCTIONSFORM_FILE", ADMINVIEW_DIR . "manage-functions-form.php");
    define("MANAGEROLESFORM_FILE", ADMINVIEW_DIR . "manage-roles-form.php");
    define("MANAGEUSERSFORM_FILE", ADMINVIEW_DIR . "manage-users-form.php");
    define("NOTAUTHORIZED_FILE", ADMINVIEW_DIR . "not-authorized.php");
?>
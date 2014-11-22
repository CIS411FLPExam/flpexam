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
     * The file path of the main controller directory.
     */
    define("MAINCONTROLLER_DIR", PUBLIC_DIR . "main/");
    
    /**
     * The file path of the exam controller directory.
     */
    define("EXAMCONTROLLER_DIR", PUBLIC_DIR . "exam/");
    
    /**
     * The file path of the admin controller directory.
     */
    define("ADMINCONTROLLER_DIR", PUBLIC_DIR . "admin/");
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
    
    /**
     * The file path of the PHPExcel code directory.
     */
    define("PHPEXCELCODE_DIR", CODE_DIR . "PHPExcel/Classes/");
    
    /**
     * The file path of the PHPExcel classes code directory.
     */
    define("PHPEXCELCLASSESCODE_DIR", PHPEXCELCODE_DIR . "PHPExcel/");
    
    /**
     * The file path of the temporary files directory.
     */
    define("TEMP_DIR", PRIVATE_DIR . "temp/");
    
    /**
     * The file path of the error log directory.
     */
    define("ERRORLOG_DIR", PRIVATE_DIR . "log/");
    
    //Base file paths.
    /**
     * The file path of the PHPExcell class file.
     */
    define("PHPEXCELCLASS_FILE", PHPEXCELCODE_DIR . "PHPExcel.php");
    
    /**
     * The file path of the PHPExcell IOFactory class file.
     */
    define("PHPEXCELIOFACTORYCLASS_FILE", PHPEXCELCLASSESCODE_DIR . "IOFactory.php");
    
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
    define("LOGO_FILE", IMAGE_DIR . "logo1.gif");
    
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
     * The file path of the plain footer file.
     */
    define("PLAINFOOTER_FILE", INCLUDES_DIR . "plain-footer.php");
    
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
    
    /**
     * The file path of the exam parameters class file.
     */
    define("EXAMPARAMETERSCLASS_FILE", CODE_DIR . "examparameters-class.php");
    
    /**
     * The file path of the exam class file.
     */
    define("EXAMCLASS_FILE", CODE_DIR . "exam-class.php");
    
    /**
     * The file path of the language class file.
     */
    define("LANGUAGECLASS_FILE", CODE_DIR . "language-class.php");
    
    /**
     * The file path of the profile class file.
     */
    define("PROFILECLASS_FILE", CODE_DIR . "profile-class.php");
    
    /**
     * The file path of the test info class file.
     */
    define("TESTINFOCLASS_FILE", CODE_DIR . "testinfo-class.php");
    
    /**
     * The file path of the detailed test info class file.
     */
    define("DETAILEDTESTINFOCLASS_FILE", CODE_DIR . "detailedtestinfo-class.php");
    
    /**
     * The file path of the question answer class file.
     */
    define("QUESTIONANSWERCLASS_FILE", CODE_DIR . "questionanswer-class.php");
    
    /**
     * The file path of the contact class file.
     */
    define("CONTACTCLASS_FILE", CODE_DIR . "contact-class.php");
    
    /**
     * The file path of the level info class file.
     */
    define("LEVELINFOCLASS_FILE", CODE_DIR . "levelinfo-class.php");
    
    /**
     * The file path of the language experience class file.
     */
    define("LANGUAGEEXPERIENCECLASS_FILE", CODE_DIR . "languageexperience-class.php");
    
    /**
     * The file path of the question comment class file.
     */
    define("QUESTIONCOMMENTCLASS_FILE", CODE_DIR . "questioncomment-class.php");
    
    /**
     * The file path of the experience option class file.
     */
    define("EXPERIENCEOPTIONCLASS_FILE", CODE_DIR . "experienceoption-class.php");
    
    /**
     * The file path of the leo pair class file.
     */
    define("LEOPAIRCLASS_FILE", CODE_DIR . "leopair-class.php");
    
    /**
     * The file path of the error log file.
     */
    define("ERRORLOG_FILE", ERRORLOG_DIR . 'log.txt');
    
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
    define("MAINCONTROLLER_FILE", MAINCONTROLLER_DIR . "index.php");
    
    /**
     * The file path of the main model file.
     */
    define("MAINMODEL_FILE", MAINMODEL_DIR . "model.php");
    
    /**
     * The file path of the about file.
     */
    define("ABOUT_FILE", MAINVIEW_DIR . "about-form.php");
    
    /**
     * The file path of the contact file.
     */
    define("CONTACT_FILE", MAINVIEW_DIR . "contact-form.php");
    
    /**
     * The file path of the home file.
     */
    define("HOME_FILE", MAINVIEW_DIR . "home-form.php");
    
    
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
    define("ADMINCONTROLLER_FILE", ADMINCONTROLLER_DIR . "index.php");
    
    /**
     * The file path of the login form file.
     */
    define("LOGINFORM_FILE", ADMINVIEW_DIR . "login-form.php");
    
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
     * The file path of the edit role form file.
     */
    define("EDITROLEFORM_FILE", ADMINVIEW_DIR . "edit-role-form.php");
    
    /**
     * The file path of the edit user form file.
     */
    define("EDITUSERFORM_FILE", ADMINVIEW_DIR . "edit-user-form.php");
    
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
    
    /**
     * The file path of the edit exam parameters form file.
     */
    define("EDITEXAMPARAMETERSFORM_FILE", ADMINVIEW_DIR . "edit-examparameters-form.php");
    
    /**
     * The file path of the view exam parameters form file.
     */
    define("VIEWEXAMPARAMETERSFORM_FILE", ADMINVIEW_DIR . "view-examparameters-form.php");
    
    /**
     * The file path of the manage test entries form file.
     */
    define("MANAGETESTENTRIESFORM_FILE", ADMINVIEW_DIR . "manage-testentries-form.php");
    
    /**
     * The file path of the view test entry form file.
     */
    define("VIEWTESTENTRYFORM_FILE", ADMINVIEW_DIR . "view-testentry-form.php");
    
    /**
     * The file path of the view test form file.
     */
    define("VIEWTESTFORM_FILE", ADMINVIEW_DIR . "view-test-form.php");
    
    /**
     * The file path of the manage contacts form file.
     */
    define("MANAGECONTACTSFORM_FILE", ADMINVIEW_DIR . "manage-contacts-form.php");
    
    /**
     * The file path of the add/edit contact form file.
     */
    define("ADDEDITCONTACTFORM_FILE", ADMINVIEW_DIR . "add-edit-contact-form.php");
    
    /**
     * The file path of the file to use to import languages via Excel sheets.
     */
    define("PROCESSLANGUAGEIMPORTEXCEL_FILE", ADMINVIEW_DIR . "process-languageimportexcel.php");
    
    /**
     * The file path of the file to use to import languages via Word documents.
     */
    define("PROCESSLANGUAGEIMPORTWORD_FILE", ADMINVIEW_DIR . "process-languageimportword.php");
    
    /**
     * The file path of the add/edit level info form file.
     */
    define("ADDEDITLEVELINFOFORM_FILE", ADMINVIEW_DIR . "add-edit-levelinfo-form.php");
    
    /**
     * The file path of the view level info form file.
     */
    define("VIEWLEVELINFOFORM_FILE", ADMINVIEW_DIR . "view-levelinfo-form.php");
    
    /**
     * The file path of the manage level infos form file.
     */
    define("MANAGELEVELINFOSFORM_FILE", ADMINVIEW_DIR . "manage-levelinfos-form.php");
    
    /**
     * The file path of the edit language experiences form file.
     */
    define("ADDEDITLANGUAGEEXPERIENCESFORM_FILE", ADMINVIEW_DIR . "add-edit-languageexperiences-form.php");
    
    /**
     * The file path of the view language experiences form file.
     */
    define("VIEWLANGUAGEEXPERIENCESFORM_FILE", ADMINVIEW_DIR . "view-languageexperiences-form.php");
    
    /**
     * The file path of the manage language experiences form file.
     */
    define("MANAGELANGUAGEEXPERIENCESFORM_FILE", ADMINVIEW_DIR . "manage-languageexperiences-form.php");
    
    /**
     * The file path of the view question comments form file.
     */
    define("VIEWQUESTIONCOMMENTSFORM_FILE", ADMINVIEW_DIR . "view-questioncomments-form.php");
    
    /**
     * The file path of the add/edit experience option form file.
     */
    define("ADDEDITEXPERIENCEOPTIONFORM_FILE", ADMINVIEW_DIR . "add-edit-experienceoption-form.php");
    
    /**
     * The file path of the view experience option form file.
     */
    define("VIEWEXPERIENCEOPTIONFORM_FILE", ADMINVIEW_DIR . "view-experienceoption-form.php");
    
    /**
     * The file path of the manage experience options form file.
     */
    define("MANAGEEXPERIENCEOPTIONSFORM_FILE", ADMINVIEW_DIR . "manage-experienceoptions-form.php");
    
//Exam paths.
/******************************************************************************/
    
    /**
     * The file path of the exam directory.
     */
    define("EXAM_DIR", PRIVATE_DIR . "exam/");
    
    /**
     * The file path of the exam view directory.
     */
    define("EXAMVIEW_DIR", EXAM_DIR . "view/");
    
    /**
     * The file path of the exam model directory.
     */
    define("EXAMMODEL_DIR", EXAM_DIR . "model/");
    
    /**
     * The file path of the exam controller file.
     */
    define("EXAMCONTROLLER_FILE", EXAMCONTROLLER_DIR . "index.php");
    
    /**
     * The file path of the exam model file.
     */
    define("EXAMMODEL_FILE", EXAMMODEL_DIR . "model.php");
    
    /**
     * The file path of the key code form file.
     */
    define("KEYCODEFORM_FILE", EXAMVIEW_DIR . "keycode-form.php");
    
    /**
     * The file path of the language select form file.
     */
    define("SELECTLANGUAGEFORM_FILE", EXAMVIEW_DIR . "select-language-form.php");
    
    /**
     * The file path of the create profile form file.
     */
    define("CREATEPROFILEFORM_FILE", EXAMVIEW_DIR . "create-profile-form.php");
    
    /**
     * The file path of the view test quetsion form file.
     */
    define("TESTQUESTIONVIEWFORM_FILE", EXAMVIEW_DIR . "testquestion-view-form.php");
    
    /**
     * The file path of the vew test results form file.
     */
    define("VIEWTESTRESULTSFORM_FILE", EXAMVIEW_DIR . "view-testresults-form.php");
?>
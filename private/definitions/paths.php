<?php
//ALL PATHS ARE RELATIVE TO ./flpexam/public/controller/

//Base paths
/******************************************************************************/

    //Base directories.
    /**
     * Gets the file path of the public directory.
     * @return string The directory.
     */
    function GetPublicDir()
    {
        return "../../public/";
    }
    
    /**
     * Gets the file path of the private directory.
     * @return string The directory.
     */
    function GetPrivateDir()
    {
        return "../../private/";
    }
    
    /**
     * Gets the file path of the css directory.
     * @return string The directory.
     */
    function GetCssDir()
    {
        return GetPrivateDir() . "css/";
    }
    
    /**
     * Gets the file path of the javascript directory.
     * @return string The directory.
     */
    function GetJavascriptDir()
    {
        return GetPrivateDir() . "js/";
    }
    
    /**
     * Gets the file path of the includes directory.
     * @return string The directory.
     */
    function GetIncludesDir()
    {
        return GetPrivateDir() . "includes/";
    }
    
    /**
     * Gets the file path of the definitions directory.
     * @return string the Directory.
     */
    function GetDefinitionsDir()
    {
        return GetPrivateDir() . "definitions/";
    }
    
    /**
     * Gets the file path of the main controller directory.
     * @return string The file path.
     */
    function GetMainControllerDir()
    {
        return GetPublicDir() . "main/";
    }
    
    /**
     * Gets the file path of the exam controller directory.
     * @return string The directory.
     */
    function GetExamControllerDir()
    {
        return GetPublicDir() . "exam/";
    }
    
    /**
     * Gets the file path of the admin controller directory.
     * @return string The directory.
     */
    function GetAdminControllerDir()
    {
        return GetPublicDir() . "admin/";
    }
    
    /**
     * The file path of the image directory.
     * @return string The directory.
     */
    function GetImageDir()
    {
        return GetPrivateDir() . "images/";
    }
    
    /**
     * Gets the file path of the icons directory.
     * @return string The directory.
     */
    function GetIconsDir()
    {
        return GetImageDir() . "icons/";
    }
    
    /**
     * Gets the file path of the model directory.
     * @return string The directory.
     */
    function GetModelDir()
    {
        return GetPrivateDir() . "model/";
    }
    
    /**
     * Gets the file path of the view directory.
     * @return string The directory.
     */
    function GetViewDir()
    {
        return GetPrivateDir() . "view/";
    }
    
    /**
     * Gets the file path of the code directory.
     * @return string The directory.
     */
    function GetCodeDir()
    {
        return GetPrivateDir() . "code/";
    }
    
    /**
     * Gets the file path of the PHPExcel code directory.
     * @return string The directory.
     */
    function GetPHPExcelCodeDir()
    {
        return GetCodeDir() . "PHPExcel/Classes/";
    }
    
    /**
     * Gets the file path of the PHPExcel classes code directory.
     * @return string The directory.
     */
    function GetPHPExcelClassesCodeDir()
    {
        return GetPHPExcelCodeDir() . "PHPExcel/";
    }
    
    /**
     * Gets the file path of the temp directory.
     * @return string The directory.
     */
    function GetTempDir()
    {
        return GetPrivateDir() . "temp/";
    }
    
    /**
     * Gets the file path of the error log directory.
     * @return string The directory.
     */
    function GetErrorLogDir()
    {
        return GetPrivateDir() . "log/";
    }
    
    //Base file paths.
    /**
     * Gets the file path of the PHPExcel class file.
     * @return string The file path.
     */
    function GetPHPExcelClassFile()
    {
        return GetPHPExcelCodeDir() . "PHPExcel.php";
    }
    
    /**
     * Gets the file path of the PHPExcel IOFactory class file.
     * @return string The file path.
     */
    function GetPHPExcelIOFactoryClassFile()
    {
        return GetPHPExcelClassesCodeDir() . "IOFactory.php";
    }
    
    /**
     * Gets the file path of the base model file.
     * @return string The file path.
     */
    function GetModelFile()
    {
        return GetModelDir() . "model.php";
    }
    
    /**
     * Gets the file path of the main CSS file.
     * @return string The file path.
     */
    function GetMainCssFile()
    {
        return GetCssDir() . "main.css";
    }
    
    /**
     * Gets the file path of the navbar CSS file.
     * @return string The file path.
     */
    function GetNavbarCssFile()
    {
        return GetCssDir() . "navbar.css";
    }
    
    /**
     * Gets the file path of the validation CSS file.
     * @return string The file path.
     */
    function GetValidationCssFile()
    {
        return GetCssDir() . "validation.css";
    }
    
    /**
     * Gets the file path of the icon file.
     * @return string The file path.
     */
    function GetIconFile()
    {
        return GetIconsDir() . "icon.ico";
    }
    
    /**
     * Gets the file path of the logo file.
     * @return string The file path.
     */
    function GetLogoFile()
    {
        return GetImageDir() . "logo1.gif";
    }
    
    /**
     * The file path of the control panel content file.
     * @return string The file path.
     */
    function GetControlPanelFile()
    {
        return GetIncludesDir() . "control-panel.php";
    }
    
    /**
     * Gets the file path of the default template file.
     * @return string The file path.
     */
    function GetDefaultTemplateFile()
    {
        return GetIncludesDir() . "default-template.php";
    }
    
    /**
     * Gets the file path of the footer file.
     * @return string The file path.
     */
    function GetFooterFile()
    {
        return GetIncludesDir() . "footer.php";
    }
    
    /**
     * Gets the file path of the plain footer file.
     * @return string The file path.
     */
    function GetPlainFooterFile()
    {
        return GetIncludesDir() . "plain-footer.php";
    }
    
    /**
     * Gets the file path of the header file.
     * @return string The file path.
     */
    function GetHeaderFile()
    {
        return GetIncludesDir() . "header.php";
    }
    
    /**
     * Gets the file path of the message content file.
     * @return string The file path.
     */
    function GetMessageFile()
    {
        return GetIncludesDir() . "message.php";
    }
    
    /**
     * Gets the file path of the navbar content file.
     * @return string The file path.
     */
    function GetNavbarFile()
    {
        return GetIncludesDir() . "navbar.php";
    }
    
    /**
     * Gets the file path of the attributes file.
     * @return string The file path.
     */
    function GetAttributesFile()
    {
        return GetJavascriptDir() . "attributes.js";
    }
    
    /**
     * Gets the file path of the JQuery file.
     * @return string The file path.
     */
    function GetJQueryFile()
    {
        return GetJavascriptDir() . "jquery-1.11.1-min.js";
    }
    
    /**
     * Gets the file path of the JQuery table sorter file.
     * @return string The file path.
     */
    function GetJQueryTableSorterFile()
    {
        return GetJavascriptDir() . "jquery.tablesorter.js";
    }
    
    /**
     * Gets the file path of the JQuery validate file.
     * @return string The file path.
     */
    function GetJQueryValidateFile()
    {
        return GetJavascriptDir() . "jquery.validate.js";
    }
    
    /**
     * Gets the main javascript file.
     * @return string The file path.
     */
    function GetMainJSFile()
    {
        return GetJavascriptDir() . "main.js";
    }
    
    /**
     * Gets the file path of the navbar javascript file.
     * @return string The file path.
     */
    function GetNavbarJSFile()
    {
        return GetJavascriptDir() . "navbar.js";
    }
    
    /**
     * Gets the file path of the dynamic collection file.
     * @return string The file path.
     */
    function GetDynamicCollectionsJSFile()
    {
        return GetJavascriptDir() . "dynamic-collection.js";
    }
    
    /**
     * Gets the file path of the actions file.
     * @return string The file path.
     */
    function GetActionsFile()
    {
        return GetDefinitionsDir() . "actions.php";
    }
    
    /**
     * Gets the file path of the general functions file.
     * @return string The file path.
     */
    function GetGeneralFunctionsFile()
    {
        return GetCodeDir() . "general-functions.php";
    }
    
    /**
     * Gets the file path of the paths file.
     * @return string The file path.
     */
    function GetPathsFile()
    {
        return GetDefinitionsDir() . "paths.php";
    }
    
    /**
     * Gets the file path of the identifier file.
     * @return string The file path.
     */
    function GetIdentifierFile()
    {
        return GetDefinitionsDir() . "identifiers.php";
    }
    
    /**
     * Gets the file path of the validation info class file.
     * @return string The file path.
     */
    function GetValidationInfoClassFile()
    {
        return GetCodeDir() . "validation-info-class.php";
    }
    
    /**
     * Gets the file path of the messag form file.
     * @return string The file path.
     */
    function GetMessageFormFile()
    {
        return GetViewDir() . "message-form.php";
    }
    
    /**
     * Gets the file path of the not authorized file.
     * @return string The file path.
     */
    function GetNotAuthorizedFile()
    {
        return GetViewDir() . "not-authorized.php";
    }
    
    /**
     * Gets the file path of the exam parameters class file.
     * @return string The file path.
     */
    function GetExamParametersClassFile()
    {
        return GetCodeDir() . "examparameters-class.php";
    }
    
    /**
     * Gets the file path of the exam class file.
     * @return string The file path.
     */
    function GetExamClassFile()
    {
        return GetCodeDir() . "exam-class.php";
    }
    
    /**
     * Gets the file path of the language class file.
     * @return string The file path.
     */
    function GetLanguageClassFile()
    {
        return GetCodeDir() . "language-class.php";
    }
    
    /**
     * Gets the file path of the profile class file.
     * @return string The file path.
     */
    function GetProfileClassFile()
    {
        return GetCodeDir() . "profile-class.php";
    }
    
    /**
     * Gets the file path of the test info class file.
     * @return string The file path.
     */
    function GetTestInfoClassFile()
    {
        return GetCodeDir() . "testinfo-class.php";
    }
    
    /**
     * Gets the file path of the detailed test info class file.
     * @return string The file path.
     */
    function GetDetailTestInfoClassFile()
    {
        return GetCodeDir() . "detailedtestinfo-class.php";
    }
    
    /**
     * Gets the file path of the question answer class file.
     * @return string The file path.
     */
    function GetQuestionAnswerClassFile()
    {
        return GetCodeDir() . "questionanswer-class.php";
    }
    
    /**
     * Gets the file path of the contact class file.
     * @return string The file path.
     */
    function GetContactClassFile()
    {
        return GetCodeDir() . "contact-class.php";
    }
    
    /**
     * Gets the file path of the level info class file.
     * @return string The file path.
     */
    function GetLevelInfoClassFile()
    {
        return GetCodeDir() . "levelinfo-class.php";
    }
    
    /**
     * Gets the file path of the language experience class file.
     * @return string The file path.
     */
    function GetLanguageExperiencesClassFile()
    {
        return GetCodeDir() . "languageexperience-class.php";
    }
    
    /**
     * The file path of the question comment class file.
     * @return string The file path.
     */
    function GetQuestionCommentClassFile()
    {
        return GetCodeDir() . "questioncomment-class.php";
    }
    
    /**
     * Gets the file path of the experience option class file.
     * @return string The file path.
     */
    function GetExperienceOptionClassFile()
    {
        return GetCodeDir() . "experienceoption-class.php";
    }
    
    /**
     * Gets the file path of the leo pair class file.
     * @return string The file path.
     */
    function GetLeoPairClassFile()
    {
        return GetCodeDir() . "leopair-class.php";
    }
    
    /**
     * Gets the file path of the error log file.
     * @return string The file path.
     */
    function GetErrorLogFile()
    {
        return GetErrorLogDir() . "log.txt";
    }
    
//Main paths.
/******************************************************************************/
    
    /**
     * Gets the file path of the main directory.
     * @return string The file path.
     */
    function GetMainDir()
    {
        return GetPrivateDir() . "main/";
    }
    
    /**
     * Gets the file path of the main view directory.
     * @return string The file path.
     */
    function GetMainViewDir()
    {
        return GetMainDir() . "view/";
    }
    
    /**
     * Gets the file path of the main model directory.
     * @return string The file path.
     */
    function GetMainModelDir()
    {
        return GetMainDir() . "model/";
    }
    
    /**
     * Gets the file path of the main controller file.
     * @return string The file path.
     */
    function GetMainControllerFile()
    {
        return GetMainControllerDir() . "index.php";
    }
    
    /**
     * Gets the file path of the main model file.
     * @return The file path.
     */
    function GetMainModelFile()
    {
        return GetMainModelDir() . "model.php";
    }
    
    /**
     * Gets the file path of the about form file.
     * @return string The file path.
     */
    function GetAboutFormFile()
    {
        return GetMainViewDir() . "about-form.php";
    }
    
    /**
     * Gets the file path of the contact form file.
     * @return string The file path.
     */
    function GetContactFormFile()
    {
        return GetMainViewDir() . "contact-form.php";
    }
    
    /**
     * The file path of the home form file.
     * @return string The file path.
     */
    function GetHomeFormFile()
    {
        return GetMainViewDir() . "home-form.php";
    }
    
    
//Admin paths.
/******************************************************************************/
    
    //Admin directories.
    /**
     * Gets the file path of the admin directory.
     * @return string The file path.
     */
    function GetAdminDir()
    {
        return GetPrivateDir() . "admin/";
    }
    
    /**
     * Gets the file path of the admin view directory.
     * @return string The file path.
     */
    function GetAdminViewDir()
    {
        return GetAdminDir() . "view/";
    }
    
    /**
     * Gets the file path of the admin model directory.
     * @return string The file path.
     */
    function GetAdminModelDir()
    {
        return GetAdminDir() . "model/";
    }
    
    //Admin file paths.
    /**
     * Gets the file path of the amdin model file.
     * @return string The file path.
     */
    function GetAdminModelFile()
    {
        return  GetAdminModelDir() . "model.php";
    }
    
    /**
     * Gets the file path of the admin controller file.
     * @return string The file path.
     */
    function GetAdminControllerFile()
    {
        return GetAdminControllerDir() . "index.php";
    }
    
    /**
     * Gets the file path of the login form file.
     * @return string The file path.
     */
    function GetLoginFormFile()
    {
        return GetAdminViewDir() . "login-form.php";
    }
    
    /**
     * Gets the file path of the add role form file.
     * @return string The file path.
     */
    function GetAddRoleFormFile()
    {
        return GetAdminViewDir() . "add-role-form.php";
    }
    
    /**
     * Gets the file path of the add user form file.
     * @return string The file path.
     */
    function GetAddUserFormFile()
    {
        return GetAdminViewDir() . "add-user-form.php";
    }
    
    /**
     * Gets the file path of the control panel form file.
     * @return string The file path.
     */
    function GetControlPanelFormFile()
    {
        return GetAdminViewDir() . "control-panel-form.php";
    }
    
    /**
     * Gets the file path of the edit role form.
     * @return string The file path.
     */
    function GetEditRoleFormFile()
    {
        return GetAdminViewDir() . "edit-role-form.php";
    }
    
    /**
     * Gets the file path of the edit user form file.
     * @return string The file path.
     */
    function GetEditUserFormFile()
    {
        return GetAdminViewDir() . "edit-user-form.php";
    }
    
    /**
     * Gets the file path of the manage roles form file.
     * @return string The file path.
     */
    function GetMangageRolesFormFile()
    {
        return GetAdminViewDir() . "manage-roles-form.php";
    }
    
    /**
     * Gets the file path of the manage users form file.
     * @return string The file path.
     */
    function GetManageUsersFormFile()
    {
        return GetAdminViewDir() . "manage-users-form.php";
    }
    
    /**
     * Gets the file path of the manage languages form file.
     * @return string The file path.
     */
    function GetManageLanguagesFormFile()
    {
        return GetAdminViewDir() . "manage-languages-form.php";
    }
    
    /**
     * Gets the file path of the view user form file.
     * @return string The file path.
     */
    function GetViewUserFormFile()
    {
        return GetAdminViewDir() . "view-user-form.php";
    }
    
    /**
     * Gets the file path of the add/edit langauge form file.
     * @return string The file path.
     */
    function GetAddEditLangaugeFormFile()
    {
        return GetAdminViewDir() . "add-edit-language-form.php";
    }
    
    /**
     * The file path of the view langauge form file.
     * @return string The file path.
     */
    function GetViewLanguageFormFile()
    {
        return GetAdminViewDir() . "view-language-form.php";
    }
    
    /**
     * Gets the file path of the manage languages form file.
     * @return string The file path.
     */
    function GetMangageQuestionsFormFile()
    {
        return GetAdminViewDir() . "manage-questions-form.php";
    }
   
    /**
     * Gets the file path of the view question form file.
     * @return string The file path.
     */
    function GetViewQuestionFormFile()
    {
        return GetAdminViewDir() . "view-question-form.php";
    }
    
    /**
     * Gets the file path of the add/edit question form file.
     * @return string The file path.
     */
    function GetAddEditQuestionFormFile()
    {
        return GetAdminViewDir() . "add-edit-question-form.php";
    }
    
    /**
     * Gets the file path of the edit exam parameters form file.
     * @return string The file path.
     */
    function GetEditExamParametersFormFile()
    {
        return GetAdminViewDir() . "edit-examparameters-form.php";
    }
    
    /**
     * Gets the file path of the view exam parameters form file.
     * @return string The file path.
     */
    function GetViewExamParametersFormFile()
    {
        return GetAdminViewDir() . "view-examparameters-form.php";
    }
    
    /**
     * Gets the file path of the manage test entries form file.
     * @return string The file path.
     */
    function GetManageTestentriesFormFile()
    {
        return GetAdminViewDir() . "manage-testentries-form.php";
    }
    
    /**
     * Gets the file path of the view test entry form file.
     * @return string The file path.
     */
    function GetViewTestEntryFormFile()
    {
        return GetAdminViewDir() . "view-testentry-form.php";
    }
    
    /**
     * Gets the file path of the view test form file.
     * @return string The file path.
     */
    function GetViewTestFormFile()
    {
        return GetAdminViewDir() . "view-test-form.php";
    }
    
    /**
     * Gets the file path of the manage contacts form file.
     * @return string The file path.
     */
    function GetManageContactsFormFile()
    {
        return GetAdminViewDir() . "manage-contacts-form.php";
    }
    
    /**
     * Gets the file path of the add/edit contact form file.
     * @return string The file path.
     */
    function GetAddEditContactFormFile()
    {
        return GetAdminViewDir() . "add-edit-contact-form.php";
    }
    
    /**
     * Gets the file path of the process language import excel file.
     * @return string The file path.
     */
    function GetProcessLanguageImportExcelFile()
    {
        return GetAdminViewDir() . "process-languageimportexcel.php";
    }
    
    /**
     * Gets the file path of the process language import word file.
     * @return string The file path.
     */
    function GetProcessLanguageImportWordFile()
    {
        return GetAdminViewDir() . "process-languageimportword.php";
    }
    
    /**
     * Gets the file path of the add/edit level info form file.
     * @return string The file path.
     */
    function GetAddEditLevelInfoFormFile()
    {
        return GetAdminViewDir() . "add-edit-levelinfo-form.php";
    }
    
    /**
     * Gets the file path of the view level info form file.
     * @return string The file path.
     */
    function GetViewLevelInfoFormFile()
    {
        return GetAdminViewDir() . "view-levelinfo-form.php";
    }
    
    /**
     * Gets the file path of the manage level infos form file.
     * @return string The file path.
     */
    function GetManageLevelInfosFormFile()
    {
        return GetAdminViewDir() . "manage-levelinfos-form.php";
    }
    
    /**
     * Gets the file path of the add/edit langauge experiences form file.
     * @return string The file path.
     */
    function GetAddEditLanguageExperienceFormFile()
    {
        return GetAdminViewDir() . "add-edit-languageexperiences-form.php";
    }
    
    /**
     * Gets the file path of the view language experiences form file.
     * @return string The file path.
     */
    function GetViewLanguageExperienceFormFile()
    {
        return GetAdminViewDir() . "view-languageexperiences-form.php";
    }
    
    /**
     * Gets the file path of the manage language experiences form file.
     * @return string The file path.
     */
    function GetManageLanguageExperiencesFormFile()
    {
        return GetAdminViewDir() . "manage-languageexperiences-form.php";
    }
    
    /**
     * Gets the file path of the view question comments form file.
     * @return string The file path.
     */
    function GetViewQuestionCommentsFormFile()
    {
        return GetAdminViewDir() . "view-questioncomments-form.php";
    }
    
    /**
     * Gets the file path o fthe add/edit experience option form file.
     * @return string The file path.
     */
    function GetAddEditExperienceOptionFormFile()
    {
        return GetAdminViewDir() . "add-edit-experienceoption-form.php";
    }
    
    /**
     * Gets the file path of the view experience option form file.
     * @return string The file path.
     */
    function GetViewExperienceOptionFormFile()
    {
        return GetAdminViewDir() . "view-experienceoption-form.php";
    }
    
    /**
     * Gets the file path of the manage experience options form file.
     * @return string The file path.
     */
    function GetManageExperienceOptionsFormFile()
    {
        return GetAdminViewDir() . "manage-experienceoptions-form.php";
    }
    
//Exam paths.
/******************************************************************************/
    
    /**
     * The file path of the exam directory.
     * @return string The file path.
     */
    function GetExamDir()
    {
        return GetPrivateDir() . "exam/";
    }
    
    /**
     * Gets the file path of th exam view directory.
     * @return string The file path.
     */
    function GetExamViewDir()
    {
        return GetExamDir() . "view/";
    }
    
    /**
     * Gets the file path of the exam model directory.
     * @return string The file path.
     */
    function GetExamModelDir()
    {
        return GetExamDir() . "model/";
    }
    
    /**
     * Gets the file path of the exam controller file.
     * @return string The file path.
     */
    function GetExamControllerFile()
    {
        return GetExamControllerDir() . "index.php";
    }
    
    /**
     * Gets the file path of the exam model file.
     * @return string The file path.
     */
    function GetExamModelFile()
    {
        return GetExamModelDir() . "model.php";
    }
    
    /**
     * Gets the file path of the key code form file.
     * @return string The file path.
     */
    function GetKeyCodeFormFile()
    {
        return GetExamViewDir() . "keycode-form.php";
    }
    
    /**
     * Gets the file path of the language select form file.
     * @return string The file path.
     */
    function GetSelectLanguageFormFile()
    {
        return GetExamViewDir() . "select-language-form.php";
    }
    
    /**
     * Gets the file path of the create profile form file.
     * @return string The file path.
     */
    function GetCreateProfileFormFile()
    {
        return GetExamViewDir() . "create-profile-form.php";
    }
    
    /**
     * Gets the file path of the view test question form file.
     * @return string The file path.
     */
    function GetTestQuestionViewFormFile()
    {
        return GetExamViewDir() . "testquestion-view-form.php";
    }
    
    /**
     * Gets the file path of the view test results form file.
     * @return string The file path.
     */
    function GetViewTestResultsFormFile()
    {
        return GetExamViewDir() . "view-testresults-form.php";
    }
?>
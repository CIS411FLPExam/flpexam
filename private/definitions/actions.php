<?php
    /**
     * The action key word for all actions.
     */
    define("ACTION_KEYWORD", "action");
    
//Actions available through the main controller.
/******************************************************************************/

    /**
     * The action word to get to the home page.
     */
    define("HOME_ACTION", "Home");
    
    /**
     * The action word to use to login.
     */
    define("LOGIN_ACTION", "Login");
    
    /**
     * The action word to use to logout.
     */
    define("LOGOUT_ACTION", "LogOut");
    
    /**
     * The action word to use to process a login.
     */
    define("PROCESSLOGIN_ACTION", "ProcessLogin");
    
    /**
     * The key word to use to add a new user account.
     */
    define("SELFADD_ACTION", "SelfAdd");
    
    /**
     * The action word to use to edit a user account.
     */
    define("SELFEDIT_ACTION", "SelfEdit");
    
    /**
     * The action word to use to process a user add or edit.
     */
    define("PROCESSSELFADDEDIT_ACTION", "ProcessSelfAddEdit");
    
    /**
     * The action word to use to view user information.
     */
    define("SELFVIEW_ACTION", "SelfView");
    
    /**
     * The action word to use to change a user's password.
     */
    define("CHANGEPASSWORD_ACTION", "ChangePassword");
    
    /**
     * The action word to use to contact someone from the site.
     */
    define("CONTACT_ACTION", "Contact");
    
    /**
     * The action word to use to view the site's information.
     */
    define("ABOUT_ACTION", "About");
    
    /**
     * The action word for a user to use to add a language profile.
     */
    define("LANGUAGEPROFILEADD_ACTION", "LanguageProfileAdd");
    
    /**
     * The action word for a user to use to edit a language profile.
     */
    define("LANGUAGEPROFILEEDIT_ACTION", "LanguageProfileEdit");
    
    /**
     * The action word for a user to use to view a lanauage profile.
     */
    define("LANGUAGEPROFILEVIEW_ACTION", "LanguageProfileView");
    
    /**
     * The action word to use to process a user profile add or edit.
     */
    define("PROCESSLANGUAGEPROFILEADDEDIT_ACTION", "ProcessLanguageProfileAddEdit");
    
    /**
     * The action word for a user to use to view all of their profiles.
     */
    define("MANAGELANGUAGEPROFILES_ACTION", "ManageLanguageProfiles");
    
    /**
     * The action word to use to add a user profile.
     */
    define("PROFILEADD_ACTION", "ProfileAdd");
    
    /**
     * The action word to use to edit a user profile.
     */
    define("PROFILEEDIT_ACTION", "ProfileEdit");
    
    /**
     * The action word to use to view a user profile.
     */
    define("PROFILEVIEW_ACTION", "ProfileView");
    
    /**
     * The action word to use to process an add/edit profile.
     */
    define("PROCESSPROFILEADDEDIT_ACTION", "ProcessProfileAddEdit");
    
    
//Actions available through the admin controller.
/******************************************************************************/
    
    /**
     * The action word to use to search for a users.
     */
    define("USERSEARCH_ACTION", "UserSearch");
    
    /**
     * The action word to use to access the control panel.
     */
    define("CONTROLPANEL_ACTION", "ControlPanel");
    
    /**
     * The action word to use to manage current user accounts.
     */
    define("MANAGEUSERS_ACTION", "ManageUsers");
    
    /**
     * The action word to use to edit a current user's information.
     */
    define("USEREDIT_ACTION", "UserEdit");
    
    /**
     * The action word to use to delete a user's account.
     */
    define("USERDELETE_ACTION", "UserDelete");
    
    /**
     * The action word to use to view a user's account information.
     */
    define("USERVIEW_ACTION", "UserView");
    
    /**
     * The action word to use to process a user add or edit.
     */
    define("PROCESSUSERADDEDIT_ACTION", "ProcessUserAddEdit");
    
    /**
     * The action word to use to manage functions.
     */
    define("MANAGEFUNCTIONS_ACTION", "ManageFunctions");
    
    /**
     * The action word to use to add a function.
     */
    define("FUNCTIONADD_ACTION", "FunctionAdd");
    
    /**
     * The action word to use to edit a function.
     */
    define("FUNCTIONEDIT_ACTION", "FunctionEdit");
    
    /**
     * The action word to use to delete a function.
     */
    define("FUNCTIONDELETE_ACTION", "FunctionDelete");
    
    /**
     * The action word to use to process a function add or edit.
     */
    define("PROCESSFUNCTIONADDEDIT", "ProcessFunctionAddEdit");
    
    /**
     * The action word to use to maange roles.
     */
    define("MANAGEROLES_ACTION", "ManageRoles");
    
    /**
     * The action word to use to add a new role.
     */
    define("ROLEADD_ACTION", "RoleAdd");
    
    /**
     * The action word to use to edit a role.
     */
    define("ROLEEDIT_ACTION", "RoleEdit");
    
    /**
     * The action word to use to delete a role.
     */
    define("ROLEDELETE_ACTION", "RoleDelete");
    
    /**
     * The action word to use to process a role add or edit.
     */
    define("PROCESSROLEADDEDIT_ACTION", "PrcessRoleAddEdit");
    
    /**
     * The action word to use to manage languages.
     */
    define("MANAGELANGUAGES_ACTION", "ManageLanguages");
    
    /**
     * The action word to use to add a language.
     */
    define("LANGUAGEADD_ACTION", "LanguageAdd");
    
    /**
     * The action to word to use to edit an existing language.
     */
    define("LANGUAGEEDIT_ACTION", "LanguageEdit");
    
    /**
     * The action word to use to view a language.
     */
    define("LANGUAGEVIEW_ACTION", "LanguageView");
    
    /**
     * The action word to use to delete a language.
     */
    define("LANGUAGEDELETE_ACTION", "LanguageDelete");
    
    /**
     * The action word to use to process a language add/edit.
     */
    define("PROCESSLANGUAGEADDEDIT_ACTION", "ProcessLanguageAddEdit");
    
    /**
     * The action word to use to manage questions.
     */
    define("MANAGEQUESTIONS_ACTION", "ManageQuestions");
    
    /**
     * The action word to use to add a question.
     */
    define("QUESTIONADD_ACTION", "QuestionAdd");
    
    /**
     * The action to word to use to edit an existing question.
     */
    define("QUESTIONEDIT_ACTION", "QuestionEdit");
    
    /**
     * The action word to use to view a question.
     */
    define("QUESTIONVIEW_ACTION", "QuestionView");
    
    /**
     * The action word to use to delete a question.
     */
    define("QUESTIONDELETE_ACTION", "QuestionDelete");
    
    /**
     * The action word to use to process a question add/edit.
     */
    define("PROCESSQUESTIONADDEDIT_ACTION", "ProcessQuestionAddEdit");
    
//Actions available through the exam controller.
/******************************************************************************/
    
    /**
     * The action word to use to start an exam.
     */
    define("STARTEXAM_ACTION", "StartExam");
    
    /**
     * The action word to use select a language for the exam.
     */
    define("SELECTEXAMLANGUAGE_ACTION", "SelectExamLanguage");
    
    /**
     * The action word to use to process a language select for an exam.
     */
    define("PROCESSEXAMLANGUAGESELECT_ACTION", "ProcessSelectExamLanguage");
?>
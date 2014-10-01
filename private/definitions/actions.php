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
     * The action word to use to contact someone from the site.
     */
    define("CONTACT_ACTION", "Contact");
    
    /**
     * The action word to use to view the site's information.
     */
    define("ABOUT_ACTION", "About");
    
    
//Actions available through the admin controller.
/******************************************************************************/
  
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
     * The action word to add a user.
     */
    define("USERADD_ACTION", "UserAdd");
    
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
     * The action word to use to process a user add.
     */
    define("PROCESSUSERADD_ACTION", "ProcessUserAdd");
    
    /**
     * The action word to use to process a user edit.
     */
    define("PROCESSUSEREDIT_ACTION", "ProcessUserEdit");
    
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
    
    /**
     * The action word to use to search for question.
     */
    define("QUESTIONSEARCH_ACTION", "QuestionSearch");
    
    /**
     * The action word to use to view exam parameters.
     */
    define("EXAMPARAMETERSVIEW_ACTION", "ExamParametersView");
    
    /**
     * The action word to use to edit exam parameters.
     */
    define("EXAMPARAMETERSEDIT_ACTION", "ExamParametersEdit");
    
    /**
     * The action word to use to process the edit of exam parameters.
     */
    define("PROCESSEXAMPARAMETERSEDIT_ACTION", "ProccesExamParametersEdit");
    
    /**
     * The action word to use to manage tests.
     */
    define("MANAGETESTS_ACTION", "ManageTests");
    
    /**
     * The action word to use to view a test.
     */
    define("TESTVIEW_ACTION", "TestView");
    
    /**
     * The action word to use to search tests by name.
     */
    define("TESTSEARCH_ACTION", "TestSearch");
    
    /**
     * The action word to use to import the questions for a langauge.
     */
    define("LANGUAGEIMPORT_ACTION", "LanguageImport");
    
    /**
     * The action word to use to export the questions for a language.
     */
    define("LANGUAGEEXPORT_ACTION", "LanguageExport");
    
    /**
     * The action word to use to add a contact.
     */
    define("CONTACTADD_ACTION", "ContactAdd");
    
    /**
     * The action word to use to edit a contact.
     */
    define("CONTACTEDIT_ACTION", "ConcactEdit");
    
    /**
     * The action word to use to manage contacts.
     */
    define("MANAGECONTACTS_ACTION", "ManageContacts");
    
    /**
     * The action word to use to delete a contact.
     */
    define("CONTACTDELETE_ACTION", "ContactDelete");
    
    /**
     * The action word to use to process a contact add edit.
     */
    define("PROCESSCONTACTADDEDIT_ACTION", "ProcessContactAddEdit");
    
    /**
     * The action word to use to activate a language.
     */
    define("LANGUAGEACTIVATE_ACTION", "LanguageActivate");
    
    /**
     * The action word to use to deactivate a language.
     */
    define("LANGUAGEDEACTIVATE_ACTION", "LanguageDeactivate");
    
    /**
     * The action word to use to activate a contact.
     */
    define("CONTACTACTIVATE_ACTION", "ContactActivate");
    
    /**
     * The action word to use to deactivate a contact.
     */
    define("CONTACTDEACTIVATE_ACTION", "ContactDeactivate");
    
    /**
     * The action word to use to manage level infos.
     */
    define("MANAGELEVELINFOS_ACTION", "ManageLevelInfos");
    
    /**
     * The action word to use to add a level info.
     */
    define("LEVELINFOADD_ACTION", "LevelInfoAdd");
    
    /**
     * The action word to use to view a level info.
     */
    define("LEVELINFOVIEW_ACTION", "LevelInfoView");
    
    /**
     * The action word to use to edit a level info.
     */
    define("LEVELINFOEDIT_ACTION", "LevelInfoEdit");
    
    /**
     * The action word to use to delete a level info.
     */
    define("LEVELINFODELETE_ACTION", "LevelInfoDelete");
    
    /**
     * The action word to use to process a level info add/edit.
     */
    define("PROCESSLEVELINFOADDEDIT_ACTION", "ProcessLevelInfoAddEdit");
    
//Actions available through the exam controller.
/******************************************************************************/
    
    /**
     * The action word to use to enter a key code.
     */
    define("ENTERKEYCODE_ACTION", "EnterKeyCode");
    
    /**
     * The action word to use to process a key code.
     */
    define("PROCESSKEYCODE_ACTION", "ProcessKeyCode");
    
    /**
     * The action word to use to select a language.
     */
    define("LANGUAGESELECT_ACTION", "LanguageSelect");
    
    /**
     * The action word to use to process a language selection.
     */
    define("PROCESSLANGUAGESELECT_ACTION", "ProcessLanguageSelect");
    
    /**
     * The action word to use to create a profile.
     */
    define("PROFILECREATE_ACTION", "ProfileCreate");
    
    /**
     * The action word to use to process a created profile.
     */
    define("PROCESSPROFILECREATE_ACTION", "ProcessProfileCreate");
    
    /**
     * The action word to use to start the exam.
     */
    define("STARTEXAM_ACTION", "StartExam");
    
    /**
     * The action word to process an exam question.
     */
    define("SUBMITANSWER_ACTION", "SubmitAnswer");
    
    /**
     * The action word to use to view test results.
     */
    define("TESTRESULTSVIEW_ACTION", "TestResultsView");
    
?>
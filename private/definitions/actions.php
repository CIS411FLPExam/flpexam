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
     * The action word to use to add a user profile.
     */
    define("SELFPROFILEADD_ACTION", "SelfProfileAdd");
    
    /**
     * The action word to use to edit a user profile.
     */
    define("SELFPROFILEEDIT_ACTION", "SelfProfileEdit");
    
    /**
     * The action word to use to process a user profile add or edit.
     */
    define("PROCESSSELFPROFILEADDEDIT_ACTION", "ProcessSelfProfileAddEdit");
    
    /**
     * The action word to use to view user information.
     */
    define("SELFVIEW_ACTION", "SelfView");
    
    /**
     * The action word to use to change a user's password.
     */
    define("CHANGEPASSWORD_ACTION", "ChangePassword");
    
//Actions available through the admin controller.
/******************************************************************************/
    
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
?>
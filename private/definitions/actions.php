<?php
    //The action key word for all actions.
    define("ACTION_KEYWORD", "action");
    
//Actions available through the main controller.
/******************************************************************************/

    define("HOME_ACTION", "Home");
    define("LOGIN_ACTION", "Login");
    define("LOGOUT_ACTION", "LogOut");
    define("SELFADD_ACTION", "SelfAdd");
    define("SELFEDIT_ACTION", "SelfEdit");
    define("PROCESSSELFADDEDIT_ACTION", "ProcessSelfAddEdit");
    define("SELFPROFILEADD_ACTION", "SelfProfileAdd");
    define("SELFPROFILEEDIT_ACTION", "SelfProfileEdit");
    define("PROCESSSELFPROFILEADDEDIT_ACTION", "ProcessSelfProfileAddEdit");
    
//Actions available through the admin controller.
/******************************************************************************/
    
    define("CONTROLPANEL_ACTION", "ControlPanel");
    define("PROCESSLOGIN_ACTION", "ProcessLogin");
    define("MANAGEUSERS_ACTION", "ManageUsers");
    define("USERADD_ACTION", "UserAdd");
    define("USEREDIT_ACTION", "UserEdit");
    define("USERDELETE_ACTION", "UserDelete");
    define("PROCESSUSERADDEDIT_ACTION", "ProcessUserAddEdit");
    define("MANAGEFUNCTIONS_ACTION", "ManageFunctions");
    define("FUNCTIONADD_ACTION", "FunctionAdd");
    define("FUNCTIONEDIT_ACTION", "FunctionEdit");
    define("FUNCTIONDELETE_ACTION", "FunctionDelete");
    define("PROCESSFUNCTIONADDEDIT", "ProcessFunctionAddEdit");
    define("MANAGEROLES_ACTION", "ManageRoles");
    define("ROLEADD_ACTION", "RoleAdd");
    define("ROLEEDIT_ACTION", "RoleEdit");
    define("ROLEDELETE_ACTION", "RoleDelete");
    define("PROCESSROLEADDEDIT_ACTION", "PrcessRoleAddEdit");
?>
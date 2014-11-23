<div id='cssmenu'>
    <ul>
        <li><a href="<?php echo( GetControllerScript( GetMainControllerFile(), GetHomeAction() ) ); ?>"><span>Home</span></a></li>
        <?php if (loggedIn()) {  ?>
            <li class='active has-sub'><a href='#'><span>Admin</span></a>
            <ul>
                <?php if (userIsAuthorized(GetControlPanelAction())) { ?>
                    <li><a href="<?php echo(GetControllerScript(GetAdminControllerFile(), GetControlPanelAction())) ?>"><span>Control Panel</span></a></li>
                <?php } ?>
                <?php if (userIsAuthorized(GetManageRolesAction())) { ?>
                    <li><a href="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageRolesAction())) ?>"><span>Roles</span></a></li>
                <?php } ?>
                <?php if (userIsAuthorized(GetManageUsersAction())) { ?>
                    <li><a href="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageUsersAction())) ?>"><span>Users</span></a></li>
                <?php } ?>
                <?php if (userIsAuthorized(GetManageTestEntriesAction())) { ?>
                    <li><a href="<?php echo( GetControllerScript(GetAdminControllerFile(), GetManageTestEntriesAction() ) ) ?>"><span>Tests</span></a></li>
                <?php } ?>
                <?php if (userIsAuthorized(GetManageContactsAction())) { ?>
                    <li><a href="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageContactsAction())) ?>"><span>Contacts</span></a></li>
                <?php } ?>
                <?php if (userIsAuthorized(GetManageLanguagesAction())) { ?>
                    <li><a href="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageLanguagesAction())) ?>"><span>Languages</span></a></li>
                <?php } ?>
                <?php if (userIsAuthorized(GetExamParametersViewAction())) { ?>
                    <li><a href="<?php echo(GetControllerScript(GetAdminControllerFile(), GetExamParametersViewAction())) ?>"><span>Exam Params</span></a></li>
                <?php } ?>
                <?php if (userIsAuthorized(GetLanguageExperienceViewAction())) { ?>
                    <li><a href="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageLanguageExperiencesAction())) ?>"><span>Experiences</span></a></li>
                <?php } ?>
            </ul>
            </li>
            <li><a href="<?php echo( GetControllerScript( GetAdminControllerFile(), GetLogoutAction() ) ) ?>"><span>Logout</span></a></li>
        <?php } else { ?>
            <li><a href="<?php echo( GetControllerScript( GetAdminControllerFile(), GetLoginAction() ) . '&' . GetRequestedPageIdentifier() .'=' . GetRequestedURI( ) ); ?>"><span>Login</span></a></li>
        <?php } ?>
    </ul>
</div>
<h1>Control Panel</h1>

<table class="controlPanel">
    <thead>
        <tr>
            <?php if (userIsAuthorized(GetManageUsersAction())) {  ?>
                <td>
                    <a href="<?php echo( GetControllerScript(GetAdminControllerFile(), GetManageUsersAction() ) ) ?>">Users</a>
                </td>
            <?php } ?>
            
            <?php if (userIsAuthorized(GetManageLanguagesAction()) ) { ?>
                <td>
                    <a href="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageLanguagesAction())); ?>">Languages</a>
                </td>
            <?php } ?>
            
            <?php if (userIsAuthorized(GetExamParametersViewAction()) ) { ?>
                <td>
                    <a href="<?php echo(GetControllerScript(GetAdminControllerFile(), GetExamParametersViewAction())); ?>">Exam Params</a>
                </td>
            <?php } ?>
            <?php if (userIsAuthorized(GetLanguageExperienceViewAction())) { ?>
                <td>
                    <a href="<?php echo( GetControllerScript(GetAdminControllerFile(), GetManageLanguageExperiencesAction() ) ) ?>">Experiences</a>
                </td>
            <?php } ?>
            <?php if (userIsAuthorized(GetManageRolesAction())) {  ?>
                <td>
                    <a href="<?php echo( GetControllerScript(GetAdminControllerFile(), GetManageRolesAction() ) ) ?>">Roles</a>
                </td>
            <?php } ?>
            
            <?php if (userIsAuthorized(GetManageTestEntriesAction())) {  ?>
                <td>
                    <a href="<?php echo( GetControllerScript(GetAdminControllerFile(), GetManageTestEntriesAction() ) ) ?>">Tests</a>
                </td>
            <?php } ?>
                
            <?php if (userIsAuthorized(GetManageContactsAction())) {  ?>
                <td>
                    <a href="<?php echo( GetControllerScript(GetAdminControllerFile(), GetManageContactsAction() ) ) ?>">Contacts</a>
                </td>
            <?php } ?>
        </tr>
        <tr>
            
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
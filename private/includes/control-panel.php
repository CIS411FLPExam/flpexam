<h1>Control Panel</h1>

<table class="controlPanel">
    <thead>
        <tr>
            <?php if (userIsAuthorized(MANAGEUSERS_ACTION)) {  ?>
                <td>
                    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGEUSERS_ACTION ) ) ?>">Users</a>
                </td>
            <?php } ?>
            
            <?php if (userIsAuthorized(MANAGELANGUAGES_ACTION) ) { ?>
                <td>
                    <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGELANGUAGES_ACTION)); ?>">Languages</a>
                </td>
            <?php } ?>
            
            <?php if (userIsAuthorized(EXAMPARAMETERSVIEW_ACTION) ) { ?>
                <td>
                    <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, EXAMPARAMETERSVIEW_ACTION)); ?>">Exam Params</a>
                </td>
            <?php } ?>
            <?php if (userIsAuthorized(LANGUAGEEXPERIENCESVIEW_ACTION)) { ?>
                <td>
                    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEEXPERIENCESVIEW_ACTION ) ) ?>">Experiences</a>
                </td>
            <?php } ?>
            <?php
            //<?php if (userIsAuthorized(MANAGEFUNCTIONS_ACTION)) {  //?
                ///<td>
                    //<a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGEFUNCTIONS_ACTION ) ) ?">Functions</a> &nbsp;
                //</td>
            //?php } ?
            ?>
            <?php if (userIsAuthorized(MANAGEROLES_ACTION)) {  ?>
                <td>
                    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGEROLES_ACTION ) ) ?>">Roles</a>
                </td>
            <?php } ?>
            
            <?php if (userIsAuthorized(MANAGETESTENTRIES_ACTION)) {  ?>
                <td>
                    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGETESTENTRIES_ACTION ) ) ?>">Tests</a>
                </td>
            <?php } ?>
                
            <?php if (userIsAuthorized(MANAGECONTACTS_ACTION)) {  ?>
                <td>
                    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGECONTACTS_ACTION ) ) ?>">Contacts</a>
                </td>
            <?php } ?>
        </tr>
        <tr>
            
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
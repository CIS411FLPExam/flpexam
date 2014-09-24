<h1>Control Panel</h1>

<table class="noWrapHidden centerText centerElement">
    <thead>
        <tr>
            <td>
                <?php if (userIsAuthorized(MANAGEUSERS_ACTION)) {  ?>
                    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGEUSERS_ACTION ) ) ?>">Manage Users</a> &nbsp;
                <?php } ?>
            </td>
            <td>
                <?php if (userIsAuthorized(MANAGELANGUAGES_ACTION) ) { ?>
                    <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGELANGUAGES_ACTION)); ?>">Manage Languages</a> &nbsp;
                <?php } ?>
            </td>
            <td>
                <?php if (userIsAuthorized(EXAMPARAMETERSVIEW_ACTION) ) { ?>
                    <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, EXAMPARAMETERSVIEW_ACTION)); ?>">Manage Exam Parameters</a> &nbsp;
                <?php } ?>
            </td>
            <?php
            //<td>
                //<?php if (userIsAuthorized(MANAGEFUNCTIONS_ACTION)) {  //?
                    //<a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGEFUNCTIONS_ACTION ) ) ?">Manage Functions</a> &nbsp;
                //?php } ?
            //</td>
            ?>
            <td>
                <?php if (userIsAuthorized(MANAGEROLES_ACTION)) {  ?>
                    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGEROLES_ACTION ) ) ?>">Manage Roles</a> &nbsp;
                <?php } ?>
            </td>
            <td>
                <?php if (userIsAuthorized(MANAGETESTS_ACTION)) {  ?>
                    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGETESTS_ACTION ) ) ?>">Manage Tests</a> &nbsp;
                <?php } ?>
            </td>
            <td>
                <?php if (userIsAuthorized(MANAGECONTACTS_ACTION)) {  ?>
                    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGECONTACTS_ACTION ) ) ?>">Manage Contacts</a> &nbsp;
                <?php } ?>
            </td>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
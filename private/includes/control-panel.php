<h1>Control Panel</h1>

<table class="controlPanel">
    <thead>
        <tr>
            <td>
                <?php if (userIsAuthorized(MANAGEUSERS_ACTION)) {  ?>
                    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGEUSERS_ACTION ) ) ?>">Users</a> &nbsp;
                <?php } ?>
            </td>
            <td>
                <?php if (userIsAuthorized(MANAGELANGUAGES_ACTION) ) { ?>
                    <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGELANGUAGES_ACTION)); ?>">Languages</a> &nbsp;
                <?php } ?>
            </td>
            <td>
                <?php if (userIsAuthorized(EXAMPARAMETERSVIEW_ACTION) ) { ?>
                    <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, EXAMPARAMETERSVIEW_ACTION)); ?>">Exam Parameters</a> &nbsp;
                <?php } ?>
            </td>
            <?php
            //<td>
                //<?php if (userIsAuthorized(MANAGEFUNCTIONS_ACTION)) {  //?
                    //<a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGEFUNCTIONS_ACTION ) ) ?">Functions</a> &nbsp;
                //?php } ?
            //</td>
            ?>
            <td>
                <?php if (userIsAuthorized(MANAGEROLES_ACTION)) {  ?>
                    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGEROLES_ACTION ) ) ?>">Roles</a> &nbsp;
                <?php } ?>
            </td>
            <td>
                <?php if (userIsAuthorized(MANAGETESTS_ACTION)) {  ?>
                    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGETESTS_ACTION ) ) ?>">Tests</a> &nbsp;
                <?php } ?>
            </td>
            <td>
                <?php if (userIsAuthorized(MANAGECONTACTS_ACTION)) {  ?>
                    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGECONTACTS_ACTION ) ) ?>">Contacts</a> &nbsp;
                <?php } ?>
            </td>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
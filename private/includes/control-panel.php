<h1>Control Panel</h1>

<table class="controlPanel">
    <thead>
        <tr>
            <?php if (userIsAuthorized(MANAGEUSERS_ACTION)) {  ?>
                <td>
                    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGEUSERS_ACTION ) ) ?>">Users</a> &nbsp;
                </td>
            <?php } ?>
            
            <?php if (userIsAuthorized(MANAGELANGUAGES_ACTION) ) { ?>
                <td>
                    <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGELANGUAGES_ACTION)); ?>">Languages</a> &nbsp;
                </td>
            <?php } ?>
            
            <?php if (userIsAuthorized(EXAMPARAMETERSVIEW_ACTION) ) { ?>
                <td>
                    <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, EXAMPARAMETERSVIEW_ACTION)); ?>">Exam Parameters</a> &nbsp;
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
                    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGEROLES_ACTION ) ) ?>">Roles</a> &nbsp;
                </td>
            <?php } ?>
            
            <?php if (userIsAuthorized(MANAGETESTS_ACTION)) {  ?>
                <td>
                    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGETESTS_ACTION ) ) ?>">Tests</a> &nbsp;
                </td>
            <?php } ?>
                
            <?php if (userIsAuthorized(MANAGECONTACTS_ACTION)) {  ?>
                <td>
                    <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, MANAGECONTACTS_ACTION ) ) ?>">Contacts</a> &nbsp;
                </td>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
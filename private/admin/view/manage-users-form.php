<?php
    include(HEADER_FILE);
    include(CONTROLPANEL_FILE);
?>
<!-- Start main content here -->

<h2>Manage Users</h2>

<?php
    $userCanEdit = userIsAuthorized(USEREDIT_ACTION);
    $userCanView = userIsAuthorized(USERVIEW_ACTION);
    $userCanDelete = userIsAuthorized(USERDELETE_ACTION);
?>

<form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, USERSEARCH_ACTION)) ?>" method="post">
    <label>Name:</label><input type="text" name="<?php echo(NAME_IDENTIFIER); ?>" />
    <input type="submit" value="Search" />
</form>

<br />
            
<div class="divider"></div>

<br />
            
<form action="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, USERDELETE_ACTION ) ); ?>" method="post">
    <div class="datatable">
        <table id="users" class="tablesorter">
            <thead>
                <tr>
                    <th><b>First Name</b></th>
                    <th><b>Last Name</b></th>
                    <th><b>User Name</b></th>
                    <th><b>Email</b></th>
                    <?php if ($userCanView) { ?><th></th><?php } ?>
                    <?php if ($userCanEdit) { ?><th></th><?php } ?>
                    <?php if ($userCanDelete) { ?><th></th><?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                    $j = 0;
                    foreach ($results as $record)
                    {
                        $firstName = $record[FIRSTNAME_IDENTIFIER];
                        $lastName = $record[LASTNAME_IDENTIFIER];
                        $userName = $record[USERNAME_IDENTIFIER];
                        $email = $record[EMAIL_IDENTIFIER];
                        $user_ID = $record[USERID_IDENTIFIER];
                ?>


                <tr class="row1">
                    <td><?php echo(htmlspecialchars($firstName)); ?></td>
                    <td><?php echo(htmlspecialchars($lastName)); ?></td>
                    <td><?php echo(htmlspecialchars($userName)); ?></td>
                    <td><?php echo(htmlspecialchars($email)); ?></td>

                    <?php if ($userCanView) { ?>
                        <td>
                            <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, USERVIEW_ACTION . "&". USERID_IDENTIFIER . "=" . urldecode($user_ID))) ?>">
                                View
                            </a>
                        </td>
                    <?php } ?>
                    <?php if ($userCanEdit) { ?>
                        <td>
                            <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, USEREDIT_ACTION . "&". USERID_IDENTIFIER . "=" . urldecode($user_ID))) ?>">
                                Edit
                            </a>
                        </td>
                    <?php } ?>
                    <?php if ($userCanDelete) { ?>
                        <td class="centerText">
                            <input type="checkbox" name="record<?php echo($j); ?>" value="<?php echo(htmlspecialchars($user_ID)); ?>" />
                        </td>
                    <?php } ?>
                </tr>
                <?php
                        ++$j;
                    }
                ?>
            </tbody>
        </table>
    </div>
    <input type="hidden" name="numListed" value="<?php echo count($results); ?>" />
    <?php if ($userCanDelete) { ?>
            <br />
            
            <input type="submit" value="Delete Selected" />
    <?php } ?>
</form>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
<script>
    $( document ).ready( function( ) 
    { 
        $( "#users" ).tablesorter( ); 
    });   
</script>
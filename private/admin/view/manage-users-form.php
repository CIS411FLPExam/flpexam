<?php
    include(GetHeaderFile());
    include(GetControlPanelFile());
?>
<!-- Start main content here -->

<h2>Users</h2>

<?php
    $userCanAdd = userIsAuthorized(GetUserAddAction());
    $userCanEdit = userIsAuthorized(GetUserEditAction());
    $userCanView = userIsAuthorized(GetUserViewAction());
    $userCanDelete = userIsAuthorized(GetUserDeleteAction());
    $userCanSearch = userIsAuthorized(GetUserSearchAction());
?>
<?php if ($userCanAdd) { ?>
    <form action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetUserAddAction())); ?>" method="post">
        <input type="submit" value="Add User" />
    </form>

    <br />
<?php } ?>

<?php if (FALSE) { ?>
    <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetUserSearchAction())) ?>" method="post">
        <label>Name:</label><input type="text" name="<?php echo(GetNameIdentifier()); ?>" />
        <input type="submit" value="Search" />
    </form>
    <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageUsersAction())) ?>" method="post">
        <input type="submit" value="Clear" />
    </form>
    <br />
    <br />
    <div class="divider"></div>

    <br />
<?php } ?>

<?php
    if (isset($message))
    {
        include(GetMessageFile());
    }
?>
<form onsubmit="return ConfirmationPrompt('Delete the selected users?');" action="<?php echo( GetControllerScript(GetAdminControllerFile(), GetUserDeleteAction() ) ); ?>" method="post">
    <div class="datatable">
        <table id="users" class="tablesorter">
            <thead>
                <tr>
                    <th><b>User Name</b></th>
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
                        $userName = $record[GetUserNameIdentifier()];
                        $user_ID = $record[GetUserIdIdentifier()];
                        $vital = $record['Vital'];
                ?>


                <tr>
                    <td><?php echo(htmlspecialchars($userName)); ?></td>

                    <?php if ($userCanView) { ?>
                        <td>
                            <input type="button" value="View" onclick="Relocate('<?php echo(GetControllerScript(GetAdminControllerFile(), GetUserViewAction() . "&". GetUserIdIdentifier() . "=" . urlencode($user_ID))) ?>');" />
                        </td>
                    <?php } ?>
                    <?php if ($userCanEdit) { ?>
                        <td>
                            <input type="button" value="Edit" onclick="Relocate('<?php echo(GetControllerScript(GetAdminControllerFile(), GetUserEditAction() . "&". GetUserIdIdentifier() . "=" . urlencode($user_ID))) ?>');" />
                        </td>
                    <?php } ?>
                    <?php if ($userCanDelete) { ?>
                        <td class="centerText">
                            <?php if ($vital == '0') { ?>
                                <input type="checkbox" name="record<?php echo($j); ?>" value="<?php echo(htmlspecialchars($user_ID)); ?>" />
                            <?php } ?>
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
        <input type="button" value="Select All" onclick="CheckAll();" />
    <?php } ?>
</form>

<!-- End main content here -->
<?php
    include( GetFooterFile() ); 
?>
<script>
    $( document ).ready( function( ) 
    { 
        $( "#users" ).tablesorter( ); 
    });   
</script>
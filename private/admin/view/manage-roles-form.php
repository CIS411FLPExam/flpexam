<?php
    include( GetHeaderFile() );
    include( GetControlPanelFile() );
?>
<!-- Start main content here -->

<h2>Roles</h2>
<?php
    if (isset($message))
    {
        include(GetMessageFile());
    }
?>
<?php if (userIsAuthorized(GetRoleAddAction())) { ?>
    <form action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetRoleAddAction())); ?>" method="post">
        <input type="submit" value="Add Role" />
    </form>
    
    <br />
<?php } ?>
<form onsubmit="return ConfirmationPrompt('Delete the selected roles?');" action="<?php echo(GetControllerScript(GetAdminControllerFile(),GetRoleDeleteAction())) ?>" method="post">
    <div class="datatable">
        <table id="roles" class="tablesorter">
            <thead>
                <tr>
                    <th><b>Name</b></th> <th><b>Description</b></th>
                    <?php if (userIsAuthorized(GetRoleEditAction())) { ?>
                        <th></th>
                    <?php } ?>
                    <?php if (userIsAuthorized(GetRoleDeleteAction())) { ?>
                        <th></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
            <?php
                $j = 0;
                foreach ($results as $record) {
                    $name = $record["Name"];
                    $desc = $record["Description"];
                    $role_ID = $record["RoleID"];
                    $vital = $record['Vital'];

                    echo "<tr>";
                    echo "<td>$name</td><td>$desc</td>";
                    if (userIsAuthorized(GetRoleEditAction())) {
            ?>
                <td>
                    <?php if ($vital == '0') { ?>
                        <input type="button" value="Edit" onclick="Relocate('<?php echo(GetControllerScript(GetAdminControllerFile(), GetRoleEditAction()). '&' . GetRoleIdIDentifier() . '=' . urlencode($role_ID)); ?>');" />
                    <?php } ?>
                </td>
            <?php
                    }
                    if (userIsAuthorized(GetRoleDeleteAction())) {
                        echo "<td>";
                        if ($vital == '0')
                        {
                            echo "<input type=\"checkbox\" name=\"record$j\" value=\"" . htmlspecialchars($role_ID) . "\"/>";
                        }
                        echo "</td>";
                    }
                    echo "</tr>\n";
                    ++$j;
                }
            ?>
            </tbody>
        </table>
    </div>
    <br/>
    <input type="hidden" name="numListed" value="<?php echo count($results); ?>"/>
    <?php if (userIsAuthorized(GetRoleDeleteAction())) { ?>
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
        $( "#roles" ).tablesorter( ); 
    });   
</script>
<?php
    include( HEADER_FILE );
    include( CONTROLPANEL_FILE );
?>
<!-- Start main content here -->

<h2>Roles</h2>
<?php
    if (isset($message))
    {
        include(MESSAGE_FILE);
    }
?>
<?php if (userIsAuthorized(ROLEADD_ACTION)) { ?>
    <form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, ROLEADD_ACTION)); ?>" method="post">
        <input type="submit" value="Add Role" />
    </form>
    
    <br />
<?php } ?>
<form onsubmit="return ConfirmationPrompt('Delete the selected roles?');" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE,ROLEDELETE_ACTION)) ?>" method="post">
    <div class="datatable">
        <table id="roles" class="tablesorter">
            <thead>
                <tr>
                    <th><b>Name</b></th> <th><b>Description</b></th>
                    <?php if (userIsAuthorized(ROLEEDIT_ACTION)) { ?>
                        <th></th>
                    <?php } ?>
                    <?php if (userIsAuthorized(ROLEDELETE_ACTION)) { ?>
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
                    if (userIsAuthorized(ROLEEDIT_ACTION)) {
            ?>
                <td>
                    <?php if ($vital == '0') { ?>
                        <input type="button" value="Edit" onclick="Relocate('<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, ROLEEDIT_ACTION). '&' . ROLEID_IDENTIFIER . '=' . urlencode($role_ID)); ?>');" />
                    <?php } ?>
                </td>
            <?php
                    }
                    if (userIsAuthorized(ROLEDELETE_ACTION)) {
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
    <?php if (userIsAuthorized(ROLEDELETE_ACTION)) { ?>
        <input type="submit" value="Delete Selected" />
        <input type="button" value="Select All" onclick="CheckAll();" />
    <?php } ?>
</form>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
<script>
    $( document ).ready( function( ) 
    { 
        $( "#roles" ).tablesorter( ); 
    });   
</script>
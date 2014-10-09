<?php
    include( HEADER_FILE );
    include( CONTROLPANEL_FILE );
?>
<!-- Start main content here -->

<h2>Roles</h2>

<?php if (userIsAuthorized(ROLEADD_ACTION)) { ?>
    <form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, ROLEADD_ACTION)); ?>" method="post">
        <input type="submit" value="Add Role" />
    </form>
    
    <br />
<?php } ?>
<form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE,ROLEDELETE_ACTION)) ?>" method="post">
    <div class="datatable">
        <table id="roles" class="tablesorter">
            <thead>
                <tr>
                    <th><b>Name</b></th> <th><b>Description</b></th> <th></th> <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
                $j = 0;
                foreach ($results as $record) {
                    $name = $record["Name"];
                    $desc = $record["Description"];
                    $role_ID = $record["RoleID"];

                    echo "<tr>";
                    echo "<td>$name</td><td>$desc</td>";
                    if (userIsAuthorized(ROLEEDIT_ACTION)) {
                        echo "<td><a href=\"" . GetControllerScript(ADMINCONTROLLER_FILE,ROLEEDIT_ACTION) . "&id=" . urldecode($role_ID) . "\">Edit</a></td>";
                    } else {
                        echo "<td></td>";
                    }
                    if (userIsAuthorized(ROLEDELETE_ACTION)) {
                        echo "<td><input type=\"checkbox\" name=\"record$j\" value=\"" . htmlspecialchars($role_ID) . "\"/></td>";
                    } else {
                        echo "<td></td>";
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
    <?php
        if (userIsAuthorized(ROLEDELETE_ACTION)) {
            echo "<input type=\"submit\" value=\"Delete Selected\"/>";
        }
    ?>
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
<?php
    include( HEADER_FILE );
    include( CONTROLPANEL_FILE );
?>
<!-- Start main content here -->

<h2>Manage Roles</h2>

<?php
    if (userIsAuthorized(ROLEADD_ACTION)) {
        echo "<a href=\"" . GetControllerScript(ADMINCONTROLLER_FILE,ROLEADD_ACTION) . "\">Add Role</a><p/>";
    }
?>
<form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE,ROLEDELETE_ACTION)) ?>" method="post">
    <table border>
        <tr>
            <td><b>Name</b></td> <td><b>Description</b></td> <td></td> <td></td>
        </tr>
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
    </table>
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
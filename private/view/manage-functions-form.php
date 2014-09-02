<?php
    include( HEADER_FILE );
    include( CONTROLPANEL_FILE );
?>
<!-- Start main content here -->

<h2>Manage Functions</h2>
<?php
    if (userIsAuthorized(FUNCTIONADD_ACTION)) {
        echo "<a href=\"" . GetControllerScript( FUNCTIONADD_ACTION ). "\">Add Function</a><p/>";
    }
?>
<form action="<?php echo(GetControllerScript( FUNCTIONDELETE_ACTION)) ?>" method="post">

    <table border>
        <tr>
            <td><b>Name</b></td> <td><b>Description</b></td> <td></td> <td></td>
        </tr>
        <?php
            $j = 0;
            foreach ($results as $record) {
                $name = $record["Name"];
                $desc = $record["Description"];
                $function_ID = $record["FunctionID"];

                echo "<tr>";
                echo "<td>" . htmlspecialchars($name) . "</td><td>" . htmlspecialchars($desc) . "</td>";
                if (userIsAuthorized(FUNCTIONEDIT_ACTION)) {
                    echo "<td><a href=\"" . GetControllerScript(FUNCTIONEDIT_ACTION) . "&id=" . urlencode($function_ID) . "\">Edit</a></td>";
                } else {
                    echo "<td></td>";
                }
                if (userIsAuthorized(FUNCTIONDELETE_ACTION)) {
                    echo "<td><input type=\"checkbox\" name=\"record$j\" value=\"" . htmlspecialchars($function_ID) . "\"/></td>";
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
        if (userIsAuthorized(FUNCTIONDELETE_ACTION)) {
            echo "<input type=\"submit\" value=\"Delete Selected\"/>";
        }
    ?>
</form>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
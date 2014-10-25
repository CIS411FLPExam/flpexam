<?php
    include( HEADER_FILE );
    include( CONTROLPANEL_FILE );
?>
<!-- Start main content here -->

<h2>Manage Functions</h2>
<?php
    if (userIsAuthorized(FUNCTIONADD_ACTION)) {
        echo "<a href=\"" . GetControllerScript(ADMINCONTROLLER_FILE, FUNCTIONADD_ACTION ). "\">Add Function</a><p/>";
    }
?>
<form onsubmit="return ConfirmationPrompt('Delete the selected functions?');" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, FUNCTIONDELETE_ACTION)) ?>" method="post">
    <div class="datatable">
        <table id="functions" class="tablesorter">
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
                    $function_ID = $record["FunctionID"];

                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($name) . "</td><td>" . htmlspecialchars($desc) . "</td>";
                    if (userIsAuthorized(FUNCTIONEDIT_ACTION)) {
                        echo "<td><a href=\"" . GetControllerScript(ADMINCONTROLLER_FILE,FUNCTIONEDIT_ACTION) . "&id=" . urlencode($function_ID) . "\">Edit</a></td>";
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
            </tbody>
        </table>
    </div>
    <br/>
    <input type="hidden" name="numListed" value="<?php echo count($results); ?>"/>
    <?php if (userIsAuthorized(FUNCTIONDELETE_ACTION)) { ?>
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
        $( "#functions" ).tablesorter( ); 
    });   
</script>
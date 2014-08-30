<?php
    require_once ( "../php/DocInfo.php" );
    
    $docInfo = new wg\custom\DocInfo( );
    $docInfo->SetTitle( "VP Desings Control Panel - Manage Roles" );
    $docInfo->SetAuthor( "Wesley Garey" );
    $docInfo->SetDescription( "Fashion Designs" );
    
    $docInfo->SetTags( array( "desings", "clothes" ) );
    
    include( "../includes/header.php" );
    include('control_panel.php');
?>
<!-- Start main content here -->

<h2>Manage Roles</h2>

<?php
    if (userIsAuthorized("RoleAdd")) {
        echo "<a href=\"index.php?action=RoleAdd\">Add Role</a><p/>";
    }
?>
<form action="index.php?action=RoleDelete" method="post">
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
                if (userIsAuthorized("RoleEdit")) {
                    echo "<td><a href=\"index.php?action=RoleEdit&id=$role_ID\">Edit</a></td>";
                } else {
                    echo "<td></td>";
                }
                if (userIsAuthorized("RoleDelete")) {
                    echo "<td><input type=\"checkbox\" name=\"record$j\" value=\"$role_ID\"/></td>";
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
        if (userIsAuthorized("RoleDelete")) {
            echo "<input type=\"submit\" value=\"Delete Selected\"/>";
        }
    ?>
</form>

<!-- End main content here -->
<?php
    include( "../includes/footer.php" ); 
?>
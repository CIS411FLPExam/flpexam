<?php
    require_once ( "../php/DocInfo.php" );
    
    $docInfo = new wg\custom\DocInfo( );
    $docInfo->SetTitle( "VP Desings Control Panel - Manage Functions" );
    $docInfo->SetAuthor( "Wesley Garey" );
    $docInfo->SetDescription( "Fashion Designs" );
    
    $docInfo->SetTags( array( "desings", "clothes" ) );
    
    include( "../includes/header.php" );
    include('control_panel.php');
?>
<!-- Start main content here -->

<h2>Manage Functions</h2>
<?php
    if (userIsAuthorized("FunctionAdd")) {
        echo "<a href=\"index.php?action=FunctionAdd\">Add Function</a><p/>";
    }
?>
<form action="index.php?action=FunctionDelete" method="post">

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
                echo "<td>$name</td><td>$desc</td>";
                if (userIsAuthorized("FunctionEdit")) {
                    echo "<td><a href=\"index.php?action=FunctionEdit&id=$function_ID\">Edit</a></td>";
                } else {
                    echo "<td></td>";
                }
                if (userIsAuthorized("FunctionDelete")) {
                    echo "<td><input type=\"checkbox\" name=\"record$j\" value=\"$function_ID\"/></td>";
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
        if (userIsAuthorized("FunctionDelete")) {
            echo "<input type=\"submit\" value=\"Delete Selected\"/>";
        }
    ?>
</form>

<!-- End main content here -->
<?php
    include( "../includes/footer.php" ); 
?>
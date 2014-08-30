<?php
    require_once ( "../php/DocInfo.php" );
    
    $docInfo = new wg\custom\DocInfo( );
    $docInfo->SetTitle( "VP Desings Control Panel - Manage Users" );
    $docInfo->SetAuthor( "Wesley Garey" );
    $docInfo->SetDescription( "Fashion Designs" );
    
    $docInfo->SetTags( array( "desings", "clothes" ) );
    
    include( "../includes/header.php" );
    include('control_panel.php');
?>
<!-- Start main content here -->

<h2>Manage Users</h2>

<?php
    if (userIsAuthorized("UserAdd")) {
        echo "<a href=\"index.php?action=UserAdd\">Add User</a><p/>";
    }
?>
<form action="index.php?action=UserDelete" method="post">
    <table border>
        <tr>
            <td><b>First Name</b></td>
            <td><b>Last Name</b></td>
            <td><b>User Name</b></td>
            <td><b>Email</b></td>
            <td></td>
            <td></td>
        </tr>
    <?php
        $j = 0;
        foreach ($results as $record) {
            $firstName = $record["FirstName"];
            $lastName = $record["LastName"];
            $userName = $record["UserName"];
            $email = $record["Email"];
            $user_ID = $record["UserID"];

            echo "<tr>";
            echo "<td>$firstName</td> <td>$lastName</td> <td>$userName</td> <td>$email</td>";
            if (userIsAuthorized("UserEdit")) {
                echo "<td><a href=\"index.php?action=UserEdit&id=$user_ID\">Edit</a></td>";
            } else {
                echo "<td></td>";
            }
            if (userIsAuthorized("UserDelete")) {
                echo "<td><input type=\"checkbox\" name=\"record$j\" value=\"$user_ID\"/></td>";
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
        if (userIsAuthorized("UserDelete")) {
            echo "<input type=\"submit\" value=\"Delete Selected\"/>";
        }
    ?>
</form>

<!-- End main content here -->
<?php
    include( "../includes/footer.php" ); 
?>
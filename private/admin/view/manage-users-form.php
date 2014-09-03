<?php
    include( HEADER_FILE );
    include(CONTROLPANEL_FILE);
?>
<!-- Start main content here -->

<h2>Manage Users</h2>

<?php if (userIsAuthorized(USERADD_ACTION)){ ?>
        <a href="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, USERADD_ACTION ) ); ?>">Add User</a>
<?php    } ?>
<form action="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, USERDELETE_ACTION ) ); ?>" method="post">
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
            echo "<td>" . htmlspecialchars($firstName) . "</td> <td>" . htmlspecialchars($lastName) . "</td> <td>" . htmlspecialchars($userName) . "</td> <td>" . htmlspecialchars($email) . "</td>";
            if (userIsAuthorized(USEREDIT_ACTION)) {
                echo "<td><a href=\"" . GetControllerScript(ADMINCONTROLLER_FILE, USEREDIT_ACTION) . "&id=" . urldecode($user_ID) . "\">Edit</a></td>";
            } else {
                echo "<td></td>";
            }
            if (userIsAuthorized(USERDELETE_ACTION)) {
                echo "<td><input type=\"checkbox\" name=\"record$j\" value=\" " . htmlspecialchars($user_ID) . "\"/></td>";
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
        if (userIsAuthorized(USERDELETE_ACTION)) {
            echo "<input type=\"submit\" value=\"Delete Selected\"/>";
        }
    ?>
</form>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
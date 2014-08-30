<h1>Control Panel</h1>

<?php if (userIsAuthorized("ManageUsers")) {  ?>
        <a href="index.php?action=ManageUsers">Manage Users</a> &nbsp;
<?php } 
    if (userIsAuthorized("ManageFunctions")) {  ?>
        <a href="index.php?action=ManageFunctions">Manage Functions</a> &nbsp;
<?php } 
    if (userIsAuthorized("ManageRoles")) {  ?>
        <a href="index.php?action=ManageRoles">Manage Roles</a> &nbsp;
<?php } ?>
<?php 
    if( userIsAuthorized( "file-management" ) ) 
    {
?>
        <a href="../controller/controller.php?action=file-management">Manage Files</a> &nbsp;
<?php
    }
    if( userIsAuthorized( "send-sales" ) )
    {
?>
        <a href="../controller/controller.php?action=send-sales">Send Sales EMail</a> &nbsp;
<?php
    }
    if( userIsAuthorized( "add-product" ) ) 
    {
?>
        <a href="../controller/controller.php?action=add-product">Add Product</a> &nbsp;
<?php
    }
?>        
<?php
    if (loggedIn()) { 
?>
        <a href="index.php?action=LogOut">Log Out</a>
<?php } else { 
        echo "<a href=\"index.php?action=Login&RequestedPage=" . urlencode($_SERVER['REQUEST_URI']) . "\">Log In</a>";
} ?>


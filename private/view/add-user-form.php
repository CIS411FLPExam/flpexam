<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<h1>Add User</h1>

<form action="<?php echo(GetControllerScript(PROCESSUSERADDEDIT_ACTION)) ?>" method="post">

    First Name*: <input type="text" name="FirstName" size="20" value=""><br/>

    Last Name*: <input type="text" name="LastName" size="20" value=""><br/>

    User Name*: <input type="text" name="UserName" size="20" value=""><br/>

    Password*: <input type="password" name="Password" size="20" value=""><br/>

    Email*: <input type="text" name="Email" size="20" value=""><br/>

    <br/>

    <input type="submit" value="Submit" />

</form>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
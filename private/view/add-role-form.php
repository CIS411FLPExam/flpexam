<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<h2>Add Role</h2>

<form action="<?php echo(GetControllerScript(PROCESSROLEADDEDIT_ACTION)) ?>" method="post">

        Name: <input type="text" name="Name" size="20" value=""><br/>
        Description: <input type="text" name="Description" size="20" value=""><br/>
        <br/>

        <input type="submit" value="Submit" />

</form>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
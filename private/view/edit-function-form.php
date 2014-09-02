<?php
    include( HEADER_FILE);
?>
<!-- Start main content here -->

<h2>Modify Function</h2>

<form action="<?php echo(GetControllerScript(PROCESSFUNCTIONADDEDIT)) ?>" method="post">

    <input type="hidden" name="FunctionID" value="<?php echo htmlspecialchars($id); ?>"/>

    Name:  <input type="text" name="Name" size="20" value="<?php echo htmlspecialchars($name); ?>" /><br/>
        Description: <input type="text" name="Description" size="20" value="<?php echo htmlspecialchars($desc); ?>" />

        <br/>

        <input type="submit" value="Submit" />

</form>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<h2>Add Role</h2>

<form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, PROCESSROLEADDEDIT_ACTION)) ?>" method="post">
    <div class="formGroup">
        <div class="formSection">
            <label>Name:</label><input type="text" name="Name" size="20" value=""><br/>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Description:</label><input type="text" name="Description" size="20" value=""><br/>
        </div>
        
        <br/>

        <input type="submit" value="Submit" />
    </div>
</form>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
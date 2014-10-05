<?php
    include( HEADER_FILE);
?>
<!-- Start main content here -->

<h2>Modify Function</h2>

<form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE,PROCESSFUNCTIONADDEDIT)) ?>" method="post">

    <input type="hidden" name="FunctionID" value="<?php echo htmlspecialchars($id); ?>"/>

    <div class="formGroup">
        <div class="formSection">
            <label>Name<span class="redText">*</span>:</label><input type="text" name="Name" value="<?php echo htmlspecialchars($name); ?>" autofocus required />
            <div class="clear"></div>
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>Description:</label><input type="text" name="Description" value="<?php echo htmlspecialchars($desc); ?>" />
            <div class="clear"></div>
        </div>
        
        <br/>

        <input type="submit" value="Submit" />
    </div>
</form>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
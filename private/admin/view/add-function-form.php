<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<h2>Add Function</h2>

<form action="<?php echo( GetControllerScript( ADMINCONTROLLER_FILE, PROCESSFUNCTIONADDEDIT ) ); ?>" method="post">
    <div class="formGroup">
        <div class="formSection">
            <label>Name<span class="redText">*</span>:</label><input type="text" name="Name" size="20" value="" autofocus required />
            <div class="clear"></div>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Description:</label><input type="text" name="Description" size="20" value="" />
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
<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<h2>Add Role</h2>
<div class="formGroup">
    <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, PROCESSROLEADDEDIT_ACTION)) ?>" method="post">
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
    </form>
    <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEROLES_ACTION)); ?>" method="post">
        <input type="submit" value="Cancel" />
    </form>
</div>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
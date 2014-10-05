<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<h1>Test Clearance</h1>

<div class="formGroup">
    <form action="<?php echo(GetControllerScript(EXAMCONTROLLER_FILE, PROCESSKEYCODE_ACTION));?>" method="post">
        <div class="formSection">
            <label>Enter Key Code:</label>
            <input name="KeyCode"  type="password" class="formInput" autofocus />
            <div class="clear"></div>
        </div>
        
        <input type="submit" value="Submit" />
    </form>
</div>

<?php
    if(isset($message))
    {
        include(MESSAGE_FILE);
    }
?>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
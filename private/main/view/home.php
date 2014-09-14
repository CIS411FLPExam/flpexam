<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<h3>Welcome to the Clarion University's Foreign Language Placement Exam site!</h3>
<br />
<a href="<?php echo(GetControllerScript(EXAMCONTROLLER_FILE, ENTERKEYCODE_ACTION)); ?>">Take Exam!</a>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
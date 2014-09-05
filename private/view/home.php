<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<h3>Welcome to the Clarion University's Foreign Language Placement Exam site!</h3>
<?php if(!loggedIn()) {?>
<a href='<?php echo( GetControllerScript( MAINCONTROLLER_FILE, SELFADD_ACTION ) ); ?>'>Sign up!</a>
<?php } ?>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
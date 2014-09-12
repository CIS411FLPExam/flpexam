<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<h3>Welcome to the Clarion University's Foreign Language Placement Exam site!</h3>
<?php if(!loggedIn()) {?>
<form class="inline" action='<?php echo( GetControllerScript( MAINCONTROLLER_FILE, SELFADD_ACTION ) ); ?>' method="post">
        <input type="submit" value="Sign Up!" />
    </form>
<?php } ?>

<form class="inline" action='<?php echo( GetControllerScript( EXAMCONTROLLER_FILE, STARTEXAM_ACTION ) ); ?>' method="post">
    <input type="submit" value="Start Exam!" />
</form>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
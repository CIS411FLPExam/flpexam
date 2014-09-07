<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->
<h1>Profiles</h1>
<form action="<?php echo(GetControllerScript(MAINCONTROLLER_FILE, LANGUAGEPROFILEADD_ACTION)); ?>" method="post">
    <input type="submit" value="Add Profile" />
</form>

<?php if(is_array($languageProfiles) && count($languageProfiles) > 0) { ?>

    <?php foreach ($languageProfiles as $profile) { ?>
    <?php }?>
<?php } else { ?>
    <h3>No profiles on record.</h3>
<?php } ?>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
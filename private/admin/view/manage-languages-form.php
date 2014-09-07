<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->
<h1>Languages</h1>
<form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEADD_ACTION)); ?>" method="post">
    <input type="submit" value="Add Language" />
</form>

<?php if(is_array($languages) && count($languages) > 0) { ?>
    <?php foreach ($languages as $language) { ?>
    <?php }?>
<?php } else { ?>
    <h3>No languages on record.</h3>
<?php } ?>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
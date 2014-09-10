<?php
    include( HEADER_FILE );
?>
 <!-- Start main content here -->
 
<div class="formGroup">
    <h1>Language</h1>
    <div class="formGroup">
        <div class="formSection">
            <label>Name:</label>
            <label><?php echo(htmlspecialchars($name)); ?></label>
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>Active:</label><label><?php if ($active) { echo('Yes'); } else { echo ('No'); } ?></label>
        </div>
    </div>
    <?php if (userIsAuthorized(LANGUAGEEDIT_ACTION)) {?>
        <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEEDIT_ACTION . "&". LANGUAGEID_IDENTIFIER . '=' .htmlspecialchars($languageID))); ?>">
            Edit
        </a> &nbsp;
    <?php } ?>
    <?php if (userIsAuthorized(MANAGEQUESTIONS_ACTION)) {?>
        <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEQUESTIONS_ACTION)); ?>">
            Manage Questions
        </a>
    <?php } ?>
</div>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
<script>
    $( document ).ready( function( ) 
    { 
        $( "#questions" ).tablesorter( ); 
    });   
</script>
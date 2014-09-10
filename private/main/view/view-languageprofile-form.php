<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->
<h1>Language Profile</h1>
<div class="formGroup">
    <div class="formSection">
        <label>Language:</label><label><?php echo($language); ?></label>
    </div>

    <div class="divider"></div>

    <div class="formSection">
        <label>Home <br /> Spoken:</label>
        <label><b><?php if ($spokenAtHome) { echo('Yes'); } else { echo('No'); }?></b></label>
    </div>

    <div class="divider"></div>

    <div class="formSection">
        <label>High School:</label>
        <label><?php echo(htmlspecialchars($highSchool)); ?></label>
    </div>

    <div class="divider"></div>

    <div class="formSection">
        <label>Major:</label>
        <label><?php echo(htmlspecialchars($major)); ?></label>
    </div>

    <div class="divider"></div>
        
    <div class="formSection">
        <label>Jr High Experience:</label><label><?php echo($jrHighExp); ?></label>
    </div>

    <div class="divider"></div>

    <div class="formSection">
        <label>High School Experience:</label><label><?php echo($srHighExp); ?></label>
    </div>

    <div class="divider"></div>

    <div class="formSection">
        <label>College Experience:</label><label><?php echo($collegeExp); ?></label>
    </div>
    
    <br />
    
    <form action="<?php echo(GetControllerScript(MAINCONTROLLER_FILE, LANGUAGEPROFILEEDIT_ACTION)); ?>" method="post">
        <input type="hidden" name="<?php echo(LANGUAGEPROFILEID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($profileID)); ?>" />
        <input type="submit" value="Edit" />
    </form>
</div>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
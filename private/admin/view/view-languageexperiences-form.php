<?php
    include( HEADER_FILE );
    include( CONTROLPANEL_FILE );
?>
<!-- Start main content here -->
<h1>View Language Experiences</h1>

<div class="formGroup">
        <div class="formSection">
            <label>Name:</label>
            Spoken At Home
        </div>
        <div class="formSection">
            <label>Initial Level:</label>
            <?php echo(htmlspecialchars($spokenAtHomeInitLevel));?>
        </div>
        <?php
            $j = 0;
            foreach ($languageExperiences as $experience)
            {
        ?>
            <div class="divider"></div>
            <div class="formSection">
                <label>Name:</label>
                <?php echo(htmlspecialchars($experience->GetName())); ?>
            </div>
            <div class="formSection">
                <label>Level:</label>
                <?php echo(htmlspecialchars($experience->GetInitLevel())); ?>
            </div>
        <?php
                $j++;
            }
        ?>
        <br />
        
        <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEEXPERIENCESEDIT_ACTION)); ?>">
            Edit
        </a>
</div>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
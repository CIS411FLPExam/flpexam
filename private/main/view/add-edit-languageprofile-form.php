<?php
    include( HEADER_FILE );
?>
<?php if (isset($profileID)) { ?>
    <h1>Edit Profile</h1>
<?php } else { ?>
    <h1>Add Profile</h1>
<?php } ?>
<!-- Start main content here -->
<form action="<?php echo(GetControllerScript(MAINCONTROLLER_FILE, PROCESSLANGUAGEPROFILEADDEDIT_ACTION));?>" method="post">
    <?php if (isset($profileID)) { ?>
        <input type="hidden" name="<?php echo(LANGUAGEPROFILEID_IDENTIFIER) ?>" value="<?php echo(htmlspecialchars($profileID)); ?>" />
    <?php } ?>
    <?php if (isset($requestedPage)) { ?>
        <input type="hidden" name="<?php echo(REQUESTEDPAGE_IDENTIFIER); ?>" value="<?php echo($requestedPage); ?>" />
    <?php } ?>
    <div class="formGroup">
        <div class="formSection">
            <label>Language:</label>
            <?php if (isset($profileID)) { ?>
                <label><?php echo(htmlspecialchars($language)); ?></label>
            <?php } else {?>
                <select name="Language" class="formInput">
                    <?php foreach ($availableLanguages as $availableLanguage) { ?>
                    <option <?php if($language == $availableLanguage[NAME_IDENTIFIER]) { echo("selected='selected'"); } ?>>
                        <?php echo(htmlspecialchars($availableLanguage[NAME_IDENTIFIER])); ?>
                    </option>
                    <?php } ?>
                </select>
            <?php } ?>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Home Spoken:</label>
            <input name="SpokenAtHome" type="checkbox" <?php if($spokenAtHome) { echo('checked'); } ?> />
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Jr High Experience:</label>
            <select name="JrHighExp" class="formInput">
                <?php foreach ($experiences as $experience) { ?>
                <option <?php if($jrHighExp == $experience[NAME_IDENTIFIER]) { echo('selected'); } ?>>
                    <?php echo(htmlspecialchars($experience[NAME_IDENTIFIER])); ?>
                </option>
                <?php } ?>
            </select>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>High School Experience:</label>
            <select name="SrHighExp" class="formInput">
                <?php foreach ($experiences as $experience) { ?>
                <option <?php if($srHighExp == $experience[NAME_IDENTIFIER]) { echo('selected'); } ?>>
                    <?php echo(htmlspecialchars($experience[NAME_IDENTIFIER])); ?>
                </option>
                <?php } ?>
            </select>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>College Experience:</label>
            <select name="CollegeExp" class="formInput">
                <?php foreach ($experiences as $experience) { ?>
                <option <?php if($collegeExp == $experience[NAME_IDENTIFIER]) { echo('selected'); } ?>>
                    <?php echo(htmlspecialchars($experience[NAME_IDENTIFIER])); ?>
                </option>
                <?php } ?>
            </select>
        </div>
        
        <br />

        <input type="submit" value="Submit" />
    </div>
</form>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
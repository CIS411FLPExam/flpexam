<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->
<h1>Edit Language Experiences</h1>
<?php if ( isset($errors) && count($errors) > 0) {?>
    <h3><span class="redText">Errors on page.</span></h3>
<?php } ?>
<div class="formGroup">
    <form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, PROCESSLANGUAGEEXPERIENCESEDIT_ACTION)); ?>" method="post">
        <div class="formSection">
            <?php
                if (isset($errors['SpokenAtHomeInitLevel']))
                {
                    $message = 'Errors';
                    $collection = $errors['SpokenAtHomeInitLevel']->GetErrors();
                    include(MESSAGE_FILE);
                }
            ?>
            <label>Name<span class="redText">*</span>:</label>
            Spoken At Home
        </div>
        <div class="formSection">
            <label>Initial Level<span class="redText">*</span>:</label>
            <input name="SpokenAtHomeInitLevel" type="text" value="<?php echo(htmlspecialchars($spokenAtHomeInitLevel));?>" autofocus required min="1"/>
        </div>
        <?php
            $j = 0;
            foreach ($languageExperiences as $experience)
            {
        ?>
            <div class="divider"></div>
            <div class="formSection">
                <?php
                    if (isset($errors['Experience'. $j]))
                    {
                        $message = 'Errors';
                        $collection = $errors['Experience'. $j]->GetErrors();
                        include(MESSAGE_FILE);
                    }
                ?>
                <input type="hidden" name="<?php echo($experience->GetIdKey() . $j); ?>" value="<?php echo(htmlspecialchars($experience->GetId())); ?>" />
                <label>Name<span class="redText">*</span>:</label>
                <input type="text" name="<?php echo($experience->GetNameKey() . $j); ?>" value="<?php echo(htmlspecialchars($experience->GetName())); ?>" required maxlength="32" />
            </div>
            <div class="formSection">
                <label>Initial Level<span class="redText">*</span>:</label>
                <input type="text" name="<?php echo($experience->GetInitLevelKey() . $j); ?>" value="<?php echo(htmlspecialchars($experience->GetInitLevel())); ?>" required min="1"/>
            </div>
        <?php
                $j++;
            }
        ?>
        
        <input type="hidden" name="numListed" value="<?php echo(count($languageExperiences)); ?>" />
        
        <br />
        
        <input type="submit" value="Submit" />
    </form>
</div>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
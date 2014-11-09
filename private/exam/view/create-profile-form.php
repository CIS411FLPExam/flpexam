<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<?php
    if(isset($message))
    {
        include(MESSAGE_FILE);
    }
?>

<h1>Profile</h1>
<div class="formGroup">
    <form action="<?php echo(GetControllerScript(EXAMCONTROLLER_FILE, PROCESSPROFILECREATE_ACTION)) ?>" method="post">
        <div class="formSection">
            <label>First Name<span class="redText">*</span>:</label>
            <input name="<?php echo($profile->GetFirstNameIndex()); ?>" type="text" class="formInput" value="<?php echo(htmlspecialchars($profile->GetFirstName())); ?>" autofocus required maxlength="32"/>
            <div class="displayBox">(Your first name.)</div>
            <div class="clear"></div>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Last Name<span class="redText">*</span>:</label>
            <input name="<?php echo($profile->GetLastNameIndex()); ?>" type="text" class="formInput" value="<?php echo(htmlspecialchars($profile->GetLastName())); ?>" required maxlength="32" />
            <div class="displayBox">(Your last name.)</div>
            <div class="clear"></div>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Email<span class="redText">*</span>:</label>
            <input name="<?php echo($profile->GetEmailIndex()); ?>" type="email" class="formInput" value="<?php echo(htmlspecialchars($profile->GetEmail())); ?>" required maxlength="40" />
            <div class="displayBox">(An e-mail address that you can be contacted at.)</div>
            <div class="clear"></div>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Major:</label>
            <input name="<?php echo($profile->GetMajorIndex()); ?>" type="text" class="formInput" value="<?php echo(htmlspecialchars($profile->GetMajor())); ?>" maxlength="32" />
            <div class="displayBox">(The name of your current or desired college major.)</div>
            <div class="clear"></div>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>High School:</label>
            <input name="<?php echo($profile->GetHighSchoolIndex()); ?>" type="text" class="formInput" value="<?php echo(htmlspecialchars($profile->GetHighSchool())); ?>" maxlength="32"/>
            <div class="displayBox">(The name of your current or past high school.)</div>
            <div class="clear"></div>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <b>Is <?php echo(htmlspecialchars($language->GetName())); ?> spoken at home?<span class="redText">*</span></b>
            <input name="<?php echo($profile->GetSpokenAtHomeIndex()); ?>" type="radio" value="Y" <?php if ($profile->GetSpokenAtHome()) { echo('checked'); } ?> />Yes
            <input name="<?php echo($profile->GetSpokenAtHomeIndex()); ?>" type="radio" value="N" <?php if (!$profile->GetSpokenAtHome()) { echo('checked'); } ?> />No
        </div>
        
        <?php
            $leopairs = $profile->GetLeoPairs();
            foreach($languageExperiences as $le)
            {
                $leopair = new LEOPair();
                $experienceName = $le->GetName();
                $experienceDesc = $le->GetDescription();
                $options = $le->GetOptions();
                
                foreach($leopairs as $leo)
                {
                    if ($experienceName == $leo->GetExperienceName())
                    {
                        $leopair = $leo;
                        break;
                    }
                }
        ?>
        <div class="divider"></div>
        
        <div class="formSection">
            <label><?php echo(htmlspecialchars($experienceName)); ?><span class="redText">*</span>:</label>
            <select name="<?php echo(htmlspecialchars($leo->GetLEOPairKey())); ?>" class="formInput">
                <?php foreach ($options as $option) { ?>
                    <option <?php if ($option->GetName() == $leopair->GetOptionName()) { echo('selected="selected"'); } ?>>
                        <?php echo(htmlspecialchars($option->GetName())); ?>
                    </option>
                <?php } ?>
            </select>
            <div class="displayBox">(<?php echo(htmlspecialchars($experienceDesc)); ?>)</div>
            <div class="clear"></div>
        </div>
        <?php } ?>
        
        <br />
        
        <input type="submit" value="Submit" />
        
    </form>
</div>
<!-- End main content here -->
<?php
    include( PLAINFOOTER_FILE ); 
?>
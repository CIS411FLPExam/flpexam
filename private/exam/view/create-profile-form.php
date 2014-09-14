<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->
<h1>Profile</h1>
<div class="formGroup">
    <form action="<?php echo(GetControllerScript(EXAMCONTROLLER_FILE, PROCESSPROFILECREATE_ACTION)) ?>" method="post">
        <div class="formSection">
            <label>First Name:</label>
            <input name="<?php echo($profile->GetFirstNameIndex()); ?>" type="text" class="formInput" value="<?php echo(htmlspecialchars($profile->GetFirstName())); ?>" autofocus />
            (Your first name.)
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Last Name:</label>
            <input name="<?php echo($profile->GetLastNameIndex()); ?>" type="text" class="formInput" value="<?php echo(htmlspecialchars($profile->GetLastName())); ?>" />
            (Your last name.)
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Email:</label>
            <input name="<?php echo($profile->GetEmailIndex()); ?>" type="text" class="formInput" value="<?php echo(htmlspecialchars($profile->GetEmail())); ?>" />
            (An e-mail address that you can be contacted at.)
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Major:</label>
            <input name="<?php echo($profile->GetMajorIndex()); ?>" type="text" class="formInput" value="<?php echo(htmlspecialchars($profile->GetMajor())); ?>" />
            (The name of your major if you are attending college.)
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>High School:</label>
            <input name="<?php echo($profile->GetHighSchoolIndex()); ?>" type="text" class="formInput" value="<?php echo(htmlspecialchars($profile->GetHighSchool())); ?>" />
            (The name of your current or past high school.)
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <b>Do you speak <?php echo(htmlspecialchars($language->GetName())); ?> at home?</b>
            <input name="<?php echo($profile->GetSpokenAtHomeIndex()); ?>" type="radio" value="Y" />Yes
            <input name="<?php echo($profile->GetSpokenAtHomeIndex()); ?>" type="radio" value="N" checked />No
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Junior High Exp:</label>
            <select name="<?php echo($profile->GetJrHighExpIndex()); ?>" class="formInput">
                <?php foreach ($experiences as $experience) { ?>
                    <option <?php if ($experience == $profile->GetJrHighExp()) { echo('selected="selected"'); } ?>>
                        <?php echo(htmlspecialchars($experience)); ?>
                    </option>
                <?php } ?>
            </select>
            (The estimated amount of experience you have had with <?php echo(htmlspecialchars($language->GetName())); ?> in middle school.)
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>High School Exp:</label>
            <select name="<?php echo($profile->GetSrHighExpIndex()); ?>" class="formInput">
                <?php foreach ($experiences as $experience) { ?>
                    <option <?php if ($experience == $profile->GetSrHighExp()) { echo('selected="selected"'); } ?>>
                        <?php echo(htmlspecialchars($experience)); ?>
                    </option>
                <?php } ?>
            </select>
            (The estimated amount of experience you have had with <?php echo(htmlspecialchars($language->GetName())); ?> in high school.)
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>College Exp:</label>
            <select name="<?php echo($profile->GetCollegeExpIndex()); ?>" class="formInput">
                <?php foreach ($experiences as $experience) { ?>
                    <option <?php if ($experience == $profile->GetCollegeExp()) { echo('selected="selected"'); } ?>>
                        <?php echo(htmlspecialchars($experience)); ?>
                    </option>
                <?php } ?>
            </select>
            (The estimated amount of experience you have had with <?php echo(htmlspecialchars($language->GetName())); ?> in college.)
        </div>
        
        <br />
        
        <input type="submit" value="Submit" />
        
    </form>
</div>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
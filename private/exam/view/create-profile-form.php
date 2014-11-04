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
            (Your first name.)
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Last Name<span class="redText">*</span>:</label>
            <input name="<?php echo($profile->GetLastNameIndex()); ?>" type="text" class="formInput" value="<?php echo(htmlspecialchars($profile->GetLastName())); ?>" required maxlength="32" />
            (Your last name.)
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Email<span class="redText">*</span>:</label>
            <input name="<?php echo($profile->GetEmailIndex()); ?>" type="email" class="formInput" value="<?php echo(htmlspecialchars($profile->GetEmail())); ?>" required maxlength="40" />
            (An e-mail address that you can be contacted at.)
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Major:</label>
            <input name="<?php echo($profile->GetMajorIndex()); ?>" type="text" class="formInput" value="<?php echo(htmlspecialchars($profile->GetMajor())); ?>" maxlength="32" />
            (The name of your major if you are attending college.)
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>High School:</label>
            <input name="<?php echo($profile->GetHighSchoolIndex()); ?>" type="text" class="formInput" value="<?php echo(htmlspecialchars($profile->GetHighSchool())); ?>" maxlength="32"/>
            (The name of your current or past high school.)
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <b>Is <?php echo(htmlspecialchars($language->GetName())); ?> spoken at home?<span class="redText">*</span></b>
            <input name="<?php echo($profile->GetSpokenAtHomeIndex()); ?>" type="radio" value="Y" />Yes
            <input name="<?php echo($profile->GetSpokenAtHomeIndex()); ?>" type="radio" value="N" checked />No
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Junior High Exp<span class="redText">*</span>:</label>
            <select name="<?php echo($profile->GetJrHighExpIndex()); ?>" class="formInput">
                <?php foreach ($experiences as $experience) { ?>
                    <option <?php if ($experience == $profile->GetJrHighExp()) { echo('selected="selected"'); } ?>>
                        <?php echo(htmlspecialchars($experience)); ?>
                    </option>
                <?php } ?>
            </select>
            <div class="displayBox">(The estimated amount of experience you have had with <?php echo(htmlspecialchars($language->GetName())); ?> in middle school.)</div>
            <div class="clear"></div>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>High School Exp<span class="redText">*</span>:</label>
            <select name="<?php echo($profile->GetSrHighExpIndex()); ?>" class="formInput">
                <?php foreach ($experiences as $experience) { ?>
                    <option <?php if ($experience == $profile->GetSrHighExp()) { echo('selected="selected"'); } ?>>
                        <?php echo(htmlspecialchars($experience)); ?>
                    </option>
                <?php } ?>
            </select>
            <div class="displayBox">(The estimated amount of experience you have had with <?php echo(htmlspecialchars($language->GetName())); ?> in high school.)</div>
            <div class="clear"></div>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>College Exp<span class="redText">*</span>:</label>
            <select name="<?php echo($profile->GetCollegeExpIndex()); ?>" class="formInput">
                <?php foreach ($experiences as $experience) { ?>
                    <option <?php if ($experience == $profile->GetCollegeExp()) { echo('selected="selected"'); } ?>>
                        <?php echo(htmlspecialchars($experience)); ?>
                    </option>
                <?php } ?>
            </select>
            <div class="displayBox">(The estimated amount of experience you have had with <?php echo(htmlspecialchars($language->GetName())); ?> in college.)</div>
            <div class="clear"></div>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Current Course<span class="redText">*</span>:</label>
            <select name="<?php echo($profile->GetCurrentCourseIndex()); ?>" class="formInput">
                <?php foreach ($courses as $course) { ?>
                    <option <?php if ($course[NAME_IDENTIFIER] == $profile->GetCurrentCourse()) { echo('selected="selected"'); } ?>>
                        <?php echo(htmlspecialchars($course[NAME_IDENTIFIER])); ?>
                    </option>
                <?php } ?>
            </select>
            <div class="displayBox">(The <?php echo(htmlspecialchars($language->GetName())); ?> class you are currently enrolled in.)</div>
            <div class="clear"></div>
        </div>
        
        <br />
        
        <input type="submit" value="Submit" />
        
    </form>
</div>
<!-- End main content here -->
<?php
    include( PLAINFOOTER_FILE ); 
?>
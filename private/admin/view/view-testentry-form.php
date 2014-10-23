<?php
    include(HEADER_FILE);
    include(CONTROLPANEL_FILE);
?>
<!-- Start main content here -->
<h1>Test Entry</h1>
<?php if (userIsAuthorized(TESTVIEW_ACTION)) { ?>
    <div class="formGroup">

            <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, TESTVIEW_ACTION)); ?>" method="post">
                <input type="hidden" name="<?php echo(TESTID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($testID)); ?>" />
                <input type="submit" value="View Test" />
            </form>

    </div>
<?php } ?>
<div class="infoSectionCntnr">
    <div class="infoSection">
        <h3>Student Info</h3>

        <div class="formSection">
            <label>Name:</label>
            <div class="infoDisplayBox"><?php echo(htmlspecialchars($testInfo->GetFirstName() . ' ' . $testInfo->GetLastName())); ?></div>
            <div class="clear"></div>
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>Email:</label>
            <div class="infoDisplayBox"><?php echo(htmlspecialchars($testInfo->GetEmail())); ?></div>
            <div class="clear"></div>
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>Major:</label>
            <div class="infoDisplayBox"><?php echo(htmlspecialchars($testInfo->GetMajor())); ?></div>
            <div class="clear"></div>
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>High School:</label>
            <div class="infoDisplayBox"><?php echo(htmlspecialchars($testInfo->GetHighSchool())); ?></div>
            <div class="clear"></div>
        </div>
    </div>

    <div class="infoSection">
        <h3>Language Experience</h3>

        <div class="formSection">
            <label>Spoken At Home:</label>
            <?php if($testInfo->GetSpokenAtHome() == TRUE) { ?>
                Yes
            <?php } else { ?>
                No
            <?php }?>
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>Junior High Exp:</label>
            <?php echo(htmlspecialchars($testInfo->GetJrHighExp())); ?>
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>High School Exp:</label>
            <?php echo(htmlspecialchars($testInfo->GetSrHighExp())); ?>
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>College Exp:</label>
            <?php echo(htmlspecialchars($testInfo->GetCollegeExp())); ?>
        </div>
        
        <div class="divider"></div>

        <div class="formSection">
            <label>Current Course:</label>
            <?php echo(htmlspecialchars($testInfo->GetCurrentCourse())); ?>
        </div>

    </div>

    <div class="infoSection">
        <h3>Test Results</h3>

        <div class="formSection">
            <label>Score:</label>
            <?php echo(htmlspecialchars($testInfo->GetScore())); ?>
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>Language:</label>
            <?php echo(htmlspecialchars($testInfo->GetLanguage())); ?>
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>Date Submitted:</label>
            <?php echo(htmlspecialchars($testInfo->GetDate())); ?>
        </div>
    </div>
</div>

<div class="clear"></div>
<!-- End main content here -->
<?php
    include(FOOTER_FILE); 
?>
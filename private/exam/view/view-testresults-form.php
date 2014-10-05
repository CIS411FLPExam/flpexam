<?php
    include(HEADER_FILE);
?>
<!--Start main content-->
<h1>Test Results</h1>
<div class="formGroup">
        <h3>Test Info</h3>
        <h4>Thank you taking Clarion University's <?php echo(htmlspecialchars($languageName)); ?> placement test!</h4>
        <?php if ($levelInfoID > 0) { ?>
            <div class="divider"></div>
            
            <div class="formSection">
                <label>Level Name:</label>
                <div class="displayBox"><?php echo(htmlspecialchars($levelInfo->GetName())); ?></div>
                <div class="clear"></div>
            </div>

            <div class='divider'></div>

            <div class="formSection">
                <label>Course Name:</label>
                <div class="displayBox"><?php echo(htmlspecialchars($levelInfo->GetCourse())); ?></div>
                <div class="clear"></div>
            </div>

            <?php if (!empty($levelInfo->GetDescription())) { ?>
                <div class='divider'></div>

                <div class="formSection">
                    <label>Level Description:</label>
                    <div class="displayBox"><?php echo(htmlspecialchars($levelInfo->GetDescription())); ?></div>
                    <div class="clear"></div>
                </div>
            <?php } ?>
    <?php } ?>
    <?php if ($contact->GetId() > 0) { ?>
        <br />
        <p>
            Contact &nbsp; <b><?php echo(htmlspecialchars($contact->GetFirstName()) . ' ' . htmlspecialchars($contact->GetLastName())); ?></b>
             &nbsp; at &nbsp; <b><?php echo(htmlspecialchars($contact->GetEmail())); ?></b>
             &nbsp; for more information.
        </p>
    <?php } ?>
</div>

<!--End main content-->
<?php
    include(FOOTER_FILE);
?>
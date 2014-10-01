<?php
    include(HEADER_FILE);
?>
<!--Start main content-->
<h1>Test Results</h1>
<div class="formGroup">
        <h3>Test Info</h3>

        <div class="formSection">
            <label>Score:</label>
            <?php echo(htmlspecialchars($score)); ?>
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>Language:</label>
            <?php echo(htmlspecialchars($languageName)); ?>
        </div>
        <?php if ($levelInfoID > 0) { ?>
            <h3>Level Info</h3>

            <div class="formSection">
                <label>Name:</label>
                <?php echo(htmlspecialchars($levelInfo->GetName())); ?>
            </div>

            <div class='divider'></div>

            <div class="formSection">
                <label>Course Name:</label>
                <?php echo(htmlspecialchars($levelInfo->GetCourse())); ?>
            </div>

            <?php if (!empty($levelInfo->GetDescription())) { ?>
                <div class='divider'></div>

                <div class="formSection">
                    <label>Description:</label>
                    <?php echo(htmlspecialchars($levelInfo->GetDescription())); ?>
                </div>
            <?php } ?>
    <?php } ?>
    <?php if ($contact->GetId() > 0) { ?>
    <p>
        Contact <b><?php echo(htmlspecialchars($contact->GetFirstName()) . htmlspecialchars($contact->GetLastName())); ?></b>
        at <b><?php echo(htmlspecialchars($contact->GetEmail())); ?></b>
        for more information.
    </p>
</div>
<?php } ?>
<!--End main content-->
<?php
    include(FOOTER_FILE);
?>
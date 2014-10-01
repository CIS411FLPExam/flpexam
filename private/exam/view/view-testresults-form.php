<?php
    include(HEADER_FILE);
?>
<!--Start main content-->
<h1>Test Results</h1>
<div class="infoSectionCntnr">
    <div class="infoSection">
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
    </div>

    <?php if ($levelInfoID > 0) { ?>
        <div class="infoSection">
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
        </div>
    <?php } ?>
</div>

<div class="clear"></div>

<?php if ($contact->GetId() > 0) { ?>
    <p>
        Contact <?php echo(htmlspecialchars($contact->GetFirstName()) . htmlspecialchars($contact->GetLastName())); ?>
        at <?php echo(htmlspecialchars($contact->GetEmail())); ?>
        for more information.
    </p>
<?php } ?>
<!--End main content-->
<?php
    include(FOOTER_FILE);
?>
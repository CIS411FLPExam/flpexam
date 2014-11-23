<?php
    include(GetHeaderFile());
?>
<!--Start main content-->
<div class="formGroup">
    <h1>Contact Us</h1>
    <?php if ($contact->GetId() > 0) { ?>
        <p>
             Send an e-mail to &nbsp; <b><?php echo(htmlspecialchars($contact->GetFirstName()) . ' ' . htmlspecialchars($contact->GetLastName())); ?></b>
             &nbsp; at &nbsp; <a href="mailto:<?php echo(htmlspecialchars($contact->GetEmail())); ?>?Subject=Foreign%20Language%20Placement%20Exam%20Site" target="_top"><b><?php echo(htmlspecialchars($contact->GetEmail())); ?></b></a>
             &nbsp; for more information.
        </p>
    <?php } ?>
</div>
<!--End main content-->
<?php
    include(GetFooterFile());
?>
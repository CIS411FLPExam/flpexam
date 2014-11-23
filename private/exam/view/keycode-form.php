<?php
    include( GetHeaderFile() );
?>
<!-- Start main content here -->

<h1>Test Clearance</h1>

<div class="formGroup">
    <form action="<?php echo(GetControllerScript(GetExamControllerFile(), GetProcessKeyCodeAction()));?>" method="post">
        <div class="formSection">
            <label>Enter Key Code:</label>
            <input name="KeyCode"  type="password" class="formInput" autofocus />
            <div class="clear"></div>
        </div>
        
        <input type="submit" value="Submit" />
    </form>
</div>

<?php if(isset($contact) && $contact->GetId() > 0) { ?>
    <h3 class="redText">Invalid key code.</h3>
    <ul>
        <li>
            Contact &nbsp; <b><?php echo(htmlspecialchars($contact->GetFirstName()) . ' ' . htmlspecialchars($contact->GetLastName())); ?></b>
            &nbsp; at &nbsp; <a href="mailto:<?php echo(htmlspecialchars($contact->GetEmail())); ?>?Subject=Foreign%20Language%20Placement%20Exam%20Site" target="_top"><b><?php echo(htmlspecialchars($contact->GetEmail())); ?></b></a>
            &nbsp; for permissions.
        </li>
    </ul>
 <?php } ?>

<!-- End main content here -->
<?php
    include( GetPlainFooterFile() );
?>
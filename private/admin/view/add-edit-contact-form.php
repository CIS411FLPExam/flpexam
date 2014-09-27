<?php
    include(HEADER_FILE);
?>
<!--Start main content-->

<?php
    if (isset($message))
    {
        include(MESSAGE_FILE);
    }
?>

<div class="formGroup">
    <?php if(isset($contactID)) { ?>
        <h1>Edit Contact</h1>
    <?php } else { ?>
        <h1>Add Contact</h1>
    <?php } ?>
    
    <form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, PROCESSCONTACTADDEDIT_ACTION)); ?>" method="post">
        <?php if(isset($contactID)) { ?>
            <input type="hidden" name="<?php echo($contact->GetIdIndex()); ?>" value="<?php echo(htmlspecialchars($contactID)); ?>" />
        <?php } ?>
        <div class="formSection">
            <label>First Name:</label>
            <input name="<?php echo($contact->GetFirstNameIndex()); ?>" type="text" class="formInput" value="<?php echo(htmlspecialchars($contact->GetFirstName())); ?>" autofocus required maxlength="32" />
            (The contact's first name.)
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Last Name:</label>
            <input name="<?php echo($contact->GetLastNameIndex()); ?>" type="text" class="formInput" value="<?php echo(htmlspecialchars($contact->GetLastName())); ?>" required maxlength="32" />
            (The contact's last name.)
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Email:</label>
            <input name="<?php echo($contact->GetEmailIndex()); ?>" type="email" class="formInput" value="<?php echo(htmlspecialchars($contact->GetEmail())); ?>" required maxlength="40" />
            (An e-mail address that the contact can be reached at.)
        </div>
        
        <br />
        
        <input type="submit" value="Submit" />
    </form>
</div>

<!--End main content-->
<?php
    include(FOOTER_FILE);
?>
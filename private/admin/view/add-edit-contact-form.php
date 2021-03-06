<?php
    include(GetHeaderFile());
?>
<!--Start main content-->

<?php
    if (isset($message))
    {
        include(GetMessageFile());
    }
?>
<?php if(isset($contactID)) { ?>
    <h1>Edit Contact</h1>
<?php } else { ?>
    <h1>Add Contact</h1>
<?php } ?>
<div class="formGroup">
    <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetProcessContactAddEditAction())); ?>" method="post">
        <?php if(isset($contactID)) { ?>
            <input type="hidden" name="<?php echo($contact->GetIdIndex()); ?>" value="<?php echo(htmlspecialchars($contactID)); ?>" />
        <?php } ?>
        <div class="formSection">
            <label>First Name<span class="redText">*</span>:</label>
            <input name="<?php echo($contact->GetFirstNameIndex()); ?>" type="text" class="formInput" value="<?php echo(htmlspecialchars($contact->GetFirstName())); ?>" autofocus required maxlength="32" />
            (The contact's first name.)
            <div class="clear"></div>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Last Name<span class="redText">*</span>:</label>
            <input name="<?php echo($contact->GetLastNameIndex()); ?>" type="text" class="formInput" value="<?php echo(htmlspecialchars($contact->GetLastName())); ?>" required maxlength="32" />
            (The contact's last name.)
            <div class="clear"></div>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Email<span class="redText">*</span>:</label>
            <input name="<?php echo($contact->GetEmailIndex()); ?>" type="email" class="formInput" value="<?php echo(htmlspecialchars($contact->GetEmail())); ?>" required maxlength="40" />
            (An e-mail address that the contact can be reached at.)
            <div class="clear"></div>
        </div>
        
        <br />
        
        <input type="submit" value="Submit" />
    </form>
    <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageContactsAction())); ?>" method="post">
        <input type="submit" value="Cancel" />
    </form>
</div>

<!--End main content-->
<?php
    include(GetFooterFile());
?>
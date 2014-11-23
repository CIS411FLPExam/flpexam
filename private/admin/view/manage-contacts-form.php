<?php
    include(GetHeaderFile());
    include(GetControlPanelFile());
?>
<!--Start main content-->

<h1>Contacts</h1>

<?php
    $userCanAdd = userIsAuthorized(GetContactAddAction());
    $userCanEdit = userIsAuthorized(GetContactEditAction());
    $userCanDelete = userIsAuthorized(GetContactDeleteAction());
?>

<?php if($userCanAdd) { ?>
    <form action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetContactAddAction())); ?>" method="post">
        <input type="submit" value="Add Contact" />
    </form>

    <br />
<?php } ?>

<?php if(count($contacts) > 0) { ?>
    <form onsubmit="return ConfirmationPrompt('Delete the selected contacts?');" action="<?php echo( GetControllerScript(GetAdminControllerFile(), GetContactDeleteAction() ) ); ?>" method="post">
        <div class="datatable">
            <table id="contacts" class="tablesorter">
                <thead>
                    <tr>
                        <th><b>First Name</b></th>
                        <th><b>Last Name</b></th>
                        <th>Primary</th>
                        <?php if ($userCanEdit) { ?><th></th><?php } ?>
                        <?php if ($userCanDelete) { ?><th></th><?php } ?>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $j = 0;
                        foreach ($contacts as $contact)
                        {
                            $contactID = $contact->GetId();
                            $firstName = $contact->GetFirstName();
                            $lastName = $contact->GetLastName();
                            $active = $contact->GetPrimary();
                    ?>
                    <tr>
                        <td><?php echo(htmlspecialchars($firstName)); ?></td>
                        <td><?php echo(htmlspecialchars($lastName)); ?></td>
                        <td class="centerText">
                            <?php if($active == TRUE) { ?>
                                Yes
                            <?php } else if ($userCanEdit) { ?>
                                <input type="button" value="Activate" onclick="Relocate('<?php echo(GetControllerScript(GetAdminControllerFile(), GetContactActivateAction() . "&". GetContactsIdIdentifier() . "=" . urlencode($contactID))); ?>');" />
                            <?php } else { ?>
                                    No
                            <?php } ?>
                        </td>
                        <?php if ($userCanEdit) { ?>
                            <td>
                                <input type="button" value="Edit" onclick="Relocate('<?php echo(GetControllerScript(GetAdminControllerFile(), GetContactEditAction() . "&". GetContactsIdIdentifier() . "=" . urlencode($contactID))); ?>');" />
                            </td>
                        <?php } ?>
                        <?php if ($userCanDelete) { ?>
                            <td class="centerText">
                                <input type="checkbox" name="record<?php echo($j); ?>" value="<?php echo(htmlspecialchars($contactID)); ?>" />
                            </td>
                        <?php } ?>
                    </tr>
                    <?php
                            ++$j;
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <input type="hidden" name="numListed" value="<?php echo count($contacts); ?>" />
        <?php if ($userCanDelete) { ?>
                <br />
                <input type="submit" value="Delete Selected" />
                <input type="button" value="Select All" onclick="CheckAll();" />
        <?php } ?>
    </form>
<?php } else { ?>
    <h3>No contacts found.</h3>
<?php } ?>
<!-- End main content here -->
<?php
    include( GetFooterFile() ); 
?>
<script>
    $( document ).ready( function( ) 
    { 
        $( "#contacts" ).tablesorter( ); 
    });   
</script>
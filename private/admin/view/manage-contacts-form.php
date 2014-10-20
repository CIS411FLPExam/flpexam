<?php
    include(HEADER_FILE);
    include(CONTROLPANEL_FILE);
?>
<!--Start main content-->

<h1>Contacts</h1>

<?php
    $userCanAdd = userIsAuthorized(CONTACTADD_ACTION);
    $userCanEdit = userIsAuthorized(CONTACTEDIT_ACTION);
    $userCanDelete = userIsAuthorized(CONTACTDELETE_ACTION);
?>

<?php if($userCanAdd) { ?>
    <form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, CONTACTADD_ACTION)); ?>" method="post">
        <input type="submit" value="Add Contact" />
    </form>

    <br />
<?php } ?>

<?php if(count($contacts) > 0) { ?>
    <form action="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, CONTACTDELETE_ACTION ) ); ?>" method="post">
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
                        <?php if ($userCanEdit) { ?>
                            <td>
                                <?php if($active == TRUE) { ?>
                                    Yes
                                <?php } else if ($userCanEdit) { ?>
                                    <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, CONTACTACTIVATE_ACTION . "&". CONTACTID_IDENTIFIER . "=" . urldecode($contactID))); ?>">
                                        Activate
                                    </a>
                                <?php } else { ?>
                                        No
                                <?php } ?>
                            </td>
                        <?php } ?>
                        <?php if ($userCanEdit) { ?>
                            <td>
                                <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, CONTACTEDIT_ACTION . "&". CONTACTID_IDENTIFIER . "=" . urldecode($contactID))); ?>">
                                    Edit
                                </a>
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
        <?php } ?>
    </form>
<?php } else { ?>
    <h3>No contacts found.</h3>
<?php } ?>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
<script>
    $( document ).ready( function( ) 
    { 
        $( "#contacts" ).tablesorter( ); 
    });   
</script>
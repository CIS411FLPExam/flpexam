<?php
    include(HEADER_FILE);
    include(CONTROLPANEL_FILE);
?>
<!--Start main content-->

<?php
    $userCanAdd = userIsAuthorized(LANGUAGEEXPERIENCESADD_ACTION);
    $userCanView = userIsAuthorized(LANGUAGEEXPERIENCESVIEW_ACTION);
    $userCanEdit = userIsAuthorized(LANGUAGEEXPERIENCESEDIT_ACTION);
    $userCanDelete = userIsAuthorized(LANGUAGEEXPERIENCESDELETE_ACTION);
    $userCanManageOptions = userIsAuthorized(MANAGEEXPERIENCEOPTIONS_ACTION);
?>

<h1>Language Experiences</h1>

<?php if ($userCanAdd) { ?>
    <form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEEXPERIENCESADD_ACTION)); ?>" method="post">
        <input type="submit" value="Add Experience" />
    </form>
<?php } ?>
<div class="formGroup">
    <?php if (count($experiences) > 0) { ?>
        <form onsubmit="return ConfirmationPrompt('Delete the selected language experiences?');" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEEXPERIENCESDELETE_ACTION)); ?>" method="post">
            <div class="datatable">
                <table id="experiences" class="tablesorter">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <?php if ($userCanManageOptions) { ?><th></th><?php } ?>
                            <?php if ($userCanView) { ?><th></th><?php } ?>
                            <?php if ($userCanEdit) { ?><th></th><?php } ?>
                            <?php if ($userCanDelete) { ?><th></th><?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $j = 0;
                            foreach ($experiences as $experience)
                            {
                                $id = $experience->GetId();
                                $name = $experience->GetName();
                        ?>
                            <tr>
                                <td><?php echo(htmlspecialchars($name)); ?></td>
                                <?php if ($userCanManageOptions) { ?>
                                    <td class="centerText">
                                        <input type="button" value="Options" onclick="Relocate('<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEEXPERIENCEOPTIONS_ACTION) . '&' . LANGUAGEEXPERIENCEID_IDENTIFIER . '=' . urlencode($id)); ?>');" />
                                    </td>
                                <?php } ?>
                                <?php if ($userCanView) { ?>
                                    <td class="centerText">
                                        <input type="button" value="View" onclick="Relocate('<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEEXPERIENCESVIEW_ACTION) . '&' . LANGUAGEEXPERIENCEID_IDENTIFIER . '=' . urlencode($id));?>');" />
                                    </td>
                                <?php } ?>
                                <?php if ($userCanEdit) { ?>
                                    <td class="centerText">
                                        <input type="button" value="Edit" onclick="Relocate('<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEEXPERIENCESEDIT_ACTION) . '&' . LANGUAGEEXPERIENCEID_IDENTIFIER . '=' . urlencode($id));?>');" />
                                    </td>
                                <?php } ?>
                                <?php if ($userCanDelete) { ?>
                                    <td class="centerText">
                                        <input type="checkbox" name="record<?php echo($j); ?>" value="<?php echo(htmlspecialchars($id)); ?>" />
                                    </td>
                                <?php } ?>
                            </tr>
                            <?php
                                    $j++;
                                }
                            ?>
                    </tbody>
                </table>
            </div>
            <input type="hidden" name="numListed" value="<?php echo count($experiences); ?>" />
            <?php if ($userCanDelete) { ?>
                <br />
                <input type="submit" value="Delete Selected" />
                <input type="button" value="Select All" onclick="CheckAll();" />
            <?php } ?>
        </form>
    <?php } else { ?>
        <h3>No language experiences found.</h3>
    <?php } ?>
</div>

<!--End main content-->
<?php
    include(FOOTER_FILE);
?>
<script>
    $( document ).ready( function( ) 
    { 
        $( "#experiences" ).tablesorter( ); 
    });   
</script>
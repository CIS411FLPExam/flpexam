<?php
    include(HEADER_FILE);
    include(CONTROLPANEL_FILE);
?>
<!--Start main content-->

<?php
    $userCanAdd = userIsAuthorized(EXPERIENCEOPTIONADD_ACTION);
    $userCanView = userIsAuthorized(EXPERIENCEOPTIONVIEW_ACTION);
    $userCanEdit = userIsAuthorized(EXPERIENCEOPTIONEDIT_ACTION);
    $userCanDelete = userIsAuthorized(EXPERIENCEOPTIONDELETE_ACTION);
?>

<h1><?php echo(htmlspecialchars($experienceName)); ?> Experience Options</h1>

<?php if ($userCanAdd) { ?>
    <form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, EXPERIENCEOPTIONADD_ACTION)); ?>" method="post">
        <input type="hidden" name="<?php echo(LANGUAGEEXPERIENCEID_IDENTIFIER) ?>" value="<?php echo(htmlspecialchars($experienceID)); ?>" />
        <input type="submit" value="Add Option" />
    </form>

    <br />
<?php } ?>
<div class="formGroup">
    <?php if (count($options) > 0) { ?>
        <form onsubmit="return ConfirmationPrompt('Delete the selected experience options?');" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, EXPERIENCEOPTIONDELETE_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(LANGUAGEEXPERIENCEID_IDENTIFIER) ?>" value="<?php echo(htmlspecialchars($experienceID)); ?>" />
            <div class="datatable">
                <table id="options" class="tablesorter">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Initial&nbsp;Level</th>
                            <?php if ($userCanView) { ?><th></th><?php } ?>
                            <?php if ($userCanEdit) { ?><th></th><?php } ?>
                            <?php if ($userCanDelete) { ?><th></th><?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $j = 0;
                            foreach ($options as $option)
                            {
                                $id = $option->GetId();
                                $name = $option->GetName();
                                $initLevel = $option->GetInitLevel();
                        ?>
                            <tr>
                                <td><?php echo(htmlspecialchars($name)); ?></td>
                                <td class="centerText"><?php echo(htmlspecialchars($initLevel)); ?></td>
                                <?php if ($userCanView) { ?>
                                    <td class="centerText">
                                        <input type="button" value="View" onclick="Relocate('<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, EXPERIENCEOPTIONVIEW_ACTION) . '&' . EXPERIENCEOPTIONID_IDENTIFIER . '=' . urlencode($id));?>');" />
                                    </td>
                                <?php } ?>
                                <?php if ($userCanEdit) { ?>
                                    <td class="centerText">
                                        <input type="button" value="Edit" onclick="Relocate('<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, EXPERIENCEOPTIONEDIT_ACTION) . '&' . EXPERIENCEOPTIONID_IDENTIFIER . '=' . urlencode($id));?>');" />
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
            <input type="hidden" name="numListed" value="<?php echo count($options); ?>" />
            <?php if ($userCanDelete) { ?>
                <br />
                <input type="submit" value="Delete Selected" />
                <input type="button" value="Select All" onclick="CheckAll();" />
            <?php } ?>
        </form>
    <?php } else { ?>
        <h3>No experience options found.</h3>
    <?php } ?>
</div>

<!--End main content-->
<?php
    include(FOOTER_FILE);
?>
<script>
    $( document ).ready( function( ) 
    { 
        $( "#options" ).tablesorter( ); 
    });   
</script>
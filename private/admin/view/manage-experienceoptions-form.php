<?php
    include(GetHeaderFile());
    include(GetControlPanelFile());
?>
<!--Start main content-->

<?php
    $userCanAdd = userIsAuthorized(GetExperienceOptionAddAction());
    $userCanView = userIsAuthorized(GetExperienceOptionViewAction());
    $userCanEdit = userIsAuthorized(GetExperienceOptionEditAction());
    $userCanDelete = userIsAuthorized(GetExperienceOptionDeleteAction());
?>

<h1><?php echo(htmlspecialchars($experienceName)); ?> Experience Options</h1>

<?php if ($userCanAdd) { ?>
    <form action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetExperienceOptionAddAction())); ?>" method="post">
        <input type="hidden" name="<?php echo(GetLanguageExperienceIdIdentifier()) ?>" value="<?php echo(htmlspecialchars($experienceID)); ?>" />
        <input type="submit" value="Add Option" />
    </form>

    <br />
<?php } ?>
<div class="formGroup">
    <?php if (count($options) > 0) { ?>
        <form onsubmit="return ConfirmationPrompt('Delete the selected experience options?');" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetExperienceOptionDeleteAction())); ?>" method="post">
            <input type="hidden" name="<?php echo(GetLanguageExperienceIdIdentifier()) ?>" value="<?php echo(htmlspecialchars($experienceID)); ?>" />
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
                                        <input type="button" value="View" onclick="Relocate('<?php echo(GetControllerScript(GetAdminControllerFile(), GetExperienceOptionViewAction()) . '&' . GetExperienceOptionIdIdentifier() . '=' . urlencode($id));?>');" />
                                    </td>
                                <?php } ?>
                                <?php if ($userCanEdit) { ?>
                                    <td class="centerText">
                                        <input type="button" value="Edit" onclick="Relocate('<?php echo(GetControllerScript(GetAdminControllerFile(), GetExperienceOptionEditAction()) . '&' . GetExperienceOptionIdIdentifier() . '=' . urlencode($id));?>');" />
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
    include(GetFooterFile());
?>
<script>
    $( document ).ready( function( ) 
    { 
        $( "#options" ).tablesorter( ); 
    });   
</script>
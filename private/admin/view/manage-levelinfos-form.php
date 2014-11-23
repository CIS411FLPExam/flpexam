<?php
    include(GetHeaderFile());
    include(GetControlPanelFile());
?>
<!--Start main content-->

<?php
    $userCanAdd = userIsAuthorized(GetLevelInfoAddAction());
    $userCanView = userIsAuthorized(GetLevelInfoViewAction());
    $userCanEdit = userIsAuthorized(GetLevelInfoEditAction());
    $userCanDelete = userIsAuthorized(GetLevelInfoDeleteAction());
?>

<h1><?php echo(htmlspecialchars($languageName)); ?> Level Information</h1>

<?php if ($userCanAdd) { ?>
    <div class="formGroup">
        <form action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetLevelInfoAddAction())); ?>" method="post">
            <input type="hidden" name="<?php echo(GetLanguageIdIdentifier()); ?>" value="<?php echo(htmlspecialchars($languageID)); ?>" />
            <input type="submit" value="Add Level Info" />
        </form>
    </div>
<?php } ?>

<div class="formGroup">
    <?php if (count($levelinfos) > 0) { ?>
        <form onsubmit="return ConfirmationPrompt('Delete the selected level\'s information?');" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetLevelInfoDeleteAction())); ?>" method="post">
            <input type="hidden" name="<?php echo(GetLanguageIdIdentifier()); ?>" value="<?php echo(htmlspecialchars($languageID)); ?>" />
            <div class="datatable">
                <table id="levelInfos" class="tablesorter">
                    <thead>
                        <tr>
                            <th>Level</th>
                            <th>Name</th>
                            <?php if ($userCanView) { ?><th></th><?php } ?>
                            <?php if ($userCanEdit) { ?><th></th><?php } ?>
                            <?php if ($userCanDelete) { ?><th></th><?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $j = 0;
                            foreach ($levelinfos as $levelInfo)
                            {
                        ?>
                            <tr>
                                <td class="centerText"><?php echo(htmlspecialchars($levelInfo->GetLevel())); ?></td>
                                <td><?php echo(htmlspecialchars($levelInfo->GetName())); ?></td>
                                <?php if ($userCanView) { ?>
                                    <td class="centerText">
                                        <input type="button" value="View" onclick="Relocate('<?php echo(GetControllerScript(GetAdminControllerFile(), GetLevelInfoViewAction()) . '&' . GetLevelInfoIdIdentifier() . '=' . htmlspecialchars($levelInfo->GetId()));?>');" />
                                    </td>
                                <?php } ?>
                                <?php if ($userCanEdit) { ?>
                                    <td class="centerText">
                                        <input type="button" value="Edit" onclick="Relocate('<?php echo(GetControllerScript(GetAdminControllerFile(), GetLevelInfoEditAction()) . '&' . GetLevelInfoIdIdentifier() . '=' . htmlspecialchars($levelInfo->GetId()));?>');" />
                                    </td>
                                <?php } ?>
                                <?php if ($userCanDelete) { ?>
                                    <td class="centerText">
                                        <input type="checkbox" name="record<?php echo($j); ?>" value="<?php echo(htmlspecialchars($levelInfo->GetId())); ?>" />
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
            <input type="hidden" name="numListed" value="<?php echo count($levelinfos); ?>" />
            <?php if ($userCanDelete) { ?>
                <br />
                <input type="submit" value="Delete Selected" />
                <input type="button" value="Select All" onclick="CheckAll();" />
            <?php } ?>
        </form>
    <?php } else { ?>
        <h3>No level information found.</h3>
    <?php } ?>
</div>

<!--End main content-->
<?php
    include(GetFooterFile());
?>

<script>
    $( document ).ready( function( ) 
    { 
        $( "#levelInfos" ).tablesorter( ); 
    });   
</script>
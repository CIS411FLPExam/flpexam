<?php
    include(HEADER_FILE);
    include(CONTROLPANEL_FILE);
?>
<!--Start main content-->

<?php
    $userCanAdd = userIsAuthorized(LEVELINFOADD_ACTION);
    $userCanView = userIsAuthorized(LEVELINFOVIEW_ACTION);
    $userCanEdit = userIsAuthorized(LEVELINFOEDIT_ACTION);
    $userCanDelete = userIsAuthorized(LEVELINFODELETE_ACTION);
?>

<h1><?php echo(htmlspecialchars($languageName)); ?> Level Information</h1>

<?php if ($userCanAdd) { ?>
    <div class="formGroup">
        <form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LEVELINFOADD_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($languageID)); ?>" />
            <input type="submit" value="Add Level Info" />
        </form>
    </div>
<?php } ?>

<div class="formGroup">
    <?php if (count($levelinfos) > 0) { ?>
        <form onsubmit="return ConfirmationPrompt('Delete the selected level\'s information?');" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LEVELINFODELETE_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo(htmlspecialchars($languageID)); ?>" />
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
                                <td><?php echo(htmlspecialchars($levelInfo->GetLevel())); ?></td>
                                <td><?php echo(htmlspecialchars($levelInfo->GetName())); ?></td>
                                <?php if ($userCanView) { ?>
                                    <td class="centerText">
                                        <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LEVELINFOVIEW_ACTION) . '&' . LEVELINFOID_IDENTIFIER . '=' . htmlspecialchars($levelInfo->GetId()));?>">
                                            View
                                        </a>
                                    </td>
                                <?php } ?>
                                <?php if ($userCanEdit) { ?>
                                    <td class="centerText">
                                        <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LEVELINFOEDIT_ACTION) . '&' . LEVELINFOID_IDENTIFIER . '=' . htmlspecialchars($levelInfo->GetId()));?>">
                                            Edit
                                        </a>
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
            <?php } ?>
        </form>
    <?php } else { ?>
        <h3>No level information found.</h3>
    <?php } ?>
</div>

<!--End main content-->
<?php
    include(FOOTER_FILE);
?>

<script>
    $( document ).ready( function( ) 
    { 
        $( "#levelInfos" ).tablesorter( ); 
    });   
</script>
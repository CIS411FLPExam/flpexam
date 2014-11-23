<?php
    include(GetHeaderFile());
    include(GetControlPanelFile());
?>
<!-- Start main content here -->
<h1>Languages</h1>

<?php
    $userCanAdd = userIsAuthorized(GetLanguageAddAction());
    $userCanEdit = userIsAuthorized(GetLanguageEditAction());
    $userCanView = userIsAuthorized(GetLanguageViewAction());
    $userCanDelete = userIsAuthorized(GetLanguageDeleteAction());
    $userCanManageQuestions = userIsAuthorized(GetManageQuestionsAction());
    $userCanManageLevelInfos = userIsAuthorized(GetManageLevelInfosAction());
?>

<?php if($userCanAdd) { ?>
    <form action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetLanguageAddAction())); ?>" method="post">
        <input type="submit" value="Add Language" />
    </form>

    <br />
<?php } ?>
<?php if(count($languages) > 0) { ?>
    <form onsubmit="return ConfirmationPrompt('Delete the selected languages?');" action="<?php echo( GetControllerScript(GetAdminControllerFile(), GetLanguageDeleteAction() ) ); ?>" method="post">
        <div class="datatable">
            <table id="languages" class="tablesorter">
                <thead>
                    <tr>
                        <th><b>Name</b></th>
                        <?php if ($userCanEdit) { ?><th>Exam</th><?php } ?>
                        <?php if ($userCanEdit) { ?><th>Feedback</th><?php } ?>
                        <?php if ($userCanManageQuestions) { ?><th></th><?php } ?>
                        <?php if ($userCanManageLevelInfos) { ?><th></th><?php } ?>
                        <?php if ($userCanView) { ?><th></th><?php } ?>
                        <?php if ($userCanEdit) { ?><th></th><?php } ?>
                        <?php if ($userCanDelete) { ?><th></th><?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $j = 0;
                        foreach ($languages as $language)
                        {
                            $languageID = $language[GetLanguageIdIdentifier()];
                            $name = $language[GetNameIdentifier()];
                            $active = $language['Active'];
                            $feedback = $language['Feedback'];
                    ?>
                    <tr>
                        <td><?php echo(htmlspecialchars($name)); ?></td>
                        <?php if ($userCanEdit) { ?>
                            <td>
                                <?php if($active == TRUE) { ?>
                                    <input type="button" value="Deactivate" onclick="Relocate('<?php echo(GetControllerScript(GetAdminControllerFile(), GetLangaugeDeactivateAction() . "&". GetLanguageIdIdentifier() . "=" . urlencode($languageID))); ?>');" />
                                <?php } else { ?>
                                    <input type="button" value="Activate" onclick="Relocate('<?php echo(GetControllerScript(GetAdminControllerFile(), GetLanguageActivateAction() . "&". GetLanguageIdIdentifier() . "=" . urlencode($languageID))); ?>');" />
                                <?php } ?>
                            </td>
                        <?php } ?>
                        <?php if ($userCanEdit) { ?>
                            <td>
                                <?php if($feedback == TRUE) { ?>
                                    <input type="button" value="Deactivate" onclick="Relocate('<?php echo(GetControllerScript(GetAdminControllerFile(), GetLanguageFeedbackDeactivateAction() . "&". GetLanguageIdIdentifier() . "=" . urlencode($languageID))); ?>');" />
                                <?php } else { ?>
                                    <input type="button" value="Activate" onclick="Relocate('<?php echo(GetControllerScript(GetAdminControllerFile(), GetLanguageFeedbackActivateAction() . "&". GetLanguageIdIdentifier() . "=" . urlencode($languageID))); ?>');" />
                                <?php } ?>
                            </td>
                        <?php } ?>
                        <?php if ($userCanManageQuestions) { ?>
                            <td>
                                <input type="button" value="Questions" onclick="Relocate('<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageQuestionsAction() . "&". GetLanguageIdIdentifier() . "=" . urlencode($languageID))); ?>');" />
                            </td>
                        <?php } ?>
                        <?php if ($userCanManageLevelInfos) { ?>
                            <td>
                                <input type="button" value="Level Info" onclick="Relocate('<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageLevelInfosAction() . "&". GetLanguageIdIdentifier() . "=" . urlencode($languageID))); ?>');" />
                            </td>
                        <?php } ?>
                        <?php if ($userCanView) { ?>
                            <td>
                                <input type="button" value="View" onclick="Relocate('<?php echo(GetControllerScript(GetAdminControllerFile(), GetLanguageViewAction() . "&". GetLanguageIdIdentifier() . "=" . urlencode($languageID))); ?>');" />
                            </td>
                        <?php } ?>
                        <?php if ($userCanEdit) { ?>
                            <td>
                                <input type="button" value="Edit" onclick="Relocate('<?php echo(GetControllerScript(GetAdminControllerFile(), GetLanguageEditAction() . "&". GetLanguageIdIdentifier() . "=" . urlencode($languageID))); ?>');" />
                            </td>
                        <?php } ?>
                        <?php if ($userCanDelete) { ?>
                            <td class="centerText">
                                <input type="checkbox" name="record<?php echo($j); ?>" value="<?php echo(htmlspecialchars($languageID)); ?>" />
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
        <input type="hidden" name="numListed" value="<?php echo count($languages); ?>" />
        <?php if ($userCanDelete) { ?>
            <br />
            <input type="submit" value="Delete Selected" />
            <input type="button" value="Select All" onclick="CheckAll();" />
        <?php } ?>
    </form>
<?php } else { ?>
    <h3>No languages found.</h3>
<?php } ?>
<!-- End main content here -->
<?php
    include( GetFooterFile() ); 
?>
<script>
    $( document ).ready( function( ) 
    { 
        $( "#languages" ).tablesorter( ); 
    });   
</script>
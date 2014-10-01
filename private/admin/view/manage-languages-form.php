<?php
    include(HEADER_FILE);
    include(CONTROLPANEL_FILE);
?>
<!-- Start main content here -->
<h1>Languages</h1>

<?php
    $userCanAdd = userIsAuthorized(LANGUAGEADD_ACTION);
    $userCanEdit = userIsAuthorized(LANGUAGEEDIT_ACTION);
    $userCanView = userIsAuthorized(LANGUAGEVIEW_ACTION);
    $userCanDelete = userIsAuthorized(LANGUAGEDELETE_ACTION);
    $userCanManageQuestions = userIsAuthorized(MANAGEQUESTIONS_ACTION);
    $userCanManageLevelInfos = userIsAuthorized(MANAGELEVELINFOS_ACTION);
?>

<?php if($userCanAdd) { ?>
    <form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEADD_ACTION)); ?>" method="post">
        <input type="submit" value="Add Language" />
    </form>

    <br />
<?php } ?>
<?php if(count($languages) > 0) { ?>
    <form action="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEDELETE_ACTION ) ); ?>" method="post">
        <div class="datatable">
            <table id="languages" class="tablesorter">
                <thead>
                    <tr>
                        <th><b>Name</b></th>
                        <?php if ($userCanView) { ?><th></th><?php } ?>
                        <?php if ($userCanEdit) { ?><th></th><?php } ?>
                        <?php if ($userCanManageQuestions) { ?><th></th><?php } ?>
                        <?php if ($userCanManageLevelInfos) { ?><th></th><?php } ?>
                        <?php if ($userCanDelete) { ?><th></th><?php } ?>
                        <?php if ($userCanEdit) { ?><th></th><?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $j = 0;
                        foreach ($languages as $language)
                        {
                            $languageID = $language[LANGUAGEID_IDENTIFIER];
                            $name = $language[NAME_IDENTIFIER];
                            $active = $language['Active'];
                    ?>
                    <tr>
                        <td><?php echo(htmlspecialchars($name)); ?></td>
                        <?php if ($userCanView) { ?>
                            <td>
                                <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEVIEW_ACTION . "&". LANGUAGEID_IDENTIFIER . "=" . urldecode($languageID))); ?>">
                                    View
                                </a>
                            </td>
                        <?php } ?>
                        <?php if ($userCanEdit) { ?>
                            <td>
                                <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEEDIT_ACTION . "&". LANGUAGEID_IDENTIFIER . "=" . urldecode($languageID))); ?>">
                                    Edit
                                </a>
                            </td>
                        <?php } ?>
                        <?php if ($userCanManageQuestions) { ?>
                            <td>
                                <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEQUESTIONS_ACTION . "&". LANGUAGEID_IDENTIFIER . "=" . urldecode($languageID))); ?>">
                                    Manage Questions
                                </a>
                            </td>
                        <?php } ?>
                        <?php if ($userCanManageLevelInfos) { ?>
                            <td>
                                <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGELEVELINFOS_ACTION . "&". LANGUAGEID_IDENTIFIER . "=" . urldecode($languageID))); ?>">
                                    Manage Level Info
                                </a>
                            </td>
                        <?php } ?>
                        <?php if ($userCanDelete) { ?>
                            <td class="centerText">
                                <input type="checkbox" name="record<?php echo($j); ?>" value="<?php echo(htmlspecialchars($languageID)); ?>" />
                            </td>
                        <?php } ?>
                        <?php if ($userCanEdit) { ?>
                            <td>
                                <?php if($active == TRUE) { ?>
                                    <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEDEACTIVATE_ACTION . "&". LANGUAGEID_IDENTIFIER . "=" . urldecode($languageID))); ?>">
                                        Deactivate
                                    </a>
                                <?php } else { ?>
                                    <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEACTIVATE_ACTION . "&". LANGUAGEID_IDENTIFIER . "=" . urldecode($languageID))); ?>">
                                        Activate
                                    </a>
                                <?php } ?>
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
        <?php } ?>
    </form>
<?php } else { ?>
    <h3>No languages found.</h3>
<?php } ?>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
<script>
    $( document ).ready( function( ) 
    { 
        $( "#languages" ).tablesorter( ); 
    });   
</script>
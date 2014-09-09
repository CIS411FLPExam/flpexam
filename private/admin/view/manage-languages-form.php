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
?>

<?php if($userCanAdd) { ?>
    <form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEADD_ACTION)); ?>" method="post">
        <input type="submit" value="Add Language" />
    </form>

    <br />
<?php } ?>
<form action="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEDELETE_ACTION ) ); ?>" method="post">
    <div class="datatable">
        <table id="languages" class="tablesorter">
            <thead>
                <tr>
                    <th><b>Name</b></th>
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
                        $languageID = $language[LANGUAGEID_IDENTIFIER];
                        $name = $language[NAME_IDENTIFIER];
                ?>
                <tr class="row1">
                    <td><?php echo(htmlspecialchars($name)); ?></td>
                    <?php if ($userCanView) { ?>
                        <td>
                            <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEVIEW_ACTION . "&". LANGUAGEID_IDENTIFIER . "=" . urldecode($languageID))) ?>">
                                View
                            </a>
                        </td>
                    <?php } ?>
                    <?php if ($userCanEdit) { ?>
                        <td>
                            <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEEDIT_ACTION . "&". LANGUAGEID_IDENTIFIER . "=" . urldecode($languageID))) ?>">
                                Edit
                            </a>
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
    <input type="hidden" name="numListed" value="<?php echo count($results); ?>" />
    <?php if ($userCanDelete) { ?>
            
            <br />
            
            <input type="submit" value="Delete Selected" />
    <?php } ?>
</form>

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
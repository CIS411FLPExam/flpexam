<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->
<h1>Profiles</h1>

<form action="<?php echo(GetControllerScript(MAINCONTROLLER_FILE, LANGUAGEPROFILEADD_ACTION)); ?>" method="post">
    <input type="submit" value="Add Profile" />
</form>

<br />

<div class="datatable">
    <table id="profiles" class="tablesorter">
        <thead>
            <tr>
                <th><b>Language</b></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $j = 0;
                foreach ($languageProfiles as $languageProfile)
                {
                    $profileID = $languageProfile[LANGUAGEPROFILEID_IDENTIFIER];
                    $name = $languageProfile[NAME_IDENTIFIER];
                    $languageID = $languageProfile[LANGUAGEID_IDENTIFIER];
            ?>
            <tr class="row1">
                <td><?php echo(htmlspecialchars($name)); ?></td>
                <td>
                    <a href="<?php echo(GetControllerScript(MAINCONTROLLER_FILE, LANGUAGEPROFILEVIEW_ACTION . "&". LANGUAGEPROFILEID_IDENTIFIER . "=" . urldecode($profileID))) ?>">
                        View
                    </a>
                </td>
                <td>
                    <a href="<?php echo(GetControllerScript(MAINCONTROLLER_FILE, LANGUAGEPROFILEEDIT_ACTION . "&". LANGUAGEPROFILEID_IDENTIFIER . "=" . urldecode($profileID))) ?>">
                        Edit
                    </a>
                </td>
            </tr>
            <?php }  ?>
        </tbody>
    </table>
</div>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
<script>
    $( document ).ready( function( ) 
    { 
        $( "#profiles" ).tablesorter( ); 
    });   
</script>
<?php
    include(HEADER_FILE);
?>
<!--Start main content here-->
<h1>Tests</h1>

<?php
    $userCanView = userIsAuthorized(TESTVIEW_ACTION);
?>

<div class="datatable">
    <table id="tests" class="tablesorter">
        <thead>
            <tr>
                <th><b>First Name</b></th>
                <th><b>Last Name</b></th>
                <th><b>Language</b></th>
                <th><b>Score</b></th>
                <th><b>Date</b></th>
                <?php if ($userCanView) { ?><th></th><?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
                $j = 0;
                foreach ($testInfos as $testInfo)
                {
                    $testID = $testInfo->GetId();
                    $firstName = $testInfo->GetFirstName();
                    $lastName = $testInfo->GetLastName();
                    $language = $testInfo->GetLanguage();
                    $score = $testInfo->GetScore();
                    $date = $testInfo->GetDate();
            ?>
            <tr>
                <td><?php echo(htmlspecialchars($firstName)); ?></td>
                <td><?php echo(htmlspecialchars($lastName)); ?></td>
                <td><?php echo(htmlspecialchars($language)); ?></td>
                <td><?php echo(htmlspecialchars($score)); ?></td>
                <td><?php echo(htmlspecialchars($date)); ?></td>
                <?php if ($userCanView) { ?>
                    <td>
                        <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, TESTVIEW_ACTION . "&". TESTID_IDENTIFIER . "=" . urldecode($testID))); ?>">
                            View
                        </a>
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
<input type="hidden" name="numListed" value="<?php echo count($testInfos); ?>" />

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
<script>
    $( document ).ready( function( ) 
    { 
        $( "#tests" ).tablesorter( ); 
    });   
</script>
<?php
    include( HEADER_FILE );
?>

<h1>Language</h1>

<!-- Start main content here -->
<form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEEDIT_ACTION)); ?>" method="post">
    <input type="hidden" name="<?php echo(htmlspecialchars(LANGUAGEID_IDENTIFIER)); ?>" value="<?php echo(htmlspecialchars($languageID)); ?>" />
    <div class="formGroup">
        <div class="formSection">
            <label>Name:</label>
            <label><?php echo(htmlspecialchars($name)); ?></label>
        </div>
        <div class="formSection">
            <label>Active:</label><label><?php if ($active) { echo('Yes'); } else { echo ('No'); } ?></label>
        </div>
    </div>
</form>

<h3>Questions</h3>

<?php
    $userCanAdd = userIsAuthorized(QUESTIONADD_ACTION);
    $userCanEdit = userIsAuthorized(QUESTIONEDIT_ACTION);
    $userCanView = userIsAuthorized(QUESTIONVIEW_ACTION);
    $userCanDelete = userIsAuthorized(QUESTIONDELETE_ACTION);
?>

<?php if($userCanAdd) { ?>
    <form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONADD_ACTION)); ?>" method="post">
        <input type="submit" value="Add Question" />
    </form>

    <br />
<?php } ?>
    
<form action="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONDELETE_ACTION ) ); ?>" method="post">
    <div class="datatable">
        <table id="questions" class="tablesorter">
            <thead>
                <tr>
                    <th><b>Question</b></th>
                    <?php if ($userCanView) { ?><th><b>View</b></th><?php } ?>
                    <?php if ($userCanEdit) { ?><th><b>Edit</b></th><?php } ?>
                    <?php if ($userCanDelete) { ?><th><b>Select</b></th><?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php
                    $j = 0;
                    foreach ($questions as $question)
                    {
                        $questionID = $question[QUESTIONID_IDENTIFIER];
                        $questionName = $question[NAME_IDENTIFIER];
                ?>
                
                <tr class="row1">
                    <td><?php echo(htmlspecialchars($questionName)); ?></td>

                    <?php if ($userCanView) { ?>
                        <td>
                            <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONVIEW_ACTION . "&". QUESTIONID_IDENTIFIER . "=" . urldecode($questionID))) ?>">
                                <input type="button" value="View" />
                            </a>
                        </td>
                    <?php } ?>
                    <?php if ($userCanEdit) { ?>
                        <td>
                            <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONEDIT_ACTION . "&". QUESTIONID_IDENTIFIER . "=" . urldecode($questionID))) ?>">
                                <input type="button" value="Edit" />
                            </a>
                        </td>
                    <?php } ?>
                    <?php if ($userCanDelete) { ?>
                        <td class="centerText">
                            <input type="checkbox" name="record<?php echo($j); ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
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
            
            <div class="divider"></div>

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
        $( "#questions" ).tablesorter( ); 
    });   
</script>
<?php
    include( HEADER_FILE );
    include( CONTROLPANEL_FILE );
?>
<!-- Start main content here -->

<h3><?php echo($language); ?> Questions</h3>

<?php
    $userCanAdd = userIsAuthorized(QUESTIONADD_ACTION);
    $userCanEdit = userIsAuthorized(QUESTIONEDIT_ACTION);
    $userCanView = userIsAuthorized(QUESTIONVIEW_ACTION);
    $userCanDelete = userIsAuthorized(QUESTIONDELETE_ACTION);
    $userCanExport = userIsAuthorized(LANGUAGEEXPORT_ACTION);
    $userCanImport = userIsAuthorized(LANGUAGEIMPORT_ACTION);
    $userCanExportStats = userIsAuthorized(LANGUAGESTATISTICSEXPORT_ACTION);
    $userCanSearch = userIsAuthorized(QUESTIONSEARCH_ACTION);
?>
<?php
    if (isset($message))
    {
        include(MESSAGE_FILE);
    }
?>

<div class="formGroup">
    <?php if($userCanAdd) { ?>
        <form class="inlineBlock questionFormPad" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONADD_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo($languageID); ?>" />
            <input class="questionButton" type="submit" value="Add Question" />
        </form>
    <?php } ?>
    <?php if ($userCanExport) { ?>
        <form class="inlineBlock questionFormPad" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEEXPORT_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo($languageID); ?>" />
            <input class="questionButton" type="submit" value="Export Questions" />
        </form>
    <?php } ?>
    <?php if ($userCanExportStats) { ?>
        <form class="inlineBlock questionFormPad" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGESTATISTICSEXPORT_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo($languageID); ?>" />
            <input class="questionButton" type="submit" value="Export Stats" />
        </form>
    <?php } ?>
    <?php if (userIsAuthorized($userCanEdit)) { ?>
        <form class="inlineBlock questionFormPad" onsubmit="return ConfirmationPrompt('Reset all question statistics?');" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONSTATISTICSRESET_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo($languageID); ?>" />
            <input class="questionButton" type="submit" value="Reset Stats" />
        </form>
    <?php } ?>
     <?php if ($userCanImport) { ?>
        <br />
        <form class="inlineBlock questionFormPad" enctype="multipart/form-data" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEIMPORT_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo($languageID); ?>" />
            <input class="questionButton" name="Add" type="submit" value="Add Questions" />
            <input type="file" name="file" required />
        </form>
        <br />
        <form class="inlineBlock questionFormPad" enctype="multipart/form-data" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, LANGUAGEIMPORT_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo($languageID); ?>" />
            <input class="questionButton" name="Update" type="submit" value="Edit Questions" />
            <input type="file" name="file" required />
        </form>
        <br />
    <?php } ?>
</div>
<?php if ($userCanSearch) { ?>
    <div class="divider"></div>
    
    <div class="formGroup">
        <h4>Find Questions</h4>
        <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONSEARCH_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo($languageID); ?>" />
            <input name="<?php echo(NAME_IDENTIFIER) ?>" type="text" class="formInput" value="<?php if (isset($name)) { echo(htmlspecialchars($name)); } ?>" />
            &nbsp;
            <input type="submit" value="Search Questions" />
        </form>
        <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONSEARCH_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo($languageID); ?>" />
            <input type="hidden" name="Flagged" />
            <input type="submit" value="View Flagged" />
        </form>
        <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEQUESTIONS_ACTION)); ?>" method="post">
            <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo($languageID); ?>" />
            <input type="submit" value="Clear" />
        </form>
    </div>
<?php } ?>

<div class="divider"></div>
<h4><?php echo(count($questions)); ?> Question(s)</h4>
<form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGEQUESTIONS_ACTION)); ?>" method="post">
    <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo($languageID); ?>" />
    <input type="number" name="Level" value="<?php if (isset($level)) { echo(htmlspecialchars($level)); } ?>" required min="1"/>
    <input type="submit" value="Change Level" />
</form>
    
<?php if(count($questions) > 0) { ?>
    <form onsubmit="return ConfirmationPrompt('Delete the selected questions?');" action="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONDELETE_ACTION ) ); ?>" method="post">
        <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo($languageID); ?>" />
        <div class="datatable">
            <table id="questions" class="tablesorter">
                <thead>
                    <tr>
                        <th><b>I.D.</b></th>
                        <th><b>Level</b></th>
                        <th><b>Question</b></th>
                        <th><b>Avg&nbsp;Score</b></th>
                        <th><b>Flagged</b></th>
                        <?php if ($userCanView) { ?><th></th><?php } ?>
                        <?php if ($userCanEdit) { ?><th></th><?php } ?>
                        <?php if ($userCanDelete) { ?><th></th><?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $j = 0;
                        foreach ($questions as $question)
                        {
                            $questionID = $question[QUESTIONID_IDENTIFIER];
                            $questionName = $question[NAME_IDENTIFIER];
                            $questionLevel = $question['Level'];
                            $correctlyAnsweredPercent = $question['AvgScore'];
                            $flagCount = $question['Flagged'];
                            
                            if(strlen($questionName) > 50)
                            {
                                $questionName = substr($questionName, 0, 47) . '...';
                            }
                    ?>

                    <tr>
                        <td><?php echo(htmlspecialchars($questionID)); ?></td>
                        <td class="centerText"><?php echo(htmlspecialchars($questionLevel)); ?></td>
                        <td><?php echo(htmlspecialchars($questionName)); ?></td>
                        <td class="centerText"><?php echo(number_format(htmlspecialchars($correctlyAnsweredPercent), 2)); ?>%</td>
                        <td class="centerText"><?php echo(htmlspecialchars($flagCount)) ?>x</td>
                        <?php if ($userCanView) { ?>
                            <td>
                                <input type="button" value="View" onclick="Relocate('<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONVIEW_ACTION . "&". QUESTIONID_IDENTIFIER . "=" . urlencode($questionID))) ?>');"
                            </td>
                        <?php } ?>
                        <?php if ($userCanEdit) { ?>
                            <td>
                                <input type="button" value="Edit" onclick="Relocate('<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONEDIT_ACTION . "&". QUESTIONID_IDENTIFIER . "=" . urlencode($questionID))) ?>');"
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
        <input type="hidden" name="numListed" value="<?php echo count($questions); ?>" />
        <?php if ($userCanDelete) { ?>
                <br />
                <input type="submit" value="Delete Selected" />
                <input type="button" value="Select All" onclick="CheckAll();" />
        <?php } ?>
    </form>
<?php } else { ?>
    <h3>No questions found.</h3>
<?php } ?>
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
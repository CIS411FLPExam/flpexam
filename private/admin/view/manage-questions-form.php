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
?>

<form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONSEARCH_ACTION)); ?>" method="post">
    <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo($languageID); ?>" />
    <label>Search Questions:</label>
    <input name="<?php echo(NAME_IDENTIFIER) ?>" type="text" class="formInput" />
    <input type="submit" value="Search" />
</form>

<br />

<div class="divider"></div>

<br />

<?php if($userCanAdd) { ?>
    <form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONADD_ACTION)); ?>" method="post">
        <input type="hidden" name="<?php echo(LANGUAGEID_IDENTIFIER); ?>" value="<?php echo($languageID); ?>" />
        <input type="submit" value="Add Question" />
    </form>

    <br />
<?php } ?>

<?php if(count($questions) > 0) { ?>
    <form action="<?php echo( GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONDELETE_ACTION ) ); ?>" method="post">
        <div class="datatable">
            <table id="questions" class="tablesorter">
                <thead>
                    <tr>
                        <th><b>Question</b></th>
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
                    ?>

                    <tr class="row1">
                        <td><?php echo(htmlspecialchars($questionName)); ?></td>

                        <?php if ($userCanView) { ?>
                            <td>
                                <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONVIEW_ACTION . "&". QUESTIONID_IDENTIFIER . "=" . urldecode($questionID))) ?>">
                                    View
                                </a>
                            </td>
                        <?php } ?>
                        <?php if ($userCanEdit) { ?>
                            <td>
                                <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, QUESTIONEDIT_ACTION . "&". QUESTIONID_IDENTIFIER . "=" . urldecode($questionID))) ?>">
                                    Edit
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
                <input type="submit" value="Delete Selected" />
        <?php } ?>
    </form>
<?php } else { ?>
    <h3>No questions found.</h3>
<?php } ?>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
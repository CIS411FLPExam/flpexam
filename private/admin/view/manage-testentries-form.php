<?php
    include(HEADER_FILE);
    include(CONTROLPANEL_FILE);
?>
<!--Start main content here-->
<h1>Tests</h1>

<?php
    $userCanView = userIsAuthorized(TESTENTRYVIEW_ACTION);
    $userCanDelete = userIsAuthorized(TESTENTRYDELETE_ACTION);
    $userCanSearch = userIsAuthorized(TESTENTRYSEARCH_ACTION);
?>

<?php if ($userCanSearch) { ?>
    <h3>Search</h3>
    <div class="formGroup">
        <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, TESTENTRYSEARCH_ACTION)); ?>" method="post">
            <div class="formGroup">
                <label class="srchSectLbl">Name:</label>
                <input class="srchSectTxt" type="text" name="Name" value="<?php echo(htmlspecialchars($name)); ?>" />
            </div>
            <div class="formGroup">
                <label class="srchSectLbl">Language:</label>
                <select class="srchSectSelect" name="Language" class="formInput">
                    <option selected="selected"></option>
                    <?php foreach ($languageNames as $languageName) { ?>
                        <option><?php echo(htmlspecialchars($languageName)); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="formGroup">
                <label class="srchSectLbl">Score:</label>
                <input class="srchSectNmbr" type="number" name="MinScore" value="<?php echo(htmlspecialchars($minScore)) ?>" min="0" />
                to
                <input class="srchSectNmbr" type="number" name="MaxScore" value="<?php echo(htmlspecialchars($maxScore)) ?>" min="0"/>
            </div>
            <div class="formGroup">
                <label class="srchSectLbl">Date:</label>
                <input class="srchSectDate" type="date" name="MinDate" value="<?php echo(htmlspecialchars($minDate)) ?>" />
                to
                <input class="srchSectDate" type="date" name="MaxDate" value="<?php echo(htmlspecialchars($maxDate)) ?>" />
            </div>

            <br />

            <input type="submit" value="Search" />
        </form>
        <form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, MANAGETESTENTRIES_ACTION)); ?>" method="post">
            <input type="submit" value="Clear" />
        </form>
    </div>
    <div class="divider"></div>
<?php } ?>
    
<?php if (count($testInfos)) { ?>
    <form onsubmit="return ConfirmationPrompt('Delete the selected test records?');" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, TESTENTRYDELETE_ACTION)); ?>" method="post">
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
                        <?php if ($userCanDelete){ ?><th></th><?php } ?>
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
                                <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, TESTENTRYVIEW_ACTION . "&". TESTID_IDENTIFIER . "=" . urlencode($testID))); ?>">
                                    View
                                </a>
                            </td>
                        <?php } ?>
                        <?php if ($userCanDelete) { ?>
                            <td>
                                <input type="checkbox" name="record<?php echo($j); ?>" value="<?php echo(htmlspecialchars($testID)) ?>" />
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
        <input type="hidden" name="numListed" value="<?php echo(count($testInfos)); ?>" />
        <br />
        
        <?php if ($userCanDelete) { ?>
            <input type="submit" value="Delete Selected" />
            <input type="button" value="Select All" onclick="CheckAll();" />
        <?php } ?>
    </form>
<?php } else { ?>
    <h3>No tests found.</h3>
<?php } ?>
<!--End main content here-->
<?php
    include( FOOTER_FILE ); 
?>
<script>
    $( document ).ready( function( ) 
    { 
        $( "#tests" ).tablesorter( ); 
    });   
</script>
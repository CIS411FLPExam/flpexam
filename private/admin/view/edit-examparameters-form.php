<?php
    include(HEADER_FILE);
?>
<!-- Start main content here -->

<?php
    if(isset($message))
    {
        include(MESSAGE_FILE);
    }
?>

<div class="formGroup">
    <h1>Exam Parameters</h1>
    <form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, PROCESSEXAMPARAMETERSEDIT_ACTION)) ?>" method="post">
        <div class="formSection">
            <label>Key Code:</label>
            <input name="<?php echo($parameters->GetKeyCodeIndex()); ?>" type="text" value="<?php echo(htmlspecialchars($keyCode)); ?>" autofocus maxlength="40"/>
            <div class="clear"></div>
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>Question Count<span class="redText">*</span>:</label>
            <input name="<?php echo($parameters->GetQuestionCountIndex()); ?>" type="number" value="<?php echo(htmlspecialchars($questionCount)); ?>" required />
            per-level
            <div class="clear"></div>
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>Score<span class="redText">*</span>:</label>
            <input name="<?php echo($parameters->GetIncLevelScoreIndex()); ?>" type="number" value="<?php echo(htmlspecialchars($incLevelScore)); ?>" required min="0" max="100" />
            % or higher to increase level
            <div class="clear"></div>
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>Score<span class="redText">*</span>:</label>
            <input name="<?php echo($parameters->GetDecLevelScoreIndex()); ?>" type="number" value="<?php echo(htmlspecialchars($decLevelScore)); ?>" required min="0" max="100" />
            % or lower to decrease level
            <div class="clear"></div>
        </div>
        
        <br />
        
        <input type="submit" value="Submit" />
    </form>
</div>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
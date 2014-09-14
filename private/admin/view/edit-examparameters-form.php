<?php
    include(HEADER_FILE);
?>
<!-- Start main content here -->
<div class="formGroup">
    <h1>Exam Parameters</h1>
    <form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, PROCESSEXAMPARAMETERSEDIT_ACTION)) ?>" method="post">
        <div class="formSection">
            <label>Key Code:</label>
            <input name="<?php echo($parameters->GetKeyCodeIndex()); ?>" type="text" value="<?php echo(htmlspecialchars($keyCode)); ?>" />
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>Question Count:</label>
            <input name="<?php echo($parameters->GetQuestionCountIndex()); ?>" type="number" value="<?php echo(htmlspecialchars($questionCount)); ?>" />
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>Score:</label>
            <input name="<?php echo($parameters->GetIncLevelScoreIndex()); ?>" type="number" value="<?php echo(htmlspecialchars($incLevelScore)); ?>" />
            % or higher to increase level
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>Score:</label>
            <input name="<?php echo($parameters->GetDecLevelScoreIndex()); ?>" type="number" value="<?php echo(htmlspecialchars($decLevelScore)); ?>" />
            % or lower to decrease level
        </div>
        
        <br />
        
        <input type="submit" value="Submit" />
    </form>
</div>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
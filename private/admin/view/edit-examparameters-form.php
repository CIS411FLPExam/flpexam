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
            <label>Get at least:</label>
            <input name="<?php echo($parameters->GetIncLevelScoreIndex()); ?>" type="number" value="<?php echo(htmlspecialchars($incLevelScore)); ?>" />
            % correct to increase level
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>Get less than:</label>
            <input name="<?php echo($parameters->GetDecLevelScoreIndex()); ?>" type="number" value="<?php echo(htmlspecialchars($decLevelScore)); ?>" />
            % correct to decrease level
        </div>
        
        <br />
        
        <input type="submit" value="Submit" />
    </form>
</div>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
<?php
    include(GetHeaderFile());
?>
<!-- Start main content here -->

<?php
    if(isset($message))
    {
        include(GetMessageFile());
    }
?>

<h1>Exam Parameters</h1>
<div class="formGroup">
    <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetProcessExamParametersEditAction())) ?>" method="post">
        <div class="formSection">
            <label>Key Code:</label>
            <input name="<?php echo($parameters->GetKeyCodeIndex()); ?>" type="text" value="<?php echo(htmlspecialchars($keyCode)); ?>" autofocus maxlength="40"/>
            <div class="clear"></div>
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Home Spoken lvl:<span class="redText">*</span>:</label>
            <div class="displayBox">
                <input name="SpokenAtHomeInitLevel" type="number" value="<?php echo(htmlspecialchars($spokenAtHomeInitLevel));?>" autofocus required min="1" />
                (The initial level of a test taker who speaks the language at home.)
            </div>
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
    <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetExamParametersViewAction())); ?>" method="post">
        <input type="submit" value="Cancel" />
    </form>
</div>
<!-- End main content here -->
<?php
    include( GetFooterFile() ); 
?>
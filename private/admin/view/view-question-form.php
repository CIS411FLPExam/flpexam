<?php
    include( GetHeaderFile() );
    include( GetControlPanelFile() );
?>
<!-- Start main content here -->
<h1>Question</h1>

<div class="formGroup">
    <div class="formSection">
        <label>I.D.:</label><?php echo(htmlspecialchars($questionID)); ?>
    </div>

    <div class="divider"></div>
    
    <div class="formSection">
        <label>Level:</label><?php echo(htmlspecialchars($level)); ?>
    </div>

    <div class="divider"></div>

    <div class="formSection">
        <label>Instructions:</label><div class="displayBox"><?php echo(htmlspecialchars($instructions)); ?></div>
        <div class="clear"></div>
    </div>

    <div class="divider"></div>

    <div class="formSection">
        <label>Question:</label><pre class="displayBox"><?php echo(htmlspecialchars($name)); ?></pre>
        <div class="clear"></div>
    </div>

    <div class="divider"></div>
    
    <?php
        $i = 1;
        foreach ($answers as $answer)
        { 
    ?>
        <div class="formSection">
            <label>Answer <?php echo(htmlspecialchars($i)); ?>:</label>
            <div class="displayBox"><?php echo(htmlspecialchars($answer[GetNameIdentifier()])); ?></div>
            <div class="clear"></div>
        </div>

        <div class="divider"></div>
    <?php
            $i++;
        } 
    ?>
</div>

<h2>Question Statistics</h2>

<div class="formGroup">
    <div class="formSection">
        The question has been asked
        <b>
            <?php echo(htmlspecialchars($totalTimesAnswered)); ?>
        </b>
        time(s).
    </div>
    
    <div class="divider"></div>
    
    <div class="formSection">
        The question has been answered correctly
        <b>
            <?php echo(htmlspecialchars($totalTimesAnsweredCorrectly)); ?>
        </b>
        time(s).
    </div>
    
    <div class="divider"></div>
    
    <div class="formSection">
        The question has been flagged
        <b>
            <?php echo(htmlspecialchars($totalTimesFlagged)); ?>
        </b>
        time(s).
        <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetQuestionCommentsViewAction())); ?>" method="post">
            <input type="hidden" name="<?php echo(GetQuestionIdIdentifier()) ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
            <input type="submit" value="View Comments" />
        </form>
    </div>
    <?php
        $i = 1;
        foreach ($answers as $answer)
        { 
            $answerID = $answer[GetAnswerIdIdentifier()];
    ?>
        <div class="divider"></div>
        
        <div class="formSection">
            The answer
            <b>"<?php echo(htmlspecialchars($answer[GetNameIdentifier()])); ?>"</b>
            has been chosen 
            <b><?php echo(htmlspecialchars($answer['Chosen'])); ?></b>
            time(s).
        </div>
    <?php
            $i++;
        } 
    ?>
</div>

<br />

<form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetQuestionEditAction())); ?>" method="post">
    <input type="hidden" name="<?php echo(GetQuestionIdIdentifier()); ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
    <input type="submit" value="Edit" />
</form>

<form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetQuestionStatisticsResetAction())) ?>" method="post">
    <input type="hidden" name="<?php echo(GetQuestionIdIdentifier()); ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
    <input type="submit" value="Reset Stats" />
</form>

<form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetQuestionAddAction())); ?>" method="post">
    <input type="hidden" name="<?php echo(GetQuestionIdIdentifier()); ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
    <input type="submit" value="Add New Question" />
</form>

<form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetLanguageViewAction())); ?>" method="post">
    <input type="hidden" name="<?php echo(GetQuestionIdIdentifier()); ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
    <input type="submit" value="View Language" />
</form>

<form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageQuestionsAction())); ?>" method="post">
    <input type="hidden" name="<?php echo(GetQuestionIdIdentifier()); ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
    <input type="hidden" name="Level" value="<?php echo(htmlspecialchars($level)); ?>" />
    <input type="submit" value="Manage Questions" />
</form>
<!-- End main content here -->
<?php
    include( GetFooterFile() ); 
?>
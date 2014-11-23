<?php
    include(GetHeaderFile());
?>
<!--Start main content-->
<h1>Question <?php echo(htmlspecialchars($questionID)); ?> Comments</h1>

<div class="formGroup">
    <?php if (count($comments) > 0) { ?>
        <?php
            $count = 1;
            foreach($comments as $comment)
            {
                $text = $comment->GetComment();
        ?>
            <div class="formSection">
                <label>Comment #<?php echo(htmlspecialchars($count)) ?>:</label>
                <div class="displayBox">
                    <?php echo(htmlspecialchars($text)); ?>
                </div>
                <div class="clear"></div>
            </div>
        <?php
                $count++;
            }
        ?>
    <?php } else { ?>
        <h3>No comments on record for this question.</h3>
    <?php } ?>
</div>

<form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetQuestionViewAction())); ?>" method="post">
    <input type="hidden" name="<?php echo(GetQuestionIdIdentifier()); ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
    <input type="submit" value="View Question" />
</form>

<form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageQuestionsAction())); ?>" method="post">
    <input type="hidden" name="<?php echo(GetQuestionIdIdentifier()); ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
    <input type="hidden" name="Level" value="<?php echo(htmlspecialchars($level)); ?>" />
    <input type="submit" value="Manage Questions" />
</form>

<form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetLanguageViewAction())); ?>" method="post">
    <input type="hidden" name="<?php echo(GetQuestionIdIdentifier()); ?>" value="<?php echo(htmlspecialchars($questionID)); ?>" />
    <input type="submit" value="View Language" />
</form>
<!--End main content-->
<?php
    include(GetFooterFile());
?>
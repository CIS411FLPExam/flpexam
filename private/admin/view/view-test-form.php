<?php
    include(HEADER_FILE);
    include(CONTROLPANEL_FILE);
?>
<h1><?php if (isset($testeeName)) { echo($testeeName . "'s"); } ?> Test</h1>
<div class="formGroup">
    <?php
        $count = 1;
        foreach($testQAs as $testQA)
        {
            $instructions = $testQA['Instructions'];
            $name = $testQA['Question'];
            $level = $testQA['Level'];
            $answers = $testQA['Answers'];
    ?>
    <div class="divider"></div>
    <div class="formSection">
        <label>Level:</label>
        <?php echo(htmlspecialchars($level)); ?>
    </div>
    <?php if (!empty($instructions)) { ?>
        <div class="formSection">
            <label>Instructions:</label>
            <div class="displayBox"><b><?php echo(htmlspecialchars($instructions)); ?></b></div>
            <div class="clear"></div>
        </div>
    <?php } ?>
    <div class="formSection">
        <label>Question:</label>
        <div class="question">
            <pre><b><?php echo(htmlspecialchars($name)); ?></b></pre>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="formSection">
        <?php
            $answerOptionAsciiVal = 97;
            for ($index = 0; $index < count($answers); $index++)
            {
                $answer = $answers[$index];
                $correct = $answer['Correct'] == '1';
        ?>
            <input class="floatLeft" type="radio" <?php if ($answer['Chosen'] == '1') { echo('checked'); } else { echo('disabled="TRUE"'); } ?>  />
            <span class="floatLeft">
                <b>
                    <?php
                        echo(chr($answerOptionAsciiVal++));
                    ?>)
                </b>
            </span>
            <div class="inline floatLeft">&nbsp;</div>
            <div class="displayBox">
                <?php if ($correct){ ?>
                    <mark>
                <?php } ?>
                <?php echo(htmlspecialchars($answer['Answer'])); ?>
                <?php if ($correct){ ?>
                    </mark>
                <?php } ?>
            </div>
            <div class="clear"></div>
        <?php
            }
        ?>
    </div>
    <?php
            $count++;
        }
    ?>
</div>
<div class="formGroup">
    <form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, TESTENTRYVIEW_ACTION)); ?>" method="post">
        <input type="hidden" name="<?php echo(TESTID_IDENTIFIER) ?>" value="<?php echo(htmlspecialchars($testID)); ?>" />
        <input type="submit" value="View Test Entry" />
    </form>
</div>
<?php
    include(FOOTER_FILE);
?>
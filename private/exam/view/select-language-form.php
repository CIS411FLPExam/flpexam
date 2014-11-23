<?php
    include( GetHeaderFile() );
?>
<!-- Start main content here -->

<h1>Language Selection</h1>

<div class="formGroup">
    <?php if (count($languageNames) > 0) { ?>
        <form action="<?php echo(GetControllerScript(GetExamControllerFile(), GetProcessLanguageSelectAction())); ?>" method="post">
            <div class="formSection">
                <label>Language: </label>
                <select name="<?php echo(GetNameIdentifier()); ?>" class="formInput" autofocus>
                    <option selected="selected"><?php echo(htmlspecialchars($languageNames[0])); ?></option>
                    <?php for($index = 1; $index < count($languageNames); $index++) { ?>
                        <option><?php echo(htmlspecialchars($languageNames[$index])); ?></option>
                    <?php } ?>
                </select>
                <div class="clear"></div>
            </div>
            
            <br />
            
            <input type="submit" value="Select" />
        </form>
    <?php } else { ?>
        <h3>There are no exams available at this time.</h3>
    <?php } ?>
    <?php
        if(isset($message))
        {
            include(GetMessageFile());
        }
    ?>
</div>

<!-- End main content here -->
<?php
    include( GetPlainFooterFile() );
?>
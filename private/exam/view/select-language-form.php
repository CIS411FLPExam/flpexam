<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<h1>Language Selection</h1>

<div class="formGroup">
    <?php if (count($languageNames) > 0) { ?>
        <form action="<?php echo(GetControllerScript(EXAMCONTROLLER_FILE, PROCESSLANGUAGESELECT_ACTION)); ?>" method="post">
            <div class="formSection">
                <label>Language: </label>
                <select name="<?php echo(NAME_IDENTIFIER); ?>" class="formInput" autofocus>
                    <option selected="selected"><?php echo(htmlspecialchars($languageNames[0])); ?></option>
                    <?php for($index = 1; $index < count($languageNames); $index++) { ?>
                        <option><?php echo(htmlspecialchars($languageNames[$index])); ?></option>
                    <?php } ?>
                </select>
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
            include(MESSAGE_FILE);
        }
    ?>
</div>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
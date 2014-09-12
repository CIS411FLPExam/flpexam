<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->
<form action="<?php echo(GetControllerScript(EXAMCONTROLLER_FILE, PROCESSEXAMLANGUAGESELECT_ACTION)); ?>" method="post">
    <label>Languages:</label>
     <select name="Language" class="formInput">
        <?php foreach ($languages as $availableLanguage) { ?>
        <option <?php if($language == $availableLanguage[NAME_IDENTIFIER]) { echo("selected='selected'"); } ?>>
            <?php echo(htmlspecialchars($availableLanguage[NAME_IDENTIFIER])); ?>
        </option>
        <?php } ?>
    </select>
    <input type="submit" value="Select" />
</form>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
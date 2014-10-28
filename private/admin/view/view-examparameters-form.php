<?php
    include(HEADER_FILE);
    include(CONTROLPANEL_FILE);
?>
<!-- Start main content here -->
<div class="formGroup">
    <h1>Exam Parameters</h1>
    
    <div class="formSection">
        <label>Key Code:</label>
        <div class="displayBox"><?php echo(htmlspecialchars($keyCode)); ?></div>
        <div class="clear"></div>
    </div>
    
    <div class="formSection">
        <label>Home Spoken lvl:</label>
        <?php echo(htmlspecialchars($spokenAtHomeInitLevel));?>
    </div>
    
    <div class="divider"></div>
    
    <div class="formSection">
        <label>Question Count:</label><?php echo(htmlspecialchars($questionCount)); ?> per-level
    </div>
    
    <div class="divider"></div>
    
    <div class="formSection">
        <label>Score:</label> 
        <?php echo(htmlspecialchars($incLevelScore)); ?>
        % or higher to increase level
    </div>
    
    <div class="divider"></div>
    
    <div class="formSection">
        <label>Score:</label>
        <?php echo(htmlspecialchars($decLevelScore)); ?>
        % or lower to decrease level
    </div>
    
</div>

<form class="inline" action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, EXAMPARAMETERSEDIT_ACTION)); ?>" method="post">
    <input type="submit" value="Edit" />
</form>
<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
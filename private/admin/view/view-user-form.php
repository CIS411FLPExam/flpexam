<?php
    include( HEADER_FILE );
    include( CONTROLPANEL_FILE );
?>
<!-- Start main content here -->
<h1>User</h1>

<div class="formGroup">
    
    <div class="formSection">
        <label>User Name:</label><?php echo(htmlspecialchars($userName)); ?>
    </div>
    
    <div class="divider"></div>
    
    <div class="formSection">
        <label>Roles:</label>
        <ul>
            <?php foreach ($hasAttrResults as $row) { ?>
            <li><?php echo($row[NAME_IDENTIFIER]); ?></li>
            <?php } ?>
        </ul>
    </div>
    
    <?php if(userIsAuthorized(USEREDIT_ACTION)) { ?>
        <input type="button" value="Edit" onclick="Relocate('<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, USEREDIT_ACTION . "&". USERID_IDENTIFIER . "=" . urlencode($userID))) ?>');" />
    <?php } ?>
</div>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
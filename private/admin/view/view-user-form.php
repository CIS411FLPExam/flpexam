<?php
    include( GetHeaderFile() );
    include( GetControlPanelFile() );
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
            <li><?php echo($row[GetNameIdentifier()]); ?></li>
            <?php } ?>
        </ul>
    </div>
    
    <?php if(userIsAuthorized(GetUserEditAction())) { ?>
        <input type="button" value="Edit" onclick="Relocate('<?php echo(GetControllerScript(GetAdminControllerFile(), GetUserEditAction() . "&". GetUserIdIdentifier() . "=" . urlencode($userID))) ?>');" />
    <?php } ?>
</div>

<!-- End main content here -->
<?php
    include( GetFooterFile() ); 
?>
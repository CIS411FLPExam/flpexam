<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->
<div class="formGroup">
    <div class="formSection">
        <label>First Name:</label><label><?php echo(htmlspecialchars($firstName)); ?></label>
    </div>
    
    <div class="divider"></div>
    
    <div class="formSection">
        <label>Last Name:</label><label><?php echo(htmlspecialchars($lastName)); ?></label>
    </div>
    
    <div class="divider"></div>
    
    <div class="formSection">
        <label>User Name:</label><label><?php echo(htmlspecialchars($userName)); ?></label>
    </div>
    
    <div class="divider"></div>
    
    <div class="formSection">
        <label>Email:</label><label><?php echo(htmlspecialchars($email)); ?></label>

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
        <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, USEREDIT_ACTION . "&". USERID_IDENTIFIER . "=" . urldecode($userID))) ?>">
            Edit
        </a>
    <?php } ?>
</div>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
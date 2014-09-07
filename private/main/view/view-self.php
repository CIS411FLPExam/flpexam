<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

<div class="formGroup">
    <div class="formSection">
        First Name: <label><?php echo(htmlspecialchars($firstName)); ?></label>
    </div>
    
    <div class="divider"> </div>
    
    <div class="formSection">
        Last Name: <label><?php echo(htmlspecialchars($lastName)); ?></label>
    </div>
    
    <div class="divider"> </div>
    
    <div class="formSection">
        User Name: <label><?php echo(htmlspecialchars($userName)); ?></label>
    </div>
    
    <div class="divider"> </div>
    
    <div class="formSection">
        Email: <label><?php echo(htmlspecialchars($email)); ?></label>
    </div>
    
    <?php if(userIsAuthentic($userID)) { ?>
        <div class="formSection">
            <form action="<?php echo(GetControllerScript(MAINCONTROLLER_FILE,CHANGEPASSWORD_ACTION)) ?>" method="post">
                <input type="hidden" name="<?php echo(USERID_IDENTIFIER) ?>" value="<?php echo($userID); ?>" />
                <input type="submit" value="Change Password" />
            </form>
            <form action="<?php echo(GetControllerScript(MAINCONTROLLER_FILE,SELFEDIT_ACTION)) ?>" method="post">
                <input type="hidden" name="<?php echo(USERID_IDENTIFIER) ?>" value="<?php echo($userID); ?>" />
                <input type="submit" value="Edit" />
            </form>
        </div>
    <?php } ?>
</div>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
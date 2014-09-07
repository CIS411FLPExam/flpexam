<?php
    include( HEADER_FILE );
?>
<!-- Start main content here -->

First Name: <label><?php echo(htmlspecialchars($firstName)); ?></label>

<br />

Last Name: <label><?php echo(htmlspecialchars($lastName)); ?></label>

<br />

User Name: <label><?php echo(htmlspecialchars($userName)); ?></label>

<br />

Email: <label><?php echo(htmlspecialchars($email)); ?></label>

<br />

<ul>
    <?php foreach ($hasAttrResults as $row) { ?>
    <li><?php echo($row[NAME_IDENTIFIER]); ?></li>
    <?php } ?>
</ul>

<?php if(userIsAuthorized(USEREDIT_ACTION)) { ?>
    <a href="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE, USEREDIT_ACTION . "&". USERID_IDENTIFIER . "=" . urldecode($userID))) ?>">
        <input type="button" value="Edit" />
    </a>
<?php } ?>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
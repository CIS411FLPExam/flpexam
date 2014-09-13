
<?php
    
    $has_attributes = array( );
    $hasnt_attributes = array( );
    
    $i = 0;
    foreach ($hasAttrResults as $row) {
        $has_attributes[$i]["id"] = $row["RoleID"];
        $has_attributes[$i]["name"] = $row["Name"];
        ++$i;
    }

    $i = 0;
    foreach ($hasNotAttrResults as $row) {
        $hasnt_attributes[$i]["id"] = $row["RoleID"];
        $hasnt_attributes[$i]["name"] = $row["Name"];
        ++$i;
    }

    $select1 = "<select id=\"hasAttributes\" name=\"hasAttributes[]\" size=\"10\" style=\"width:200px;\" multiple=\"multiple\">\n";
    for($i = 0; $i < count($has_attributes); ++$i) {
        $attrid = $has_attributes[$i]["id"];
        $attrname = $has_attributes[$i]["name"];
        $select1 .= "<option value=\"$attrid\">$attrname</option>\n";
    }
    $select1 .= "</select>";

    $select2 = "<select id=\"hasntAttributes\" name=\"hasntAttributes[]\" size=\"10\" style=\"width:200px;\" multiple=\"multiple\">\n";
    for($i = 0; $i < count($hasnt_attributes); ++$i) {
        $attrid = $hasnt_attributes[$i]["id"];
        $attrname = $hasnt_attributes[$i]["name"];
        $select2 .= "<option value=\"$attrid\">$attrname</option>\n";
    }
    $select2 .= "</select>";
    
    include( HEADER_FILE);
    include( CONTROLPANEL_FILE );
?>
<!-- Start main content here -->

<h2>Modify User</h2>

<form action="<?php echo(GetControllerScript(ADMINCONTROLLER_FILE,PROCESSUSEREDIT_ACTION)) ?>" method="post" onsubmit="selectAll('hasAttributes')">
    <input type="hidden" name="<?php echo(USERID_IDENTIFIER) ?>" value="<?php echo(htmlspecialchars($id)); ?>"/>
    <div class="formGroup">
        <div class="formSection">
            <label>Username:</label>
            <input name="<?php echo(USERNAME_IDENTIFIER) ?>" class="formInput" type="text" value="<?php echo(htmlspecialchars($userName)); ?>" />
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Password:</label>
            <input name="<?php echo(PASSWORD_IDENTIFIER) ?>" class="formInput" type="password" />
        </div>
        
        <div class="divider"></div>
        
        <div class="formSection">
            <label>Password Retype:</label>
            <input name="<?php echo(PASSWORDRETYPE_IDENTIFIER) ?>" class="formInput" type="password" />
        </div>
        
        <div class="divider"></div>
        
        <table>

            <tr>
                <td>
                    <b>Is</b><br/>
                    <?php echo $select1; ?>
                </td>

                <td>
                    <input type="button" value=">>" onclick="swap('hasAttributes','hasntAttributes')"><br/>
                    <br/>
                    <input type="button" value="<<" onclick="swap('hasntAttributes','hasAttributes')"><br/>
                </td>

                <td>
                    <b>Is Not</b><br/>
                    <?php echo $select2; ?>
                </td>
            </tr>

        </table>

        <br/>

        <input type="submit" value="Submit" />
    </div>
</form>

<!-- End main content here -->
<?php
    include( FOOTER_FILE ); 
?>
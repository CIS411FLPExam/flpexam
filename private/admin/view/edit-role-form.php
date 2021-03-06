<?php
    $has_attributes = array( );
    $hasnt_attributes = array( );
    
    $i = 0;
    foreach ($hasAttrResults as $row) {
        $has_attributes[$i]["id"] = $row["FunctionID"];
        $has_attributes[$i]["name"] = $row["Name"];
        ++$i;
    }

    $i = 0;
    foreach ($hasNotAttrResults as $row) {
        $hasnt_attributes[$i]["id"] = $row["FunctionID"];
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

    include( GetHeaderFile() );
    include( CONTROLPANEL_FILE );
?>
<!-- Start main content here -->

<h2>Modify Role</h2>

<div class="formGroup">
    <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(),GetProcessRoleAddEditAction())) ?>" method="post" onsubmit="selectAll('hasAttributes')">
        <input type="hidden" name="RoleID" value="<?php echo htmlspecialchars($id); ?>"/>
        <div class="formSection">
            <label>Name<span class="redText">*</span>:</label><input type="text" name="Name" size="20" value="<?php echo htmlspecialchars($name); ?>" autofocus required />
            <div class="clear"></div>
        </div>

        <div class="divider"></div>

        <div class="formSection">
            <label>Description:</label><input type="text" name="Description" size="20" value="<?php echo htmlspecialchars($desc); ?>" />
            <div class="clear"></div>
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
    </form>
    <form class="inline" action="<?php echo(GetControllerScript(GetAdminControllerFile(), GetManageRolesAction())); ?>" method="post">
        <input type="submit" value="Cancel" />
    </form>
</div>

<!-- End main content here -->
<?php
    include( GetFooterFile() ); 
?>
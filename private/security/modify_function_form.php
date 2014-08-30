<?php
    require_once ( "../php/DocInfo.php" );
    
    $docInfo = new wg\custom\DocInfo( );
    $docInfo->SetTitle( "VP Desings Control Panel - Modify Function" );
    $docInfo->SetAuthor( "Wesley Garey" );
    $docInfo->SetDescription( "Fashion Designs" );
    
    $docInfo->SetTags( array( "desings", "clothes" ) );
    
    include( "../includes/header.php" );
    include('control_panel.php');
?>
<!-- Start main content here -->

<h2>Modify Function</h2>

<form action="index.php?action=ProcessFunctionAddEdit" method="post">

        <input type="hidden" name="FunctionID" value="<?php echo $id; ?>"/>

        Name:  <input type="text" name="Name" size="20" value="<?php echo $name; ?>" /><br/>
        Description: <input type="text" name="Description" size="20" value="<?php echo $desc; ?>" />

        <br/>

        <input type="submit" value="Submit" />

</form>

<!-- End main content here -->
<?php
    include( "../includes/footer.php" ); 
?>
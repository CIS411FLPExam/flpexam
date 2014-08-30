<?php
    require_once ( "../php/DocInfo.php" );
    
    $docInfo = new wg\custom\DocInfo( );
    $docInfo->SetTitle( "VP Desings" );
    $docInfo->SetAuthor( "Wesley Garey" );
    $docInfo->SetDescription( "Fashion Designs" );
    
    $docInfo->SetTags( array( "desings", "clothes" ) );
    
    include( "../includes/header.php" );
    include('control_panel.php');
?>
<!-- Start main content here -->
   
<h2>Add Function</h2>

<form action="index.php?action=ProcessFunctionAddEdit" method="post">

        Name: <input type="text" name="Name" size="20" value=""><br/> 
        Description: <input type="text" name="Description" size="20" value=""><br/> 

        <br/>

        <input type="submit" value="Submit" />

</form>
	
<!-- End main content here -->
<?php
    include( "../includes/footer.php" ); 
?>
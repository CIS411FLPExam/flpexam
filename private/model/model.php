<?php
    require_once ( '../php/Constants.php' );
    
    function GetDBConnection( )
    {
        $dsn = 'mysql:host=localhost;dbname=s_wdgarey_vpdesigns';
        $username = 's_wdgarey';
        $password = 'Pimp9919';

        try
        {
            $db = new PDO( $dsn, $username, $password );
        }
        catch ( PDOException $e )
        {
            $message = $e->getMessage( );
            include ( MESSAGE_FILE_PATH );
            die;
        }
        
        return $db;            
    }
    
    function DeleteProduct( $id )
    {
        $db = GetDBConnection( );
        $query = "DELETE FROM product WHERE ID = :id";
        
        $statement = $db->prepare( $query );
        $statement->bindValue( ':id', $id );
        
        $success = $statement->execute( );
        $statement->closeCursor( );
        
        if ( $success )
        {
            return TRUE;
        }
        else
        {
            LogSQLError( $statement->errorInfo( ) );
            die;
        }
    }
    
    function UpdateProduct( $id, $name, $price, $isOnSale, $quantity, $category, $dateAdded, $imageName, $summary  )
    {
        $db = GetDBConnection( );
        $query = 'UPDATE product SET Name = :name, 
                                Price = :price,
                                IsOnSale = :isOnSale, 
                                Quantity = :quantity,
                                Category = :category,
                                DateAdded = :dateAdded,
                                ImageName = :imageName,
                                Summary = :summary
                          WHERE ID =  :id';
        
        $statement = $db->prepare( $query );
        $statement->bindValue( ':id', $id );
        $statement->bindValue( ':name', $name );
        $statement->bindValue( ':price', $price );
        $statement->bindValue( ':isOnSale', $isOnSale );
        $statement->bindValue( ':quantity', $quantity );
        $statement->bindValue( ':category', $category );
        $statement->bindValue( ':dateAdded', ToMySQLDate( $dateAdded ) );
        $statement->bindValue( ':imageName', $imageName );
        $statement->bindValue( ':summary', $summary );

        $success = $statement->execute( );
        $statement->closeCursor( );

        if ( $success )
        {
            return TRUE;
        }
        else
        {
            LogSQLError( $statement->errorInfo( ) );
            die;
        }
    }
    function InsertProduct( $name, $price, $isOnSale, $quantity, $category, $dateAdded, $imageName, $summary  )
    {
        $db = GetDBConnection( );
        $query = 'INSERT INTO product (Name, Price, IsOnSale, Quantity, Category, DateAdded, ImageName, Summary)
                        VALUES (:name, :price, :isOnSale, :quantity, :category, :dateAdded, :imageName, :summary)';
        $statement = $db->prepare($query);
        
        $statement->bindValue( ':name', $name );
        $statement->bindValue( ':price', $price );
        $statement->bindValue( ':isOnSale', $isOnSale );
        $statement->bindValue( ':quantity', $quantity );
        $statement->bindValue( ':category', $category );
        $statement->bindValue( ':dateAdded', ToMySQLDate( $dateAdded ) );
        $statement->bindValue( ':imageName', $imageName );
        $statement->bindValue( ':summary', $summary );
        
        $success = $statement->execute( );
        $statement->closeCursor( );

        if ( $success )
        {
            return $db->lastInsertId( );
        }
        else
        {
            LogSQLError( $statement->errorInfo( ) );
            die;
        }
    }
    
    function LogSQLError( $error )
    {
        $message = $error[2];
        include ( MESSAGE_FILE_PATH );
    }
    
    function GetAssociatedProducts( $content )
    {
        try
        {
            $db = GetDBConnection();
            $query = "SELECT * FROM product WHERE Name LIKE :content"
                    . " OR Category LIKE :content OR ImageName LIKE :content"
                    . " OR Summary LIKE :content ORDER BY Name";
            $statement = $db->prepare( $query );
            $statement->bindValue( ":content", '%' . $content . '%' );
            $statement->execute( );
            $product = $statement->fetchAll( );  // Should be 0 or 1 row
            
            $statement->closeCursor( );
            
            return $product;			 // False if 0 rows
        }
        catch ( PDOException $e )
        {
            $message = $e->getMessage( );
            include  ( MESSAGE_FILE_PATH );
            die;
        }
    }
    
    function GetAllCategories( )
    {
        try
        {
            $db = GetDBConnection( );

            $query = "SELECT DISTINCT(Category) AS Category FROM product ORDER BY Category;";

            $statement = $db->prepare( $query );
            $statement->execute( );
            $results = $statement->fetchAll( );

            $statement->closeCursor( );

            return $results;
        }
        catch ( PDOException $e )
        {
            $message = $e->getMessage( );
            include  ( MESSAGE_FILE_PATH );
            die;
        }
    }
    
    function GetProduct( $id )
    {
        try
        {
            $db = GetDBConnection();
            $query = "SELECT * FROM product WHERE ID = :id";
            $statement = $db->prepare( $query );
            $statement->bindValue( ":id", $id );
            $statement->execute( );
            
            $product = $statement->fetch( );  // Should be 0 or 1 row
            
            $statement->closeCursor( );
            
            return $product;			 // False if 0 rows
        }
        catch ( PDOException $e )
        {
            $message = $e->getMessage( );
            include  ( MESSAGE_FILE_PATH );
            die;
        }
    }
    
    function GetAllProducts( )
    {
        try
        {
            $db = GetDBConnection( );

            $query = "SELECT * FROM product ORDER BY Name";

            $statement = $db->prepare( $query );
            $statement->execute( );
            $results = $statement->fetchAll( );

            $statement->closeCursor( );

            return $results;
        }
        catch ( PDOException $e )
        {
            $message = $e->getMessage( );
            include  ( MESSAGE_FILE_PATH );
            die;
        }
    }
    
    function GetOnsaleProducts( )
    {
        try
        {
            $db = GetDBConnection( );

            $query = "SELECT * FROM product WHERE IsOnSale = 'Y' ORDER BY Name";

            $statement = $db->prepare( $query );
            $statement->execute( );
            $results = $statement->fetchAll( );

            $statement->closeCursor( );

            return $results;
        }
        catch ( PDOException $e )
        {
            $message = $e->getMessage( );
            include  ( MESSAGE_FILE_PATH );
            die;
        }
    }
    
    function GetProducts( $category )
    {
        try
        {
            $db = GetDBConnection( );

            $query = "SELECT * FROM product WHERE Category = :category  ORDER BY Name";
            
            $statement = $db->prepare( $query );
            $statement->bindValue( ':category', $category );
            $statement->execute( );
            $results = $statement->fetchAll( );

            $statement->closeCursor( );

            return $results;
        }
        catch ( PDOException $e )
        {
            $message = $e->getMessage( );
            include  ( MESSAGE_FILE_PATH );
            die;
        }
    }
    
    function GetRandomNewImages( $count )
    {
        require_once( FILERETRIEVER_PATH );
        require_once( ELEMENTCREATOR_PATH );

        $imageRetriever = new wg\custom\FileRetriever( );
        $elementCreator = new wg\custom\ElementCreator( );
        $imageRetriever->SetDir( NEW_IMAGE_DIR );

        $images = $imageRetriever->GetRandomFiles( $count );

        $count = count( $images );

        $imgList = array( );
        for( $i = 0; $i < $count; $i++ )
        {
            $src = NEW_IMAGE_DIR . $images[$i];
            $alt = "New item.";
            $imgList[] = $elementCreator->CreateIMG( $src, $alt ) ;
        }
        
        return $imgList;
    }
    
    function SaveNewImage( )
    {
        require_once ( FILEINFO_PATH );
        require_once ( FILERETRIEVER_PATH );
        
        $uploadfile = new \wg\custom\FileInfo( IMAGE_FILE_ID );
        $retriever = new wg\custom\FileRetriever( );
        
        $tmpName = $uploadfile->GetPath( );
        
        $retriever->SetDir( NEW_IMAGE_DIR );
        $files = $retriever->GetAllFiles( );
        
        $id = 0;
        
        $newImageNameFound = false;
        while( $newImageNameFound == false )
        {
            $id++;
            $newImageNameFound = true;
            $newName = "sample" . $id;
            
            for ( $i = 0; $i < count( $files ) && $newImageNameFound == true; $i++ )
            {
                $usedName = $files[$i];
            
                if ( strpos( $usedName , $newName ) !== false )
                {
                    $newImageNameFound = false;
                }
            }
        }
        
        $newName = $newName . "." . $uploadfile->GetExtension( );
        
        move_uploaded_file( $tmpName, NEW_IMAGE_DIR . $newName );
        
        return $newName;
    }
    
    function DeleteImageFile( $fileName )
    {
        $path = NEW_IMAGE_DIR . $fileName;
        
        unlink( $path );
    }
    
    function SaveQuoteFile( )
    {
        require_once ( FILEINFO_PATH );
    
        $uploadfile = new \wg\custom\FileInfo( QUOTE_FILE_ID );
        
        $tmpName = $uploadfile->GetPath( );
        $newName = QUOTEFILE_PATH;
        
        move_uploaded_file( $tmpName, $newName );
    }
    
    function SaveNewSalesFile( )
    {
        require_once ( FILEINFO_PATH );

        $uploadfile = new \wg\custom\FileInfo( SALES_FILE_ID );

        $tmpName = $uploadfile->GetPath( );
        $newName = $uploadfile->GetNewPath( SALES_FILE_DIR );

        move_uploaded_file( $tmpName, $newName );
    }
    
    function AddSubscriber( )
    {
        $email = $_POST[EMAIL_FIELD_ID];
        $newSubscriber = $email . "\n";
        $subscribers = file( SUBSCRIBERS_FILE_PATH );
        
        $subscribers[] = $newSubscriber;
        file_put_contents( SUBSCRIBERS_FILE_PATH, $subscribers );
    }
    
    function GetAllSubscribers( )
    {
        $recipients = array( );
        $subscribers = file( SUBSCRIBERS_FILE_PATH );
        foreach ( $subscribers as $subscriber )
        {
            $recipient = trim( $subscriber );
            if ( strlen( $recipient ) > 0 )
            {
                $recipients[] = $recipient;
            }
        }

        return $recipients;
    }
    
    function GetLatestSalesFile( )
    {
        require_once ( FILERETRIEVER_PATH );
        $retriever = new wg\custom\FileRetriever( );
        $retriever->SetDir( SALES_FILE_DIR );

        $latest_ctime = 0;
        $latest_filename = '';    

        $salesFiles = $retriever->GetAllFiles( );

        foreach ( $salesFiles as $entry )
        {
            $filepath = SALES_FILE_DIR . $entry;

            if ( is_file( $filepath ) && filectime( $filepath ) > $latest_ctime )
            {
              $latest_ctime = filectime( $filepath );
              $latest_filename = $filepath;
            }
        }
        
        return $latest_filename;
    }
    
    function GetEmailMailer( )
    {
        require_once 'Mail.php';
        
        $options = array();
        $options['host'] = 'ssl://smtp.gmail.com';
        $options['port'] = 465;
        $options['auth'] = true;
        $options['username'] = 'vpdesigns.company@gmail.com';
        $options['password'] = 'vpdesigns99';
        $mailer = Mail::factory( 'smtp', $options );
        
        return $mailer;
    }
    
    function GetEmailHeader( )
    {
        $headers = array ( );
        $headers['From'] = 'Vp Designs <vpdesigns.company@gmail.com>';
        $headers['Subject'] = 'VP Designs Sales';
        $headers['Content-type'] = 'text/html';

        return $headers;
    }
    
    function SendSubscriberEmails( )
    {
        $mailer = GetEmailMailer( );
        $headers = GetEmailHeader( );
        
        $recipients = GetAllSubscribers( );

        $latest_filename = GetLatestSalesFile( );

        if ( is_file( $latest_filename ) )
        {
            $message = file_get_contents( $latest_filename );
        }
        else
        {
            $message =  'Sorry, no sales.';
        }
        
        $mailer->send( $recipients, $headers, $message );
    }
    
    function GetAllDirectoryFiles( $dir )
    {
        require_once( FILERETRIEVER_PATH );
        
        $retriever = new wg\custom\FileRetriever( );
        
        $retriever->SetDir( $dir );
        
        $files = $retriever->GetAllFiles( );
        
        return $files;
    }
    
    function GetRandomQuote( )
    {
        $randomQuote = GetRandomLine( QUOTEFILE_PATH );
        
        return $randomQuote;
    }
    
    function GetRandomLine( $file )
    {
        $f_contents = file( $file );
        $line = $f_contents[array_rand( $f_contents )];
        return $line;
    }
?>
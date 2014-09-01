<!DOCTYPE html>
<html lang="en">
    <head>
            <?php
                if ( !isset( $dCharset ) ) { $dCharset = "UTF-8"; }
                if ( !isset( $dDescription ) ) { $dDescription = "Clarion University foreign language placement exam."; }
                if ( !isset( $dTags ) || !is_array( $dTags ) ) { $dTags = array( "Clarion", "University", "foreign", "language", "placement", "exam" ); }
                if ( !isset( $dAuthor) ) { $dAuthor = "FLP Exam Project Group"; }
                if ( !isset( $dTitle ) ) { $dTitle = "Foreign Language Placement Exam"; }
                
                $tags = "";
                foreach ( $dTags as $tag )
                {
                    $tags .= $tag . " ";
                }
                
                echo ( "<meta charset='" . $dCharset . "' />" );
                echo ( "<meta name='description' content='" . $dDescription . "' />" );
                echo ( "<meta name='keywords' content='" . $tags . "' /> "  );
                echo ( "<meta name='author' content='" . $dAuthor . "' /> " );
                
                //The page title.
                echo ( "<title>" . $dTitle . "</title>");
                
                //External page links.
                echo ( "<link rel='shortcut icon' href='" . ICON_FILE . "' />" );
                
                echo ( "<link rel='stylesheet' href='" . VALIDATIONCSS_FILE . "' />" );
                echo ( "<link rel='stylesheet' href='" . MAINCSS_FILE . "' />" );
                echo ( "<link rel='stylesheet' href='" . NAVBARCSS_FILE . "' />" );
                
                echo ( "<script type='text/javascript' src='" . MAINJS_FILE . "'></script>" );
                echo ( "<script type='text/javascript' src='" . NAVBARJS_FILE . "'></script>" );
                echo ( "<script type='text/javascript' src='" . ATTRIBUTES_FILE . "'></script>" );
                echo ( "<script type='text/javascript' src='" . JQUERYTABLESORTER_FILE . "'></script>" );
                echo ( "<script type='text/javascript' src='" . JQUERYVALIDATE_FILE . "'></script>" );
                echo ( "<script type='text/javascript' src='" . JQUERY_FILE . "'></script>" );
            ?>
    </head>
    <body>        
        <div id="wrapper">
            <img src="<?php echo(LOGO_FILE) ?>" />
            <h1>Foreign Language Placement Exam</h1>
            <div class="clear"></div>
            <div id="navbar">
                <?php include( NAVBAR_FILE ); ?>
            </div>
            <div id="content">
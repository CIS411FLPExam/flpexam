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
                echo ( "<link rel='shortcut icon' href='" . ICON_FILEPATH . "' />" );
                echo ( "<script type='text/javascript' src='" . JQUERY_FILE_PATH . "'></script>" );
                echo ( "<link rel='stylesheet' href='" .MAINCSS_FILE_PATH . "' />" );
                echo ( "<link rel='stylesheet' href='" . NAVBARCSS_FILE_PATH . "' />" );
                echo ( "<script type='text/javascript' src='" . MAINJS_FILE_PATH . "'></script>" );
            ?>
    </head>

    <body>
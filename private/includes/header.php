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
        ?>

        <meta charset='<?php echo($dCharset); ?>' />
        <meta name='description' content='<?php echo($dDescription); ?>' />
        <meta name='keywords' content='<?php echo($tags); ?>' />
        <meta name='author' content='<?php echo($dAuthor); ?>' />

        <title><?php echo($dTitle); ?></title>

        <link rel='shortcut icon' href='<?php echo(ICON_FILE); ?>' />

        <link rel='stylesheet' href='<?php echo(VALIDATIONCSS_FILE); ?>' />
        <link rel='stylesheet' href='<?php echo(MAINCSS_FILE); ?>' />
        <link rel='stylesheet' href='<?php echo(NAVBARCSS_FILE); ?>' />

        <script type='text/javascript' src='<?php echo(JQUERY_FILE); ?>'></script>
        <script type='text/javascript' src='<?php echo(MAINJS_FILE); ?>'></script>
        <script type='text/javascript' src='<?php echo(NAVBARJS_FILE); ?>'></script>
        <script type='text/javascript' src='<?php echo(ATTRIBUTES_FILE); ?>'></script>
        <script type='text/javascript' src='<?php echo(JQUERYTABLESORTER_FILE); ?>'></script>
        <script type='text/javascript' src='<?php echo(JQUERYVALIDATE_FILE); ?>'></script>
    </head>
    <body>        
        <div id="wrapper">
            <header>
                <img src="<?php echo(LOGO_FILE) ?>" />
                <span class="banner">Foreign Language Placement Exam</span>
                <?php if(loggedIn()) { ?>
                <span id="username"><?php echo(htmlspecialchars($_SESSION[USERNAME_IDENTIFIER])); ?></span>
                <?php }?>
                <div class="clear"></div>
            </header>
            <nav id="navbar">
                <?php include( NAVBAR_FILE ); ?>
            </nav>
            <article id="content">
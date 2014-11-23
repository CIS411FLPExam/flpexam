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

        <link rel='shortcut icon' href='<?php echo(GetIconFile()); ?>' />

        <link rel='stylesheet' href='<?php echo(GetValidationCssFile()); ?>' />
        <link rel='stylesheet' href='<?php echo(GetMainCssFile()); ?>' />
        <link rel='stylesheet' href='<?php echo(GetNavbarCssFile()); ?>' />

        <script type='text/javascript' src='<?php echo(GetJQueryFile()); ?>'></script>
        <script type='text/javascript' src='<?php echo(GetMainJSFile()); ?>'></script>
        <script type='text/javascript' src='<?php echo(GetNavbarJSFile()); ?>'></script>
        <script type='text/javascript' src='<?php echo(GetAttributesFile()); ?>'></script>
        <script type='text/javascript' src='<?php echo(GetJQueryTableSorterFile()); ?>'></script>
        <script type='text/javascript' src='<?php echo(GetJQueryValidateFile()); ?>'></script>
        <script type='text/javascript' src='<?php echo(GetDynamicCollectionsJSFile()); ?>'></script>
    </head>
    <body>        
        <div id="wrapper">
            <header class="centerText">
                <?php if(loggedIn()) { ?>
                    <span class="username"><?php echo(htmlspecialchars($_SESSION[GetUserNameIdentifier()])); ?></span>
                <?php }?>
                <div class="clear"></div>
                <div class="inlineBlock centerText logoDiv">
                    <span class="whiteText clarionSpan">CLARION</span>
                    <br />
                    <span class="whiteText universitySpan">UNIVERSITY</span>
                </div>
                <span class="banner">Foreign Language Placement Exam</span>
            </header>
            <?php if(loggedIn()) { ?>
            <nav id="navbar">
                <?php include( GetNavbarFile() ); ?>
            </nav>
            <?php } ?>
            <article id="content" class="<?php if(loggedIn()) { echo('shiftContent'); } ?>">
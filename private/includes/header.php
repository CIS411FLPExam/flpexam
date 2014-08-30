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
                echo ( "<link rel='shortcut icon' href='../images/icons/vp-designs.ico' />" );
                echo ( "<script type='text/javascript' src='../js/jquery-1.9.1.min.js'></script>" );
                echo ( "<link rel='stylesheet' href='../lib/960-grid-system/code/css/960_12_col.css' />" );
                echo ( $docInfo->GetLinksString( ) );
                echo ( "<link rel='stylesheet' href='../css/main.css' />" );
                echo ( "<link rel='stylesheet' href='../css/navbar.css' />" );
                echo ( "<script type='text/javascript' src='../js/main.js'></script>" );
            ?>
    </head>

    <body>
            <div id="wrapper">
                <header id="mainHeader">
                    <img src="../images/vpdesigns/vp-designs-logo-2.png" alt="VP Designs logo."/>

                    <div class="navbarContainer">
                        <nav id="majorNavigation" class="navbar">
                            <ul id="mainGroup" class="themeColor1">
                                <li id="homeGroup" class="themeColor1">
                                    <a href="../controller/controller.php?action=home">Home</a>
                                    <ul id="homeSubgroup" class="themeColor1">
                                    </ul>
                                </li>
                                <li id="salesGroup" class="themeColor1">
                                    <a href="../controller/controller.php?action=sales">Sales</a>
                                    <ul id="salesSubgroup" class="themeColor1">
                                    </ul>
                                </li>
                                <li id="topsGroup" class="themeColor1">
                                    <a href="../controller/controller.php?action=display-products&Type=Category&Category=Top">Tops</a>
                                    <ul id="topsSubgroup" class="themeColor1">
                                        <li><a href="../controller/controller.php?action=display-products&Type=Category&Category=Shirt">Shirts</a></li>
                                        <li><a href="../controller/controller.php?action=display-products&Type=Category&Category=Sweater">Sweaters</a></li>
                                    </ul>
                                </li>
                                <li id="bottomsGroup" class="themeColor1">
                                        <a href="../controller/controller.php?action=display-products&Type=Category&Category=Bottom">Bottoms</a>
                                        <ul id="bottomsSubgroup" class="themeColor1">
                                            <li><a href="../controller/controller.php?action=display-products&Type=Category&Category=Shorts">Shorts</a></li>
                                            <li><a href="../controller/controller.php?action=display-products&Type=Category&Category=Pants">Pants</a></li>
                                        </ul>
                                </li>
                                <li id="dressesGroup" class="themeColor1">
                                    <a href="../controller/controller.php?action=display-products&Type=Category&Category=Dress">Dresses</a>
                                    <ul id="dressesSubgroup" class="themeColor1">
                                        <li><a href="../controller/controller.php?action=display-products&Type=Category&Category=Casual">Casual</a></li>
                                        <li><a href="../controller/controller.php?action=display-products&Type=Category&Category=Fancy">Fancy</a></li>
                                        <li><a href="../controller/controller.php?action=display-products&Type=Category&Category=Comfort">Comfort</a></li>
                                    </ul>
                                </li>
                                <li id="shoesGroup" class="themeColor1">
                                    <a href="../controller/controller.php?action=display-products&Type=Category&Category=Shoes">Shoes</a>
                                    <ul id="shoesSubgroup" class="themeColor1">
                                        <li><a href="../controller/controller.php?action=display-products&Type=Category&Category=Heels">Heels</a></li>
                                        <li><a href="../controller/controller.php?action=display-products&Type=Category&Category=Sandals">Sandals</a></li>
                                        <li><a href="../controller/controller.php?action=display-products&Type=Category&Category=Slippers">Slippers</a></li>
                                    </ul>
                                </li>
                                <li id="hatsGroup" class="themeColor1">
                                    <a href="../controller/controller.php?action=display-products&Type=Category&Category=Hat">Hats</a>
                                    <ul id="hatsSubgroup" class="themeColor1">
                                        <li><a href="../controller/controller.php?action=display-products&Type=Category&Category=Church">Church</a></li>
                                        <li><a href="../controller/controller.php?action=display-products&Type=Category&Category=Winter">Winter</a></li>
                                        <li><a href="../controller/controller.php?action=display-products&Type=Category&Category=Summer">Summer</a></li>
                                    </ul>
                                </li>
                                <li id="extrasGroup" class="themeColor1">
                                    <a href="../controller/controller.php?action=display-products&Type=Category&Category=Extras">Extras</a>
                                    <ul id="extrasSubgroup" class="themeColor1">
                                        <li><a href="../controller/controller.php?action=display-products&Type=Category&Category=Socks">Socks</a></li>
                                        <li><a href="../controller/controller.php?action=display-products&Type=Category&Category=Necklaces">Necklaces</a></li>
                                        <li><a href="../controller/controller.php?action=display-products&Type=Category&Category=Scarf">Scarfs</a></li>
                                    </ul>
                                </li>
                                <li id="productsGroup" class="themeColor1">
                                    <a href="../controller/controller.php?action=display-products">Products</a>
                                    <ul id="productsSubgroup" class="themeColor1">
                                        <li><a href="../controller/controller.php?action=display-products">Display All</a></li>
                                        <li><a href="../controller/controller.php?action=search-products">Search</a></li>
                                    </ul>
                                </li>
                                <li id="subsribeGroup" class="themeColor1">
                                    <a href="../controller/controller.php?action=sales-subscriber">Subscribe</a>
                                    <ul id="subscribeSubgroup" class="themeColor1">
                                        <li><a href="../controller/controller.php?action=sales-subscriber">Sales</a></li>
                                    </ul>
                                </li>
                                <li id="helpGroup" class="themeColor1">
                                    <a href="../controller/controller.php?action=under-construction">Help</a>
                                    <ul id="helpSubgroup" class="themeColor1">
                                        <li><a href="../controller/controller.php?action=about">About</a></li>
                                        <li><a href="../controller/controller.php?action=ideas">Ideas</a></li>
                                        <li><a href="../controller/controller.php?action=checksheet">Checklist</a></li>
                                    </ul>
                                </li>
                                <li id="adminGroup" class="themeColor1">
                                    <a href="../security/index.php?action=security">Admin</a>
                                    <ul id="adminSubgroup" class="themeColor1">
                                        <?php if (userIsAuthorized("ManageUsers")) {  ?>
                                            <li><a href="../security/index.php?action=ManageUsers">Manage Users</a></li>
                                        <?php } 
                                            if (userIsAuthorized("ManageFunctions")) {  ?>
                                                <li><a href="../security/index.php?action=ManageFunctions">Manage Functions</a></li>
                                        <?php } 
                                            if (userIsAuthorized("ManageRoles")) {  ?>
                                                <li><a href="../security/index.php?action=ManageRoles">Manage Roles</a></li>
                                        <?php } ?>
                                        <?php 
                                            if( userIsAuthorized( "file-management" ) ) 
                                            {
                                        ?>
                                                <li><a href="../controller/controller.php?action=file-management">Manage Files</a></li>
                                        <?php
                                            }
                                            if( userIsAuthorized( "send-sales" ) )
                                            {
                                        ?>
                                                <li><a href="../controller/controller.php?action=send-sales">Send Sales EMail</a></li>
                                        <?php
                                            }
                                            if( userIsAuthorized( "add-product" ) ) 
                                            {
                                        ?>
                                                <li><a href="../controller/controller.php?action=add-product">Add Product</a></li>
                                        <?php
                                            }
                                        ?>
                                    </ul>
                                </li>
                                <li id="logGroup" class="themeColor1">
                                    <?php
                                        if ( !loggedIn( ) )
                                        {
                                            echo "<a href=\"../security/index.php?action=Login&RequestedPage=" . urlencode($_SERVER['REQUEST_URI']) . "\">Login</a>";                                    
                                        }
                                        else
                                        {
                                    ?>
                                        <a href="../security/index.php?action=LogOut">Logout</a>
                                    <?php 
                                        }
                                    ?>
                                    <ul id="logSubgroup" class="themeColor1">
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    <div class="clear"> </div>
                    </div>
                </header>

                <br />
                
                <section id ="mainContent" class="container_12">
                        

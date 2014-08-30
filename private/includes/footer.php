                </section>
			
                <br />
			
		<footer id="mainFooter">
                    <p>
                        <?php
                            echo( $randomQuote );
                        ?>
                    </p>
                    <nav id="minorNavigation">
                        <a href="../controller/controller.php?action=home">Home</a>
                        <a href="../security/index.php?action=security">Admin</a>
                        <a href="mailto:w.d.garey@eagle.clarion.edu.com?Subject=VP%20Designs%20Comments" target="_top">Contact Us</a>
                    </nav>
                    <p>
                        <?php
                            $filename = basename( $_SERVER['PHP_SELF'] );
                            if (file_exists( $filename ) )
                            {
                                echo "Last modified " . date ( "F d Y", filemtime( $filename ) ) . ".";
                            }
                        ?>
                    </p>
		</footer>
            </div>
        </body>
</html>
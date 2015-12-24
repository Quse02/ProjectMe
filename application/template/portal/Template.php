<?php include dirname(__FILE__) . '/Header.php'; ?>
<body>
<div id="main-container">
    <?php include dirname(__FILE__) . '/Banner.php'; ?>
        <div id="content">
            <?php
            // Only include content if it exists
            if ($_CONTENT) {
                try {
                    include "{$_CONTENT_DIR}{$_CONTENT}.php";
                } catch (Safe_Exception $ex) {
                    if ($_DEV) {
                        echo $ex->getMessage();
                        echo "<pre>{$ex->getTraceAsString()}</pre>";
                    } else {
                        echo $ex->getMessage();
                    }
                } catch (Exception $ex) {
                    if ($_DEV) {
                        echo $ex->getMessage();
                        echo "<pre>{$ex->getTraceAsString()}</pre>";
                    } else {
                        echo "Exception Occured";
                    }
                }
            } else {
                echo "	<p>Sorry, could not find page</p>";
            }
            ?>
        </div><!-- End Content -->
</div><!-- End Container -->
<?php include dirname(__FILE__) . '/Footer.php'; ?>
</body>

</html>
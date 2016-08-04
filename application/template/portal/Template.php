<?php
session_start();
include ('./application/content/data/dbh.php');
$user = new USER();

include dirname(__FILE__) . '/Header.php';
?>
<body>
    <?php include dirname(__FILE__) . '/Banner.php'; ?>
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
<?php include dirname(__FILE__) . '/Footer.php'; ?>
</body>

</html>
<?php
if ($_REQUEST['delete']) {

    $stmt = $user->runQuery("DELETE FROM tbl_uploads WHERE id=:file_id");
    $stmt->bindParam(":file_id", $_SESSION['project_id']);
    $stmt->execute();
}

?>
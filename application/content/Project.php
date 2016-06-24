<?php
if(!$user->is_logged_in()) {
    $user->redirect('Login');
}

$file_stmt = $user->runQuery("SELECT * FROM tbl_uploads");
$file_stmt->execute();
$results = $file_stmt->fetchAll(PDO::FETCH_ASSOC);

$folder = "./media/uploads/";
if(isset($_POST['btn-upload']))
{
    $file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];


    // new file size in KB
    $new_size = $file_size/1024;
    // new file size in KB

    // make file name in lower case
    $new_file_name = strtolower($file);
    // make file name in lower case

    $final_file = substr(strstr($new_file_name, '-'), strlen('-'));

    if(move_uploaded_file($file_loc,$folder.$final_file))
    {
        $stmt = $user->runQuery("INSERT INTO tbl_uploads(file,type,size,project) 
                                                VALUES(:file, :type, :size, :project)");
        $stmt->bindparam(":file", $final_file);
        $stmt->bindparam(":type", $file_type);
        $stmt->bindparam(":size", $new_size);
        $stmt->bindparam(":project", $_SESSION['project_name']);
        $stmt->execute();
        ?>
        <script>
            alert('File Uploaded Successfully');
            window.location.href='Project';
        </script>
        <?php
    }
    else
    {
        ?>
        <script>
            alert('error while uploading file');
            window.location.href='Project';
        </script>
        <?php
    }
} else if (isset($_POST['btn-delete'])) {

    $stmt = $user->runQuery("DELETE FROM tbl_uploads WHERE id=:file_id");
    $stmt->bindParam(":file_id", $_SESSION['project_id']);
    $stmt->execute();
    ?>
    <script>
        alert('File Deleted Successfully');
        window.location.href='Project';
    </script>
<?php
}
?>

<div id="main-content">
    <div id="left-side">
        <h2>Project: <?php echo $_SESSION['project_name']; ?></h2>

        <h2>File Manager</h2>
        <ul>
            <form method="post">
            <?php
            foreach ( $results as $output) {
                $_SESSION['project_id'] = $output['id'];
                if ( $output['project'] == $_SESSION['project_name']) {
                    ?>
                    <li><?php echo $output['project'] ?> - <a href="<?php echo $folder ?><?php echo $output['file'] ?>" target="_blank"><?php echo $output['file'] ?> </a>(<?php echo $output['size'] ?>KB) <button type="submit" class="btn-delete" name="btn-delete"></button> </li>
            <?php }
            } ?>
            </form>
        </ul>
    </div>
    <div id="right-side">
        <div class="login-box">
            <h2>File Upload</h2>
            <p>Add your document to this project.</p>
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="file" />
                <button type="submit" name="btn-upload">Submit</button>
            </form>
        </div>
        <div class="link-box">
            <h2>Time Entry</h2>
        </div>
    </div>
</div>

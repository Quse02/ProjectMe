<?php
if(!$user->is_logged_in()) { $user->redirect('Login'); }

$file_stmt = $user->runQuery("SELECT * FROM tbl_uploads");
$file_stmt->execute();
$results = $file_stmt->fetchAll(PDO::FETCH_ASSOC);
extract($results);

$folder = "./media/uploads/";
if(isset($_POST['btn-upload']))
{
    $file = rand(1000,100000)."-".$_FILES['file']['name'];
    $file_loc = $_FILES['file']['tmp_name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];

    // new file size in KB
    $new_size = $file_size/1024;

    // make file name in lower case
    $new_file_name = strtolower($file);

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
    } else
    { ?>
        <script>
            alert('error while uploading file');
            window.location.href='Project';
        </script>
        <?php
    }
} else if (isset($_POST['btn-delete']))
{
    $stmt = $user->runQuery("DELETE FROM tbl_uploads WHERE id=:file_id");
    $stmt->bindParam(":file_id", $_SESSION['project_id']);
    $stmt->execute();
    ?>
    <script type="text/javascript" src="media/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="media/js/bootbox.min.js"></script>
    <script type="text/javascript">
         bootbox.confirm("Are you sure you want to remove this file?", function(result) {
         // delete code here
         if (result === true) {
         alert('File Deleted Successfully');
         }
         });
    </script>
<?php
} ?>
<div class="wrapper-back">
    <div class="main-back">
        <div id="title"><h2><?php echo $_SESSION['project_name']; ?></h2></div>
        <div id="left-side">
            <h4>Project View</h4>
            <ul class="project-menu">
                <li><a href="#">Site Details</a></li>
                <li><a href="#">File Manager</a></li>
                <li><a href="#">Changelog</a></li>
                <li><a href="#">Contacts</a></li>
            </ul>
            <br />
            <h4>Admin View</h4>
            <ul class="project-menu">
                <li><a href="#">User Management</a></li>
                <li><a href="#">Time Tracker</a></li>
                <li><a href="#">Feature Log</a></li>
                <li><a href="#">Project Manager</a></li>
                <li><a href="#">File Manager</a></li>
            </ul>
        </div>
        <div id="right-side">
            <h2>Site Details</h2>
            <p><strong>Live URL:</strong> <a href="<?php echo $_SESSION['project_url']; ?>" target="_blank"><?php echo $_SESSION['project_url']; ?></a><br />
            <strong>Development Site:</strong> TBD<br />
            <strong>Project Status:</strong> <?php echo $_SESSION['project_status']; ?></p>
            <p><a href="#" target="_blank">Submit </a> a Feature Request/Change</p>
            <h2>File Manager</h2>
            <div class="login-box">
                <h3>Upload - Add a document, pdf, or spreadsheet</h3>
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="file" accept="image/*" />
                    <button type="submit" name="btn-upload">Submit</button>
                </form>
            </div>
            <ul class="project-items">
                <li>File Name (Size)<span class="float-right">Delete</span></li>
                <form method="post">
                    <?php
                    foreach ( $results as $output) {
                        $_SESSION['project_id'] = $output['id'];
                        if ( $output['project'] == $_SESSION['project_name']) {
                            ?>
                            <li><a href="<?php echo $folder ?><?php echo $output['file'] ?>" target="_blank">
                                <?php

                                if (strpos($output['type'], 'image') === 0) {
                                    ?>
                                    <img class="file_img" src="./media/uploads/<?php echo $output['file'] ?>" />
                                    <?php
                                } else {
                                    echo "<img class='file_img' src='./media/images/paper.png' />";
                                }

                                ?>
                                <?php echo $output['file'] ?> </a>(<?php echo $output['size'] ?>KB)
                                <a class="delete_product" data-id="<?php echo $product_id; ?>" href="javascript:void(0)">
                                <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </li>
                        <?php }
                    } ?>
                </form>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript" src="media/js/bootstrap.min.js"></script>
<script type="text/javascript" src="media/js/bootbox.min.js"></script>
<script>
    $(document).ready(function(){

        $('.delete_product').click(function(e){

            e.preventDefault();

            var pid = $(this).attr('data-id');
            var parent = $(this).parent("td").parent("tr");

            bootbox.dialog({
                message: "Are you sure you want to Delete ?",
                title: "<i class='glyphicon glyphicon-trash'></i> Delete !",
                buttons: {
                    success: {
                        label: "No",
                        className: "btn-success",
                        callback: function() {
                            $('.bootbox').modal('hide');
                        }
                    },
                    danger: {
                        label: "Delete!",
                        className: "btn-danger",
                        callback: function() {

                            $.post('Test', { 'delete':pid })
                                .done(function(response){
                                    location.reload();
                                })
                                .fail(function(){
                                    bootbox.alert('Something Went Wrong.');
                                })
                        }
                    }
                }
            });
        });
    });
</script>

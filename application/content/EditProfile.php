<?php
if(!$user->is_logged_in()) { $user->redirect('Login'); }

$stmt = $user->runQuery("SELECT * FROM users WHERE user_id=:uid");
$stmt->execute(array(":uid" => $_SESSION['userSession']));
$rows = $stmt->fetch(PDO::FETCH_ASSOC);
extract($rows);

if(isset($_POST['btn-update-profile']))
{
    $fname = $_POST['first_name_entry'];
    $lname = $_POST['last_name_entry'];
    $uname = $_POST['user_name_entry'];
    $imgFile = $_FILES['user_image']['name'];
    $tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];

    if($imgFile){
        $upload_dir = './media/uploads/'; // upload directory
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
        $userpic = rand(1000,1000000).".".$imgExt; // rename uploading image

        // allow valid image file formats
        if(in_array($imgExt, $valid_extensions)){
            // Check file size '5MB'
            if($imgSize < 5000000) {
                unlink($upload_dir.$rows['user_pic']);
                move_uploaded_file($tmp_dir,$upload_dir.$userpic);
            } else
            {
                $errMSG = "Sorry, your file is too large.";
            }
        } else
        {
            $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    } else
    {
        // if no image selected the old image remain as it is.
        $userpic = $rows['user_pic']; // old image from database
    }

    // if no error occured, continue ....
    if(!isset($errMSG))
    {
        $stmt = $user->runQuery("UPDATE users SET first_name=:fname,last_name=:lname,user_pic=:uPic,user_name=:uname WHERE user_id=:uid");
        $stmt->execute(array(":fname"=>$fname,":lname"=>$lname,":uPic"=>$userpic,":uname"=>$uname,":uid"=>$rows['user_id']));

        if($stmt->execute())
        {
            $successMSG = "new record succesfully inserted ...";
            header("refresh:0;UserProfile"); // redirects image view page after 5 seconds.
        } else
        {
            $errMSG = "error while inserting....";
        }
    }
} ?>
<div class="wrapper-back">
    <div class="main-back">
        <div id="title"><h2>Edit Profile for <?php echo $row['first_name'] . " " . $row['last_name']; ?></h2></div>
        <div id="left-side">
            <h4>Profile Options</h4>
            <ul class="project-menu">
                <li><a href="ResetPassword">Reset Password</a></li>
                <li><a href='Logout'>Logout</a></li>
            </ul>
        </div>
        <div id="right-side">
            <form class="form-signin" method="post" enctype="multipart/form-data">
                <ul class="edit-profile">
                    <li><label> First Name </label><input type="text" class="input-block-level" placeholder="First Name" value="<?php echo $rows['first_name'] ?>" name="first_name_entry" required /></li>
                    <li><label> Last Name </label><input type="text" class="input-block-level" placeholder="Last Name" value="<?php echo $rows['last_name'] ?>" name="last_name_entry" required /></li>
                    <li><label> Username </label><input type="text" class="input-block-level" placeholder="Username" value="<?php echo $rows['user_name'] ?>" name="user_name_entry" required /></li>
                    <li><label> Update Image </label><input class="input-group" type="file" name="user_image" accept="image/*" /></li>
                    <li><label> Current Image </label><img src="./media/uploads/<?php echo $rows['user_pic'] ?>" /></li>
                </ul>
                <button class="btn btn-large btn-primary" type="submit" name="btn-update-profile">Update</button>
            </form>
        </div>
    </div>
</div>

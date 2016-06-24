<?php
if(!$user->is_logged_in()) {
    $user->redirect('Login');
}

$stmt = $user->runQuery("SELECT * FROM users WHERE user_id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$rows = $stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['btn-update-profile']))
{
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $uname = $_POST['user_name'];

    $stmt = $user->runQuery("UPDATE users SET first_name=:fname,last_name=:lname,user_name=:uname WHERE user_id=:uid");
    $stmt->execute(array(":fname"=>$fname,":lname"=>$lname,":uname"=>$uname,":uid"=>$rows['user_id']));

    $msg = "<div class='alert alert-success'>
                <button class='close' data-dismiss='alert'>&times;</button>
                Profile Changed Successfully, you will now be redirected.
                </div>";
    header("refresh:0;UserProfile");
} else {
$msg = "<div class='alert alert-success'>
            <button class='close' data-dismiss='alert'>&times;</button>
            No Account found, Try again
            </div>";
}

?>
<div id="main-content">
    <div id="left-side">
        <p><strong>Hey </strong>  <?php echo $rows['first_name'] ?>, lets update some information on your profile.</p>
        <p>Use the form to the right to change it.</p>
    </div>
    <div id="right-side">
        <div class="login-box">
            <form class="form-signin" method="post">
                <h2>Edit Profile</h2>
                <input type="text" class="input-block-level" placeholder="First Name" value="<?php echo $rows['first_name'] ?>" name="first_name" required />
                <input type="text" class="input-block-level" placeholder="Last Name" value="<?php echo $rows['last_name'] ?>" name="last_name" required />
                <input type="text" class="input-block-level" placeholder="Username" value="<?php echo $rows['user_name'] ?>" name="user_name" required />
                <button class="btn btn-large btn-primary" type="submit" name="btn-update-profile">Update</button>
            </form>
        </div>
    </div>
</div>

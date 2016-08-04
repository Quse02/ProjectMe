<?php
$newid = $_SESSION['newid'];
$newcode = $_SESSION['newCode'];

if(empty($newid) && empty($newcode)) { $user->redirect('Login'); }

if(isset($newid) && isset($newcode))
{
    $id = base64_decode($newid);
    $code = $newcode;

    $stmt = $user->runQuery("SELECT * FROM users WHERE user_id=:uid AND tokenCode=:token");
    $stmt->execute(array(":uid"=>$id,":token"=>$code));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);

    if($stmt->rowCount() == 1)
    {
        if(isset($_POST['btn-reset-pass']))
        {
            $pass = $_POST['pass'];
            $cpass = $_POST['confirm-pass'];

            if($cpass!==$pass)
            {
                $msg = "<div class='alert alert-block'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Sorry!</strong>  Password Doesn't match. 
						</div>";
            } else
            {
                $password = md5($cpass);
                $stmt = $user->runQuery("UPDATE users SET user_pass=:upass WHERE user_id=:uid");
                $stmt->execute(array(":upass"=>$password,":uid"=>$rows['user_id']));

                $msg = "<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						Password Changed Successfully, you will now be redirected.
						</div>";
                header("refresh:5;UserProfile");
            }
        }
    } else
    {
        $msg = "<div class='alert alert-success'>
				<button class='close' data-dismiss='alert'>&times;</button>
				No Account found, Try again
				</div>";
    }
} ?>
<div class="wrapper-back">
    <div class="main-back">
        <div id="left-side">
            <div class="login-box">
                <form class="form-signin" method="post">
                    <h2>Password Reset</h2>
                    <input type="password" class="input-block-level" placeholder="New Password" name="pass" required />
                    <input type="password" class="input-block-level" placeholder="Confirm New Password" name="confirm-pass" required />
                    <button class="btn btn-large btn-primary" type="submit" name="btn-reset-pass">Update</button>
                </form>
            </div>
        </div>
        <div id="right-side">
            <p><strong>Hey </strong>  <?php echo $rows['first_name'] ?>, lets get that password reset for you.</p>
            <p>Use the form to the left to change it.</p>
            <p>Make a mistake? <a href="#">Return to Profile</a> </p>
            <?php
            if(isset($msg)) {
                echo $msg;
            } ?>
        </div>
    </div>
</div>
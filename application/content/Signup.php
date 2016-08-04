<?php
if($user->is_logged_in()!="") { $user->redirect('Main'); }

if(isset($_POST['btn-signup']))
{
    $uname = trim($_POST['txt_uname']);
    $umail = trim($_POST['txt_umail']);
    $upass = trim($_POST['txt_upass']);
    $fname = trim($_POST['txt_fname']);
    $lname = trim($_POST['txt_lname']);
    $upic = "tweed.png";
    $code = md5(uniqid(rand()));

    $stmt = $user->runQuery("SELECT * FROM users WHERE user_email=:email_id");
    $stmt->execute(array(":email_id"=>$umail));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($stmt->rowCount() > 0)
    {
        $msg = "
        <div class='alert alert-error'>
    <button class='close' data-dismiss='alert'>&times;</button>
     <strong>Sorry!</strong> this email already exists, please try another one.
     </div>
     ";
    } else
    {
        if($user->register($fname,$lname,$uname,$umail,$upass,$upic,$code))
        {
            $id = $user->lasdID();
            $key = base64_encode($id);
            $id = $key;

            $_SESSION['signupid'] = $id;
            $_SESSION['signupcode'] = $code;

            $message = "     
                Hello $uname,
                <br /><br />
                Welcome to ShaunQuartier.com!<br/>
                To complete your registration  please , just click following link<br/>
                <br /><br />
                <a href='http://shaunquartier.com/Verify' target='_blank'>Click HERE to Activate</a>
                <br /><br />
                Thanks,";
            $message .= "<input name='id' type='hidden' value='<?php echo " . $_SESSION["signupid"] . "; ?>' />";
            $message .= "<input name='code' type='hidden' value='<?php echo " . $_SESSION["signupcode"] . "; ?>' />";

            $subject = "Confirm Registration";

            $user->send_mail($umail,$message,$subject);
            $msg = "
                <div class='alert alert-success'>
                    <button class='close' data-dismiss='alert'>&times;</button>
                    <strong>Success!</strong>  We've sent an email to $umail.
                    Please click on the confirmation link in the email to create your account. 
                </div>
            ";

        } else
        {
            echo "sorry , Query could no execute...";
        }
    }
}
?>
<div class="wrapper-back">
    <div class="main-back">
        <div id="left-side">
            <h2>Sign up now to join my site!</h2>
                <p>Submit the form to become a member of my website.</p>
                <p>After finishing, you will receive an email in order to activate your account.</p>
        </div>
        <div id="right-side">
            <div class="login-box">
                <?php if(isset($msg)) echo $msg;  ?>
                <form class="form-signin" method="post">
                    <h2>Join Now</h2>
                    <div class="form-group">
                        <input type="text" class="input-block-level" placeholder="Username" name="txt_uname" required />
                    </div>
                    <div class="form-group">
                        <input type="email" class="input-block-level" placeholder="Email address" name="txt_umail" required />
                    </div>
                    <div class="form-group">
                        <input type="password" class="input-block-level" placeholder="Password" name="txt_upass" required />
                    </div>
                    <div class="form-group">
                        <input type="text" class="input-block-level" name="txt_fname" placeholder="First Name" required />
                    </div>
                    <div class="form-group">
                        <input type="text" class="input-block-level" name="txt_lname" placeholder="Last Name" required />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-block btn-primary" type="submit" name="btn-signup">Sign Up</button>
                    </div>
                    <p>Have an account already? <a href="Login">Login</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
<?php

if($user->is_logged_in()!="")
{
    $user->redirect('Main');
}

if(isset($_POST['btn-submit']))
{
    $umail = $_POST['txtemail'];

    $stmt = $user->runQuery("SELECT user_id FROM users WHERE user_email=:umail LIMIT 1");
    $stmt->execute(array(":umail"=>$umail));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() == 1)
    {
        $id = base64_encode($row['user_id']);
        $code = md5(uniqid(rand()));

        $stmt = $user->runQuery("UPDATE users SET tokenCode=:token WHERE user_email=:umail");
        $stmt->execute(array(":token"=>$code,"umail"=>$umail));

        $_SESSION['newid'] = $id;
        $_SESSION['newCode'] = $code;

        // HTML email starts here
        $message  = "<html><body>";
        $message .= "<input name='id' type='hidden' value='<?php echo " . $_SESSION["newid"] . "; ?>' />";
        $message .= "<input name='code' type='hidden' value='<?php echo " . $_SESSION["newCode"] . "; ?>' />";
        $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
        $message .= "<tr><td>";
        $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
        $message .= "<thead>
						<tr height='80'>
							<th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >Shaun Quartier</th>
						</tr>
						</thead>";

        $message .= "<tbody>
						<tr align='center' height='50' style='font-family:Verdana, Geneva, sans-serif;'>
							<td style='background-color:#00a2d1; text-align:center;'><a href='http://www.shaunquartier.com' style='color:#fff; text-decoration:none;'>Shaun Quartier</a></td>
						</tr>
						
						<tr>
							<td colspan='4' style='padding:15px;'>
								<p style='font-size:20px;'>Hey, $umail,</p>
								<hr />
								<p style='font-size:25px;'>We got your request to reset your password, if you made this request then just click the following link. If not, just ignore this email.
                                    <br /><br />Click Following Link To Reset Your Password <br /><br /></p>
								<p><a href='http://localhost:8001/ResetPassword' target='_blank'>Reset Your Password</a></p>
								<p>thank you,</p>
							</td>
						</tr>
						
						<tr height='80'>
							<td colspan='4' align='center' style='background-color:#f5f5f5; border-top:dashed #00a2d1 2px; font-size:24px; '>
							<label>
							Shaun Quartier On : 
							<a href='https://facebook.com/CodingCage' target='_blank'><img style='vertical-align:middle' src='https://cdnjs.cloudflare.com/ajax/libs/webicons/2.0.0/webicons/webicon-facebook-m.png' /></a>
							</label>
							</td>
						</tr>
						
						</tbody>";
        $message .= "</table>";
        $message .= "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";
        // HTML email ends here

        $subject = "Password Reset";

        $user->send_mail($umail,$message,$subject);

        $msg = "<div class='alert alert-success'>
     <button class='close' data-dismiss='alert'>&times;</button>
     We've sent an email to $umail.
                    Please click on the password reset link in the email to generate new password. 
      </div>";
    }
    else
    {
        $msg = "<div class='alert alert-danger'>
     <button class='close' data-dismiss='alert'>&times;</button>
     <strong>Sorry!</strong> Email not found. 
       </div>";
    }
}
?>


<div id="main-content">
    <div id="left-side">
        <h2>Forget Password</h2>
        <?php
        if(isset($msg)) {
            echo "<p>" . $msg . "</p>";
        } else { ?>
            <p>Please enter your email address. You will receive a link to create a new password via email.</p>
        <?php } ?>
        <p>Don't have an account? <a href="Signup">Sign Up Now!</a> </p>
    </div>
    <div id="right-side">
        <div class="login-box">
            <form class="form-signin forget" method="post">
                <br />
                <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
                <br />
                <button class="btn btn-danger btn-primary" type="submit" name="btn-submit">Generate new Password</button>
            </form>
        </div>
    </div>
</div> <!-- main content --> 
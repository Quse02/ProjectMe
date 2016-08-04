<?php
if($user->is_logged_in()!="")
{ $user->redirect('Main'); }

if(isset($_POST['btn-login']))
{
    $umail = $_POST['txtemail'];
    $upass = $_POST['txtupass'];

    if($user->login($umail,$upass))
    {
        $user->redirect('Main');
    }
}
?>
<div class="wrapper-back">
    <div class="main-back">
        <div id="left-side">
            <div class="login-box">
                <form method="post">
                    <?php
                    if(isset($_GET['error']))
                    { ?>
                        <div class='alert alert-success'>
                            <button class='close' data-dismiss='alert'>&times;</button>
                            <strong>Wrong Details!</strong>
                        </div>
                    <?php
                    } ?>
                    <h3>Sign In</h3>
                    <div class="form-group">
                        <input type="email" class="input-block-level" placeholder="Email address" name="txtemail" required />
                    </div>
                    <div class="form-group">
                        <input type="password" class="input-block-level" placeholder="Password" name="txtupass" required />
                    </div>
                    <div class="form-group">
                        <button class="btn btn-large btn-primary" type="submit" name="btn-login">Sign in</button>
                    </div>
                    <label>Don't have account yet! <a href="Signup">Sign Up</a></label>
                    <!--<a href="fpass.php">Lost your Password ? </a> -->
                </form>
            </div>
            <div class="login-box">
                <h3>Forget your Password?</h3>
                <p><a href="Forget_Password">Click Here </a> to have a new one sent to you.</p>
            </div>
        </div>
        <div id="right-side">
            <h2>Welcome to my Management Portal</h2>
            <p>This section is going be designed for project and management information. <br /> This project will consist of:</p>
            <ul>
                <li>Document Manager</li>
                <li>Tasks</li>
                <li>Links to Client &amp; Development Sites</li>
                <li>User/Client Profiles</li>
                <li>Team Collaboration Tools</li>
            </ul>
        </div>
    </div>
</div>
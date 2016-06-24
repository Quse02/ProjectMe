<?php

if($user->is_logged_in()!="")
{
    $user->redirect('Main');
}
?>
<div id="main-content">
    <div id="left-side">
        <h2>Error</h2>
        <?php echo $_SESSION['error_msg'] ?>
        <p><a href="Login">Back to Login Page</a> <br />
            <a href="Signup">Signup Now</a></p>
    </div>
</div>

<?php
if(!$user->is_logged_in()) {
    $user->redirect('Login');
}

$stmt = $user->runQuery("SELECT * FROM users WHERE user_id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$_SESSION['newid'] = base64_encode($row['user_id']);
$_SESSION['newCode'] = $row['tokenCode'];
?>

<div id="main-content">
    <div id="left-side">
        <h1>User Profile for <?php echo $row['first_name'] . " " . $row['last_name']; ?></h1>
        <ul>
            <li><label> Email </label><?php echo $row['user_email']; ?></li>
            <li><label> Username </label><?php echo $row['user_name']; ?></li>
            <li><label> User Group </label><?php echo $row['user_group']; ?></li>
            <li><label> First Name </label><?php echo $row['first_name']; ?></li>
            <li><label> Last Name </label><?php echo $row['last_name']; ?></li>
            <li><label> Hours Worked</label><?php echo $row['hoursWorked']; ?></li>
        </ul>
    </div>
    <div id="right-side">
        <div class="link-box">
            <h2>Profile Options</h2>
            <p><a href="ResetPassword">Reset Password</a><br />
            <a href="EditProfile">Edit Profile</a></p>
        </div>
    </div>
</div>
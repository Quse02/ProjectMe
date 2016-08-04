<?php
if(!$user->is_logged_in()) { $user->redirect('Login'); }

$stmt = $user->runQuery("SELECT * FROM users WHERE user_id=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
extract($row);

$_SESSION['newid'] = base64_encode($row['user_id']);
$_SESSION['newCode'] = $row['tokenCode'];
?>
<div class="wrapper-back">
    <div class="main-back">
        <div id="title"><h2>User Profile for <?php echo $row['first_name'] . " " . $row['last_name']; ?></h2></div>
        <div id="left-side">
            <h4>Profile Options</h4>
                <ul class="project-menu">
                    <li><a href="EditProfile">Edit Profile</a></li>
                    <li><a href="ResetPassword">Reset Password</a></li>
                    <li><a href='Logout'>Logout</a></li>
                </ul>
        </div>
        <div id="right-side">
            <ul class="user-profile">
                <li><label> Email </label><?php echo $row['user_email']; ?></li>
                <li><label> Username </label><?php echo $row['user_name']; ?></li>
                <li><label> User Group </label><?php echo $row['user_group']; ?></li>
                <li><label> First Name </label><?php echo $row['first_name']; ?></li>
                <li><label> Last Name </label><?php echo $row['last_name']; ?></li>
                <li><label> Hours Worked</label><?php echo $row['hoursWorked']; ?></li>
                <li><label> Profile Image </label><img src="./media/uploads/<?php echo $row['user_pic'] ?>" /></li>
            </ul>
        </div>
    </div>
</div>
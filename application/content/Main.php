<?php
if(!$user->is_logged_in()) {
    $user->redirect('Login');
}

$project_stmt = $user->runQuery("SELECT * FROM project");
$project_stmt->execute();
$project_row = $project_stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="main-content">
    <div id="left-side">
        <h1></h1>
            <h2>Projects</h2>
            <ul>
                <form method="post">
                <?php
                foreach ( $project_row as $project) { ?>
                    <div class="project">
                        <button class="btn-project" type="submit" name="btn-<?php echo $project['page'] ?>"><?php echo $project['name'] ?></button>
                    </div>
                    <?php

                    if(isset($_POST['btn-' . $project['page']]))
                    {
                        $_SESSION['project_name'] = $project['name'];
                        $user->redirect('Project');
                    }
                }
                ?>
                </form>
            </ul>
    </div>
    <div id="right-side">
        <div class="link-box">
            <h2>Admin Report</h2>
                <ul>
                    <li><a href="#">User Manager</a></li>
                    <li><a href="#">Project Manager</a></li>
                    <li><a href="#">File Manager</a></li>
                </ul>
        </div>
        <div class="link-box">
            <h2>User Options</h2>
                <ul>
                    <li><a href="UserProfile">View Profile</a></li>
                    <li><a href="EditProfile">Edit Profile</a></li>
                    <li><a href="Logout">Logout</a> </li>
                </ul>
        </div>
    </div>
</div>
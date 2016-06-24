<?php
if($user->is_logged_in()) {
    $stmt = $user->runQuery("SELECT * FROM users WHERE user_id=:uid");
    $stmt->execute(array(":uid"=>$_SESSION['userSession']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<div id="head-container">
    <div id="banner">
        <div id="logo">
            <a href='Home'></a>
            <?php
            if(!$user->is_logged_in()) {
                echo "<a href='Home'></a>";
            } else {
                echo "<a href='Main'></a>";
            }
            ?>
        </div>
        <div id="menu">
            <ul>
            <?php
            if(!$user->is_logged_in()) {
                echo "<li><a href='#about-page'><span>About</span></a></li>
                      <li><a href='#skillset-page'><span>Skillset</span></a></li>
                      <li><a href='#portfolio-page'><span>Portfolio</span></a></li>";
            } else {
                echo "<li><a href='UserProfile' title='User Profile'><span>" . $row['first_name'] . " " . $row['last_name']; "</span></a></li>";
                echo "<li><a href='Logout'><span>Logout</span></a></li>";
            }
            ?>
            </ul>
        </div>
    </div><!-- End banner -->
    <hr class="style-one-head" />
</div>

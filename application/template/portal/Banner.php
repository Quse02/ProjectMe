<?php
if($user->is_logged_in()) {
    $stmt = $user->runQuery("SELECT * FROM users WHERE user_id=:uid");
    $stmt->execute(array(":uid"=>$_SESSION['userSession']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);
}
?>
<div id="head-container">
    <div id="banner">
        <div id="logo">
            <a href='/'></a>
            <?php
            if(!$user->is_logged_in()) {
                echo "<a href='/'></a>";
            } else {
                echo "<a href='Main'></a>";
            }
            ?>
        </div>
        <div id="social_media_icons">
            <?php
            if(!$user->is_logged_in()) {
                echo "<ul>
                        <li><a class='facebook_icon' href='https://www.facebook.com/ShaunQuartier' target='_blank'></a></li>
                        <li><a class='twitter_icon' href='https://twitter.com/TheQuse' target='_blank'></a></li>
                        <li><a class='linkedin_icon' href='https://www.linkedin.com/in/quartiers' target='_blank'></a></li>
                        <li><a class='ghost-button-footer' href='Contact'>Contact Me</a></li>
                      </ul>";
            } else {
                echo "<a class='menu' href='UserProfile' title='User Profile'><img class='profile_img' src='./media/uploads/" .$row['user_pic'] . "' /> ". $row['first_name'] . " " . $row['last_name'] . "</a>";
                echo "(<a class='menu' href='Logout'>Logout</a>)";
            }
            ?>
        </div>
    </div><!-- End banner -->
    <hr class="style-one-head" />
</div>

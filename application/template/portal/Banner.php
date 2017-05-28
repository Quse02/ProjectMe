<?php
if($user->is_logged_in()) {
    $stmt = $user->runQuery("SELECT * FROM users WHERE user_id=:uid");
    $stmt->execute(array(":uid"=>$_SESSION['userSession']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    extract($row);
}
?>
<header>
    <div class="header__container">
        <div class="header__container__inner">
            <div class="logo">
                <?php
                if(!$user->is_logged_in()) {
                    echo "<a href='/'></a>";
                } else {
                    echo "<a href='Main'></a>";
                }
                ?>
            </div>
            <div class="social-icons">
                <?php
                if(!$user->is_logged_in()) {
                    echo "<div class='social-icons__item'><i class='fa fa-facebook fa-lg' aria-hidden='true'><a class='facebook_icon' href='https://www.facebook.com/ShaunQuartier' target='_blank'></a></i></div>
                            <div class='social-icons__item'><i class='fa fa-twitter fa-lg' aria-hidden='true'><a class='twitter_icon' href='https://twitter.com/TheQuse' target='_blank'></a></i></div>
                            <div class='social-icons__item'><i class='fa fa-github fa-lg' aria-hidden='true'><a class='github_icon' href='https://github.com/Quse02' target='_blank'></a></i></div>
                            <div class='social-icons__item'><i class='fa fa-linkedin fa-lg' aria-hidden='true'><a class='linkedin_icon' href='https://www.linkedin.com/in/quartiers' target='_blank'></a></i></div>";
                } else {
                    echo "<a class='menu' href='UserProfile' title='User Profile'><img class='profile_img' src='./media/uploads/" .$row['user_pic'] . "' /> ". $row['first_name'] . " " . $row['last_name'] . "</a>";
                    echo "(<a class='menu' href='Logout'>Logout</a>)";
                }
                ?>
            </div>
        </div><!-- End Inner -->
        <hr class="style-one-head" />
    </div>
</header>

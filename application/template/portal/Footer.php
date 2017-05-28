<footer>
    <div class="footer__container">
        <hr class="style-one-foot" />
        <div class="footer__container__inner">
            <div class="more_info">
                <p>Copyright @2017</p>
            </div>
            <div class="links">
                    <?php
                    if(!$user->is_logged_in()) {
                        echo "<div class='links__item'><a href=\"/\">Showcase</a></div>
                          <div class='links__item'><a href=\"Login\">Login</a></div>";
                    } ?>
            </div>
        </div><!-- End Footer -->

        <script type="text/javascript">
            $(window).load(function(){
                $('#skill').masonry({
                    // options
                    itemSelector: '.skill-box',
                    gutter: 15
                });
            });
        </script>
    </div>
</footer>

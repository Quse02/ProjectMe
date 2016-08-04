<div id="footer-container">
    <hr class="style-one-foot" />
    <div id="footer">
        <div id="more_info">
            <p>Copyright @2016</p>
        </div>
        <div id="links">
            <ul>
                <?php
                if(!$user->is_logged_in()) {
                    echo "<li><a href=\"\">Showcase</a></li>
                          <li><a href=\"Login\">Login</a></li>";
                } ?>
            </ul>
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
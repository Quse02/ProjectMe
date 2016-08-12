<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="This is the showcase portfolio for Shaun Quartier. This website displays his skills, connections, and information as a web developer" />
    <meta name="keywords" content="web developer,website,showcase,html,php,css,javascript,about,web design,Shaun Quartier,profile,portfolio" />
    <meta name="author" content="Shaun Quartier" />
    <meta name="robots" content="index, follow" />
    <title>Shaun Quartier - My Showcase</title>

    <link rel='stylesheet' href='media/css/bootstrap.min.css' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Work+Sans:400,500' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css' />
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="media/css/main.css" />
    <link rel="stylesheet" href="media/css/owl.carousel.css" />
    <link rel="stylesheet" href="media/css/owl.theme.css" />
    <link rel='stylesheet' href='media/css/onepage-scroll.css' type='text/css'>

    <link rel="shortcut icon" href="media/images/Logo.png" />
    <link rel="apple-touch-icon" href="media/images/apple-touch-icon.png" />

    <script type="text/javascript" language="JavaScript" src="media/js/_scripts.js"></script>
    <script type="text/javascript" src="media/js/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="media/js/jquery-ui-1.10.3.custom.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script type="text/javascript" src="media/js/owl.carousel.js"></script>
    <script type="text/javascript" src="media/js/masonry.pkgd.min.js"></script>
    <script type="text/javascript" src="media/js/jquery.onepage-scroll.js"></script>


    <script type="application/javascript">
        $(document).ready(function() {
            $(".main").onepage_scroll({
                sectionContainer: "section",
                loop: true
            });
            $("#owl-portfolio").owlCarousel({
                navigation : false, // Show next and prev buttons
                slideSpeed : 900,
                paginationSpeed : 400,
                singleItem:true
            });

            var path = window.location.pathname;
            if ((path == '/') || (path == '/Home')) {
                var d = new Date();
                var n = d.getHours();
                if (n > 19 || n < 6) {
                    // If time is after 7PM or before 6AM, apply night theme to ‘body’
                    $('body').addClass('Home').addClass('night');
                } else if (n > 16 && n < 19) {
                    // If time is between 4PM – 7PM sunset theme to ‘body’
                    $('body').addClass('Home').addClass('sunset');
                } else {
                    // Else use ‘day’ theme
                    $('body').addClass('Home').addClass('day');
                }
            } else {
                var newClass = path.match(/[^\/]*[^\d\/][^\/]*/);
                $('body').addClass(newClass[0]).addClass('NotHome');
            }

        });
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-73450808-1', 'auto');
        ga('send', 'pageview');
    </script>
</head>
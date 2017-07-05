<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $this->partial(getPath('views') . 'common/_head.php') ?>

        <link href="<?= get_url('css') ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?= get_url('css') ?>animate.min.css" rel="stylesheet">
        <link href="<?= get_url('css/front') ?>style.css" rel="stylesheet">
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    </head>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="row">
                <div class="site-logo">
                    <a href="<?= get_url('', FALSE) ?>" class="brand"><img src="/img/front/logo.png" height="60"></a>
                </div>

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="<?= get_url('', FALSE) ?>">Home</a></li>
                        <li><a href="<?= get_url('features', FALSE) ?>">Features</a></li>
                        <li><a class="btn btn-danger" href="<?= admin_url('')?>">Login</a></li>
                    </ul>
                </div>
                <!-- /.Navbar-collapse -->
            </div>
        </div>
    </nav>
    <!-- logo, check the CSS file for more info how the logo "image" is shown -->
    <div class="logo"></div>


    <?= $this->yieldView(); ?>

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
<!--                    <div class="text-center">
                        <a href="#home" class="scrollup"><i class="fa fa-angle-up fa-3x"></i></a>
                    </div>-->
                    &copy; Micro. All Rights Reserved.
                    <div class="credits">
                        <a href="javascript:;">Developed By </a> <a href="javascript:;">Rana Partap</a>
                    </div>
                </div>

                <div class="top-bar">
                    <div class="col-lg-12">
                        <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

</body>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script src="<?= get_url('js') ?>bootstrap.min.js" type="text/javascript"></script>
   <script src="<?= get_url('js') ?>jquery.easing.min.js" type="text/javascript"></script>
</html>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="assets/img/favicon.ico">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title><?= SITE_TITLE ?></title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!-- Bootstrap core CSS     -->
        <link href="<?= get_url('css') ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?= get_url('css') ?>animate.min.css" rel="stylesheet">
        <link href="<?= get_url('css') ?>light-bootstrap-dashboard.css" rel="stylesheet">
        <link href="<?= get_url('css') ?>dataTables.min.css" rel="stylesheet">
        <link href="<?= get_url('css') ?>dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="<?= get_url('css') ?>admin.css" rel="stylesheet">

        <!--     Fonts and icons     -->
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
        <link href="<?= get_url('css') ?>pe-icon-7-stroke.css" rel="stylesheet" />

        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script>var url = "<?php echo URL; ?>";</script>

    </head>
    <body>


        <div class="wrapper">

            <?= $this->partial(getPath('views') . 'admin/_sidebar.php') ?>

            <div class="main-panel">

                <?= $this->partial(getPath('views') . 'admin/_navbar.php') ?>

                <div class="content">
                    <div class="container-fluid">

                        <?= $this->partial(getPath('views') . 'admin/_flashes.php') ?>

                        <?= $this->yieldView(); ?>
                    </div>
                </div>

                <?= $this->partial(getPath('views') . 'admin/_footer.php') ?>

            </div>
        </div>

    </body>

    <!--   Core JS Files   -->
    <script src="<?= get_url('js') ?>bootstrap.min.js" type="text/javascript"></script>
    <script src="<?= get_url('js') ?>bootstrap-checkbox-radio-switch.js"></script>
    <script src="<?= get_url('js') ?>chartist.min.js"></script>
    <script src="<?= get_url('js') ?>dataTables.min.js"></script>
    <script src="<?= get_url('js') ?>dataTables.bootstrap.min.js"></script>
    <script src="<?= get_url('js') ?>bootstrap-notify.js"></script>
    <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>-->
    <script src="<?= get_url('js') ?>light-bootstrap-dashboard.js"></script>
    <!--<script src="<?= get_url('js') ?>demo.js"></script>-->

    <script type="text/javascript">
//            $(document).ready(function () {
//
//                demo.initChartist();
//
//                $.notify({
//                    icon: 'pe-7s-gift',
//                    message: "Welcome to <b>Light Bootstrap Dashboard</b> - a beautiful freebie for every web developer."
//
//                }, {
//                    type: 'info',
//                    timer: 4000
//                });
//
//            });
    </script>

</html>

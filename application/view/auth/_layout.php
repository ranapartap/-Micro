<!DOCTYPE html>
<html lang="en">
    <head>
        <?= $this->partial(getPath('views') . 'common/_head.php') ?>

        <link href="<?= get_url('css') ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?= get_url('css') ?>light-bootstrap-dashboard.css" rel="stylesheet">
        <link href="<?= get_url('css') ?>login.css" rel="stylesheet">

        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    </head>
    <body class="signup">

        <?= $this->yieldView(); ?>


        <script>
            var url = "<?php echo URL; ?>";
        </script>

    </body>

    <script src="<?= get_url('js') ?>bootstrap.min.js" type="text/javascript"></script>

</html>

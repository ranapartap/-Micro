<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>MINI3</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS -->
        <link href="<?= get_url('css') ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?= get_url('css') ?>login.css" rel="stylesheet">

        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    </head>
    <body>

        <?= $this->yieldView(); ?>


        <script>
            var url = "<?php echo URL; ?>";
        </script>

    </body>
</html>

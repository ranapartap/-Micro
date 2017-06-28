<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>MINI3</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- JS -->
        <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
        <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

        <!-- CSS -->
        <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
    </head>
    <body>
        <!-- logo, check the CSS file for more info how the logo "image" is shown -->
        <div class="logo"></div>
        <?= $this->yieldView(); ?>

        <!-- navigation -->
        <div class="navigation">
            <a href="<?= admin_url('', FALSE) ?>">Login Here</a>
        </div>
        <div class="navigation">
            <a href="<?= get_url('exampleone' , FALSE) ?>">Example 1 Page</a>
        </div>

        <!-- jQuery, loaded in the recommended protocol-less way -->
        <!-- more http://www.paulirish.com/2010/the-protocol-relative-url/ -->
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

        <!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
        <script>
            var url = "<?php echo URL; ?>";
        </script>

        <!-- our JavaScript -->
        <script src="<?php echo URL; ?>js/application.js"></script>
    </body>
</html>

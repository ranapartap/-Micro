<meta charset="utf-8">
<title><?= SITE_TITLE_DESC ?></title>
<meta name="description" content="">
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

<?php

if( !\Micro\Controller\AuthController::validate(ROLE_ADMIN) ){
    $seconds_to_cache = 60*5; //3 min  //3600 //1 hr 60secx 60 min;
    $ts = gmdate("D, d M Y H:i:s", time() + $seconds_to_cache) . " GMT";
    header("Expires: $ts");
    header("Pragma: cache");
    header("Cache-Control: max-age=$seconds_to_cache");
}
?>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="apple-touch-icon" sizes="76x76" href="<?= get_url('img') ?>apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?= get_url('img') ?>favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?= get_url('img') ?>favicon-16x16.png">
<link rel="shortcut icon" href="<?= get_url('img') ?>favicon.ico" type="image/x-icon">

<script>
    var ajaxurl = "<?= URL ?>";
    var currenturl = "<?=  \Micro\Core\Application::$request->uri() ?>";
</script>
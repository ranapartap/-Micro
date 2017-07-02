<?php
//"blue | azure | green | orange | red | purple"
?>

<div class="sidebar" data-color="azure" data-image="../assets/img/full-screen-image-3.jpg">

    <div class="logo">
        <a href="<?= get_url(ADMIN_BASE) ?>" class="logo-text">
            <?= SITE_TITLE ?>
        </a>
    </div>
    <div class="logo logo-mini">
        <a href="<?= get_url(ADMIN_BASE) ?>" class="logo-text">
            <?= SITE_TITLE_MINI ?>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="/img/default-avatar.png" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                    Tania Andrew
                    <b class="caret"></b>
                </a>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <li><a href="#">My Profile</a></li>
                        <li><a href="#">Edit Profile</a></li>
                        <li><a href="#">Settings</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <?= Micro\Controller\BaseController::getSidebarMenu(); ?>

            <!--            <li>
                            <a data-toggle="collapse" href="#mapsExamples">
                                <i class="pe-7s-map-marker"></i>
                                <p>Maps
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <div class="collapse" id="mapsExamples">
                                <ul class="nav">
                                    <li><a href="maps/google.html">Google Maps</a></li>
                                    <li><a href="maps/vector.html">Vector Maps</a></li>
                                    <li><a href="maps/fullscreen.html">Full Screen Map</a></li>
                                </ul>
                            </div>
                        </li>-->

    </div>
</div>
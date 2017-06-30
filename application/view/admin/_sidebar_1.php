<?php
$admin_menus = unserialize(ADMIN_MENUS);
?>
<div class="sidebar" data-color="azure" data-image="assets/img/sidebar-5.jpg">

    <!--
        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag
    -->

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="<?= get_url('admin') ?>" class="simple-text">
                    <?=SIDEBAR_TITLE?>
                </a>
            </div>
            <ul class="nav">

                <?php foreach ($admin_menus as $key => $menu) : ?>
                <li class="<?= curent_url_verify($menu['url']) ? 'active': '' ?>">
                    <a href="<?= admin_url($menu['url'], FALSE) ?>">
                        <i class="<?=$menu['icon']?>"></i>
                        <p><?=$menu['name']?></p>
                    </a>
                </li>
                <?php endforeach; ?>


            </ul>
    	</div>
    </div>
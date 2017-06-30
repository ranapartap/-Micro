<?php
/**
 * There are some variables attached to every function which is called from RouterController,
 * these variables are set by our Router, You can read more on https://github.com/klein/klein.php
 * We have pass these variables to our controller functions to act on Request, Response, Services and App
 *
 * @param type $req - Request Object - Like URI, Request Parameters etc.
 * @param type $res - Respond to all requests like get, put, handle uri requests etc.
 * @param type $service - Handle Views etc.
 * @param type $app - Custom declared global variables
 */
namespace Micro\Controller;

use Micro\Core\SessionManager;

class BaseController
{
    public static $current_uri;

    /**
     * Render Sidebar Admin Menu
     */
    public static function getSidebarMenu() {

        $admin_menus = unserialize(ADMIN_MENUS);
        ?>
        <ul class="nav">

        <?php foreach ($admin_menus as $key => $menu) : ?>
            <?php
            $active='';
            if(isset($menu['sub_menu'])){
                foreach ($menu['sub_menu'] as $k => $v)
                {
                    if(curent_url_verify($v['url']) )
                        $active = 'active';
                }
            }
            ?>


            <li class="<?= curent_url_verify($menu['url']) || $active=="active" ? 'active' : '' ?>">
                <a  <?php if(isset($menu['sub_menu'])) { echo 'data-toggle="collapse"';} ?>
                    href="<?= isset($menu['sub_menu']) ? '#mid'.$menu['url'] : admin_url($menu['url']) ?>"
                >
                    <i class="<?= $menu['icon'] ?>"></i>
                    <p><?= $key ?>
                        <?php if(isset($menu['sub_menu'])) {echo '<b class="caret"></b>'; } ?>
                    </p>
                </a>

                <?php if(isset($menu['sub_menu'])):?>
                    <div class="collapse <?= $active=='active'? 'in' : ''?>" <?php if(isset($menu['sub_menu'])) { echo 'id="mid'.$menu['url'].'"';} ?>>
                        <ul class="nav">
                            <?php foreach ($menu['sub_menu'] as $sub_key => $sub_menu) : ?>
                                <li class="<?= curent_url_verify($sub_menu['url']) ? 'active' : '' ?>">
                                    <a href="<?= admin_url($sub_menu['url']) ?>"><?=$sub_key?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif;?>

            </li>
        <?php endforeach; ?>

        </ul>

        <?php
    }
}

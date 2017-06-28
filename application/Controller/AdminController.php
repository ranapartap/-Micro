<?php
namespace Micro\Controller;

use Micro\Controller\BaseController;


class AdminController extends BaseController {

    public function index($req, $res, $service, $app)
    {
        // load views
        $service->render(getPath('views') . 'admin/index.php',
                [   'pageTitle' => "Dashboard"
                ]);
    }


}

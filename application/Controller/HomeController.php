<?php
namespace Micro\Controller;

use Klein\ServiceProvider;
use Micro\Controller\BaseController;

class HomeController extends BaseController {
    
    public function index($req, $res, $service, $app)
    {
        // load views
        $service->render(getPath('views') . 'home/index.php');
    }

    public function exampleOne($req, $res, $service, $app)
    {
          // load views
        $service->render(getPath('views') . 'home/example_one.php');
    }

    public function exampleTwo($req, $res, $service, $app)
    {
        $service->render(getPath('views') . 'home/example_two.php');
    }
}

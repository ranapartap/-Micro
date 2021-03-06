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

use Klein\ServiceProvider;
use Micro\Controller\BaseController;
use Micro\Core\Application;

class HomeController extends BaseController {

    public function index()
    {
        // load views
        Application::$service->render(getPath('views') . 'home/index.php');
    }

    public function exampleOne()
    {
          // load views
        Application::$service->render(getPath('views') . 'home/example_one.php');
    }

    public function exampleTwo()
    {
        Application::$service->render(getPath('views') . 'home/example_two.php');
    }
}

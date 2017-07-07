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

use Klein\Klein;
use Micro\Core\SessionManager;
use Micro\Core\Model;
use Micro\Core\Application;
use Micro\Controller\AuthController;

class RouteController {

    public $router;

    /**
     * Start the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct() {

        //Declare the router object
        $this->router = new \Klein\Klein();

        //Create the Database Connection will be used in all Controllers with ($app->db->connection->[tablename()])
        $this->router->respond(function ($req, $res, $ser, $app) {
            $app->register('db', function() {
                $model = new Model();
                return $model;
            });

            Application::$request = $req;
            Application::$response = $res;
            Application::$service = $ser;
            Application::$app = $app;

//            Application::$pages = Application::$app->db->connection->posts->where('post_type=?', POST_TYPE_PAGE);
//            dd(Application::$pages ,1);

        });

        // Frontend requests handling
        $this->frontend(new \Micro\Controller\HomeController());

        // Admin Panel requests handling
        // ADMIN_BASE is defined in /public/constants.php
        // with this constant we can change Admin Panel url easily for every new application
        $this->router->with('/'.ADMIN_BASE, function () {

            // Declare the session variable
            $session = new SessionManager();

            // Check user role is ADMIN
            // sometime we have more than one roles like NON-REGISTERED, REGISTERED USER, ADMIN,
            // we do not want Admin Panel access except ADMIN ROLE
            if (AuthController::validate( ROLE_ADMIN )) {

                // Admin Requests
                $this->admin(new \Micro\Controller\AdminController());

            } else {

                // Not logged in? Show login screen
                $this->login(new \Micro\Controller\AuthController());
            }
        });

        // Dynamic Pages
        $this->dynamicPages();

        // Process the Routes now
        $this->router->dispatch();
    }


    /**
     * Login Module
     */
    public function login($Controller) {

        // Setup layout for every login/Signup etc. pages
        $this->router->respond(function ($request, $response, $service) {
            $service->layout(getPath('views') . 'auth/_layout.php');
        });

        // When base admin url is accessed like "www.example.com/admin"
        $this->router->get('/?', function($request, $response, $service, $app) use ($Controller) {
            return $Controller->login($request, $response, $service, $app);
        });

        // When POST request is submitted on base admin url like Login Page Submitted
        $this->router->post('/?', function($request, $response, $service, $app) use ($Controller) {
            return $Controller->do_login($request, $response, $service, $app);
        });
    }

    /**
     * Admin Module (for Admin loggedin users)
     */
    public function admin($Controller) {

        $admin_menus = arrayToObject(unserialize(ADMIN_MENUS));
//        dd($admin_menus);
//        dd($admin_menus->Dashboard->actions[0]->route);

        // Setup layout for every Admin page pages
        $this->router->respond(function ($request, $response, $service) {
            $service->layout(getPath('views') . 'admin/_layout.php');
        });
//                dd($admin_menus);

        //Loop each menu
        foreach ($admin_menus as $mKey => $menu)
        {
            if(!isset($menu->actions)) continue;

            //Loop each action
            foreach ($menu->actions as $akey => $action)
            {
                //Create the route
                $this->createRoute($action->method, $action->route, [new $menu->controller, $action->action]);

            }

        }

    }

    public function dynamicPages() {

        $model = new Model();
        $pages = $model->connection->posts->where('post_type=? AND is_deleted=? AND status=?', [POST_TYPE_PAGE, AdminPostController::POST_DELETE_FALSE, AdminPostController::POST_STATUS_PUBLISHED]);
        Application::$pages = fetch_row($pages);

        // Setup layout for dynamic pages
        $this->router->respond(function ($request, $response, $service) {
            $service->layout(getPath('views') . 'pages/_layout.php');
        });

        // Set routes for dynamic pages
        foreach (Application::$pages as $key => $page)
        {
            $this->router->get('/'.$page->slug, function() use ($page) {
                Application::$service->render(getPath('views') . 'pages/page-content.php', ['page' => $page]);
            });

        }

    }

    /**
     * Create a new Route
     *
     * @param string $request_method Method Type eg: GET,POST,PUT,DELETE,OPTIONS etc.
     * @param string $route Url route  eg: '/?', '/admin', '/user/edit/[id]' etc.
     * @param mix $action Function name for any global function
     *                          eg: createUser()
     *                      Array for Class function [$classname, $function]
     *                          eg: ['AdminController','index']
     */
    public function createRoute($request_method, $route, $action) {

        $this->router->respond($request_method, $route, function() use ($action)  {
            if (is_callable($action) )
                return call_user_func($action);
            else
                error_exit("Invalid method");
        });

    }

    /**
     * Frontend requests
     */
    public function frontend($Controller) {

        // Setup layout for every frontend page
        $this->router->respond(function ($request, $response, $service) {
            $service->layout(getPath('views') . 'home/_layout.php');
        });

        // Index Page
        $this->router->get('/', function($request, $response, $service, $app) use ($Controller) {
            return $Controller->index($request, $response, $service, $app);
        });

        // Logout - for all roles including ADMIN/REGISTERED etc.
        $this->router->get('/logout', function($request, $response, $service, $app) use ($Controller) {
            $auth_cont = new AuthController();
            return $auth_cont->logout($request, $response, $service, $app);
        });

        /** Other frontend page requests **/
        $this->router->get('/about', function($request, $response, $service, $app) use ($Controller) {
            return $Controller->exampleOne($request, $response, $service, $app);
        });

        $this->router->get('/features', function() {
            Application::$service->render(getPath('views') . 'home/features.php');
        });
    }

}

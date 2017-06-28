<?php

namespace Micro\Controller;

use Klein\Klein;
use Micro\Core\SessionManager;
use Micro\Core\Model;

class RouteController {

    public $router;

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct() {

        $this->router = new \Klein\Klein();

        //Create the Database Connection will be used in all Controllers with ($app->db->connection->[tablename()])
        $this->router->respond(function ($request, $response, $service, $app) {
            $app->register('db', function() {
                $model = new Model();
                return $model;
            });
        });

        // frontend requests
        $this->frontend(new \Micro\Controller\HomeController());

        // admin panel requests
        $this->router->with('/'.ADMIN_BASE, function () {
            $session = new SessionManager();

            if (isset($session->getSession()->user->role) && $session->getSession()->user->role == ROLE_ADMIN) {

                $this->admin(new \Micro\Controller\AdminController());

            } else {

                $this->login(new \Micro\Controller\AuthController());
            }
        });

        $this->router->dispatch();
    }


    /**
     * Login Module
     */
    public function login($Controller) {
        $this->router->respond(function ($request, $response, $service) {
            $service->layout(getPath('views') . 'auth/_layout.php');
        });

        $this->router->get('/?', function($request, $response, $service, $app) use ($Controller) {
            return $Controller->login($request, $response, $service, $app);
        });

        $this->router->post('/?', function($request, $response, $service, $app) use ($Controller) {
            return $Controller->do_login($request, $response, $service, $app);
        });
    }

    /**
     * Admin Module
     */
    public function admin($Controller) {

        $this->router->respond(function ($request, $response, $service) {
            $service->layout(getPath('views') . 'admin/_layout.php');
        });

        $this->router->get('/?', function($request, $response, $service, $app) use ($Controller) {
            return $Controller->index($request, $response, $service, $app);
        });

        $userController = new \Micro\Controller\AdminUserController();
        $this->router->get('/user', function($request, $response, $service, $app) use ($userController) {
            return $userController->index($request, $response, $service, $app);
        });
        $this->router->get('/user/[i:id]', function($request, $response, $service, $app) use ($userController) {
            return $userController->edit($request, $response, $service, $app);
        });
        $this->router->put('/user/[i:id]', function($request, $response, $service, $app) use ($userController) {
            return $userController->update($request, $response, $service, $app);
        });
        $this->router->get('/user/block/[i:id]/[i:mode]', function($request, $response, $service, $app) use ($userController) {
            return $userController->block($request, $response, $service, $app);
        });
    }

    public function frontend($Controller) {

        $this->router->respond(function ($request, $response, $service) {
            $service->layout(getPath('views') . 'home/_layout.php');
        });

        $this->router->get('/', function($request, $response, $service, $app) use ($Controller) {
            return $Controller->index($request, $response, $service, $app);
        });

        $this->router->get('/logout', function($request, $response, $service, $app) use ($Controller) {
            $auth_cont = new AuthController();
            return $auth_cont->logout($request, $response, $service, $app);
        });

        $this->router->get('/exampleone', function($request, $response, $service, $app) use ($Controller) {
            return $Controller->exampleOne($request, $response, $service, $app);
        });

        $this->router->get('/exampletwo', function($request, $response, $service, $app) use ($Controller) {
            return $Controller->exampleTwo($request, $response, $service, $app);
        });
    }

}

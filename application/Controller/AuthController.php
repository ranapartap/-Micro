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

use Micro\Controller\BaseController;
use Micro\Core\SessionManager;
use Micro\Core\Application;
use Klein\Exceptions\KleinExceptionInterface;

class AuthController extends BaseController {

    public function login() {

        Application::$service->render(getPath('view') . 'auth/login.php');
    }

    public function do_login() {
        $err = '';

        if (strlen(Application::$request->username) < 6 || strlen(Application::$request->username) > 50)
            $err .= '<strong>Error!</strong> Invalid username.';

        if (empty(Application::$request->password))
            $err .= (empty($err) ? '' : '<br>') . '<strong>Error!</strong> Empty Password.';

        if (!$user = Application::$app->db->connection->users("(email = ? OR username = ?) AND password=?", [Application::$request->username, Application::$request->username, Application::$request->password])->fetch())
            $err .= (empty($err) ? '' : '<br>') . '<strong>Error!</strong> Invalid Username/password.';

        if (!empty($err)) {
            Application::$service->flash($err, 'danger');
            Application::$service->refresh();
            return;
        }

        $user = fetch_row($user);
        $session = new SessionManager;
        $session->setSessionKey('user', $user);

//        dd($session->getSession()->user,1);

        return Application::$response->redirect(admin_url('', false));
    }

    public function logout() {
        $session = new SessionManager;
        $session->clearSession();

        return Application::$response->redirect(getBaseUrl());
    }

    /**
     * Validate the user by role
     * @param type $role_validate User role to validate with
     * @return boolean true when user is logged In AND user role is matched
     */
    public static function validate($role_validate) {
        $session = new SessionManager;

        if (isset($session->getSession()->user->roles_id) && $session->getSession()->user->roles_id == ROLE_ADMIN)
            return true;

        return false;
    }

}

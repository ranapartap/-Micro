<?php

namespace Micro\Controller;

use Micro\Controller\BaseController;
use Micro\Core\SessionManager;

class AuthController extends BaseController {

    public function login($req, $res, $service, $app) {
        $service->render(getPath('view') . 'auth/login.php');
    }

    public function do_login($req, $res, $service, $app) {
        $session = new SessionManager;
        $session->setSessionKey('user', ['role' => 1, 'user_name'=> 'Administrator']);

        return $res->redirect(admin_url('', false));
    }

    public function logout($req, $res, $service, $app) {
        $session = new SessionManager;
        $session->Clear();

        return $res->redirect(getBaseUrl());
    }

}

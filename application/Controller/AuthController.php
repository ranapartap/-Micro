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
use Valitron\Validator;
use Klein\Exceptions\KleinExceptionInterface;

class AuthController extends BaseController {

     public  $rules = [
                    'username' => ['required', 'alphaNum', ['lengthMin', 2], ['lengthMax', 255]],
                    'password' => ['required', 'alphaNum', ['lengthMin', 2], ['lengthMax', 255]],
                    'confirm-password' => [['equals', 'password']],
                    'email' => ['required', 'email'],
                    ];

    public function login() {

        Application::$service->render(getPath('view') . 'auth/login.php');
    }

    public function do_login() {
        $err = '';

        if (empty(Application::$request->password))
            $err .= (empty($err) ? '' : '<br>') . '<strong>Error!</strong> Empty Password.';

        if(!$user = Application::$app->db->connection->users("(email = :un OR username = :un)", [ "un"=> Application::$request->username])->fetch())
            $err .= (empty($err) ? '' : '<br>') . '<strong>Error!</strong> Invalid User.';

        if(empty($err) && PASSWORD_ENCRYPTION) {
            if(!password_verify(Application::$request->password, $user->password))
                $err .= (empty($err) ? '' : '<br>') . '<strong>Error!</strong> Invalid Username/Password.';
        }

        if(empty($err) && !PASSWORD_ENCRYPTION) {
            if (!$user = Application::$app->db->connection->users(
                    "(email = :un OR username = :un) AND password=:pw",
                        [   "un"=> Application::$request->username,
                            "pw"=> Application::$request->password
                        ])->fetch()
                )
            $err .= (empty($err) ? '' : '<br>') . '<strong>Error!</strong> Invalid Username/password.';
        }

        if (!empty($err)) {
            Application::$service->flash($err, 'danger');
            Application::$service->refresh();
            return;
        }
        $user = fetch_row($user);
        $session = new SessionManager;
        $session->setSession('user', $user);
//dd( $session->getSession('user'),1);

//        dd($session->getSession()->user,1);

        return Application::$response->redirect(admin_url('', false));
    }

    /**
     * New user registration
     * @return type
     */
    public function signup() {
        $err = '';

        $valid = new Validator($_POST);
        $valid->mapFieldsRules($this->rules);

        if($valid->validate()){
            $password = PASSWORD_ENCRYPTION ? password_hash($strPassword, PASSWORD_DEFAULT) : Application::$request->password;

            $data = [
                        "username" => Application::$request->username,
                        "roles_id" => NEW_REG_USER_ROLE_ID,
                        "fullname" => Application::$request->fullname,
                        "password" => $password,
                        "email" => Application::$request->email,
                    ];

            if($result =  Application::$app->db->connection->users()->insert($data))
                Application::$service->flash('<strong>Success!</strong> Registration completed successfully', 'success');
            else
                Application::$service->flash('<strong>Error!</strong> registering new user', 'danger');
        } else {
            Application::$service->flash(errors_to_string($valid->errors() ), 'danger');
            return;
        }

        SessionManager::setSession('tab', 2);
        Application::$service->refresh();

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

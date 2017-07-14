<?php
/**
 * Admin User Controller
 * Handles the requests for Users/User module for Admin Panle
 */
namespace Micro\Controller;

use Micro\Controller\BaseController;
use Micro\Core\Application;
use Valitron\Validator;

class AdminUserController extends BaseController {

    const BASE_URL = 'users';
    
    const USER_STATUS_ACTIVE = 0;
    const USER_STATUS_BLOCKED = 1;
    const USER_STATUS_ARRAY = [0 => "Active", 1 => "Blocked"] ;

    const USER_DELETE_FALSE = 0;
    const USER_DELETE_TRUE = 1;

    const USERNAME_MIN_LEN = 4;
    const USERNAME_MAX_LEN = 100;


    public  $rules = [
                    'username' => ['required', 'alphaNum',  ['lengthMin', self::USERNAME_MIN_LEN], ['lengthMax', self::USERNAME_MAX_LEN] ],
                    'mobile' => ['required', 'alphaNum',  ['lengthMin', 8], ['lengthMax', 20] ],
                    'email'=>['email']
                    ];

    /**
     * Index page for admin users listing
     */
    public function index()
    {
        // load view with PageTitle and Users collection
        Application::$service->render(getPath('views') . 'admin/'.self::BASE_URL.'/index.php',
                        [   'pageTitle' => "Users",
                            'users' => Application::$app->db->connection->users->where('is_deleted=?', AdminUserController::USER_DELETE_FALSE)
                        ]
                    );
    }

    public function validate() {



        $v->mapFieldsRules($rules);

        if(!$v->validate())
            return $v;

        return true;
    }


    /**
     * Edit user page
     */
    public function create()
    {

//        dd(['id'=>Application::$request->id(),
//        'params'=>Application::$request->params(),
//        'uri'=>Application::$request->uri(),
//        'pathname'=>Application::$request->pathname(),
//        'server'=>Application::$request->server(),
//        'method'=>Application::$request->method()]);

        //Form is submitted
        if(Application::$request->method(METHOD_POST)){

            if($user = Application::$app->db->connection->users("username = ? || email= ?", [Application::$request->username, Application::$request->email ])->fetch()){
                Application::$service->flash('<strong>Error!</strong> Duplicate username/email.', 'danger');
                $error = true;
            }

            $valid = new Validator($_POST);
            $valid->mapFieldsRules($this->rules);

            if($valid->validate()){
//                $users =  Application::$app->db->connection->users();
                $data = array(
                    "username" => Application::$request->username,
                    "fullname" => Application::$request->fullname,
                    "email" => Application::$request->email,
                    "mobile" => Application::$request->mobile,
                );

                if($result =  Application::$app->db->connection->users()->insert($data)){
                    Application::$service->flash('<strong>Success!</strong> User added successfully.', 'success');
                }

            } else {
                Application::$service->flash(errors_to_string($valid->errors() ), 'danger');
                Application::$service->refresh();
                return;
            }
        }

        Application::$response->redirect(admin_url(self::BASE_URL));

        // load view
        Application::$service->render(getPath('views') . 'admin/'.self::BASE_URL.'/form.php',
                        [   'pageTitle' => "Create User",
                            'method' => METHOD_POST,
                        ]
                    );
    }

    /**
     * Edit user page
     */
    public function edit()
    {

        $error = false;
        if (!Application::$service->validateParam('id')->isInt()){
            Application::$service->flash('<strong>Error!</strong> Invalid user ID supplied.', 'danger');
            $error = true;
        }

        if(!$user = Application::$app->db->connection->users("id = ?", Application::$request->param('id'))->fetch()){
            Application::$service->flash('<strong>Error!</strong> User not found.', 'danger');
            $error = true;
        }

        if($error) {
            Application::$response->redirect(admin_url(self::BASE_URL));
            return;
        }


        // load view
        Application::$service->render(getPath('views') . 'admin/'.self::BASE_URL.'/edit.php',
                        [   'pageTitle' => "Edit Users",
                            'data' => $user,
                            'method' => METHOD_PUT,
                        ]
                    );
    }

    /**
     * Update user details - Request submitted from User Edit page
     */
    public function update()
    {

        $error = false;
        if (!Application::$service->validateParam('id')->isInt()){
            Application::$service->flash('<strong>Error!</strong> Invalid user ID supplied.', 'danger');
            $error = true;
        }

        if(!$user = Application::$app->db->connection->users("id = ?", Application::$request->param('id'))->fetch()){
            Application::$service->flash('<strong>Error!</strong> User not found.', 'danger');
            $error = true;
        }

        if($error) {
            Application::$service->back();
            return;
        }

        $data = [
                    'fullname' => Application::$request->param('fullname'),
                    'email' => Application::$request->param('email'),
                    'mobile' => Application::$request->param('mobile'),
                    'address' => Application::$request->param('address'),
                    'about' => Application::$request->param('about'),
                ];

        if($user->update($data))
            Application::$service->flash('<strong>Success!</strong> User updated successfully.', 'success');
        else
            Application::$service->flash('<strong>Error!</strong> User not updated.', 'danger');

        Application::$response->redirect(admin_url(self::BASE_URL));

        return;
    }

    /**
     * Block a user - Update user status as blocked
     */
    public function block()
    {
        $error = false;
        if (!Application::$service->validateParam('id')->isInt()){
            Application::$service->flash('<strong>Error!</strong> Invalid user ID supplied.', 'danger');
            $error = true;
        }

        if (!Application::$service->validateParam('mode')->isInt()){
            Application::$service->flash('<strong>Error!</strong> Invalid parameters supplied.', 'danger');
            $error = true;
        }

        if(!$user = Application::$app->db->connection->users("id = ?", Application::$request->param('id'))->fetch()){
            Application::$service->flash('<strong>Error!</strong> User not found.', 'danger');
            $error = true;
        }

        if($error) {
            Application::$service->back();
            return;
        }

        $mode = Application::$request->param('mode') == AdminUserController::USER_STATUS_BLOCKED ? 'Blocked' : "Activated";

        if($user->update(['status'=>  Application::$request->param('mode')]))
            Application::$service->flash("<strong>Success!</strong> User <b>{$mode}</b>  successfully.", 'success');
        else
            Application::$service->flash('<strong>Error!</strong> updating user status.', 'danger');

        Application::$response->redirect(admin_url(self::BASE_URL));

        return;
    }

    /**
     * Delete a user - ajax call Update user status as deleted
     */
    public function ajaxDelete()
    {
        $error = false;
        if (!Application::$service->validateParam('id')->isInt()){
            Application::$response->json(['error' => 'Invalid user ID supplied.']);
            return;
        }

        if(!$user = Application::$app->db->connection->users("id = ?", Application::$request->param('id'))->fetch()){
            Application::$response->json(['error' => 'User not found.']);
            return;
        }

        if($err = $user->update(['is_deleted'=> AdminUserController::USER_DELETE_TRUE]))
            Application::$response->json(['success' => 1, 'status' => $err]);
        else
            Application::$response->json(['error' => 'User not deleted', 'status' => $err]);

        return;
    }

    /**
     * Validate username ajax call
     */
    public function ajaxValidateusercreate()
    {
        $field = trim(Application::$request->field);
        $value = trim(Application::$request->value);

        if ( $field == "username" && (strlen($value) < AdminUserController::USERNAME_MIN_LEN
                || strlen($value) > AdminUserController::USERNAME_MAX_LEN )) {

            Application::$response->json(['error' => 'Required length is ['.AdminUserController::USERNAME_MIN_LEN.' - '.AdminUserController::USERNAME_MAX_LEN.']']);
            return;
        }

        if( !$user = Application::$app->db->connection->users("{$field} = ?", $value )->fetch() ){

            Application::$response->json(['success' => "{$field} available"]);
            return;
        } else {

            Application::$response->json(['error' => "{$field} already exists"]);
            return;
        }

    }


}

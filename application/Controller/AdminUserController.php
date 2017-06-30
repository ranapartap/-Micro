<?php
/**
 * There are some variables attached to every function which is called from RouterController,
 * these variables are set by our Router, You can read more on https://github.com/klein/klein.php
 * We have pass these variables to our controller functions to act on Request, Response, Services and App
 *
 * @param type Application::$request - Request Object - Like URI, Request Parameters etc.
 * @param type Application::$response - Respond to all requests like get, put, handle uri requests etc.
 * @param type Application::$service - Handle Views etc.
 * @param type Application::$app - Custom declared global variables
 */
namespace Micro\Controller;

use Micro\Controller\BaseController;
use Micro\Core\Application;

class AdminUserController extends BaseController {

    const USER_STATUS_ACTIVE = 0;
    const USER_STATUS_BLOCKED = 1;
    const USER_STATUS_ARRAY = [0 => "Active", 1 => "Blocked"] ;

    const USER_DELETE_FALSE = 0;
    const USER_DELETE_TRUE = 1;

    /**
     * Index page for admin users listing
     */
    public function index()
    {
        // load view with PageTitle and Users collection
        Application::$service->render(getPath('views') . 'admin/users/index.php',
                        [   'pageTitle' => "Users",
                            'users' => Application::$app->db->connection->users->where('is_deleted=?', AdminUserController::USER_DELETE_FALSE)
                        ]
                    );
    }

    /**
     * Edit user page
     */
    public function create()
    {
        if(Application::$request->method(METHOD_POST))
            dd('data posted');

        // load view
        Application::$service->render(getPath('views') . 'admin/users/form.php',
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
            Application::$service->back();
            return;
        }

//        dd(['id'=>Application::$request->id(),
//        'params'=>Application::$request->params(),
//        'uri'=>Application::$request->uri(),
//        'id'=>Application::$request->uri(),
//        'pathname'=>Application::$request->pathname(),
//        'server'=>Application::$request->server(),
//        'method'=>Application::$request->method()]);

        // load view
        Application::$service->render(getPath('views') . 'admin/users/edit.php',
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

        Application::$response->redirect(admin_url('users'));

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

        Application::$response->redirect(admin_url('users'));

        return;
    }

    /**
     * Delete a user - Update user status as deleted
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


}

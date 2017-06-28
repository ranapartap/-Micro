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

class AdminUserController extends BaseController {

    const USER_STATUS_ACTIVE = 0;
    const USER_STATUS_BLOCKED = 1;
    const USER_STATUS_ARRAY = [0 => "Active", 1 => "Blocked"] ;

    const USER_DELETE_FALSE = 0;
    const USER_DELETE_TRUE = 1;

    /**
     * Index page for admin users listing
     */
    public function index($req, $res, $service, $app)
    {
        // load view with PageTitle and Users collection
        $service->render(getPath('views') . 'admin/users/index.php',
                        [   'pageTitle' => "Users",
                            'users' => $app->db->connection->users->where('is_deleted=?', AdminUserController::USER_DELETE_FALSE)
                        ]
                    );
    }

    /**
     * Edit user page
     */
    public function edit($req, $res, $service, $app)
    {
        $error = false;
        if (!$service->validateParam('id')->isInt()){
            $service->flash('<strong>Error!</strong> Invalid user ID supplied.', 'danger');
            $error = true;
        }

        if(!$user = $app->db->connection->users("id = ?", $req->param('id'))->fetch()){
            $service->flash('<strong>Error!</strong> User not found.', 'danger');
            $error = true;
        }

        if($error) {
            $service->back();
            return;
        }

//        dd(['id'=>$req->id(),
//        'params'=>$req->params(),
//        'uri'=>$req->uri(),
//        'id'=>$req->uri(),
//        'pathname'=>$req->pathname(),
//        'server'=>$req->server(),
//        'method'=>$req->method()]);

        // load view
        $service->render(getPath('views') . 'admin/users/edit.php',
                        [   'pageTitle' => "Edit Users",
                            'data' => $user,
                            'method' => METHOD_PUT,
                        ]
                    );
    }

    /**
     * Update user details - Request submitted from User Edit page
     */
    public function update($req, $res, $service, $app)
    {
        $error = false;
        if (!$service->validateParam('id')->isInt()){
            $service->flash('<strong>Error!</strong> Invalid user ID supplied.', 'danger');
            $error = true;
        }

        if(!$user = $app->db->connection->users("id = ?", $req->param('id'))->fetch()){
            $service->flash('<strong>Error!</strong> User not found.', 'danger');
            $error = true;
        }

        if($error) {
            $service->back();
            return;
        }

        $data = [
                    'fullname' => $req->param('fullname'),
                    'email' => $req->param('email'),
                    'mobile' => $req->param('mobile'),
                    'address' => $req->param('address'),
                    'about' => $req->param('about'),
                ];

        if($user->update($data))
            $service->flash('<strong>Success!</strong> User updated successfully.', 'success');
        else
            $service->flash('<strong>Error!</strong> User not updated.', 'danger');

        $res->redirect(admin_url('user'));

        return;
    }

    /**
     * Block a user - Update user status as blocked
     */
    public function block($req, $res, $service, $app)
    {
        $error = false;
        if (!$service->validateParam('id')->isInt()){
            $service->flash('<strong>Error!</strong> Invalid user ID supplied.', 'danger');
            $error = true;
        }

        if (!$service->validateParam('mode')->isInt()){
            $service->flash('<strong>Error!</strong> Invalid parameters supplied.', 'danger');
            $error = true;
        }

        if(!$user = $app->db->connection->users("id = ?", $req->param('id'))->fetch()){
            $service->flash('<strong>Error!</strong> User not found.', 'danger');
            $error = true;
        }

        if($error) {
            $service->back();
            return;
        }

        $mode = $req->param('mode') == AdminUserController::USER_STATUS_ACTIVE ? 'Blocked' : "Activated";

        if($user->update(['status'=>  $req->param('mode')]))
            $service->flash("<strong>Success!</strong> User {$mode}  successfully.", 'success');
        else
            $service->flash('<strong>Error!</strong> updating user status.', 'danger');

        $res->redirect(admin_url('user'));

        return;
    }

    /**
     * Delete a user - Update user status as deleted
     */
    public function ajaxDelete($req, $res, $service, $app)
    {
        $error = false;
        if (!$service->validateParam('id')->isInt()){
            $res->json(['error' => 'Invalid user ID supplied.']);
            return;
        }

        if(!$user = $app->db->connection->users("id = ?", $req->param('id'))->fetch()){
            $res->json(['error' => 'User not found.']);
            return;
        }

        if($err = $user->update(['is_deleted'=> AdminUserController::USER_DELETE_TRUE]))
            $res->json(['success' => 1, 'status' => $err]);
        else
            $res->json(['error' => 'User not deleted', 'status' => $err]);

        return;
    }


}

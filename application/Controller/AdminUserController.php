<?php
namespace Micro\Controller;

use Micro\Controller\BaseController;


class AdminUserController extends BaseController {

    const USER_STATUS_ACTIVE = 0;
    const USER_STATUS_BLOCKED = 1;
    const USER_STATUS_ARRAY = [0 => "Active", 1 => "Blocked"] ;

    public function index($req, $res, $service, $app)
    {
//
//        foreach ( $app->db->connection->users() as $user) { // get all applications
//            dd($user['username']); // print application title
//            dd($user->roles['name']); // print application title
//        }

        // load view
        $service->render(getPath('views') . 'admin/users/index.php',
                        [   'pageTitle' => "Users",
                            'users' => $app->db->connection->users()
                        ]
                    );
    }

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
                            'method' => 'PUT',
                        ]
                    );
    }

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


}

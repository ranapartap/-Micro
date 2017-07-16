<?php
/**
 * Admin Post Controller
 * Handles the requests for Post module for Admin Panle
 */
namespace Micro\Controller;

use Micro\Controller\BaseController;
use Micro\Core\Application;
use Valitron\Validator;

class AdminPostController extends BaseController {

    const BASE_URL = 'posts';

    const POST_STATUS_DISABLED = 0;
    const POST_STATUS_PUBLISHED = 1;
    const POST_STATUS_ARRAY = [0 => "Private", 1 => "Publish"] ;

    const POST_DELETE_FALSE = 0;
    const POST_DELETE_TRUE = 1;

    public  $rules = [
                    'title' => ['required', 'alphaNum'],
                    'slug' => ['required', 'alphaNum',  ['lengthMin', 2], ['lengthMax', 255] ]
                    ];

    /**
     * Index page for posts users listing
     */
    public function index()
    {

        return  Application::render(getPath('views') . 'admin/'.self::BASE_URL.'/index.php',
                        [   'pageTitle' => "Posts",
                            'posts' => Application::$app->db->connection->posts->where('is_deleted=?', AdminPostController::POST_DELETE_FALSE)
                        ]
                    );
    }

    /**
     * Preview post/page
     */
    public function preview()
    {
        if(!$post = Application::$app->db->connection->posts("id = ?", Application::$request->id)->fetch()){
            Application::$service->flash('<strong>Error!</strong> Post/Page not found.', 'danger');
            $error = true;
        }

        $post = fetch_row($post);

        // Set frontend page layout
        Application::$service->layout(getPath('views') . 'pages/_layout.php');

        return Application::$service->render(getPath('views') . 'pages/page-content.php', ['page' => $post]);
    }


    /**
     * Edit post/page
     */
    public function create()
    {

        //Form is submitted
        if(Application::$request->method(METHOD_POST)){

            if($user = Application::$app->db->connection->posts("slug = ?", Application::$request->slug)->fetch()){
                Application::$service->flash('<strong>Error!</strong> Duplicate post', 'danger');
                $error = true;
            }

            $valid = new Validator($_POST);
            $valid->mapFieldsRules($this->rules);

            if($valid->validate()){
//                $users =  Application::$app->db->connection->users();
                $data = array(
                    "title" => Application::$request->title,
                    "slug" => Application::$request->slug,
                    "content" => Application::$request->content
                );

                if($result =  Application::$app->db->connection->users()->insert($data)){
                    Application::$service->flash('<strong>Success!</strong> Post added successfully.', 'success');
                }

            } else {
                Application::$service->flash(errors_to_string($valid->errors() ), 'danger');
                Application::$service->refresh();
                return;
            }
        }

        Application::$response->redirect(admin_url('users'));

        // load view
        Application::$service->render(getPath('views') . 'admin/'.self::BASE_URL.'/form.php',
                        [   'pageTitle' => "Create Post",
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
            Application::$service->flash('<strong>Error!</strong> Invalid Post ID supplied.', 'danger');
            $error = true;
        }

        if(!$user = Application::$app->db->connection->posts("id = ?", Application::$request->id)->fetch()){
            Application::$service->flash('<strong>Error!</strong> Post not found.', 'danger');
            $error = true;
        }

        if($error) {
            Application::$response->redirect(admin_url(self::BASE_URL));
            return;
        }


        // load view
        Application::$service->render(getPath('views') . 'admin/'.self::BASE_URL.'/edit.php',
                        [   'pageTitle' => "Edit Post",
                            'data' => $user,
                            'method' => METHOD_PUT,
                        ]
                    );
    }

    /**
     * Update user details - Request submitted from Post Edit page
     */
    public function update()
    {

        $error = false;
        if (!Application::$service->validateParam('id')->isInt()){
            Application::$service->flash('<strong>Error!</strong> Invalid user ID supplied.', 'danger');
            $error = true;
        }

        if(!$user = Application::$app->db->connection->posts("id = ?", Application::$request->param('id'))->fetch()){
            Application::$service->flash('<strong>Error!</strong> Post not found.', 'danger');
            $error = true;
        }

        if($error) {
            Application::$service->back();
            return;
        }

        $data = [
                    'title' => Application::$request->param('title'),
                    'slug' => Application::$request->param('slug'),
                    'content' => esc_html(Application::$request->param('content')),
                ];

        if($user->update($data))
            Application::$service->flash('<strong>Success!</strong> Post updated successfully.', 'success');
        else
            Application::$service->flash('<strong>Error!</strong> Post not updated.', 'danger');

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

        if(!$user = Application::$app->db->connection->posts("id = ?", Application::$request->param('id'))->fetch()){
            Application::$service->flash('<strong>Error!</strong> Post not found.', 'danger');
            $error = true;
        }

        if($error) {
            Application::$service->back();
            return;
        }

        $mode = Application::$request->mode == AdminPostController::POST_STATUS_DISABLED ? AdminPostController::POST_STATUS_ARRAY[AdminPostController::POST_STATUS_DISABLED] : AdminPostController::POST_STATUS_ARRAY[AdminPostController::POST_STATUS_PUBLISHED];

        if($user->update(['status'=>  Application::$request->param('mode')]))
            Application::$service->flash("<strong>Success!</strong> Post <b>{$mode}</b>  successfully.", 'success');
        else
            Application::$service->flash('<strong>Error!</strong> updating post status.', 'danger');

        Application::$response->redirect(admin_url(self::BASE_URL));

        return;
    }

    /**
     * Delete a post - ajax call Update post status as deleted
     */
    public function ajaxDelete()
    {
        $error = false;
        if (!Application::$service->validateParam('id')->isInt()){
            Application::$response->json(['error' => 'Invalid post ID supplied.']);
            return;
        }

        if(!$user = Application::$app->db->connection->users("id = ?", Application::$request->param('id'))->fetch()){
            Application::$response->json(['error' => 'Post not found.']);
            return;
        }

        if($err = $user->update(['is_deleted'=> AdminPostController::USER_DELETE_TRUE]))
            Application::$response->json(['success' => 1, 'status' => $err]);
        else
            Application::$response->json(['error' => 'Post not deleted', 'status' => $err]);

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

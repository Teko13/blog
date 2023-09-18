<?php

namespace App\controllers;

use App\models\Comment;
use App\models\Post;
use App\models\User;
use App\src\Application;
use App\controllers\Controller;

class AdminController extends Controller
{
    private Post $post;
    private Comment $comment;
    private User $user;

    public function createPost()
    {

        if (Application::$app->request->isPostMethod()) {
            $body = Application::$app->request->getBody();
            $post = $this->post;
            $post->loadData($body);
            if ($post->validate() && $post->save()) {
                Application::$app->session->setFlash("succes", "Votre post a bien été créé");
            }
            Application::$app->session->setFlash("error", $post->errors);
            return $this->render('create-post', ['post' => $this->post]);
        }
        return $this->render('create-post', ["post" => $this->post]);
    }
    public function adminDashbord()
    {
        //get user posts and their comments total number for display it in dashbord
        $id = Application::$app->session->get('user')['id'];
        $posts = $this->post->findMany(["id_author" => $id]);
        $comments = [];
        foreach ($posts as $post) {
            $comments[] = $this->comment->findMany(['id_post' => $post["id"]]);
        }
        $postsInfos = ["posts" => $posts, "comments" => $comments];
        return $this->render('adminDashBoard', ["postsInfos" => $postsInfos]);
    }
    public function authorization()
    {
        if (Application::$app->session->get('user')) {
            if (Application::$app->session->get('user')['type'] >= User::STATUS_VALIDE) {
                return true;
            } else {
                Application::$app->response->setStatusCode(401);
                return false;
            }
        } else {
            Application::$app->response->redirect('/login');
        }
    }
    public function __construct()
    {
        if ($this->authorization() === false) {
            echo $this->render('_401', []);
            exit;
        }
        $this->post = new Post();
        $this->user = new User();
        $this->comment = new Comment();
    }
    public function managePost(): string
    {
        $post = $this->post;
        $idAuthor = Application::$app->session->get("user")["id"];
        $posts = Application::$app->session->get("user")['type'] === 2 ? $post->findAll() : $post->findMany(["id_author" => $idAuthor]);
        return $this->render("manage-post", ["posts" => $posts]);

    }
    public function editPost()
    {
        if (Application::$app->request->isGetMethod()) {
            if (isset(Application::$app->request->getBody()['id'])) {
                $idPost = Application::$app->request->getBody()['id'];
                $post = $this->post->findOnePost($idPost)[0];
                //Check if current user is post author or admin
                if (((int) $post["id_author"] !== Application::$app->session->get('user')['id']) && (Application::$app->session->get('user')['type'] !== 2)) {
                    Application::$app->response->setStatusCode(401);
                    return $this->render("_401", []);
                }
                return $this->render('edit-post', ['post' => $this->post, "concernedPost" => $post]);

            } else {
                Application::$app->response->redirect("/admin/manage-post");
            }
        } elseif (Application::$app->request->isPostMethod()) {
            $body = Application::$app->request->getBody();
            // check if current user is post author or admin
            if (((int) $body['id_author'] !== Application::$app->session->get("user")['id']) && (Application::$app->session->get("user")['type'] !== 2)) {
                Application::$app->response->setStatusCode(401);
                return $this->render("_401", []);
            }
            $post = $this->post;
            $post->loadData($body);
            // we need to add field "updated_at"in the fields list in update context to also update it
            $post->updated_at = date("Y-m-d H:i:s");
            if ($post->validate() && $post->update(['id' => $post->id])) {
                Application::$app->session->setFlash("succes", "Votre post a bien été modifieé");
            }
            Application::$app->session->setFlash("error", $post->errors);
            return $this->render('edit-post', ['post' => $this->post, 'concernedPost' => (array) $post]);

        }
    }
    public function deletPost(): string
    {
        if (Application::$app->request->isGetMethod() && isset(Application::$app->request->getBody()['id'])) {
            $idPost = Application::$app->request->getBody()['id'];
            // check if current user is post author
            $post = $this->post->findOne(["id" => $idPost]);
            if ($post->id_author === Application::$app->session->get("user")['id']) {
                $post->delete(['id' => $post->id]);
            } else {
                Application::$app->response->setStatusCode(401);
                return $this->render('_401', []);
            }
        }
        Application::$app->response->redirect('manage-post');
    }
    public function usersValidation(): string
    {
        if (Application::$app->session->get("user")["type"] === 2) {
            $users = $this->user->findAll();
            return $this->render("users-validation", ["users" => $users]);
        } else {
            Application::$app->response->setStatusCode(401);
            return $this->render('_401', []);
        }
    }
    public function changeStatus(): void
    {
        if (Application::$app->session->get("user")["type"] === 2) {
            try {
                $requestBody = Application::$app->request->getBody();
                $this->user->type = (int) $requestBody['status'];
                if (($this->user->update(["id" => $requestBody['id']]))) {
                    Application::$app->response->redirect('/admin/users-validation');
                }
            } catch (\Throwable $error) {
                Application::$app->response->setStatusCode(500);
                echo $this->render('_500', ["error" => $error->getMessage()]);
            }
        } else {
            Application::$app->response->setStatusCode(401);
            echo $this->render('_401', []);
        }
    }
    public function commentValidation(): string
    {
        if (Application::$app->session->get("user")["type"] === 2) {
            $comments = $this->comment->findAllComments();
            return $this->render("comment-validation", ["comments" => $comments]);
        } else {
            Application::$app->response->setStatusCode(401);
            return $this->render('_401', []);
        }
    }
    public function commentValidationAction(): void
    {
        if (Application::$app->session->get("user")["type"] === 2) {
            try {
                $requestBody = Application::$app->request->getBody();
                $this->comment->status = $requestBody["status"];
                if ($this->comment->update(["id" => $requestBody["id"]])) {
                    Application::$app->response->redirect("/admin/comments-validation");
                }
            } catch (\Throwable $error) {
                Application::$app->response->setStatusCode(500);
                echo $this->render('_500', ["error" => $error->getMessage()]);
            }
        } else {
            Application::$app->response->setStatusCode(401);
            echo $this->render('_401', []);
        }
    }
    public function commentDeletion(): void
    {
        if (Application::$app->session->get("user")["type"] === 2) {
            try {
                $requestBody = Application::$app->request->getBody();
                if ($this->comment->delete(["id" => $requestBody["id"]])) {
                    Application::$app->response->redirect("/admin/comments-validation");
                }
            } catch (\Throwable $error) {
                Application::$app->response->setStatusCode(500);
                echo $this->render('_500', ["error" => $error->getMessage()]);
            }
        } else {
            Application::$app->response->setStatusCode(401);
            echo $this->render('_401', []);
        }
    }
    public function userDeletion(): void
    {
        if (Application::$app->session->get("user")["type"] === 2) {
            try {
                $requestBody = Application::$app->request->getBody();
                if ($this->user->delete(["id" => $requestBody["id"]])) {
                    Application::$app->response->redirect("/admin/users-validation");
                }
            } catch (\Throwable $error) {
                Application::$app->response->setStatusCode(401);
                echo $this->render('_401', []);
            }
        } else {
            Application::$app->response->setStatusCode(401);
            echo $this->render('_401', []);
        }
    }
}

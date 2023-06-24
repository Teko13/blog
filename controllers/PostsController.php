<?php

namespace App\controllers;

use App\models\Comment;
use App\models\Post;
use App\src\Application;

class PostsController extends Controller
{
    public Post $post;
    public Comment $comment;

    public function __construct()
    {
        $this->post = new Post();
        $this->comment = new Comment();
    }

    public function posts()
    {

        $post = $this->post;
        $allPosts = $post->findAll();
        return $this->render('posts', ["posts" => $allPosts]);
    }
    public function post()
    {
        $requestBody = Application::$app->request->getBody();
        if (!isset($requestBody['id'])) {
            Application::$app->response->redirect("/posts");
        }
        $postId = $requestBody["id"];
        $onePost = $this->post->findOnePost($postId);
        $comments = $this->comment->findPostComments($postId);
        $details = ["post" => $onePost[0], "comments" => $comments];
        return $this->render('post', ["post" => $details]);
    }
    public function submitComment()
    {
        $body = Application::$app->request->getBody();
        $body["id_author"] = Application::$app->session->get("user")["id"];
        $comment = $this->comment;
        $comment->loadData($body);
        if ($comment->validate() && $comment->save()) {
            $post = $this->post->findOnePost($body['id_post']);
            $postTitle = $post[0]['title'];
            $author = Application::$app->session->get("user")["firstName"] . ' ' . Application::$app->session->get("user")["lastName"];
            $mailData = [$author, $postTitle, $comment->content];
            Application::$app->mailer->sendCommentValidationrequest($mailData);
            Application::$app->session->setFlash("succes", "Votre commentaire a été bien soumis et sera publier après validation");
        }
        Application::$app->session->setFlash("error", $comment->errors);
        Application::$app->response->redirect("/post?id=" . $body['id_post'] . '#comment');
    }
}

<?php
require_once '../vendor/autoload.php';
use App\controllers\AdminController;
use App\controllers\AuthController;
use App\controllers\PostsController;
use App\models\User;
use App\src\Application;
use App\controllers\SiteController;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$config = [
    'db' => [
        'dsn' => $_ENV['DB_DNS'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
    'mailer' => [
        'host' => $_ENV['MAIL_SERVER_HOST'],
        'port' => $_ENV['MAIL_SERVER_PORT'],
        'user' => $_ENV['MAIL_SERVER_USERNAME'],
        'send_from' => $_ENV['MAIL_SEND_FROM'],
        'password' => $_ENV['MAIL_SERVER_PASSWORD']
    ],
];

$app = new Application(dirname(__DIR__), $config);
$app->router->get("/", [SiteController::class, "home"]);
$app->router->get("/posts", [PostsController::class, 'posts']);
$app->router->get("/post", [PostsController::class, 'post']);
$app->router->post("/signup", [AuthController::class, "signup"]);
$app->router->get("/login", [AuthController::class, "login"]);
$app->router->get("/signup", [AuthController::class, "signup"]);
$app->router->get("/logout", [AuthController::class, "logout"]);
$app->router->get("/admin/create-post", [AdminController::class, "createPost"]);
$app->router->post("/admin/create-post", [AdminController::class, "createPost"]);
$app->router->get("/admin/manage-post", [AdminController::class, "managePost"]);
$app->router->get('/admin/edit-post', [AdminController::class, "editPost"]);
$app->router->get('/admin/delet-post', [AdminController::class, "deletPost"]);
$app->router->get('/admin/valide', [AdminController::class, "changeStatus"]);
$app->router->post('/admin/edit-post', [AdminController::class, "editPost"]);
$app->router->get("/admin/user-deletion", [AdminController::class, "userDeletion"]);
$app->router->get('/admin/users-validation', [AdminController::class, "usersValidation"]);
$app->router->get("/admin/comments-validation", [AdminController::class, "commentValidation"]);
$app->router->get("/admin/comment-deletion", [AdminController::class, "commentDeletion"]);
$app->router->post("/login", [AuthController::class, "login"]);
$app->router->post("/contact", [SiteController::class, "handlerContact"]);
$app->router->get('/admin/comment-validation', [AdminController::class, "commentValidationAction"]);
$app->router->get("/admin/", [AdminController::class, "adminDashbord"]);
$app->router->post("/comment", [PostsController::class, "submitComment"]);
$app->run();


?>

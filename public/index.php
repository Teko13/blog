<?php
require_once '../vendor/autoload.php';
use App\controllers\AuthController;
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
    ]
];

$app = new Application(dirname(__DIR__), $config);
$app->router->get("/", [SiteController::class, "home"]);
$app->router->get("/posts", 'posts');
$app->router->post("/signup", [AuthController::class, "signup"]);
$app->router->get("/login", [AuthController::class, "login"]);
$app->router->get("/signup", [AuthController::class, "signup"]);
$app->router->post("/login", [AuthController::class, "login"]);
$app->router->post("/contact", [SiteController::class, "handlerContact"]);
$app->run();


?>
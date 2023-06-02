<?php
require_once '../vendor/autoload.php';
use App\src\Application;
use App\controllers\SiteController;

$app = new Application(dirname(__DIR__));
$app->router->get("/", [SiteController::class, "home"]);
$app->router->get("/posts", 'posts');
$app->router->post("/contact", [SiteController::class, "handlerContact"]);
$app->run();


?>
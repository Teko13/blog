<?php
require_once './vendor/autoload.php';
use App\src\Application;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
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
$app = new Application(__DIR__, $config);

$app->db->applyMigrations();


?>

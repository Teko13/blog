<?php

namespace App\src;

use App\models\User;
use App\models\Login;
use App\models\DataBase;
use App\controllers\Controller;

class Application
{

  public Router $router;

  public Request $request;
  public static string $ROOT_DIR;
  public DataBase $db;
  public Response $response;
  public Session $session;
  public Mailer $mailer;
  public string $layout;
  public Controller|null $controller = null;
  public Login|null $user;
  public static Application $app;

  public function __construct($routePath, $config)
  {
    self::$app = $this;
    self::$ROOT_DIR = $routePath;
    $this->request = new Request();
    $this->db = new DataBase($config['db']);
    $this->response = new Response();
    $this->router = new Router($this->request, $this->response);
    $this->session = new Session();
    $this->mailer = new Mailer($config['mailer']);
    $this->setLayout();
  }

  public function setLayout(): void
  {
    $userSession = $this->session->get('user') ?? false;
    if ($userSession) {
      switch ($userSession['type']) {
        case User::STATUS_VALIDE:
          $this->layout = "auth";
          break;
        case User::STATUS_INVALIDE:
          $this->layout = 'auth';
          break;
        case User::STATUS_ADMIN:
          $this->layout = 'auth';
          break;

        default:
          $this->layout = 'main';
          break;
      }
    } else {
      $this->layout = 'main';
    }
  }

  public function getController(): Controller|null
  {
    return $this->controller;
  }

  public function setController(Controller $controller): void
  {
    $this->controller = $controller;
  }

  public function run(): void
  {
    echo $this->router->resolve();
  }

  public function login(Login $user): void
  {
    $this->user = $user;
    $userInfos = (array) $this->user;
    unset($userInfos['password']);
    unset($userInfos['errors']);
    $this->session->set('user', $userInfos);
  }

  public function logout(): void
  {
    $this->session->remove('user');
    $this->user = null;
  }
}


?>
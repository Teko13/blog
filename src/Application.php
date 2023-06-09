<?php

namespace App\src;

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
  public Controller $controller;
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
  }

  public function getController(): Controller
  {
    return $this->controller;
  }

  public function setController(Controller $controller)
  {
    $this->controller = $controller;
  }

  public function run()
  {
    echo $this->router->resolve();
  }
}


?>
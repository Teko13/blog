<?php

namespace App\src;

use App\controllers\Controller;

class Application
{

  public Router $router;
  public Request $request;
  public static string $ROUTE_DIR;
  public Response $response;
  public Controller $controller;
  public static Application $app;

  public function __construct($routePath)
  {
    self::$app = $this;
    self::$ROUTE_DIR = $routePath;
    $this->request = new Request();
    $this->response = new Response();
    $this->router = new Router($this->request, $this->response);
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
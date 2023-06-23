<?php

namespace App\src;

use App\src\Application;

class Router
{
    protected array $routes = [];
    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function post($path, $action): void
    {
        $this->routes["post"][$path] = $action;
    }

    public function get($path, $action): void
    {
        $this->routes["get"][$path] = $action;
    }

    public function resolve(): string
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $action = $this->routes[$method][$path] ?? false;
        if ($action == false) {
            $this->response->setStatusCode(404);
            return $this->renderView("_404", []);
        }
        if (is_string($action)) {
            return $this->renderView($action, []);
        }
        if (is_array($action)) {
            Application::$app->setController(new $action[0]());
            $action[0] = Application::$app->getController();
        }
        return call_user_func($action, $this->request);
    }

    public function renderView($view, $params): string
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->viewContent($view, $params);
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }


    protected function viewContent($view, $params): string
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

    protected function layoutContent(): string
    {
        $layout = $layout = Application::$app->layout;
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }
}



?>
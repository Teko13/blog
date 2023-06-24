<?php
namespace App\src;

class Request
{
    public array $get;
    public array $post;
    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
    }

    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, "?");
        if ($position === false) {
            return $path;
        }
        return $path = substr($path, 0, $position);
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function getBody(): array
    {
        $body = [];
        if ($this->getMethod() == 'get') {
            foreach ($this->get as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->getMethod() == 'post') {
            foreach ($this->post as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }
    public function isGetMethod(): bool
    {
        return $this->getMethod() === 'get';
    }
    public function isPostMethod(): bool
    {
        return $this->getMethod() === 'post';
    }
}


?>

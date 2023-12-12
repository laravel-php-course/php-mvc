<?php

namespace App\core;

class Router
{
    private array $routes;
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($url, $callback)
    {
        $this->routes['get'][$url] = $callback;
    }

    public function post($url, $callback)
    {
        $this->routes['post'][$url] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->Method();
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback)
        {
            die('404');
        }

        echo call_user_func($callback);
    }
}
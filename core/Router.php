<?php

namespace App\core;

use App\configs\BaseConfig;

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

        if (is_array($callback))
        {
            $callback[0] = new $callback[0];
        }

        if (is_string($callback))
        {
            return $this->renderTemplate($callback);
        }

        return call_user_func($callback);
    }

    public function renderTemplate(string $view, array $params = []): array|bool|string
    {
        $layout        = 'main.php';
        $layoutContent = $this->renderLayout($layout);
        $viewContent   = $this->renderOnlyView($view, $params);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderLayout(string $layout): bool|string
    {
        ob_start();
        include_once BaseConfig::getConfigs('BASE_DIR')."/views/layout/$layout";
        return ob_get_clean();
    }

    public function renderOnlyView(string $view, array $params = []): bool|string
    {
        ob_start();
        foreach ($params as $key => $value)
        {
            $$key = $value;
        }
        include_once BaseConfig::getConfigs('BASE_DIR')."/views/$view.php";
        return ob_get_clean();
    }
}
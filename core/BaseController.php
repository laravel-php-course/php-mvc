<?php

namespace App\core;

class BaseController
{
    public function render($view, $params = []): bool|array|string
    {
        return Application::$app->router->renderTemplate($view, $params);
    }
}
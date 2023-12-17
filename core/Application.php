<?php

namespace App\core;

use JetBrains\PhpStorm\Pure;

class Application
{

    public Router $router;
    public Request $request;
    public static Application $app;

    #[Pure] public function __construct()
    {
        self::$app     = $this;
        $this->request = new Request();
        $this->router  = new Router($this->request);
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
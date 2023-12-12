<?php

namespace App\core;

class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/'; //  /user?id=12
        $position = strpos($path, '?');

        if (!$position) return $path;

        return substr($path, 0, $position);
    }

    public function Method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}
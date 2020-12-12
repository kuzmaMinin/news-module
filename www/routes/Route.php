<?php

namespace Route;

use Controller\NewsController;

class Route
{
    public function getRoute()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (preg_match('/^\/(news)\/?$/', $uri)) {
            $page = 1;
            return (new NewsController)->actionList($page);
        }

        if (preg_match('/^\/(news)\/(page)-(\d+)/', $uri, $matches)) {
            $page = $matches[3];
            return (new NewsController)->actionList($page);
        }

        if (preg_match('/^\/(news)\/(\d+)/', $uri, $matches)) {
            $id = $matches[2];;
            return (new NewsController)->actionDetail($id);
        }
    }
}


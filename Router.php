<?php

class Router
{

    function delegate()
    {

        $this->getController($file, $controller, $action, $args);


        if (is_readable($file) == false) {

            die ('404 Not Found FILE');

        }

        $controller = new $controller();
        $controller->$action($args);

    }

    /**
     *
     * @param $file
     * @param $controller
     * @param $action
     * @param $args
     */
    private function getController(&$file, &$controller, &$action, &$args)
    {


        $route = $_SERVER["REQUEST_URI"];

        if (empty($route)) {
            $route = 'index';
        }

        $route = trim($route, '/\\');

        $parts = explode('/', $route);

        $cmdPath = PROJECTDIR . "/controllers/";
        foreach ($parts as $part) {

            $fullPath = $cmdPath . $part;

            if (is_dir($fullPath)) {

                $cmdPath .= $part . DIRSEP;

                array_shift($parts);

                continue;

            }

            if (is_file($fullPath . '.php')) {

                $controller = $part;

                array_shift($parts);

                break;

            }

        }

        if (empty($controller)) {
            $controller = 'WeatherController';
        };

        $action = array_shift($parts);

        if (empty($action)) {
            $action = 'index';
        }


        $file = $cmdPath . $controller . '.php';
        $controller = '\controllers\\' . $controller;
        foreach ($parts as $par) {
            $a = explode('-', $par);
            $args[$a[0]] = $a[1];

        }

    }
}
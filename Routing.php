<?php

require_once 'src/controllers/DefaultController.php';
require_once 'src/controllers/SecurityController.php';
require_once 'src/controllers/WorkoutController.php';
require_once 'src/controllers/CommunicationController.php';
require_once 'src/controllers/UserController.php';

class Router {
    public static $routes;

    public static function get($url, $view) {
        self::$routes[$url] = $view;
    }

    public static function post($url, $view) {
        self::$routes[$url] = $view;
    }

    public static function run($url) {
        $urlParts = explode("/", $url);
        $action = $urlParts[0];

        if (!array_key_exists($action, self::$routes)) {
            header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
            include('notFound.php');
            die();
        }
        
        $controller = self::$routes[$action];
        $object = new $controller;
        $action = $action ?: 'homepage';

        //TODO: check if id is int
        //TODO: map whether id can be passed to a certain controller method
        $id = $urlParts[1] ?? '';

        $object->$action($id);
    }
}

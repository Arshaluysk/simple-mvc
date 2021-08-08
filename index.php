<?php
require_once 'vendor/autoload.php';
require_once 'routes.php';

    class App {

        public static $project = 'mvc';
        public $routes = null;

        function __construct($routes){

            $this->routes = $routes;
            $http = (isset($_SERVER['PATH_INFO'])) ? $_SERVER['PATH_INFO'] : '/task';
            $http = explode('/', $http);

            if (array_key_exists($http[1], $this->routes) && $this->routes[$http[1]]['req'] == $_SERVER['REQUEST_METHOD']) {

                if (array_key_exists('directory',$this->routes[$http[1]])) {
                    $path = "./controller/".$this->routes[$http[1]]['directory'].'/'.$this->routes[$http[1]]['controller'].".php";
                } else{
                    $path = "./controller/".$this->routes[$http[1]]['controller'].".php";
                }

                if (file_exists($path)) {

                    include $path;

                } else {

                    exit ("go back");
                }

                $controller = new $this->routes[$http[1]]['controller'];
                call_user_func([$controller, $this->routes[$http[1]]['method']]);

            } else {

                header("HTTP/1.0 404 Not Found");
            }
        }

        public static function url(){

            if (isset($_SERVER['HTTPS'])) {
                if ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") {

                    return 'https://' . $_SERVER['HTTP_HOST'];
                } else {

                    return 'http://' . $_SERVER['HTTP_HOST'].'/'.self::$project;
                }
            } else {

                return 'http://' . $_SERVER['HTTP_HOST'].'/'.self::$project;
            }
        }

        public static function redirect ($url) {
            header("location:".self::url().'/'.$url);die;
        }
        public static function route ($url) {
            return self::url().'/'.$url;
        }
    }

new App($routes);

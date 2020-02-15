<?php
    class Router{
        public $routes = [
            'GET' => [],
            'POST' => []
        ];

        public function get($uri,$controller){
            $this->routes['GET'][$uri] = $controller;
        }
        
        public function post($uri,$controller){
            $this->routes['POST'][$uri] = $controller;
        }

        public static function load($fileName){
            $router = new static;
            require_once $fileName;
            return $router;
        }

        public function direct($uri,$requestMethod){
            try{
                if(array_key_exists($uri,$this->routes[$requestMethod])){
                    $this->shiftControl(...explode('@',$this->routes[$requestMethod][$uri]));
                }else{
                    throw new Exception("Something went wrong!");
                }

            }catch(Exception $e){
                die($e->getMessage());
            }
        }
        public function shiftControl($className,$methodName){
            $controller = new $className;
            $controller->$methodName();
        }
    }
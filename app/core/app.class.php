<?php
    class App{
        public static $registry = [];

        public static function bind($key,$value){
            static::$registry[$key] = $value;
        }

        public static function get($key){
            try{
                if(!array_key_exists($key,static::$registry)){
                    throw new Exception("${key} does not exist");
                }
            }catch(Exception $e){
                die($e->getMessage());
            }
            return static::$registry[$key];
        }
    }
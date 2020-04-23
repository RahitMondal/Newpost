<?php
    class Connection{
        public static function make($db){
            try{
                $pdo = new PDO(
                    $db['connection'].';dbname='.$db['name'],
                    $db['user'],$db['password'],
                    $db['option']
                );
                return $pdo;
            }catch(PDOException $e){
                die("connection error - ".$e->getMessage());
            }
        }
    }
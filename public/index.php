<?php
    require_once '../app/core/bootstrap.php';
    
    //var_dump($_SERVER);

    App::bind('dbConfig',require_once '../config/database.config.php');
    App::bind('conn',Connection::make(App::get('dbConfig')));
    $pdoConn = App::get('conn');
    App::bind('dbUpdate',new Query($pdoConn));
    $dbUpdate = App::get('dbUpdate');

    Router::load('../routes/routes.php')->direct(Request::getUri(),Request::getMethod());
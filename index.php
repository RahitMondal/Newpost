<?php
    require_once 'core/bootstrap.core.php';
    
    //var_dump($_SERVER);

    Router::load('core/routes.core.php')->direct(Request::getUri(),Request::getMethod());
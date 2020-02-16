<?php
    $router->get('','PageController@home');
    $router->get('friends','PageController@friends');
    $router->get('edit','PageController@edit');
    $router->post('signup','ModelController@signup');
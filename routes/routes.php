<?php
    $router->get('','PageController@home');
    $router->get('friends','PageController@friends');
    $router->get('edit','PageController@edit');
    $router->post('signup','ModelController@signup');
    $router->post('update','ModelController@update');
    $router->post('logout','ModelController@logout');
    $router->post('login','ModelController@login');
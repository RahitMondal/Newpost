<?php
    return [
        'name' => 'newconn',
        'connection' => 'mysql:host=localhost',
        'user' => 'root',
        'password' => '',
        'option' => [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    ];
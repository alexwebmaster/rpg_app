<?php

return [
    'app_key' => '{key}',
    'roles'=>[
        'user'=>[],
        'admin'=>['user'],
        'super_admin'=>['user','admin'],
    ],
    'provider'=>'database',
    'firewall'=>[
        'admin' => [
            'prefix' => '/admin/',
            'login_path' => '/admin/login',
            'redirect_path' => '/login'
        ]
    ]
];
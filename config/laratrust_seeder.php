<?php

return [
    'role_structure' => [
        'administrator' => [
            'users' => 'c,r,u,d',
            'post' => 'c,r,u,d',
            'profile' => 'c,r,u,d',
            'product' => 'c,r,u,d',
        ],
        'client' => [
            'users' => 'r',
            'post' => 'c,r,u,d',
            'product' => 'c,r,u,d',

        ],
        'editor' => [
            'users' => 'r,u',
            'post' => 'c,r,u,d',
            'product' => 'c,r,u,d',

        ],
        'operator' => [
            'users' => 'r',
        ],
        'user' => [],
    ],
    'permission_structure' => [],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];

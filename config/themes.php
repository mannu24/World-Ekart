<?php

return [
    'default' => 'default',

    'themes' => [
        'default' => [
            'views_path' => 'resources/themes/default/views',
            'assets_path' => 'public/themes/default/assets',
            'name' => 'Default'
        ],

        'martfury' => [
            'views_path' => 'resources/themes/martfury/views',
            'assets_path' => 'public/themes/martfury/assets',
            'name' => 'Martfury',
            'parent' => 'default'
        ],

        'ekart' => [
            'views_path' => 'resources/themes/ekart/views',
            'assets_path' => 'public/themes/ekart/assets',
            'name' => 'Ekart',
            'parent' => 'Velocity'
        ],

        'velocity' => [
            'views_path' => 'resources/themes/velocity/views',
            'assets_path' => 'public/themes/velocity/assets',
            'name' => 'Velocity',
            'parent' => 'default'
        ],
    ],

    'admin-default' => 'default',

    'admin-themes' => [
        'default' => [
            'views_path' => 'resources/admin-themes/default/views',
            'assets_path' => 'public/admin-themes/default/assets',
            'name' => 'Default'
        ]
    ]
];

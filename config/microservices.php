<?php

return [
    /**
     * 定义 URI 前缀
     */
    'prefix' => env('MS_URI_PREFIX', 'api'),

    /**
     * 定义服务
     */
    'services' => [
        // 例：用户服务
        'user' => env('MS_USER'),
    ]
];

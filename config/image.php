<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */
    'driver' => env('IMAGE_DRIVER', 'gd'),

    /*
    |--------------------------------------------------------------------------
    | GD Library Path
    |--------------------------------------------------------------------------
    |
    | If you are using the GD library and your server does not load it by
    | default you may specify the path to the GD library below.
    |
    */
    'gd' => [
        'path' => '/usr/bin/convert',
    ],
];

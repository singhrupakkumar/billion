<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ], 
    'facebook' => [ 
        'client_id' => '616915468714853',
        'client_secret' => 'c9b9fd8c0f11999783f2b323a50fa19b',
        'redirect' => 'https://dev.alianceparcel.com/sociallogin/facebook/callback',
    ],
    'twitter' => [
        'client_id' => '1034671247631-tbn2fi4lj5duoeenpn4ll6do542suong.apps.googleusercontent.com',
        'client_secret' => 'OyZ0NLzrZzp7_q7qAddfD3D_',
        'redirect' => 'https://dev.alianceparcel.com/sociallogin/google/callback',
    ],
    'instagram' => [
        'client_id' => '112fad92a51147729756f1cecb010f22',
        'client_secret' => '97aad18047bd4a01806e59d12e997c95',
        'redirect' => 'https://dev.alianceparcel.com/sociallogin/instagram/callback',
    ], 

];

<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'newman_administration' => [
        'client_id' => env('NEWMAN_ADMINISTRATION_CLIENT_ID'),
        'client_secret' => env('NEWMAN_ADMINISTRATION_CLIENT_SECRET'),
        'redirect' => env('NEWMAN_ADMINISTRATION_REDIRECT'),
        'host' => env('NEWMAN_ADMINISTRATION_HOST'),
    ],

    'gitlab' => [
        'client_id' => env('GITLAB_CLIENT_ID'),
        'client_secret' => env('GITLAB_CLIENT_SECRET'),
        'redirect' => env('GITLAB_REDIRECT_URI'),
        'instance_uri' => env('GITLAB_INSTANCE_URI')
    ],
];

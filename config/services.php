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

    'facebook' => [
        'client_id' => '920516628673334',
        'client_secret' => 'e4dedfa6b5dc0c8563c3202de8f37c50',
        'redirect' => 'http://dinhnghia.ani.com/auth/facebook/callback',
    ],

    'google' => [
        'client_id' => '141672117222-v686f1k51eue4omim4tg2jh7cug5neog.apps.googleusercontent.com',
        'client_secret' => '9rHewg3w0FZoJWZe6tEjcGiw',
        'redirect' => 'http://dinhnghia.ani.com/auth/google/callback',
    ],

    'github' => [
        'client_id' => '89a2d6824670903348cb',
        'client_secret' => 'b0a791d7eead7632a18c99e2967e921cf224b527',
        'redirect' => 'http://dinhnghia.ani.com/auth/github/callback',
    ],

];

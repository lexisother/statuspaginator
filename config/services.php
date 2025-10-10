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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'gitlab' => [
        'webhook_secret' => env('GITLAB_WEBHOOK_SECRET')
    ],

    'buddy' => [
        'workspace' => env('BUDDY_WORKSPACE'),
        'token' => env('BUDDY_TOKEN'),
    ],

    'ohdear' => [
        'token' => env('OHDEAR_TOKEN'),
    ],

    'jira' => [
        'host' => env('JIRAAPI_V3_HOST'),
        'user' =>  env('JIRAAPI_V3_USER'),
        'token' =>  env('JIRAAPI_V3_PERSONAL_ACCESS_TOKEN'),
        'projectKey' => env('JIRAAPI_V3_PROJECT_KEY'),
    ]

];

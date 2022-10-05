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



    'google' => [ 

    'client_id' => env('GOOGLE_CLIENT_ID'),

    'project_id' => env('GOOGLE_APP_ID'), 

    'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',

    'refresh_token' => 'https://accounts.google.com/o/oauth2/token',

    'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',

    'client_secret' => env('GOOGLE_CLIENT_SECRET'),

    'redirect' => env('GOOGLE_REDIRECT'),

    'redirect_uris' => [env('GOOGLE_REDIRECT')],

      ],

    'dropbox' => [  

    'driver' => 'dropbox',  

   'client_id' => env('DROPBOX_CLIENT_ID'),  

   'client_secret' => env('DROPBOX_CLIENT_SECRET'),  

   'redirect' => env('DROPBOX_REDIRECT_URI') 

    ],



  'graph' => [    

  'client_id' => env('GRAPH_CLIENT_ID'),  

  'client_secret' => env('GRAPH_SECRET'),

  'redirect' => env('MICROSOFT_REDIRECT_URI') 

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
        'client_id' => env('fb_client_id'), //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'client_secret' => env('fb_client_secret'), //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'redirect' => 'https://educate-system.digitalservicescorp.com/callback'
        
    ],



];


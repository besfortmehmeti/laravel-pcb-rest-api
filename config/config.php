<?php
/**
 * PayPal Setting & API Credentials
 */
return [
    'mode'    => 'sandbox', // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'url'          => env('PCB_SANDBOX_API_URL', ''),
        'merchant'     => env('PCB_SANDBOX_API_MERCHANT_ID', ''),
        'ssl_key'      => env('PCB_SANDBOX_API_SSL_KEY', ''),
        'ssl_key_pass' => env('PCB_SANDBOX_API_SSL_KEY_PASS', ''),
        'ssl_cert'     => env('PCB_SANDBOX_API_SSL_CERT', ''),
    ],
    'live' => [
        'url'          => env('PCB_LIVE_API_URL', ''),
        'merchant'     => env('PCB_LIVE_API_MERCHANT_ID', ''),
        'ssl_key'      => env('PCB_LIVE_API_SSL_KEY', ''),
        'ssl_key_pass' => env('PCB_LIVE_API_SSL_KEY_PASS', ''),
        'ssl_cert'     => env('PCB_LIVE_API_SSL_CERT', ''),
    ],
    'payment_action'   => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
    'currency'         => 'EUR',
    'approved_url'     => '', // Change this accordingly for your application.
    'declined_url'     => '', // Change this accordingly for your application.
    'canceled_url'     => '', // Change this accordingly for your application.
    'locale'           => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
];
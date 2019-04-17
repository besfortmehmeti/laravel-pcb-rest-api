<?php
/**
 * PCB Gateway Setting
 */
return [
    'mode'    => env('PCB_MODE', ''), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'url'          => env('PCB_SANDBOX_API_URL', ''),
        'merchant'     => env('PCB_SANDBOX_API_MERCHANT_ID', ''),
        'ssl_key'      => env('PCB_SANDBOX_API_SSL_KEY', ''),
        'ssl_cainfo'   => env('PCB_SANDBOX_API_SSL_CAINFO', ''),
        'ssl_cert'     => env('PCB_SANDBOX_API_SSL_CERT', ''),
    ],
    'live' => [
        'url'          => env('PCB_LIVE_API_URL', ''),
        'merchant'     => env('PCB_LIVE_API_MERCHANT_ID', ''),
        'ssl_key'      => env('PCB_LIVE_API_SSL_KEY', ''),
        'ssl_cainfo'   => env('PCB_LIVE_API_SSL_CAINFO', ''),
        'ssl_cert'     => env('PCB_LIVE_API_SSL_CERT', ''),
    ],
    'ApproveURL'         => env('PCB_ApproveURL', ''),
    'CancelURL'         => env('PCB_CancelURL', ''),
    'DeclineURL'         => env('PCB_DeclineURL', ''),
    'currency'         => 'EUR',
    'locale'           => 'EN', 
];
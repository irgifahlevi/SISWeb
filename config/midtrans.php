<?php
return [
  'midtrans_merchant_id' => env('MIDTRANS_MERCHANT_ID'),
  'midtrans_client_key' => env('MIDTRANS_CLIENT_KEY'),
  'midtrans_server_key' => env('MIDTRANS_SERVER_KEY'),
  'midtrans_production' => env('MIDTRANS_IS_PRODUCTION'),
  'midtrans_development' => env('MIDTRANS_IS_DEVELOPMENT'),
  'midtrans_sanitized' => env('MIDTRANS_IS_SANITIZED'),
  'midtrans_3ds' => env('MIDTRANS_IS_3DS'),
];

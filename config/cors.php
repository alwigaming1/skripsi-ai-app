<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie', '*'], // Tambahkan '*' agar semua path boleh
    'allowed_methods' => ['*'],
    'allowed_origins' => ['*'], // Izinkan semua domain (untuk sementara)
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => true, // Ubah jadi true jika pakai cookie session
];
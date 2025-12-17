<?php

// 1. Load Composer Autoloader
require __DIR__ . '/../vendor/autoload.php';

// 2. Load Aplikasi Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 3. --- FIX VERCEL READ-ONLY FILESYSTEM ---
// Kita paksa Laravel menggunakan folder /tmp untuk penyimpanan sementara
$storagePath = '/tmp/storage';

if (!is_dir($storagePath)) {
    mkdir($storagePath, 0777, true);
    mkdir($storagePath . '/framework/views', 0777, true);
    mkdir($storagePath . '/framework/cache', 0777, true);
    mkdir($storagePath . '/framework/sessions', 0777, true);
    mkdir($storagePath . '/logs', 0777, true);
}

// Set path baru ke aplikasi
$app->useStoragePath($storagePath);

// Paksa Config Cache ke /tmp agar tidak bentrok dengan file sisa Windows
$_SERVER['APP_CONFIG_CACHE'] = '/tmp/config.php';
$_SERVER['APP_SERVICES_CACHE'] = '/tmp/services.php';
$_SERVER['APP_PACKAGES_CACHE'] = '/tmp/packages.php';
$_SERVER['APP_ROUTES_CACHE'] = '/tmp/routes.php';

// 4. Jalankan Aplikasi
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Tambah jika perlu
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Tambah jika perlu
    })
    ->withProviders([
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,

        App\Providers\RouteServiceProvider::class,
        App\Providers\BroadcastServiceProvider::class,
    ])
    ->create();

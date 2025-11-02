<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isAdmin' => App\Http\Middleware\IsAdministrator::class,
            'isDokter' => App\Http\Middleware\IsDokter::class,
            'isPerawat' => App\Http\Middleware\IsPerawat::class,
            'isResepsionis' => App\Http\Middleware\IsResepsionis::class,
            'isPemilik' => App\Http\Middleware\IsPemilik::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
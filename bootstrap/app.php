<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            "IsAdmin" => App\Http\Middleware\IsAdmin::class,
            "ApiAuth" => App\Http\Middleware\ApiAuth::class,

        ]);
        $middleware->web(append:[
            App\Http\Middleware\ChangeLang::class

        ]

    );
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

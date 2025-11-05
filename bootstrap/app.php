<?php

use App\Http\Middleware\RedirectIfAuthenticatedToChat;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
// use App\Http\Middleware\Authenticate;

return Application::configure(basePath: dirname(__DIR__))
    ->withMiddleware(function (Middleware $middleware): void {
        // $middleware->alias(['auth.session', Authenticate::class]);
        $middleware->alias([
            'auth.session_check' => RedirectIfAuthenticatedToChat::class,
        ]);
    })
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

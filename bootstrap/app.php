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
        //
    })
 ->withExceptions(function (Exceptions $exceptions) {
    $exceptions->render(function (Illuminate\Auth\AuthenticationException $e, Illuminate\Http\Request $request) {
        $guard = $e->guards()[0] ?? null;

        switch ($guard) {
            case 'clinic_user':
                $login = route('clinic.login');
                break;
            default:
                $login = route('login');
                break;
        }

        return $request->expectsJson()
            ? response()->json(['message' => $e->getMessage()], 401)
            : redirect()->guest($login);
    });
})->create();
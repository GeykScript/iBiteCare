<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    protected function redirectTo($request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        $guard = $this->getGuardFromRoute($request);

        $loginRoutes = [
            'web' => 'login',
            'clinic_user' => 'clinic.login',
        ];

        if ($guard && isset($loginRoutes[$guard])) {
            return route($loginRoutes[$guard]);
        }

        return route('login');
    }

    protected function getGuardFromRoute($request): ?string
    {
        $route = $request->route();
        if (!$route) {
            return null;
        }

        foreach ($route->middleware() as $middleware) {
            if (Str::startsWith($middleware, 'auth:')) {
                return Str::after($middleware, 'auth:');
            }
        }

        return null;
    }
}

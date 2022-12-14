<?php

namespace App\Http\Middleware;

use App\Exceptions\AccessException;
use Exception;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param Request $request
     * @return string
     */
    protected function redirectTo($request): string
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
        throw new AccessException();
    }
}

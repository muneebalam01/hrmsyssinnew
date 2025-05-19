<?php

namespace App\Exceptions;
use Illuminate\Auth\AuthenticationException;

use Exception;

class Handler extends Exception
{
    protected function unauthenticated($request, AuthenticationException $exception)
{
    if ($request->expectsJson()) {
        return response()->json(['message' => $exception->getMessage()], 401);
    }

    if (in_array('employee', $exception->guards())) {
        return redirect()->route('employee.login');
    }

    return redirect()->route('login');
}
}

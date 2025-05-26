<?php

use App\Responses\Response;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('dashboard/login');
        $middleware->redirectUsersTo('dashboard/home');
        $middleware->alias([
            'throttle:resend-otp' => \Illuminate\Routing\Middleware\ThrottleRequests::class . ':resend-otp',
            ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (ThrottleRequestsException $e, $request) {
            $message = 'Too many attempts. Please try again later.';
            $code = 429;
            if (isset($e->getHeaders()['Retry-After'])) {
                $retryAfterSeconds = (int) $e->getHeaders()['Retry-After'];
                $message = 'Too many attempts. Please wait ' . $retryAfterSeconds . ' seconds before trying again.';
            }
            return Response::error([], $message, $code);
        });
    })->create();

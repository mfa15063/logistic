<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use League\OAuth2\Server\Exception\OAuthServerException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Request;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {

        $this->reportable(function (Request $request ,Throwable $e) {
            if ($e instanceof OAuthServerException && $e->getCode() === 9) {
                // OAuthServerException with code 9 indicates an expired or invalid token
                return $this->unauthenticated($request, $e);
            }
            return response()->json($e->getMessage());
        });
    }
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json(['type' => 'error','code'=>'Unauthenticated','message'=>'Unauthenticated Client'], 401);
        }
    }
}

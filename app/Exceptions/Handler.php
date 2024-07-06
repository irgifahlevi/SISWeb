<?php

namespace App\Exceptions;

use Illuminate\Database\QueryException;
use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('Error.404', [], 404);
        }
        if ($this->isHttpException($exception) && $exception->getStatusCode() == 500) {
            return response()->view('Error.500', [], 500);
        }
        if ($exception instanceof QueryException) {
            return response()->view('Error.Database', [], 500);
        }

        //return parent::render($request, $exception);
        return response()->view('Error.General', ['exception' => $exception], 500);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}

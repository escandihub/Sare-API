<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    // public function register()
    // {
    //     //
    // }
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['message'=> 'Registro no encontrado.'
        ], 404);
        }        
        else if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'error' => 'Recurso no encontrado.'
            ], 404);
        }
        else if($exception instanceof ValidationException)
            return response()->json(['message'=>'Los datos proporcionados no son válidos.','errors' => $exception->validator->getMessageBag()], 422);
        return parent::render($request, $exception);
    }
}

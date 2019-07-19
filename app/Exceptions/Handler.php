<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Log;
class Handler extends ExceptionHandler {

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception) {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception) {

        // if ($request->wantsJson() && !($exception instanceof ValidationException)) {
        //     Log::error("Error in " . $exception->getFile() . ", CODE:" . $exception->getCode() . ", LINE:" . $exception->getLine() . ", MSG:" . $exception->getMessage());
        //     return response()->json([
        //                 "message" => $exception->getMessage(),
        //                 "code" => $exception->getCode(),
        //                 "file" => $exception->getFile(),
        //                 "line" => $exception->getLine(),
        //                 "status_code" => 500
        //             ])->setStatusCode(500);
        // }

        return parent::render($request, $exception);
    }

}

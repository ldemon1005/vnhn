<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {   
        // dd($exception);
        // return view('error.404');
        // return response()->view('error.404', [], 404);
        // return parent::render($request, $exception);
        // if ($this->isHttpException($e))
        // {
        //     return $this->renderHttpException($e);
        // }
        // else
        // {
        //     return parent::render($request, $e);
        // }
        if ($exception instanceof ModelNotFoundException) {
            if ($request->ajax()) {
                // Nếu request ở dạng ajax trả về lỗi 404 với thông báo dạng Json
                return response()->json(['error' => 'Không tìm thấy user'], 404);
            } else {
                // Request thông thường trả về view 404
                return response()->view('error.404', [], 404);
            }
        }
        return parent::render($request, $exception);
    }
    // protected function unauthenticated($request, AuthenticationException $exception)
    // {
    //     if ($request->expectsJson()) {
    //         return response()->json(['error' => 'Unauthenticated.'], 401);
    //     }

    //     return redirect()->guest(route('auth.login'));
    // }
}

<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Exception;
use function get_class;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use function var_dump;

class Handler extends ExceptionHandler
{
    use ApiResponser;
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param Exception $exception
     * @return JsonResponse|Response
     */
    public function render($request, Exception $exception)
    {
        switch (true)
        {
            case $exception instanceof HttpException:
                $code    = $exception->getStatusCode();
                $message = Response::$statusTexts[$code];
                break;
            case $exception instanceof ModelNotFoundException:
                $model   = strtolower(class_basename($exception->getModel()));
                $message = "No item found for ${model} with the given id";
                $code    = Response::HTTP_NOT_FOUND;
                break;
            case $exception instanceof AuthorizationException:
                $message = $this->getErrorMessage($exception);
                $code    = Response::HTTP_UNAUTHORIZED;
                break;
            case $exception instanceof AuthenticationException:
                $message = $this->getErrorMessage($exception);
                $code    = Response::HTTP_FORBIDDEN;
                break;
            case $exception instanceof ValidationException:
                $message = $exception->validator
                    ->errors()
                    ->getMessages();
                $code    = Response::HTTP_UNPROCESSABLE_ENTITY;
                break;
            case $exception instanceof ClientException:
                $message = $this->getErrorMessage($exception);
                $code = $exception->getCode();
                break;
            default:
                if (empty(env('APP_DEBUG'))) {
                    $message = $exception->getMessage();
                    $code = Response::HTTP_INTERNAL_SERVER_ERROR;
                }
                else
                {
                    return parent::render($request, $exception);
                }
        }

        return $this->errorResponse($message, $code);
    }

    private function  getErrorMessage(\Exception $ex)
    {
        $json = json_decode($ex->getMessage());
        return $json->error ?? Response::$statusTexts[$ex->getCode()];
    }
}

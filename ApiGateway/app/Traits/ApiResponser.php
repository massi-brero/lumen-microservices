<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ApiResponser
{
    /**
     * @param $data
     * @param int $code
     * @return Response
     */
    public function successResponse($data, $code = Response::HTTP_OK): Response
    {
        return response($data, $code)->header('Content-Type', 'application/json');
    }

    /**
     * @param $msg
     * @param int $code
     * @return JsonResponse
     */
    public function errorResponse($msg, $code = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return response()->json(['error' => $msg, 'code' => $code], $code);
    }

    /**
     * @param string $msg
     * @param int $code
     * @return Response
     */
    public function errorMessageResponse(string $msg, $code = Response::HTTP_INTERNAL_SERVER_ERROR): Response
    {
        return response($msg, $code)->header('Content-Type', 'application/json');
    }
}
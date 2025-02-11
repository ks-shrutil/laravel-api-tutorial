<?php

namespace App\Traits;


trait ApiResponses{


    /**
     * Summary of ok
     * @param mixed $message
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    protected function ok($message, $data=[]) {
        return $this->success($message, $data , 200);
    }


    /**
     * Summary of success
     * @param mixed $message
     * @param mixed $statusCode
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    protected function success($message, $data = [],  $statusCode = 200) {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $statusCode
        ], $statusCode);
    }

    protected function error($message, $statusCode) {
        return response()->json([
            'message' => $message,
            'status' => $statusCode
        ], $statusCode);
    }
}
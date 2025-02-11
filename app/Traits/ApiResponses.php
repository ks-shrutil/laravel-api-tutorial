<?php

namespace App\Traits;


trait ApiResponses{


    /**
     * Summary of ok
     * @param mixed $message
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    protected function ok($message) {
        return $this->success($message, 200);
    }


    /**
     * Summary of success
     * @param mixed $message
     * @param mixed $statusCode
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    protected function success($message, $statusCode = 200) {
        return response()->json([
            'message' => $message,
            'status' => $statusCode
        ], $statusCode);
    }
}
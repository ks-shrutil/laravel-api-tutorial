<?php

namespace App\Traits;


trait ApiResponses
{


    /**
     * Undocumented function
     *
     * @param [type] $message
     * @param array $data
     * @return void
     */
    protected function ok($message, $data = [])
    {
        return $this->success($message, $data, 200);
    }


    /**
     * Undocumented function
     *
     * @param [type] $message
     * @param array $data
     * @param integer $statusCode
     * @return void
     */
    protected function success($message, $data = [],  $statusCode = 200)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
            'status' => $statusCode
        ], $statusCode);
    }


    /**
     * Undocumented function
     *
     * @param [type] $message
     * @param [type] $statusCode
     * @return void
     */
    protected function error($errors = [], $statusCode = null)
    {
        if (is_string($errors)) {

            return response()->json([
                'message' => $errors,
                'status' => $statusCode
            ], $statusCode);
        }

        return response()->json([
            'errors' => $errors
        ]);
    }


    protected function notAuthorized($message){
        return $this->error([
            'status' => 401,
            'message' => $message,
            'source' => ''
        ]);
    }
}

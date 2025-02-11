<?php

namespace App\Traits;


trait ApiResponses{
    /**
     * Summary of ok
     * @param mixed $message
     */
    protected function ok($message){
        return $this->success($message, 200);
    }


    /**
     * Summary of success
     * @param mixed $message
     * @param mixed $statusCode
     */
    protected function success($message, $statusCode = 200){
        return $this->ok('Hello, Login!');
      
    }
}
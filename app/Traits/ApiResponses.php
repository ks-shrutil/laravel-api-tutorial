<?php

namespace App\Traits;


trait ApiResponses{

    protected function ok($message){
        return $this->success($message, 200);
    }

    protected function success($message, $statusCode = 200){
        return $this->ok('Hello, Login!');
      
    }
}
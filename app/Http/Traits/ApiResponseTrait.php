<?php

namespace App\Http\Traits;

trait ApiResponseTrait
{

    public function apiResponse($data = null, $message = null, $status = null)
    {
        $return = [
            'data' => $data,
            'message' => $message,
            'status' => $status
        ];
        return response($return, $status);
    }

}

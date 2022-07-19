<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Validator;

trait PostValidationTrait
{
    use ApiResponseTrait;

    public function validateRequest($request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required'
        ]);
        if ($validation->fails())
            return [
                'status' => false,
                'message' => $validation->errors()
            ];
        return [
            'status' => true,
            'message' => ''
        ];
    }

}

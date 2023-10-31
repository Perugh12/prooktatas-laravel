<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    public function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message
        ];

        return response()->json($response, $code);
    }

    public function sendError($error, $message = [], $code = 404)
    {
        $response = [
            'success' => false,
            'data' => $error,
            'message' => $message
        ];

        return response()->json($response, $code);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function successMsg($data, $message)
    {
        $response = [
            'success' => true,
            'data' => $data,
            'message' => $message
        ];

        return response()->json($response, 200);
    }

    public function errrorMsg($data=[], $message, $httpCode=404)
    {
        $response = [
            'success' => false,
            'message' => $message
        ];

        if (!empty($message)) {
            $response['data'] = $data;
        }

        return response()->json($response, $httpCode);
    }
}

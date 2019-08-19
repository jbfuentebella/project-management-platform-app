<?php

namespace App;

class ResponseFormatter
{
    public static function successMsg($data, $message)
    {
        $response = [
            'success' => true,
            'data' => $data,
            'message' => $message
        ];

        return response()->json($response, 200);
    }

    public static function errorMsg($message, $data=[], $httpCode=404)
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

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Response;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function successResponse($data, $message)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
            'errors' => []
        ], Response::HTTP_OK);
    }

    public function errorResponse($errors, $message, $code = 500)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => [],
            'errors' => $errors
        ], $code);
    }
    public function activityLog($logName=null,$description=null,$performedOn,$event=null,$properties=null)
    {
        $user = auth()->user();
        activity($logName)->withProperties($properties)
            ->causedBy($user)
            ->performedOn($performedOn)
            ->event($event)
            ->log($description);
    }
}

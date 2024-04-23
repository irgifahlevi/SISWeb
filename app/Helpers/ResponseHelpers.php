<?php

namespace App\Helpers;

use Illuminate\Http\Response;

class ResponseHelpers
{
  public static function SuccessResponse($message, $data, $status)
  {
    return response()->json([
      'status' => $status,
      'message' => $message,
      'data' => $data,
    ], $status);
  }

  public static function ErrorResponse($message, $status)
  {
    return response()->json([
      'status' => $status,
      'message' => $message
    ], $status);
  }
}

<?php

namespace App\Traits;
use Illuminate\Http\Response;

trait ApiResponser{

    /**
     * Build success response
     * @param string|array $data
     * @param int $code
     * @return Illuminate\Http\JsonResponse
     */

    public function successResponse($data, $code = Response::HTTP_OK)
    {
<<<<<<< HEAD
        return response()->json(['data' => $data, 'site' => 2], $code);
=======
        return response()->json(['data' => $data, 'site' => 1], $code);
>>>>>>> 54b457263e92240da2d86e7970f3a8d9f73342f2
    }

    /**
     * Build error responses
     * @param string|array $message
     * @param int $code
     * @return Illuminate\Http\JsonResponse
     */

    public function errorResponse($message, $code)
    {
<<<<<<< HEAD
     return response()->json(['error' => $message, 'site' => 2, 'code' => $code], $code);
=======
     return response()->json(['error' => $message, 'site' => 1, 'code' => $code], $code);
>>>>>>> 54b457263e92240da2d86e7970f3a8d9f73342f2
    }
}
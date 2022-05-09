<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token): JsonResponse
    {
        return response()->json([
            'token_type' => 'Bearer: ',
            'access_token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    /**
     * @param string $token
     * @param string $email
     * @return string
     */
    public function generateResetLink(string $token, string $email): string
    {
        return getenv('APP_URL'). '/api/user/recover-password?token='. $token. '&email='. $email;
    }
}

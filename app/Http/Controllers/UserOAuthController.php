<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Http\Redirector;

class UserOAuthController
{
    private const CODE = 'dbd214d5caf41e67d8dddb316c16d167913b8418';

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function oauth(Request $request): RedirectResponse|Redirector
    {
        Log::info('oauth', $request->all());
        $params = $request->all();
        $params['code'] = self::CODE;

        $url = $request['redirect_uri'] . '?' . http_build_query($params);

        Log::info($url);

        return redirect($url);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getToken(Request $request): array
    {
        Log::info('getToken', $request->all());
        return [
            'access_token' => sha1(time()),
            'refresh_token' => sha1(time()),
            'token_type' => 'bearer',
            'expires_in' => 600000,
        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function refreshToken(Request $request): array
    {
        Log::info('refreshToken', $request->all());
        return $this->getToken($request);
    }
}

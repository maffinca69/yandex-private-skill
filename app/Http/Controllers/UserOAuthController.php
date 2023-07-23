<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Lumen\Http\Redirector;

class UserOAuthController
{
    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function oauth(Request $request): RedirectResponse|Redirector
    {
        $params = [
            'code' => sha1(time()),
            'state' => $request['state'],
            'client_id' => $request['client_id'],
            'scope' => $request['scope'],
        ];

        return redirect($request['redirect_uri'] . '?' . http_build_query($params));
    }

    /**
     * @param Request $request
     * @return string
     */
    public function getToken(Request $request): string
    {
        return sha1(md5(microtime(true)));
    }

    /**
     * @param Request $request
     * @return string
     */
    public function refreshToken(Request $request): string
    {
        return $this->getToken($request);
    }
}

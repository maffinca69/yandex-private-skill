<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserOAuthController
{
    /**
     * @param Request $request
     * @return void
     */
    public function oauth(Request $request): void
    {
        redirect()->to($request['redirect_uri']);
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

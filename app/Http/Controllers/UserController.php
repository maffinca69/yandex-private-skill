<?php

namespace App\Http\Controllers;

use App\Http\Request\FormRequest\UserUnlinkRequest;

class UserController
{
    /**
     * @param UserUnlinkRequest $request
     * @return array
     */
    public function unlink(UserUnlinkRequest $request): array
    {
        return [
            'request_id' => $request->getXRequestId(),
        ];
    }
}

<?php

namespace App\Http\Request\FormRequest;

use App\Http\Request\AbstractRequest;

abstract class YandexSmartHomeRequest extends AbstractRequest
{
    /**
     * @return string
     */
    public function getXRequestId(): string
    {
        return $this->request->header('X-Request-Id', 5);
    }
}

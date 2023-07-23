<?php

namespace App\Http\Request\FormRequest\Device;

use App\Http\Request\FormRequest\YandexSmartHomeRequest;

class UserDevicesGettingRequest extends YandexSmartHomeRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [];
    }
}

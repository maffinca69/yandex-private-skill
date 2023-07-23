<?php

namespace App\Http\Request\FormRequest\Device;

use App\Http\Request\FormRequest\YandexSmartHomeRequest;

class UserStateDevicesGettingRequest extends YandexSmartHomeRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'devices' => ['required', 'array'],
            'devices.*.id' => ['required', 'string'],
        ];
    }

    /**
     * @return array
     */
    public function getDevices(): array
    {
        return $this->request->get('devices');
    }
}

<?php

namespace App\Http\Request\FormRequest\Device;

use App\Http\Request\FormRequest\YandexSmartHomeRequest;

class UserChangeStateDevicesRequest extends YandexSmartHomeRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'payload.devices' => ['required', 'array']
        ];
    }

    /**
     * @return array
     */
    public function getDevices(): array
    {
        return $this->request->get('payload.devices');
    }
}

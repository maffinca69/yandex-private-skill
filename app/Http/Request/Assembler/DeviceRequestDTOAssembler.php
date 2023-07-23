<?php

namespace App\Http\Request\Assembler;

use App\Http\Request\FormRequest\Device\UserStateDevicesGettingRequest;
use App\Services\Device\DTO\DeviceRequestDTO;

class DeviceRequestDTOAssembler
{
    /**
     * @param array $deviceData
     * @return DeviceRequestDTO
     */
    public function create(array $deviceData): DeviceRequestDTO
    {
        $customData = json_decode($deviceData['custom_data'] ?? [], true);

        return new DeviceRequestDTO($deviceData['id'], $customData);
    }
}

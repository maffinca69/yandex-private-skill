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
        return new DeviceRequestDTO($deviceData['id'], $deviceData['custom_data'] ?? []);
    }
}

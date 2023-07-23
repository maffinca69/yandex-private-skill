<?php

namespace App\Http\Request\Assembler;

use App\Http\Request\FormRequest\Device\UserStateDevicesGettingRequest;
use App\Services\Device\DTO\DeviceRequestDTO;

class DevicesRequestDTOAssembler
{
    public function __construct(private readonly DeviceRequestDTOAssembler $requestDTOAssembler)
    {
    }

    /**
     * @param UserStateDevicesGettingRequest $request
     * @return array<DeviceRequestDTO>
     */
    public function create(UserStateDevicesGettingRequest $request): array
    {
        $requestDevices = $request->getDevices();

        $devices = [];
        foreach ($requestDevices as $requestDevice) {
            $devices[] = $this->requestDTOAssembler->create($requestDevice);
        }

        return $devices;
    }
}

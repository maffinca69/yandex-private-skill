<?php

namespace App\Http\Response\Formatter\Yandex;

use App\Services\Device\DTO\CapabilityDTO;
use App\Services\Device\DTO\DeviceDTO;

class UserDevicesFormatter
{
    public function __construct(private readonly UserDevicesCapabilityFormatter $capabilityFormatter)
    {
    }

    /**
     * @param DeviceDTO $device
     * @param bool $includeState
     * @return array
     */
    public function format(DeviceDTO $device, bool $includeState = false): array
    {
        $capabilities = array_map(static fn (CapabilityDTO $capability) => $this->capabilityFormatter->format($capability, $includeState), $device->getCapabilities());

        return [
            'id' => $device->getId(),
            'name' => $device->getName(),
            'description' => $device->getDescription(),
            'room' => $device->getRoom(),
            'type' => $device->getType(),
            'capabilities' => $capabilities
        ];
    }
}

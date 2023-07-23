<?php

namespace App\Services\Device;

use App\Services\Device\DTO\DeviceDTO;

class DevicesGettingService
{
    /**
     * @param DeviceCreatingService $deviceCreatingService
     */
    public function __construct(
        private readonly DeviceCreatingService $deviceCreatingService,
    ) {
    }

    /**
     * @return array<DeviceDTO>
     */
    public function get(): array
    {
        $device = $this->deviceCreatingService->create();
        return [$device];
    }
}

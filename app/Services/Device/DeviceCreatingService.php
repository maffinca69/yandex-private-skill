<?php

namespace App\Services\Device;

use App\Services\Device\DTO\CapabilityDTO;
use App\Services\Device\DTO\DeviceDTO;

class DeviceCreatingService
{
    public const ID = 1;
    private const NAME = 'Подсветка';
    private const DESCRIPTION = 'Подсветка в прихожей';
    private const ROOM = 'Прихожая';

    /** @var string https://yandex.ru/dev/dialogs/smart-home/doc/concepts/device-types.html */
    private const TYPE = 'devices.types.light';

    /** @var string https://yandex.ru/dev/dialogs/smart-home/doc/concepts/on_off.html */
    public const CAPABILITY_TYPE = 'devices.capabilities.on_off';
    public const INSTANCE = 'on';

    /**
     * @param DeviceStateGettingService $deviceStateGettingService
     */
    public function __construct(private readonly DeviceStateGettingService $deviceStateGettingService)
    {
    }

    /**
     * @return DeviceDTO
     */
    public function create(): DeviceDTO
    {
        $capabilities = [$this->createCapabilityDTO()];

        return new DeviceDTO(
            self::ID,
            self::NAME,
            self::DESCRIPTION,
            self::ROOM,
            self::TYPE,
            $capabilities
        );
    }

    private function createCapabilityDTO(): CapabilityDTO
    {
        $state = $this->deviceStateGettingService->getState();

        return new CapabilityDTO(
            type: self::CAPABILITY_TYPE,
            instance: self::INSTANCE,
            valueAsBool: $state
        );
    }
}

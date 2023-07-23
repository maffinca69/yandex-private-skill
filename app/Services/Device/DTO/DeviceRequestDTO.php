<?php

namespace App\Services\Device\DTO;

class DeviceRequestDTO
{
    /**
     * @param string $id
     * @param array $customData
     */
    public function __construct(
        private readonly string $id,
        private readonly array $customData
    ) {
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getCustomData(): array
    {
        return $this->customData;
    }
}

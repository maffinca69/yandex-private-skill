<?php

namespace App\Services\Device\DTO;

class DeviceDTO
{
    /**
     * @param int $id
     * @param string $name
     * @param string $description
     * @param string $room
     * @param string $type
     * @param array<CapabilityDTO> $capabilities
     */
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly string $description,
        private readonly string $room,
        private readonly string $type,
        private readonly array $capabilities = [],
    ) {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getRoom(): string
    {
        return $this->room;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return array<CapabilityDTO>
     */
    public function getCapabilities(): array
    {
        return $this->capabilities;
    }
}

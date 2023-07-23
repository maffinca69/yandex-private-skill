<?php

namespace App\Services\Device\DTO;

class CapabilityDTO
{
    /**
     * @param string $type
     * @param string $instance
     * @param array $parameters
     * @param bool $retrievable
     * @param bool $reportable
     * @param bool $valueAsBool
     */
    public function __construct(
        private readonly string $type,
        private readonly string $instance = '',
        private readonly array $parameters = [],
        private readonly bool $retrievable = false,
        private readonly bool $reportable = false,
        private readonly bool $valueAsBool = false,
    ) {
    }

    /**
     * @return string
     */
    public function getInstance(): string
    {
        return $this->instance;
    }

    /**
     * @return bool
     */
    public function isValueAsBool(): bool
    {
        return $this->valueAsBool;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * @return bool
     */
    public function isRetrievable(): bool
    {
        return $this->retrievable;
    }

    /**
     * @return bool
     */
    public function isReportable(): bool
    {
        return $this->reportable;
    }
}

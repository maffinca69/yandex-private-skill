<?php

namespace App\Services\Device;

class DeviceStateToggleService
{
    private const SCRIPT_STATE_OFF = 'state-off.sh';
    private const SCRIPT_STATE_ON = 'state-on.sh';

    /**
     * @return bool
     */
    public function on(): bool
    {
        return $this->execute(self::SCRIPT_STATE_ON);
    }

    /**
     * @return bool
     */
    public function off(): bool
    {
        return $this->execute(self::SCRIPT_STATE_OFF);
    }

    /**
     * @param string $script
     * @return bool
     */
    private function execute(string $script): bool
    {
        return (bool) shell_exec(storage_path('scripts') . DIRECTORY_SEPARATOR . $script);
    }
}

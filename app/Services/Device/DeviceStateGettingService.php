<?php

namespace App\Services\Device;

class DeviceStateGettingService
{
    private const REGEX = '/Port.[0-9+]:.\w+ (?<state>[^\W_]+)/';
    private const SCRIPT_NAME = 'getState.sh';

    private const POWER_ON_STATE = 'power';
    private const POWER_OFF_STATE = 'off';

    private const STATES = [
        self::POWER_OFF_STATE => false,
        self::POWER_ON_STATE => true,
    ];

    /**
     * @return bool
     */
    public function getState(): bool
    {
        $output = shell_exec(storage_path('scripts') . DIRECTORY_SEPARATOR . self::SCRIPT_NAME);

        preg_match(self::REGEX, $output, $data);

        $state = $data['state'] ?? null;
        if ($state === null) {
            return false;
        }

        return self::STATES[$state];
    }
}

<?php

namespace App\Services\Device;

use Illuminate\Support\Facades\Log;

class DeviceStateToggleService
{
    private const SCRIPT_STATE_OFF = 'state-off.sh';
    private const SCRIPT_STATE_ON = 'state-on.sh';

    /**
     * @return bool
     */
    public function on(): bool
    {
        $result = $this->execute(self::SCRIPT_STATE_ON);
        Log::info("result on", ['result' => $result]);
        return $this->execute(self::SCRIPT_STATE_ON);
    }

    /**
     * @return bool
     */
    public function off(): bool
    {
        $result = $this->execute(self::SCRIPT_STATE_OFF);

        Log::info("result off", ['result' => $result]);

        return $result;
    }

    /**
     * @param string $script
     * @return false|string|null
     */
    private function execute(string $script): false|string|null
    {
        return shell_exec(storage_path('scripts') . DIRECTORY_SEPARATOR . $script);
    }
}

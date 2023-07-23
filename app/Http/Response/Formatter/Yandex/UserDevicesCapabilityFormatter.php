<?php

namespace App\Http\Response\Formatter\Yandex;

use App\Services\Device\DTO\CapabilityDTO;

class UserDevicesCapabilityFormatter
{
    /**
     * @param CapabilityDTO $capability
     * @param bool $includeState
     * @return array
     */
    public function format(CapabilityDTO $capability, bool $includeState = false): array
    {
        $response = [
            'type' => $capability->getType(),
//            'retrievable' => false,
//            'reportable' => false,
//            'parameters' => [
//                'split' => false
//            ]
        ];

//        if ($includeState) {
//            $response['state'] = [
//                'instance' => $capability->getInstance(),
//                'value' => $capability->isValueAsBool(),
//            ];
//        }

        return $response;
    }
}

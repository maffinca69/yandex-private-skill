<?php

namespace App\Http\Controllers;

use App\Http\Request\Assembler\DevicesRequestDTOAssembler;
use App\Http\Request\FormRequest\Device\UserChangeStateDevicesRequest;
use App\Http\Request\FormRequest\Device\UserDevicesGettingRequest;
use App\Http\Request\FormRequest\Device\UserStateDevicesGettingRequest;
use App\Http\Response\Formatter\Yandex\UserDevicesFormatter;
use App\Services\Device\DeviceCreatingService;
use App\Services\Device\DevicesGettingService;
use App\Services\Device\DeviceStateGettingService;
use App\Services\Device\DeviceStateToggleService;
use App\Services\Device\DTO\DeviceDTO;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserDevicesController
{
    /**
     * @param UserDevicesGettingRequest $request
     * @param UserDevicesFormatter $formatter
     * @param DevicesGettingService $devicesGettingService
     * @param DeviceStateGettingService $deviceStateGettingService
     * @return array
     */
    public function getDevices(
        UserDevicesGettingRequest $request,
        UserDevicesFormatter $formatter,
        DevicesGettingService $devicesGettingService,
        DeviceStateGettingService $deviceStateGettingService
    ): array {
        $devices = $devicesGettingService->get();

        return [
            'request_id' => $request->getXRequestId(),
            'payload' => [
                'user_id' => 1,
                'devices' => array_map(static fn(DeviceDTO $device) => $formatter->format($device), $devices)
            ]
        ];
    }

    public function getStateDevices(
        UserStateDevicesGettingRequest $request,
        DevicesRequestDTOAssembler $devicesRequestDTOAssembler,
        DevicesGettingService $devicesGettingService,
        UserDevicesFormatter $formatter,
    ): array {
        Log::info('getStateDevices', $request->getAll());
        $requestDevices = $devicesRequestDTOAssembler->create($request);

        $devices = $devicesGettingService->get();

        return [
            'request_id' => $request->getXRequestId(),
            'payload' => [
                'devices' => array_map(static fn(DeviceDTO $device) => $formatter->format($device, true), $devices)
            ]
        ];
    }

    /**
     * @param UserChangeStateDevicesRequest $request
     * @param DeviceStateToggleService $deviceStateToggleService
     *
     * @return array
     */
    public function changeState(
        UserChangeStateDevicesRequest $request,
        DeviceStateToggleService $deviceStateToggleService,
        DevicesGettingService $devicesGettingService
    ): array {
        Log::info('changeState', $request->getAll());
        $devices = $devicesGettingService->get();
        $targetDevice = null;
        $action = null;
        foreach ($request->getDevices() as $deviceFromRequest) {
            foreach ($devices as $device) {
                if ($deviceFromRequest['id'] == $device->getId()) {
                    $targetDevice = $device;

                    foreach ($deviceFromRequest['capabilities'] as $capability) {
                        if ($capability['state']['instance'] === DeviceCreatingService::CAPABILITY_TYPE) {
                            $action = $capability['state']['value'];
                        }
                    }
                    break;
                }
            }
        }

        if ($targetDevice === null) {
            throw new BadRequestHttpException('Not found target device');
        }

        $action ? $deviceStateToggleService->on() : $deviceStateToggleService->off();

        return [
            'request_id' => $request->getXRequestId(),
            'payload' => [
                'devices' => [
                    [
                        'id' => DeviceCreatingService::ID,
                        'type' => DeviceCreatingService::CAPABILITY_TYPE,
                        'state' => [
                            'instance' => DeviceCreatingService::INSTANCE,
                            'action_result' => [
                                'status' => 'DONE'
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}

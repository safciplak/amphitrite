<?php

namespace App\Repositories;

use App\Http\Requests\CheckSubscriptionRequest;
use App\Http\Requests\DeviceRequest;
use App\Http\Requests\PurchaseRequest;
use App\Models\Device;
use App\Services\ReceiptValidationService;

class ApiRepository
{
    /**
     * Regsiter.
     *
     * @param  DeviceRequest $request
     * @return mixed
     */
    public function register(DeviceRequest $request)
    {
        return Device::create(
            [
                'uid' => $request->input('uid'),
                'client_token' => uniqid(),
                'app_id' => $request->input('app_id'),
                'language' => $request->input('language'),
                'operating_system_id' => $request->input('operating_system_id'),
            ]
        );
    }

    /**
     * Purchase.
     *
     * @param  PurchaseRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function purchase(PurchaseRequest $request)
    {
        $device = $this->checkClientToken($request);

        if (!$device instanceof Device) {
            return response()->json(['message' => 'Client Token Not Found']);
        }

        $data = ReceiptValidationService::purchase($request);

        return response()->json(['data' => $data]);
    }

    /**
     * Check Subscription.
     *
     * @param  CheckSubscriptionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkSubscription(CheckSubscriptionRequest $request)
    {
        $device = $this->checkClientToken($request);

        if ($device instanceof Device) {
            return response()->json(['subscription_status' => $device->subscription_status]);
        }

        return $device;
    }

    /**
     * Check Client Token.
     *
     * @param $request
     */
    private function checkClientToken($request)
    {
        $clientToken = $request->input('client_token');

        $device = Device::where('client_token', $clientToken)->first();

        if (!$device) {
            return response()->json(['message' => 'Client Token Not Found']);
        }

        return $device;
    }
}

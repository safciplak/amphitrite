<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckSubscriptionRequest;
use App\Http\Requests\DeviceRequest;
use App\Http\Requests\PurchaseRequest;
use App\Jobs\RenewedSubscription;
use App\Models\Device;
use App\Repositories\ApiRepository;

class ApiController extends Controller
{
    /**
     * @var ApiRepository
     */
    private $apiRepository;

    /**
     * ApiController constructor.
     *
     * @param ApiRepository $apiRepository
     */
    public function __construct(ApiRepository $apiRepository)
    {
        $this->apiRepository = $apiRepository;
    }

    /**
     * Register.
     *
     * @param  DeviceRequest $request
     * @return mixed
     */
    public function register(DeviceRequest $request)
    {
        return $this->apiRepository->register($request);
    }

    /**
     * Purchase.
     *
     * @param PurchaseRequest $request
     */
    public function purchase(PurchaseRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->apiRepository->purchase($request);
    }

    /**
     * Check Subscription.
     *
     * @param CheckSubscriptionRequest $request
     */
    public function checkSubscription(CheckSubscriptionRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->apiRepository->checkSubscription($request);
    }

    public function test()
    {
        $devices = Device::all();
        foreach ($devices as $device) {
            dispatch((new RenewedSubscription($device)));
        }
        die('done');
    }
}

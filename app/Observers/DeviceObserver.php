<?php

namespace App\Observers;

use App\Events\Canceled;
use App\Events\NotSubscriber;
use App\Events\Renewed;
use App\Events\Started;
use App\Jobs\ObserveSubscriptionState;
use App\Models\Device;
use App\Services\SendEventService;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Mockery\Exception;

class DeviceObserver
{
    /**
     * @var Client
     */
    private $client;

    /**
     * DeviceObserver constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Handle the Device "created" event.
     *
     * @param  \App\Models\Device $device
     * @return void
     */
    public function created(Device $device)
    {
        logger('created a device');
    }

    /**
     * Handle the Device "updated" event.
     *
     * @param  \App\Models\Device $device
     * @return void
     */
    public function updated(Device $device)
    {
        try {
            dispatch(new ObserveSubscriptionState($device));
        } catch (Exception $exception) {
            logger()->error($exception->getMessage());
        }
    }
}

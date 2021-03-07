<?php
namespace App\Services;

use App\Events\Canceled;
use App\Events\NotSubscriber;
use App\Events\Renewed;
use App\Events\Started;
use App\Models\Device;
use GuzzleHttp\Client;
use Illuminate\Http\Response;

class SendEventService
{
    /**
     * Send Event.
     *
     * @param Device $device
     */
    public static function sendEvent(Device $device)
    {
        logger(sprintf("updated a device with this id = %s", $device->id));
        logger(sprintf("subscription status = %s", $device->subscription_status));

        $options = [
            'event' => self::selectEvent($device),
            'device_id' => $device->id,
            'app_id' => $device->app->id,
        ];

        logger('sending event to callback url .. with below parameters');
        logger($options);

        $client = new Client(['verify' => false ]);
        $response = $client->get($device->app->callback_url, $options);

        if (!in_array($response->getStatusCode(), [Response::HTTP_OK, Response::HTTP_CREATED])) {
            throw new \Exception('Response code was not 200 or 201 so Service Unreachable');
            logger('Response code was not 200 or 201 so Service Unreachable');
        }
    }

    /**
     * Select Event.
     *
     * @param  Device $device
     * @return string
     */
    private static function selectEvent(Device $device)
    {
        switch ($device->subscription_status) {
        case "0":
            return NotSubscriber::class;
        case "1":
            return Started::class;
        case "2":
            return Renewed::class;
        case "3":
            return Canceled::class;
        }
    }
}

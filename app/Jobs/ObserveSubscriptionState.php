<?php

namespace App\Jobs;

use App\Events\Canceled;
use App\Events\NotSubscriber;
use App\Events\Renewed;
use App\Events\Started;
use App\Models\Device;
use App\Services\GoogleAndIosApiService;
use App\Services\SendEventService;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mockery\Exception;

class ObserveSubscriptionState implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Device
     */
    private $device;
    /**
     * @var Client
     */
    private $client;

    /**
     * Create a new job instance.
     *
     * @param Device $device
     */
    public function __construct(Device $device)
    {
        $this->device = $device;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            SendEventService::sendEvent($this->device);
        } catch (Exception $exception) {
            logger()->error($exception->getMessage());
        }
    }
}

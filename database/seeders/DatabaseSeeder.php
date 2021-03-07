<?php

namespace Database\Seeders;

use App\Models\App;
use App\Models\Device;
use App\Models\OperatingSystem;
use App\Models\Subscription;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Device::factory(100)->create();
        App::factory(10)->create();

        $this->generateOperatingSystems();
        $this->generateSubscriptionStatus();
    }

    /**
     * Generate Operating Systems.
     */
    private function generateOperatingSystems(): void
    {
        $oses = ['IOS', 'ANDROID'];
        foreach ($oses as $os) {
            OperatingSystem::create([
                'name' => $os
            ]);
        }
    }

    /**
     * Generate Subscription Status.
     */
    private function generateSubscriptionStatus()
    {
        $statuses = ['NOT_SUBSCRIBER', 'STARTED', 'RENEWED', 'CANCELED'];
        foreach ($statuses as $status) {
            Subscription::create([
                'status_name' => $status
            ]);
        }
    }
}

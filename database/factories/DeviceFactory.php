<?php

namespace Database\Factories;

use App\Models\Device;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Ramsey\Uuid\Type\Integer;

class DeviceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Device::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uid' => Str::random(10),
            'client_token' => Str::random(10),
            'app_id' => $this->faker->numberBetween(1, 10),
            'operating_system_id' => $this->faker->numberBetween(1, 2),
            'language' => Str::random(3),
            'subscription_status' => $this->faker->numberBetween(1, 3),
            'receipt' => $this->faker->randomNumber(5),
            'expire_date' => Carbon::today()->subDays(rand(0, 30))
        ];
    }
}

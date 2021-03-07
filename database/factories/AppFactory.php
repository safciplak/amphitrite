<?php

namespace Database\Factories;

use App\Models\App;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = App::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'callback_url' => $this->selectUrl(),
        ];
    }

    /**
     * Select Url.
     *
     * @return string
     */
    private function selectUrl()
    {
        $websites = ['https://www.google.com', 'https://www.goygoy.us'];
        $randomNumber = rand(0, 1);
        return $websites[$randomNumber];
    }
}

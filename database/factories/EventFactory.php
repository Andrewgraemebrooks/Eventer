<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'name' => $this->faker->company,
            'description' => $this->faker->catchPhrase,
            'date' => $this->faker->date('Y-m-d'),
            'time' => $this->faker->time('H:i:s'),
            'duration' => $this->faker->time('H:i'),
            'venue' => $this->faker->streetAddress,
        ];
    }
}

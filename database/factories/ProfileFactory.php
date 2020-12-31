<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'bio' => $this->faker->realText(100),
            'status_text' => $this->faker->realText(15),
            'status_emoji' => $this->faker->emoji(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Mews\Purifier\Facades\Purifier;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = Carbon::parse($this->faker->dateTimeThisMonth());

        return [
            'user_id' => User::factory(),
            'title' => $this->faker->realText(50),
            'description' => $this->faker->realText(100),
            'body' => Purifier::clean($this->faker->randomHtml()),
            'thumbnail' => 'https://loremflickr.com/1024/768/technology?lock=' . $this->faker->numberBetween($min = 0, $max = 10000),
            'views' => $this->faker->numberBetween($min = 0, $max = 100000),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}

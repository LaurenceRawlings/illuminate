<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence($nbWords = 10, $variableNbWords = true),
            'description' => $this->faker->sentence($nbWords = 15, $variableNbWords = true),
            'body' =>  $this->faker->paragraph($nbSentences = 10, $variableNbSentences = true),
            'thumbnail' => $this->faker->imageUrl($width = 640, $height = 480),
            'views' => $this->faker->numberBetween($min = 0, $max = 10000),
        ];
    }
}

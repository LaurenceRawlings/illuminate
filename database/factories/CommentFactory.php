<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = Carbon::parse($this->faker->dateTimeThisMonth());

        return [
            'post_id' => Post::inRandomOrder()->first()->id,
            'user_id' => User::factory(),
            'comment' => $this->faker->realText(50),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}

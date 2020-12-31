<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Model;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Like::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $likeableType = $this->faker->randomElement(array(Post::class, Comment::class));
        $likeableId = 0;

        if ($likeableType == Post::class) {
            $likeableId = Post::query()->inRandomOrder()->first()->id;
        }
        else if ($likeableType == Comment::class) {
            $likeableId = Comment::query()->inRandomOrder()->first()->id;
        }

        return [
            'user_id' => User::factory(),
            'likeable_id' => $likeableId,
            'likeable_type' => $likeableType,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AuthorFactory extends Factory
{
    protected $model = Author::class;

    public function definition(): array
    {
      return [
        'name' => $this->faker->name(),
        'email' => $this->faker->unique()->safeEmail(),
        'bio' => $this->faker->realTextBetween(),
        'image' => $this->faker->imageUrl(),
        'github_handle' => $this->faker->userName(),
        'twitter_handle' => $this->faker->userName(),
        'created_at' => $this->faker->dateTimeBetween('-1 year', '-3 month'),
        'updated_at' => $this->faker->dateTimeBetween('-2 month', 'now'),
    ];
    }

    public function withImage(): static
    {
        return $this->state([
            'image' => 'authors/' . Str::uuid() . '.jpg',
        ]);
    }
}

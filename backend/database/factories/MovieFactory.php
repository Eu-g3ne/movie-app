<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    return [
      'title' => $this->faker->sentence(3, true),
      'slug' => $this->faker->slug(3, true),
      'episode' => $this->faker->numberBetween(0, 60),
      'total_episodes' => 60,
      'status' => $this->faker->randomElement(['desired', 'finished', 'ongoing']),
      'type' => $this->faker->randomElement(['anime', 'film', 'serial']),
      'rating' => $this->faker->numberBetween(0, 10),
      'is_favorite' => $this->faker->boolean,
    ];
  }

  public function configure()
  {
    return $this->afterCreating(function (Movie $movie) {
      $movie->slug = Str::slug($movie->title);
      $movie->save();
    });
  }
}

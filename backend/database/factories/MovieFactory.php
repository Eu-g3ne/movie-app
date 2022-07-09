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

  public function suspended()
  {
    return $this->state(fn (array $attributes) => [
      'description' => 'С давних времён человечество ведёт борьбу с титанами — огромными существами, которые не обладают особым интеллектом, зато едят людей и получают от этого удовольствие. После продолжительной борьбы остатки человечества построили высокую стену, окружившую страну людей, через которую титаны пройти не могут. С тех пор прошло сто лет, люди мирно живут под защитой стены. Но однажды подросток Эрен и его приёмная сестра Микаса становятся свидетелями страшного события — участок стены разрушается супер-титаном, появившемся прямо из воздуха. Титаны нападают на город, и дети в ужасе видят, как один из монстров заживо съедает их мать. Брат с сестрой выживают, и Эрен клянётся, что убьёт всех титанов и отомстит за человечество!'
    ]);
  }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    $i = rand(1, 5);
    return [
      'poster' => 'images/img/ps' . $i . '.jpg',
      'background' => 'images/img/bg' . $i . '.jpg',
    ];
  }
}

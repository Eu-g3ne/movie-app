<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    for ($i = 0; $i < 10; $i++) {
      Category::factory()->has(Movie::factory()->hasImage()->count(rand(2, 4)))->create();
    }
  }
}

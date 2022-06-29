<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Movie;

class MovieService
{
  protected Movie $movie;
  protected Category $category;

  public function __construct(Movie $movie = null, Category $category = null)
  {
    $this->movie = $movie;
    $this->category = $category;
  }

  public function syncCategories(Movie $movie, array $categories)
  {
    $categoriesIds = [];

    foreach ($categories as $category) {
      $categoriesIds[] = $this->category->firstOrCreate(['name' => $category])->id;
    }
    $movie->categories()->sync($categoriesIds);
  }
}

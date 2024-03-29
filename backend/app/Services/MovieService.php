<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieService
{
  protected Movie $movie;
  protected Category $category;
  protected $background;
  protected $poster;
  protected $filename;

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

  public function imagesInit(Movie $movie, Request $request)
  {
    $this->filename = str_replace("-", "", $movie->slug);
    $this->background = $request->file('image.background');
    $this->poster = $request->file('image.poster');
  }

  public function updateImages(Movie $movie, Request $request)
  {
    $this->imagesInit($movie, $request);
    if ($request->hasFile('image.background' && Storage::delete($movie->image->background))) {
      $movie->image->background = $this->background->store('images');
    }
    if ($request->hasFile('image.poster') && Storage::delete($movie->image->poster)) {
      $movie->image->poster = $this->poster->store('images');
    }
    $movie->image->save();
  }

  public function storeImages(Movie $movie, Request $request)
  {
    $this->imagesInit($movie, $request);
    $movie->image()->create(['poster' => '', 'background' => '']);
    if ($request->hasFile('image.background')) {
      $movie->image->background = $this->background->store('images');
    }
    if ($request->hasFile('image.poster')) {
      $movie->image->poster = $this->poster->store('images');
    }
    $movie->image->save();
  }

  public function findMovie(Movie $movie)
  {
    return Movie::where('user_id', auth()->user()->id)->findOrFail($movie->id);
  }
}

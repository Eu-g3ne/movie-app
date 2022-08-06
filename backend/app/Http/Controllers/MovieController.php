<?php

namespace App\Http\Controllers;

use App\Http\Requests\Movie\StoreRequest;
use App\Http\Requests\Movie\UpdateRequest;
use App\Http\Resources\MovieCollection;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Services\MovieService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class MovieController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  protected Movie $movie;
  protected MovieService $movieService;

  public function __construct(Movie $movie, MovieService $movieService)
  {
    $this->movie = $movie;
    $this->movieService = $movieService;
  }
  public function index()
  {
    try {
      $movies = cache()->remember('movies', now()->addMinutes(30), function () {
        return auth()->user()->movies;
      });
      return new MovieCollection($movies);
    } catch (Throwable $e) {
      report($e);
      return response()->json(['message' => $e], 500);
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreRequest $request)
  {
    try {

      $this->movie = auth()->user()->movies()->create($request->validated());

      $this->movieService->storeImages($this->movie, $request);

      $this->movieService->syncCategories($this->movie, $request->validated()['categories'] ?? []);
      cache()->forget('movies');
      return $this->movieResponse($this->movie);
    } catch (Throwable $e) {
      report($e);
      return response()->json(['message' => $e], 500);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  Movie  $movie
   * @return \Illuminate\Http\Response
   */
  public function show(Movie $movie)
  {
    $this->movie = $this->movieService->findMovie($movie);
    return new MovieResource($this->movie);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateRequest $request, Movie $movie)
  {
    $this->movie = $this->movieService->findMovie($movie);
    $this->movie->update($request->validated());
    $this->movieService->updateImages($this->movie, $request);
    if (isset($request->validated()['categories'])) {
      $this->movieService->syncCategories($this->movie, $request->validated()['categories'][0] !== null ? $request->validated()['categories'] : []);
    }
    cache()->forget('movies');
    return new MovieResource($this->movieResponse($this->movie));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Movie $movie)
  {
    try {
      $this->movie = $this->movieService->findMovie($movie);
      $slash = strripos($this->movie->image->poster, '/'); // REMOVE THIS IN PROD
      $poster = $this->movie->image->poster; // REMOVE THIS IN PROD
      if (mb_substr($poster, 0, $slash) !== 'images/img') { // REMOVE THIS IN PROD
        Storage::delete([$this->movie->image->background, $this->movie->image->poster]);
      }
      $this->movie->delete();
      cache()->forget('movies');
    } catch (Throwable $e) {
      report($e);
      return response()->json(['message' => $e], 500);
    }
  }
  public function movieResponse(Movie $movie)
  {
    return new MovieResource($movie->load('categories', 'image'));
  }
}

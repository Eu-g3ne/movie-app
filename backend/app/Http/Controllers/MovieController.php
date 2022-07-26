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
        return $this->movie->with(['categories', 'image'])->get();
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

      $movie = Movie::create($request->validated());

      $this->movieService->storeImages($movie, $request);

      $this->movieService->syncCategories($movie, $request->validated()['categories'] ?? []);
      return $this->movieResponse($movie);
    } catch (Throwable $e) {
      report($e);
      return response()->json(['message' => $e], 500);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Movie $movie)
  {
    return new MovieResource($movie);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateRequest $request, Movie $movie)
  {
    $movie->update($request->validated());
    $this->movieService->updateImages($movie, $request);
    // dump($request->validated()['categories']);
    // dump(isset($request->validated()['categories']));
    // dd($request->validated()['categories'][0] === null);
    if (isset($request->validated()['categories'])) {
      $this->movieService->syncCategories($movie, $request->validated()['categories'][0] !== null ? $request->validated()['categories'] : []);
    }


    return new MovieResource($movie->load('categories', 'image'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Movie $movie)
  {
    //
    $movie->delete();
  }
  public function movieResponse(Movie $movie)
  {
    return new MovieResource($movie->load('categories', 'image'));
  }
}

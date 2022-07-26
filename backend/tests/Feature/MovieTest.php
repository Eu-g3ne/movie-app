<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

use function PHPSTORM_META\map;

class MovieTest extends TestCase
{

  use RefreshDatabase;
  /**
   * A basic feature test example.
   *
   * @return void
   */


  public $description = 'С давних времён человечество ведёт борьбу с титанами — огромными существами';
  protected $response;
  public function test_movie_post_request()
  {
    $this->addMovie();
    $this->response->assertStatus(201)->assertJson([
      'slug' => 'attack-on-the-titan',
      'title' => 'Attack On The Titan',
      'description' => $this->description,
      'episode' => 5,
      'total_episodes' => 48,
      'status' => 'finished',
      'type' => 'anime',
      'rating' => 9,
      'is_favorite' => true,
      'image' => [
        'poster' => 'images/poster-attackonthetitan.jpg',
        'background' => 'images/background-attackonthetitan.jpg'
      ],
      'categories' => ['сёнен', 'эпик', 'боевик']
    ]);
    Storage::assertExists('images/background-attackonthetitan.jpg');
    Storage::assertExists('images/poster-attackonthetitan.jpg');
  }

  public function test_movies_get_all_request()
  {
    $response = $this->getJson('/movies');
    $response->assertStatus(200);
  }

  public function test_movie_by_slug_request()
  {
    $this->addMovie();
    $response = $this->getJson('/movies/attack-on-the-titan');
    $response->assertStatus(200)->assertJson([
      'title' => 'Attack On The Titan',
      'description' => $this->description,
      'episode' => 5,
      'total_episodes' => 48,
      'status' => 'finished',
      'type' => 'anime',
      'rating' => 9,
      'is_favorite' => true,
      'image' => [
        'poster' => 'images/poster-attackonthetitan.jpg',
        'background' => 'images/background-attackonthetitan.jpg'
      ],
      'categories' => ['сёнен', 'эпик', 'боевик']
    ]);
  }

  public function test_movie_update_request()
  {
    $this->addMovie();

    Storage::fake();
    $poster = UploadedFile::fake()->image('poster.jpg');
    $background = UploadedFile::fake()->image('background.jpg');

    $this->response = $this->putJson('/movies/attack-on-the-titan', [
      'title' => 'Death Note',
      'rating' => 8,
      'image' => [
        'poster' => $poster,
        'background' => $background
      ]
    ]);

    $this->response->assertStatus(200)->assertJson([
      'slug' => 'death-note',
      'title' => 'Death Note',
      'description' => $this->description,
      'episode' => 5,
      'total_episodes' => 48,
      'status' => 'finished',
      'type' => 'anime',
      'rating' => 8,
      'is_favorite' => true,
      'image' => [
        'poster' => 'images/poster-deathnote.jpg',
        'background' => 'images/background-deathnote.jpg'
      ],
      'categories' => ['сёнен', 'эпик', 'боевик']
    ]);

    Storage::assertExists('images/background-deathnote.jpg');
    Storage::assertExists('images/poster-deathnote.jpg');
    Storage::assertMissing('images/background-attackonthetitan.jpg');
    Storage::assertMissing('images/poster-attackonthetitan.jpg');
  }

  public function addMovie()
  {
    Storage::fake();
    $poster = UploadedFile::fake()->image('poster.jpg');
    $background = UploadedFile::fake()->image('background.jpg');

    $this->response = $this->postJson('/movies', [
      'title' => 'Attack On The Titan',
      'description' => $this->description,
      'episode' => 5,
      'total_episodes' => 48,
      'status' => 'finished',
      'type' => 'anime',
      'rating' => 9,
      'is_favorite' => true,
      'image' => [
        'poster' => $poster,
        'background' => $background
      ],
      'categories' => ['сёнен', 'эпик', 'боевик']
    ]);
  }
}

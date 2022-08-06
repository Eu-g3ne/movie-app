<?php

namespace Tests\Feature;

use App\Models\User;
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
  protected $user;
  protected $poster;
  protected $background;
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
      'categories' => ['сёнен', 'эпик', 'боевик']
    ]);
  }

  public function test_movies_get_all_request()
  {
    $this->createUser();
    $response = $this->actingAs($this->user)->getJson('/movies');
    $response->assertStatus(200);
  }

  public function test_movie_by_slug_request()
  {
    $this->addMovie();
    $response = $this->actingAs($this->user)->getJson('/movies/attack-on-the-titan');
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
        'poster' => 'images/' . $this->poster->hashName(),
        'background' => 'images/' . $this->background->hashName()
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

    $this->response = $this->actingAs($this->user)->putJson('/movies/attack-on-the-titan', [
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
        'poster' => 'images/' . $poster->hashName(),
        'background' => 'images/' . $background->hashName()
      ],
      'categories' => ['сёнен', 'эпик', 'боевик']
    ]);
  }

  public function test_movie_remove_request()
  {
    $this->addMovie();

    $this->response = $this->actingAs($this->user)->deleteJson('/movies/attack-on-the-titan');

    $this->response->assertStatus(200);

    Storage::assertMissing('/images/poster.jpg');
    Storage::assertMissing('/images/background.jpg');
  }

  public function addMovie()
  {
    $this->createUser();
    Storage::fake();
    $this->poster = UploadedFile::fake()->image('poster.jpg');
    $this->background = UploadedFile::fake()->image('background.jpg');
    $this->response = $this->actingAs($this->user)->postJson('/movies', [
      'title' => 'Attack On The Titan',
      'description' => $this->description,
      'episode' => 5,
      'total_episodes' => 48,
      'status' => 'finished',
      'type' => 'anime',
      'rating' => 9,
      'is_favorite' => true,
      'image' => [
        'poster' => $this->poster,
        'background' => $this->background
      ],
      'categories' => ['сёнен', 'эпик', 'боевик']
    ]);
  }

  public function createUser()
  {
    /**
     * @var mixed $user
     */
    $this->user =  User::factory()->create();
  }
}

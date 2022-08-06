<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
  /**
   * A basic feature test example.
   *
   * @return void
   */



  public function test_categories_get_all_request()
  {
    $user =  User::factory()->create();
    $response = $this->actingAs($user)->getJson('/categories');
    $response->assertStatus(200);
  }
}

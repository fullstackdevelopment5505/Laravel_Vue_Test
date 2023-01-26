<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class PostTest extends TestCase
{
    public function testRequiredFieldsForGetPost() {
        $user = User::factory()->create();
        $this->actingAs($user, 'api')->json('GET', 'api/post', ['Accept' => 'application/json'])
        ->assertStatus(422)
        ->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "page" => ["The page field is required."]
            ]
        ]);
    }

    public function testSuccessfulForGetPost() {
        $user = User::factory()->create();
        $this->actingAs($user, 'api')->json('GET', 'api/post/?page=1', ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            "data" => []
        ]);
    }

    public function testRequiredFieldsForStorePost() {
        $user = User::factory()->create();
        $this->actingAs($user, 'api')->json('POST', 'api/post/', ['Accept' => 'application/json'])
        ->assertStatus(422)
        ->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "title" => ["The title field is required."],
                "description" => ["The description field is required."]
            ]
        ]);
    }

    public function testSuccessfulForStorePost() {
        $user = User::factory()->create();
        $postData = [
            "title" => "Hello world",
            "description" => "Test Example Post",
        ];

        $this->actingAs($user, 'api')->json('POST', 'api/post/',  $postData, ['Accept' => 'application/json'])
        ->assertStatus(201)
        ->assertJson([
            "message" => "Post created",
            "data" => []
        ]);
    }
}

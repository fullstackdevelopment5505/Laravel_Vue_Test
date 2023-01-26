<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class PostResponseTest extends TestCase
{
    public function testSuccessfulForGetPostResponse() {
        $user = User::factory()->create();
        $this->actingAs($user, 'api')->json('GET', 'api/response/1', ['Accept' => 'application/json'])
        ->assertStatus(200)
        ->assertJson([
            "data" => []
        ]);
    }

    public function testRequiredFieldsForStorePostResponse() {
        $user = User::factory()->create();
        $this->actingAs($user, 'api')->json('POST', 'api/response/1', ['Accept' => 'application/json'])
        ->assertStatus(422)
        ->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "description" => ["The description field is required."]
            ]
        ]);
    }

    public function testSuccessfulForStorePostResponse() {
        $user = User::factory()->create();
        $postData = [
            "description" => "Test Example Post Response",
        ];

        $this->actingAs($user, 'api')->json('POST', 'api/response/1',  $postData, ['Accept' => 'application/json'])
        ->assertStatus(201)
        ->assertJson([
            "message" => "PostResponse created",
            "data" => []
        ]);
    }
}

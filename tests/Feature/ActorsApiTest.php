<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\WithFaker;
use phpDocumentor\Reflection\Types\Void_;
use Tests\Feature\ApiTestCase;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ActorsApiTest extends ApiTestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        print_r("ACTORS API TEST CASE");
        DB::table('actors')->insert([
            'name' => "Charles Santoss",
            'bio' => 'Nascido no Rio de janeiro',
            'born_at' => '1991-05-28',
        ]);
    }

    /**
     *Testing get Actors list from GET /api/actors route
     *
     * @return void
     */
    public function testGetActorsRequest()
    {
        $response = $this->get('/api/actors');
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [],
                'links' => [
                    "first" => "http://localhost/api/actors?page=1",
                    "last" => "http://localhost/api/actors?page=1",
                    "prev" => null,
                    "next" => null
                ],
                'meta' => []
            ]);
    }

    /**
     *Testing get Actors list from GET /api/actors route
     *
     * @return void
     */
    public function testGetActorRequest()
    {
        $response = $this->get('/api/actors/1');
        $response
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => 1,
                    'name' => 'Charles Santoss',
                    'bio' => 'Nascido no Rio de janeiro',
                    'born_at' => '1991-05-28',
                    "created_at" => '',
                    "updated_at" => ''
                ]
            ]);
    }


    /**
     *Testing save a actor from POST /api/actors route
     *
     * @return void
     */
    public function  testPostActorsRequest()
    {
        $response = $this->json(
            'POST',
            '/api/actors',
            [
                'name' => 'Ana Maria',
                'bio' => 'Nascida no Rio de janeiro',
                'born_at' => '1991-05-28',
            ]
        );
        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'bio',
                    'born_at',
                    'updated_at',
                    'created_at',
                    'id'
                ],
            ]);
    }


    /**
     *Testing UPDATE a actor from PUT /api/actors route
     *
     * @return void
     */
    public function  testPutActorsRequest()
    {
        $response = $this->json(
            'PUT',
            '/api/actors/1',
            [
                'name' => 'Ana MariaAA',
                'bio' => 'Nascida no Rio de janeiro',
                'born_at' => '1991-05-28',
            ]
        );
        $response
            ->dump()
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'name',
                    'bio',
                    'born_at',
                    'updated_at',
                    'created_at',
                    'id'
                ],
            ]);
    }

    /**
     *Testing DELETE a actor from DELETE /api/actors route
     *
     * @return void
     */
    public function  testDeleteActorRequest()
    {
        $response = $this->json(
            'DELETE',
            '/api/actors/1'
        );
        $response
            ->dump()
            ->assertStatus(200)
            ->assertJson([
                'message' => "Actor Charles Santoss was deleted successfully"
            ]);
    }
}

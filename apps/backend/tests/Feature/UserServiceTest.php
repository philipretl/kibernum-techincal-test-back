<?php

namespace Tests\Feature;

use App\Contracts\UsersService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{

    use WithFaker;

    protected string $url = '/api/v1/users';

    protected UsersServiceHandler $users_service;

    public function setUp():void{
        parent::setUp();

        /**
         * Dependency Injection
         */
        $this->users_service = $this->app->make(UsersService::class);
    }

    /**
     * @test
     */

    public function it_checks_the_list_users_endpoint(){

        $response = $this->withHeaders([
            'Accept' =>  'application/json'
        ])->json('GET', $this->url.'/list');

        $response->assertStatus(200)
            ->assertJson([
                'success'=> true,
                'description' => 'Empty list of users in kibernum technical test.',
                'errors' => [],
                'data' => [],
                'messages' => [
                    [
                        'message_code' => 'EMPTY_LIST',
                        'message' =>  'Empty model list solicited.'
                    ]
                ]

            ]);
    }
}

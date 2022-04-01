<?php

namespace Tests\Feature;

use App\Contracts\ExternalServices\UsersServiceHandler;
use App\Contracts\UsersService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServiceTest extends TestCase
{

    use WithFaker;

    protected string $url = '/api/v1/users';

    protected UsersService $users_service;

    public function setUp(): void
    {
        parent::setUp();

        /**
         * Dependency Injection
         */
        $this->users_service = $this->app->make(UsersService::class);
    }

    /**
     * @test
     */
    public function it_checks_the_list_users_endpoint_when_is_empty()
    {
        $mock_users_service_handler = \Mockery::mock(
            UsersServiceHandler::class
        )->makePartial();

        $mock_users_service_handler->shouldReceive('getListFromExternalService')
            ->andReturn([]);

        $this->app->instance(UsersServiceHandler::class, $mock_users_service_handler);

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->json('GET', $this->url . '/list');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'description' => 'Empty list of users in kibernum technical test.',
                'errors' => [],
                'data' => [],
                'messages' => [
                    [
                        'message_code' => 'EMPTY_LIST',
                        'message' => 'Empty model list solicited.'
                    ]
                ]

            ]);
    }

    /**
     * @test
     */
    public function it_checks_the_list_users_endpoint_when_it_is_not_empty()
    {

        $mock_users_service_handler = \Mockery::mock(
            UsersServiceHandler::class
        )->makePartial();

        $users_list = [
            [
                'id' => 1,
                'name' => $this->faker->name(),
                'avatar' => $this->faker->imageUrl(
                    360,
                    360,
                    'avatar',
                    true,
                    'profile picture'
                ),
                'createdAt' => $this->faker->date('Y-m-d')
            ],
            [
                'id' => 2,
                'name' => $this->faker->name(),
                'avatar' => $this->faker->imageUrl(
                    360,

                    360,
                    'avatar',
                    true,
                    'profile picture'
                ),
                'createdAt' => $this->faker->date('Y-m-d')
            ],
        ];

        $mock_users_service_handler->shouldReceive('getListFromExternalService')
            ->andReturn(json_decode(json_encode($users_list)));

        $this->app->instance(UsersServiceHandler::class, $mock_users_service_handler);

        $response = $this->withHeaders([
            'Accept' => 'application/json'
        ])->json('GET', $this->url . '/list');

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'description' => 'List of users in kibernum technical test.',
                'errors' => [],
                'data' => [
                    'users' => [
                        [
                            'id' => $users_list[0]['id'],
                            'name' => $users_list[0]['name'],
                            'avatar' => $users_list[0]['avatar'],
                            'created_at' => $users_list[0]['createdAt']

                        ],
                        [
                            'id' => $users_list[1]['id'],
                            'name' => $users_list[1]['name'],
                            'avatar' => $users_list[1]['avatar'],
                            'created_at' => $users_list[1]['createdAt']
                        ],

                    ]
                ],
                'messages' => [
                    [
                        'message_code' => 'SIMPLE_LIST',
                        'message' => 'Simple data list.'
                    ]
                ]

            ]);
    }
}

<?php

namespace Tests\Feature;

use App\Contracts\ExternalServices\UsersServiceHandler;
use App\Contracts\UsersService;
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

    /**
     * @test
     */
    public function it_checks_when_the_fields_required_is_not_present()
    {

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json(
            'POST',
            $this->url . '/register',
            []
        );

        $response->assertStatus(400)
            ->assertJson([
                'success' => false,
                'description' => 'Exist conflict with the request, please check the errors or messages.',
                'data' => [],
                'errors' => [
                    [
                        'error_code' => 'REQUIRED',
                        'field' => 'name',
                        'message' => 'The name field is required.',
                    ],
                    [
                        'error_code' => 'REQUIRED',
                        'field' => 'avatar',
                        'message' => 'The avatar field is required.',
                    ],
                ],
                'messages' => [
                    [
                        'message_code' => 'CHECK_DATA',
                        'message' => 'The form has errors whit the inputs.',
                    ],
                ],

            ]);
    }

    /**
     * @test
     */
    public function it_checks_when_the_field_is_not_a_valid_url()
    {

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json(
            'POST',
            $this->url . '/register',
            [
                'name' => $this->faker->name(),
                'avatar' => 'it_is_not_valid_url',
            ]
        );

        $response->assertStatus(400)
            ->assertJson([
                'success' => false,
                'description' => 'Exist conflict with the request, please check the errors or messages.',
                'data' => [],
                'errors' => [
                    [
                        'error_code' => 'URL',
                        'field' => 'avatar',
                        'message' => 'The avatar format is invalid.',
                    ],
                ],
                'messages' => [
                    [
                        'message_code' => 'CHECK_DATA',
                        'message' => 'The form has errors whit the inputs.',
                    ],
                ],

            ]);
    }

    /**
     * @test
     */
    public function it_checks_when_the_field_name_does_not_have_a_size_max_50()
    {

        $response = $this->withHeaders([
            'Accept' => 'application/json',
        ])->json(
            'POST',
            $this->url . '/register',
            [
                'name' => $this->faker->text(),
                'avatar' => $this->faker->imageUrl(
                    360,
                    360,
                    'avatar',
                    true,
                    'profile picture'
                )
            ]
        );

        $response->assertStatus(400)
            ->assertJson([
                'success' => false,
                'description' => 'Exist conflict with the request, please check the errors or messages.',
                'data' => [],
                'errors' => [
                    [
                        'error_code' => 'MAX_STRING',
                        'field' => 'name',
                        'message' => 'The name may not be greater than 50 characters.',
                    ],
                ],
                'messages' => [
                    [
                        'message_code' => 'CHECK_DATA',
                        'message' => 'The form has errors whit the inputs.',
                    ],
                ],

            ]);
    }
}

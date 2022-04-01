<?php

namespace Tests\Feature\Integration;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Contracts\ExternalServices\UsersServiceHandler;

class UsersServiceHandlerTest extends TestCase
{
    use WithFaker;

    protected UsersServiceHandler $users_service_handler;

    public function setUp(): void
    {
        parent::setUp();

        /**
         * Dependency Injection
         */
        $this->users_service_handler = $this->app->make(UsersServiceHandler::class);
    }

    /**
     * @test
     */
    public function it_checks_the_list_users_method()
    {
        $users_list = $this->users_service_handler->getListFromExternalService();

        if (count($users_list) !== 0) {
            $this->assertInstanceOf(\stdClass::class, $users_list[0]);
            $this->assertObjectHasAttribute('id', $users_list[0]);
            $this->assertObjectHasAttribute('name', $users_list[0]);
            $this->assertObjectHasAttribute('createdAt', $users_list[0]);
            $this->assertObjectHasAttribute('avatar', $users_list[0]);
        }

        $this->assertIsArray($users_list);
    }

    /**
     * @test
     */

    public function it_checks_when_save_the_user_in_the_external_service()
    {

        $data = [
            'name' => $this->faker->name(),
            'avatar' => $this->faker->imageUrl(
                360,
                360,
                'avatar',
                true,
                'profile picture'
            )
        ];

        $user_data = $this->users_service_handler->saveUserInExternalService($data);

        $this->assertInstanceOf(\stdClass::class, $user_data);
        $this->assertObjectHasAttribute('id', $user_data);
        $this->assertObjectHasAttribute('name', $user_data);
        $this->assertObjectHasAttribute('createdAt', $user_data);
        $this->assertObjectHasAttribute('avatar', $user_data);
    }
}

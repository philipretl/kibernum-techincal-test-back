<?php

namespace Tests\Feature\Integration;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use App\Contracts\ExternalServices\UsersServiceHandler;

class UsersServiceHandlerTest extends TestCase
{
    protected $url = '/api/v1/owner/register';
    protected UsersServiceHandler $users_service_handler;

    public function setUp():void{
        parent::setUp();
        $this->users_service_handler = $this->app->make(UsersServiceHandler::class);
    }

    /**
     * @test
     */
    public function it_checks_the_list_users_method()
    {

        $this->assertTrue();
    }
}

<?php

namespace App\Services\ExternalServices;

use App\Contracts\ExternalServices\UsersServiceHandler;
use App\Services\ExternalServices\Instances\User;
use Illuminate\Support\Facades\Http;
use stdClass;


class UsersServiceHandlerImpl implements UsersServiceHandler{

    private string $save_url;
    private string $list_url;

    public function __construct(){
        $this->list_url = config('users_api_services.base_url') . config('users_api_services.list_users_url');
        $this->save_url = config('users_api_services.base_url') . config('users_api_services.save_user_url');
    }

    public function getListFromExternalService():array
    {
        $response = Http::get($this->list_url);
        return json_decode($response->body());
    }

    public function saveUserInExternalService(array $data):stdClass
    {
        $response = Http::post($this->save_url, $data);
        return json_decode($response->body());
    }
}

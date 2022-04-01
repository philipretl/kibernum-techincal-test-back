<?php

namespace App\Services;

use App\Contracts\ExternalServices\UsersServiceHandler;
use App\Contracts\UsersService;
use App\Services\ExternalServices\Instances\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UsersServiceImpl implements UsersService{

    private UsersServiceHandler $users_service_handler;

    public function __construct(UsersServiceHandler $users_service_handler){
        $this->users_service_handler = $users_service_handler;
    }

    public function saveUser(array $data): User
    {
        $data = $this->users_service_handler->saveUserInExternalService($data);
        $user = new User;

        return $user;
    }

    public function listUsers(): Collection
    {
        $users_list = [];
        $users_list_unmapped = $this->users_service_handler->getListFromExternalService();

        foreach ($users_list_unmapped as $user_unmapped){
            array_push($users_list, new User(
                $user_unmapped->name,
                $user_unmapped->createdAt,
                $user_unmapped->id,
                $user_unmapped->avatar
            ));
        }
        return collect($users_list);
    }
}

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

        return new User(
            $data->id,
            $data->name,
            $data->avatar,
            $data->createdAt
        );
    }

    public function listUsers(): Collection
    {
        $users_list = [];
        $users_list_unmapped = $this->users_service_handler->getListFromExternalService();

        foreach ($users_list_unmapped as $user_unmapped){
            $user = new User(
                $user_unmapped->id,
                $user_unmapped->name,
                $user_unmapped->avatar,
                $user_unmapped->createdAt
            );
            array_push($users_list, $user->jsonSerialize());
        }
        return collect($users_list);
    }
}

<?php

namespace App\Contracts;

use App\Services\ExternalServices\Instances\User;
use Illuminate\Support\Collection;

interface UsersService {

    public function saveUser(array $data):User;
    public function listUsers():Collection;
}

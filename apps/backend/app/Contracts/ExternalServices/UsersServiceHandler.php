<?php

namespace App\Contracts\ExternalServices;
use stdClass;

interface UsersServiceHandler {

    public function getListFromExternalService():array;
    public function saveUserInExternalService(array $data):stdClass;

}

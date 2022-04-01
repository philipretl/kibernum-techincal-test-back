<?php

namespace App\Contracts\ExternalServices;

interface UsersServiceHandler {

    public function getListFromExternalService();
    public function saveUserInExternalService($data);

}

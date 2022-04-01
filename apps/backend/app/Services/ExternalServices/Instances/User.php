<?php

namespace App\Services\ExternalServices\Instances;

class User
{


    public function __construct(
        private string $name,
        private String $created_at,
        private string $id,
        private string $avatar,
    ){}
}

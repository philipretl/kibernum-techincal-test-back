<?php

namespace App\Services\ExternalServices\Instances;

use Illuminate\Database\Eloquent\JsonEncodingException;

class User implements \JsonSerializable
{

    public function __construct(
        private string $id,
        private string $name,
        private string $avatar,
        private String $created_at,
    ){}

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}

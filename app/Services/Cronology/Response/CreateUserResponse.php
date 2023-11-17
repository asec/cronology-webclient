<?php

namespace App\Services\Cronology\Response;

use App\Services\Cronology\Entity\User;
use Exception;

class CreateUserResponse extends ApiResponse
{
    public User $result;

    /**
     * @throws Exception
     */
    protected function set(string $key, mixed $value): bool
    {
        if ($key === "result")
        {
            $this -> result = new User($value);
            return true;
        }

        return parent::set($key, $value);
    }
}

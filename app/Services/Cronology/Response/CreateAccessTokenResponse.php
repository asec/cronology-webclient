<?php

namespace App\Services\Cronology\Response;

use App\Services\Cronology\Entity\AccessToken;

class CreateAccessTokenResponse extends ApiResponse
{
    public AccessToken $result;

    /**
     * @throws \Exception
     */
    protected function set(string $key, mixed $value): bool
    {
        if ($key === "result")
        {
            $this->result = new AccessToken($value);
            return true;
        }

        return parent::set($key, $value);
    }
}

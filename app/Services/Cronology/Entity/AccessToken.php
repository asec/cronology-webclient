<?php

namespace App\Services\Cronology\Entity;

class AccessToken extends Entity
{
    public string $username;
    public string $accessToken;
    public \DateTime $accessTokenValid;
}

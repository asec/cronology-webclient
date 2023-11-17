<?php

namespace App\Services\Cronology\Entity;

class User extends Entity
{
    public string $id;
    public string $username;
    public bool $isAdmin;
    public string $accessToken;
    public \DateTime $accessTokenValid;
    public \DateTime $created;
    public \DateTime $updated;
}

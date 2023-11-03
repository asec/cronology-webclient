<?php

namespace App\Services\Cronology\Entity;

class App extends Entity
{
    public string $id;
    public string $name;
    public string $uuid;
    public array $ip;
    public \DateTime $created;
    public \DateTime $updated;
}

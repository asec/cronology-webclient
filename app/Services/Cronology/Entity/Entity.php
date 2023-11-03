<?php

namespace App\Services\Cronology\Entity;

use Exception;

class Entity
{
    /**
     * @throws Exception
     */
    public function __construct(array $rawData)
    {
        foreach ($rawData as $key => $value)
        {
            $this -> set($key, $value);
        }
    }

    /**
     * @throws Exception
     */
    protected function set(string $key, mixed $value): bool
    {
        if (!property_exists($this, $key))
        {
            return false;
        }

        if (in_array($key, ["created", "updated"]))
        {
            $value = new \DateTime($value);
        }

        $this -> $key = $value;

        return true;
    }
}

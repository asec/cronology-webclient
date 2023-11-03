<?php

namespace App\Services\Cronology\Response;

class ApiResponse
{
    public int $statusCode = 0;
    public bool $success = false;

    public function __construct(array $rawData, int $statusCode)
    {
        $this -> statusCode = $statusCode;
        foreach ($rawData as $key => $value)
        {
            $this -> set($key, $value);
        }
    }

    protected function set(string $key, mixed $value): bool
    {
        if (!property_exists($this, $key))
        {
            return false;
        }

        $this -> $key = $value;

        return true;
    }
}

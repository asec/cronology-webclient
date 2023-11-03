<?php

namespace App\Services\Cronology\Response;


use App\Services\Cronology\Entity\App;
use Exception;

class AppDataResponse extends ApiResponse
{
    public App $result;

    /**
     * @throws Exception
     */
    protected function set(string $key, mixed $value): bool
    {
        if ($key === "result")
        {
            $this -> result = new App($value);
            return true;
        }

        return parent::set($key, $value);
    }
}

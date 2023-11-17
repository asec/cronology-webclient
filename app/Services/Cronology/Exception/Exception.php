<?php

namespace App\Services\Cronology\Exception;

use App\Services\Cronology\Response\ApiError;

class Exception extends \Exception
{
    protected static string $displayMessage = "An unexpected error occurred while processing your request.";
    public function __construct(string|ApiError|\Throwable $message = "", int $code = 0, ?Throwable $previous = null)
    {
        if ($message instanceof ApiError)
        {
            $code = $message->statusCode;
            $message = env("APP_ENV") === "local" ? $message->error : static::$displayMessage;
        }
        else if ($message instanceof \Throwable)
        {
            $code = $message->getCode();
            $message = env("APP_ENV") === "local" ? $message->getMessage() : static::$displayMessage;
        }
        parent::__construct($message, $code, $previous);
    }
}

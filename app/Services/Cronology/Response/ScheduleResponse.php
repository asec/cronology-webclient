<?php

namespace App\Services\Cronology\Response;

class ScheduleResponse extends ApiResponse
{
    public \DateTime $now;
    /**
     * @var \DateTime[]
     */
    public array $next;

    protected function set(string $key, mixed $value): bool
    {
        if ($key === "now")
        {
            $this->now = new \DateTime($value);
            return true;
        }
        else if ($key === "next")
        {
            $this->next = [];
            foreach ($value as $v)
            {
                $this->next[] = new \DateTime($v);
            }
            return true;
        }

        return parent::set($key, $value);
    }
}

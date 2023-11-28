<?php

namespace App\Traits\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;

trait UsesCache
{
    protected string $cacheNamespace = "livewire:";
    protected string $cacheNamespaceActive = "";
    protected bool $cacheNamespaceInitialised = false;

    protected function cacheInitialiseNamespace(): void
    {
        if ($this->cacheNamespaceInitialised)
        {
            return;
        }

        /**
         * @type User $user
         */
        $user = auth()->user();
        if (isset($user))
        {
            $this->cacheNamespaceActive = "user:" . $user->id . ":" . $this->cacheNamespace . static::class . ":";
        }
        $this->cacheNamespaceInitialised = true;
    }

    protected function cacheChangeNamespace(string $namespace, $useClassName = true): void
    {
        $this->cacheNamespaceActive = $namespace . ":" . ($useClassName ? static::class . ":" : "");
        $this->cacheNamespaceInitialised = true;
    }

    protected function cacheGetKeyName(string $key): string
    {
        return $this->cacheNamespaceActive . $key;
    }

    protected function cacheSet(string $key, mixed $value, \DateInterval|int|null $ttl = null): bool
    {
        $this->cacheInitialiseNamespace();
        return Cache::store("redis")->set($this->cacheGetKeyName($key), $value, $ttl);
    }

    /**
     * @param string $key
     * @param \Closure|mixed|null $default
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected function cacheGet(string $key, mixed $default = null): mixed
    {
        $this->cacheInitialiseNamespace();
        return Cache::store("redis")->get($this->cacheGetKeyName($key), $default);
    }
}

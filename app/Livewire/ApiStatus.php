<?php

namespace App\Livewire;

use App\Services\Cronology\Api;
use App\Services\Cronology\Response\ApiError;
use App\Traits\Livewire\UsesCache;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ApiStatus extends Component
{
    use UsesCache;
    #[Locked]
    public bool $status;
    #[Locked]
    public string $version = "";

    public function placeholder(): View
    {
        $this->restoreCachedState();
        return view("livewire.api-status", [
            "status" => $this->status ?? null,
            "version" => $this->version
        ]);
    }

    protected function cacheState(): void
    {
        $this->cacheChangeNamespace("livewire");
        $this->cacheSet("status", $this->status);
        $this->cacheSet("version", $this->version);
    }

    protected function restoreCachedState(): void
    {
        $this->cacheChangeNamespace("livewire");
        $cachedStatus = $this->cacheGet("status");
        if (isset($cachedStatus))
        {
            $this->status = (bool) $cachedStatus;
        }
        $this->version = $this->cacheGet("version") ?? $this->version;
    }

    public function render(Api $api): View
    {
        $changed = false;
        $ping = $api->ping();
        if ($ping instanceof ApiError)
        {
            if (!isset($this->status) || $this->status)
            {
                $changed = true;
            }
            $this->reset();
            $this->status = false;
        }
        else
        {
            if (!isset($this->status) || !$this->status || $this->version !== $ping->version)
            {
                $changed = true;
            }
            $this->status = true;
            $this->version = $ping->version;
        }

        if ($changed)
        {
            $this->cacheState();
        }

        return view('livewire.api-status');
    }
}

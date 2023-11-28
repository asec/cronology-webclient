<?php

namespace App\Livewire;

use App\Models\User;
use App\Services\Cronology\Api;
use App\Services\Cronology\Exception\Exception;
use App\Services\Cronology\Response\ApiError;
use App\Traits\Livewire\UsesCache;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Schedule extends Component
{
    use UsesCache;
    public string $schedule = "now";
    public bool $showUtc = false;
    #[Locked]
    public \DateTime $now;
    #[Locked]
    public array $dates = [];

    public function updatedSchedule(): void
    {
        $this->cacheSet("schedule", $this->schedule);
    }

    public function mount(): void
    {
        $this->schedule = $this->cacheGet("schedule") ?? $this->schedule;

        $cachedShowUtc = $this->cacheGet("showUtc");
        $this->showUtc = isset($cachedShowUtc) ? (bool) $cachedShowUtc : $this->showUtc;
    }

    public function refresh(Api $api, Request $request): void
    {
        /**
         * @type User $user
         */
        $user = $request->user();
        if (!$this->schedule || !$user)
        {
            return;
        }

        $api->setAccessToken($user->cronology_access_token);
        $result = $api->schedule($this->schedule, 5);
        if ($result instanceof ApiError)
        {
            $this->reset("now", "dates");
            $this->addError("schedule", (new Exception($result))->getMessage());
            return;
        }
        $this->resetErrorBag();
        $this->now = $result->now;
        $this->dates = $result->next;
    }

    public function toggleUtc(): void
    {
        $this->showUtc = !$this->showUtc;
        $this->cacheSet("showUtc", $this->showUtc);
    }

    public function render(Api $api, Request $request): View
    {
        $this->refresh($api, $request);
        return view('livewire.schedule');
    }
}

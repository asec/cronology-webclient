<?php

namespace App\Livewire;

use App\Services\Cronology\Api;
use App\Services\Cronology\Response\ApiError;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

/**
 * @property Api $api
 */
class Ping extends Component
{
    public string $error;
    public string $version;
    #[Locked]
    public string $loadingText = "Pinging API...";

    #[Computed]
    protected function api(): Api
    {
        return App::get(Api::class);
    }

    /*public function mount(): void
    {
        $this->refresh();
    }*/

    public function refresh(): void
    {
        $this->reset();
        $result = $this->api->ping();
        if ($result instanceof ApiError)
        {
            $this->error = $result->error;
            return;
        }

        $this->version = $result->version;
    }

    public function placeholder(): View
    {
        return view("livewire.placeholders.default", [
            "text" => $this->loadingText
        ]);
    }

    public function render(): View
    {
        $this->refresh();
        return view("livewire.ping");
    }
}

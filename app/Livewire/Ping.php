<?php

namespace App\Livewire;

use App\Services\Cronology\Api;
use App\Services\Cronology\Response\ApiError;
use Illuminate\View\View;
use Livewire\Component;

class Ping extends Component
{
    public string $error;
    public string $version;

    public function mount(Api $api): void
    {
        $result = $api->ping();
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
            "text" => "Pinging API..."
        ]);
    }
}

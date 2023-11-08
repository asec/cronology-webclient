<?php

namespace App\Livewire;

use App\Services\Cronology\Api;
use App\Services\Cronology\Response\ApiError;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

/**
 * @property Api $api
 */
class AppData extends Component
{
    public string $error;
    public string $name;
    public string $uuid;
    public array $ip;
    public \DateTime $created;
    public \DateTime $updated;

    #[Computed]
    protected function api(): Api
    {
        return App::get(Api::class);
    }

    public function refresh(): void
    {
        $this->reset();
        $result = $this->api->getAppData();
        if ($result instanceof ApiError)
        {
            $this->error = $result->error;
            return;
        }

        $this->fill($result->result);
    }

    public function placeholder(): View
    {
        return view("livewire.placeholders.default", [
            "text" => "GET '/app/:uuid'"
        ]);
    }

    public function render(): View
    {
        $this->refresh();
        return view("livewire.app-data");
    }
}

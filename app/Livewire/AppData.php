<?php

namespace App\Livewire;

use App\Services\Cronology\Api;
use App\Services\Cronology\Response\ApiError;
use Carbon\Carbon;
use Illuminate\View\View;
use Livewire\Component;

class AppData extends Component
{
    public string $error;
    public string $name;
    public string $uuid;
    public array $ip;
    public string $created;
    public string $updated;

    protected function formatDate(\DateTime $dateTime): string
    {
        return Carbon::parse($dateTime)->setTimezone("Europe/Budapest")->format("Y-m-d H:i:s");
    }

    public function mount(Api $api): void
    {
        $result = $api->getAppData();
        if ($result instanceof ApiError)
        {
            $this->error = $result->error;
            return;
        }

        $this->name = $result->result->name;
        $this->uuid = $result->result->uuid;
        $this->ip = $result->result->ip;
        $this->created = $this->formatDate($result->result->created);
        $this->updated = $this->formatDate($result->result->updated);
    }

    public function placeholder(): View
    {
        return view("livewire.placeholders.default", [
            "text" => "GET '/app/:uuid'"
        ]);
    }
}

<?php

namespace App\Livewire\Forms\User;

use App\Models\User;
use App\Services\Cronology\Api;
use App\Services\Cronology\Exception\Exception;
use App\Services\Cronology\Response\ApiError;
use App\Services\Utils;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Component;

class ApiData extends Component
{
    #[Locked]
    public string $id = "";
    #[Locked]
    public string $accessToken = "";
    #[Locked]
    public string $accessTokenValid = "";
    #[Locked]
    public bool $isAccessTokenValid = false;

    protected function checkIfAccessTokenIsValid(): void
    {
        $date = Carbon::createFromFormat("Y-m-d H:i:s", $this->accessTokenValid, Utils::getUserTimezone());
        $this->isAccessTokenValid = $date >= now();
    }

    protected function setApiData(string $id, string $accessToken, Carbon|\DateTime $accessTokenValid, User $user = null)
    {
        $this->fill([
            "id" => $id,
            "accessToken" => $accessToken,
            "accessTokenValid" => Utils::formatDate($accessTokenValid)
        ]);
        $this->checkIfAccessTokenIsValid();
        if ($user)
        {
            $user->update([
                "cronology_id" => $id,
                "cronology_access_token" => $accessToken,
                "cronology_access_token_valid" => $accessTokenValid
            ]);
        }
    }

    public function mount(Request $request): void
    {
        /**
         * @type User $user
         */
        $user = $request->user("web");
        $this->setApiData(
            $user->cronology_id,
            $user->cronology_access_token,
            $user->cronology_access_token_valid
        );
    }

    /**
     * @throws ValidationException
     */
    public function save(Api $api, Request $request): void
    {
        $this->resetErrorBag();
        /**
         * @type User $user
         */
        $user = $request->user();
        $data = $api->getUserByUsername($user->email);
        if ($data instanceof ApiError)
        {
            throw ValidationException::withMessages([
                "id" => (new Exception($data))->getMessage()
            ]);
        }

        $this->setApiData(
            $data->result->id,
            $data->result->accessToken,
            $data->result->accessTokenValid,
            $user
        );
    }

    public function generateAccessToken(Api $api, Request $request): void
    {
        $this->resetErrorBag("accessToken");
        /**
         * @type User $user
         */
        $user = $request->user();
        $data = $api->createAccessToken($user->cronology_id);
        if ($data instanceof ApiError)
        {
            throw ValidationException::withMessages([
                "accessToken" => (new Exception($data))->getMessage()
            ]);
        }

        $this->setApiData(
            $this->id,
            $data->result->accessToken,
            $data->result->accessTokenValid,
            $user
        );
        $this->dispatch("access-token-generated");
    }

    public function render(): View
    {
        return view('livewire.forms.user.api-data');
    }
}

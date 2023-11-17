<?php

namespace App\Livewire\Forms\User;

use App\Models\User;
use App\Services\Cronology\Api;
use App\Services\Cronology\Response\ApiError;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Register extends Component
{
    #[Rule(["required", "string", "min:5", "max:100", "email", "lowercase", "unique:users,email"])]
    public string $email;
    #[Locked]
    public bool $isEmailSet = false;

    #[Rule(["required", "string", "min:12", "max:100", "regex:/[a-z]/u", "regex:/[A-Z]/u", "regex:/\d/", "regex:/\W/"])]
    public string $password;
    #[Locked]
    public bool $isPasswordSet = false;
    #[Rule(["required", "string", "same:password"])]
    public string $confirmPassword;
    #[Locked]
    public bool $isConfirmationSet = false;

    protected function messages(): array
    {
        return [
            "regex" => "The password must contain at least one lowercase character, one uppercase character, one number and one special character."
        ];
    }

    protected function prepareForValidation($attributes)
    {
        $attributes["email"] = Str::lower($attributes["email"]);
        return $attributes;
    }

    public function updatedEmail(Api $api): void
    {
        $this->email = Str::lower($this->email);
        $cronologyUser = $api->getUserByUsername($this->email);
        if (!($cronologyUser instanceof ApiError))
        {
            $this->isEmailSet = false;
            throw ValidationException::withMessages([
                "email" => "This user already exists."
            ]);
        }
        $this->isEmailSet = !isset($this->getErrorBag()->getMessages()["email"]);
        if (!$this->isEmailSet)
        {
            $this->reset(["password", "isPasswordSet", "confirmPassword", "isConfirmationSet"]);
        }
        $this->dispatch("email-updated");
    }

    public function updatedPassword(): void
    {
        $this->isPasswordSet = !isset($this->getErrorBag()->getMessages()["password"]);
        if (!$this->isPasswordSet)
        {
            $this->reset("confirmPassword", "isConfirmationSet");
        }
        $this->dispatch("password-updated");
    }

    public function updatedConfirmPassword(): void
    {
        $this->isConfirmationSet = !isset($this->getErrorBag()->getMessages()["confirmPassword"]);
    }

    public function save(Api $api): void
    {
        if (empty($this->email))
        {
            return;
        }
        else if (empty($this->password))
        {
            $this->resetValidation(["password", "confirmPassword"]);
            return;
        }
        else if (empty($this->confirmPassword))
        {
            $this->resetValidation("confirmPassword");
            return;
        }

        $validated = $this->validate();

        try
        {
            $response = $api->createUser($validated["email"]);
            if ($response instanceof ApiError)
            {
                if (!$response->statusCode)
                {
                    session()->flash("error", $response->error);
                }
                else
                {
                    $this->addError("email", $response->error);
                }
                return;
            }
            $user = new User([
                "email" => $validated["email"],
                "password" => Hash::make($validated["password"]),
                "cronology_id" => $response->result->id,
                "cronology_access_token" => $response->result->accessToken,
                "cronology_access_token_valid" => $response->result->accessTokenValid
            ]);

            $user->save();

            session()->flash("success", "The registration was successful, you may log in now.");
            $this->redirectRoute("home");
        }
        catch (\Exception $e)
        {
            session()->flash("error", $e->getMessage());
            $this->redirectRoute("user.register");
        }
    }

    public function render(): View
    {
        return view('livewire.forms.user.register');
    }
}

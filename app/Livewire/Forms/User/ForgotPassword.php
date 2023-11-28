<?php

namespace App\Livewire\Forms\User;

use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ForgotPassword extends Component
{
    #[Rule(["required", "string", "min:5", "max:100", "email", "lowercase"])]
    public string $email;
    protected string $message = "If the e-mail address was correct you should have recieved an e-mail with the"
        . " details on how to reset your password.";

    protected function prepareForValidation($attributes)
    {
        $attributes["email"] = Str::lower($attributes["email"]);
        return $attributes;
    }

    public function save(): void
    {
        $validated = $this->validate();
        $this->email = Str::lower($validated["email"]);

        $user = Password::getUser($this->only("email"));
        if (!$user)
        {
            $this->showResult();
            return;
        }

        $token = Password::createToken($user);
        $this->dispatch("save-success");
        $this->redirectRoute("user.reset-password", [
            $token,
            "email" => $this->email
        ]);
    }

    protected function showResult(): void
    {
        session()->flash("success", $this->message);
        $this->reset("email");
    }

    public function render(): View
    {
        return view('livewire.forms.user.forgot-password');
    }
}

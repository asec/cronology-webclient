<?php

namespace App\Livewire\Forms\User;

use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Component;

class Register extends Component
{
    #[Rule("required|min:5|max:100|email")]
    public string $email;
    #[Locked]
    public bool $isEmailSet = false;

    #[Rule(["required", "min:12", "max:100", "regex:/[a-z]/u", "regex:/[A-Z]/u", "regex:/\d/", "regex:/\W/"])]
    public string $password;
    #[Locked]
    public bool $isPasswordSet = false;
    #[Rule(["same:password"])]
    public string $confirmPassword;
    #[Locked]
    public bool $isConfirmationSet = false;

    protected function messages(): array
    {
        return [
            "regex" => "The password must contain at least one lowercase character, one uppercase character, one number and one special character."
        ];
    }

    public function updatedEmail(): void
    {
        $this->isEmailSet = !isset($this->getErrorBag()->getMessages()["email"]);
        if (!$this->isEmailSet)
        {
            $this->reset(["password", "isPasswordSet", "confirmPassword"]);
        }
        $this->dispatch("email-updated");
    }

    public function updatedPassword(): void
    {
        $this->isPasswordSet = !isset($this->getErrorBag()->getMessages()["password"]);
        if (!$this->isPasswordSet)
        {
            $this->reset("confirmPassword");
        }
        $this->dispatch("password-updated");
    }

    public function updatedConfirmPassword(): void
    {
        $this->isConfirmationSet = !isset($this->getErrorBag()->getMessages()["confirmPassword"]);
    }

    public function save(): void
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

        $this->validate();
        dd($this->email, $this->isEmailSet);
    }

    public function render(): View
    {
        return view('livewire.forms.user.register');
    }
}

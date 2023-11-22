<?php

namespace App\Livewire\Forms\User;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ResetPassword extends Component
{
    #[Locked]
    public string $token = "";
    #[Rule(["required", "string", "min:5", "max:100", "email", "lowercase"])]
    public string $email = "";
    #[Rule(["required", "string", "min:12", "max:100", "regex:/[a-z]/u", "regex:/[A-Z]/u", "regex:/\d/", "regex:/\W/"])]
    public string $password = "";
    #[Rule(["required", "string", "same:password"])]
    public string $password_confirmation = "";

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

    public function mount(string $token): void
    {
        $this->token = $token;
        $this->email = request()->string("email");
    }

    /**
     * @throws ValidationException
     */
    public function save(): void
    {
        $this->validate();
        $result = Password::reset($this->only("email", "password", "password_confirmation", "token"), function (User $user) {
            $user->update([
                "password" => Hash::make($this->password)
            ]);

            Auth::login($user, true);
        });

        if ($result !== Password::PASSWORD_RESET)
        {
            throw ValidationException::withMessages([
                "email" => __($result)
            ]);
        }

        session()->flash("success", __($result));
        $this->resetErrorBag();
        $this->dispatch("save-success");
        $this->redirect(RouteServiceProvider::HOME);
    }

    public function render(): View
    {
        return view('livewire.forms.user.reset-password');
    }
}
